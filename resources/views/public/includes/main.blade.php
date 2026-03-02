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

        /* === MODAL PILARES ANIMACIÓN === */
        .pilar-modal-hidden {
            pointer-events: none;
            visibility: hidden;
        }

        .pilar-modal-visible {
            pointer-events: auto;
            visibility: visible;
        }

        .pilar-modal-backdrop {
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .pilar-modal-visible .pilar-modal-backdrop {
            opacity: 1;
        }

        .pilar-modal-content {
            opacity: 0;
            transform: translateY(40px) scale(0.97);
            transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1), transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .pilar-modal-visible .pilar-modal-content {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Animación de entrada de cada tarjeta de proyecto */
        .proyecto-card {
            opacity: 0;
            transform: translateY(20px);
            animation: proyectoFadeIn 0.4s ease forwards;
        }

        @keyframes proyectoFadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Scroll personalizado en modal */
        #pilarModalBody::-webkit-scrollbar {
            width: 6px;
        }

        #pilarModalBody::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #pilarModalBody::-webkit-scrollbar-thumb {
            background: #D98D5F;
            border-radius: 10px;
        }

        #pilarModalBody::-webkit-scrollbar-thumb:hover {
            background: #b86e42;
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

        // =============================================
        // PILARES DEL CAMBIO - MODAL CON PROYECTOS
        // =============================================
        // ESTRUCTURA DE DATOS EXTENSIBLE:
        // Para agregar más proyectos, simplemente añade objetos al array "proyectos" de cada pilar.
        // Cada proyecto tiene: { titulo, descripcion, icono (clase FontAwesome) }
        const pilaresData = [
            // ---- PILAR 0: SEGURIDAD ----
            {
                titulo: 'Seguridad Ciudadana',
                subtitulo: 'Pilar 1 — Protección y orden para El Alto',
                icono: 'fas fa-shield-alt',
                iconColor: 'text-red-600',
                iconBg: 'bg-red-100',
                descripcion: 'Un El Alto seguro es posible. Nuestro plan integra tecnología, presencia policial y participación vecinal para devolver la tranquilidad a cada barrio. No más miedo al salir de casa.',
                proyectos: [
                    {
                        titulo: 'Patrullaje Inteligente 24/7',
                        descripcion: 'Incremento de patrullas motorizadas y a pie con rutas optimizadas por datos de incidencia delictiva en cada distrito.',
                        icono: 'fas fa-car-side'
                    },
                    {
                        titulo: 'Iluminación Pública LED',
                        descripcion: 'Instalación de alumbrado LED en calles, pasarelas y plazas oscuras. Las zonas iluminadas reducen hasta un 60% los delitos.',
                        icono: 'fas fa-lightbulb'
                    },
                    {
                        titulo: 'Control de Bares Clandestinos',
                        descripcion: 'Operativos permanentes contra locales ilegales que venden alcohol a menores y generan violencia en los barrios.',
                        icono: 'fas fa-ban'
                    },
                    {
                        titulo: 'Cámaras de Vigilancia Urbana',
                        descripcion: 'Red municipal de videovigilancia conectada a un centro de monitoreo con respuesta inmediata ante emergencias.',
                        icono: 'fas fa-video'
                    },
                    {
                        titulo: 'Brigadas Vecinales de Seguridad',
                        descripcion: 'Capacitación y equipamiento de brigadas barriales que trabajen coordinadamente con la Policía y la Guardia Municipal.',
                        icono: 'fas fa-users-cog'
                    },
                ]
            },
            // ---- PILAR 1: PROYECTOS ESTRATÉGICOS ----
            {
                titulo: 'Proyectos Estratégicos',
                subtitulo: 'Pilar 2 — Obras que transforman la ciudad',
                icono: 'fas fa-city',
                iconColor: 'text-blue-600',
                iconBg: 'bg-blue-100',
                descripcion: 'Proyectos de gran escala que cambiarán el rostro de El Alto. Infraestructura moderna, gobernanza propia y tecnología al servicio de la ciudadanía.',
                proyectos: [
                    {
                        titulo: 'Carta Orgánica Municipal',
                        descripcion: 'Aprobación de la carta orgánica para que El Alto tenga autonomía plena en sus decisiones administrativas y legislativas.',
                        icono: 'fas fa-scroll'
                    },
                    {
                        titulo: 'Embovedado de Ríos',
                        descripcion: 'Canalización y embovedado de los ríos Seco y otros cauces para prevenir inundaciones y recuperar espacios públicos.',
                        icono: 'fas fa-water'
                    },
                    {
                        titulo: 'Autódromo Municipal',
                        descripcion: 'Construcción de un autódromo profesional que genere turismo, empleo y sea sede de competencias nacionales e internacionales.',
                        icono: 'fas fa-flag-checkered'
                    },
                    {
                        titulo: 'Banco de Sangre Municipal',
                        descripcion: 'Centro de hemoterapia propio para atender emergencias sin depender de otras ciudades, salvando vidas en El Alto.',
                        icono: 'fas fa-tint'
                    },
                    {
                        titulo: 'Avenidas Concluidas',
                        descripcion: 'Finalización de las avenidas troncales inconclusas que conectarán los 14 distritos de manera eficiente y segura.',
                        icono: 'fas fa-road'
                    },
                    {
                        titulo: 'El Alto Digital — Modernización Municipal',
                        descripcion: 'Proyecto integral de transformación digital que eliminará la burocracia y acercará los servicios municipales al ciudadano. Alineado con la Ley 164 (TIC), Ley 1178 (SAFCO) y el Código Tributario. Meta: 50% de trámites digitalizados en 3-4 años, reducción del 40% en tiempos de atención e incremento del 15% en recaudación.',
                        icono: 'fas fa-laptop-code',
                        destacado: true,
                        subProyectos: [
                            {
                                titulo: 'Licencias de Funcionamiento en Línea',
                                descripcion: 'Solicitud, carga de documentos, validación automática, pago digital y emisión con código QR. Inspecciones programadas desde tablets con firma digital. Elimina visitas físicas múltiples y la discrecionalidad.',
                                icono: 'fas fa-file-signature'
                            },
                            {
                                titulo: 'Sistema Digital de Quejas Ciudadanas',
                                descripcion: 'Plataforma web, app móvil y WhatsApp para reportar baches, luminarias dañadas, denunciar corrupción o solicitar servicios. Con geolocalización, fotos y asignación automática al área responsable. El vecino puede dar seguimiento en tiempo real: Recibido → En proceso → Resuelto.',
                                icono: 'fas fa-headset'
                            },
                            {
                                titulo: 'Certificado de No Adeudo Digital',
                                descripcion: 'Emisión automática e instantánea del certificado cuando el sistema detecta deuda cero. Con número único, código QR verificable y firma digital institucional. Trámite 100% en línea, sin filas.',
                                icono: 'fas fa-file-certificate'
                            },
                            {
                                titulo: 'Portal Tributario Integral',
                                descripcion: 'Plataforma unificada para consultas, pagos y seguimiento de obligaciones tributarias municipales. Integración con la base de datos tributaria para transparencia total.',
                                icono: 'fas fa-money-check-alt'
                            },
                        ]
                    },
                ]
            },
            // ---- PILAR 2: SALUD ----
            {
                titulo: 'Salud para Todos',
                subtitulo: 'Pilar 3 — Atención digna y accesible',
                icono: 'fas fa-heartbeat',
                iconColor: 'text-teal-600',
                iconBg: 'bg-teal-100',
                descripcion: 'La salud no es un privilegio, es un derecho. Vamos a acercar la atención médica a cada barrio con infraestructura de calidad y medicamentos a precio justo.',
                proyectos: [
                    {
                        titulo: 'Red de Postas de Salud',
                        descripcion: 'Construcción y equipamiento de postas de salud en cada distrito para atención primaria cercana a tu hogar.',
                        icono: 'fas fa-clinic-medical'
                    },
                    {
                        titulo: 'Farmacias Populares Municipales',
                        descripcion: 'Red de farmacias con medicamentos esenciales a precio de costo. Sin intermediarios, directo al bolsillo de las familias.',
                        icono: 'fas fa-pills'
                    },
                    {
                        titulo: 'Centros de Rehabilitación',
                        descripcion: 'Espacios especializados para rehabilitación física y tratamiento de adicciones, accesibles y con profesionales capacitados.',
                        icono: 'fas fa-hand-holding-medical'
                    },
                    {
                        titulo: 'Brigadas Médicas Móviles',
                        descripcion: 'Unidades móviles que lleven atención médica gratuita a las zonas más alejadas de cada distrito.',
                        icono: 'fas fa-ambulance'
                    },
                ]
            },
            // ---- PILAR 3: EDUCACIÓN ----
            {
                titulo: 'Educación de Calidad',
                subtitulo: 'Pilar 4 — Formando el futuro de El Alto',
                icono: 'fas fa-graduation-cap',
                iconColor: 'text-yellow-600',
                iconBg: 'bg-yellow-100',
                descripcion: 'Invertir en educación es invertir en el futuro. Nuestros hijos merecen aulas dignas, alimentación adecuada y herramientas para competir en el mundo moderno.',
                proyectos: [
                    {
                        titulo: 'Desayuno Escolar Nutritivo',
                        descripcion: 'Mejora integral del desayuno escolar con alimentos nutritivos, variados y de producción local. Niños bien alimentados aprenden mejor.',
                        icono: 'fas fa-utensils'
                    },
                    {
                        titulo: 'Aulas Dignas y Equipadas',
                        descripcion: 'Refacción y construcción de infraestructura educativa moderna con laboratorios, bibliotecas y espacios deportivos.',
                        icono: 'fas fa-school'
                    },
                    {
                        titulo: 'Becas Municipales',
                        descripcion: 'Programa de becas para estudiantes destacados de escasos recursos que quieran acceder a educación superior y técnica.',
                        icono: 'fas fa-award'
                    },
                    {
                        titulo: 'Centros de Tecnología Educativa',
                        descripcion: 'Laboratorios de computación e internet gratuito en las unidades educativas para cerrar la brecha digital.',
                        icono: 'fas fa-laptop'
                    },
                ]
            },
            // ---- PILAR 4: MEDIO AMBIENTE ----
            {
                titulo: 'Medio Ambiente',
                subtitulo: 'Pilar 5 — Un El Alto verde y limpio',
                icono: 'fas fa-leaf',
                iconColor: 'text-green-700',
                iconBg: 'bg-green-100',
                descripcion: 'Nuestra ciudad merece aire limpio and espacios verdes. Transformaremos el problema de la basura en una oportunidad económica y ambiental.',
                proyectos: [
                    {
                        titulo: 'Industrialización de la Basura',
                        descripcion: 'Planta de reciclaje y tratamiento de residuos sólidos que genere empleo y reduzca la contaminación. La basura es recurso, no desperdicio.',
                        icono: 'fas fa-recycle'
                    },
                    {
                        titulo: 'Arborización Urbana Masiva',
                        descripcion: 'Plantación de miles de árboles nativos y resistentes a la altura en avenidas, plazas y áreas públicas de toda la ciudad.',
                        icono: 'fas fa-tree'
                    },
                    {
                        titulo: 'Parques y Espacios Verdes',
                        descripcion: 'Creación de parques distritales con áreas recreativas, deporte y esparcimiento para familias.',
                        icono: 'fas fa-seedling'
                    },
                ]
            },
            // ---- PILAR 5: BIENESTAR ANIMAL ----
            {
                titulo: 'Bienestar Animal',
                subtitulo: 'Pilar 6 — Respeto por toda forma de vida',
                icono: 'fas fa-paw',
                iconColor: 'text-purple-600',
                iconBg: 'bg-purple-100',
                descripcion: 'Una ciudad que cuida a sus animales es una ciudad con valores. Implementaremos políticas reales de protección y bienestar animal.',
                proyectos: [
                    {
                        titulo: 'Albergue Hospital Veterinario',
                        descripcion: 'Centro municipal de rescate, atención veterinaria gratuita y adopción responsable para animales en situación de calle.',
                        icono: 'fas fa-clinic-medical'
                    },
                    {
                        titulo: 'Cementerio Municipal para Mascotas',
                        descripcion: 'Espacio digno para despedir a nuestros compañeros de vida. Un servicio que muchas familias necesitan.',
                        icono: 'fas fa-dove'
                    },
                    {
                        titulo: 'Campañas de Esterilización',
                        descripcion: 'Jornadas gratuitas de esterilización y vacunación para controlar la población canina y prevenir enfermedades.',
                        icono: 'fas fa-syringe'
                    },
                ]
            },
            // ---- PILAR 6: AYUDA SOLIDARIA ----
            {
                titulo: 'Ayuda Solidaria',
                subtitulo: 'Pilar 7 — Nadie se queda atrás',
                icono: 'fas fa-hands-helping',
                iconColor: 'text-orange-600',
                iconBg: 'bg-orange-100',
                descripcion: 'Un gobierno con rostro humano protege a los más vulnerables. Transporte gratuito, guarderías y programas de apoyo directo para quienes más lo necesitan.',
                proyectos: [
                    {
                        titulo: 'Transporte Gratuito (Pasaje Cero)',
                        descripcion: 'Transporte gratuito en Wayna Bus para niños menores de 12 años y adultos mayores. Apoyo directo al bolsillo de la familia.',
                        icono: 'fas fa-bus'
                    },
                    {
                        titulo: 'Guarderías Distritales',
                        descripcion: 'Red de guarderías municipales gratuitas para que las madres y padres trabajadores tengan dónde dejar a sus hijos con seguridad.',
                        icono: 'fas fa-baby'
                    },
                    {
                        titulo: 'Comedores Populares',
                        descripcion: 'Comedores municipales con alimentación nutritiva a precio simbólico para personas en situación de vulnerabilidad.',
                        icono: 'fas fa-utensils'
                    },
                    {
                        titulo: 'Apoyo a Adultos Mayores',
                        descripcion: 'Centros de día con actividades recreativas, atención médica básica y acompañamiento para nuestros abuelos.',
                        icono: 'fas fa-user-friends'
                    },
                ]
            },
            // ---- PILAR EXTRA: ROSTRO HUMANO ----
            {
                titulo: 'Rostro Humano',
                subtitulo: 'El centro de todo es la persona',
                icono: 'fas fa-heart',
                iconColor: 'text-white',
                iconBg: 'bg-mts-green',
                descripcion: 'Un gobierno no se mide solo por sus obras, sino por cómo trata a su gente. Garantizamos un trato digno, transparente y humano en cada oficina pública.',
                proyectos: [
                    {
                        titulo: 'Atención Digna en Oficinas Públicas',
                        descripcion: 'Capacitación obligatoria en atención al ciudadano para todos los funcionarios municipales. Evaluación periódica por los vecinos.',
                        icono: 'fas fa-handshake'
                    },
                    {
                        titulo: 'Gobierno Transparente',
                        descripcion: 'Rendición de cuentas pública semestral, presupuestos abiertos y auditorías ciudadanas. Tu dinero, tu derecho a saber.',
                        icono: 'fas fa-eye'
                    },
                    {
                        titulo: 'Ventanilla Única Municipal',
                        descripcion: 'Simplificación de trámites para que ningún vecino deba ir de oficina en oficina. Un solo lugar, una sola vez.',
                        icono: 'fas fa-door-open'
                    },
                    {
                        titulo: 'Participación Ciudadana Real',
                        descripcion: 'Asambleas distritales vinculantes donde los vecinos decidan cómo se invierte el presupuesto de su zona.',
                        icono: 'fas fa-bullhorn'
                    },
                ]
            },
        ];

        // Función para abrir modal de pilar
        function abrirModalPilar(index) {
            const pilar = pilaresData[index];
            if (!pilar) return;

            const modal = document.getElementById('pilarModal');
            const iconEl = document.getElementById('pilarModalIcon');
            const titleEl = document.getElementById('pilarModalTitle');
            const subtitleEl = document.getElementById('pilarModalSubtitle');
            const descEl = document.getElementById('pilarModalDesc');
            const bodyEl = document.getElementById('pilarModalProyectos');

            // Setear header
            iconEl.className = `w-14 h-14 rounded-full flex items-center justify-center shrink-0 ${pilar.iconBg}`;
            iconEl.innerHTML = `<i class="${pilar.icono} ${pilar.iconColor} text-2xl"></i>`;
            titleEl.textContent = pilar.titulo;
            subtitleEl.textContent = pilar.subtitulo;
            descEl.textContent = pilar.descripcion;

            // Generar tarjetas de proyectos
            let html = '';
            pilar.proyectos.forEach((proy, i) => {
                const isDestacado = proy.destacado ? true : false;
                const hasSubProyectos = proy.subProyectos && proy.subProyectos.length > 0;
                const cardClass = isDestacado
                    ? 'md:col-span-2 bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200'
                    : 'bg-gray-50 border border-gray-100';
                const badgeHTML = isDestacado
                    ? '<span class="inline-block bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider mb-2"><i class="fas fa-star mr-1"></i>Proyecto Destacado</span><br>'
                    : '';

                // Renderizar sub-proyectos si existen
                let subProyectosHTML = '';
                if (hasSubProyectos) {
                    subProyectosHTML = '<div class="mt-4 pt-4 border-t border-blue-200/50 space-y-3">';
                    subProyectosHTML += '<p class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-2"><i class="fas fa-cubes mr-1"></i> Componentes del Proyecto</p>';
                    proy.subProyectos.forEach((sub, j) => {
                        subProyectosHTML += `
                            <div class="flex items-start gap-3 bg-white/80 p-3 rounded-lg border border-blue-100 hover:border-blue-300 transition duration-200 proyecto-card" style="animation-delay: ${(i + j + 1) * 0.1}s;">
                                <div class="w-8 h-8 rounded-md bg-blue-100 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="${sub.icono} text-blue-600 text-xs"></i>
                                </div>
                                <div>
                                    <h6 class="font-display font-bold text-sm text-gray-800">${sub.titulo}</h6>
                                    <p class="text-xs text-gray-600 leading-relaxed mt-0.5">${sub.descripcion}</p>
                                </div>
                            </div>
                        `;
                    });
                    subProyectosHTML += '</div>';
                }

                html += `
                    <div class="proyecto-card ${cardClass} p-5 rounded-xl hover:shadow-lg transition duration-300 group/proy" style="animation-delay: ${i * 0.08}s;">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg ${pilar.iconBg} flex items-center justify-center shrink-0 group-hover/proy:scale-110 transition duration-200">
                                <i class="${proy.icono} ${pilar.iconColor} text-sm"></i>
                            </div>
                            <div class="flex-1">
                                ${badgeHTML}
                                <h5 class="font-display font-bold text-base text-gray-800 mb-1">${proy.titulo}</h5>
                                <p class="text-sm text-gray-600 leading-relaxed">${proy.descripcion}</p>
                            </div>
                        </div>
                        ${subProyectosHTML}
                    </div>
                `;
            });
            bodyEl.innerHTML = html;

            // Mostrar modal con animación
            modal.classList.remove('pilar-modal-hidden');
            // Forzar reflow para que la transición funcione
            modal.offsetHeight;
            modal.classList.add('pilar-modal-visible');
            document.body.style.overflow = 'hidden';
        }

        // Función para cerrar modal
        function cerrarModalPilar() {
            const modal = document.getElementById('pilarModal');
            modal.classList.remove('pilar-modal-visible');
            document.body.style.overflow = 'auto';
            // Esperar a que termine la animación antes de ocultar
            setTimeout(() => {
                modal.classList.add('pilar-modal-hidden');
            }, 400);
        }

        // Cerrar al hacer clic en el backdrop
        function cerrarModalPilarBackdrop(event) {
            if (event.target === document.getElementById('pilarModal') || event.target.classList.contains('pilar-modal-backdrop')) {
                cerrarModalPilar();
            }
        }

        // Cerrar con tecla Escape (extender el listener existente)
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const pilarModal = document.getElementById('pilarModal');
                if (pilarModal && pilarModal.classList.contains('pilar-modal-visible')) {
                    cerrarModalPilar();
                }
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
