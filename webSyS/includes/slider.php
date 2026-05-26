<?php
$tswStart   = strtotime('2026-05-12 08:00:00');
$tswEnd     = strtotime('2026-05-22 23:59:59');
$tswInDates = (time() >= $tswStart && time() <= $tswEnd);
$tswActive  = $tswInDates;
?>
<style>
/* Override height: 711px = alto exacto del banner superweek */
.swiper-classic {
    height: 500px;
}
@media (min-width: 992px) {
    .swiper-classic {
        height: 711px;
    }
}
/* SuperWeek: fondo oscuro para camuflar las franjas de contain */
.swiper-classic .swiper-slide--superweek {
    background-color: #0a1430;
}
.swiper-classic .swiper-slide--superweek .hero-slide-bg {
    object-fit: contain;
}
</style>
<!--Hero-->
<section class="position-relative bg-dark overflow-hidden">
                <!-- Cult overlay decorativo (no interfiere con el Swiper) -->
                <div class="cult-hero-overlay" aria-hidden="true"></div>

                <!-- Swiper slider -->
                <div class="swiper-container swiper-classic">
                    <!-- Swiper wrapper -->
                    <div class="swiper-wrapper">
                        <?php if ($tswActive): ?>
                        <!-- Slide SuperWeek 2026 -->
                        <div class="swiper-slide swiper-slide--superweek">
                            <a href="https://www.axoft.com/tango/superweek/?d=SYS2"
                               target="_blank" rel="noopener noreferrer"
                               class="d-block w-100 h-100 position-relative text-decoration-none"
                               aria-label="Tango SuperWeek 2026 - 50% OFF + 12 cuotas sin interés">
                                <picture>
                                    <source srcset="assets/img/slider/superweek.webp" type="image/webp">
                                    <img
                                        src="assets/img/slider/superweek.jpg"
                                        alt=""
                                        class="hero-slide-bg"
                                        width="1920"
                                        height="711"
                                        fetchpriority="high"
                                        loading="eager"
                                        decoding="async"
                                    >
                                </picture>
                                <div class="container-fluid text-white d-flex align-items-end justify-content-center h-100 position-relative pb-5 pb-lg-7">
                                    <ul class="carousel-layers list-unstyled mb-0 text-center">
                                        <li data-carousel-layer="fade-start">
                                            <span class="btn btn-warning btn-lg fw-bold px-5 shadow">
                                                Conseguí tu código
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <!-- slide item -->
                        <div class="swiper-slide">
                            <picture>
                                <source srcset="assets/img/slider/1.webp" type="image/webp">
                                <img
                                    src="assets/img/slider/1.jpg"
                                    alt=""
                                    class="hero-slide-bg"
                                    width="1920"
                                    height="1000"
                                    fetchpriority="high"
                                    loading="eager"
                                    decoding="async"
                                >
                            </picture>
                            <div class="bg-dark position-absolute start-0 top-0 w-100 h-100 opacity-75"></div>
                            <div class="container-fluid text-white d-flex align-items-center h-100" style="position:relative; z-index:2;">
                                <div class="row pt-11 w-100">
                                    <div class="col-xl-8 col-lg-10 mx-auto text-center">
                                        <ul class="carousel-layers list-unstyled mb-0">
                                            <li data-carousel-layer="fade-end">
                                                <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex">
                                                    <i class="bx bx-cloud" aria-hidden="true"></i>
                                                    SOLUCIONES CLOUD
                                                </span>
                                            </li>
											<li data-carousel-layer="fade-start">
                                                <h2 class="cult-display cult-display--hero mb-4">
                                                    A LA <span class="cult-shimmer-text--bright">MEDIDA</span><br>DE TU NEGOCIO
                                                </h2>
                                            </li>
                                            <li data-carousel-layer="fade-end">
                                                <p class="lead mb-4 mb-lg-5 mx-auto" style="max-width: 38rem; opacity: 0.88;">
                                                    Hospeda tu servidor de manera segura y escalable, con soporte 24/7 y tecnología de vanguardia
                                                </p>
                                            </li>
                                            <li data-carousel-layer="fade-start">
                                                <a href="datacenter.php" class="btn cult-btn-glass btn-lg cult-btn-shimmer">
                                                    Conocé nuestro Datacenter
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Slide 2 - Tango Delta 5-->
                        <div class="swiper-slide">
                            <picture>
                                <source srcset="assets/img/slider/2.webp" type="image/webp">
                                <img
                                    src="assets/img/slider/2.png"
                                    alt=""
                                    class="hero-slide-bg"
                                    width="1920"
                                    height="1000"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </picture>
                            <div class="bg-dark position-absolute start-0 top-0 w-100 h-100 opacity-75"></div>
                            <div class="container-fluid text-white d-flex align-items-center h-100" style="position:relative; z-index:2;">
                                <div class="row pt-5 w-100">
                                    <div class="col-xl-8 col-lg-10 mx-auto text-center">
                                        <ul class="carousel-layers list-unstyled mb-0">
                                            <li data-carousel-layer="fade-end">
                                                <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex">
                                                    <i class="bx bx-chip" aria-hidden="true"></i>
                                                    NUEVA VERSIÓN · IA INTEGRADA
                                                </span>
                                            </li>
                                            <li data-carousel-layer="fade-start">
                                                <h2 class="cult-display cult-display--hero mb-4">
                                                    TANGO <span class="cult-shimmer-text--bright">DELTA 5</span><br>EVOLUCIONÁ CON IA
                                                </h2>
                                            </li>
                                            <li data-carousel-layer="fade-end">
                                                <p class="lead mb-4 mb-lg-5 mx-auto" style="max-width: 38rem; opacity: 0.88;">
                                                    Analizá datos en lenguaje natural, automatizá tareas y transformá tu gestión con inteligencia artificial integrada
                                                </p>
                                            </li>
                                            <li data-carousel-layer="fade-start">
                                                <a href="tango-delta.php" class="btn cult-btn-glass btn-lg cult-btn-shimmer">
                                                    Descubrí Tango Delta 5
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Slide 3-->
                        <div class="swiper-slide">
                            <picture>
                                <source srcset="assets/img/slider/3.webp" type="image/webp">
                                <img
                                    src="assets/img/slider/3.jpg"
                                    alt=""
                                    class="hero-slide-bg"
                                    width="1920"
                                    height="1000"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </picture>
                            <div class="bg-dark position-absolute start-0 top-0 w-100 h-100 opacity-75"></div>
                            <div class="container-fluid text-white d-flex align-items-center h-100" style="position:relative; z-index:2;">
                                <div class="row pt-5 w-100">
                                    <div class="col-xl-8 col-lg-10 mx-auto text-center">
                                        <ul class="carousel-layers list-unstyled mb-0">
                                            <li data-carousel-layer="fade-end">
                                                <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex">
                                                    <i class="bx bx-server" aria-hidden="true"></i>
                                                    GESTIÓN IT
                                                </span>
                                            </li>
                                            <li data-carousel-layer="fade-start">
                                                <h2 class="cult-display cult-display--hero mb-4">
                                                    GESTIÓN <span class="cult-shimmer-text--bright">INTEGRAL</span><br>DE TU INFORMÁTICA
                                                </h2>
                                            </li>
                                            <li data-carousel-layer="fade-end">
                                                <p class="lead mb-4 mb-lg-5 mx-auto" style="max-width: 38rem; opacity: 0.88;">
                                                    Deja en nuestras manos la administración y soporte de toda tu infraestructura IT
                                                </p>
                                            </li>
                                            <li data-carousel-layer="fade-start">
                                                <a href="gestion-it.php" class="btn cult-btn-glass btn-lg cult-btn-shimmer">
                                                    Conocé nuestra Gestión IT
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slider pagination -->
                    <div class="swiper-pagination swiperClassic-pagination text-white"></div>
                    <!-- Slider Arrow -->
                    <div class="swiper-button-prev swiperClassic-button-prev bg-transparent width-5x height-5x text-white">
                    </div>
                    <!-- Slider Arrow -->
                    <div class="swiper-button-next swiperClassic-button-next bg-transparent width-5x height-5x text-white">
                    </div>
                </div>
            </section>
            <!--/.Slider end-->
