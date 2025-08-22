# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a corporate website for "Servicios y Sistemas SRL", a technology solutions company in Argentina that specializes in Tango Software distribution and IT services. The site showcases their products, services, and company information.

## 🚨 IMPORTANT PROJECT CONSTRAINTS

### Deployment Limitations
- **NO direct server access** - changes are deployed by copying/pasting files manually
- **MINIMAL dependencies** - avoid external tools, build processes, or package managers
- **Self-contained code** - everything must work without npm, composer, or build steps
- **Spanish documentation** - all code comments and documentation must be in Spanish

### What NOT to use:
- Node.js dependencies (npm, yarn)
- PHP Composer packages
- Build tools (webpack, gulp, etc.)
- CSS preprocessors (SASS, LESS)
- TypeScript
- Any external CLI tools

### What TO use:
- Vanilla PHP (no frameworks)
- Vanilla JavaScript (ES5/ES6 that works in all browsers)
- Pure CSS (no preprocessors)
- CDN libraries only (Bootstrap, jQuery via CDN)

## Architecture

### Core Structure
- **PHP-based website** with modular architecture
- **Centralized configuration** in `config/config.php`
- **Template-based product pages** using `templates/tango-product-template.php`
- **Reusable components** in `includes/` directory
- **Modular CSS/JS** in `assets/` directory

### Key Files & Directories

```
├── config/config.php              # Configuración central (info empresa, datos productos)
├── templates/
│   └── tango-product-template.php # Template unificado para todos los productos Tango
├── includes/
│   ├── functions.php              # Funciones PHP utilitarias
│   ├── components.php             # Componentes HTML reutilizables
│   ├── head.php                   # HTML head con meta tags SEO
│   ├── nav.php                    # Componente navegación
│   ├── footer.php                 # Componente footer
│   └── faq-template.php           # Template FAQ
├── assets/
│   ├── css/
│   │   ├── sys_style.css          # Hoja de estilos principal
│   │   └── modules/dark-mode.css  # Estilos modo oscuro
│   └── js/
│       ├── sys.bundle.min.js      # Bundle JavaScript principal
│       └── sys-forms.js           # Utilidades manejo formularios
```

## Development Workflow

### Testing the Site
```bash
# Servidor PHP local para testing
php -S localhost:8000

# Validar sintaxis PHP
php -l archivo.php

# Verificar todos los archivos PHP
find . -name "*.php" -exec php -l {} \;
```

### Manual Optimization (NO automated tools)
```bash
# Solo usar herramientas manuales online:
# CSS minification: https://cssminifier.com/
# JS minification: https://javascript-minifier.com/
# Image optimization: https://tinypng.com/
```

## Key Patterns & Conventions

### Product Configuration
All Tango products are defined in `config/config.php` as an array with consistent structure:
```php
// Configuración de productos Tango
$tango_products = [
    'clave-producto' => [
        'name' => 'Nombre Producto',
        'slug' => 'slug-producto',
        'color' => '#COLOR_HEX',
        'logo' => 'archivo_logo.png',
        'short_desc' => 'Descripción...',
        'meta_desc' => 'Descripción SEO...'
    ]
];
```

### Creating New Product Pages
Use the unified template instead of creating separate files:
```php
<?php
// Configuración del producto
$product_key = 'clave-del-producto';
$modules = [...]; // Opcional: módulos del producto
$faq_items = [...]; // Opcional: preguntas frecuentes
$custom_content = '...'; // Opcional: HTML personalizado

// Cargar template unificado
include('templates/tango-product-template.php');
?>
```

### Form Handling
Use the `SysFormHandler` JavaScript object for consistent form behavior:
```javascript
// Integración EmailJS
SysFormHandler.initEmailJS('idFormulario', {
    serviceId: 'service_xxx',
    templateId: 'template_xxx',
    successRedirect: 'exito.html'
});

// Integración endpoint PHP
SysFormHandler.initPHP('idFormulario', 'endpoint.php', 'exito.html');
```

### Component Usage
Use functions from `includes/functions.php` and `includes/components.php`:
```php
// Renderizar tarjetas de productos
echo renderProductCard($key, $product, $delay);

// Generar enlaces WhatsApp
$link = generateWhatsAppLink('Mensaje personalizado');

// Renderizar componentes reutilizables
renderHeroSection($titulo, $subtitulo, $color);
renderCTASection($titulo, $subtitulo, $texto_boton, $url_boton);
```

### SEO & Meta Tags
- Todas las páginas usan meta tags dinámicos desde `includes/head.php`
- El markup Schema.org JSON-LD se genera automáticamente
- Meta tags de Open Graph y Twitter Card están incluidos
- URLs canónicas se configuran cuando se define `$canonical_url`

## Important Constants

Key constants defined in `config/config.php`:
- `SITE_NAME`: Nombre de la empresa
- `SITE_URL`: URL base del sitio web
- `SITE_EMAIL`: Email de contacto principal
- `SITE_PHONE`: Teléfono de contacto
- `DEFAULT_META_DESCRIPTION`: Descripción SEO por defecto
- `ECOMMERCE_URL`: URL sitio e-commerce externo
- `SUPPORT_URL`: URL sistema de soporte

## Server Configuration

The `.htaccess` file includes:
- Reescritura de URLs (elimina extensiones .php)
- Compresión (gzip/deflate)
- Headers de caché
- Páginas de error personalizadas (403.php, 404.php, 500.php)

## EmailJS Configuration

Para formularios de contacto, EmailJS está configurado como servicio principal de email. Los detalles de configuración están en `CONFIGURACION_EMAILJS.md`. Como alternativa, el manejo de email PHP está disponible en `enviar-datacenter.php`.

## Dark Mode Support

Los estilos de modo oscuro están separados en `assets/css/modules/dark-mode.css` y detectan automáticamente las preferencias del sistema.

## Form Validation

La validación del lado cliente se maneja con `SysFormHandler.validateForm()` que verifica:
- Campos requeridos
- Validación formato email
- Agrega clases de validación Bootstrap (`is-invalid`)

## Code Documentation Standards

**ALWAYS write code comments in Spanish:**

```php
<?php
/**
 * Función para generar tarjeta de producto
 * @param string $key Clave del producto
 * @param array $product Datos del producto
 * @param int $delay Delay para animación AOS
 * @return string HTML de la tarjeta
 */
function renderProductCard($key, $product, $delay = 0) {
    // Generar HTML de la tarjeta
    $html = '<div class="col-xl-2">';
    // ... resto del código
    return $html;
}
?>
```

```javascript
/**
 * Manejador de formularios del sistema
 * Proporciona funcionalidad unificada para envío de formularios
 */
const SysFormHandler = {
    /**
     * Inicializar formulario con EmailJS
     * @param {string} formId ID del formulario
     * @param {object} emailConfig Configuración EmailJS
     */
    initEmailJS: function(formId, emailConfig) {
        // Código de inicialización
    }
};
```

```css
/* Estilos para el modo oscuro */
.dark-mode {
    /* Variables de color para tema oscuro */
    --bg-color: #1a1a1a;
    --text-color: #ffffff;
}
```

When adding new features or modifying existing code, ensure they follow these constraints and documentation standards for easy maintenance and deployment.