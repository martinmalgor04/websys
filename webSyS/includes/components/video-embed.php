<?php
/**
 * Componente: Video Embed
 * Videos embebidos responsivos (YouTube, Vimeo, etc.)
 * Reutiliza Bootstrap 5 ratio classes (ya disponibles)
 * Sin dependencias nuevas
 */

/**
 * Renderizar video embebido de YouTube
 * @param string $videoId ID del video de YouTube (ej: "mgRFUxznwHs")
 * @param string $title Título del video para SEO y accesibilidad
 * @param string $bgColor Clase de background (default: "bg-secondary")
 * @param string $aspectRatio Ratio del video (default: "ratio-16x9")
 * @return void
 */
function renderYouTubeEmbed($videoId, $title, $bgColor = "bg-secondary", $aspectRatio = "ratio-16x9") {
    ?>
    <section class="position-relative <?= $bgColor ?>">
        <div class="container position-relative py-9">
            <div class="row">
                <div class="col col-lg-10 col-xl-8 mx-lg-auto">
                    <h3 class="mb-4 text-white"><?= htmlspecialchars($title) ?></h3>
                    <div class="row">
                        <div class="ratio <?= $aspectRatio ?>">
                            <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($videoId) ?>" 
                                    title="<?= htmlspecialchars($title) ?>" 
                                    allowfullscreen
                                    loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar video embebido de Vimeo
 * @param string $videoId ID del video de Vimeo
 * @param string $title Título del video
 * @param string $bgColor Clase de background (default: "bg-secondary")
 * @param string $aspectRatio Ratio del video (default: "ratio-16x9")
 * @return void
 */
function renderVimeoEmbed($videoId, $title, $bgColor = "bg-secondary", $aspectRatio = "ratio-16x9") {
    ?>
    <section class="position-relative <?= $bgColor ?>">
        <div class="container position-relative py-9">
            <div class="row">
                <div class="col col-lg-10 col-xl-8 mx-lg-auto">
                    <h3 class="mb-4 text-white"><?= htmlspecialchars($title) ?></h3>
                    <div class="row">
                        <div class="ratio <?= $aspectRatio ?>">
                            <iframe src="https://player.vimeo.com/video/<?= htmlspecialchars($videoId) ?>" 
                                    title="<?= htmlspecialchars($title) ?>" 
                                    allowfullscreen
                                    loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar video embebido genérico con URL personalizada
 * @param string $embedUrl URL completa del embed
 * @param string $title Título del video
 * @param string $bgColor Clase de background (default: "bg-secondary")
 * @param string $aspectRatio Ratio del video (default: "ratio-16x9")
 * @param array $containerClasses Clases adicionales para el contenedor
 * @return void
 */
function renderVideoEmbed($embedUrl, $title, $bgColor = "bg-secondary", $aspectRatio = "ratio-16x9", $containerClasses = []) {
    $containerClassString = implode(' ', $containerClasses);
    ?>
    <section class="position-relative <?= $bgColor ?> <?= $containerClassString ?>">
        <div class="container position-relative py-9">
            <div class="row">
                <div class="col col-lg-10 col-xl-8 mx-lg-auto">
                    <?php if ($title): ?>
                    <h3 class="mb-4 text-white"><?= htmlspecialchars($title) ?></h3>
                    <?php endif; ?>
                    <div class="row">
                        <div class="ratio <?= $aspectRatio ?>">
                            <iframe src="<?= htmlspecialchars($embedUrl) ?>" 
                                    title="<?= htmlspecialchars($title) ?>" 
                                    allowfullscreen
                                    loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar video específico de Tango Gestión (reutiliza video existente)
 * @return void
 */
function renderTangoGestionVideo() {
    renderYouTubeEmbed(
        'mgRFUxznwHs',
        'Tango gestión Integrado - Tango Software'
    );
}

/**
 * Renderizar video YouTube con estilo cult-* y lazy-loading por click.
 * Carga el iframe sólo al primer click, mejorando LCP y bandwidth inicial.
 *
 * @param array $opts {
 *   @type string $video_id   ID del video de YouTube.
 *   @type string $title      Título visible y para iframe.
 *   @type string $eyebrow    Texto eyebrow opcional.
 *   @type string $subtitle   Lead opcional bajo el título.
 *   @type string $bg         Clase de background (default: bg-body).
 *   @type string $poster     URL del poster (default: hqdefault de YouTube).
 * }
 * @return void
 */
function renderCultYouTubeEmbed(array $opts) {
    $video_id = $opts['video_id'] ?? '';
    if (!$video_id) return;
    $title    = $opts['title']    ?? 'Video demostrativo';
    $eyebrow  = $opts['eyebrow']  ?? '';
    $subtitle = $opts['subtitle'] ?? '';
    $bg       = $opts['bg']       ?? 'bg-body';
    $poster   = $opts['poster']   ?? 'https://i.ytimg.com/vi/' . rawurlencode($video_id) . '/hqdefault.jpg';
    $safe_id  = htmlspecialchars($video_id, ENT_QUOTES, 'UTF-8');
    $safe_t   = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $uid      = 'cultVid' . substr(md5($video_id . microtime(true)), 0, 8);
    ?>
    <section class="position-relative overflow-hidden <?= htmlspecialchars($bg) ?>">
        <div class="container position-relative py-9 py-lg-11">
            <?php if ($eyebrow || $title || $subtitle): ?>
            <div class="row justify-content-center mb-5 mb-lg-7">
                <div class="col-lg-9 text-center">
                    <?php if ($eyebrow): ?>
                    <span class="cult-section-eyebrow" data-aos="fade-up"><?= htmlspecialchars($eyebrow) ?></span>
                    <?php endif; ?>
                    <?php if ($title): ?>
                    <h2 class="cult-display cult-display--xl mb-3" data-aos="fade-up" data-aos-delay="50"><?= htmlspecialchars($title) ?></h2>
                    <?php endif; ?>
                    <?php if ($subtitle): ?>
                    <p class="lead text-muted mx-auto" style="max-width: 42rem;" data-aos="fade-up" data-aos-delay="100"><?= htmlspecialchars($subtitle) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="150">
                    <div id="<?= $uid ?>" class="cult-video ratio ratio-16x9 rounded-4 overflow-hidden shadow-lg position-relative"
                         data-video-id="<?= $safe_id ?>"
                         role="button"
                         tabindex="0"
                         aria-label="Reproducir video: <?= $safe_t ?>">
                        <img src="<?= htmlspecialchars($poster) ?>"
                             alt="<?= $safe_t ?>"
                             class="cult-video__poster w-100 h-100"
                             loading="lazy"
                             decoding="async"
                             style="object-fit: cover;">
                        <span class="cult-video__play" aria-hidden="true">
                            <i class="bx bx-play"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    (function(){
        var el = document.getElementById('<?= $uid ?>');
        if (!el) return;
        var loaded = false;
        var loadVideo = function(){
            if (loaded) return;
            loaded = true;
            var vid = el.getAttribute('data-video-id');
            var iframe = document.createElement('iframe');
            iframe.setAttribute('src', 'https://www.youtube.com/embed/' + vid + '?autoplay=1&rel=0');
            iframe.setAttribute('title', '<?= addslashes($safe_t) ?>');
            iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture');
            iframe.setAttribute('allowfullscreen', '');
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = '0';
            el.innerHTML = '';
            el.appendChild(iframe);
        };
        el.addEventListener('click', loadVideo);
        el.addEventListener('keydown', function(e){
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); loadVideo(); }
        });
    })();
    </script>
    <?php
}

/**
 * Renderizar múltiples videos en una sección
 * @param array $videos Array de videos con estructura: ['id', 'title', 'type' => 'youtube'|'vimeo']
 * @param string $sectionTitle Título de la sección
 * @param string $bgColor Background de la sección
 * @return void
 */
function renderVideoGallery($videos, $sectionTitle = "", $bgColor = "bg-secondary") {
    ?>
    <section class="position-relative <?= $bgColor ?>">
        <div class="container position-relative py-9 py-lg-11">
            <?php if ($sectionTitle): ?>
            <div class="row justify-content-center mb-7">
                <div class="col-lg-8 text-center">
                    <h2 class="display-5 mb-4 text-white" data-aos="fade-up"><?= htmlspecialchars($sectionTitle) ?></h2>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="row">
                <?php foreach ($videos as $index => $video): ?>
                <div class="col-lg-6 mb-5" data-aos="fade-up" data-aos-delay="<?= ($index * 100) ?>">
                    <div class="ratio ratio-16x9">
                        <?php
                        $embedUrl = '';
                        if ($video['type'] === 'youtube') {
                            $embedUrl = "https://www.youtube.com/embed/" . htmlspecialchars($video['id']);
                        } elseif ($video['type'] === 'vimeo') {
                            $embedUrl = "https://player.vimeo.com/video/" . htmlspecialchars($video['id']);
                        }
                        ?>
                        <iframe src="<?= $embedUrl ?>" 
                                title="<?= htmlspecialchars($video['title']) ?>" 
                                allowfullscreen
                                loading="lazy"></iframe>
                    </div>
                    <?php if (isset($video['description'])): ?>
                    <p class="text-white mt-3"><?= htmlspecialchars($video['description']) ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
}
?>