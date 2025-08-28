<?php
/**
 * Componente: Navigation Products
 * Sección de navegación entre productos Tango
 * Reutiliza Bootstrap 5 buttons (ya disponibles)
 * Sin dependencias nuevas
 */

/**
 * Renderizar sección de navegación entre productos
 * @param string|null $currentProduct Slug del producto actual para excluir
 * @param string $title Título de la sección (default: "Conoce nuestros productos")
 * @param string $bgClass Clase de background (default: "bg-light")
 * @param array $productKeys Array de claves de productos específicos a mostrar (opcional)
 * @return void
 */
function renderNavigationProducts($currentProduct = null, $title = "Conoce nuestros productos", $bgClass = "bg-light", $productKeys = []) {
    global $tango_products;
    
    // Si no hay configuración de productos, intentar cargarla
    if (empty($tango_products)) {
        require_once('config/config.php');
    }
    
    // Si se especifican claves de productos, filtrar solo esos
    if (!empty($productKeys)) {
        $products = [];
        foreach ($productKeys as $key) {
            if (isset($tango_products[$key])) {
                $products[$key] = $tango_products[$key];
            }
        }
    } else {
        $products = $tango_products;
    }
    
    ?>
    <section class="position-relative border-bottom overflow-hidden <?= $bgClass ?>">
        <div class="container py-9 py-lg-11 position-relative">
            <div class="row pt-5 pt-lg-7 justify-content-center align-items-center">
                <div class="col-xl-10 text-center mb-9">
                    <h4 class="display-4 mb-3" data-aos="fade-up"><?= htmlspecialchars($title) ?></h4>
                    
                    <div data-aos="fade-up" data-aos-delay="150">
                        <?php foreach ($products as $slug => $product): ?>
                            <?php if ($slug !== $currentProduct): ?>
                            <a href="<?= htmlspecialchars($product['slug']) ?>.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill me-3 mb-3">
                                <span><?= htmlspecialchars($product['name']) ?></span>
                            </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar navegación específica para productos Tango principales
 * @param string|null $currentProduct Producto actual a excluir
 * @return void
 */
function renderTangoProductsNavigation($currentProduct = null) {
    // Usar todos los productos principales del config
    $mainProductKeys = ['gestion', 'punto-venta', 'estudios-contables', 'resto', 'capital-humano', 'delta'];
    
    // Usar clase CSS en lugar de estilo inline
    renderNavigationProducts($currentProduct, "Conoce nuestros productos", "product-navigation-bg", $mainProductKeys);
}

/**
 * Renderizar navegación compacta con menos productos
 * @param string|null $currentProduct Producto actual a excluir
 * @param array $selectedProductKeys Array de claves de productos seleccionados
 * @return void
 */
function renderCompactProductsNavigation($currentProduct = null, $selectedProductKeys = ['gestion', 'punto-venta', 'estudios-contables']) {
    renderNavigationProducts($currentProduct, "Otros productos que te pueden interesar", "bg-light", $selectedProductKeys);
}

/**
 * Renderizar navegación con call-to-action personalizado
 * @param string|null $currentProduct Producto actual a excluir
 * @param string $ctaText Texto del botón CTA
 * @param string $ctaUrl URL del botón CTA
 * @param string $ctaIcon Ícono del botón CTA
 * @param int $maxProducts Número máximo de productos a mostrar
 * @return void
 */
function renderProductsNavigationWithCTA($currentProduct = null, $ctaText = "Ver todos los productos", $ctaUrl = "index.php#product", $ctaIcon = "bx-grid-alt", $maxProducts = 4) {
    global $tango_products;
    
    // Si no hay configuración de productos, intentar cargarla
    if (empty($tango_products)) {
        require_once('config/config.php');
    }
    
    ?>
    <section class="position-relative border-bottom overflow-hidden product-navigation-bg">
        <div class="container py-9 py-lg-11 position-relative">
            <div class="row pt-5 pt-lg-7 justify-content-center align-items-center">
                <div class="col-xl-10 text-center mb-9">
                    <h4 class="display-4 mb-3" data-aos="fade-up">Conoce nuestros productos</h4>
                    
                    <div data-aos="fade-up" data-aos-delay="150" class="mb-5">
                        <?php 
                        $count = 0;
                        foreach ($tango_products as $slug => $product): 
                            if ($slug !== $currentProduct && $count < $maxProducts):
                                $count++;
                        ?>
                        <a href="<?= htmlspecialchars($product['slug']) ?>.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill me-3 mb-3">
                            <span><?= htmlspecialchars($product['name']) ?></span>
                        </a>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                    
                    <div data-aos="fade-up" data-aos-delay="200">
                        <a href="<?= htmlspecialchars($ctaUrl) ?>" class="btn btn-primary btn-lg rounded-pill px-5">
                            <i class="bx <?= htmlspecialchars($ctaIcon) ?> me-2"></i><?= htmlspecialchars($ctaText) ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Renderizar breadcrumb de productos (navegación jerárquica)
 * @param string $currentProduct Nombre del producto actual
 * @param array $breadcrumbItems Items adicionales del breadcrumb
 * @return void
 */
function renderProductBreadcrumb($currentProduct, $breadcrumbItems = []) {
    ?>
    <section class="py-4 bg-light border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="index.php" class="text-decoration-none">
                            <i class="bx bx-home me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="index.php#product" class="text-decoration-none">Productos</a>
                    </li>
                    <?php foreach ($breadcrumbItems as $item): ?>
                    <li class="breadcrumb-item">
                        <?php if (isset($item['url'])): ?>
                            <a href="<?= htmlspecialchars($item['url']) ?>" class="text-decoration-none"><?= htmlspecialchars($item['name']) ?></a>
                        <?php else: ?>
                            <?= htmlspecialchars($item['name']) ?>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($currentProduct) ?></li>
                </ol>
            </nav>
        </div>
    </section>
    <?php
}
?>