# SPEC PRP: Reorganización de la página Tango Gestión

> Ingest the information from this file, implement the Low-Level Tasks, and generate the code that will satisfy the High and Mid-Level Objectives.

## High-Level Objective

Reorganizar la estructura y orden de contenido de la página Tango Gestión (`tango-gestion.php`) para mejorar la experiencia del usuario, el flujo de información y la presentación visual, siguiendo un orden lógico específico que maximice la comprensión del producto y sus beneficios.

## Mid-Level Objectives

1. **Restructurar el orden de secciones** - Reorganizar las secciones existentes según la secuencia específica requerida
2. **Optimizar presentación visual** - Remover sombras de imágenes de partners/integraciones y mejorar la presentación del logo principal
3. **Mejorar flujo informativo** - Asegurar que el contenido fluya lógicamente desde introducción hasta call-to-action
4. **Mantener funcionalidad existente** - Conservar todos los componentes y funcionalidades actuales sin romper la modularidad
5. **Validar experiencia de usuario** - Asegurar que el nuevo orden mejore la comprensión y navegación

## Current State Assessment

### Archivos Afectados
- `webSyS/tango-gestion.php` - Página principal del producto
- `webSyS/templates/tango-product-template.php` - Template genérico usado
- `webSyS/includes/components/partners-slider.php` - Componente de integraciones
- `webSyS/includes/components/card-hover-2.php` - Componente de conectividad
- `webSyS/includes/components/video-embed.php` - Componente de video
- `webSyS/includes/components/reportes-slider.php` - Componente de reportes

### Orden Actual (Problemático)
```yaml
current_structure:
  1: Header con logo pequeño (template line 65-78)
  2: Custom content (todos los componentes mezclados) (line 101-103)
     - Partners slider (integraciones con sombras)
     - Conectividad total (card-hover-2)
     - Video de Tango Gestión integrado
     - Tango Reportes slider
  3: Introducción "La solución para la gestión..." (line 82-99)
  4: Módulos y Funcionalidades (line 105-135)
  5: Conoce nuestros productos (line 146-166)
```

### Problemas Identificados
- **Orden confuso**: La introducción aparece después del contenido personalizado
- **Logo pequeño**: El header no destaca suficientemente el producto
- **Sombras en integraciones**: Las imágenes de partners tienen efectos visuales no deseados
- **Flujo no lógico**: El usuario no recibe contexto antes de ver integraciones/videos

## Desired State Specification

### Nuevo Orden Requerido
```yaml
desired_structure:
  1: Tango Gestión background y logo grande
  2: La solución para la gestión de tu empresa
  3: Módulos y Funcionalidades  
  4: Integrado con los mejores softwares (sin sombras)
  5: Tango Gestión integrado (video)
  6: Tango Reportes
  7: Conectividad total buttons (reportes y conecta tu estudio)
  8: Conoce nuestros productos
```

### Beneficios del Nuevo Orden
- **Flujo lógico**: Introducción → Explicación → Detalles → Prueba social → Demostración → Expansión → CTA
- **Mejor UX**: El usuario entiende qué es el producto antes de ver sus integraciones
- **Presentación mejorada**: Logo más prominente y sin elementos visuales distractores

## Implementation Notes

### Restricciones Técnicas
- **NO usar build tools** - Vanilla PHP únicamente
- **Mantener modularidad** - Conservar estructura de componentes existente
- **Reutilizar assets** - No crear nuevas dependencias
- **Documentación en español** - Todos los comentarios y documentación deben estar en español

### Patrones a Seguir
- Usar template system existente (`tango-product-template.php`)
- Mantener responsive design con Bootstrap 5
- Conservar efectos AOS (animate on scroll)
- Utilizar configuración centralizada (`config.php`)

### Modificaciones Específicas
1. **Header**: Aumentar tamaño del logo y background
2. **Partners**: Remover efectos de sombra en las imágenes
3. **Orden**: Reorganizar llamadas a componentes en `$custom_content`
4. **Template**: Ajustar posicionamiento de secciones

## Context

### Beginning Context - Archivos Existentes
```
webSyS/
├── tango-gestion.php (configuración y orden actual)
├── templates/tango-product-template.php (template genérico)
├── includes/components/
│   ├── partners-slider.php (integraciones)
│   ├── card-hover-2.php (conectividad)
│   ├── video-embed.php (video embebido)
│   └── reportes-slider.php (tango reportes)
├── config/config.php (datos centralizados)
└── assets/css/sys_style.css (estilos existentes)
```

### Ending Context - Archivos Modificados
```
webSyS/
├── tango-gestion.php (nuevo orden de componentes)
├── templates/tango-product-template.php (header mejorado - OPCIONAL)
├── includes/components/
│   └── partners-slider.php (sin sombras en imágenes)
└── assets/css/sys_style.css (ajustes de logo - OPCIONAL)
```

## Low-Level Tasks

### 1. Reordenar componentes en tango-gestion.php

**Action: MODIFY**
**File**: `webSyS/tango-gestion.php`
**Changes**: Reorganizar las llamadas a componentes en la variable `$custom_content`

```php
// Cambiar el orden de líneas 105-108:
// ACTUAL: $partners_slider_content + $connectivity_content + $video_content + $reportes_content
// NUEVO: $video_content + $reportes_content + $connectivity_content (sin partners en custom_content)
```

**Validation**:
```bash
php -l webSyS/tango-gestion.php
curl -s http://localhost/tango-gestion.php | grep -o "<section" | wc -l
```

### 2. Remover sombras de imágenes en partners-slider

**Action: MODIFY**
**File**: `webSyS/includes/components/partners-slider.php`
**Changes**: Eliminar clases de sombra en las imágenes de partners

```php
// Línea ~33: Remover clases shadow o efectos visuales de las imágenes
// Cambiar: class="img-fluid shadow-lg"
// Por: class="img-fluid"
```

**Validation**:
```bash
php -l webSyS/includes/components/partners-slider.php
grep -n "shadow" webSyS/includes/components/partners-slider.php
```

### 3. Mover partners-slider después de módulos

**Action: MODIFY** 
**File**: `webSyS/tango-gestion.php`
**Changes**: Colocar el partners slider después de los módulos y antes del video

```php
// Remover $partners_slider_content de $custom_content (línea 105)
// Crear variable $partners_after_modules para insertar en template
// Modificar template para renderizar partners después de módulos
```

**Validation**:
```bash
php -l webSyS/tango-gestion.php  
curl -s http://localhost/tango-gestion.php | grep -A5 -B5 "mejores software"
```

### 4. Ajustar posicionamiento en template (OPCIONAL)

**Action: MODIFY**
**File**: `webSyS/templates/tango-product-template.php` 
**Changes**: Crear insertion point para partners después de módulos

```php
// Después de línea 135 (end: Módulos), agregar:
<?php if (isset($partners_after_modules)): ?>
    <?= $partners_after_modules ?>
<?php endif; ?>
```

**Validation**:
```bash
php -l webSyS/templates/tango-product-template.php
curl -s http://localhost/tango-gestion.php | grep -o "<h2.*Integrado" 
```

### 5. Mejorar header de producto (OPCIONAL - ENHANCEMENT)

**Action: MODIFY**
**File**: `webSyS/templates/tango-product-template.php`
**Changes**: Aumentar prominencia del logo en el header

```php
// Línea 70-74: Aumentar tamaño de logo
// Agregar clases para logo más grande: class="img-fluid mx-auto" style="max-height: 150px"
```

**Validation**:
```bash
php -l webSyS/templates/tango-product-template.php
curl -s http://localhost/tango-gestion.php | grep -o 'max-height.*150px'
```

### 6. Testing de orden final

**Action: VALIDATE**
**Changes**: Verificar que el nuevo orden se muestra correctamente

```bash
# Test del orden visual correcto
curl -s http://localhost/tango-gestion.php > test_output.html
grep -n -A2 -B2 "solución para la gestión\|Módulos y Funcionalidades\|mejores software\|Gestión integrado\|TANGO REPORTES\|Conectividad total\|nuestros productos" test_output.html
```

**Expected Order**:
1. "solución para la gestión" (introducción)
2. "Módulos y Funcionalidades" 
3. "mejores software" (partners)
4. "Gestión integrado" (video)
5. "TANGO REPORTES"
6. "Conectividad total"
7. "nuestros productos"

## Implementation Strategy

### Phase 1: Core Reorganization (Required)
1. Reorder components in `tango-gestion.php` 
2. Remove shadow effects from partners images
3. Move partners slider to correct position

### Phase 2: Template Enhancement (Optional)
4. Add insertion point in template for proper positioning
5. Enhance header logo prominence

### Dependencies Logic
- Task 1 → Task 3 (need to remove from custom_content before repositioning)
- Task 2 → Independent (can run parallel)
- Task 4 → Task 3 (template needs to support new positioning)
- Task 5 → Independent (visual enhancement)

### Risk Mitigation
- **Backup files** before modification
- **Test syntax** after each change
- **Validate visual order** with curl/grep commands
- **Rollback plan**: Git revert to previous state

## Validation Gates

### Level 1: Syntax & Structure
```bash
# Verificar sintaxis PHP
php -l webSyS/tango-gestion.php
php -l webSyS/templates/tango-product-template.php
php -l webSyS/includes/components/partners-slider.php

# Verificar que archivos existen
ls -la webSyS/tango-gestion.php webSyS/templates/tango-product-template.php
```

### Level 2: Content Order Validation  
```bash
# Probar página local y verificar orden de secciones
curl -s http://localhost/tango-gestion.php > output.html
grep -n -E "(solución para la gestión|Módulos y Funcionalidades|mejores software|Gestión integrado|TANGO REPORTES|Conectividad total|nuestros productos)" output.html

# Verificar que no hay sombras en partners
curl -s http://localhost/tango-gestion.php | grep -v "shadow.*partners"
```

### Level 3: Visual Validation
```bash
# Verificar que el sitio carga sin errores
curl -I http://localhost/tango-gestion.php
curl -s http://localhost/tango-gestion.php | grep -c "<section"

# Validar responsive design se mantiene
curl -s -H "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 13_0 like Mac OS X)" http://localhost/tango-gestion.php > mobile_test.html
```

### Level 4: Integration Test
```bash
# Verificar que otros productos Tango no se ven afectados
curl -I http://localhost/tango-punto-de-venta.php
curl -I http://localhost/tango-estudios-contables.php

# Test completo de navegación
curl -s http://localhost/tango-gestion.php | grep -c "href.*tango-" 
```

## Quality Checklist

- [ ] Current state fully documented with file analysis
- [ ] Desired state clearly defined with specific order
- [ ] All objectives measurable with curl/grep commands  
- [ ] Tasks ordered by dependency logic
- [ ] Each task has validation commands AI can execute
- [ ] Risks identified (syntax errors, broken template, visual issues)
- [ ] Rollback strategy included (Git revert)
- [ ] Integration points noted (template system, component architecture)
- [ ] No new dependencies introduced (vanilla PHP constraint)
- [ ] Spanish documentation maintained

## Success Criteria

✅ **Functional Success**
- All existing functionality preserved
- No broken links or PHP errors
- Template system remains modular

✅ **Visual Success** 
- New section order matches requirements (1-8)
- Partners integration images have no shadows
- Logo appears more prominently 

✅ **User Experience Success**
- Information flows logically from introduction to call-to-action
- Page loads within acceptable time
- Responsive design maintained across devices

Remember: Focus on the transformation journey with clear validation gates. The goal is improving user flow while maintaining technical robustness.