<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>David Vargas 2026 | Un Futuro Digno para El Alto</title>

    <!-- Google Fonts: Oswald (Títulos) y Roboto (Cuerpo) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">

    <!-- FontAwesome para Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuración de Colores Personalizados -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mts: {
                            green: '#006837',
                            /* Verde Corporativo */
                            greenLight: '#008f4c',
                            copper: '#D98D5F',
                            /* Color de Acento/Botones */
                            copperDark: '#b86e42',
                            dark: '#1A1A1A',
                            /* Texto Oscuro */
                            light: '#F8F9FA',
                            /* Fondos Suaves */
                        }
                    },
                    fontFamily: {
                        display: ['Oswald', 'sans-serif'],
                        body: ['Roboto', 'sans-serif'],
                    },
                    backgroundImage: {
                        'pattern': "url('https://www.transparenttextures.com/patterns/cubes.png')",
                    }
                }
            }
        }
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17926563417"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-17926563417');
    </script>

    <style>
        /* Estilos base adicionales */
        .clip-diagonal {
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
        }

        .clip-diagonal-reverse {
            clip-path: polygon(0 10%, 100% 0, 100% 100%, 0 100%);
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(0, 104, 55, 0.95) 0%, rgba(0, 80, 40, 0.8) 100%);
        }

        /* Botón de Play personalizado */
        .play-button {
            transition: all 0.3s ease;
        }

        .play-button:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(217, 141, 95, 0.6);
        }
    </style>
</head>

<body class="font-body text-mts-dark bg-white antialiased overflow-x-hidden">

    <!-- NAV BAR -->

    @include('public.includes.nav')


    @yield('contenido')

    <!-- FOOTER -->
    @include('public.includes.footer')

    <!-- FLOAT WHATSAPP BUTTON -->
    <a href="https://whatsapp.com/channel/0029Vb7imk5EQIav20vde90Y" target="_blank"
        class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl transition transform hover:scale-110 animate-bounce">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <!-- Scripts -->

    <!-- Inicialización de AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true, // Animación solo ocurre una vez al bajar
            offset: 100, // Comienza antes de llegar al elemento
            duration: 800,
            easing: 'ease-out-cubic',
        });
    </script>

    <!-- JS Menu Logica -->
    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Efecto sticky navbar más suave
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg', 'bg-white/95');
                navbar.classList.remove('py-2');
            } else {
                navbar.classList.remove('shadow-lg');
                navbar.classList.add('py-2');
            }
        });

        // Función para abrir WhatsApp
        function abrirWhatsApp() {
            // Obtener valores del formulario
            const nombre = document.getElementById('nombreUsuario').value.trim();
            const numero = document.getElementById('numeroUsuario').value.trim();

            // Validar que los campos no estén vacíos
            if (!nombre) {
                alert('Por favor, ingresa tu nombre completo');
                return;
            }

            if (!numero) {
                alert('Por favor, ingresa tu número de WhatsApp');
                return;
            }

            const numeroWhatsApp = '59178877050'; // Número con código de país (Bolivia +591)
            const mensaje = encodeURIComponent(
                `¡Hola! Soy ${nombre} y mi número es ${numero}.\n\n` +
                `Quiero participar y ser parte del cambio para El Alto. Me gustaría recibir más información sobre las propuestas de David Vargas.`
            );
            const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensaje}`;

            // Abrir en nueva ventana
            window.open(urlWhatsApp, '_blank');
        }

        // Funciones para el Modal de Video
        function abrirModalVideo() {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('videoPlayer');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden'; // Prevenir scroll del body

            // Reproducir video automáticamente
            if (video) {
                video.play();
            }

            // Si usas iframe de YouTube/TikTok, descomentar esto:
            // const iframe = document.getElementById('videoIframe');
            // iframe.src = "https://www.youtube.com/embed/TU_VIDEO_ID?autoplay=1";
        }

        function cerrarModalVideo() {
            const modal = document.getElementById('videoModal');
            const video = document.getElementById('videoPlayer');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto'; // Restaurar scroll

            // Pausar y reiniciar video
            if (video) {
                video.pause();
                video.currentTime = 0;
            }

            // Si usas iframe, descomentar esto:
            // const iframe = document.getElementById('videoIframe');
            // iframe.src = "";
        }

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModalVideo();
                document.getElementById('shareMenu').classList.add('hidden');
            }
        });

        // Funciones para compartir en redes sociales
        function toggleShareMenu() {
            const menu = document.getElementById('shareMenu');
            menu.classList.toggle('hidden');
        }

        function compartirEn(red) {
            // URL de la página actual o del video
            const url = encodeURIComponent(window.location.href + '#cumbia');
            const titulo = encodeURIComponent(
                '🎶 ¡Escucha la Cumbia del Mayor Vargas! El ritmo del cambio llegó a El Alto 🎵');
            const mensaje = encodeURIComponent(
                '¡Dale play a la Cumbia del Mayor Vargas! El ritmo del cambio para El Alto 2026 🎶🔥 #DavidVargas #ElAlto #Cumbia'
            );

            let shareUrl = '';

            switch (red) {
                case 'whatsapp':
                    shareUrl = `https://wa.me/?text=${mensaje}%20${url}`;
                    break;
                case 'facebook':
                    shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${mensaje}`;
                    break;
                case 'twitter':
                    shareUrl = `https://twitter.com/intent/tweet?text=${mensaje}&url=${url}`;
                    break;
                case 'telegram':
                    shareUrl = `https://t.me/share/url?url=${url}&text=${mensaje}`;
                    break;
            }

            if (shareUrl) {
                window.open(shareUrl, '_blank', 'width=600,height=400');
            }
        }

        function copiarEnlace() {
            const url = window.location.href + '#cumbia';
            navigator.clipboard.writeText(url).then(() => {
                const textoBtn = document.getElementById('copiarTexto');
                textoBtn.textContent = '¡Copiado!';
                setTimeout(() => {
                    textoBtn.textContent = 'Copiar link';
                }, 2000);
            }).catch(err => {
                // Fallback para navegadores que no soportan clipboard API
                const input = document.createElement('input');
                input.value = url;
                document.body.appendChild(input);
                input.select();
                document.execCommand('copy');
                document.body.removeChild(input);

                const textoBtn = document.getElementById('copiarTexto');
                textoBtn.textContent = '¡Copiado!';
                setTimeout(() => {
                    textoBtn.textContent = 'Copiar link';
                }, 2000);
            });
        }

        // Cerrar menú de compartir al hacer clic fuera
        document.addEventListener('click', function(e) {
            const shareMenu = document.getElementById('shareMenu');
            const shareButton = document.getElementById('shareButton');
            if (shareMenu && shareButton && !shareMenu.contains(e.target) && !shareButton.contains(e.target)) {
                shareMenu.classList.add('hidden');
            }
        });
    </script>
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '25232725403096300');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=25232725403096300&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
</body>

</html>
