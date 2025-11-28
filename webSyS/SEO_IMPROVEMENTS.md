# Mejoras SEO e Indexación para IA - Implementadas

## Resumen de Cambios

Se han implementado mejoras completas de SEO y optimización para indexación por modelos de IA (GPT, Claude, Gemini) en el sitio web de Servicios y Sistemas.

## Archivos Nuevos Creados

### 1. robots.txt
**Ubicación:** `webSyS/robots.txt`

Archivo de control de indexación con:
- Reglas para permitir indexación completa
- Protección de directorios privados (/private/, /config/, /includes/)
- Permisos explícitos para bots de IA: GPTBot, CCBot, anthropic-ai, Google-Extended
- Referencia al sitemap dinámico

**Verificar:**
```
http://localhost:8000/robots.txt
https://serviciosysistemas.com.ar/robots.txt
```

### 2. sitemap.php
**Ubicación:** `webSyS/sitemap.php`

Sitemap XML dinámico que incluye:
- Página principal (prioridad 1.0)
- 6 páginas de productos Tango (prioridad 0.9)
- 2 páginas de servicios (prioridad 0.8)
- Fechas de última modificación automáticas
- Frecuencias de actualización apropiadas

**Verificar:**
```
http://localhost:8000/sitemap.php
https://serviciosysistemas.com.ar/sitemap.php
```

**Enviar a Google Search Console:**
1. Ir a Google Search Console
2. Sitemaps → Agregar sitemap
3. URL: https://serviciosysistemas.com.ar/sitemap.php

## Archivos Modificados

### 1. includes/functions.php
**Funciones agregadas:**

#### generateProductSchema($product)
- Schema para productos Tango Software
- Tipo: SoftwareApplication
- Incluye: name, description, brand, offers, provider
- Precio: "Consultar precio" (configurable)

#### generateServiceSchema($service_name, $description, $service_type)
- Schema para servicios (Datacenter, Gestión IT)
- Tipo: Service
- Incluye: provider, areaServed, hasOfferCatalog

#### generateFAQSchema($faqs)
- Schema para preguntas frecuentes
- Tipo: FAQPage
- Permite a Google mostrar FAQs en resultados de búsqueda

#### generateBreadcrumbSchema($items)
- Schema para navegación breadcrumb
- Tipo: BreadcrumbList
- Mejora navegación en resultados de búsqueda

#### generateLocalBusinessSchema() - MEJORADA
- Horario de atención actualizado: 8:00-13:00 y 16:00-20:00 (L-V)
- Instagram agregado: https://www.instagram.com/hardstore.ctes
- Email y precio agregados
- Geolocalización precisa para Corrientes

### 2. includes/head.php
**Mejoras implementadas:**

#### Meta tags para robots e IA
```php
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
```

#### Open Graph mejorado
- `og:url` ahora usa canonical URL
- `og:image` dinámico por página
- `og:image:width` y `og:image:height` agregados
- `og:locale` agregado (es_AR)

#### Soporte para múltiples schemas
- Maneja un solo schema
- Maneja array de múltiples schemas (ej: LocalBusiness + FAQ)
- Soporte para schema como array o string (legacy)

### 3. index.php
**Cambios:**
- Meta description completa agregada
- Meta keywords agregados
- Canonical URL definida
- Schema LocalBusiness mejorado
- Schema FAQPage agregado (6 preguntas frecuentes)

**Verificar schema:**
- Google Rich Results Test: https://search.google.com/test/rich-results
- Schema.org Validator: https://validator.schema.org/

### 4. datacenter.php - REFACTORIZADO
**Antes:** Head HTML manual
**Ahora:** Usa `includes/head.php` con variables

**Cambios:**
- Variables de meta tags definidas
- Schema de Service agregado
- Meta keywords específicos
- Canonical URL definida

### 5. gestion-it.php - REFACTORIZADO
**Antes:** Head HTML manual
**Ahora:** Usa `includes/head.php` con variables

**Cambios:**
- Variables de meta tags definidas
- Schema de Service agregado
- Meta keywords específicos
- Canonical URL definida

### 6. tango-delta.php
**Cambios:**
- Usa función unificada `generateProductSchema()`
- Meta keywords agregados
- Schema mejorado con información completa

### 7. templates/tango-product-template.php
**Cambios:**
- Usa función unificada `generateProductSchema()`
- Meta keywords agregados
- Aplica a todos los productos Tango que usan este template:
  - Tango Gestión
  - Tango Punto de Venta
  - Tango Estudios Contables
  - Tango Restô
  - Tango Capital Humano

## Información Configurada

### Datos de la empresa
- **Horario:** Lunes a Viernes 8:00-13:00 y 16:00-20:00
- **Instagram:** https://www.instagram.com/hardstore.ctes
- **Código Postal:** 3400 (Corrientes)
- **Geolocalización:** -27.4692, -58.8306

### SEO por página
Todas las páginas ahora tienen:
- Título único y descriptivo
- Meta description específica (150-160 caracteres)
- Meta keywords relevantes
- Canonical URL
- Schema markup apropiado

## Verificación y Testing

### 1. Verificar robots.txt
```bash
curl http://localhost:8000/robots.txt
```

### 2. Verificar sitemap.php
```bash
curl http://localhost:8000/sitemap.php
```

### 3. Verificar Schema Markup
**Herramientas recomendadas:**
1. **Google Rich Results Test**
   - URL: https://search.google.com/test/rich-results
   - Probar cada página del sitio

2. **Schema Markup Validator**
   - URL: https://validator.schema.org/
   - Pegar el código fuente HTML de cada página

3. **Google Search Console**
   - Enhancements → revisar errores de schema
   - Sitemaps → verificar que sitemap.php esté indexado

### 4. Verificar Open Graph
**Herramientas:**
1. **Facebook Sharing Debugger**
   - URL: https://developers.facebook.com/tools/debug/
   - Verificar preview de cada página

2. **Twitter Card Validator**
   - URL: https://cards-dev.twitter.com/validator
   - Verificar preview de cada página

### 5. Verificar Meta Tags
Ver código fuente de cada página y verificar:
- `<title>` único y descriptivo
- `<meta name="description">` presente
- `<meta name="keywords">` presente
- `<link rel="canonical">` presente
- Meta tags Open Graph completos
- Meta tags para robots e IA

## Páginas Optimizadas

### ✅ Página Principal (index.php)
- Schema: LocalBusiness + FAQPage
- 6 FAQs indexadas
- Meta tags completos

### ✅ Tango Delta 5 (tango-delta.php)
- Schema: SoftwareApplication
- Meta tags específicos

### ✅ Productos Tango (vía template)
- tango-gestion.php
- tango-punto-de-venta.php
- tango-estudios-contables.php
- tango-resto.php
- tango-capital-humano.php
- Schema: SoftwareApplication (cada uno)

### ✅ Servicios
- datacenter.php - Schema: Service (HostingService)
- gestion-it.php - Schema: Service (TechnologyService)

## Próximos Pasos Recomendados

### 1. Configuración en Google
1. **Google Search Console**
   - Enviar sitemap: sitemap.php
   - Verificar indexación
   - Revisar errores de schema

2. **Google Business Profile**
   - Actualizar horarios de atención
   - Agregar enlaces a redes sociales
   - Sincronizar con schema LocalBusiness

### 2. Redes Sociales
Cuando tengas URLs de Facebook y LinkedIn, agregarlas en:
- `includes/functions.php` → `generateLocalBusinessSchema()` → array `sameAs`

### 3. Imágenes Open Graph
Crear imágenes optimizadas para compartir (1200x630px):
- Una por cada producto Tango
- Una para servicios (Datacenter, Gestión IT)
- Actualizar variables `$og_image` en cada página

### 4. Monitoreo
- Configurar Google Analytics 4
- Configurar Google Tag Manager
- Monitorear posicionamiento en Search Console
- Revisar Core Web Vitals

## Indexación por IA

### Bots permitidos
- **GPTBot** (OpenAI) - Para ChatGPT
- **CCBot** (Anthropic) - Para Claude
- **anthropic-ai** - Para Claude
- **Google-Extended** - Para entrenamiento de IA de Google
- **Googlebot** - Para Google Search
- **Bingbot** - Para Bing Search

### Verificar indexación
Las IAs pueden tardar semanas/meses en indexar. Para verificar:
1. Preguntar a ChatGPT sobre "Servicios y Sistemas Corrientes"
2. Preguntar a Claude sobre "Tango Software en Corrientes"
3. Verificar en Bing Chat / Copilot

## Soporte

Para más información sobre las mejoras implementadas:
- Ver código en: `includes/functions.php`
- Ver configuración en: `includes/head.php`
- Ver robots.txt y sitemap.php

## Resultados Esperados

### Corto Plazo (1-2 semanas)
- Sitemap indexado en Google
- Rich snippets en resultados de búsqueda
- FAQs visibles en Google

### Mediano Plazo (1-3 meses)
- Mejora en posicionamiento local
- Más tráfico orgánico
- Mejor CTR en resultados

### Largo Plazo (3-6 meses)
- Indexación por modelos de IA
- Posicionamiento top en búsquedas locales
- Autoridad de dominio mejorada

