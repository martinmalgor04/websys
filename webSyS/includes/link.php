		<!-- Favicon -->
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        
		<!-- Box Icons -->
        <link rel="preload" href="assets/fonts/boxicons/css/boxicons.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="assets/fonts/boxicons/css/boxicons.min.css">
        </noscript>
        <link rel="preload" href="assets/fonts/boxicons/fonts/boxicons.woff2" as="font" type="font/woff2" crossorigin>
        
		<!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:ital@0;1&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:ital@0;1&display=swap" rel="stylesheet">
        </noscript>
        
		<!-- Swiper Slider - CDN -->
        <link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
        </noscript>
        
        <!-- Main CSS -->
        <link href="assets/css/sys_style.min.css" rel="stylesheet">
        <link rel="preload" href="assets/css/modules/dark-mode.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link href="assets/css/modules/dark-mode.css" rel="stylesheet">
        </noscript>
        
        <!-- Product card styling -->
        <link rel="preload" href="assets/css/product-cards.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link href="assets/css/product-cards.css" rel="stylesheet">
        </noscript>

		<!-- AOS Animations - CDN (no crítico para first paint) -->
        <link rel="preconnect" href="https://unpkg.com" crossorigin>
        <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
        </noscript>

        <!-- LCP hero image preload -->
        <?php
        $tswStart  = strtotime('2026-05-13 00:00:00');
        $tswEnd    = strtotime('2026-05-22 23:59:59');
        $tswActive = (time() >= $tswStart && time() <= $tswEnd);
        ?>
        <?php if ($tswActive): ?>
        <link rel="preload" href="assets/img/slider/superweek.webp" as="image" type="image/webp" fetchpriority="high">
        <?php else: ?>
        <link rel="preload" href="assets/img/slider/1.webp" as="image" type="image/webp" fetchpriority="high">
        <?php endif; ?>
        
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