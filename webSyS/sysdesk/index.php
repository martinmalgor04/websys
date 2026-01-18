<?php
/**
 * SysDesk - Página de descarga del sistema de soporte remoto
 * Esta página no está enlazada desde el sitio principal
 * Dominio: sysdesk.serviciosysistemas.com.ar
 */

// Detectar si se accede vía subdominio o directamente
$is_subdomain = (strpos($_SERVER['HTTP_HOST'] ?? '', 'sysdesk.') === 0);

// URLs base para assets
$main_site_url = 'https://serviciosysistemas.com.ar';
$main_assets = $is_subdomain ? $main_site_url . '/assets/' : '../assets/';

// Incluir configuración
$config_path = $is_subdomain ? dirname(__DIR__) . '/' : '../';
require_once($config_path . 'config/config.php');
require_once($config_path . 'includes/functions.php');

// Configuración de la página
$page_title = 'SysDesk - Sistema de Soporte Remoto';
$meta_description = 'Descargá SysDesk, nuestra herramienta de soporte remoto para asistencia técnica rápida y segura.';
$meta_keywords = 'sysdesk, soporte remoto, asistencia técnica, servicios y sistemas';
$body_id = 'sysdesk';
$canonical_url = 'https://sysdesk.serviciosysistemas.com.ar';

// No indexar esta página
header('X-Robots-Tag: noindex, nofollow');
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO Meta Tags -->
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="assets/img/SYSDESK.png">
    
    <!-- Favicon -->
    <link rel="icon" href="assets/img/SYSDESK_Mesa de trabajo 1 copia 5.png" type="image/png">
    
    <!-- Box Icons -->
    <link rel="stylesheet" href="<?= $main_assets ?>fonts/boxicons/css/boxicons.min.css">
    
    <!-- AOS Animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Main CSS del sitio -->
    <link href="<?= $main_assets ?>css/sys_style.css" rel="stylesheet">
    <link href="<?= $main_assets ?>css/modules/dark-mode.css" rel="stylesheet">
    
    <!-- Estilos específicos de SysDesk -->
    <style>
        .sysdesk-hero {
            min-height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            padding: 80px 0 100px;
        }
        
        .sysdesk-logo {
            max-width: 320px;
            height: auto;
            filter: drop-shadow(0 0 40px rgba(255, 255, 255, 0.2));
        }
        
        @media (max-width: 768px) {
            .sysdesk-logo {
                max-width: 240px;
            }
        }
        
        .download-card {
            background: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            transition: all 0.3s ease;
        }
        
        .download-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>
    
    <!-- Script para tema -->
    <script>
        (function() {
            'use strict';
            const getSystemTheme = () => {
                return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            };
            const theme = getSystemTheme();
            document.documentElement.setAttribute('data-bs-theme', theme);
            document.documentElement.style.colorScheme = theme;
            if (theme === 'dark') {
                document.documentElement.classList.add('dark-mode');
            } else {
                document.documentElement.classList.add('light-mode');
            }
        })();
    </script>
</head>
<body id="<?= $body_id ?>">
    
    <!-- Preloader Spinner -->
    <div class="spinner-loader bg-primary text-white">
        <div class="spinner-grow" role="status"></div>
        <span class="small d-block ms-2">Cargando...</span>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        
        <!-- Hero Section -->
        <section class="sysdesk-hero bg-primary position-relative">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center" data-aos="fade-up">
                        <img src="assets/img/sysdeskw.png" alt="SysDesk" class="sysdesk-logo mb-4">
                        <p class="lead text-white mb-5" style="font-size: 1.25rem;">
                            Soporte remoto rápido y seguro para tu empresa.<br>
                            Conectate con nuestro equipo técnico en segundos.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mb-4">
                            <a href="assets/downloads/sysdesk.exe" class="btn btn-white btn-lg rounded-pill px-5 py-3 hover-lift" download>
                                <i class="bx bx-download me-2"></i>Descargar SysDesk
                            </a>
                            <a href="#como-usar" class="btn btn-outline-white btn-lg rounded-pill px-5 py-3">
                                <i class="bx bx-info-circle me-2"></i>Cómo Usar
                            </a>
                        </div>
                        <div class="text-white-50 small">
                            <span class="me-3"><i class="bx bxl-windows me-1"></i> Windows</span>
                            <span class="me-3"><i class="bx bx-download me-1"></i> Fácil instalación</span>
                            <span><i class="bx bx-check-circle me-1"></i> Soporte seguro</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="position-absolute bottom-0 start-0 end-0">
                <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="width:100%;height:50px;">
                    <path d="M0 60L60 55C120 50 240 40 360 35C480 30 600 30 720 32C840 35 960 40 1080 42C1200 45 1320 45 1380 45L1440 45V60H0Z" fill="var(--bs-body-bg)"/>
                </svg>
            </div>
        </section>

        <!-- Cómo usar Section -->
        <section id="como-usar" class="position-relative bg-body">
            <div class="container position-relative py-9 py-lg-11">
                <div class="row justify-content-center mb-7">
                    <div class="col-lg-8 text-center">
                        <h2 class="display-5 mb-3" data-aos="fade-up">¿Cómo funciona?</h2>
                        <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                            Conectate con nuestro soporte técnico en cuatro simples pasos
                        </p>
                    </div>
                </div>
                
                <div class="row justify-content-center g-4">
                    <!-- Paso 1 -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="download-card card card-body h-100 text-center p-4 rounded-4">
                            <div class="step-number bg-primary text-white rounded-3 mx-auto mb-4">1</div>
                            <h4 class="mb-3">Descargá el programa</h4>
                            <p class="text-muted mb-0">
                                Hacé clic en el botón de descarga para obtener SysDesk.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Paso 2 -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="download-card card card-body h-100 text-center p-4 rounded-4">
                            <div class="step-number bg-primary text-white rounded-3 mx-auto mb-4">2</div>
                            <h4 class="mb-3">Instalá SysDesk</h4>
                            <p class="text-muted mb-0">
                                Ejecutá el instalador y seguí los pasos. <strong>Es necesario instalar para recibir soporte.</strong>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Paso 3 -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="download-card card card-body h-100 text-center p-4 rounded-4">
                            <div class="step-number bg-primary text-white rounded-3 mx-auto mb-4">3</div>
                            <h4 class="mb-3">Abrí SysDesk</h4>
                            <p class="text-muted mb-0">
                                Una vez instalado, abrí el programa desde el escritorio o menú inicio.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Paso 4 -->
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="download-card card card-body h-100 text-center p-4 rounded-4">
                            <div class="step-number bg-primary text-white rounded-3 mx-auto mb-4">4</div>
                            <h4 class="mb-3">Compartí tu código</h4>
                            <p class="text-muted mb-0">
                                Se mostrará un código en pantalla. Pasáselo a nuestro técnico.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="position-relative bg-gradient-light">
            <div class="container position-relative py-9 py-lg-11">
                <div class="row justify-content-center g-4">
                    <!-- Feature 1 -->
                    <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-3 mx-auto mb-3">
                                <i class="bx bx-lock-alt"></i>
                            </div>
                            <h6 class="mb-2">Conexión segura</h6>
                            <p class="text-muted small mb-0">Encriptación de extremo a extremo</p>
                        </div>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-3 mx-auto mb-3">
                                <i class="bx bx-timer"></i>
                            </div>
                            <h6 class="mb-2">Rápido</h6>
                            <p class="text-muted small mb-0">Conexión instantánea sin esperas</p>
                        </div>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-center">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-3 mx-auto mb-3">
                                <i class="bx bx-check-shield"></i>
                            </div>
                            <h6 class="mb-2">Fácil de usar</h6>
                            <p class="text-muted small mb-0">Instalación simple y rápida</p>
                        </div>
                    </div>
                    
                    <!-- Feature 4 -->
                    <div class="col-lg-3 col-md-6 col-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="text-center">
                            <div class="feature-icon bg-primary bg-opacity-10 text-primary rounded-3 mx-auto mb-3">
                                <i class="bx bx-support"></i>
                            </div>
                            <h6 class="mb-2">Soporte experto</h6>
                            <p class="text-muted small mb-0">Equipo técnico certificado</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Final -->
        <section class="position-relative bg-body">
            <div class="container position-relative py-9 py-lg-11">
                <div class="row justify-content-center mb-6">
                    <div class="col-12 text-center" data-aos="fade-up">
                        <h4 class="mb-5 text-muted uppercase tracking-wider small">Empresas que confían en nuestro soporte</h4>
                        <div class="d-flex flex-wrap justify-content-center align-items-center gap-5 opacity-50">
                            <img src="<?= $main_assets ?>img/partners/clients/sanatoriodelnorte.jpeg" alt="Sanatorio del Norte" style="height: 40px; filter: grayscale(100%);">
                            <img src="<?= $main_assets ?>img/partners/clients/playadito.webp" alt="Playadito" style="height: 40px; filter: grayscale(100%);">
                            <img src="<?= $main_assets ?>img/partners/clients/bancoctes.webp" alt="Banco de Corrientes" style="height: 40px; filter: grayscale(100%);">
                            <img src="<?= $main_assets ?>img/partners/clients/shonko-sa_li1.webp" alt="Shonko" style="height: 40px; filter: grayscale(100%);">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center pt-5">
                    <div class="col-lg-8 text-center" data-aos="fade-up">
                        <h3 class="display-6 mb-4">¿Listo para recibir soporte?</h3>
                        <p class="lead text-muted mb-5">
                            Descargá SysDesk ahora y conectate con nuestro equipo técnico en segundos.
                        </p>
                        <a href="assets/downloads/SysDesk.exe" class="btn btn-primary btn-lg rounded-pill px-5 py-3 hover-lift" download>
                            <i class="bx bx-download me-2"></i>Descargar SysDesk
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer Simple -->
    <footer class="bg-body footer position-relative border-top">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <img src="assets/img/sysdes.png" alt="SysDesk" style="height:40px;" class="mb-2">
                    <p class="text-muted small mb-0">
                        Una herramienta de <a href="https://serviciosysistemas.com.ar" target="_blank">Servicios y Sistemas</a>
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-1">
                        <i class="bx bx-phone me-1"></i>
                        <a href="tel:+543794260022">+54 379 426-0022</a>
                    </p>
                    <p class="text-muted small mb-0">
                        &copy; <?= date('Y') ?> Servicios y Sistemas SRL
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <a href="#" class="toTop"><i class="bx bxs-up-arrow"></i></a>

    <!-- Scripts -->
    <script src="<?= $main_assets ?>js/sys.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Dark/Light Mode automático
        (function() {
            'use strict';
            const setTheme = theme => {
                const root = document.documentElement;
                root.setAttribute('data-bs-theme', theme);
                root.style.colorScheme = theme;
                root.classList.remove('dark-mode', 'light-mode');
                root.classList.add(theme + '-mode');
            };
            
            const getSystemTheme = () => {
                return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            };
            
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const systemTheme = getSystemTheme();
            
            if (!currentTheme || currentTheme !== systemTheme) {
                setTheme(systemTheme);
            }
            
            if (window.matchMedia) {
                const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                const handleThemeChange = (e) => setTheme(e.matches ? 'dark' : 'light');
                if (mediaQuery.addEventListener) {
                    mediaQuery.addEventListener('change', handleThemeChange);
                }
            }
        })();
        
        // Ocultar spinner
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.body.classList.add('loaded');
            }, 100);
        });
        
        // Inicializar AOS
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>
