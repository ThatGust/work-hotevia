<?php 
    $svg_icon = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="133.333" height="108" viewBox="0 0 100 81"><path d="m44.3 19.4-3.7 7.4-10.5.7c-5.8.3-11.7.7-13.1.8-1.9.2 0 1.4 7.3 4.9 9.6 4.6 9.7 4.7 9.7 8.2 0 3.1.3 3.6 2.3 3.6 1.7 0 3.3-1.8 7-8 2.6-4.3 5.2-8.2 5.7-8.5.6-.3 2.2 1.5 3.7 4.1 5.7 9.5 8.3 12.5 10.6 12.2 1.7-.2 2.3-1.1 2.5-3.8.3-3.5.7-3.8 10-8.5l9.7-5-13.2-.3-13.2-.3-4.3-7.4c-2.4-4.1-4.9-7.5-5.6-7.5-.7 0-2.9 3.3-4.9 7.4z"/><path d="M11 37.9v7.9l6.4 3.6c3.5 2 6.8 3.6 7.3 3.6.8 0 5.7-12 5.1-12.5C28.6 39.6 11.7 30 11.4 30c-.2 0-.4 3.6-.4 7.9zM77.7 34.6c-5.3 2.7-8.7 5-8.4 5.7.2.7 1.3 3.8 2.3 6.9 1 3.2 2.2 5.8 2.8 5.8.6 0 4-1.7 7.6-3.8l6.5-3.7.3-7.8c.2-5.8 0-7.7-1-7.6-.7 0-5.3 2-10.1 4.5zM30.6 47.8c-.5.8-4.6 11.5-4.6 12 0 .1 1.4-.5 3-1.3 2.8-1.5 3-1.9 2.9-6.5-.2-5-.4-5.6-1.3-4.2zM68 51.9c0 4 .4 5.3 2.2 6.5 1.2.9 2.3 1.4 2.5 1.3.4-.4-3.8-12.7-4.3-12.7-.2 0-.4 2.2-.4 4.9zM37 58.1l-11.5 5 .3 7.4c.2 4.1.7 7.5 1.1 7.5.3 0 5.5-2 11.3-4.5C44.1 71 49.6 69 50.5 69c.8 0 5.9 2 11.2 4.5C67 76 71.7 78 72.1 78c.5 0 .9-3.4.9-7.5v-7.6L62.4 58c-5.8-2.8-11.3-5-12.3-4.9-.9 0-6.8 2.3-13.1 5z"/></svg>';
    $post_id = get_queried_object_id();
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    $banners_de_contenido = get_field("banners_de_contenido", "option");
    $numero_de_empleos_raw = get_field('numero_de_empleos', 'option');
    $numero_de_empleos = intval($numero_de_empleos_raw);
    if ($numero_de_empleos < 1) {
        $numero_de_empleos = 10;
    }
    $slider_move_seconds = intval(get_field('sec_move', $post_id));
    if ($slider_move_seconds < 1) {
        $slider_move_seconds = 2;
    }
    $slider_move_delay = $slider_move_seconds * 1000;
?>
<script>
    jQuery(document).ready(function($) {
        const sliderMoveDelay = <?php echo (int) $slider_move_delay; ?>;
        
        if (typeof Swiper !== 'undefined') {
            const logoSlider = new Swiper('.logo-grid.swiper', {
                sliceVisibility: true,
                loop: true,     
                grabCursor: true,
                spaceBetween: 20,
                autoplay: {
                    delay: sliderMoveDelay,
                    disableOnInteraction: false
                },
                breakpoints: {
                    0: {
                        slidesPerView: 2, 
                        slidesPerGroup: 1,
                        spaceBetween: 10
                    },
                    576: {
                        slidesPerView: 3,
                        slidesPerGroup: 1,
                        spaceBetween: 12
                    },
                    768: {
                        slidesPerView: 4,
                        slidesPerGroup: 1,
                        spaceBetween: 15
                    },
                    1024: {
                        slidesPerView: 6,
                        slidesPerGroup: 1
                    }
                }
            });
        } else {
            console.warn('SwiperJS script is not loaded yet. Check your WordPress enqueues.');
        }
    });
</script>
<script>
    const banners = <?php echo json_encode($banners_de_contenido); ?>;
    const numeroDeEmpleosEntreBanners = <?php echo (int) $numero_de_empleos; ?>;
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

            // Secciones que se ocultan durante una búsqueda activa
            const $seccionLogos    = $('.logo-grid-container');
            const $seccionEnlaces  = $('.city-districts-grid-container');
            
            let debounceTimeout = null;

            function hideSections(){
                $seccionLogos.hide();
                $seccionEnlaces.hide();
            }

            function showSections(){
                $seccionLogos.show();
                $seccionEnlaces.show();
            }

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
                        //console.log(response);
                        if (response.success) {
                            renderListado(response.data.empleos);
                            renderPaginacion(response.data.total_pages, response.data.current_page);
                            actualizarURL(response.data.current_page, filtrosParaEnviar);
                            // Logos y enlaces solo visibles sin filtros activos
                            if (filtrosParaEnviar.length > 0) {
                                hideSections();
                            } else {
                                showSections();
                            }
                            //console.log(response.data.query);//222
                        }
                    },
                    error: function(e) {
                        console.log(e);
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
                    let itemHtml = '';

                    if (empleo.es_destacado) {
                        itemHtml = `
                            <div class="card-destacado post-${empleo.id}" style="margin-bottom: 20px;">
                                <a href="${empleo.url}">
                                    <div class="card-destacado-content">
                                        <div class="card-destacado-main">
                                            <div class="card-destacado-header">
                                                <span class="etiqueta-gold">Empleo destacado</span>
                                            </div>
                                            <h3 class="card-destacado-title">${empleo.titulo || ''}</h3>
                                            <p class="card-destacado-empresa">${empleo.empresa || ''}</p>
                                            <p class="card-destacado-ubicacion">${empleo.ubicacion || ''}</p>
                                            <p class="card-destacado-expira">Expira el ${empleo.fecha || ''}</p>
                                        </div>
                                        ${empleo.empresa_logo ? `
                                            <div class="card-destacado-logo">
                                                <img src="${empleo.empresa_logo}" alt="Logo de ${empleo.empresa || 'empresa'}">
                                            </div>
                                        ` : ''}
                                    </div>
                                </a>
                            </div>
                        `;
                    } else {
                        itemHtml = `
                            <div class="wrap-item post-${empleo.id}">
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
                        `;
                    }

                    $listaEmpleos.append(itemHtml);

                    if ((index + 1) % numeroDeEmpleosEntreBanners === 0) {
                        const bannerIndex = Math.floor((index + 1) / numeroDeEmpleosEntreBanners) - 1;

                        if (banners[bannerIndex] && banners[bannerIndex].html) {
                            $listaEmpleos.append(`
                                <div class="banner-contenido" style="margin-top:20px; margin-bottom:20px;">
                                    ${banners[bannerIndex].html}
                                </div>
                            `);
                        }
                    }
                });
            }

            /*function renderPaginacion(totalPages, currentPage) {
                $paginacion.empty();
                if (totalPages <= 1) return;

                for (let i = 1; i <= totalPages; i++) {
                    let activeClass = (i === currentPage) ? 'active' : '';
                    $paginacion.append(`<button class="page-btn ${activeClass}" data-page="${i}">${i}</button>`);
                }
            }*/

            function renderPaginacion(totalPages, currentPage) {
                $paginacion.empty();
                if (totalPages <= 1) return;

                let rango = 2;
                let rangoInicio = Math.max(1, currentPage - rango);
                let rangoFin = Math.min(totalPages, currentPage + rango);

                if (currentPage > 1) {
                    $paginacion.append(`<button class="page-btn prev-btn prev" data-page="${currentPage - 1}">« Anterior</button>`);
                }

                if (rangoInicio > 1) {
                    $paginacion.append(`<button class="page-btn" data-page="1">1</button>`);
                    if (rangoInicio > 2) {
                        $paginacion.append(`<span class="pagination-dots" style="padding: 6px 12px; color: #70757a;">...</span>`);
                    }
                }

                for (let i = rangoInicio; i <= rangoFin; i++) {
                    let activeClass = (i === currentPage) ? 'active' : '';
                    $paginacion.append(`<button class="page-btn ${activeClass}" data-page="${i}">${i}</button>`);
                }

                if (rangoFin < totalPages) {
                    if (rangoFin < totalPages - 1) {
                        $paginacion.append(`<span class="pagination-dots" style="padding: 6px 12px; color: #70757a;">...</span>`);
                    }
                    $paginacion.append(`<button class="page-btn" data-page="${totalPages}">${totalPages}</button>`);
                }

                if (currentPage < totalPages) {
                    $paginacion.append(`<button class="page-btn next-btn next" data-page="${currentPage + 1}">Siguiente »</button>`);
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
                    //console.log("ajax_url", wp_ajax_obj.ajax_url);
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


            
            $('.google-style-search-container form').on('submit', function(e) {
                e.preventDefault();
                const query = $input.val().trim();
                if (query.length < 3) {
                    $('#search-validation-error').remove();
                    const $errorMessage = $(`
                        <div id="search-validation-error" style="
                            color: #d93025; 
                            font-size: 13px; 
                            margin-top: 8px; 
                            margin-left: 15px; 
                            font-weight: 500;
                            display: none;
                        ">
                            Debe ingresar al menos 3 caracteres para filtrar.
                        </div>
                    `);

                    $('.google-style-search-container').append($errorMessage);
                    
                    $errorMessage.fadeIn(200).delay(3000).fadeOut(400, function() {
                        $(this).remove();
                    });

                    $input.focus();
                    return false;
                }
                createTagElement('Buscar término', query, 'palabra_clave');
                $input.val('');
                $resultsBox.hide().empty();
                cargarListadoEmpleos(1);
                $input.focus();
            });
        });
    })(jQuery);
</script>