<?php
/**
 * Componente: Cult Hero Product
 * Hero de producto moderno usando el sistema de diseño cult-*.
 * Reemplaza el hero genérico (logo grande sobre color del producto) por una
 * propuesta de valor con eyebrow, título shimmer, subtítulo, CTAs y logo lateral.
 *
 * Reutiliza: cult-mesh-bg, cult-hero-grid, cult-blob, cult-eyebrow,
 * cult-display, cult-shimmer-text--bright, cult-btn-glass, cult-btn-shimmer.
 * Sin CSS nuevo.
 */

if (!function_exists('renderCultProductHero')) {
    /**
     * Renderiza un hero de producto cult-style.
     *
     * @param array $config {
     *     @type string $eyebrow_text   Texto del eyebrow (badge superior).
     *     @type string $eyebrow_icon   Clase boxicon (ej: "bx bx-briefcase").
     *     @type string $title          Texto antes del shimmer (HTML permitido).
     *     @type string $shimmer        Fragmento con efecto shimmer-text--bright.
     *     @type string $title_after    Texto después del shimmer (HTML permitido).
     *     @type string $subtitle       Subtítulo / lead paragraph.
     *     @type array  $ctas           Array de CTAs: ['label', 'href', 'icon', 'class', 'target'].
     *     @type string $logo_src       Ruta del logo del producto (versión clara/dark).
     *     @type string $logo_alt       Texto alt del logo.
     *     @type int    $logo_width     Ancho del logo (default 320).
     *     @type int    $logo_height    Alto del logo (default 180).
     *     @type string $variant        Variante mesh: 'blue' (default), 'violet', 'plain'.
     *     @type string $product_color  Color del producto en HEX para tinting opcional.
     *     @type array  $stats          Stats bajo el hero (mismo formato que renderCultStatsStrip).
     *     @type string $decoration_html HTML adicional inyectado dentro del hero (badges, sparkles, etc.).
     * }
     * @return void Imprime el HTML.
     */
    function renderCultProductHero(array $config): void
    {
        $eyebrow_text    = $config['eyebrow_text']    ?? '';
        $eyebrow_icon    = $config['eyebrow_icon']    ?? 'bx bx-cube';
        $title           = $config['title']           ?? '';
        $shimmer         = $config['shimmer']         ?? '';
        $title_after     = $config['title_after']     ?? '';
        $subtitle        = $config['subtitle']        ?? '';
        $ctas            = $config['ctas']            ?? [];
        $logo_src        = $config['logo_src']        ?? '';
        $logo_alt        = $config['logo_alt']        ?? 'Producto';
        $logo_width      = isset($config['logo_width'])  ? (int) $config['logo_width']  : 320;
        $logo_height     = isset($config['logo_height']) ? (int) $config['logo_height'] : 180;
        $variant         = $config['variant']         ?? 'blue';
        $product_color   = $config['product_color']   ?? '';
        $stats           = $config['stats']           ?? [];
        $decoration_html = $config['decoration_html'] ?? '';

        $mesh_class = '';
        $mesh_style = '';
        $use_product_color = $product_color !== '' && function_exists('cultProductMeshStyle');

        if ($use_product_color) {
            $mesh_class = function_exists('cultProductMeshClass') ? cultProductMeshClass() : 'cult-mesh-bg cult-mesh-bg--product text-white';
            $mesh_style = cultProductMeshStyle($product_color);
        } elseif ($variant !== 'plain') {
            $mesh_class = 'cult-mesh-bg text-white';
            if ($variant === 'blue')   $mesh_class .= ' cult-mesh-bg--blue';
            if ($variant === 'violet') $mesh_class .= ' cult-mesh-bg--violet';
        }

        $blob_style = $use_product_color
            ? 'top:-15%; right:-10%; opacity:0.35; background:' . htmlspecialchars(cultNormalizeHex($product_color), ENT_QUOTES, 'UTF-8') . ';'
            : 'top:-15%; right:-10%; opacity:0.3;';
        ?>
        <section class="position-relative overflow-hidden cult-page-header <?= $mesh_class ? htmlspecialchars($mesh_class, ENT_QUOTES, 'UTF-8') : '' ?>"
                 <?= $mesh_style ? 'style="' . $mesh_style . '"' : '' ?>>
            <div class="cult-hero-grid" aria-hidden="true"></div>
            <span class="cult-blob" style="<?= $blob_style ?>" aria-hidden="true"></span>
            <span class="cult-blob" style="bottom:-20%; left:-15%; width:30rem; height:30rem; background:#ffffff; opacity:0.08; animation-delay:-6s;" aria-hidden="true"></span>
            <?= $decoration_html ?>

            <div class="container py-9 py-lg-15 position-relative">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7">
                        <?php if ($eyebrow_text): ?>
                        <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex" data-aos="fade-up">
                            <i class="<?= htmlspecialchars($eyebrow_icon, ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                            <?= htmlspecialchars($eyebrow_text, ENT_QUOTES, 'UTF-8') ?>
                        </span>
                        <?php endif; ?>

                        <h1 class="cult-display cult-display--hero mb-4" data-aos="fade-up" data-aos-delay="50">
                            <?= $title ?><?php if ($shimmer): ?> <span class="cult-shimmer-text--bright"><?= $shimmer ?></span><?php endif; ?><?= $title_after ?>
                        </h1>

                        <?php if ($subtitle): ?>
                        <p class="lead mb-5" style="max-width: 42rem; opacity: 0.88;" data-aos="fade-up" data-aos-delay="100">
                            <?= $subtitle ?>
                        </p>
                        <?php endif; ?>

                        <?php if (!empty($ctas)): ?>
                        <div class="d-flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="150">
                            <?php foreach ($ctas as $cta):
                                $label = $cta['label'] ?? 'Ver más';
                                $href  = $cta['href']  ?? '#';
                                $icon  = $cta['icon']  ?? '';
                                $cls   = $cta['class'] ?? 'cult-btn-glass cult-btn-shimmer';
                                $target = $cta['target'] ?? '';
                                $rel    = $target === '_blank' ? ' rel="noopener noreferrer"' : '';
                                ?>
                                <a href="<?= htmlspecialchars($href, ENT_QUOTES, 'UTF-8') ?>"
                                   class="btn btn-lg <?= htmlspecialchars($cls, ENT_QUOTES, 'UTF-8') ?>"
                                   <?= $target ? 'target="' . htmlspecialchars($target, ENT_QUOTES, 'UTF-8') . '"' . $rel : '' ?>>
                                    <?php if ($icon): ?><i class="<?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?> me-2" aria-hidden="true"></i><?php endif; ?>
                                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($logo_src): ?>
                    <div class="col-lg-5 text-center" data-aos="fade-up" data-aos-delay="200">
                        <motion-tilt max-tilt="6" speed="400" style="display:inline-block;">
                            <img src="<?= htmlspecialchars($logo_src, ENT_QUOTES, 'UTF-8') ?>"
                                 alt="<?= htmlspecialchars($logo_alt, ENT_QUOTES, 'UTF-8') ?>"
                                 class="img-fluid product-logo-enhanced"
                                 width="<?= $logo_width ?>"
                                 height="<?= $logo_height ?>"
                                 loading="eager"
                                 decoding="async"
                                 style="max-width: 22rem;">
                        </motion-tilt>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($stats) && function_exists('cultStatNumber')): ?>
                <div class="cult-stats-row mt-2" data-aos="fade-up" data-aos-delay="250">
                    <?php foreach ($stats as $stat):
                        if (is_string($stat)) { echo $stat; continue; }
                        echo cultStatNumber(
                            (string) ($stat['value']   ?? ''),
                            (string) ($stat['label']   ?? ''),
                            (string) ($stat['prefix']  ?? ''),
                            (string) ($stat['suffix']  ?? ''),
                            (bool)   ($stat['animate'] ?? true),
                            'cult-stat-block--light'
                        );
                    endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('renderCultStatsStrip')) {
    /**
     * Renderiza una franja de stats animados (debajo del hero o intercalada).
     *
     * @param array $stats Array de stats. Cada elemento puede ser:
     *                     ['value', 'label', 'prefix', 'suffix', 'animate']
     *                     o el ya generado por cultStatNumber().
     * @param bool  $light Si true, usa el estilo claro (sobre fondo oscuro).
     *                     Si false, asume contenedor con fondo claro.
     * @param string $bg   Clase de background opcional para wrapper.
     * @return void
     */
    function renderCultStatsStrip(array $stats, bool $light = true, string $bg = ''): void
    {
        if (empty($stats)) return;
        $blockClass = $light ? 'cult-stat-block--light' : 'cult-stat-block--dark';
        ?>
        <section class="position-relative overflow-hidden <?= htmlspecialchars($bg, ENT_QUOTES, 'UTF-8') ?>">
            <div class="container position-relative">
                <div class="cult-stats-row<?= $light ? '' : ' border-0' ?>" data-aos="fade-up" style="<?= $light ? '' : 'border-color: rgba(13,110,253,0.15);' ?>">
                    <?php foreach ($stats as $stat):
                        if (is_string($stat)) { echo $stat; continue; }
                        $value   = $stat['value']   ?? '';
                        $label   = $stat['label']   ?? '';
                        $prefix  = $stat['prefix']  ?? '';
                        $suffix  = $stat['suffix']  ?? '';
                        $animate = $stat['animate'] ?? true;
                        if (function_exists('cultStatNumber')) {
                            echo cultStatNumber((string) $value, (string) $label, (string) $prefix, (string) $suffix, (bool) $animate, $blockClass);
                        }
                    endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
