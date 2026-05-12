# 🚀 Instrucciones de Despliegue Seguro

## ⚠️ IMPORTANTE - PROTECCIÓN DEL E-COMMERCE

Este repositorio está configurado para **NO TOCAR** las siguientes carpetas/archivos en cPanel:

### 🚫 CARPETAS PROTEGIDAS (NO se despliegan):
- `ecommerce/` - E-commerce existente
- `php/` - Scripts específicos del servidor  
- `Mpago/` - Integración con Mercado Pago
- `sysdesk/` - Sistema de tickets
- `soporte/` - Sistema de soporte
- `pruebagit/` - Carpeta de pruebas
- `phpspreadsheet/` - Librería de Excel
- `pdfclientes/` - PDFs de clientes
- `pdfproveedores/` - PDFs de proveedores
- `photos/` - Fotos del sistema
- `fondos/` - Archivos de fondos
- `mpdf/` - Librería de PDF

### 📁 ARCHIVOS QUE SÍ SE DESPLIEGAN:
- `index.php` y todas las páginas principales
- `gestion-it.php` (nueva página)
- `datacenter.php`
- `tango-*.php` (productos)
- `assets/` (CSS, JS, imágenes)
- `includes/` (componentes)
- `templates/` (plantillas)
- `config/` (configuraciones)

## 🔧 Configuración de Secrets en GitHub

Para que funcione el auto-deploy, configurá estos secrets en tu repo:

1. Ve a **Settings → Secrets and variables → Actions**
2. Agregar:
```
FTP_HOST: tu-dominio.com
FTP_USERNAME: tu-usuario-cpanel  
FTP_PASSWORD: tu-contraseña-cpanel
```

## 🚀 Proceso de Deploy

El workflow de GitHub Actions está en **la raíz del repositorio** (no dentro de `webSyS`): [`.github/workflows/deploy-cpanel.yml`](../.github/workflows/deploy-cpanel.yml). Solo sube el contenido de `webSyS/` a `/public_html/` por FTP.

1. **Hacer cambios** en el código local
2. **Commit y push** a la rama `main`:
   ```bash
   git add .
   git commit -m "Descripción del cambio"
   git push origin main
   ```
3. **GitHub Actions** se ejecuta automáticamente
4. **Solo se actualizan** los archivos del sitio web
5. **E-commerce queda intacto** ✅

## 🛡️ Seguridad

- ✅ `.gitignore` protege archivos sensibles
- ✅ GitHub Actions excluye carpetas del e-commerce
- ✅ `.cpanel.yml` hace backup antes del deploy
- ✅ Solo archivos específicos se sincronizan

## 🔍 Verificación Post-Deploy

Después de cada deploy, verificar:
1. ✅ Sitio web principal funciona
2. ✅ E-commerce sigue funcionando  
3. ✅ Formularios de contacto funcionan
4. ✅ Todas las páginas cargan correctamente

## 🆘 En Caso de Problemas

Si algo sale mal:
1. **Verificar logs** en cPanel
2. **Restaurar backup** si es necesario
3. **Contactar** al equipo de desarrollo

---
**Última actualización:** $(date)
