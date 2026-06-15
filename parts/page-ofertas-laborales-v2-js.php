
<?php 
    $svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';
    $post_id = get_the_ID();
    $banners_de_contenido = get_field("banners_de_contenido", "option");
    array_shift($banners_de_contenido); //delete first item
?>
<script>
    const banners = <?php echo json_encode($banners_de_contenido); ?>;
    /**
     * LÓGICA DE CONTROL DE INTERFAZ: script.js (COMPLETO)
     */
    (function($) {
        $(function() {
            const $input = $('#autocompleteSearch');
            const $resultsBox = $('#autocompleteResults');
            const $tagsContainer = $('#searchTags');
            const $listaEmpleos = $('#lista-empleos');
            const $paginacion = $('#paginacion-empleos');
            
            const $searchSpinner = $('#searchSpinner');
            const $mainSpinner = $('#mainSpinner');
            
            let debounceTimeout = null;

            // Persiste los filtros directamente en la barra de direcciones
            function actualizarURL(pagina, filtros) {
                const url = new URL(window.location.href);
                
                if (filtros.length > 0) {
                    url.searchParams.set('filtros', JSON.stringify(filtros));
                } else {
                    url.searchParams.delete('filtros');
                }

                if (pagina > 1) {
                    url.searchParams.set('paged', pagina);
                } else {
                    url.searchParams.delete('paged');
                }

                window.history.pushState({}, '', url.toString());
            }

            // Lee los filtros activos en el DOM
            function obtenerFiltrosActivos() {
                let filtros = [];
                $('.search-tag').each(function() {
                    filtros.push({
                        key: $(this).data('key'),
                        value: $(this).data('value'),
                        tipoLabel: $(this).data('tipo-label')
                    });
                });
                return filtros;
            }

            // Trae los empleos por Ajax aplicando los bloques semánticos
            function cargarListadoEmpleos(pagina = 1, esCargaInicial = false) {
                let filtrosParaEnviar = [];

                if (esCargaInicial) {
                    const urlParams = new URLSearchParams(window.location.search);
                    const filtrosParam = urlParams.get('filtros');
                    if (filtrosParam) {
                        try {
                            filtrosParaEnviar = JSON.parse(filtrosParam);
                            filtrosParaEnviar.forEach(f => {
                                createTagElement(f.tipoLabel, f.value, f.key);
                            });
                        } catch(e) { 
                            console.error("Error interpretando variables de URL", e); 
                        }
                    }
                } else {
                    filtrosParaEnviar = obtenerFiltrosActivos();
                }

                $.ajax({
                    url: wp_ajax_obj.ajax_url,
                    type: 'GET',
                    data: {
                        action: 'filtrar_y_paginar_empleos',
                        post_id: '<?php echo $post_id; ?>',
                        paged: pagina,
                        filtros: filtrosParaEnviar
                    },
                    beforeSend: function() {
                        $mainSpinner.show();
                        $listaEmpleos.css('opacity', '0.3');
                    },
                    success: function(response) {
                        $mainSpinner.hide();
                        $listaEmpleos.css('opacity', '1');
                        
                        if (response.success) {
                            renderListado(response.data.empleos);
                            renderPaginacion(response.data.total_pages, response.data.current_page);
                            actualizarURL(response.data.current_page, filtrosParaEnviar);
                        }
                    },
                    error: function() {
                        $mainSpinner.hide();
                        $listaEmpleos.css('opacity', '1');
                    }
                });
            }

            function renderListado(empleos) {
                $listaEmpleos.empty();
                if (empleos.length === 0) {
                    $listaEmpleos.html('<p class="no-results">No se encontraron empleos con los criterios seleccionados.</p>');
                    return;
                }
                empleos.forEach(function(empleo, index) {
                    $listaEmpleos.append(`
                        <div class="wrap-item">
                            <a href="${empleo.url}" class="job-item">
                                <span class="icon"><?php echo $svg_icon; ?></span>

                                ${empleo.titulo ? `
                                    <span class="job-title-list">${empleo.titulo}</span>
                                    <span class="job-separator"> - </span>
                                ` : ''}

                                ${empleo.empresa ? `
                                    <span class="job-location">${empleo.empresa} /</span>
                                ` : ''}

                                ${(empleo.ubicacion || empleo.fecha) ? `
                                    <span class="job-info">
                                        ${empleo.ubicacion || ''}
                                        ${empleo.ubicacion && empleo.fecha ? ' - ' : ''}
                                        ${empleo.fecha || ''}
                                    </span>
                                ` : ''}
                            </a>
                        </div>
                    `);

                    // Insertar banner cada 10 empleos
                    if ((index + 1) % 10 === 0) {
                        const bannerIndex = Math.floor((index + 1) / 10) - 1;

                        if (banners[bannerIndex] && banners[bannerIndex].html) {
                            $listaEmpleos.append(`
                                <div class="banner-contenido">
                                    ${banners[bannerIndex].html}
                                </div>
                            `);
                        }
                    }
                });
            }

            function renderPaginacion(totalPages, currentPage) {
                $paginacion.empty();
                if (totalPages <= 1) return;

                for (let i = 1; i <= totalPages; i++) {
                    let activeClass = (i === currentPage) ? 'active' : '';
                    $paginacion.append(`<button class="page-btn ${activeClass}" data-page="${i}">${i}</button>`);
                }
            }

            $paginacion.on('click', '.page-btn', function() {
                let destino = $(this).data('page');
                cargarListadoEmpleos(destino);
                $('html, body').animate({ scrollTop: $(".google-style-search-container").offset().top - 20 }, 300);
            });

            // Autocompletado reactivo
            $input.on('input', function() {
                clearTimeout(debounceTimeout);
                const query = $(this).val().trim();

                if (query.length < 2) {
                    $resultsBox.hide().empty();
                    $searchSpinner.hide();
                    return;
                }

                $searchSpinner.show();

                debounceTimeout = setTimeout(function() {
                    $.ajax({
                        url: wp_ajax_obj.ajax_url,
                        type: 'GET',
                        data: {
                            action: 'buscar_empleos_autocomplete',
                            term: query
                        },
                        success: function(response) {
                            $searchSpinner.hide();
                            if (response.success && response.data.length > 0) {
                                renderSuggestions(response.data);
                            } else {
                                $resultsBox.hide().empty();
                            }
                        },
                        error: function() { 
                            $searchSpinner.hide(); 
                        }
                    });
                }, 350);
            });

            function renderSuggestions(data) {
                $resultsBox.empty();
                data.forEach(function(item) {
                    // Se agrega una clase condicional css si es la opción global por palabra clave
                    let extraClass = (item.key === 'palabra_clave') ? 'global-keyword-sug' : '';
                    
                    $resultsBox.append(`
                        <div class="suggestion-item ${extraClass}" data-key="${item.key}" data-value="${item.label}" data-tipo="${item.tipo}">
                            <span class="suggestion-label">${item.label}</span>
                            <span class="suggestion-category-badge">${item.tipo}</span>
                        </div>
                    `);
                });
                $resultsBox.show();
            }

            // Selección de sugerencias
            $resultsBox.on('click', '.suggestion-item', function() {
                const key = $(this).data('key');
                const value = $(this).data('value');
                const tipoLabel = $(this).data('tipo');

                createTagElement(tipoLabel, value, key);
                $input.val('');
                $resultsBox.hide().empty();
                
                cargarListadoEmpleos(1);
                $input.focus();
            });

            function createTagElement(tipoLabel, value, key) {
                let exists = false;
                $('.search-tag').each(function() {
                    if ($(this).data('key') === key && $(this).data('value') === value) {
                        exists = true;
                    }
                });
                if (exists) return;

                $tagsContainer.append(`
                    <div class="search-tag" data-key="${key}" data-value="${value}" data-tipo-label="${tipoLabel}">
                        <span class="tag-category">${tipoLabel}:</span>
                        <span class="tag-value">${value}</span>
                        <span class="remove-tag">&times;</span>
                    </div>
                `);
            }

            // Remover tag individual
            $tagsContainer.on('click', '.remove-tag', function(e) {
                e.stopPropagation();
                $(this).closest('.search-tag').remove();
                cargarListadoEmpleos(1);
                $input.focus();
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.google-style-search-container').length) {
                    $resultsBox.hide();
                }
            });

            // Inicialización al refrescar
            const urlParams = new URLSearchParams(window.location.search);
            const paginaInicial = parseInt(urlParams.get('paged')) || 1;
            cargarListadoEmpleos(paginaInicial, true);
        });
    })(jQuery);
</script>


<style>
    /**
    * ARQUITECTURA VISUAL: style.css (COMPLETO)
    */
    .google-style-search-container {
        
    }
    .search-input-wrapper {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        border: 1px solid #dfe1e5;
        border-radius: 24px;
        padding: 6px 45px 6px 15px;
        background: #fff;
        position: relative;
    }
    .search-input-wrapper:focus-within {
        box-shadow: 0 1px 6px rgba(32,33,36,0.28);
        border-color: transparent;
    }
    .search-tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .search-tag {
        background-color: #f1f3f4;
        border: 1px solid #dadce0;
        border-radius: 16px;
        padding: 4px 12px;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .search-tag .tag-category {
        color: #5f6368;
        font-weight: bold;
    }
    .search-tag .tag-value {
        color: #1a73e8;
        font-weight: 500;
    }
    .search-tag .remove-tag {
        cursor: pointer;
        color: #70757a;
        font-weight: bold;
        margin-left: 4px;
    }
    .search-tag .remove-tag:hover { color: #d93025; }

    #autocompleteSearch {
        border: none;
        outline: none;
        flex-grow: 1;
        padding: 8px 5px;
        font-size: 16px;
        min-width: 120px;
        margin: 0;
    }

    /* CARGADORES (SPINNERS CSS) */
    .search-spinner {
        width: 18px;
        height: 18px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #1a73e8;
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
        position: absolute;
        right: 15px;
    }
    .main-spinner-wrapper {
        display: flex;
        justify-content: center;
        padding: 30px 0;
    }
    .loader-wheel {
        width: 35px;
        height: 35px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #1a73e8;
        border-radius: 50%;
        animation: spin 0.9s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* DROPDOWN DE SUGERENCIAS COINCIDENTES */
    .autocomplete-suggestions-box {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #dfe1e5;
        border-top: none;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 6px rgba(32,33,36,0.28);
        z-index: 999;
        max-height: 320px;
        overflow-y: auto;
    }
    .suggestion-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 18px;
        cursor: pointer;
        border-bottom: 1px solid #f1f3f4;
    }
    .suggestion-item:hover { background-color: #f8f9fa; }
    .suggestion-label { font-size: 15px; color: #202124; font-weight: 500; }

    .suggestion-category-badge {
        font-size: 11px;
        background-color: #e8f0fe;
        color: #1a73e8;
        padding: 3px 8px;
        border-radius: 10px;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 0.5px;
    }

    /* ESTILO OPCIÓN GLOBAL DE PALABRA CLAVE */
    .suggestion-item.global-keyword-sug {
        background-color: #fbfdff;
        border-bottom: 2px solid #e8f0fe;
    }
    .suggestion-item.global-keyword-sug .suggestion-label {
        color: #1a73e8;
        font-weight: bold;
    }
    .suggestion-item.global-keyword-sug .suggestion-category-badge {
        background-color: #1a73e8;
        color: #fff;
    }

    /* MAQUETACIÓN RESULTADOS PRINCIPALES */
    #lista-empleos-container {  }
    .empleo-item-lista { padding: 15px 0; border-bottom: 1px solid #e0e0e0; }
    .empleo-item-lista h3 { margin: 0; font-size: 18px; }
    .empleo-item-lista h3 a { color: #1a0dab; text-decoration: none; }
    .empleo-item-lista h3 a:hover { text-decoration: underline; }

    /* CONTROLES DE CAMBIO DE PÁGINA */
    .page-btn { background: #fff; border: 1px solid #dadce0; border-radius: 4px; padding: 6px 12px; cursor: pointer; }
    .page-btn:hover { background: #f8f9fa; }
    .page-btn.active { background: #1a73e8; color: #fff; border-color: #1a73e8; font-weight: bold; cursor: default; }
    .no-results { text-align: center; color: #70757a; padding-top: 15px; }
</style>
