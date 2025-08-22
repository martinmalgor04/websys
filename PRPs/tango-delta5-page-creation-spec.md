# SPEC PRP: Creación de Página Tango Delta 5 y Reorganización de Assets

> Ingest the information from this file, implement the Low-Level Tasks, and generate the code that will satisfy the High and Mid-Level Objectives.

## High-Level Objective

Crear una página completamente nueva para Tango Delta 5 basada en la inspiración de https://axoft.com/tango/novedades/delta5/, incorporando las funcionalidades de AI y características avanzadas mencionadas, utilizando el sistema de templates unificado existente y reorganizando los assets de imágenes para una mejor estructura y mantenimiento.

## Mid-Level Objectives

1. **Crear página Tango Delta 5** - Desarrollar nueva página usando contenido específico de IA y nuevas funcionalidades
2. **Reorganizar assets de imágenes** - Consolidar y organizar las imágenes dispersas en estructura coherente
3. **Implementar secciones específicas de AI** - Crear componentes para mostrar características de inteligencia artificial
4. **Optimizar estructura de assets** - Migrar imágenes de carpetas temporales a ubicaciones definitivas
5. **Mantener consistencia visual** - Asegurar que el nuevo diseño siga el estilo de Servicios y Sistemas

## Current State Assessment

### Archivos Existentes
- `webSyS/tango-delta.php` (123 líneas) - **Página básica con placeholder**
- `webSyS/config/config.php` - **Sin configuración de Delta**
- `webSyS/assets/img/delta/` - **Solo contiene tangoai.png**
- `webSyS/TANGO PUNTO DE VENTA/` - **Imágenes desorganizadas fuera de assets**

### Estado Actual de Assets
```yaml
current_image_structure:
  organized:
    - "webSyS/assets/img/productos/tango-gestion/"
    - "webSyS/assets/img/productos/tango-resto/"
    - "webSyS/assets/img/productos/tango-estudios-contables/"
    - "webSyS/assets/img/productos/tango-capital-humano/"
    - "webSyS/assets/img/productos/tango-punto-de-venta/" (parcial)
  
  disorganized:
    - "webSyS/TANGO PUNTO DE VENTA/LOGO/" (8 archivos)
    - "webSyS/TANGO PUNTO DE VENTA/INTEGRACIONES/" (5 archivos)
    - "webSyS/TANGO PUNTO DE VENTA/SOLUCIONES/" (14 archivos)
    - "webSyS/TANGO PUNTO DE VENTA/" (3 archivos raíz)

  missing:
    - "webSyS/assets/img/productos/tango-delta/" (necesita crear)
```

### Problemas Identificados

#### **Falta Configuración de Delta**
- Sin meta tags, colores, o logo configurados
- Página actual es placeholder básico

#### **Assets Desorganizados**
- Carpeta `TANGO PUNTO DE VENTA` fuera del directorio `assets`
- Imágenes duplicadas con nombres inconsistentes
- Sin estructura coherente para nuevos productos

#### **Contenido Placeholder**
- Página delta actual solo muestra "actualizando contenido"
- Sin información específica de Delta 5

## Desired State Specification

### Nueva Página Tango Delta 5
```yaml
desired_delta5_page:
  structure:
    header: "Logo Delta 5 prominente con tema negro/azul"
    intro: "Introducción a IA en Tango con soberanía de datos"
    features:
      - "Inteligencia Artificial en Tango"
      - "Automatización de pedidos"
      - "Diseño de comprobantes"
      - "Visión total del cliente"
      - "Compras más rápidas con AI"
      - "Sueldos fácil y flexible"
      - "Tango Empleados con AI"
    components:
      - "Sección hero con video/animación"
      - "Cards de características con iconos"
      - "Testimonios y casos de uso"
      - "Call to action para demo/contacto"
```

### Organización de Assets
```yaml
desired_image_structure:
  "webSyS/assets/img/productos/":
    tango-delta/:
      - "logo-delta5.svg"
      - "tangoai.png"
      - "ai-features/"
      - "screenshots/"
      - "icons/"
    
    tango-punto-de-venta/:
      - "LogoPDV.png" (ya existe)
      - "logos/" (desde TANGO PUNTO DE VENTA/LOGO/)
      - "integraciones/" (desde TANGO PUNTO DE VENTA/INTEGRACIONES/)
      - "soluciones/" (desde TANGO PUNTO DE VENTA/SOLUCIONES/)
      - "dispositivos.png" (desde TANGO PUNTO DE VENTA/)
```

## Implementation Notes

### Restricciones Técnicas
- **NO usar build tools** - Vanilla PHP únicamente
- **Preservar URLs** - Mantener `/tango-delta.php` como ruta
- **Optimizar imágenes** - Usar formatos web apropiados (WebP cuando sea posible)

### Contenido Específico Proporcionado
- **Título principal**: "Inteligencia Artificial en Tango"
- **Soberanía de datos**: Enfoque en control de información del usuario
- **Características**: 7 funcionalidades específicas mencionadas
- **Estilo**: Servicios y Sistemas (colores corporativos, tipografía, estructura)

## Context

### Beginning Context - Estado Actual
```
webSyS/
├── tango-delta.php (placeholder básico)
├── config/config.php (sin delta)
├── assets/img/delta/ (solo tangoai.png)
└── TANGO PUNTO DE VENTA/ (desorganizado)
    ├── LOGO/ (8 archivos)
    ├── INTEGRACIONES/ (5 archivos)
    ├── SOLUCIONES/ (14 archivos)
    └── *.png (3 archivos)
```

### Ending Context - Estado Objetivo
```
webSyS/
├── tango-delta.php (página completa Delta 5)
├── config/config.php (con delta configurado)
├── assets/img/productos/
│   ├── tango-delta/ (completo con assets)
│   └── tango-punto-de-venta/ (reorganizado)
└──  TANGO PUNTO DE VENTA/ (DELETED)
```

## Low-Level Tasks

### 1. Add Tango Delta to Central Configuration

**Action: ADD**
**File**: `webSyS/config/config.php`
**Changes**: Add delta product to $tango_products array

```php
// Add after line ~72 in $tango_products array:
'delta' => [
    'name' => 'Tango Delta 5',
    'slug' => 'tango-delta',
    'color' => '#000080', // Navy blue for Delta 5
    'logo' => 'logo-delta5.svg',
    'icon' => 'icon-Code',
    'short_desc' => 'La nueva versión de Tango con Inteligencia Artificial integrada para automatizar y optimizar tu gestión empresarial.',
    'meta_desc' => 'Tango Delta 5 - Software empresarial con IA integrada. Automatización inteligente, análisis de datos y gestión avanzada.'
]
```

**Validation**:
```bash
php -l webSyS/config/config.php
php -r "require 'webSyS/config/config.php'; var_dump(array_key_exists('delta', \$tango_products));"
```

### 2. Create Organized Asset Structure

**Action: CREATE**
**Directory Structure**: Organize image assets properly

```bash
# Create directory structure
mkdir -p webSyS/assets/img/productos/tango-delta/{ai-features,screenshots,icons}

# Move Punto de Venta assets to proper location
mkdir -p webSyS/assets/img/productos/tango-punto-de-venta/{logos,integraciones,soluciones}
```

**Validation**:
```bash
ls -la webSyS/assets/img/productos/tango-delta/
ls -la webSyS/assets/img/productos/tango-punto-de-venta/
```

### 3. Migrate Punto de Venta Images

**Action: MOVE**
**Source**: `webSyS/TANGO PUNTO DE VENTA/`
**Target**: `webSyS/assets/img/productos/tango-punto-de-venta/`

```bash
# Move logo files
cp "webSyS/TANGO PUNTO DE VENTA/LOGO/"* webSyS/assets/img/productos/tango-punto-de-venta/logos/

# Move integration files  
cp "webSyS/TANGO PUNTO DE VENTA/INTEGRACIONES/"* webSyS/assets/img/productos/tango-punto-de-venta/integraciones/

# Move solution icons
cp "webSyS/TANGO PUNTO DE VENTA/SOLUCIONES/"* webSyS/assets/img/productos/tango-punto-de-venta/soluciones/

# Move root files
cp "webSyS/TANGO PUNTO DE VENTA/"*.png webSyS/assets/img/productos/tango-punto-de-venta/
```

**Validation**:
```bash
find webSyS/assets/img/productos/tango-punto-de-venta/ -type f | wc -l
find "webSyS/TANGO PUNTO DE VENTA/" -type f | wc -l
```

### 4. Create Complete Tango Delta 5 Page

**Action: REPLACE**
**File**: `webSyS/tango-delta.php`
**Changes**: Replace placeholder with complete Delta 5 page

```php
<?php
/**
 * Página de Tango Delta 5 - Nueva versión con IA integrada
 * Incluye documentación en español y uso de constantes centralizadas
 */

// Configuración del producto
$product_key = 'delta';

// Título personalizado para la sección intro
$intro_title = 'Inteligencia Artificial en Tango';

// Texto personalizado de introducción
$intro_text = 'Sumamos AI para que analices datos en lenguaje natural, automatices tareas y ejecutes acciones, obteniendo respuestas más rápidas, incluso a partir de información cruzada entre módulos y datos no uniformes. Más simple, más fácil, más rápido. Todo bajo un principio clave: la soberanía de tus datos. Vos elegís con qué proveedor trabajar; ellos pueden analizarlos, pero nunca resguardarlos. La información siempre es tuya. Tecnología con propósito, sin perder el control.';

// Módulos/Características de Tango Delta 5
$modules = [
    [
        'title' => 'Automatización de Pedidos',
        'icon' => 'bx bx-bot',
        'description' => 'Seguimos ampliando las posibilidades de integración de Tango. Ahora en Ventas también podés modificar pedidos desde Excel o mediante API, respetando todas las validaciones del sistema.'
    ],
    [
        'title' => 'Diseño de Comprobantes',
        'icon' => 'bx bx-palette',
        'description' => 'Nueva herramienta gráfica para diseñar intuitivamente tus formularios. Definí colores, incluí fórmulas, trabajá por secciones y agregá imágenes con modelos predefinidos.'
    ],
    [
        'title' => 'Visión Total del Cliente',
        'icon' => 'bx bx-user-circle',
        'description' => 'Gestión de Clientes con visión integral. Indicadores clave en formato tablero, situación financiera actualizada desde BCRA y consultas dinámicas.'
    ],
    [
        'title' => 'Compras con IA',
        'icon' => 'bx bx-brain',
        'description' => 'Importación automática de comprobantes en PDF gracias a la inteligencia artificial que automatiza su registración, ahorrando tiempo y reduciendo errores.'
    ],
    [
        'title' => 'Sueldos Inteligentes',
        'icon' => 'bx bx-calculator',
        'description' => 'Editor avanzado de fórmulas con autocompletado y pago a múltiples cuentas bancarias. Distribución automática por importe o porcentaje.'
    ],
    [
        'title' => 'Tango Empleados + IA',
        'icon' => 'bx bx-group',
        'description' => 'Formularios personalizables y AI que interpreta documentación de RRHH para responder consultas frecuentes de colaboradores de forma inmediata.'
    ]
];

// Sección hero con IA
$ai_hero_content = '<section class="position-relative text-white" style="background: linear-gradient(135deg, #000080 0%, #4169E1 100%);">
    <div class="container position-relative py-9 py-lg-15">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                <h1 class="display-3 fw-bold mb-4">El Futuro es Ahora</h1>
                <h3 class="mb-4">Inteligencia Artificial Integrada</h3>
                <p class="lead mb-5">
                    Tango Delta 5 revoluciona la gestión empresarial con IA nativa. 
                    Automatización inteligente, análisis predictivo y decisiones basadas en datos.
                </p>
                <div class="d-flex gap-3">
                    <a href="#demo" class="btn btn-light btn-lg">Ver Demo</a>
                    <a href="#features" class="btn btn-outline-light btn-lg">Conocer Más</a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="assets/img/delta/tangoai.png" alt="Tango IA" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>';

// Sección de soberanía de datos
$data_sovereignty_content = '<section class="bg-light py-9 py-lg-11">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center" data-aos="fade-up">
                <h2 class="display-5 mb-4">Soberanía de tus Datos</h2>
                <p class="lead text-muted mb-5">
                    Todo bajo un principio clave: la soberanía de tus datos. Vos elegís con qué proveedor trabajar; 
                    ellos pueden analizarlos, pero nunca resguardarlos. La información siempre es tuya. 
                    Tecnología con propósito, sin perder el control.
                </p>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <i class="bx bx-shield-check display-4 text-primary mb-3"></i>
                        <h5>Control Total</h5>
                        <p>Tus datos siempre bajo tu control</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="bx bx-select-multiple display-4 text-primary mb-3"></i>
                        <h5>Libre Elección</h5>
                        <p>Elegí tu proveedor de IA preferido</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="bx bx-lock-alt display-4 text-primary mb-3"></i>
                        <h5>Privacidad</h5>
                        <p>Información nunca almacenada externamente</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';

// Contenido personalizado
$custom_content = $ai_hero_content . $data_sovereignty_content;

// Cargar el template unificado
include('templates/tango-product-template.php');
?>
```

**Validation**:
```bash
php -l webSyS/tango-delta.php
wc -l webSyS/tango-delta.php
```

### 5. Clean Up Old Asset Structure

**Action: DELETE**
**Target**: `webSyS/TANGO PUNTO DE VENTA/`
**Changes**: Remove old disorganized directory after migration

```bash
# Verify migration completed successfully first
find webSyS/assets/img/productos/tango-punto-de-venta/ -type f | wc -l

# Then remove old directory
rm -rf "webSyS/TANGO PUNTO DE VENTA/"
```

**Validation**:
```bash
ls -la webSyS/ | grep -i "tango punto"
find webSyS/assets/img/productos/tango-punto-de-venta/ -type f | wc -l
```

### 6. Update Image References

**Action: MODIFY**
**Files**: Any references to old image paths
**Changes**: Update paths to use new organized structure

```bash
# Search for old path references
grep -r "TANGO PUNTO DE VENTA" webSyS/ --include="*.php"

# Update any found references to new paths
# Example: "TANGO PUNTO DE VENTA/LOGO/" → "assets/img/productos/tango-punto-de-venta/logos/"
```

**Validation**:
```bash
grep -r "TANGO PUNTO DE VENTA" webSyS/ --include="*.php" | wc -l
```

## Implementation Strategy

### Phase 1: Configuration and Structure (Foundation)
1. Add Delta to central configuration
2. Create organized asset structure
3. Migrate Punto de Venta images

### Phase 2: Content Creation (Core)
4. Create complete Tango Delta 5 page

### Phase 3: Cleanup and Optimization (Finalization)
5. Clean up old asset structure
6. Update any remaining image references

### Dependencies Logic
- Task 1 → Task 4 (config needed before page creation)
- Task 2 → Task 3 (structure needed before migration)
- Task 3 → Task 6 (migration needed before cleanup)
- Task 4 → Task 5 (page needed to test template changes)
- Task 6 → Task 7 (cleanup before reference updates)

### Risk Mitigation
- **Asset backup**: Copy files before moving/deleting
- **Reference validation**: Search for all path references before cleanup
- **Template testing**: Verify template changes don't break existing products
- **Incremental deployment**: Test each phase before proceeding

## Validation Gates

### Level 1: Configuration and Structure
```bash
# Verify Delta configuration
php -r "require 'webSyS/config/config.php'; echo \$tango_products['delta']['name'] . \"\n\";"

# Verify asset structure
ls -la webSyS/assets/img/productos/tango-delta/
ls -la webSyS/assets/img/productos/tango-punto-de-venta/
```

### Level 2: Content and Template
```bash
# Verify Delta page syntax and content
php -l webSyS/tango-delta.php
grep -c "Inteligencia Artificial" webSyS/tango-delta.php

```

### Level 3: Asset Migration
```bash
# Count migrated files
echo "Delta assets:" $(find webSyS/assets/img/productos/tango-delta/ -type f | wc -l)
echo "PDV assets:" $(find webSyS/assets/img/productos/tango-punto-de-venta/ -type f | wc -l)

# Verify old directory removed
! test -d "webSyS/TANGO PUNTO DE VENTA/" && echo "✅ Old directory removed" || echo "❌ Old directory still exists"
```

### Level 4: Integration and References
```bash
# Test all products still load
for product in gestion punto-de-venta estudios-contables resto capital-humano delta; do
  echo "Testing tango-$product.php..."
  php -l "webSyS/tango-$product.php"
done

# Verify no broken image references
grep -r "TANGO PUNTO DE VENTA" webSyS/ --include="*.php" | wc -l
```

## Success Metrics

### Content Creation
- **New Delta 5 page**: Complete with 6 AI-focused modules
- **Template integration**: Using unified template system
- **Content richness**: AI hero section + data sovereignty section

### Asset Organization
- **Before**: 30+ files scattered in `TANGO PUNTO DE VENTA/`
- **After**: Organized in proper `assets/img/productos/` structure
- **Cleanup**: Old disorganized directory removed

### System Integration
- **Configuration**: Delta added to central products array
- **Template compatibility**: Works with existing template system
- **Consistency**: Follows established patterns and naming conventions

## Quality Checklist

- [ ] Delta configuration added to central config
- [ ] Asset directories properly structured
- [ ] All Punto de Venta images migrated successfully
- [ ] Delta 5 page created with AI-focused content
- [ ] Template system enhanced for Delta theme
- [ ] Old asset structure cleaned up
- [ ] All image references updated
- [ ] PHP syntax validated on all files
- [ ] Template compatibility maintained
- [ ] Success metrics achieved

## Risk Assessment

### Low Risk
- **Asset migration**: Simple file copy operations
- **Configuration update**: Adding to existing array structure

### Medium Risk
- **Template modifications**: Could affect existing products
- **Image reference updates**: May miss some references

### High Risk
- **Directory deletion**: Could lose files if migration incomplete
- **Theme changes**: Dark theme might not display correctly

### Mitigation Strategies
1. **Backup before deletion**: Verify migration count matches before cleanup
2. **Incremental testing**: Test template changes on each product
3. **Reference searching**: Use comprehensive grep to find all path references
4. **Rollback plan**: Git-based recovery for all modifications

---

Remember: This project creates a modern, AI-focused product page while improving the overall asset organization for better maintainability and consistency across the Tango product line.