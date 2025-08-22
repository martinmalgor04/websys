# 🚀 **ESTRUCTURA REFACTORIZADA - SERVICIOS Y SISTEMAS**

## 📋 **Resumen de la Refactorización**

Este proyecto ha sido refactorizado para mejorar la eficiencia, reutilización del código y mantenibilidad, sin perder ningún módulo o funcionalidad existente.

## 🗂️ **Nueva Estructura de Archivos**

```
webSyS vieja/
├── config/
│   └── config.php                 # Configuración centralizada
├── templates/
│   └── tango-product-template.php # Template unificado para productos
├── includes/
│   ├── head.php                   # Encabezado HTML dinámico
│   ├── nav.php                    # Navegación
│   ├── footer.php                 # Pie de página
│   ├── script.php                 # Scripts JS
│   ├── link.php                   # Enlaces CSS
│   ├── functions.php              # Funciones PHP reutilizables
│   ├── components.php             # Componentes HTML reutilizables
│   ├── faq-template.php           # Template FAQ
│   └── slider.php                 # Slider principal
├── assets/
│   ├── css/
│   │   ├── sys_style.css          # CSS principal
│   │   └── modules/
│   │       └── dark-mode.css      # CSS específico dark mode
│   └── js/
│       ├── sys.bundle.min.js      # JS principal
│       └── sys-forms.js           # JS para formularios
└── [páginas existentes]
```

## 🔧 **Componentes Refactorizados**

### **1. Configuración Central (`config/config.php`)**
- Constantes del sitio (nombre, email, teléfono, etc.)
- Array de productos Tango con toda su información
- Array de partners
- Funciones auxiliares globales

### **2. Template de Productos (`templates/tango-product-template.php`)**
- Template unificado para todas las páginas de productos Tango
- Acepta variables para personalización:
  - `$product_key`: clave del producto
  - `$modules`: array de módulos
  - `$faq_items`: preguntas frecuentes
  - `$custom_content`: contenido HTML personalizado

### **3. Funciones PHP Reutilizables (`includes/functions.php`)**
- `renderProductCard()`: Tarjetas de productos
- `renderBreadcrumb()`: Breadcrumb navigation
- `generateSocialMeta()`: Meta tags sociales
- `generateWhatsAppLink()`: Enlaces WhatsApp
- `generateLocalBusinessSchema()`: Schema JSON-LD
- Y más funciones auxiliares

### **4. Componentes HTML (`includes/components.php`)**
- `renderHeroSection()`: Sección hero
- `renderCTASection()`: Call to action
- `renderFeatureCard()`: Tarjetas de características
- `renderStatCard()`: Estadísticas
- `renderTestimonial()`: Testimoniales
- `renderAlert()`: Alertas
- Y más componentes

### **5. JavaScript Modular (`assets/js/sys-forms.js`)**
- `SysFormHandler`: Manejador de formularios
- Soporte para EmailJS y PHP
- Validación de formularios
- Manejo de errores unificado

### **6. CSS Modular (`assets/css/modules/dark-mode.css`)**
- Todos los estilos de dark mode separados
- Variables CSS para temas
- Mejor organización y mantenibilidad

## 📝 **Cómo Usar la Nueva Estructura**

### **Crear Nueva Página de Producto:**
```php
<?php
// Configurar producto
$product_key = 'mi-producto';

// Configurar contenido
$intro_title = 'Título personalizado';
$modules = [...];
$faq_items = [...];

// Cargar template
include('templates/tango-product-template.php');
?>
```

### **Usar Componentes:**
```php
<?php
include('includes/components.php');

// Renderizar hero
renderHeroSection('Mi Título', 'Subtítulo', '#00A8E1');

// Renderizar CTA
renderCTASection(
    '¿Listo para empezar?',
    'Contactanos hoy mismo',
    'CONTACTAR',
    'contacto.php'
);
?>
```

### **Manejar Formularios:**
```javascript
// Con EmailJS
SysFormHandler.initEmailJS('miFormulario', {
    serviceId: 'service_xxx',
    templateId: 'template_xxx',
    successRedirect: 'gracias.html'
});

// Con PHP
SysFormHandler.initPHP('miFormulario', 'enviar.php', 'gracias.html');
```

## 🎯 **Beneficios de la Refactorización**

1. **Código DRY (Don't Repeat Yourself)**
   - Eliminación de código duplicado
   - Un solo lugar para cambios

2. **Mantenibilidad**
   - Estructura clara y organizada
   - Fácil de encontrar y modificar código

3. **Escalabilidad**
   - Fácil agregar nuevos productos
   - Componentes reutilizables para nuevas páginas

4. **Performance**
   - CSS modular (cargar solo lo necesario)
   - JavaScript optimizado

5. **Consistencia**
   - Mismo comportamiento en todo el sitio
   - Diseño uniforme

## 🔄 **Migración Gradual**

Para migrar las páginas existentes:

1. **Productos Tango**: Usar `tango-product-template.php`
2. **Formularios**: Migrar a `SysFormHandler`
3. **Componentes repetidos**: Usar `components.php`
4. **Configuración**: Centralizar en `config.php`

## 📚 **Próximos Pasos Recomendados**

1. Migrar todas las páginas de productos al nuevo template
2. Dividir `sys_style.css` en más módulos:
   - `modules/forms.css`
   - `modules/cards.css`
   - `modules/animations.css`
3. Crear sistema de caché para assets
4. Implementar minificación automática
5. Agregar tests automatizados

## 🛠️ **Herramientas de Desarrollo**

### **Para comprimir CSS/JS:**
```bash
# CSS
npx csso assets/css/sys_style.css -o assets/css/sys_style.min.css

# JavaScript
npx terser assets/js/sys-forms.js -o assets/js/sys-forms.min.js
```

### **Para validar código:**
```bash
# PHP
php -l archivo.php

# JavaScript
npx eslint assets/js/

# CSS
npx stylelint assets/css/
```

## 📞 **Soporte**

Si necesitás ayuda con la nueva estructura:
- Email: desarrollo@serviciosysistemas.com.ar
- Documentación: `/docs` (próximamente)

---

**Última actualización:** <?= date('d/m/Y') ?>
**Versión:** 2.0.0 