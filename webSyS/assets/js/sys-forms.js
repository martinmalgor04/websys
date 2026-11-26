/**
 * Funciones reutilizables para formularios
 * Servicios y Sistemas SRL
 * 
 * Proporciona funcionalidad unificada para el manejo de formularios
 * Compatible con EmailJS y endpoints PHP
 */

const SysFormHandler = {
    /**
     * Configuración por defecto para todos los formularios
     */
    config: {
        loadingText: '<i class="bx bx-loader-alt bx-spin me-2"></i>ENVIANDO...',
        successMessage: '¡Gracias por tu consulta! Nos pondremos en contacto pronto.',
        errorMessage: 'Error al enviar. Por favor, intentá nuevamente.',
        redirectDelay: 1500
    },

    /**
     * Inicializar manejador de formulario con EmailJS
     * @param {string} formId - ID del formulario HTML
     * @param {object} emailConfig - Configuración de EmailJS {serviceId, templateId, successRedirect}
     */
    initEmailJS: function(formId, emailConfig) {
        const form = document.getElementById(formId);
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Mostrar estado de carga
            submitBtn.innerHTML = SysFormHandler.config.loadingText;
            submitBtn.disabled = true;
            
            // Preparar datos
            const formData = SysFormHandler.getFormData(this);
            
            // Enviar con EmailJS
            emailjs.send(emailConfig.serviceId, emailConfig.templateId, formData)
                .then(function(response) {
                    SysFormHandler.handleSuccess(form, emailConfig.successRedirect);
                }, function(error) {
                    SysFormHandler.handleError(error);
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        });
    },

    /**
     * Inicializar manejador de formulario con PHP
     * @param {string} formId - ID del formulario HTML
     * @param {string} endpoint - URL del endpoint PHP para procesar el formulario
     * @param {string} successRedirect - URL de redirección tras envío exitoso
     */
    initPHP: function(formId, endpoint, successRedirect) {
        const form = document.getElementById(formId);
        if (!form || form.dataset.sysFormInitialized === 'true') return;
        form.dataset.sysFormInitialized = 'true';

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Mostrar estado de carga
            submitBtn.innerHTML = SysFormHandler.config.loadingText;
            submitBtn.disabled = true;
            
            // Enviar formulario
            fetch(endpoint, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => SysFormHandler.parseResponse(response))
            .then(data => {
                SysFormHandler.handleSuccess(form, successRedirect, data.mensaje);
            })
            .catch(error => {
                SysFormHandler.handleError(error, form);
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    },

    /**
     * Leer la respuesta JSON del endpoint PHP.
     * Si el servidor responde HTML (error 500, límite del hosting, etc.) se usa
     * el mensaje genérico en lugar del error de parseo del navegador.
     */
    parseResponse: async function(response) {
        let data = null;
        try {
            data = await response.json();
        } catch (parseError) {
            data = null;
        }

        if (!response.ok || !data || !data.success) {
            const error = new Error((data && data.error) || SysFormHandler.config.errorMessage);
            error.status = response.status;
            error.fromServer = true;
            throw error;
        }

        return data;
    },

    /**
     * Obtener datos del formulario como objeto
     */
    getFormData: function(form) {
        const formData = new FormData(form);
        const data = {
            fecha: new Date().toLocaleString('es-AR'),
            ip_info: 'Desde sitio web'
        };
        
        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }
        
        return data;
    },

    /**
     * Manejar respuesta exitosa
     */
    handleSuccess: function(form, redirectUrl, customMessage) {
        const message = customMessage || this.config.successMessage;
        
        // Mostrar mensaje de éxito
        if (!this.showInlineMessage(form, 'success', message) && typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: '¡Enviado!',
                text: message,
                timer: 3000,
                showConfirmButton: false
            });
        } else if (!form.querySelector('#success-message')) {
            alert(message);
        }
        
        // Limpiar formulario
        form.reset();
        
        // Redireccionar si se especifica
        if (redirectUrl) {
            setTimeout(() => {
                window.location.href = redirectUrl;
            }, this.config.redirectDelay);
        }
    },

    /**
     * Texto que se le muestra al visitante ante un error.
     * Solo se confía en los mensajes propios (string) o en los que vienen del
     * endpoint; los errores del navegador ("Failed to fetch", etc.) se
     * reemplazan por el mensaje genérico.
     */
    getErrorMessage: function(error) {
        if (typeof error === 'string' && error) {
            return error;
        }
        if (error && error.fromServer && error.message) {
            return error.message;
        }
        return this.config.errorMessage;
    },

    /**
     * Manejar errores
     */
    handleError: function(error, form = null) {
        console.error('Error:', error);
        
        const message = this.getErrorMessage(error);
        const type = error && error.status === 429 ? 'rate-limit' : 'error';

        if (form && this.showInlineMessage(form, type, message)) {
            return;
        }
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
                footer: '<a href="tel:+543794426022">Contactanos al +54 3794 426022</a>'
            });
        } else {
            alert(message + '\n\nContactanos al +54 3794 426022');
        }
    },

    /**
     * Mostrar mensajes dentro del formulario cuando existen sus contenedores.
     */
    showInlineMessage: function(form, type, message) {
        const messages = form.querySelector('#form-messages');
        const success = form.querySelector('#success-message');
        const error = form.querySelector('#error-message');
        const rateLimit = form.querySelector('#rate-limit-message');

        if (!messages || !success || !error || !rateLimit) {
            return false;
        }

        success.style.display = 'none';
        error.style.display = 'none';
        rateLimit.style.display = 'none';
        messages.style.display = 'block';

        const target = type === 'success' ? success : (type === 'rate-limit' ? rateLimit : error);
        const text = target.querySelector('span');
        if (text && type !== 'rate-limit') {
            text.textContent = message;
        }
        target.style.display = 'block';
        messages.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        return true;
    },

    /**
     * Validar email
     */
    validateEmail: function(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    },

    /**
     * Validar formulario completo
     */
    validateForm: function(formId) {
        const form = document.getElementById(formId);
        if (!form) return false;
        
        let isValid = true;
        
        // Validar campos requeridos
        form.querySelectorAll('[required]').forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Validar emails
        form.querySelectorAll('input[type="email"]').forEach(field => {
            if (field.value && !this.validateEmail(field.value)) {
                isValid = false;
                field.classList.add('is-invalid');
            }
        });
        
        return isValid;
    }
}; 

if (typeof module !== 'undefined' && module.exports) {
    module.exports = SysFormHandler;
}
