# SPEC PRP: Unificación de Productos Tango bajo Template Común

> Ingest the information from this file, implement the Low-Level Tasks, and generate the code that will satisfy the High and Mid-Level Objectives.

## High-Level Objective

Estandarizar todas las páginas de productos Tango para utilizar el `tango-product-template.php` unificado, eliminando duplicación de código, mejorando la mantenibilidad y garantizando consistencia visual y estructural en toda la línea de productos.

## Mid-Level Objectives

1. **Eliminar duplicación de código** - Migrar de implementaciones independientes a template unificado
2. **Estandarizar estructura de datos** - Usar configuración centralizada para todos los productos 
3. **Unificar experiencia visual** - Mantener consistencia de diseño y navegación
4. **Simplificar mantenimiento** - Reducir puntos de actualización y modificación
5. **Preservar funcionalidad existente** - No perder características específicas de cada producto
6. **Optimizar SEO** - Asegurar meta tags y schema markup consistentes

## Current State Assessment

### Archivos Analizados
- `webSyS/tango-gestion.php` (114 líneas) - ✅ **YA USA TEMPLATE**
- `webSyS/tango-punto-de-venta.php` (300 líneas) - ⚠️ **USA TEMPLATE PARCIALMENTE**
- `webSyS/tango-estudios-contables.php` (347 líneas) - ⚠️ **USA TEMPLATE PARCIALMENTE**
- `webSyS/tango-resto.php` (124 líneas) - ❌ **NO USA TEMPLATE**
- `webSyS/tango-capital-humano.php` (232 líneas) - ❌ **NO USA TEMPLATE**

### Estado de Template Usage
```yaml
current_template_usage:
  fully_migrated: ["tango-gestion.php"]
  partially_migrated: ["tango-punto-de-venta.php", "tango-estudios-contables.php"]
  needs_migration: ["tango-resto.php", "tango-capital-humano.php"]
```

### Problemas Identificados

#### **Duplicación Masiva de Código**
- **Headers duplicados**: Cada archivo repite estructura HTML completa
- **Meta tags inconsistentes**: Diferentes enfoques para SEO y schema
- **Estilos en línea**: Colores hardcodeados en lugar de usar config
- **Navegación duplicada**: Repetición de includes básicos

#### **Inconsistencias Estructurales**
- **Diferentes ordenes de sección**: No hay estándar de flujo de información
- **Logos con diferentes tamaños**: Sin estandarización visual
- **Componentes ad-hoc**: Cada página implementa sus propias secciones

#### **Mantenimiento Complejo**
- **6 archivos diferentes** para mantener en lugar de 1 template + configuraciones
- **Actualizaciones múltiples**: Cambios simples requieren tocar múltiples archivos
- **Testing fragmentado**: Cada página debe probarse independientemente

### Configuración Central Existente
```yaml
products_in_config:
  - gestion (✅ completo)
  - punto-venta (✅ completo)
  - estudios-contables (✅ completo)  
  - resto (✅ completo)
  - capital-humano (✅ completo)
```

## Desired State Specification

### Nueva Arquitectura Estandarizada
```yaml
unified_structure:
  template: "webSyS/templates/tango-product-template.php"
  config: "webSyS/config/config.php" (centralizado)
  product_files: 
    - Product-specific variables only
    - Modules/components configuration
    - Custom content when needed
    - Include template call
```

### Patrón de Implementación
```php
// webSyS/tango-[product].php estructura objetivo:
<?php
// Configuración del producto
$product_key = '[product-key]';

// Contenido personalizado (opcional)
$intro_title = 'Título específico';
$intro_text = 'Descripción específica';

// Módulos específicos del producto
$modules = [ /* array de módulos */ ];

// Componentes adicionales (opcional)
$custom_content = $specific_components;
$faq_items = $product_faqs; // opcional

// Cargar template unificado
include('templates/tango-product-template.php');
?>
```

### Beneficios del Nuevo Estado
- **Mantenimiento único**: Cambios en 1 template afectan todos los productos
- **Consistencia garantizada**: Misma estructura y experiencia en todos los productos
- **SEO optimizado**: Schema markup y meta tags estandarizados
- **Desarrollo acelerado**: Nuevos productos siguen patrón establecido
- **Testing simplificado**: Validación centralizada

## Implementation Notes

### Restricciones Técnicas
- **NO usar build tools** - Vanilla PHP únicamente
- **Preservar URLs existentes** - No cambiar rutas de productos
- **Mantener SEO actual** - No degradar rankings existentes
- **Backward compatibility** - No romper funcionalidades existentes

### Patrones Establecidos (de tango-gestion.php)
- Usar `$product_key` para identificar producto en config
- Variables opcionales: `$intro_title`, `$intro_text`, `$modules`, `$custom_content`
- Output buffering para componentes complejos
- Include final del template unificado

### Componentes a Migrar/Crear
1. **Módulos específicos**: Convertir secciones a arrays de módulos
2. **Custom content**: Mover componentes únicos a variables
3. **FAQ sections**: Estandarizar preguntas frecuentes
4. **Integration sections**: Unificar partners/integraciones

## Context

### Beginning Context - Estado Actual
```
webSyS/
├── tango-gestion.php (✅ template standard)
├── tango-punto-de-venta.php (⚠️ partially template)
├── tango-estudios-contables.php (⚠️ partially template)  
├── tango-resto.php (❌ custom implementation)
├── tango-capital-humano.php (❌ custom implementation)
├── templates/tango-product-template.php (template base)
└── config/config.php (configuración central)
```

### Ending Context - Estado Objetivo
```
webSyS/
├── tango-gestion.php (✅ template standard - unchanged)
├── tango-punto-de-venta.php (✅ fully template)
├── tango-estudios-contables.php (✅ fully template)
├── tango-resto.php (✅ fully template)
├── tango-capital-humano.php (✅ fully template)
├── tango-delta.php (✅ fully template)
├── templates/tango-product-template.php (enhanced as needed)
└── config/config.php (updated with delta product)
```

## Low-Level Tasks

### 1. Migrate tango-resto.php to Template Pattern

**Action: REPLACE**
**File**: `webSyS/tango-resto.php`
**Changes**: Replace entire custom implementation with template pattern

```php
<?php
/**
 * Página de Tango Resto - Refactorizada para usar template unificado
 * Color oficial: #E31937
 */

// Configuración del producto
$product_key = 'resto';

// Título personalizado para la sección intro
$intro_title = 'El software adaptable a todo tipo de negocio gastronómico';

// Texto personalizado de introducción  
$intro_text = 'Tango Restô ofrece una gestión integrada adaptable a todo tipo de negocio gastronómico. Desde pequeños locales hasta grandes cadenas, se adapta a las necesidades específicas de cada establecimiento.';

// Módulos de Tango Resto (extract from existing content)
$modules = [
    // Extract and convert existing sections to modules array
];

// Cargar el template unificado
include('templates/tango-product-template.php');
?>
```

**Validation**:
```bash
php -l webSyS/tango-resto.php
curl -I http://localhost/tango-resto.php
```

### 2. Migrate tango-capital-humano.php to Template Pattern

**Action: REPLACE**
**File**: `webSyS/tango-capital-humano.php`
**Changes**: Replace custom implementation with template pattern

```php
<?php
/**
 * Página de Tango Capital Humano - Refactorizada para usar template unificado
 * Color oficial: #28A745
 */

// Configuración del producto
$product_key = 'capital-humano';

// Título personalizado
$intro_title = 'Sistema integral de gestión de recursos humanos';

// Texto personalizado de introducción
$intro_text = 'Administra personal, sueldos, capacitación y evaluación de desempeño de manera integral y eficiente.';

// Módulos específicos (convert existing content)
$modules = [
    // Extract from existing implementation
];

// Cargar template unificado
include('templates/tango-product-template.php');
?>
```

**Validation**:
```bash
php -l webSyS/tango-capital-humano.php
curl -I http://localhost/tango-capital-humano.php
```

### 3. Migrate tango-delta.php to Template Pattern

**Action: REPLACE**
**File**: `webSyS/tango-delta.php`  
**Changes**: Replace custom implementation with template pattern

```php
<?php
/**
 * Página de Tango Delta - Refactorizada para usar template unificado
 * Color oficial: #000000 (black theme)
 */

// Configuración del producto
$product_key = 'delta';

// Título personalizado
$intro_title = 'Sistema avanzado de desarrollo empresarial';

// Texto personalizado
$intro_text = 'Tango Delta ofrece herramientas avanzadas para el desarrollo y gestión de procesos empresariales complejos.';

// Módulos específicos (convert existing content)
$modules = [
    // Extract from existing content if any, or create new
];

// Cargar template unificado
include('templates/tango-product-template.php');
?>
```

**Validation**:
```bash
php -l webSyS/tango-delta.php
curl -I http://localhost/tango-delta.php
```

### 4. Fully Migrate tango-punto-de-venta.php

**Action: MODIFY**
**File**: `webSyS/tango-punto-de-venta.php`
**Changes**: Convert to fully template-based (currently partial)

```php
// Remove duplicate HTML structure (lines 1-50+)
// Keep only:
// - $product_key = 'punto-venta'
// - $intro_title and $intro_text  
// - $modules array (existing)
// - include('templates/tango-product-template.php')
```

**Validation**:
```bash
php -l webSyS/tango-punto-de-venta.php
curl -I http://localhost/tango-punto-de-venta.php
diff <(curl -s localhost/tango-punto-de-venta.php | grep -o '<section') <(curl -s localhost/tango-gestion.php | grep -o '<section')
```

### 5. Fully Migrate tango-estudios-contables.php

**Action: MODIFY**
**File**: `webSyS/tango-estudios-contables.php`
**Changes**: Convert to fully template-based (currently partial)

```php
// Remove custom HTML structure (lines 1-50+)
// Keep only template pattern like tango-gestion.php
// Extract existing content to modules array
// Use template include
```

**Validation**:
```bash
php -l webSyS/tango-estudios-contables.php
curl -I http://localhost/tango-estudios-contables.php
```

### 6. Enhance Template for Missing Features

**Action: MODIFY**
**File**: `webSyS/templates/tango-product-template.php`
**Changes**: Add any missing extension points needed by migrated products

```php
// Add support for custom main background (for delta black theme)
// Enhance logo flexibility 
// Add support for additional custom sections if needed
```

**Validation**:
```bash
php -l webSyS/templates/tango-product-template.php
```

### 7. Update Navigation Links Consistency

**Action: VALIDATE**
**Changes**: Ensure all products link correctly to each other

```bash
# Test that all products maintain navigation consistency
for product in gestion punto-de-venta estudios-contables resto capital-humano delta; do
  curl -s "http://localhost/tango-$product.php" | grep -c "tango-.*\.php"
done
```

## Implementation Strategy

### Phase 1: Configuration and Foundation (Required)
1. Enhance template with any needed flexibility

### Phase 2: Full Replacements (High Impact)  
3. Migrate tango-resto.php (124 lines → ~20 lines)
4. Migrate tango-capital-humano.php (232 lines → ~25 lines)

### Phase 3: Optimization of Partials (Medium Impact)
6. Fully migrate tango-punto-de-venta.php (300 lines → ~30 lines)
7. Fully migrate tango-estudios-contables.php (347 lines → ~25 lines)

### Dependencies Logic
- Task 1 → All other tasks
- Task 7 → Tasks 1-5 (template enhancements needed for migrations)
- Tasks 1-5 → Independent (can run in parallel after dependencies)
- Task78 → All tasks (final validation)

### Risk Mitigation
- **SEO preservation**: Maintain existing meta tags and URLs
- **Functionality preservation**: Extract all existing features to template variables
- **Visual consistency**: Test each migration for layout preservation
- **Rollback plan**: Git backup before each migration step

## Validation Gates

### Level 1: Syntax & Configuration
```bash
# Verify PHP syntax on all modified files
for file in webSyS/tango-*.php webSyS/config/config.php webSyS/templates/tango-product-template.php; do
  php -l "$file"
done

# Verify config has all products
php -r "require 'webSyS/config/config.php'; echo count(\$tango_products) . ' products configured\n';"
```

### Level 2: Template Functionality  
```bash
# Test all products load without errors
for product in gestion punto-de-venta estudios-contables resto capital-humano ; do
  echo "Testing tango-$product.php..."
  curl -I "http://localhost/tango-$product.php" | head -1
done

# Verify consistent structure
curl -s "http://localhost/tango-gestion.php" | grep -c "<section" > expected_sections.txt
for product in punto-de-venta estudios-contables resto capital-humano delta; do
  sections=$(curl -s "http://localhost/tango-$product.php" | grep -c "<section")
  echo "$product: $sections sections"
done
```

### Level 3: Content Preservation
```bash
# Verify key content appears on each page
for product in gestion punto-de-venta estudios-contables resto capital-humano ; do
  echo "Testing content for $product..."
  curl -s "http://localhost/tango-$product.php" | grep -q "Módulos y Funcionalidades" && echo "✅ Modules section found" || echo "❌ Missing modules"
  curl -s "http://localhost/tango-$product.php" | grep -q "nuestros productos" && echo "✅ Navigation found" || echo "❌ Missing navigation"
done
```

### Level 4: SEO and Integration
```bash
# Test meta tags and schema markup
for product in gestion punto-de-venta estudios-contables resto capital-humano ; do
  echo "SEO test for $product..."
  curl -s "http://localhost/tango-$product.php" | grep -q "application/ld+json" && echo "✅ Schema markup" || echo "❌ No schema"
  curl -s "http://localhost/tango-$product.php" | grep -q "meta.*description" && echo "✅ Meta description" || echo "❌ No meta desc"
done

# Test cross-product navigation
curl -s "http://localhost/tango-gestion.php" | grep -o 'tango-[^.]*\.php' | sort -u
```

## Success Metrics

### Code Reduction
- **Before**: ~1,240 total lines across 5 files
- **After**: ~150 total lines across 5 files (88% reduction)

### Maintainability Improvement  
- **Before**: 5 files to update for common changes
- **After**: 1 template file for common changes

### Consistency Achievement
- **Before**: 5 different implementations
- **After**: 1 consistent template implementation

### Development Speed
- **Before**: New product requires full custom implementation  
- **After**: New product requires only config entry + variables

## Quality Checklist

- [ ] Current state fully analyzed and documented
- [ ] Desired template pattern clearly defined
- [ ] All 5 products identified with migration complexity
- [ ] Tasks ordered by dependency logic (config → template → migrations)
- [ ] Each task has PHP syntax and HTTP validation commands
- [ ] SEO preservation strategy documented
- [ ] Content extraction strategy defined for each product
- [ ] Rollback strategy included (Git-based)
- [ ] Integration testing covers cross-product navigation
- [ ] Success metrics are measurable (line count, file count)

## Risk Assessment

### Low Risk
- **tango-gestion.php**: Already using template (no changes needed)
- **Configuration updates**: Simple array additions

### Medium Risk  
- **Partial migrations** (punto-de-venta, estudios-contables): May have hidden dependencies
- **Template enhancements**: Could affect existing working product

### High Risk
- **Full replacements** (resto, capital-humano): Largest code changes
- **SEO impact**: URL or meta tag changes could affect rankings

### Mitigation Strategies
1. **Git backup** before each migration
2. **Incremental testing** after each file modification
3. **Content extraction validation** to ensure no feature loss
4. **URL preservation** to maintain SEO value

---

Remember: This transformation will reduce maintenance burden by 88% while ensuring consistent user experience across all Tango products. The investment in migration will pay dividends in faster future development and easier maintenance.