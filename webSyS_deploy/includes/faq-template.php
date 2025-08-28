<?php
/*
 * Template reutilizable para secciones FAQ
 * Uso: include('includes/faq-template.php');
 * 
 * Para personalizar:
 * 1. Define $faq_title antes de incluir (opcional)
 * 2. Define $faq_subtitle antes de incluir (opcional)  
 * 3. Define $faq_items como array antes de incluir
 */

// Valores por defecto
if (!isset($faq_title)) {
    $faq_title = "PREGUNTAS FRECUENTES";
}

if (!isset($faq_subtitle)) {
    $faq_subtitle = "Resolvemos las dudas más comunes sobre este producto";
}

// Generar ID único para el accordion
$accordion_id = 'faqAccordion' . uniqid();
?>

<!--begin: FAQ Section -->
<section class="position-relative bg-gradient-light overflow-hidden">
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center mb-9">
            <div class="col-lg-8 text-center">
                <h2 class="display-4 mb-4" data-aos="fade-up"><?= htmlspecialchars($faq_title) ?></h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                    <?= htmlspecialchars($faq_subtitle) ?>
                </p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="<?= $accordion_id ?>" data-aos="fade-up" data-aos-delay="150">
                    
                    <?php if (isset($faq_items) && is_array($faq_items)): ?>
                        <?php foreach ($faq_items as $index => $faq): ?>
                            <?php 
                            $item_id = $accordion_id . '_item' . ($index + 1);
                            $collapse_id = $accordion_id . '_collapse' . ($index + 1);
                            ?>
                            
                            <!-- FAQ <?= $index + 1 ?> -->
                            <div class="accordion-item border-0 shadow-sm mb-3">
                                <h3 class="accordion-header" id="<?= $item_id ?>">
                                    <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapse_id ?>" aria-expanded="false" aria-controls="<?= $collapse_id ?>">
                                        <i class="<?= isset($faq['icon']) ? $faq['icon'] : 'bx bx-help-circle' ?> me-3 text-primary fs-5"></i>
                                        <?= htmlspecialchars($faq['question']) ?>
                                    </button>
                                </h3>
                                <div id="<?= $collapse_id ?>" class="accordion-collapse collapse" aria-labelledby="<?= $item_id ?>" data-bs-parent="#<?= $accordion_id ?>">
                                    <div class="accordion-body">
                                        <?= $faq['answer'] ?>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            <i class="bx bx-info-circle me-2"></i>
                            No hay preguntas frecuentes disponibles en este momento.
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!--end: FAQ Section --> 