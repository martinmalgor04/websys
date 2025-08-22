
		<!--  Back to Top button -->
        <a href="#" class="toTop"><i class="bx bxs-up-arrow"></i></a>
        <!-- Scripts principales -->
        <script src="assets/js/sys.bundle.min.js"></script>
        <script src="assets/js/sys-forms.js"></script>
        
		<!-- Swiper Slider - CDN -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        
		<!-- AOS Animations - CDN -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            var swiperClassic = new Swiper(".swiper-classic", {
                slidesPerView: 1, spaceBetween: 0,
                loop: true, autoplay: { delay: 3500 },
                effect: "creative",
                creativeEffect: {
                    prev: {
                        shadow: true,
                        translate: ["-20%", 0, -1],
                    },
                    next: {
                        translate: ["100%", 0, 0],
                    },
                },
                pagination: {
                    el: ".swiperClassic-pagination",
                    clickable:true
                },
                navigation: { nextEl: ".swiperClassic-button-next", prevEl: ".swiperClassic-button-prev" }
            });
			//swiper -partners
            var swiperPartners5 = new Swiper(".swiper-partners", {
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
					

					
					// Forzar repaint para algunos elementos
					const elements = document.querySelectorAll('.partners-light, .partners-dark, .logo-light, .logo-dark');
					elements.forEach(el => {
						el.style.display = 'none';
						el.offsetHeight; // Trigger reflow
						el.style.display = '';
					});
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
			
			//Timeline progressbar 
            var sliderThumbs = new Swiper('.progress-swiper-thumbs', {
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
                        swiper.el.querySelectorAll('.swiper-pagination-progress-inner')
                            .forEach($progress => $progress.style.transitionDuration =
                                `${swiper.params.autoplay.delay}ms`)
                    }
                }
            });

             
            var swiperThumbsMain = new Swiper(".swiper-reportes", {
                spaceBetween: 16,
                loop:true,
				autoplay: true,
                autoHeight:true,
                pagination: {
                    el: ".swiper-reportes-pagination",
                    clickable: true
                },
                navigation: {
                    nextEl: ".swiper-partners-button-next",
                    prevEl: ".swiper-partners-button-prev"
                }
            });

        </script>