# 📧 OPCIONES PARA FORMULARIO DE CONTACTO DATACENTER

Como Formspree no funciona, aquí tenés **3 opciones confiables** para elegir:

## 🥇 **OPCIÓN 1: EmailJS (RECOMENDADA)**

**✅ Ventajas:**
- 100% frontend, no necesita servidor
- Muy confiable (99.9% uptime)
- 200 emails gratis/mes
- Fácil configuración (solo 3 valores)
- Dashboard para ver estadísticas

**📝 Configuración:**
1. Crear cuenta en [emailjs.com](https://emailjs.com)
2. Conectar Gmail con `daniel@serviciosysistemas.com.ar`
3. Crear template de email
4. Copiar: User ID, Service ID, Template ID
5. Actualizar en `datacenter.php`

**📄 Instrucciones completas:** `CONFIGURACION_EMAILJS.md`

---

## 🥈 **OPCIÓN 2: PHP Simple (BACKUP)**

**✅ Ventajas:**
- Funciona en cualquier servidor con PHP
- No depende de servicios externos
- Control total sobre el proceso
- Auto-respuesta incluida

**📝 Configuración:**
1. Ya está creado el archivo `enviar-datacenter.php`
2. Cambiar en `datacenter.php`:
```html
<form action="enviar-datacenter.php" method="POST">
```
3. Actualizar JavaScript para usar fetch con PHP

**🔧 Para activar esta opción:**
```javascript
// Cambiar el envío por:
fetch('enviar-datacenter.php', {
    method: 'POST',
    body: new FormData(this)
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        alert(data.mensaje);
        this.reset();
        setTimeout(() => window.location.href = 'gracias.html', 1500);
    } else {
        alert(data.error);
    }
});
```

---

## 🥉 **OPCIÓN 3: Contact Form 7 (WordPress)**

**Si el sitio fuera WordPress:**
- Plugin Contact Form 7
- Muy confiable y usado mundialmente
- Integración perfecta con WordPress

---

## 🆘 **OPCIÓN 4: Mailto (EMERGENCIA)**

**Para casos extremos:**
```html
<a href="mailto:daniel@serviciosysistemas.com.ar?subject=Consulta Datacenter&body=Nombre:%0D%0AEmail:%0D%0AEmpresa:%0D%0AMensaje:">
    Enviar Email
</a>
```

---

## 🎯 **MI RECOMENDACIÓN:**

### **1. Probar EmailJS primero**
- Es la solución más moderna y confiable
- No depende del servidor
- Muy fácil de configurar

### **2. Si EmailJS falla, usar PHP**
- Ya tenés el archivo `enviar-datacenter.php` listo
- Solo cambiar 2 líneas en `datacenter.php`

---

## 🔧 **IMPLEMENTACIÓN RÁPIDA**

### **Para EmailJS:**
1. Seguir `CONFIGURACION_EMAILJS.md`
2. Cambiar 3 valores en `datacenter.php`
3. ¡Listo!

### **Para PHP:**
1. En `datacenter.php` cambiar:
```html
<!-- Línea ~XX -->
<form action="enviar-datacenter.php" method="POST" id="datacenterForm">

<!-- Y cambiar el JavaScript por: -->
<script>
document.getElementById('datacenterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>ENVIANDO...';
    submitBtn.disabled = true;
    
    fetch('enviar-datacenter.php', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.mensaje);
            this.reset();
            setTimeout(() => window.location.href = 'gracias.html', 1500);
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        alert('Error al enviar. Contactanos al +54 3794 426022');
    })
    .finally(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});
</script>
```

---

## ❓ **¿Cuál elegir?**

- **¿Querés algo moderno y sin complicaciones?** → **EmailJS**
- **¿Preferís control total y no depender de terceros?** → **PHP**
- **¿Querés algo que funcione YA sin configurar nada?** → **PHP**

**Ambas opciones están listas para usar. Solo elegí una y seguí las instrucciones.**

---

## 📞 **Soporte:**
Si necesitás ayuda con cualquiera de estas opciones, consultame y te ayudo paso a paso. 