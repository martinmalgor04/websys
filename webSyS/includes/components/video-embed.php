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