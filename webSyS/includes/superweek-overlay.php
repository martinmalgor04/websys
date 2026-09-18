<?php
/**
 * Overlay promocional Tango SuperWeek 2026
 * Uso: include('includes/superweek-overlay.php'); después de includes/script.php
 */
require_once __DIR__ . '/superweek-config.php';
if (!$tswActive) { return; }
$tswVer = @filemtime(__DIR__ . '/../assets/js/superweek-overlay.js') ?: time();
?>
<link rel="stylesheet" href="assets/css/superweek-overlay.css?v=<?= $tswVer ?>">
<div class="tsw-overlay" id="tswOverlay" hidden data-phase="<?= htmlspecialchars($tswPhase) ?>">
    <div class="tsw-overlay__backdrop" data-tsw-close></div>
    <div class="tsw-overlay__dialog" role="dialog" aria-modal="true" aria-labelledby="tswTitle" aria-describedby="tswDesc" tabindex="-1">
        <button type="button" class="tsw-overlay__close" data-tsw-close aria-label="Cerrar promoción">
            <i class="bx bx-x" aria-hidden="true"></i>
        </button>
        <picture class="tsw-overlay__banner">
            <source srcset="<?= $tswBanner ?>.webp" type="image/webp">
            <img src="<?= $tswBanner ?>.jpg" width="1920" height="711" decoding="async"
                 alt="Tango Superweek, del 21 al 25 de septiembre: 50% OFF y 12 cuotas sin interés">
        </picture>
        <div class="tsw-overlay__body">
            <p class="tsw-overlay__eyebrow">Servicios &amp; Sistemas · partner Tango en el NEA</p>
            <h2 id="tswTitle" class="tsw-overlay__title">Tango Superweek</h2>
            <p class="tsw-overlay__dates">Del 21 al 25 de septiembre de 2026</p>
            <p id="tswDesc" class="tsw-overlay__benefit">
                <strong>50% OFF</strong> + <strong>12 cuotas sin interés</strong> en adquisición de sistemas y módulos nuevos de Tango.
            </p>
            <div class="tsw-overlay__actions">
                <a class="btn btn-warning btn-lg fw-bold tsw-overlay__cta"
                   href="<?= htmlspecialchars($tswUrl) ?>" target="_blank" rel="noopener noreferrer">
                    <?= htmlspecialchars($tswCta) ?>
                </a>
                <button type="button" class="tsw-overlay__audio" data-tsw-audio aria-pressed="false" hidden>
                    <i class="bx bx-volume-full" aria-hidden="true"></i><span>Silenciar</span>
                </button>
            </div>
            <p class="tsw-overlay__legal">
                Promoción válida del 21/09/2026 al 25/09/2026. No combinable con otras.
                <a href="<?= htmlspecialchars($tswLegales) ?>" target="_blank" rel="noopener noreferrer">Ver legales</a>.
            </p>
        </div>
        <audio class="tsw-overlay__player" preload="none" src="<?= $tswAudio ?>"></audio>
    </div>
</div>
<script src="assets/js/superweek-overlay.js?v=<?= $tswVer ?>" defer></script>
