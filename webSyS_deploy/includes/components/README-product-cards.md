# Sistema de Productos Reutilizable - Documentación

## Descripción
Sistema completo y reutilizable para mostrar productos Tango usando la configuración centralizada de `config.php`. Incluye tanto tarjetas visuales como navegación entre productos.

## Archivos involucrados
- `config/config.php` - Configuración centralizada de productos
- `includes/functions.php` - Funciones reutilizables incluyendo `renderProductCard()`
- `includes/components/navigation-products.php` - Componente reutilizable de navegación entre productos

## Funciones disponibles

### Funciones en includes/functions.php

#### `renderProductCard($key, $product, $delay = 0)`
Renderiza una tarjeta individual de producto y devuelve el HTML.

**Parámetros:**
- `$key` (string): Clave del producto
- `$product` (array): Datos del producto desde `$tango_products`
- `$delay` (int): Delay para animación AOS (opcional)

**Retorna:** String HTML de la tarjeta

### Componente: navigation-products.php

#### `renderNavigationProducts($currentProduct = null, $title = "Conoce nuestros productos", $bgClass = "bg-light", $productKeys = [])`
Renderiza sección de navegación entre productos con botones.

**Parámetros:**
- `$currentProduct` (string): Slug del producto actual para excluir
- `$title` (string): Título de la sección
- `$bgClass` (string): Clase CSS de background
- `$productKeys` (array): Array de claves de productos específicos a mostrar

#### `renderTangoProductsNavigation($currentProduct = null)`
Renderiza navegación con todos los productos principales de Tango.

#### `renderCompactProductsNavigation($currentProduct = null, $selectedProductKeys = ['gestion', 'punto-venta', 'estudios-contables'])`
Renderiza navegación compacta con productos seleccionados.

#### `renderProductsNavigationWithCTA($currentProduct = null, $ctaText = "Ver todos los productos", $ctaUrl = "index.php#product", $ctaIcon = "bx-grid-alt", $maxProducts = 4)`
Renderiza navegación con call-to-action personalizado.

#### `renderProductBreadcrumb($currentProduct, $breadcrumbItems = [])`
Renderiza breadcrumb de navegación jerárquica.

## Ejemplos de uso

### Tarjetas de productos (functions.php)

#### Renderizar tarjetas individuales
```php
<?php 
// Renderizar una tarjeta específica
echo renderProductCard('gestion', $tango_products['gestion'], 50);
?>
```

#### Renderizar múltiples productos con loop
```php
<section class="products">
    <div class="container">
        <div class="row">
            <?php 
            $productOrder = ['gestion', 'punto-venta', 'estudios-contables'];
            $delay = 50;
            
            foreach ($productOrder as $productKey) {
                if (isset($tango_products[$productKey])) {
                    echo renderProductCard($productKey, $tango_products[$productKey], $delay);
                    $delay += 50;
                }
            }
            ?>
        </div>
    </div>
</section>
```

### Navegación entre productos (navigation-products.php)

#### Navegación básica
```php
<?php 
include('includes/components/navigation-products.php');
renderTangoProductsNavigation('gestion'); // Excluir 'gestion' de la lista
?>
```

#### Navegación compacta
```php
<?php 
include('includes/components/navigation-products.php');
renderCompactProductsNavigation('punto-venta', ['gestion', 'resto']);
?>
```

#### Navegación con CTA personalizado
```php
<?php 
include('includes/components/navigation-products.php');
renderProductsNavigationWithCTA('estudios-contables', 'Ver catálogo completo', 'catalogo.php', 'bx-book', 3);
?>
```

#### Breadcrumb de productos
```php
<?php 
include('includes/components/navigation-products.php');
renderProductBreadcrumb('Tango Gestión', [
    ['name' => 'ERP', 'url' => 'categoria-erp.php'],
    ['name' => 'Empresarial']
]);
?>
```

## Añadir un nuevo producto

1. **Editar `config/config.php`** y añadir el nuevo producto al array `$tango_products`:
```php
'nuevo-producto' => [
    'name' => 'Tango Nuevo Producto',
    'slug' => 'tango-nuevo-producto',
    'color' => '#HEX_COLOR',
    'logo' => 'logo.png',
    'icon' => 'icon-Name',
    'short_desc' => 'Descripción del producto...',
    'meta_desc' => 'Meta descripción para SEO...'
],
```

2. **Crear el archivo PHP del producto**: `tango-nuevo-producto.php`

3. **Añadir las imágenes** en: `assets/img/productos/tango-nuevo-producto/`

4. **Actualizar el orden** si es necesario, modificando el array por defecto en `renderProductCards()` o especificando el orden al llamar la función.

## Ventajas del sistema refactorizado

- ✅ **Centralización**: Toda la configuración está en un solo lugar (`config.php`)
- ✅ **Reutilización**: Los componentes pueden usarse en múltiples páginas
- ✅ **Mantenibilidad**: Cambios en un producto se reflejan automáticamente en todos los componentes
- ✅ **Escalabilidad**: Fácil añadir nuevos productos sin modificar múltiples archivos
- ✅ **Flexibilidad**: Diferentes configuraciones para diferentes páginas y casos de uso
- ✅ **Seguridad**: Escape automático de datos en todos los componentes
- ✅ **Consistencia**: Mismo formato y estructura en toda la aplicación
- ✅ **Eliminación de duplicación**: Ya no hay datos hardcodeados repetidos
- ✅ **Modularidad**: Componentes separados para tarjetas visuales y navegación
- ✅ **Documentación**: Sistema completamente documentado con ejemplos

## Antes vs Después

### Antes de la refactorización:
- 📝 160+ líneas de HTML duplicado en `index.php`
- 🔄 30+ líneas de datos duplicados en `navigation-products.php`
- ❌ Cambios requerían editar múltiples archivos
- ❌ Inconsistencias entre diferentes implementaciones
- ❌ Dificil mantenimiento y escalabilidad

### Después de la refactorización:
- ✅ 4 líneas en `index.php` para renderizar productos
- ✅ Configuración centralizada en `config.php`
- ✅ Componentes reutilizables y documentados
- ✅ Cambios automáticos en toda la aplicación
- ✅ Sistema escalable y fácil de mantener
