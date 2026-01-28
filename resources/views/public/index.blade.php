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
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/95 backdrop-blur-md shadow-md" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="#" class="flex-shrink-0 flex items-center gap-2 group">
                    <div
                        class="w-10 h-10 bg-mts-green group-hover:bg-mts-copper transition-colors duration-300 rounded-full flex items-center justify-center text-white font-display font-bold text-xl shadow-lg">
                        MTS
                    </div>
                    <div>
                        <h1
                            class="font-display font-bold text-2xl text-mts-green leading-none group-hover:text-mts-dark transition-colors">
                            DAVID VARGAS</h1>
                        <span class="text-xs font-bold text-mts-copper tracking-widest uppercase">Alcalde de El Alto -
                            2026</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#inicio"
                        class="text-mts-dark hover:text-mts-copper font-medium transition text-sm uppercase tracking-wide">Inicio</a>
                    <a href="#historia"
                        class="text-mts-dark hover:text-mts-copper font-medium transition text-sm uppercase tracking-wide">Biografía</a>
                    <a href="#propuestas"
                        class="text-mts-dark hover:text-mts-copper font-medium transition text-sm uppercase tracking-wide">Propuestas</a>
                    <a href="#multimedia"
                        class="text-mts-dark hover:text-mts-copper font-medium transition text-sm uppercase tracking-wide">Prensa</a>
                    <a href="https://whatsapp.com/channel/0029Vb7imk5EQIav20vde90Y" target="_blank"
                        class="bg-mts-copper hover:bg-mts-copperDark text-white px-6 py-2 rounded-full font-bold transition shadow-lg transform hover:-translate-y-0.5 text-sm uppercase tracking-wide">
                        <i class="fab fa-whatsapp mr-2"></i> Únete
                    </a>
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-mts-green text-2xl focus:outline-none p-2">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu"
            class="hidden md:hidden absolute top-20 left-0 w-full bg-white shadow-xl border-t border-gray-100 z-40 transform transition-transform duration-300">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#inicio"
                    class="block px-3 py-3 text-base font-medium text-mts-green hover:bg-gray-50 rounded border-l-4 border-transparent hover:border-mts-green">Inicio</a>
                <a href="#historia"
                    class="block px-3 py-3 text-base font-medium text-mts-dark hover:bg-gray-50 rounded border-l-4 border-transparent hover:border-mts-copper">Biografía</a>
                <a href="#propuestas"
                    class="block px-3 py-3 text-base font-medium text-mts-dark hover:bg-gray-50 rounded border-l-4 border-transparent hover:border-mts-copper">Propuestas</a>
                <a href="#multimedia"
                    class="block px-3 py-3 text-base font-medium text-mts-dark hover:bg-gray-50 rounded border-l-4 border-transparent hover:border-mts-copper">Videos</a>
                <a href="#unete"
                    class="block px-3 py-3 text-base font-bold text-white bg-mts-copper rounded text-center mt-4">Sumarse
                    al Cambio</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="inicio"
        class="relative pt-20 min-h-[90vh] flex items-center clip-diagonal bg-gray-900 overflow-hidden">
        <!-- Background Image Parallax -->
        <div class="absolute inset-0 z-0 transform scale-105">
            <img src="/img/candidato/IMG5.jpg" alt="El Alto Fondo" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 hero-gradient"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center w-full">
            <div class="w-full md:w-3/5 text-white py-12" data-aos="fade-right" data-aos-duration="1000">
                <div
                    class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-white px-4 py-1.5 rounded-full font-bold text-xs mb-6 tracking-wider uppercase shadow-lg">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span> Gestión 2026 - 2031
                </div>
                {{-- <h1 class="font-display font-bold text-5xl md:text-7xl leading-tight mb-6 drop-shadow-lg">
                    ¡VALENTÍA PARA<br>
                    <span class="text-mts-copper">TRANSFORMAR!</span>
                </h1> --}}
                {{-- <div
                    class="inline-block bg-mts-copper text-white px-4 py-1 rounded-sm font-bold text-sm mb-4 tracking-wider uppercase">
                    Gestión 2026 - 2031
                </div> --}}
                <h1 class="font-display font-bold text-5xl md:text-7xl leading-tight mb-6">
                    ¡PARA UNA CIUDAD VALIENTE,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300">UN ALCALDE
                        VALIENTE!</span>
                </h1>
                {{-- <p
                    class="text-xl md:text-2xl font-light mb-8 max-w-2xl text-gray-100 border-l-4 border-mts-copper pl-6">
                    No más promesas vacías. Un gobierno con <strong>Rostro Humano</strong> que devuelve la dignidad a
                    cada familia alteña.
                </p> --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#propuestas"
                        class="bg-mts-copper hover:bg-mts-copperDark text-white text-center px-8 py-4 rounded-lg font-bold text-lg shadow-xl transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                        <span>Ver Propuestas</span> <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="https://www.tiktok.com/@david_vargas_alcalde/video/7596846583833054476?_r=1&_t=ZS-93QsCZ5DSKn"
                        target="_blank"
                        class="group flex items-center justify-center gap-3 px-8 py-4 rounded-lg border-2 border-white/30 hover:bg-white/10 text-white font-bold transition">
                        <i class="fas fa-play-circle text-2xl group-hover:text-mts-copper transition-colors"></i> Ver
                        Spot
                    </a>
                </div>
            </div>

            <!-- Foto Candidato -->
            <div class="hidden md:block w-2/5 h-full relative" data-aos="fade-left" data-aos-delay="200"
                data-aos-duration="1000">
                <!-- Imagen del candidato (Placeholder SVG si no hay imagen) -->
                <div class="relative z-10 mt-12">
                    <!-- Decoración trasera -->
                    <div class="absolute -inset-4 bg-mts-copper/20 rounded-full blur-2xl"></div>
                    <!-- Contenedor Imagen -->
                    <img src="/img/candidato/candidato3.png"
                        class="relative z-10 w-full drop-shadow-2xl transform hover:scale-105 transition duration-700 mask-image-bottom"
                        alt="David Vargas">
                </div>
            </div>
        </div>
    </section>

    <!-- BIOGRAFÍA / HISTORIA (NUEVA SECCIÓN) -->
    <section id="historia" class="py-24 bg-white relative overflow-hidden">
        <!-- Decoración de fondo -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-mts-green/5 rounded-full -translate-x-1/2 -translate-y-1/2">
        </div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-mts-copper/5 rounded-full translate-x-1/3 translate-y-1/3">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Imagen Historia -->
                <div class="relative" data-aos="fade-right">
                    <div class="absolute top-4 -left-4 w-full h-full border-2 border-mts-green rounded-xl z-0"></div>
                    <img src="/img/candidato/IMG5.jpg" alt="David Vargas con el pueblo"
                        class="relative z-10 rounded-xl shadow-2xl w-full object-cover h-[500px] grayscale hover:grayscale-0 transition duration-500">
                    <div
                        class="absolute -bottom-6 -right-6 bg-white p-4 shadow-xl rounded-lg z-20 max-w-xs border-l-4 border-mts-copper">
                        <p class="font-display text-mts-dark font-bold text-lg">"Hijo de El Alto, forjado en el
                            esfuerzo."</p>
                    </div>
                </div>

                <!-- Texto Historia -->
                <div data-aos="fade-left">
                    <h4 class="text-mts-copper font-bold tracking-widest uppercase mb-2">Sobre David Vargas</h4>
                    <h2 class="font-display font-bold text-4xl lg:text-5xl text-mts-dark mb-6">UN LÍDER QUE CONOCE
                        <br><span class="text-mts-green">TUS LUCHAS</span>
                    </h2>

                    <div class="space-y-4 text-gray-600 text-lg leading-relaxed">
                        <p>
                            David Vargas no es un político de escritorio. Es un profesional que caminó las mismas calles
                            de tierra que tú, enfrentó las mismas carencias y decidió prepararse para cambiar esa
                            realidad.
                        </p>
                        <p>
                            Nacido en el Distrito 8, David no es un político de escritorio. Es un profesional que caminó
                            las mismas calles de tierra que tú, enfrentó las mismas carencias y decidió prepararse para
                            cambiar esa realidad.
                        </p>
                        <p>
                            Como parte del <strong>Movimiento Tercer Sistema (MTS)</strong>, David representa la
                            verdadera renovación. Su trayectoria en la gestión social y su lucha incansable por los
                            derechos vecinales lo convierten en la única opción capaz de ordenar nuestra ciudad sin
                            perder la sensibilidad humana.
                        </p>
                        <p>
                            David plasmó su visión y experiencias en el libro <strong>"POR QUÉ NO QUIERO QUE MI HIJA SEA
                                TU EMPLEADA: Memorias de un policía que eligió la rebeldía"</strong>, una obra que
                            refleja su compromiso con la dignidad del pueblo alteño y su lucha por un futuro mejor.
                            <a href="{{ url('downloads/david-vargas.pdf') }}" download
                                class="inline-flex items-center gap-2 text-mts-copper hover:text-mts-copperDark font-bold transition mt-2">
                                <i class="fas fa-book-open"></i> Descarga el libro aquí
                            </a>
                        </p>
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-100 flex gap-8">
                        <div>
                            <span class="block font-display font-bold text-4xl text-mts-green">15+</span>
                            <span class="text-sm text-gray-500 font-medium">Años de Servicio</span>
                        </div>
                        <div>
                            <span class="block font-display font-bold text-4xl text-mts-green">100%</span>
                            <span class="text-sm text-gray-500 font-medium">Compromiso</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="plan" class="py-24 bg-white clip-diagonal-reverse pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12" data-aos="fade-up">
                <div>
                    <h2 class="font-display font-bold text-4xl text-mts-green">LOS 7 PILARES DEL CAMBIO</h2>
                    <p class="text-gray-500 mt-2 text-lg">Estructura técnica para problemas reales.</p>
                </div>
                <a href="{{ url('downloads/plan_gobierno_el_alto.pdf') }}"
                    download="PLAN DE GOBIERNO MUNICIPAL PARA EL ALTO.pdf"
                    class="hidden md:block mt-4 md:mt-0 text-mts-copper font-bold hover:text-orange-700 border-b-2 border-mts-copper pb-1 transition">
                    <i class="fas fa-file-pdf mr-2"></i> Descargar Plan Completo PDF
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pilar 1: Seguridad -->
                <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300"
                    data-aos="fade-up" data-aos-delay="0">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-red-600 text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Seguridad</h4>
                    <p class="text-sm text-gray-600">Más patrullaje, iluminación pública, control de bares clandestinos
                        y trabajo conjunto con la Policía.</p>
                </div>
                <!-- Pilar 2: Proyectos Estratégicos -->
                <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-4">
                        <i class="fas fa-city text-blue-600 text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Proyectos Estratégicos</h4>
                    <p class="text-sm text-gray-600">Carta orgánica, embovedado de ríos, autódromo, banco de sangre y
                        avenidas concluidas.</p>
                </div>
                <!-- Pilar 3: Salud -->
                <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-full bg-teal-100 flex items-center justify-center mb-4">
                        <i class="fas fa-heartbeat text-teal-600 text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Salud</h4>
                    <p class="text-sm text-gray-600">Postas de salud, farmacias populares y centros de rehabilitación
                        accesibles.</p>
                </div>
                <!-- Pilar 4: Educación -->
                <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mb-4">
                        <i class="fas fa-graduation-cap text-yellow-600 text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Educación</h4>
                    <p class="text-sm text-gray-600">Desayuno escolar nutritivo y aulas dignas para todos.</p>
                </div>
                <!-- Pilar 5: Medio Ambiente -->
                <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300"
                    data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mb-4">
                        <i class="fas fa-leaf text-mts-green text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Medio Ambiente</h4>
                    <p class="text-sm text-gray-600">Industrialización de la basura y arborización urbana.</p>
                </div>
                <!-- Pilar 6: Bienestar Animal -->
                <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300"
                    data-aos="fade-up" data-aos-delay="500">
                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mb-4">
                        <i class="fas fa-paw text-purple-600 text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Bienestar Animal</h4>
                    <p class="text-sm text-gray-600">Albergue hospital y cementerio municipal para mascotas.</p>
                </div>
                <!-- Pilar 7: Ayuda Solidaria -->
                <div class="p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300"
                    data-aos="fade-up" data-aos-delay="600">
                    <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center mb-4">
                        <i class="fas fa-hands-helping text-mts-copper text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Ayuda Solidaria</h4>
                    <p class="text-sm text-gray-600">Transporte gratuito para poblaciones vulnerables y guarderías
                        distritales.</p>
                </div>
                <!-- Pilar Extra (Rostro Humano) -->
                <div class="p-6 bg-gradient-to-br from-mts-green to-green-800 text-white rounded-xl shadow-lg transform md:scale-105"
                    data-aos="zoom-in" data-aos-delay="700">
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mb-4">
                        <i class="fas fa-heart text-white text-xl"></i>
                    </div>
                    <h4 class="font-display font-bold text-lg mb-2">Rostro Humano</h4>
                    <p class="text-sm opacity-90">El centro de todo es la persona. Trato digno en oficinas públicas
                        garantizado.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- SECCIÓN MULTIMEDIA / VIDEO (NUEVA) -->
    <section id="multimedia" class="py-20 bg-mts-dark relative overflow-hidden">
        <!-- Overlay Pattern -->
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'0 0 2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row gap-12 items-center">
                <div class="w-full md:w-1/2" data-aos="fade-right">
                    <h3 class="text-mts-copper font-bold tracking-widest uppercase mb-2">Mensaje del Candidato</h3>
                    <h2 class="font-display font-bold text-4xl text-white mb-6">"NO VENGO A PROMETER,<br>VENGO A
                        TRABAJAR"</h2>
                    <p class="text-gray-300 text-lg mb-8">
                        Escucha de viva voz por qué nuestro plan es diferente. No se trata de colores políticos, se
                        trata del futuro de nuestros hijos. Un minuto que cambiará tu perspectiva.
                    </p>
                    <a href="https://youtube.com" target="_blank"
                        class="inline-flex items-center text-white font-bold hover:text-mts-copper transition">
                        Ver canal oficial de YouTube <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                </div>
                <div style="border-radius: 10px; overflow: hidden">
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/DNufAAlG0EM?si=g7czk6EbweN8vPOW"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                </div>

                {{-- <div class="w-full md:w-1/2" data-aos="zoom-in">
                    <!-- Contenedor Responsive para Video -->
                    <div
                        class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-gray-700 bg-black aspect-video group cursor-pointer">
                        <!-- Placeholder Image (Thumbnail) -->


                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div
                                class="w-20 h-20 bg-mts-copper rounded-full flex items-center justify-center play-button group-hover:bg-white">
                                <i
                                    class="fas fa-play text-white text-3xl ml-2 group-hover:text-mts-copper transition-colors"></i>
                            </div>
                        </div>

                        <!-- Texto flotante -->
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">NUEVO</span>
                            <p class="text-white font-display font-bold mt-1 text-lg truncate">El Alto Renace: Spot
                                Oficial de Campaña</p>
                        </div>

                        <!-- Nota: Para insertar video real de YouTube, reemplazar todo el contenido de este div con:
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/TU_ID_VIDEO" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        -->
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- PROPUESTAS DESTACADAS -->
    {{-- <section id="propuestas" class="py-24 bg-mts-light relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display font-bold text-4xl text-mts-green mb-4">MEDIDAS URGENTES</h2>
                <div class="w-24 h-1.5 bg-mts-copper mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">No necesitamos magia, necesitamos gestión.
                    Estas son las 3 primeras acciones del Gobierno Municipal.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-mts-green hover:border-mts-copper hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="0">
                    <div
                        class="w-20 h-20 bg-green-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-mts-green transition duration-300 rotate-3 group-hover:rotate-0">
                        <i class="fas fa-bus text-3xl text-mts-green group-hover:text-white transition"></i>
                    </div>
                    <h3
                        class="font-display font-bold text-2xl text-gray-800 mb-3 group-hover:text-mts-green transition">
                        Pasaje Cero</h3>
                    <p class="text-gray-600 leading-relaxed">Transporte gratuito en Wayna Bus para <strong>niños
                            menores de 12 años</strong> y adultos mayores. Apoyo directo al bolsillo de mamá y papá.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-mts-copper hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-20 h-20 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-mts-copper transition duration-300 -rotate-3 group-hover:rotate-0">
                        <i class="fas fa-shield-dog text-3xl text-mts-copper group-hover:text-white transition"></i>
                    </div>
                    <h3
                        class="font-display font-bold text-2xl text-gray-800 mb-3 group-hover:text-mts-copper transition">
                        Seguridad Canina</h3>
                    <p class="text-gray-600 leading-relaxed">Rescate masivo de canes callejeros para entrenamiento en
                        <strong>seguridad barrial</strong>. Calles seguras y trato ético animal en un solo programa.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg border-b-4 border-mts-green hover:border-mts-copper hover:shadow-2xl transition duration-300 transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-20 h-20 bg-green-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-mts-green transition duration-300 rotate-3 group-hover:rotate-0">
                        <i class="fas fa-pills text-3xl text-mts-green group-hover:text-white transition"></i>
                    </div>
                    <h3
                        class="font-display font-bold text-2xl text-gray-800 mb-3 group-hover:text-mts-green transition">
                        Farmacias del Pueblo</h3>
                    <p class="text-gray-600 leading-relaxed">Red municipal de medicamentos esenciales a <strong>precio
                            de costo</strong>. Eliminamos intermediarios para garantizar tu salud.</p>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- EL PLAN DE GOBIERNO (GRID DETALLADO) -->

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="font-display font-bold text-3xl text-mts-dark mb-12" data-aos="fade-up">
                Unete a nuestras Casas de Campaña
            </h2>

        </div>
    </section>

    <!-- SECCIÓN CUMBIA DEL MAYOR VARGAS -->
    <section class="py-20 bg-mts-dark relative overflow-hidden">
        <!-- Overlay Pattern (igual que la sección multimedia) -->
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'0 0 2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>

        <!-- Decoración de fondo musical -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-40 h-40 bg-mts-copper rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-60 h-60 bg-mts-green rounded-full blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/4 w-32 h-32 bg-yellow-400 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 0.5s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-center gap-12">
                <!-- Texto -->
                <div class="text-center md:text-left md:w-1/2" data-aos="fade-right">
                    <div
                        class="inline-flex items-center gap-2 bg-mts-copper/20 border border-mts-copper/40 text-mts-copper px-4 py-1.5 rounded-full font-bold text-xs mb-4 tracking-wider uppercase">
                        <i class="fas fa-music animate-bounce"></i> ¡A BAILAR!
                    </div>
                    <h2 class="font-display font-bold text-4xl md:text-5xl text-white mb-4">LA CUMBIA DEL<br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-mts-copper to-yellow-400">MAYOR
                            VARGAS</span>
                    </h2>
                    <p class="text-gray-300 text-lg mb-6">
                        ¡El ritmo del cambio llegó a El Alto! 🎶 Escucha la cumbia que está moviendo a toda la ciudad.
                        <strong class="text-white">¡Compártela y que suene en cada esquina!</strong>
                    </p>
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                        <span class="bg-white/10 text-white text-xs px-3 py-1 rounded-full border border-white/20">
                            <i class="fas fa-fire text-orange-400 mr-1"></i> Viral
                        </span>
                        <span class="bg-white/10 text-white text-xs px-3 py-1 rounded-full border border-white/20">
                            <i class="fas fa-heart text-red-400 mr-1"></i> +10K reproducciones
                        </span>
                        <button onclick="toggleShareMenu()"
                            class="bg-white/10 text-white text-xs px-3 py-1 rounded-full border border-white/20 hover:bg-white/20 transition cursor-pointer relative"
                            id="shareButton">
                            <i class="fas fa-share text-blue-400 mr-1"></i> Compartir
                        </button>
                    </div>

                    <!-- Menú de compartir en redes sociales -->
                    <div id="shareMenu"
                        class="hidden mt-4 p-4 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 max-w-sm">
                        <p class="text-white text-sm font-bold mb-3"><i class="fas fa-share-alt mr-2"></i>Comparte la
                            cumbia:</p>
                        <div class="flex flex-wrap gap-2">
                            <!-- WhatsApp -->
                            <a href="#" onclick="compartirEn('whatsapp')"
                                class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white text-xs px-4 py-2 rounded-full transition transform hover:scale-105">
                                <i class="fab fa-whatsapp text-lg"></i> WhatsApp
                            </a>
                            <!-- Facebook -->
                            <a href="#" onclick="compartirEn('facebook')"
                                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs px-4 py-2 rounded-full transition transform hover:scale-105">
                                <i class="fab fa-facebook-f text-lg"></i> Facebook
                            </a>
                            <!-- Twitter/X -->
                            <a href="#" onclick="compartirEn('twitter')"
                                class="flex items-center gap-2 bg-black hover:bg-gray-800 text-white text-xs px-4 py-2 rounded-full transition transform hover:scale-105 border border-white/20">
                                <i class="fab fa-x-twitter text-lg"></i> X
                            </a>
                            <!-- Telegram -->
                            <a href="#" onclick="compartirEn('telegram')"
                                class="flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white text-xs px-4 py-2 rounded-full transition transform hover:scale-105">
                                <i class="fab fa-telegram-plane text-lg"></i> Telegram
                            </a>
                            <!-- Copiar enlace -->
                            <button onclick="copiarEnlace()"
                                class="flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white text-xs px-4 py-2 rounded-full transition transform hover:scale-105">
                                <i class="fas fa-link text-lg"></i> <span id="copiarTexto">Copiar link</span>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Thumbnail del Video con estilo musical -->
                <div class="md:w-1/2 flex justify-center" data-aos="zoom-in">
                    <div class="relative cursor-pointer group" onclick="abrirModalVideo()">
                        <!-- Ondas de sonido animadas -->
                        <div class="absolute -inset-8 flex items-center justify-center pointer-events-none">
                            <div class="w-72 h-72 border-2 border-mts-copper/30 rounded-full animate-ping"
                                style="animation-duration: 2s;"></div>
                            <div class="absolute w-80 h-80 border-2 border-mts-copper/20 rounded-full animate-ping"
                                style="animation-duration: 2.5s;"></div>
                            <div class="absolute w-96 h-96 border-2 border-mts-copper/10 rounded-full animate-ping"
                                style="animation-duration: 3s;"></div>
                        </div>

                        <!-- Contenedor del thumbnail con forma vertical -->
                        <div
                            class="relative w-64 h-[450px] rounded-3xl overflow-hidden shadow-2xl border-4 border-mts-copper/50 transform group-hover:scale-105 transition duration-500">
                            <!-- Imagen de preview -->
                            <img src="/img/candidato/candidato3.png" alt="La Cumbia del Mayor Vargas"
                                class="w-full h-full object-cover">

                            <!-- Overlay con gradiente musical -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent group-hover:from-black/70 transition duration-300">
                            </div>

                            <!-- Icono de notas musicales flotantes -->
                            <div class="absolute top-4 right-4 text-2xl animate-bounce"
                                style="animation-delay: 0.2s;">🎵</div>
                            <div class="absolute top-12 left-4 text-xl animate-bounce" style="animation-delay: 0.5s;">
                                🎶</div>
                            <div class="absolute top-20 right-8 text-lg animate-bounce"
                                style="animation-delay: 0.8s;">🎵</div>

                            <!-- Botón de Play con estilo disco -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="relative">
                                    <!-- Círculo giratorio -->
                                    <div class="absolute -inset-4 border-4 border-dashed border-mts-copper/50 rounded-full animate-spin"
                                        style="animation-duration: 8s;"></div>
                                    <div
                                        class="w-24 h-24 bg-gradient-to-br from-mts-copper to-orange-600 rounded-full flex items-center justify-center shadow-xl group-hover:from-orange-500 group-hover:to-yellow-500 transition duration-300 group-hover:scale-110">
                                        <i class="fas fa-play text-white text-3xl ml-2"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Texto inferior -->
                            <div class="absolute bottom-4 left-4 right-4 text-center">
                                <div class="bg-black/60 backdrop-blur-sm rounded-xl p-3 border border-white/10">
                                    <span
                                        class="bg-gradient-to-r from-mts-copper to-yellow-400 text-white text-xs font-bold px-3 py-1 rounded-full">
                                        <i class="fas fa-compact-disc animate-spin mr-1"
                                            style="animation-duration: 3s;"></i> CUMBIA OFICIAL
                                    </span>
                                    <p class="text-white font-display font-bold mt-2 text-lg">¡Dale Play y Baila!</p>
                                    <p class="text-gray-400 text-xs mt-1">Toca para reproducir</p>
                                </div>
                            </div>
                        </div>

                        <!-- Efecto de brillo dorado -->
                        <div
                            class="absolute -inset-2 bg-gradient-to-r from-mts-copper via-yellow-400 to-mts-copper rounded-3xl blur-xl opacity-40 group-hover:opacity-60 transition duration-500 -z-10 animate-pulse">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barra de "ecualizador" decorativa -->
            <div class="flex justify-center gap-1 mt-12" data-aos="fade-up">
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 20px; animation-delay: 0.1s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 35px; animation-delay: 0.2s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 25px; animation-delay: 0.3s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 40px; animation-delay: 0.4s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 30px; animation-delay: 0.5s;"></div>
                <div class="w-2 bg-yellow-400 rounded-full animate-pulse"
                    style="height: 50px; animation-delay: 0.6s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 35px; animation-delay: 0.7s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 45px; animation-delay: 0.8s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 25px; animation-delay: 0.9s;"></div>
                <div class="w-2 bg-yellow-400 rounded-full animate-pulse" style="height: 55px; animation-delay: 1s;">
                </div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 30px; animation-delay: 1.1s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 40px; animation-delay: 1.2s;"></div>
                <div class="w-2 bg-mts-copper rounded-full animate-pulse"
                    style="height: 20px; animation-delay: 1.3s;"></div>
            </div>
        </div>
    </section>

    <!-- MODAL DE VIDEO VERTICAL -->
    <div id="videoModal" class="fixed inset-0 z-[100] hidden">
        <!-- Fondo oscuro transparente -->
        <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" onclick="cerrarModalVideo()"></div>

        <!-- Contenedor del video -->
        <div class="relative z-10 flex items-center justify-center w-full h-full p-4">
            <!-- Botón cerrar -->
            <button onclick="cerrarModalVideo()"
                class="absolute top-6 right-6 text-white hover:text-mts-copper transition z-20 group">
                <div
                    class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm border border-white/20 transition">
                    <i class="fas fa-times text-2xl"></i>
                </div>
            </button>

            <!-- Contenedor del video vertical -->
            <div class="relative w-full max-w-[350px] h-[80vh] max-h-[700px] rounded-2xl overflow-hidden shadow-2xl bg-black"
                data-aos="zoom-in">
                <!-- Video (reemplaza el src con tu video) -->
                <video id="videoPlayer" class="w-full h-full object-contain" controls playsinline>
                    <source src="{{ url('downloads/cumbia_mayor_vargas.mp4') }}" type="video/mp4">
                    Tu navegador no soporta el elemento de video.
                </video>

                <!-- Alternativa: Si usas YouTube o TikTok embebido -->
                <!--
                <iframe id="videoIframe"
                    class="w-full h-full"
                    src=""
                    title="Video Player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                -->
            </div>
        </div>
    </div>

    <!-- TESTIMONIOS (NUEVA SECCIÓN DE CONFIANZA) -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="font-display font-bold text-3xl text-mts-dark mb-12" data-aos="fade-up">LA VOZ DE LOS BARRIOS
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="/img/mts/resenia2.jpg" class="w-12 h-12 rounded-full">
                        <div class="text-left">
                            <p class="font-bold text-sm">Juana Mamani</p>
                            <p class="text-xs text-gray-500">Comerciante - La Ceja</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic text-sm">"Nadie nos había hablado de créditos para gremiales sin
                        tanto papeleo. David entiende lo que sufrimos los comerciantes."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="/img/mts/resenia1.jpg" class="w-12 h-12 rounded-full">
                        <div class="text-left">
                            <p class="font-bold text-sm">Carlos Quispe</p>
                            <p class="text-xs text-gray-500">Estudiante UPEA</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic text-sm">"El internet gratuito en las plazas y colegios es vital. Es
                        el único candidato que habla de tecnología real."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="/img/mts/resenia3.jpg" class="w-12 h-12 rounded-full">
                        <div class="text-left">
                            <p class="font-bold text-sm">Sra. Elena T.</p>
                            <p class="text-xs text-gray-500">Junta Vecinal Dist. 8</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic text-sm">"Lo vi caminar por mi barrio cuando no había campaña. Eso
                        me da confianza. Es uno de nosotros."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION (LEAD MAGNET) -->
    <section id="unete" class="py-24 bg-mts-dark text-white relative overflow-hidden">
        <!-- Elemento decorativo de fondo -->
        <div
            class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-mts-green opacity-20 blur-3xl animate-pulse">
        </div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-96 h-96 rounded-full bg-mts-copper opacity-20 blur-3xl">
        </div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10" data-aos="zoom-in">
            <h2 class="font-display font-bold text-4xl mb-4">¡EL ALTO TE NECESITA!</h2>
            <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">No mires el cambio desde la ventana. Únete al
                equipo digital, recibe propuestas y defiende tu voto.</p>

            <form
                class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/10 max-w-lg mx-auto shadow-2xl">
                <div class="space-y-4">
                    <div>
                        <input type="text" id="nombreUsuario" placeholder="Tu Nombre Completo"
                            class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-mts-copper/50 transition">
                    </div>

                    <div class="flex gap-2">
                        <select
                            class="px-2 py-3 rounded-lg bg-gray-100 text-gray-700 border-none outline-none font-bold">
                            <option>🇧🇴 +591</option>
                        </select>
                        <input type="tel" id="numeroUsuario" placeholder="Número de WhatsApp"
                            class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-mts-copper/50 transition">
                    </div>

                    <div class="flex items-start gap-2 text-left">
                        <input type="checkbox" id="terms" class="mt-1">
                        <label for="terms" class="text-xs text-gray-400">Acepto recibir información de la campaña
                            (No SPAM, solo propuestas).</label>
                    </div>

                    <button type="button" onclick="abrirWhatsApp()"
                        class="w-full bg-gradient-to-r from-mts-copper to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 rounded-lg shadow-lg transition transform hover:-translate-y-1 text-lg flex justify-center items-center gap-2">
                        <i class="fab fa-whatsapp"></i> QUIERO PARTICIPAR
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-white py-12 border-t border-gray-800">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-3 mb-2">
                    <div class="w-8 h-8 bg-mts-green rounded-full flex items-center justify-center text-xs font-bold">
                        MTS</div>
                    <h3 class="font-display font-bold text-2xl text-white">DAVID VARGAS</h3>
                </div>
                <p class="text-gray-500 text-sm max-w-xs">Compromiso, Lealtad y Trabajo por la ciudad más joven de
                    Bolivia.</p>
            </div>

            <div class="flex space-x-6">
                <a href="https://www.facebook.com/alcaldevaliente" target="_blank"
                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-mts-green hover:text-white transition duration-300"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="https://www.tiktok.com/@david_vargas_alcalde" target="_blank"
                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-black hover:text-white hover:border-white border border-transparent transition duration-300"><i
                        class="fab fa-tiktok"></i></a>
                <a href="https://www.instagram.com/davidvargas_la?igsh=dXR0bzV6cGQ4eXNy" target="_blank"
                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-pink-600 hover:text-white transition duration-300"><i
                        class="fab fa-instagram"></i></a>
                <a href="https://x.com/DavidVargas_ea" target="_blank"
                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-blue-400 hover:text-white transition duration-300"><i
                        class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="text-center mt-10 pt-8 border-t border-gray-900 text-gray-600 text-xs">
            <p>&copy; 2026 Movimiento Tercer Sistema | El Alto, Bolivia.</p>
            <p class="mt-2">Desarrollado con pasión patriótica.</p>
        </div>
    </footer>

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
</body>

</html>
