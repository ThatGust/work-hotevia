<?php
    /**
     * @package WordPress
     * @subpackage Default_Theme
     * Template Name: Ofertas Laborales
     */

   $page_id = get_the_ID();
    
   //Header
   $f_s1_background = get_field("s1_background", $page_id);

   //Sites
   $f_s2_title = get_field("s2_title", $page_id);
?>
<?php get_header(); ?>

<main id="main-content" class="page wrapper page-ofertas-laborales" role="main">
    <section class="section1 wrapper">
        <div class="container">
            <div class="wrapper inner-container">
                <div class="wrap-info">
                    <div class="row row1">
                        <h1>Ofertas Laborales</h1>
                    </div>

                    <div class="filters">
                        <label for="filter-by">Filtrar por:</label>
                        <select id="filter-by-puesto">
                            <option value="">Puesto</option>
                            <option value="administrador">Administrador</option>
                            <option value="asistente-limpieza">Asistente de Limpieza</option>
                            <option value="ejecutivo-cuentas">Ejecutivo de Cuentas</option>
                            <option value="gerente-general">Gerente General</option>
                            <option value="recepcionista">Recepcionista</option>
                            <option value="supervisor">Supervisor</option>
                        </select>
                        <select id="filter-by-lugar">
                            <option value="">Lugar</option>
                        </select>
                        <button class="filter-btn">Filtrar >></button>
                    </div>

                    <div class="job-listings">
                        <div class="job-item">
                            <h2 class="job-title">RECEPCIONISTA - PARIWANA HOSTEL</h2>
                            <p class="job-location">Miraflores - 15 marzo, 2025</p>
                        </div>
                        <div class="job-item">
                            <h2 class="job-title">SUPERVISOR DE MANTENIMIENTOs - SOUMA HOTEL LIMA A VIGNETTE COLLECTION</h2>
                            <p class="job-location">Miraflores - 31 marzo, 2025</p>
                        </div>
                        <div class="job-item">
                            <h2 class="job-title">AUXILIAR DE AREAS PÚBLICAS - BEST WESTERN URBAN LARCO HOTEL</h2>
                            <p class="job-location">Miraflores - 2 abril, 2025</p>
                        </div>
                        <div class="job-item">
                            <h2 class="job-title">RECEPCIONISTA - HOTEL BRITANIA MIRAFLORES</h2>
                            <p class="job-location">Miraflores - 3 abril, 2025</p>
                        </div>
                        <div class="job-item">
                            <h2 class="job-title">SENIOR SALES MANAGER - HOTEL BRITANIA MIRAFLORES</h2>
                            <p class="job-location">Miraflores - 3 abril, 2025</p>
                        </div>
                        <div class="job-item">
                            <h2 class="job-title">PERSONAL PARA HK - CUARTELEROS - JW MARRIOTT LIMA HOTEL</h2>
                            <p class="job-location">Miraflores - 4 abril, 2025</p>
                        </div>
                        <div class="job-item">
                            <h2 class="job-title">CAMAREROS DE HOUSEKEEPING - HOTEL BRITANIA MIRAFLORES</h2>
                            <p class="job-location">Miraflores - 5 abril, 2025</p>
                        </div>
                        <div class="job-item">
                            <h2 class="job-title">RECEPCIONISTA - HOTEL BRITANIA MIRAFLORES</h2>
                            <p class="job-location">Miraflores - 5 abril, 2025</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>