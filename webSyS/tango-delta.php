<?php
// Incluir configuración central
require_once('config/config.php');

// Configuración del producto
$product_key = 'delta';
$custom_content = '
<section class="position-relative py-9 py-lg-11">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 text-center mb-9">
                <h2 class="display-4 mb-4" data-aos="fade-up">Inteligencia Artificial que Revoluciona tu Gestión</h2>
                <p class="lead mb-0" data-aos="fade-up" data-aos-delay="150">
                    Tango Delta 5 incorpora tecnología de IA avanzada que aprende de tus datos y procesos empresariales,
                    ofreciendo insights inteligentes y automatización que transforman la manera de gestionar tu negocio.
                </p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                            <i class="bx bx-brain fs-4"></i>
                        </div>
                        <h4 class="mb-3">Asistente IA Empresarial</h4>
                        <p class="mb-0">Tu asistente personal que comprende el contexto de tu negocio, responde consultas complejas y sugiere acciones basadas en patrones de datos históricos y tendencias del mercado.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                            <i class="bx bx-chart fs-4"></i>
                        </div>
                        <h4 class="mb-3">Predicciones Inteligentes</h4>
                        <p class="mb-0">Análisis predictivo que anticipa tendencias de ventas, comportamiento de clientes y necesidades de stock, permitiendo decisiones proactivas y estratégicas.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                            <i class="bx bx-shield-check fs-4"></i>
                        </div>
                        <h4 class="mb-3">Datos Seguros y Privados</h4>
                        <p class="mb-0">Procesamiento local de IA que garantiza que tus datos empresariales nunca salgan de tu infraestructura, cumpliendo con las más altas normas de seguridad y privacidad.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-5">
                        <div class="icon-box bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                            <i class="bx bx-code-alt fs-4"></i>
                        </div>
                        <h4 class="mb-3">API Abierta y Extensible</h4>
                        <p class="mb-0">Arquitectura abierta que permite integraciones personalizadas y desarrollo de extensiones, adaptándose perfectamente a las necesidades específicas de tu empresa.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="position-relative py-9 py-lg-11 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-7 mb-lg-0">
                <h2 class="display-5 mb-4" data-aos="fade-right">Transformación Digital con IA</h2>
                <div class="mb-5" data-aos="fade-right" data-aos-delay="100">
                    <h5 class="fw-bold mb-2"><i class="bx bx-check-circle text-success me-2"></i>Automatización Inteligente</h5>
                    <p class="mb-0 ms-4">Procesos que se optimizan automáticamente basándose en patrones de uso y mejores prácticas detectadas por IA.</p>
                </div>
                <div class="mb-5" data-aos="fade-right" data-aos-delay="200">
                    <h5 class="fw-bold mb-2"><i class="bx bx-check-circle text-success me-2"></i>Insights en Tiempo Real</h5>
                    <p class="mb-0 ms-4">Dashboards inteligentes que destacan información crítica y oportunidades de negocio al instante.</p>
                </div>
                <div class="mb-5" data-aos="fade-right" data-aos-delay="300">
                    <h5 class="fw-bold mb-2"><i class="bx bx-check-circle text-success me-2"></i>Soberanía de Datos</h5>
                    <p class="mb-0 ms-4">Control total sobre tus datos empresariales con procesamiento local que no depende de servicios externos.</p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="assets/img/delta/tangoai.png" alt="Tango IA" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="position-relative py-9 py-lg-11">
    <div class="container">
        <div class="row justify-content-center text-center mb-9">
            <div class="col-xl-8">
                <h2 class="display-4 mb-4" data-aos="fade-up">Funcionalidades Avanzadas</h2>
                <p class="lead mb-0" data-aos="fade-up" data-aos-delay="150">
                    Descubre las capacidades que hacen de Tango Delta 5 la plataforma más avanzada para la gestión empresarial
                </p>
            </div>
        </div>
        <div class="row g-4 mb-9">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center p-4">
                    <div class="icon-box bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="bx bx-conversation fs-2"></i>
                    </div>
                    <h4 class="mb-3">Chat IA Contextual</h4>
                    <p class="mb-0">Conversa con tu sistema como si fuera un experto consultor que conoce cada detalle de tu negocio y puede responder cualquier pregunta sobre tus datos.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center p-4">
                    <div class="icon-box bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="bx bx-trending-up fs-2"></i>
                    </div>
                    <h4 class="mb-3">Análisis Predictivo</h4>
                    <p class="mb-0">Modelos de machine learning que analizan patrones históricos para predecir demanda, optimizar inventarios y anticipar necesidades del negocio.</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center p-4">
                    <div class="icon-box bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="bx bx-customize fs-2"></i>
                    </div>
                    <h4 class="mb-3">Personalización Extrema</h4>
                    <p class="mb-0">Interfaz que se adapta automáticamente a tu flujo de trabajo, priorizando la información más relevante según tu rol y preferencias.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-8 text-center" data-aos="fade-up">
                <div class="bg-primary bg-opacity-10 rounded-4 p-5">
                    <h3 class="mb-4">¿Listo para el Futuro de la Gestión Empresarial?</h3>
                    <p class="lead mb-4">Únete a las empresas que ya están transformando sus procesos con inteligencia artificial integrada.</p>
                    <a href="' . getWhatsAppLink('Hola! Me interesa conocer más sobre Tango Delta 5 y sus funcionalidades de IA') . '" class="btn btn-primary btn-lg rounded-pill px-5">
                        <i class="bx bx-message-rounded-dots me-2"></i>Solicitar Demo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>';

// Incluir template unificado
include('templates/tango-product-template.php');
?>