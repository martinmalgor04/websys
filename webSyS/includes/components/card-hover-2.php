<?php
/**
 * Componente: Card Hover 2
 * Tarjetas con imagen de fondo, overlay y efectos hover
 * Reutiliza CSS existente (.card-hover-2 en sys_style.css línea 19874)
 * Sin dependencias nuevas
 */

/**
 * Renderizar tarjeta con efecto hover especial
 * @param string $title Título de la tarjeta
 * @param string $description Descripción o texto secundario
 * @param string $buttonText Texto del botón
 * @param string $buttonIcon Ruta al ícono SVG del botón
 * @param string $backgroundImage Ruta de la imagen de fondo
 * @param string $linkUrl URL de destino
 * @param string $colClass Clase de columna Bootstrap (default: col-md-6 col-sm-8 col-xl-4)
 * @return void
 */
function renderCardHover2($title, $description, $buttonText, $buttonIcon, $backgroundImage, $linkUrl, $colClass = 'col-md-6 col-sm-8 col-xl-4') {
    ?>
    <div class="<?= $colClass ?>">
        <a href="<?= htmlspecialchars($linkUrl) ?>" target="_blank" class="text-white position-relative d-block rounded-2 overflow-hidden card-hover-2">
            <img src="<?= htmlspecialchars($backgroundImage) ?>" alt="<?= htmlspecialchars($title) ?>" class="w-100 img-zoom">
            <div class="card-hover-2-overlay position-absolute start-0 top-0 w-100 h-100 d-flex px-4 py-5 flex-column justify-content-between">
                <div class="card-hover-2-header w-100">
                    <div class="card-hover-2-title">
                        <h5 class="fs-3 mb-2"><?= htmlspecialchars($title) ?></h5>
                    </div>
                    <p class="mb-0">
                        <i class="bx bx-person d-inline-block align-middle me-1"></i><?= htmlspecialchars($description) ?>
                    </p>
                </div>
                <div class="card-hover-2-footer w-100 mt-auto">
                    <span class="card-hover-2-footer-link">
                        <span class="btn btn-white">
                            <?php if ($buttonIcon): ?>
                                <img src="<?= htmlspecialchars($buttonIcon) ?>" style="width:3em;padding-right:1em;">
                            <?php endif; ?>
                            <?= $buttonText ?>
                        </span>
                    </span>
                </div>
            </div>
        </a>
    </div>
    <?php
}

/**
 * Renderizar sección de conectividad con estilo cult-*.
 * Reemplaza visualmente a renderConnectivitySection() en páginas modernizadas
 * sin romper compatibilidad con productos que siguen usando la versión legacy.
 *
 * @param string $title    Título de la sección.
 * @param string $eyebrow  Texto del eyebrow.
 * @param string $subtitle       Lead opcional bajo el título.
 * @param string $product_color  Color HEX oficial del producto (opcional).
 * @return void
 */
function renderCultConnectivitySection($title = "Tu Tango, conectado", $eyebrow = "Conectividad total", $subtitle = "Operá desde cualquier lugar y mantené sincronizadas sucursales, depósitos y puntos de venta.", $product_color = '') {
    $items = [
        [
            'title'    => 'Tango Connect',
            'subtitle' => 'Accedé a tu Tango desde cualquier dispositivo y navegador, sin instalar nada.',
            'icon'     => 'bx bx-mobile-alt',
            'cta'      => 'Conocer Tango Connect',
            'href'     => 'https://www.tangonexo.com/connect/',
        ],
        [
            'title'    => 'TangoNet',
            'subtitle' => 'Automatizá la transferencia de información entre sucursales, depósitos y casa central.',
            'icon'     => 'bx bx-network-chart',
            'cta'      => 'Conocer TangoNet',
            'href'     => 'https://www.tangonexo.com/tangonet/',
        ],
    ];

    $mesh_class = 'cult-mesh-bg cult-mesh-bg--blue text-white';
    $mesh_style = '';
    if ($product_color !== '' && function_exists('cultProductMeshStyle')) {
        $mesh_class = function_exists('cultProductMeshClass') ? cultProductMeshClass() : 'cult-mesh-bg cult-mesh-bg--product text-white';
        $mesh_style = cultProductMeshStyle($product_color);
    }
    $blob_style = $product_color !== '' && function_exists('cultNormalizeHex')
        ? 'top:-15%; left:-8%; opacity:0.3; background:' . htmlspecialchars(cultNormalizeHex($product_color), ENT_QUOTES, 'UTF-8') . ';'
        : 'top:-15%; left:-8%; opacity:0.25;';
    ?>
    <section class="position-relative overflow-hidden <?= htmlspecialchars($mesh_class, ENT_QUOTES, 'UTF-8') ?>"
             <?= $mesh_style ? 'style="' . $mesh_style . '"' : '' ?>>
        <div class="cult-hero-grid" aria-hidden="true"></div>
        <span class="cult-blob" style="<?= $blob_style ?>" aria-hidden="true"></span>

        <div class="container position-relative py-9 py-lg-11">
            <div class="row justify-content-center mb-7 mb-lg-9">
                <div class="col-lg-9 text-center">
                    <?php if ($eyebrow): ?>
                    <span class="cult-section-eyebrow cult-section-eyebrow--light" data-aos="fade-up">
                        <?= htmlspecialchars($eyebrow) ?>
                    </span>
                    <?php endif; ?>
                    <h2 class="cult-display cult-display--xl mb-3 text-white" data-aos="fade-up" data-aos-delay="50">
                        <?= htmlspecialchars($title) ?>
                    </h2>
                    <?php if ($subtitle): ?>
                    <p class="lead mx-auto" style="max-width: 42rem; opacity: 0.85;" data-aos="fade-up" data-aos-delay="100">
                        <?= htmlspecialchars($subtitle) ?>
                    </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row justify-content-center g-4">
                <?php foreach ($items as $i => $item): ?>
                <div class="col-md-6 col-lg-5" data-aos="fade-up" data-aos-delay="<?= 100 + ($i * 100) ?>">
                    <div class="cult-feature-glass d-flex flex-column h-100 p-4 p-lg-5">
                        <i class="<?= htmlspecialchars($item['icon']) ?> fs-1 mb-3" aria-hidden="true"></i>
                        <h3 class="h4 text-white mb-2"><?= htmlspecialchars($item['title']) ?></h3>
                        <p class="text-white-50 mb-4 flex-grow-1"><?= htmlspecialchars($item['subtitle']) ?></p>
                        <a href="<?= htmlspecialchars($item['href']) ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn cult-btn-glass cult-btn-shimmer align-self-start">
                            <?= htmlspecialchars($item['cta']) ?>
                            <i class="bx bx-right-arrow-alt ms-1" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar sección completa de conectividad con TangoNet y Tango Connect
 * @param string $sectionTitle Título de la sección (default: "Conectividad Total")
 * @param string $sectionBg Background de la sección (default: gradiente)
 * @return void
 */
function renderConnectivitySection($sectionTitle = "Conectividad Total", $sectionBg = "background: linear-gradient(135deg, #f47b3f 0%, #00c1de 100%);") {
    ?>
    <section class="position-relative" style="<?= $sectionBg ?>">
        <div class="container position-relative py-9 py-lg-11">
            <div class="row justify-content-center text-center text-white">
                <div class="col-lg-10 mb-9">
                    <h2 class="display-5 mb-4" data-aos="fade-up"><?= htmlspecialchars($sectionTitle) ?></h2>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <?php
                // Tango Connect
                renderCardHover2(
                    'Obtené toda la conectividad de Tango desde tu celular',
                    'Accedé a tu Tango desde cualquier dispositivo y múltiples navegadores',
                    'Conocé <b>Tango Connect</b>',
                    'assets/img/productos/icons/ico connect.svg',
                    'assets/img/productos/Conexión.jpg',
                    'https://www.tangonexo.com/connect/'
                );
                
                // TangoNet
                renderCardHover2(
                    'Conectá tu estudio',
                    'Automatizá la transferencia de datos y obtené información centralizada',
                    'Conocé <b>TangoNet</b>',
                    'assets/img/productos/icons/Tangonet Icon.svg',
                    'assets/img/productos/Tangonet cPanel.jpg',
                    'https://www.tangonexo.com/tangonet/'
                );
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>