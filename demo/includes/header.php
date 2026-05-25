<?php declare(strict_types=1); ?>
<header class="nav" id="site-nav" x-data="{ scrolled: false, open: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 }, { passive: true })"
        :class="{ 'scrolled': scrolled, 'nav--island': scrolled }"
        role="banner">
    <div class="container nav__inner">
        <a href="index.php" aria-label="<?= SITE_NAME ?> — Inicio">
            <picture>
                <source srcset="<?= asset('img/logo/sys_logo_w.webp') ?>" media="(prefers-color-scheme: dark)">
                <img src="<?= asset('img/logo/sys_logo.webp') ?>"
                     alt="<?= e(SITE_NAME) ?>"
                     class="nav__logo"
                     width="180" height="32"
                     loading="eager">
            </picture>
        </a>

        <button class="nav__toggle"
                @click="open = true"
                aria-label="Abrir menú"
                aria-expanded="false"
                :aria-expanded="open.toString()">
            <?= icon('menu', 20) ?>
        </button>

        <div class="nav__menu" :class="{ 'open': open }" x-cloak>
            <button class="nav__close" @click="open = false" aria-label="Cerrar menú">
                <?= icon('x', 24) ?>
            </button>

            <nav class="nav__links" aria-label="Navegación principal">
                <a href="index.php#product" class="nav__link" @click="open = false">Productos</a>
                <a href="index.php#datacenter" class="nav__link" @click="open = false">Datacenter</a>
                <a href="index.php#nosotros" class="nav__link" @click="open = false">Nosotros</a>
                <a href="index.php#faq" class="nav__link" @click="open = false">FAQ</a>
            </nav>

            <a href="<?= generateWhatsAppLink('Hola, me gustaría recibir información.') ?>"
               class="btn btn--primary btn--sm nav__cta"
               target="_blank"
               rel="noopener noreferrer">
                Contactanos
            </a>
        </div>
    </div>
</header>
