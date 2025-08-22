		<!-- Favicon -->
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        
		<!-- Box Icons -->
        <link rel="stylesheet" href="assets/fonts/boxicons/css/boxicons.min.css">
        
		<!-- Flaticon Icons -->
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
        
		<!-- AOS Animations - CDN -->
        <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
        
		<!-- Iconsmind Icons -->
        <link rel="stylesheet" href="assets/fonts/iconsmind/iconsmind.css">
        
		<!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:ital@0;1&display=swap" rel="stylesheet">
        
		<!-- Swiper Slider - CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
        
		<!-- Prism.js para resaltado de código - CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
        <!-- Main CSS -->
        <link href="assets/css/sys_style.css" rel="stylesheet">
        <link href="assets/css/modules/dark-mode.css" rel="stylesheet">
        
        <!-- Script inline para aplicar tema inmediatamente -->
        <script>
            (function() {
                'use strict';
                
                // Función para obtener el tema del sistema
                const getSystemTheme = () => {
                    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                };
                
                // Aplicar tema inmediatamente
                const theme = getSystemTheme();
                document.documentElement.setAttribute('data-bs-theme', theme);
                document.documentElement.style.colorScheme = theme;
                

                
                // Asegurar que el body tenga las clases correctas
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark-mode');
                } else {
                    document.documentElement.classList.add('light-mode');
                }
                
            })();
        </script>