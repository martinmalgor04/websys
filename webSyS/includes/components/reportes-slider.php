<?php
/**
 * Componente: Reportes Slider
 * Carrusel de características de Tango Reportes
 * Reutiliza Swiper.js existente (configuración en script.php línea 80+)
 * Sin dependencias nuevas
 */

/**
 * Renderizar sección Tango Reportes con estilo cult-*.
 * Layout split: izquierda mockup, derecha features + sistemas compatibles.
 * Reemplaza visualmente a renderTangoReportesSlider() en páginas modernizadas.
 *
 * @param array $opts {
 *   @type string $eyebrow  Texto eyebrow superior.
 *   @type string $title    Título principal.
 *   @type string $shimmer  Fragmento shimmer del título.
 *   @type string $subtitle Subtítulo / lead.
 *   @type array  $features Lista de features (strings).
 *   @type array  $systems  Sistemas compatibles [['name','class']].
 *   @type string $image    Ruta de la imagen/mockup.
 *   @type string $image_alt Alt de la imagen.
 *   @type string $bg       Clase de background (default: bg-body).
 *   @type string $size     'default' | 'large' | 'compact' — escala visual (imagen y tipografía).
 * }
 * @return void
 */
function renderCultTangoReportes(array $opts = []) {
    $eyebrow  = $opts['eyebrow']  ?? 'Tango Reportes';
    $title    = $opts['title']    ?? 'La información de tus empresas';
    $shimmer  = $opts['shimmer']  ?? 'desde donde estés';
    $subtitle = $opts['subtitle'] ?? 'Centralizá indicadores, ventas, sueldos y stock de todas tus empresas. Compartí informes con socios y contadores en un par de clics.';
    $features = $opts['features'] ?? [
        'Informes de Ventas, Sueldos y Stock de Tango Gestión, Punto de Venta y Restô.',
        'Análisis por empresa, sucursal o grupo de empresas.',
        'Indicadores, grillas e informes pivot multidimensional.',
        'Exportación directa a Excel.',
        'Compartí informes con permisos granulares.',
        'Acceso desde cualquier navegador y dispositivo.',
    ];
    $systems = $opts['systems'] ?? [
        ['name' => 'TANGO GESTIÓN',          'class' => 'bg-primary'],
        ['name' => 'TANGO PUNTO DE VENTA',   'class' => 'bg-primary'],
        ['name' => 'TANGO ESTUDIOS CONTABLES','class' => 'bg-warning text-dark'],
        ['name' => 'TANGO RESTÔ',            'class' => 'bg-danger'],
    ];
    $image    = $opts['image']     ?? 'assets/img/productos/tango-estudios-contables/IMAGEN NEXO.png';
    $imageAlt = $opts['image_alt'] ?? 'Tango Reportes - Vista del panel de indicadores';
    $bg            = $opts['bg']            ?? 'bg-white cult-section--white';
    $size          = $opts['size']          ?? 'default';
    $product_color = $opts['product_color']  ?? '';
    $scoped_class  = $product_color !== '' ? ' cult-product-scoped' : '';
    $scoped_style  = ($product_color !== '' && function_exists('cultProductMeshStyle'))
        ? cultProductMeshStyle($product_color)
        : '';
    $is_large      = $size === 'large';
    $is_compact    = $size === 'compact';
    $section_extra = $is_large ? ' cult-reportes--large' : ($is_compact ? ' cult-reportes--compact' : '');
    $img_col       = $is_large ? 'col-lg-7 col-xl-7' : ($is_compact ? 'col-lg-5' : 'col-lg-6');
    $text_col      = $is_large ? 'col-lg-5 col-xl-5' : ($is_compact ? 'col-lg-7' : 'col-lg-6');
    $title_class   = $is_large
        ? 'cult-display cult-reportes__title mb-4'
        : ($is_compact ? 'cult-display cult-display--lg mb-3' : 'cult-display cult-display--xl mb-3');
    ?>
    <section class="position-relative overflow-hidden cult-reportes<?= $section_extra ?><?= $scoped_class ?> <?= htmlspecialchars($bg) ?>"
             <?= $scoped_style ? 'style="' . $scoped_style . '"' : '' ?>>
        <div class="container position-relative cult-reportes__container">
            <div class="row align-items-center cult-reportes__row">
                <div class="<?= $img_col ?> cult-reportes__visual" data-aos="fade-up">
                    <img src="<?= htmlspecialchars($image) ?>"
                         alt="<?= htmlspecialchars($imageAlt) ?>"
                         class="cult-reportes__image img-fluid rounded-4"
                         loading="lazy"
                         decoding="async">
                </div>

                <div class="<?= $text_col ?> cult-reportes__content" data-aos="fade-up" data-aos-delay="100">
                    <?php if ($eyebrow): ?>
                    <span class="cult-section-eyebrow cult-reportes__eyebrow text-start"><?= htmlspecialchars($eyebrow) ?></span>
                    <?php endif; ?>
                    <h2 class="<?= $title_class ?> cult-headline-on-light">
                        <span class="cult-headline-on-light__base"><?= htmlspecialchars($title) ?></span><?php if ($shimmer): ?>
                        <span class="cult-headline-on-light__accent"> <?= htmlspecialchars($shimmer) ?></span><?php endif; ?>
                    </h2>
                    <?php if ($subtitle): ?>
                    <p class="cult-reportes__lead lead text-muted mb-4"><?= htmlspecialchars($subtitle) ?></p>
                    <?php endif; ?>

                    <ul class="list-unstyled mb-4 cult-check-list cult-reportes__features">
                        <?php foreach ($features as $feature): ?>
                        <li class="d-flex align-items-start mb-2">
                            <i class="bx bx-check-circle text-success me-2 cult-reportes__check flex-shrink-0" aria-hidden="true"></i>
                            <span><?= htmlspecialchars($feature) ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if (!empty($systems)): ?>
                    <h6 class="cult-reportes__systems-label fw-bold mb-3 text-uppercase text-muted">Sistemas compatibles</h6>
                    <div class="d-flex flex-wrap gap-2 cult-reportes__badges">
                        <?php foreach ($systems as $sys): ?>
                        <span class="badge cult-reportes__badge <?= htmlspecialchars($sys['class']) ?> px-3 py-2 rounded-pill">
                            <?= htmlspecialchars($sys['name']) ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}

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