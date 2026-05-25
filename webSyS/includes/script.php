
		<!--  Back to Top button -->
        <a href="#" class="toTop"><i class="bx bxs-up-arrow"></i></a>
        <!-- Scripts principales -->
        <script src="assets/js/sys.bundle.min.js" defer></script>
        <script src="assets/js/sys-forms.js" defer></script>
        <?php $cultJsVer = file_exists(__DIR__ . '/../assets/js/cult.js') ? @filemtime(__DIR__ . '/../assets/js/cult.js') : time(); ?>
        <script src="assets/js/cult.js?v=<?= $cultJsVer ?>" defer></script>
        
		<!-- Swiper Slider - CDN -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        
		<!-- AOS Animations - CDN -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            const hasElement = (selector) => document.querySelector(selector) !== null;
            const isMobile = window.matchMedia && window.matchMedia('(max-width: 767px)').matches;

            const initSwiperClassic = () => {
                if (!hasElement('.swiper-classic') || typeof Swiper === 'undefined') return;

                const classicOptions = {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: !isMobile,
                    autoplay: { delay: isMobile ? 5000 : 3500, disableOnInteraction: false },
                    speed: isMobile ? 450 : 700,
                    pagination: {
                        el: ".swiperClassic-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: ".swiperClassic-button-next",
                        prevEl: ".swiperClassic-button-prev"
                    }
                };

                if (!isMobile) {
                    classicOptions.effect = "creative";
                    classicOptions.creativeEffect = {
                        prev: {
                            shadow: true,
                            translate: ["-20%", 0, -1],
                        },
                        next: {
                            translate: ["100%", 0, 0],
                        },
                    };
                }

                new Swiper(".swiper-classic", classicOptions);
            };

            const initSwiperPartners = () => {
                if (!hasElement('.swiper-partners') || typeof Swiper === 'undefined') return;
                new Swiper(".swiper-partners", {
                    slidesPerView: 2,
                    loop: true,
                    spaceBetween: 16,
                    autoplay: true,
                    breakpoints: {
                        768: {
                            slidesPerView: 4
                        },
                        1024: {
                            slidesPerView: 5
                        }
                    },
                    pagination: {
                        el: ".swiper-partners-pagination",
                        clickable: true
                    },
                    navigation: {
                        nextEl: ".swiper-partners-button-next",
                        prevEl: ".swiper-partners-button-prev"
                    }
                });
            };
			
			// Sistema Automático de Dark/Light Mode por Sistema Operativo
			(function() {
				'use strict';
				
				// Aplicar el tema al documento
				const setTheme = theme => {
					const root = document.documentElement;
					root.setAttribute('data-bs-theme', theme);
					root.style.colorScheme = theme;
					
					// Actualizar clases auxiliares
					root.classList.remove('dark-mode', 'light-mode');
					root.classList.add(theme + '-mode');
					

					
				};
				
				// Obtener el tema preferido del sistema
				const getSystemTheme = () => {
					return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
				};
				
				// Aplicar el tema inicial según el sistema (solo si no está ya aplicado)
				const currentTheme = document.documentElement.getAttribute('data-bs-theme');
				const systemTheme = getSystemTheme();
				
				if (!currentTheme || currentTheme !== systemTheme) {
					setTheme(systemTheme);
				}
				
				// Escuchar cambios en la preferencia del sistema y aplicarlos automáticamente
				if (window.matchMedia) {
					const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
					
					// Función de callback para cambios
					const handleThemeChange = (e) => {
						setTheme(e.matches ? 'dark' : 'light');
					};
					
					// Usar addListener como fallback para navegadores antiguos
					if (mediaQuery.addEventListener) {
						mediaQuery.addEventListener('change', handleThemeChange);
					} else if (mediaQuery.addListener) {
						mediaQuery.addListener(handleThemeChange);
					}
				}
			})();
			
			// Timeline progressbar + reportes
            const initReportesSwipers = () => {
                if (typeof Swiper === 'undefined') return;

                if (hasElement('.progress-swiper-thumbs')) {
                    new Swiper('.progress-swiper-thumbs', {
                        watchSlidesVisibility: true,
                        watchSlidesProgress: true,
                        history: false,
                        breakpoints: {
                            480: {
                                slidesPerView: 2,
                                spaceBetween: 16,
                            },
                            768: {
                                slidesPerView: 3,
                                spaceBetween: 16,
                            },
                            1024: {
                                slidesPerView: 3,
                                spaceBetween: 16,
                            },
                        },
                        on: {
                            'afterInit': function (swiper) {
                                if (!swiper.el) return;
                                swiper.el.querySelectorAll('.swiper-pagination-progress-inner')
                                    .forEach($progress => $progress.style.transitionDuration =
                                        `${swiper.params.autoplay.delay}ms`);
                            }
                        }
                    });
                }

                if (hasElement('.swiper-reportes')) {
                    new Swiper(".swiper-reportes", {
                        spaceBetween: 16,
                        loop: true,
                        autoplay: true,
                        autoHeight: true,
                        pagination: {
                            el: ".swiper-reportes-pagination",
                            clickable: true
                        },
                        navigation: {
                            nextEl: ".swiper-partners-button-next",
                            prevEl: ".swiper-partners-button-prev"
                        }
                    });
                }
            };

            initSwiperClassic();
            initSwiperPartners();
            if ('requestIdleCallback' in window) {
                requestIdleCallback(initReportesSwipers, { timeout: 2000 });
            } else {
                setTimeout(initReportesSwipers, 600);
            }

        </script>
        
        <!-- Script para ocultar el spinner de carga -->
        <script>
            // Asegurar estado "loaded" sin retrasos
            document.addEventListener('DOMContentLoaded', function() {
                document.body.classList.add('loaded');
                if (window.AOS) {
                    AOS.init({
                        duration: 800,
                        once: true,
                        easing: 'ease-out-cubic'
                    });
                }
            });
        </script>