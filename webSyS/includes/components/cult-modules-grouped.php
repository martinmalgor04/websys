<?php
/**
 * Componente: Cult Modules Grouped
 * Renderiza módulos de un producto agrupados por área funcional usando
 * pestañas accesibles (Bootstrap nav-pills) en desktop y secciones
 * acumuladas (todos visibles) en mobile.
 *
 * Reutiliza: cult-pillar-card, cult-section-eyebrow, cult-display,
 * cult-shimmer-text, cult-shadow-md, motion-tilt.
 * Sin CSS adicional (usa cult-tabs si está cargado en cult.css).
 */

if (!function_exists('renderCultModulesGrouped')) {
    /**
     * Renderiza módulos agrupados por área funcional.
     *
     * @param array $groups Array asociativo:
     *   'NombreGrupo' => [
     *       ['title' => ..., 'icon' => 'bx bx-...', 'description' => ...],
     *       ...
     *   ]
     * @param array $opts {
     *   @type string $title        Encabezado de la sección.
     *   @type string $shimmer      Texto con efecto shimmer (parte del título).
     *   @type string $title_after  Texto después del shimmer.
     *   @type string $eyebrow      Texto del cult-section-eyebrow.
     *   @type string $subtitle     Lead bajo el título.
     *   @type string $section_id   ID HTML de la sección.
     *   @type string $bg             Clase de background (default: bg-gradient-light).
     *   @type string $product_color  Color HEX oficial del producto (tabs, shimmer, iconos).
     * }
     * @return void
     */
    function renderCultModulesGrouped(array $groups, array $opts = []): void
    {
        if (empty($groups)) return;

        $title         = $opts['title']         ?? 'Módulos y';
        $shimmer       = $opts['shimmer']       ?? 'Funcionalidades';
        $title_after   = $opts['title_after']   ?? '';
        $eyebrow       = $opts['eyebrow']       ?? 'Plataforma integrada';
        $subtitle      = $opts['subtitle']      ?? 'Cada módulo trabaja en conjunto para darte una visión 360° de tu negocio.';
        $section_id    = $opts['section_id']    ?? 'modulos';
        $bg            = $opts['bg']            ?? 'bg-gradient-light';
        $product_color = $opts['product_color']  ?? '';

        $scoped_class = $product_color !== '' ? ' cult-product-scoped' : '';
        $scoped_style = ($product_color !== '' && function_exists('cultProductMeshStyle'))
            ? cultProductMeshStyle($product_color)
            : '';

        $tabs_id = 'cultModulesTabs' . uniqid();
        $group_keys = array_keys($groups);
        ?>
        <section id="<?= htmlspecialchars($section_id, ENT_QUOTES, 'UTF-8') ?>" class="position-relative overflow-hidden<?= $scoped_class ?> <?= htmlspecialchars($bg, ENT_QUOTES, 'UTF-8') ?>"
                 <?= $scoped_style ? 'style="' . $scoped_style . '"' : '' ?>>
            <div class="container position-relative py-9 py-lg-11">

                <div class="row justify-content-center mb-7 mb-lg-9">
                    <div class="col-lg-10 col-xl-8 text-center">
                        <?php if ($eyebrow): ?>
                        <span class="cult-section-eyebrow" data-aos="fade-up"><?= htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endif; ?>
                        <h2 class="cult-display cult-display--xl mb-3" data-aos="fade-up" data-aos-delay="50">
                            <?= $title ?><?php if ($shimmer): ?> <span class="cult-shimmer-text"><?= $shimmer ?></span><?php endif; ?><?= $title_after ?>
                        </h2>
                        <?php if ($subtitle): ?>
                        <p class="lead text-muted mx-auto" style="max-width: 42rem;" data-aos="fade-up" data-aos-delay="100">
                            <?= $subtitle ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Pills navigation: visible en desktop, oculto en mobile -->
                <div class="d-none d-lg-flex justify-content-center mb-7" data-aos="fade-up" data-aos-delay="150">
                    <ul class="nav nav-pills cult-tabs flex-wrap justify-content-center gap-2" id="<?= $tabs_id ?>" role="tablist">
                        <?php foreach ($group_keys as $i => $group_name):
                            $tab_id   = $tabs_id . '-tab-' . $i;
                            $panel_id = $tabs_id . '-panel-' . $i;
                            $count    = count($groups[$group_name]);
                            ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link cult-tab<?= $i === 0 ? ' active' : '' ?>"
                                        id="<?= $tab_id ?>"
                                        data-bs-toggle="pill"
                                        data-bs-target="#<?= $panel_id ?>"
                                        type="button"
                                        role="tab"
                                        aria-controls="<?= $panel_id ?>"
                                        aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
                                    <?= htmlspecialchars($group_name, ENT_QUOTES, 'UTF-8') ?>
                                    <span class="cult-tab__count"><?= $count ?></span>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tab panels desktop / lista expandida mobile -->
                <div class="tab-content cult-tab-content" id="<?= $tabs_id ?>Content">
                    <?php foreach ($group_keys as $i => $group_name):
                        $panel_id = $tabs_id . '-panel-' . $i;
                        $tab_id   = $tabs_id . '-tab-' . $i;
                        $modules  = $groups[$group_name];
                        ?>
                        <div class="tab-pane fade<?= $i === 0 ? ' show active' : '' ?> cult-tab-pane"
                             id="<?= $panel_id ?>"
                             role="tabpanel"
                             aria-labelledby="<?= $tab_id ?>">

                            <!-- Encabezado de grupo: solo visible en mobile -->
                            <div class="d-lg-none mb-4 mt-<?= $i === 0 ? '0' : '6' ?>">
                                <h3 class="h4 mb-0 d-flex align-items-center gap-2">
                                    <span class="cult-tab__dot" aria-hidden="true"></span>
                                    <?= htmlspecialchars($group_name, ENT_QUOTES, 'UTF-8') ?>
                                    <span class="badge bg-primary-subtle text-primary ms-2"><?= count($modules) ?></span>
                                </h3>
                            </div>

                            <div class="row g-4 justify-content-center">
                                <?php foreach ($modules as $idx => $module):
                                    $m_title = $module['title']       ?? '';
                                    $m_icon  = $module['icon']        ?? 'bx bx-cube';
                                    $m_desc  = $module['description'] ?? '';
                                    $delay   = 50 + ($idx * 50);
                                    ?>
                                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                                        <motion-tilt max-tilt="4" speed="400" style="display:block; height:100%;">
                                            <article class="cult-pillar-card h-100 text-center">
                                                <i class="cult-pillar-card__icon <?= htmlspecialchars($m_icon, ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                                                <h4 class="cult-pillar-card__title"><?= htmlspecialchars($m_title, ENT_QUOTES, 'UTF-8') ?></h4>
                                                <p class="cult-pillar-card__text mb-0"><?= $m_desc ?></p>
                                            </article>
                                        </motion-tilt>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
