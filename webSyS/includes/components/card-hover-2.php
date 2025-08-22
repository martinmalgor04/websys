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