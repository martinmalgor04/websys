<?php
/**
 * Componente: Reportes Slider
 * Carrusel de características de Tango Reportes
 * Reutiliza Swiper.js existente (configuración en script.php línea 80+)
 * Sin dependencias nuevas
 */

/**
 * Renderizar slider de Tango Reportes con características predefinidas
 * @param string $title Título de la sección (default: "TANGO REPORTES")
 * @param string $subtitle Subtítulo de la sección
 * @param string $bgClass Clase de background (default: "bg-light")
 * @param array $customFeatures Features personalizadas (opcional)
 * @return void
 */
function renderTangoReportesSlider($title = "TANGO REPORTES", $subtitle = "La información de tus empresas desde donde estés", $bgClass = "bg-light", $customFeatures = []) {
    // Features por defecto de Tango Reportes
    $defaultFeatures = [
        "Ver informes de los módulos Ventas, Sueldos y Stock de Tango Gestión, Punto de Venta y Restó; y de Comandas de Tango Restô.",
        "Analizar la información de una empresa (o sucursal) o por un grupo de ellas.",
        "Definir tus grupos de empresas de acuerdo a la necesidad de información.",
        "Visualizar tu información mediante indicadores, informes de tipo grilla y pivot (multidimensional).",
        "Exportar los informes a Excel.",
        "Compartir tu información y recibir invitaciones - Seleccionando informes puntuales de una empresa o grupo de empresas, o bien todos los informes."
    ];
    
    $features = !empty($customFeatures) ? $customFeatures : $defaultFeatures;
    
    ?>
    <section class="position-relative overflow-hidden <?= $bgClass ?>">
        <div class="container w-lg-60 py-9 py-lg-11">
            <h2 class="display-3 mb-3" data-aos="fade-up"><?= htmlspecialchars($title) ?></h2>
            <p class="mb-6 mx-auto lead" data-aos="fade-up" data-aos-delay="100">
                <?= htmlspecialchars($subtitle) ?>
            </p>
            <div class="swiper overflow-visible swiper-reportes">
                <div class="swiper-wrapper text-center mb-7">
                    <?php foreach ($features as $feature): ?>
                    <div class="swiper-slide py-7 py-lg-9 px-4 px-xl-9 bg-body-tertiary rounded-4 shadow-xl">
                        <p class="fs-4 fw-normal">
                            ✔ <?= htmlspecialchars($feature) ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-pagination swiper-reportes-pagination bottom-0 position-relative pt-4">
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar slider de características genérico 
 * @param array $features Array de características
 * @param string $title Título de la sección
 * @param string $subtitle Subtítulo de la sección
 * @param string $bgClass Clase de background
 * @param string $sliderId ID único del slider para múltiples sliders en misma página
 * @param string $checkIcon Ícono de check (default: "✔")
 * @return void
 */
function renderFeaturesSlider($features, $title, $subtitle = "", $bgClass = "bg-light", $sliderId = "features-slider", $checkIcon = "✔") {
    ?>
    <section class="position-relative overflow-hidden <?= $bgClass ?>">
        <div class="container w-lg-60 py-9 py-lg-11">
            <h2 class="display-3 mb-3" data-aos="fade-up"><?= htmlspecialchars($title) ?></h2>
            <?php if ($subtitle): ?>
            <p class="mb-6 mx-auto lead" data-aos="fade-up" data-aos-delay="100">
                <?= htmlspecialchars($subtitle) ?>
            </p>
            <?php endif; ?>
            <div class="swiper overflow-visible <?= htmlspecialchars($sliderId) ?>">
                <div class="swiper-wrapper text-center mb-7">
                    <?php foreach ($features as $feature): ?>
                    <div class="swiper-slide py-7 py-lg-9 px-4 px-xl-9 bg-body-tertiary rounded-4 shadow-xl">
                        <p class="fs-4 fw-normal">
                            <?= $checkIcon ?> <?= htmlspecialchars($feature) ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-pagination <?= htmlspecialchars($sliderId) ?>-pagination bottom-0 position-relative pt-4">
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar slider de beneficios del producto
 * @param array $benefits Array de beneficios con estructura: ['title' => '', 'description' => '', 'icon' => '']
 * @param string $title Título de la sección
 * @param string $subtitle Subtítulo de la sección
 * @param string $bgClass Clase de background
 * @return void
 */
function renderBenefitsSlider($benefits, $title = "Beneficios del Sistema", $subtitle = "", $bgClass = "bg-light") {
    ?>
    <section class="position-relative overflow-hidden <?= $bgClass ?>">
        <div class="container w-lg-60 py-9 py-lg-11">
            <h2 class="display-3 mb-3" data-aos="fade-up"><?= htmlspecialchars($title) ?></h2>
            <?php if ($subtitle): ?>
            <p class="mb-6 mx-auto lead" data-aos="fade-up" data-aos-delay="100">
                <?= htmlspecialchars($subtitle) ?>
            </p>
            <?php endif; ?>
            <div class="swiper overflow-visible swiper-benefits">
                <div class="swiper-wrapper text-center mb-7">
                    <?php foreach ($benefits as $benefit): ?>
                    <div class="swiper-slide py-7 py-lg-9 px-4 px-xl-9 bg-body-tertiary rounded-4 shadow-xl">
                        <?php if (isset($benefit['icon'])): ?>
                        <div class="mb-4">
                            <i class="<?= htmlspecialchars($benefit['icon']) ?> display-3 text-primary"></i>
                        </div>
                        <?php endif; ?>
                        <h5 class="fw-bold mb-3"><?= htmlspecialchars($benefit['title']) ?></h5>
                        <p class="fs-6 fw-normal mb-0">
                            <?= htmlspecialchars($benefit['description']) ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="swiper-pagination swiper-benefits-pagination bottom-0 position-relative pt-4">
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar Tango Reportes para productos específicos
 * @param array $compatibleSystems Sistemas compatibles con badges
 * @return void
 */
function renderTangoReportesSection($compatibleSystems = []) {
    $defaultSystems = [
        ['name' => 'TANGO GESTIÓN', 'class' => 'bg-primary'],
        ['name' => 'TANGO PUNTO DE VENTA', 'class' => 'bg-primary'],
        ['name' => 'TANGO ESTUDIOS CONTABLES', 'class' => 'bg-warning'],
        ['name' => 'TANGO RESTO', 'class' => 'bg-danger']
    ];
    
    $systems = !empty($compatibleSystems) ? $compatibleSystems : $defaultSystems;
    
    ?>
    <section class="overflow-hidden bg-body position-relative">
        <div class="container position-relative py-9 py-lg-11">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
                    <div class="pe-lg-5">
                        <h2 class="display-6 mb-4">TANGO REPORTES</h2>
                        <h4 class="mb-4 text-primary">La información de tus empresas desde donde estés</h4>
                        <div class="mb-4">
                            <ul class="list-unstyled">
                                <li class="py-2"><i class="bx bx-check text-success me-2"></i>Ver informes de los módulos Ventas, Sueldos y Stock de Tango Gestión, Punto de Venta y Restó; y de Comandas de Tango Restô.</li>
                                <li class="py-2"><i class="bx bx-check text-success me-2"></i>Analizar la información de una empresa (o sucursal) o por un grupo de ellas.</li>
                                <li class="py-2"><i class="bx bx-check text-success me-2"></i>Definir tus grupos de empresas de acuerdo a la necesidad de información.</li>
                                <li class="py-2"><i class="bx bx-check text-success me-2"></i>Visualizar tu información mediante indicadores, informes de tipo grilla y pivot (multidimensional).</li>
                                <li class="py-2"><i class="bx bx-check text-success me-2"></i>Exportar los informes a Excel.</li>
                                <li class="py-2"><i class="bx bx-check text-success me-2"></i>Compartir tu información y recibir invitaciones.</li>
                                <li class="py-2"><i class="bx bx-check text-success me-2"></i>Seleccionando informes puntuales de una empresa o grupo de empresas, o bien todos los informes.</li>
                            </ul>
                        </div>
                        <p class="lead">
                            Tango Reportes te permite acceder a la información consolidada de ventas, sueldos y stock de tus empresas desde donde estés.
                        </p>
                        
                        <h6 class="fw-bold mt-4 mb-3">Sistemas compatibles</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($systems as $system): ?>
                            <span class="badge <?= htmlspecialchars($system['class']) ?> px-3 py-2"><?= htmlspecialchars($system['name']) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="position-relative">
                        <img src="assets/img/productos/tango-estudios-contables/IMAGEN NEXO.png" alt="Tango Reportes" class="img-fluid rounded-3 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>