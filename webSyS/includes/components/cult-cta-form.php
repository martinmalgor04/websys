<?php
/**
 * Componente: Cult CTA + Formulario de Contacto
 * Sección de cierre con título, lead y formulario de contacto idéntico
 * al de gestion-it.php / datacenter.php (POST a enviar-datacenter.php).
 *
 * Reutiliza: CSRFProtection, sys-forms.js (id="datacenterForm"),
 * cult-form-radio-chip, cult-form-select-wrap.
 *
 * IMPORTANTE: requiere que initSecurity() ya esté ejecutado en la página.
 */

if (!function_exists('renderCultCtaForm')) {
    /**
     * Renderiza la sección CTA con formulario de contacto.
     *
     * @param array $config {
     *   @type string $section_id      Default: 'contacto'.
     *   @type string $eyebrow         Texto eyebrow superior.
     *   @type string $title           Encabezado (HTML permitido en spans).
     *   @type string $shimmer         Fragmento shimmer en el título.
     *   @type string $subtitle        Lead bajo el título.
     *   @type string $asunto_default  Valor por defecto del select asunto.
     *   @type array  $asunto_options  Opciones del select [value => label] o [['value','label'], ...].
     *   @type string $mensaje_ph      Placeholder del textarea.
     *   @type string $bg_variant      'mesh-blue' (default) | 'mesh-product' | 'dark' | 'plain'.
     *   @type string $product_color   Color HEX del producto (requerido si bg_variant = mesh-product).
     *   @type string $logo_src        Ruta opcional del logo a mostrar arriba del título.
     *   @type string $logo_alt        Alt del logo (default: '').
     *   @type int    $logo_height     Altura máxima del logo en px (default: 72).
     * }
     * @return void
     */
    function renderCultCtaForm(array $config = []): void
    {
        $section_id     = $config['section_id']     ?? 'contacto';
        $eyebrow        = $config['eyebrow']        ?? 'Hablemos';
        $title          = $config['title']          ?? '¿Listo para';
        $shimmer        = $config['shimmer']        ?? 'transformar';
        $title_after    = $config['title_after']    ?? ' tu gestión?';
        $subtitle       = $config['subtitle']       ?? 'Coordinemos una demo personalizada y descubrí cómo nuestras soluciones potencian tu negocio.';
        $asunto_default = $config['asunto_default'] ?? '';
        $asunto_options = $config['asunto_options'] ?? [
            'TANGO GESTIÓN'        => 'Tango Gestión',
            'DEMO TANGO GESTIÓN'   => 'Solicitar demo',
            'PRESUPUESTO'          => 'Presupuesto',
            'SOPORTE'              => 'Soporte',
            'CONSULTA GENERAL'     => 'Consulta general',
        ];
        $mensaje_ph     = $config['mensaje_ph']     ?? 'Contanos sobre tu empresa y qué necesitás resolver…';
        $bg_variant     = $config['bg_variant']     ?? 'mesh-blue';
        $product_color  = $config['product_color']  ?? '';
        $logo_src       = $config['logo_src']       ?? '';
        $logo_alt       = $config['logo_alt']       ?? '';
        $logo_height    = isset($config['logo_height']) ? (int) $config['logo_height'] : 72;

        $section_classes = 'position-relative overflow-hidden';
        $section_style   = '';
        $card_dark = false;
        if ($bg_variant === 'mesh-product' && $product_color !== '' && function_exists('cultProductMeshStyle')) {
            $section_classes .= ' ' . (function_exists('cultProductMeshClass') ? cultProductMeshClass() : 'cult-mesh-bg cult-mesh-bg--product text-white');
            $section_style = cultProductMeshStyle($product_color);
            $card_dark = true;
        } elseif ($bg_variant === 'mesh-blue') {
            $section_classes .= ' cult-mesh-bg cult-mesh-bg--blue text-white';
            $card_dark = true;
        } elseif ($bg_variant === 'dark') {
            $section_classes .= ' bg-dark text-white';
            $card_dark = true;
        } else {
            $section_classes .= ' bg-body';
        }
        ?>
        <section id="<?= htmlspecialchars($section_id, ENT_QUOTES, 'UTF-8') ?>" class="<?= htmlspecialchars($section_classes, ENT_QUOTES, 'UTF-8') ?>"
                 <?= $section_style ? 'style="' . $section_style . '"' : '' ?>>
            <?php if ($card_dark): ?>
            <div class="cult-hero-grid" aria-hidden="true"></div>
            <?php
            $blob_style = ($bg_variant === 'mesh-product' && $product_color !== '' && function_exists('cultNormalizeHex'))
                ? 'top:-20%; right:-12%; opacity:0.28; background:' . htmlspecialchars(cultNormalizeHex($product_color), ENT_QUOTES, 'UTF-8') . ';'
                : 'top:-20%; right:-12%; opacity:0.2;';
            ?>
            <span class="cult-blob" style="<?= $blob_style ?>" aria-hidden="true"></span>
            <?php endif; ?>

            <div class="container position-relative py-9 py-lg-11">
                <div class="row justify-content-center mb-7 mb-lg-9">
                    <div class="col-lg-10 text-center">
                        <?php if ($logo_src): ?>
                        <div class="mb-4 d-flex justify-content-center" data-aos="fade-up">
                            <img src="<?= htmlspecialchars($logo_src, ENT_QUOTES, 'UTF-8') ?>"
                                 alt="<?= htmlspecialchars($logo_alt, ENT_QUOTES, 'UTF-8') ?>"
                                 class="img-fluid"
                                 style="max-height: <?= $logo_height ?>px; width: auto;"
                                 loading="lazy"
                                 decoding="async">
                        </div>
                        <?php endif; ?>
                        <?php if ($eyebrow): ?>
                        <span class="cult-section-eyebrow<?= $card_dark ? ' cult-section-eyebrow--light' : '' ?>" data-aos="fade-up">
                            <?= htmlspecialchars($eyebrow, ENT_QUOTES, 'UTF-8') ?>
                        </span>
                        <?php endif; ?>
                        <h2 class="cult-display cult-display--xl mb-4<?= $card_dark ? ' text-white' : '' ?>" data-aos="fade-up" data-aos-delay="50">
                            <?= $title ?><?php if ($shimmer): ?> <span class="<?= $card_dark ? 'cult-shimmer-text--bright' : 'cult-shimmer-text' ?>"><?= $shimmer ?></span><?php endif; ?><?= $title_after ?>
                        </h2>
                        <?php if ($subtitle): ?>
                        <p class="lead mx-auto<?= $card_dark ? '' : ' text-muted' ?>" style="max-width: 42rem;<?= $card_dark ? ' opacity:0.85;' : '' ?>" data-aos="fade-up" data-aos-delay="100">
                            <?= htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="card card-body py-5 px-4 px-md-5 shadow-lg border-0 text-body" data-aos="fade-up" data-aos-delay="150" style="border-radius: var(--cult-r-xl);">
                            <form id="datacenterForm" method="POST" action="enviar-datacenter.php" novalidate>
                                <?php
                                if (class_exists('CSRFProtection')) {
                                    echo CSRFProtection::getTokenField('contact_form');
                                }
                                ?>

                                <div id="form-messages" class="mb-4" style="display: none;">
                                    <div id="success-message" class="alert alert-success" role="alert" style="display: none;">
                                        <i class="bx bx-check-circle me-2" aria-hidden="true"></i><span></span>
                                    </div>
                                    <div id="error-message" class="alert alert-danger" role="alert" style="display: none;">
                                        <i class="bx bx-error me-2" aria-hidden="true"></i><span></span>
                                    </div>
                                    <div id="rate-limit-message" class="alert alert-warning" role="alert" style="display: none;">
                                        <i class="bx bx-time me-2" aria-hidden="true"></i>
                                        <span>Demasiados intentos. Por favor esperá un momento antes de enviar nuevamente.</span>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nombre" class="form-label fw-bold">Nombre y Apellido *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete="name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-bold">Email *</label>
                                        <input type="email" class="form-control" id="email" name="email" required autocomplete="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefono" class="form-label fw-bold">Teléfono</label>
                                        <input type="tel" class="form-control" id="telefono" name="telefono" autocomplete="tel">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="empresa" class="form-label fw-bold">Empresa</label>
                                        <input type="text" class="form-control" id="empresa" name="empresa" autocomplete="organization">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="puesto" class="form-label fw-bold">Puesto / Cargo</label>
                                        <input type="text" class="form-control" id="puesto" name="puesto" autocomplete="organization-title">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="asunto" class="form-label fw-bold">Asunto *</label>
                                        <div class="cult-form-select-wrap">
                                            <select class="form-select" id="asunto" name="asunto" required>
                                                <option value="">Seleccionar asunto</option>
                                                <?php foreach ($asunto_options as $value => $label):
                                                    if (is_array($label)) {
                                                        $value = $label['value'] ?? '';
                                                        $label = $label['label'] ?? '';
                                                    }
                                                    $selected = ($asunto_default !== '' && $asunto_default === $value) ? ' selected' : '';
                                                    ?>
                                                    <option value="<?= htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') ?>"<?= $selected ?>>
                                                        <?= htmlspecialchars((string) $label, ENT_QUOTES, 'UTF-8') ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label for="mensaje" class="form-label fw-bold">Mensaje *</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required minlength="10" placeholder="<?= htmlspecialchars($mensaje_ph, ENT_QUOTES, 'UTF-8') ?>"></textarea>
                                </div>

                                <div class="mt-4">
                                    <label class="form-label fw-bold">¿Cómo te enteraste de nosotros?</label>
                                    <div class="cult-form-radio-group">
                                        <label class="cult-form-radio-chip">
                                            <input type="radio" name="como_se_entero" value="REDES SOCIALES">
                                            <span>Redes sociales</span>
                                        </label>
                                        <label class="cult-form-radio-chip">
                                            <input type="radio" name="como_se_entero" value="BOCA EN BOCA">
                                            <span>Boca en boca</span>
                                        </label>
                                        <label class="cult-form-radio-chip">
                                            <input type="radio" name="como_se_entero" value="GOOGLE">
                                            <span>Google</span>
                                        </label>
                                        <label class="cult-form-radio-chip">
                                            <input type="radio" name="como_se_entero" value="EN EL LOCAL">
                                            <span>En el local</span>
                                        </label>
                                        <label class="cult-form-radio-chip">
                                            <input type="radio" name="como_se_entero" value="CLIENTE">
                                            <span>Ya soy cliente</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 cult-btn-shimmer">
                                        <i class="bx bx-send me-2" aria-hidden="true"></i>ENVIAR CONSULTA
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
