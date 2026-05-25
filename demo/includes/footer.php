<?php
declare(strict_types=1);
if (!function_exists('renderFamilyFab')) {
    require_once __DIR__ . '/components.php';
}
?>

<!-- CTA Section -->
<section class="cta-section" aria-label="Llamada a la acción">
    <div class="container">
        <h2 class="reveal">¿Listo para transformar tu empresa?</h2>
        <p class="reveal text-lg leading-relaxed">
            Más de <?= SITE_YEARS_EXPERIENCE ?> años ayudando a empresas del NEA a crecer con tecnología.
        </p>
        <div class="cluster reveal" style="justify-content: center;">
            <a href="<?= generateWhatsAppLink('Hola, me gustaría recibir asesoramiento.') ?>"
               class="btn btn--primary btn--lg btn--shimmer"
               target="_blank"
               rel="noopener noreferrer">
                Hablemos
            </a>
            <a href="tel:<?= e(SITE_PHONE) ?>" class="btn btn--neumorph btn--lg">
                <?= icon('phone', 18) ?>
                <?= e(SITE_PHONE_DISPLAY) ?>
            </a>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer" role="contentinfo">
    <div class="container">
        <div class="footer__grid">
            <div>
                <img src="<?= asset('img/logo/sys_logo_w.webp') ?>"
                     alt="<?= e(SITE_NAME) ?>"
                     width="160" height="28"
                     loading="lazy" decoding="async">
                <p class="footer__link" style="margin-top: var(--space-4); max-width: 28ch;">
                    Soluciones tecnológicas integrales para empresas del NEA argentino.
                </p>
            </div>

            <div>
                <h3 class="footer__title">Productos</h3>
                <?php foreach ($tango_products as $key => $product): ?>
                    <a href="<?= e($product['slug']) ?>.php" class="footer__link"><?= e($product['name']) ?></a>
                <?php endforeach; ?>
            </div>

            <div>
                <h3 class="footer__title">Servicios</h3>
                <a href="index.php#datacenter" class="footer__link">Datacenter</a>
                <a href="<?= e(SUPPORT_URL) ?>" class="footer__link" target="_blank" rel="noopener">Soporte Técnico</a>
                <a href="<?= e(ECOMMERCE_URL) ?>" class="footer__link" target="_blank" rel="noopener">Tienda Online</a>
            </div>

            <div>
                <h3 class="footer__title">Contacto</h3>
                <a href="tel:<?= e(SITE_PHONE) ?>" class="footer__link">
                    <?= icon('phone', 14) ?>&nbsp; <?= e(SITE_PHONE_DISPLAY) ?>
                </a>
                <a href="mailto:<?= e(SITE_EMAIL) ?>" class="footer__link">
                    <?= icon('mail', 14) ?>&nbsp; <?= e(SITE_EMAIL) ?>
                </a>
                <span class="footer__link">
                    <?= icon('map-pin', 14) ?>&nbsp; <?= e(SITE_ADDRESS) ?>
                </span>
            </div>
        </div>

        <div class="footer__bottom">
            <span>&copy; <?= date('Y') ?> <?= e(SITE_NAME) ?>. Todos los derechos reservados.</span>
            <span>Corrientes, Argentina</span>
        </div>
    </div>
</footer>

<?= renderFamilyFab() ?>

<!-- App JS (before Alpine so reveals init immediately) -->
<script src="<?= asset('js/app.js') ?>"></script>
<script src="<?= asset('js/cult.js') ?>" defer></script>

<!-- Alpine.js (with SRI) -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.11/dist/cdn.min.js"
        defer
        integrity="sha384-WPtu0YHhJ3arcykfnv1JgUffWDSKRnqnDeTpJUbOc2os2moEmLkIdaeR0trPN4be"
        crossorigin="anonymous"></script>

</body>
</html>
