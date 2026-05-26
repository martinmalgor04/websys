<?php
/**
 * Cult components: helpers PHP para webSyS
 * Todos los snippets generan HTML compatible con Bootstrap 5 + Boxicons.
 * Usar dentro de templates existentes sin reescribir layout.
 */

if (!function_exists('cultNormalizeHex')) {
    /** Normaliza un color HEX a formato #RRGGBB. */
    function cultNormalizeHex(string $hex): string
    {
        $hex = ltrim(trim($hex), '#');
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }
        if (!preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
            return '#00A8E1';
        }
        return '#' . strtolower($hex);
    }
}

if (!function_exists('cultHexToRgb')) {
    /** @return array{0:int,1:int,2:int} */
    function cultHexToRgb(string $hex): array
    {
        $hex = ltrim(cultNormalizeHex($hex), '#');
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }
}

if (!function_exists('cultRgbToHex')) {
    function cultRgbToHex(int $r, int $g, int $b): string
    {
        return sprintf('#%02x%02x%02x', max(0, min(255, $r)), max(0, min(255, $g)), max(0, min(255, $b)));
    }
}

if (!function_exists('cultDarkenRgb')) {
    /** @return array{0:int,1:int,2:int} */
    function cultDarkenRgb(int $r, int $g, int $b, float $factor = 0.18): array
    {
        return [
            (int) round($r * (1 - $factor)),
            (int) round($g * (1 - $factor)),
            (int) round($b * (1 - $factor)),
        ];
    }
}

if (!function_exists('cultProductMeshStyle')) {
    /**
     * Variables CSS para fondos mesh con el color oficial del producto Tango.
     * Usar en style="" de secciones con clase cult-mesh-bg--product.
     */
    function cultProductMeshStyle(string $color): string
    {
        $primary = cultNormalizeHex($color);
        [$r, $g, $b] = cultHexToRgb($primary);
        $luminance = 0.299 * $r + 0.587 * $g + 0.114 * $b;

        if ($luminance < 48) {
            $deep   = '#1e293b';
            $darker = '#0f172a';
            // Acento legible para textos/eyebrows sobre fondos claros u oscuros
            $accent     = '#2563eb';
            $accentDeep = '#1e40af';
        } else {
            [$dr, $dg, $db] = cultDarkenRgb($r, $g, $b, 0.12);
            $deep = cultRgbToHex($dr, $dg, $db);
            [$dr2, $dg2, $db2] = cultDarkenRgb($r, $g, $b, 0.24);
            $darker = cultRgbToHex($dr2, $dg2, $db2);
            $accent     = $primary;
            $accentDeep = $deep;
        }

        $safePrimary    = htmlspecialchars($primary, ENT_QUOTES, 'UTF-8');
        $safeDeep       = htmlspecialchars($deep, ENT_QUOTES, 'UTF-8');
        $safeDarker     = htmlspecialchars($darker, ENT_QUOTES, 'UTF-8');
        $safeAccent     = htmlspecialchars($accent, ENT_QUOTES, 'UTF-8');
        $safeAccentDeep = htmlspecialchars($accentDeep, ENT_QUOTES, 'UTF-8');

        return "--cult-product-color:{$safePrimary};--cult-product-color-deep:{$safeDeep};--cult-product-color-darker:{$safeDarker};--cult-product-accent:{$safeAccent};--cult-product-accent-deep:{$safeAccentDeep};";
    }
}

if (!function_exists('cultProductMeshClass')) {
    /** Clases base para sección mesh teñida por producto. */
    function cultProductMeshClass(): string
    {
        return 'cult-mesh-bg cult-mesh-bg--product text-white';
    }
}

if (!function_exists('cultStatNumber')) {
    /**
     * Renderiza un número animado con label.
     *
     * @param string $value     Valor numérico final ("99.9", "33", "100", "1000")
     * @param string $label     Texto debajo
     * @param string $prefix    Prefijo opcional ("+", "<")
     * @param string $suffix    Sufijo opcional ("%", "ms", " años")
     * @param bool   $animate   true = anima counter con JS; false = render estático
     * @param string $extra     Clases extra para el bloque
     */
    function cultStatNumber(
        string $value,
        string $label,
        string $prefix = '',
        string $suffix = '',
        bool   $animate = true,
        string $extra   = ''
    ): string {
        $isNumeric  = is_numeric($value);
        $useCounter = $animate && $isNumeric;

        $cls    = 'cult-stat-block__number';
        $cls   .= $useCounter ? ' cult-stat-count' : ' cult-stat-count cult-visible';
        $extraCls = $extra ? ' ' . htmlspecialchars($extra, ENT_QUOTES, 'UTF-8') : '';

        $attrs = '';
        if ($useCounter) {
            $attrs .= ' data-target="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"';
            if ($prefix !== '') $attrs .= ' data-prefix="' . htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8') . '"';
            if ($suffix !== '') $attrs .= ' data-suffix="' . htmlspecialchars($suffix, ENT_QUOTES, 'UTF-8') . '"';
        }

        $display = $useCounter
            ? htmlspecialchars($prefix, ENT_QUOTES, 'UTF-8') . '0' . htmlspecialchars($suffix, ENT_QUOTES, 'UTF-8')
            : htmlspecialchars($prefix . $value . $suffix, ENT_QUOTES, 'UTF-8');

        ob_start(); ?>
        <div class="cult-stat-block<?= $extraCls ?>">
            <span class="<?= $cls ?>"<?= $attrs ?>><?= $display ?></span>
            <span class="cult-stat-block__label"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('cultMarquee')) {
    /**
     * Marquee infinito de logos. Recibe array de items con keys:
     *   ['src' => 'assets/img/...', 'alt' => 'Nombre']
     */
    function cultMarquee(array $items, string $variant = 'default'): string
    {
        if (empty($items)) return '';

        $marqueeCls = 'cult-marquee';
        if ($variant === 'partners') {
            $marqueeCls .= ' cult-marquee--partners';
        }

        $renderItem = static function (array $it, bool $hidden = false) use ($variant): string {
            $src = htmlspecialchars($it['src'] ?? '', ENT_QUOTES, 'UTF-8');
            $alt = htmlspecialchars($it['alt'] ?? '', ENT_QUOTES, 'UTF-8');
            $width  = isset($it['width'])  ? (int) $it['width']  : 0;
            $height = isset($it['height']) ? (int) $it['height'] : 0;
            $dimAttrs = ($width && $height) ? ' width="' . $width . '" height="' . $height . '"' : '';
            $altAttr  = $hidden ? ' alt="" aria-hidden="true"' : ' alt="' . $alt . '"';

            if ($variant === 'partners') {
                $cardCls = 'cult-marquee__card';
                if (!empty($it['card_class'])) {
                    $cardCls .= ' ' . htmlspecialchars($it['card_class'], ENT_QUOTES, 'UTF-8');
                }
                return '<div class="' . $cardCls . '"' . ($hidden ? ' aria-hidden="true"' : '') . '>'
                    . '<img src="' . $src . '"' . $altAttr . $dimAttrs . ' loading="lazy" decoding="async">'
                    . '</div>';
            }

            return '<img src="' . $src . '"' . $altAttr . $dimAttrs . ' loading="lazy" decoding="async">';
        };

        ob_start(); ?>
        <div class="<?= $marqueeCls ?>" aria-label="Logos de clientes">
            <div class="cult-marquee__track">
                <?php foreach ($items as $it): ?>
                    <?= $renderItem($it) ?>
                <?php endforeach; ?>
                <?php foreach ($items as $it): ?>
                    <?= $renderItem($it, true) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('cultFamilyFab')) {
    /**
     * Botón flotante de contacto rápido. Boxicons, sin Alpine.
     * Toggle manejado por cult.js.
     */
    function cultFamilyFab(string $whatsappLink = '', string $phone = '', string $phoneDisplay = '', string $email = ''): string
    {
        if ($whatsappLink === '' && defined('SITE_WHATSAPP')) {
            $whatsappLink = 'https://wa.me/' . SITE_WHATSAPP . '?text=' . rawurlencode('Hola, me gustaría recibir información.');
        }
        // Fallback: derivar el número de WhatsApp desde SITE_PHONE si no hay constante específica
        if ($whatsappLink === '' && defined('SITE_PHONE')) {
            // Extraer solo dígitos de SITE_PHONE (ej: "+54 3794 426022" → "543794426022")
            $waNumber = preg_replace('/[^0-9]/', '', SITE_PHONE);
            // Para Argentina, los celulares whatsapp usan el "9" después del 54
            if (strpos($waNumber, '54') === 0 && strpos($waNumber, '549') !== 0) {
                $waNumber = '549' . substr($waNumber, 2);
            }
            if ($waNumber !== '') {
                $whatsappLink = 'https://wa.me/' . $waNumber . '?text=' . rawurlencode('Hola, me gustaría recibir información.');
            }
        }
        if ($phone === '' && defined('SITE_PHONE'))               $phone        = SITE_PHONE;
        if ($phoneDisplay === '' && defined('SITE_PHONE_DISPLAY')) $phoneDisplay = SITE_PHONE_DISPLAY;
        elseif ($phoneDisplay === '')                              $phoneDisplay = $phone;
        if ($email === '' && defined('SITE_EMAIL'))               $email        = SITE_EMAIL;

        $waSafe    = htmlspecialchars($whatsappLink, ENT_QUOTES, 'UTF-8');
        $phoneSafe = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
        $phoneDis  = htmlspecialchars($phoneDisplay, ENT_QUOTES, 'UTF-8');
        $emailSafe = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        ob_start(); ?>
        <div class="cult-fab" data-open="false" aria-label="Contacto rápido">
            <div class="cult-fab__actions">
                <?php if ($whatsappLink): ?>
                <a href="<?= $waSafe ?>" target="_blank" rel="noopener noreferrer" class="cult-fab__action">
                    <span class="cult-fab__label">WhatsApp</span>
                    <span class="cult-fab__icon-btn cult-fab__icon-btn--wa" aria-label="WhatsApp">
                        <i class="bx bxl-whatsapp" aria-hidden="true"></i>
                    </span>
                </a>
                <?php endif; ?>

                <?php if ($phone): ?>
                <a href="tel:<?= $phoneSafe ?>" class="cult-fab__action">
                    <span class="cult-fab__label"><?= $phoneDis ?></span>
                    <span class="cult-fab__icon-btn cult-fab__icon-btn--phone" aria-label="Llamar">
                        <i class="bx bx-phone" aria-hidden="true"></i>
                    </span>
                </a>
                <?php endif; ?>

                <?php if ($email): ?>
                <a href="mailto:<?= $emailSafe ?>" class="cult-fab__action">
                    <span class="cult-fab__label">Email</span>
                    <span class="cult-fab__icon-btn cult-fab__icon-btn--mail" aria-label="Enviar email">
                        <i class="bx bx-envelope" aria-hidden="true"></i>
                    </span>
                </a>
                <?php endif; ?>
            </div>

            <button class="cult-fab__trigger"
                    type="button"
                    aria-expanded="false"
                    aria-label="Abrir contacto rápido">
                <i class="bx bx-plus" aria-hidden="true"></i>
            </button>
        </div>
        <?php
        return ob_get_clean();
    }
}

if (!function_exists('cultBadge')) {
    /**
     * Badge esquinero ("Disponible" / "Próximamente").
     * Usar con un elemento padre que tenga position: relative.
     */
    function cultBadge(string $text, string $variant = 'available'): string
    {
        $cls = $variant === 'soon' ? 'cult-card-badge cult-card-badge--soon' : 'cult-card-badge cult-card-badge--available';
        return '<span class="' . $cls . '">' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</span>';
    }
}
