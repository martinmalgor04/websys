<?php
declare(strict_types=1);

/**
 * Componentes reutilizables — efectos tipo Cult UI
 * Requiere: helpers.php, icon.php
 */

/**
 * Stat animado con contador JS (requiere cult.js)
 *
 * @param string $value   Valor final: "99.9" | "33" | "100"
 * @param string $label   Texto debajo del número
 * @param string $prefix  Prefijo estático (ej. "<")
 * @param string $suffix  Sufijo estático (ej. "%", " años")
 * @param bool   $animate true = contador JS; false = solo fade-in
 * @param string $extra   Clases CSS extra para el bloque
 */
function renderStatNumber(
    string $value,
    string $label,
    string $prefix = '',
    string $suffix = '',
    bool   $animate = true,
    string $extra   = ''
): string {
    $isNumeric = is_numeric($value);
    $useCounter = $animate && $isNumeric;

    $numClass  = 'stat-block__number' . ($useCounter ? ' stat-count' : ' stat-fade');
    $targetAttr = $useCounter
        ? ' data-target="' . e($value) . '"'
        . ($prefix ? ' data-prefix="' . e($prefix) . '"' : '')
        . ($suffix ? ' data-suffix="' . e($suffix) . '"' : '')
        : '';

    /* Valor inicial visible para no-animado */
    $display = $useCounter
        ? ($prefix ? e($prefix) : '') . '0' . ($suffix ? e($suffix) : '')
        : e($prefix . $value . $suffix);

    ob_start(); ?>
    <div class="stat-block<?= $extra ? ' ' . e($extra) : '' ?>">
        <span class="<?= $numClass ?>"<?= $targetAttr ?>><?= $display ?></span>
        <span class="stat-block__label"><?= e($label) ?></span>
    </div>
    <?php return ob_get_clean();
}

/**
 * Marquee infinito de logos de partners (pausar en hover)
 * Duplica la lista para que el loop sea continuo.
 *
 * @param array $partners  Igual que $partners de site.php
 */
function renderLogoMarquee(array $partners): string
{
    ob_start();
    ?>
    <div class="partners-marquee" aria-label="Nuestros partners tecnológicos">
        <div class="partners-marquee__track" aria-hidden="true">
            <?php foreach ($partners as $p): ?>
                <img src="<?= asset('img/partners/' . e($p['logo'])) ?>"
                     alt="<?= e($p['name']) ?>"
                     width="120" height="32"
                     loading="lazy" decoding="async">
            <?php endforeach; ?>
            <?php /* Segunda copia para el loop seamless */ ?>
            <?php foreach ($partners as $p): ?>
                <img src="<?= asset('img/partners/' . e($p['logo'])) ?>"
                     alt=""
                     width="120" height="32"
                     loading="lazy" decoding="async"
                     aria-hidden="true">
            <?php endforeach; ?>
        </div>
    </div>
    <?php return ob_get_clean();
}

/**
 * Family FAB — botón flotante con 3 acciones (WhatsApp, teléfono, email)
 * Manejado por Alpine.js x-data. Se inyecta antes de </body>.
 */
function renderFamilyFab(): string
{
    ob_start(); ?>
    <div class="family-fab"
         x-data="{ open: false }"
         :data-open="open.toString()"
         @keydown.escape.window="open = false">

        <div class="family-fab__actions" x-cloak>

            <a href="<?= generateWhatsAppLink('Hola, me gustaría recibir información.') ?>"
               class="family-fab__action"
               target="_blank" rel="noopener noreferrer">
                <span class="family-fab__action-label">WhatsApp</span>
                <span class="family-fab__action-btn family-fab__action-btn--wa" aria-label="WhatsApp">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                    </svg>
                </span>
            </a>

            <a href="tel:<?= e(SITE_PHONE) ?>"
               class="family-fab__action">
                <span class="family-fab__action-label"><?= e(SITE_PHONE_DISPLAY) ?></span>
                <span class="family-fab__action-btn family-fab__action-btn--phone" aria-label="Llamar">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.09 6.09l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </span>
            </a>

            <a href="mailto:<?= e(SITE_EMAIL) ?>"
               class="family-fab__action">
                <span class="family-fab__action-label">Email</span>
                <span class="family-fab__action-btn family-fab__action-btn--mail" aria-label="Enviar email">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </span>
            </a>

        </div>

        <button class="family-fab__trigger"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-label="Contacto rápido">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
        </button>

    </div>
    <?php return ob_get_clean();
}
