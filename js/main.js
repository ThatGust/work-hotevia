jQuery(document).ready(function ($) {
   console.log("Filtro listo!");

   $(".filter-tab").on("click", function () {
       $(".filter-tab").removeClass("active");
       $(this).addClass("active");

       let target = $(this).data("target");
       $(".filter-dropdown").removeClass("active");
       $("#" + target).addClass("active");
   });

   $(".filter-dropdown li").on("click", function () {
       let valorSeleccionado = $(this).data("value");
       let tipoFiltro = $(this).parent().parent().attr("id");

       $(".job-item").each(function () {
           let titulo = $(this).data("title");
           let ubicacion = $(this).data("location");

           let mostrar = true;

           if (tipoFiltro === "filtro-puesto" && titulo !== valorSeleccionado) {
               mostrar = false;
           }

           if (tipoFiltro === "filtro-lugar" && ubicacion !== valorSeleccionado) {
               mostrar = false;
           }

           $(this).toggle(mostrar);
       });
   });
});
