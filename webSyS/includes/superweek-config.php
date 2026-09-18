<?php
/**
 * Tango SuperWeek 2026 — configuración compartida (slider, preload LCP, overlay)
 * Fases: off | previa (hasta el 20/09) | superweek (21/09 al 25/09)
 */
if (!isset($tswPhase)) {
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $tswPreviaStart = strtotime('2026-09-18 00:00:00'); // publicación de la etapa previa
    $tswStart       = strtotime('2026-09-21 00:00:00');
    $tswEnd         = strtotime('2026-09-25 23:59:59');
    $tswNow         = time();

    $tswPhase = 'off';
    if ($tswNow >= $tswPreviaStart && $tswNow < $tswStart) {
        $tswPhase = 'previa';
    } elseif ($tswNow >= $tswStart && $tswNow <= $tswEnd) {
        $tswPhase = 'superweek';
    }

    $tswActive  = ($tswPhase !== 'off');
    $tswCta     = ($tswPhase === 'superweek') ? 'Aprovechá Superweek' : 'Conseguí tu código';
    $tswUrl     = 'https://www.axoft.com/tango/superweek/?d=SYS2';
    $tswLegales = 'https://www.axoft.com/tango/superweek/legales.php';
    $tswBanner  = 'assets/superweek/banner_web'; // .webp / .jpg (1920x711)
    $tswAudio   = 'assets/superweek/tango_superweek.mp3';
}
