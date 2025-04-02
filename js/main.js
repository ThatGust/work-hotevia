jQuery( document ).ready(function() {
   if( jQuery(".page-ofertas-laborales").length ){

      jQuery(".filter-container .filter-tabs .filter-tab").each(function( index ) {
         let tab = jQuery(this);
         let target = jQuery(tab).attr("data-target");
         jQuery(tab).click(function( e ) {
            e.stopPropagation();
            jQuery(".filter-container .filter-whole .filter-dropdowns .custom-dropdown").each(function( index ) {
               jQuery(this).hide();
            });
            jQuery(".filter-container .filter-whole .filter-dropdowns .custom-dropdown#"+target).show();
            jQuery(".filter-container .filter-tabs .filter-tab").each(function( index ) {
               jQuery(this).removeClass("active");
            });
            jQuery(tab).addClass("active");
         });
      });

      //puesto
      jQuery(".custom-dropdown").each(function( index ) {
         let he = jQuery(this).find(".dropdown-toggle");
         let panel = jQuery(this).find(".dropdown-menu");
         
         
         jQuery(he).click(function( e ) {
            e.stopPropagation();
            if( jQuery(panel).css("display") == "none" ){
               jQuery(panel).show();
            }else{
               jQuery(panel).hide(); 
            }
         });

         jQuery(panel).find(".option-puesto").each(function( ) {
            jQuery(this).click(function(e) {
               e.stopPropagation();
               let item = jQuery(this);
               let puesto_id = jQuery(item).attr("data-id");
               jQuery(".search-bar-inside input.puesto").val(puesto_id);
               jQuery(panel).hide();
               jQuery(he).html( jQuery(item).html() );
            });
         });
      });

      
      jQuery("select#pais-select").change(function(){
         updateSelectCiudades();
         let code_country = jQuery(this).val();
         code_country = code_country.trim();
         jQuery(".search-bar-inside input.pais").val(code_country);
         /*jQuery("select#ciudad-select option").each(function(){
            let code_country_state = jQuery(this).val();
            let array_codes = code_country_state.split("@");
            let c_country = array_codes[0];
            c_country = c_country.trim();
            if(c_country == code_country){
               //console.log("add");
               jQuery(this).removeAttr("style");
            }else{
               //console.log("remove");
               jQuery(this).css("display","none");
            }
         }); */  
         //jQuery("div[data-name=\'ciudad\'] select").val(null); 
      });
      jQuery("select#pais-select").change();
      
      jQuery("select#ciudad-select").change(function(){
         let code_country_state = jQuery(this).val();
         let array_codes = code_country_state.split("@");
         let c_city = array_codes[1];
         jQuery(".search-bar-inside input.ciudad").val(c_city);
      });


      jQuery("a#form-run").click(function(){
         jQuery("form#form-ofertas-laborales").submit();
      });

   }
});

/*
document.addEventListener('DOMContentLoaded', function() {
    // SWITCH ENTRE FILTROS
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            document.getElementById('filtro-puesto').style.display = this.dataset.target === 'filtro-puesto' ? 'block' : 'none';
            document.getElementById('filtro-lugar').style.display = this.dataset.target === 'filtro-lugar' ? 'block' : 'none';
        });
    });


    // TOGGLE DEL MENÚ DE PUESTO
    var toggleButton = document.getElementById('puesto-toggle');
    var dropdownMenu = document.getElementById('puesto-menu');
    var radios = dropdownMenu.querySelectorAll('input[type="radio"]');
    var selectedText = toggleButton.querySelector('span');

    toggleButton.addEventListener('click', function() {
        dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') ? 'block' : 'none';
    });

    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            selectedText.textContent = this.nextElementSibling.textContent;
            dropdownMenu.style.display = 'none';
        });
    });

    document.addEventListener('click', function(event) {
        if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});
*/