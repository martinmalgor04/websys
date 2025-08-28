<?php
/**
 * Componentes HTML reutilizables
 * Servicios y Sistemas SRL
 */

/**
 * Componente: Sección Hero
 */
function renderHeroSection($title, $subtitle = '', $bgColor = '#00A8E1', $logoPath = null) {
    ?>
    <section class="position-relative text-white" style="background-color:<?= $bgColor ?>;">
        <div class="container position-relative py-9 py-lg-15">
            <div class="row pt-4">
                <div class="col-xl-12">
                    <div class="d-flex align-items-center flex-column">
                        <?php if ($logoPath): ?>
                            <img src="<?= $logoPath ?>" 
                                 title="<?= htmlspecialchars($title) ?>" 
                                 alt="<?= htmlspecialchars($title) ?>" 
                                 class="img-fluid mx-auto mb-4">
                        <?php else: ?>
                            <h1 class="display-4 fw-bold"><?= $title ?></h1>
                        <?php endif; ?>
                        
                        <?php if ($subtitle): ?>
                            <p class="lead mt-3"><?= $subtitle ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Componente: Sección CTA (Call to Action)
 */
function renderCTASection($title, $description, $buttonText, $buttonLink, $bgClass = 'bg-primary') {
    ?>
    <section class="overflow-hidden <?= $bgClass ?> position-relative text-white">
        <div class="container position-relative py-9 py-lg-11">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2 class="display-5 mb-4" data-aos="fade-up"><?= $title ?></h2>
                    <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100"><?= $description ?></p>
                    <div data-aos="fade-up" data-aos-delay="200">
                        <a href="<?= $buttonLink ?>" class="btn btn-white btn-lg hover-lift">
                            <span><?= $buttonText ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Componente: Tarjeta de característica
 */
function renderFeatureCard($icon, $title, $description, $delay = 0) {
    ?>
    <div class="col-md-6 col-lg-4 text-center mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
        <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
            <div class="mb-4 position-relative">
                <i class="<?= $icon ?> display-3 text-primary"></i>
            </div>
            <div class="d-flex align-items-center mb-3 justify-content-center">
                <h5 class="mb-0"><?= $title ?></h5>
            </div>
            <p class="mb-0 w-lg-75 mx-auto">
                <?= $description ?>
            </p>
        </div>
    </div>
    <?php
}

/**
 * Componente: Estadística
 */
function renderStatCard($number, $label, $icon = null, $delay = 0) {
    ?>
    <div class="col-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
        <div class="text-center">
            <?php if ($icon): ?>
                <i class="<?= $icon ?> display-4 text-primary mb-3"></i>
            <?php endif; ?>
            <h2 class="display-4 fw-bold text-primary mb-0"><?= $number ?></h2>
            <p class="text-muted"><?= $label ?></p>
        </div>
    </div>
    <?php
}

/**
 * Componente: Testimonial
 */
function renderTestimonial($quote, $author, $position, $company, $imagePath = null) {
    ?>
    <div class="card border-0 shadow-lg hover-lift">
        <div class="card-body p-5">
            <div class="mb-4">
                <i class="bx bxs-quote-alt-left display-4 text-primary opacity-25"></i>
            </div>
            <p class="lead mb-4"><?= $quote ?></p>
            <div class="d-flex align-items-center">
                <?php if ($imagePath): ?>
                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($author) ?>" 
                         class="rounded-circle me-3" width="60" height="60">
                <?php endif; ?>
                <div>
                    <h6 class="mb-0"><?= $author ?></h6>
                    <small class="text-muted"><?= $position ?> - <?= $company ?></small>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Componente: Timeline
 */
function renderTimelineItem($year, $title, $description, $isLeft = true) {
    ?>
    <div class="row mb-5 <?= $isLeft ? '' : 'flex-row-reverse' ?>">
        <div class="col-md-5">
            <div class="card card-body shadow-sm h-100" data-aos="fade-<?= $isLeft ? 'right' : 'left' ?>">
                <h5 class="text-primary mb-2"><?= $year ?></h5>
                <h6 class="mb-3"><?= $title ?></h6>
                <p class="mb-0"><?= $description ?></p>
            </div>
        </div>
        <div class="col-md-2 text-center d-none d-md-block">
            <div class="timeline-dot bg-primary rounded-circle mx-auto"></div>
            <div class="timeline-line bg-light"></div>
        </div>
        <div class="col-md-5"></div>
    </div>
    <?php
}

/**
 * Componente: Integración
 */
function renderIntegrationCard($name, $logo, $description = '') {
    ?>
    <div class="col-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100 shadow-sm hover-lift">
            <div class="card-body text-center p-4">
                <img src="<?= $logo ?>" alt="<?= htmlspecialchars($name) ?>" 
                     class="img-fluid mb-3" style="max-height: 60px;">
                <h6 class="mb-0"><?= $name ?></h6>
                <?php if ($description): ?>
                    <small class="text-muted"><?= $description ?></small>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Componente: Alerta informativa
 */
function renderAlert($message, $type = 'info', $icon = null, $dismissible = true) {
    $iconMap = [
        'info' => 'bx bx-info-circle',
        'success' => 'bx bx-check-circle',
        'warning' => 'bx bx-error',
        'danger' => 'bx bx-x-circle'
    ];
    
    if (!$icon && isset($iconMap[$type])) {
        $icon = $iconMap[$type];
    }
    ?>
    <div class="alert alert-<?= $type ?> <?= $dismissible ? 'alert-dismissible fade show' : '' ?>" role="alert">
        <?php if ($icon): ?>
            <i class="<?= $icon ?> me-2"></i>
        <?php endif; ?>
        <?= $message ?>
        <?php if ($dismissible): ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Componente: Botón WhatsApp flotante
 */
function renderWhatsAppButton($message = '') {
    $whatsappLink = generateWhatsAppLink($message);
    ?>
    <a href="<?= $whatsappLink ?>" 
       class="whatsapp-float" 
       target="_blank" 
       rel="noopener"
       data-aos="fade-up" 
       data-aos-delay="300">
        <i class="bx bxl-whatsapp"></i>
        <span class="whatsapp-text">¿Necesitás ayuda?</span>
    </a>
    <?php
}

/**
 * Componente: Spinner de carga
 */
function renderSpinner($text = 'Cargando...') {
    ?>
    <div class="spinner-loader bg-primary text-white">
        <div class="spinner-grow" role="status"></div>
        <span class="small d-block ms-2"><?= $text ?></span>
    </div>
    <?php
}
?> 