<?php
/**
 * Componente: Cult Modules Detailed
 * Layout zigzag (imagen + contenido alternados) para productos con pocos módulos
 * y contenido visual rico. Reutiliza cult-check-list, cult-product-scoped.
 */

if (!function_exists('renderCultModulesDetailed')) {
    /**
     * @param array $modules Lista de módulos:
     *   ['title', 'eyebrow', 'icon', 'image', 'description', 'features' => []]
     * @param array $opts {
     *   @type string $section_id
     *   @type string $eyebrow
     *   @type string $title
     *   @type string $shimmer
     *   @type string $title_after
     *   @type string $subtitle
     *   @type string $bg
     *   @type string $product_color
     * }
     */
    function renderCultModulesDetailed(array $modules, array $opts = []): void
    {
        if (empty($modules)) return;

        $section_id    = $opts['section_id']    ?? 'modulos';
        $eyebrow       = $opts['eyebrow']       ?? 'Suite integrada';
        $title         = $opts['title']         ?? 'Todo lo que incluye';
        $shimmer       = $opts['shimmer']       ?? 'tu estudio';
        $title_after   = $opts['title_after']   ?? '';
        $subtitle      = $opts['subtitle']      ?? '';
        $bg            = $opts['bg']            ?? 'bg-gradient-light';
        $product_color = $opts['product_color']  ?? '';

        $scoped_class = $product_color !== '' ? ' cult-product-scoped' : '';
        $scoped_style = ($product_color !== '' && function_exists('cultProductMeshStyle'))
            ? cultProductMeshStyle($product_color)
            : '';
        ?>
        <section id="<?= htmlspecialchars($section_id, ENT_QUOTES, 'UTF-8') ?>"
                 class="position-relative overflow-hidden<?= $scoped_class ?> <?= htmlspecialchars($bg, ENT_QUOTES, 'UTF-8') ?>"
                 <?= $scoped_style ? 'style="' . $scoped_style . '"' : '' ?>>
            <div class="container position-relative py-9 py-lg-11">
                <div class="row justify-content-center mb-7 mb-lg-9">
                    <div class="col-lg-10 col-xl-8 text-center">
                        <?php if ($eyebrow): ?>
                        <span class="cult-section-eyebrow" data-aos="fade-up"><?= htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endif; ?>
                        <h2 class="cult-display cult-display--xl mb-3" data-aos="fade-up" data-aos-delay="50">
                            <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?><?php if ($shimmer): ?>
                            <span class="cult-shimmer-text"> <?= htmlspecialchars($shimmer, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?><?= $title_after ?>
                        </h2>
                        <?php if ($subtitle): ?>
                        <p class="lead text-muted mx-auto" style="max-width: 42rem;" data-aos="fade-up" data-aos-delay="100">
                            <?= htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="cult-modules-detailed">
                    <?php foreach ($modules as $index => $module):
                        $reverse     = ($index % 2) === 1;
                        $row_class   = $reverse ? 'flex-lg-row-reverse' : '';
                        $m_title     = $module['title']       ?? '';
                        $m_eyebrow   = $module['eyebrow']     ?? '';
                        $m_icon      = $module['icon']        ?? 'bx bx-cube';
                        $m_image     = $module['image']       ?? '';
                        $m_desc      = $module['description'] ?? '';
                        $m_features  = $module['features']    ?? [];
                        $delay       = 50 + ($index * 80);
                        ?>
                    <div class="cult-modules-detailed__row row align-items-center g-5 mb-7 mb-lg-9 <?= $row_class ?>" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                        <div class="col-lg-6">
                            <?php if ($m_image): ?>
                            <div class="cult-modules-detailed__media rounded-4 overflow-hidden">
                                <img src="<?= htmlspecialchars($m_image, ENT_QUOTES, 'UTF-8') ?>"
                                     alt="<?= htmlspecialchars($m_title, ENT_QUOTES, 'UTF-8') ?>"
                                     class="img-fluid w-100"
                                     loading="lazy"
                                     decoding="async">
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="cult-modules-detailed__content">
                                <?php if ($m_eyebrow): ?>
                                <span class="cult-modules-detailed__eyebrow"><?= htmlspecialchars($m_eyebrow, ENT_QUOTES, 'UTF-8') ?></span>
                                <?php endif; ?>
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <span class="cult-modules-detailed__icon" aria-hidden="true">
                                        <i class="<?= htmlspecialchars($m_icon, ENT_QUOTES, 'UTF-8') ?>"></i>
                                    </span>
                                    <h3 class="cult-modules-detailed__title mb-0"><?= htmlspecialchars($m_title, ENT_QUOTES, 'UTF-8') ?></h3>
                                </div>
                                <?php if ($m_desc): ?>
                                <p class="text-muted mb-4"><?= $m_desc ?></p>
                                <?php endif; ?>
                                <?php if (!empty($m_features)): ?>
                                <ul class="list-unstyled cult-check-list mb-0">
                                    <?php foreach ($m_features as $feature): ?>
                                    <li class="d-flex align-items-start mb-2">
                                        <i class="bx bx-check-circle text-success me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                                        <span><?= htmlspecialchars($feature, ENT_QUOTES, 'UTF-8') ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
