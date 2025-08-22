# CONFIGURACIÓN DE EMAILJS PARA DATACENTER

## 🚀 **EmailJS - Solución Confiable y Gratuita**

EmailJS permite enviar emails directamente desde el frontend sin necesidad de servidor backend.

### **1. Crear cuenta en EmailJS**
1. Ir a [https://www.emailjs.com](https://www.emailjs.com)
2. Hacer clic en "Sign Up" 
3. Crear cuenta gratuita (200 emails/mes)
4. Verificar email

### **2. Configurar servicio de email**
1. En el dashboard, ir a "Email Services"
2. Hacer clic en "Add New Service"
3. Elegir tu proveedor de email:
   - **Gmail** (recomendado para empezar)
   - **Outlook/Hotmail**
   - **Yahoo**
   - **Otros**

#### **Para Gmail:**
1. Seleccionar "Gmail"
2. Conectar con tu cuenta `daniel@serviciosysistemas.com.ar`
3. Autorizar EmailJS
4. Copiar el **Service ID** (ejemplo: `service_gmail123`)

### **3. Crear template de email**
1. Ir a "Email Templates"
2. Hacer clic en "Create New Template"
3. Usar este contenido:

**Asunto del email:**
```
Nueva consulta DATACENTER - {{asunto}} - {{nombre}}
```

**Contenido del email:**
```
NUEVA CONSULTA - DATACENTER
============================

Datos del Contacto:
- Nombre: {{nombre}}
- Email: {{email}}
- Teléfono: {{telefono}}
- Empresa: {{empresa}}
- Puesto/Cargo: {{puesto}}
- Asunto: {{asunto}}
- ¿Cómo se enteró?: {{como_se_entero}}

Mensaje:
{{mensaje}}

============================
Fecha: {{fecha}}
Origen: {{ip_info}}

---
Este email fue enviado desde el formulario de contacto del sitio web.
Para responder, usa el email: {{email}}
```

4. **Configurar destinatario:**
   - To Email: `daniel@serviciosysistemas.com.ar`
   - From Name: `{{nombre}}`
   - Reply To: `{{email}}`

5. Copiar el **Template ID** (ejemplo: `template_abc123`)

### **4. Configurar auto-respuesta (opcional)**
1. Crear segundo template para auto-respuesta al cliente
2. Asunto: `Consulta recibida - Servicios y Sistemas`
3. Contenido:
```
Hola {{nombre}},

¡Gracias por contactarte con Servicios y Sistemas!

Hemos recibido tu consulta sobre {{asunto}} y nos pondremos en contacto contigo en las próximas 24 horas hábiles.

Datos de tu consulta:
- Asunto: {{asunto}}
- Empresa: {{empresa}}
- Fecha: {{fecha}}

Si tenés alguna consulta urgente, podés contactarnos directamente:
- Teléfono: +54 3794 426022
- Email: info@serviciosysistemas.com.ar

Saludos cordiales,
Equipo de Servicios y Sistemas
```

### **5. Obtener credenciales**
1. Ir a "Account" → "General"
2. Copiar tu **User ID** (ejemplo: `user_abc123xyz`)

### **6. Actualizar datacenter.php**
En el archivo `datacenter.php`, reemplazar estos valores:

```javascript
// Línea ~15 del script
emailjs.init("YOUR_USER_ID");

// Línea ~35 del script  
emailjs.send("YOUR_SERVICE_ID", "YOUR_TEMPLATE_ID", formData)
```

**Por tus valores reales:**
```javascript
emailjs.init("user_abc123xyz");
emailjs.send("service_gmail123", "template_abc123", formData)
```

### **7. Template completo para actualizar**
```javascript
// Inicializar EmailJS
emailjs.init("TU_USER_ID_REAL");

// En la función send
emailjs.send("TU_SERVICE_ID_REAL", "TU_TEMPLATE_ID_REAL", formData)
```

### **8. Agregar auto-respuesta (opcional)**
Si creaste template de auto-respuesta, agregar después del primer envío:
```javascript
// Envío principal
emailjs.send("service_gmail123", "template_consulta", formData)
.then(function(response) {
    // Auto-respuesta al cliente
    emailjs.send("service_gmail123", "template_autorespuesta", formData);
    
    alert('¡Gracias por tu consulta! Te hemos enviado una confirmación por email.');
    // ... resto del código
});
```

### **9. Ventajas de EmailJS:**
✅ **100% Frontend** - No necesitas backend ni PHP
✅ **Confiable** - 99.9% uptime
✅ **Gratuito** - 200 emails/mes
✅ **Fácil configuración** - Solo cambiar 3 valores
✅ **Antispam** - Protección integrada
✅ **Dashboard** - Ver estadísticas de envíos
✅ **Auto-respuestas** - Respuestas automáticas
✅ **Sin límites** - Funciona en cualquier hosting

### **10. Límites del plan gratuito:**
- **200 emails/mes**
- **2 servicios de email**
- **3 templates**
- **Soporte por email**

Si necesitas más, el plan premium es $15/mes por 1000 emails.

### **11. Alternativa si no funciona Gmail:**
Si Gmail te da problemas, usar **Outlook/Hotmail:**
1. Crear cuenta `@outlook.com` o `@hotmail.com`
2. Conectar con EmailJS
3. Configurar redirección a `daniel@serviciosysistemas.com.ar`

---

## ⚠️ **ACCIÓN REQUERIDA:**
1. **Crear cuenta en EmailJS**
2. **Configurar servicio Gmail**
3. **Crear template de email**
4. **Copiar User ID, Service ID y Template ID**
5. **Actualizar datacenter.php con los valores reales**

---

## 🔧 **OPCIÓN ALTERNATIVA 2: PHP Simple**

Si EmailJS no funciona, también preparé una versión PHP simple que funciona en cualquier servidor:

### **Archivo: `enviar-datacenter.php`**
```php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'daniel@serviciosysistemas.com.ar';
    $subject = 'Consulta Datacenter - ' . $_POST['asunto'] . ' - ' . $_POST['nombre'];
    
    $message = "NUEVA CONSULTA DATACENTER\n\n";
    $message .= "Nombre: " . $_POST['nombre'] . "\n";
    $message .= "Email: " . $_POST['email'] . "\n";
    $message .= "Teléfono: " . $_POST['telefono'] . "\n";
    $message .= "Empresa: " . $_POST['empresa'] . "\n";
    $message .= "Asunto: " . $_POST['asunto'] . "\n";
    $message .= "Mensaje: " . $_POST['mensaje'] . "\n";
    $message .= "Se enteró por: " . $_POST['como_se_entero'] . "\n";
    $message .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
    
    $headers = "From: noreply@serviciosysistemas.com.ar\r\n";
    $headers .= "Reply-To: " . $_POST['email'] . "\r\n";
    
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
```

**Cambiar en datacenter.php:**
```html
<form action="enviar-datacenter.php" method="POST">
```

---

## 🎯 **RECOMENDACIÓN:**
**Usar EmailJS** porque es más confiable y no depende de la configuración del servidor. 