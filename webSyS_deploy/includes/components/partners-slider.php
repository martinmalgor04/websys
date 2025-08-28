<?php
/**
 * Componente: Partners Slider
 * Carrusel de logos de partners/integraciones
 * Reutiliza Swiper.js existente (script.php línea 34-50)
 * Sin dependencias nuevas
 */

/**
 * Renderizar slider de partners/integraciones
 * @param array $partners Array de partners con estructura: ['name' => 'Nombre', 'logo' => 'ruta/logo.jpg', 'alt' => 'Alt text']
 * @param string $title Título de la sección (default: "Integrado con los mejores software")
 * @param string $containerId ID único del contenedor para múltiples sliders en misma página
 * @return void
 */
function renderPartnersSlider($partners, $title = "Integrado con los mejores software", $containerId = "partners-slider-default") {
    ?>
    <section class="position-relative">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-4" data-aos="fade-up" data-aos-delay="50">
                    <h2 class="display-5 text-center mb-5"><?= htmlspecialchars($title) ?></h2>
                </div>
            </div>
            <div data-aos="fade-up" class="border rounded-3 text-dark px-4 py-7 py-lg-9 px-lg-9 mb-5 position-relative z-1">
                <div class="swiper-container position-relative overflow-hidden swiper-partners" id="<?= $containerId ?>">
                    <div class="swiper-wrapper pb-5">
                        <?php foreach ($partners as $partner): ?>
                        <div class="swiper-slide">
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="<?= htmlspecialchars($partner['logo']) ?>" 
                                     alt="<?= htmlspecialchars($partner['alt'] ?? $partner['name']) ?>" 
                                     class="img-fluid">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar slider de partners para Tango Gestión con logos predefinidos
 * Reutiliza estructura y logos ya existentes en el proyecto
 * @param string $title Título personalizado (opcional)
 * @return void
 */
function renderTangoGestionPartnersSlider($title = "Integrado con los mejores software") {
    $partners = [
        [
            'name' => 'Mercadolibre',
            'logo' => 'assets/img/productos/integracion/logo_mercadolibre.jpg',
            'alt' => 'Mercadolibre'
        ],
        [
            'name' => 'Tiendanube',
            'logo' => 'assets/img/productos/integracion/logo_tiendanube.jpg',
            'alt' => 'Tiendanube'
        ],
        [
            'name' => 'Benfersoft',
            'logo' => 'assets/img/productos/integracion/logo_benfersoft.jpg',
            'alt' => 'Benfersoft'
        ],
        [
            'name' => 'Mercado Pago',
            'logo' => 'assets/img/productos/integracion/logo_mercadopago.jpg',
            'alt' => 'Mercado Pago'
        ],
        [
            'name' => 'PostNet',
            'logo' => 'assets/img/productos/integracion/logo_posnet.jpg',
            'alt' => 'PostNet'
        ],
        [
            'name' => 'WhatsApp',
            'logo' => 'assets/img/productos/integracion/logo_whatsapp.jpg',
            'alt' => 'WhatsApp'
        ]
    ];
    
    renderPartnersSlider($partners, $title, "tango-gestion-partners");
}

/**
 * Renderizar slider de partners para homepage con logos principales
 * @param string $title Título personalizado (opcional)
 * @return void
 */
function renderHomepagePartnersSlider($title = "Nuestros Partners Tecnológicos") {
    $partners = [
        [
            'name' => 'Tango Software',
            'logo' => 'assets/img/productos/tango-gestion/logo_gestion_w.png',
            'alt' => 'Tango Software'
        ],
        [
            'name' => 'Microsoft',
            'logo' => 'assets/img/partners/microsoft.png',
            'alt' => 'Microsoft Partner'
        ],
        [
            'name' => 'Intel',
            'logo' => 'assets/img/partners/intel.png',
            'alt' => 'Intel'
        ],
        // Agregar más partners según disponibilidad de logos
    ];
    
    renderPartnersSlider($partners, $title, "homepage-partners");
}
?>