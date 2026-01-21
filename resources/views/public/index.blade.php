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
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;700&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">

    <!-- FontAwesome para Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS (CDN para prototipado rápido) -->
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
                            copper: '#D98D5F',
                            /* Color de Acento/Botones */
                            dark: '#1A1A1A',
                            /* Texto Oscuro */
                            light: '#F8F9FA',
                            /* Fondos Suaves */
                        }
                    },
                    fontFamily: {
                        display: ['Oswald', 'sans-serif'],
                        body: ['Roboto', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Estilos base adicionales */
        .clip-diagonal {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .hero-gradient {
            background: linear-gradient(to right, rgba(0, 104, 55, 0.95), rgba(0, 104, 55, 0.7));
        }

        /* Animación suave para el menú móvil */
        #mobile-menu {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>

<body class="font-body text-mts-dark bg-white antialiased">

    <!-- NAV BAR -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/95 backdrop-blur-md shadow-md" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <!-- Icono simulando logo -->
                    <div
                        class="w-10 h-10 bg-mts-green rounded-full flex items-center justify-center text-white font-display font-bold text-xl">
                        MTS
                    </div>
                    <div>
                        <h1 class="font-display font-bold text-2xl text-mts-green leading-none">DAVID VARGAS</h1>
                        <span class="text-xs font-bold text-mts-copper tracking-widest uppercase">Alcalde 2026</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#inicio" class="text-mts-dark hover:text-mts-copper font-medium transition">Inicio</a>
                    <a href="#propuestas" class="text-mts-dark hover:text-mts-copper font-medium transition">Propuestas
                        Clave</a>
                    <a href="#plan" class="text-mts-dark hover:text-mts-copper font-medium transition">Plan de
                        Gobierno</a>
                    <a href="#unete"
                        class="bg-mts-copper hover:bg-orange-600 text-white px-6 py-2 rounded-full font-bold transition shadow-lg transform hover:-translate-y-0.5">
                        <i class="fab fa-whatsapp mr-2"></i> Únete al Equipo
                    </a>
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-mts-green text-2xl focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu"
            class="hidden md:hidden absolute top-20 left-0 w-full bg-white shadow-xl border-t border-gray-100">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#inicio"
                    class="block px-3 py-3 text-base font-medium text-mts-green hover:bg-gray-50 rounded">Inicio</a>
                <a href="#propuestas"
                    class="block px-3 py-3 text-base font-medium text-mts-dark hover:bg-gray-50 rounded">Propuestas</a>
                <a href="#plan"
                    class="block px-3 py-3 text-base font-medium text-mts-dark hover:bg-gray-50 rounded">Plan
                    Completo</a>
                <a href="#unete"
                    class="block px-3 py-3 text-base font-bold text-mts-copper hover:bg-gray-50 rounded">Sumarse al
                    Cambio</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="inicio" class="relative pt-20 min-h-[90vh] flex items-center clip-diagonal bg-gray-900">
        <!-- Background Image Placeholder (Reemplazar con foto real del candidato/banner) -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop"
                alt="El Alto Fondo" class="w-full h-full object-cover opacity-40">
            <!-- Capa verde encima de la foto -->
            <div class="absolute inset-0 hero-gradient"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
            <div class="w-full md:w-2/3 text-white py-12">
                <div
                    class="inline-block bg-mts-copper text-white px-4 py-1 rounded-sm font-bold text-sm mb-4 tracking-wider uppercase">
                    Gestión 2026 - 2031
                </div>
                <h1 class="font-display font-bold text-5xl md:text-7xl leading-tight mb-6">
                    ¡POR UNA CIUDAD VALIENTE,<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300">UN ALCALDE
                        VALIENTE!</span>
                </h1>
                <p class="text-xl md:text-2xl font-light mb-8 max-w-2xl text-gray-100">
                    Un Gobierno con Rostro Humano para El Alto. Priorizamos tu dignidad, seguridad y bolsillo.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#propuestas"
                        class="bg-mts-copper hover:bg-orange-600 text-white text-center px-8 py-4 rounded font-bold text-lg shadow-xl transition transform hover:-translate-y-1">
                        Conoce las Propuestas
                    </a>
                    <a href="#plan"
                        class="border-2 border-white hover:bg-white hover:text-mts-green text-white text-center px-8 py-4 rounded font-bold text-lg transition">
                        Descargar Plan
                    </a>
                </div>
            </div>

            <!-- Espacio para foto del candidato (Recortada sin fondo idealmente) -->
            <div class="hidden md:block w-1/3 h-full relative">
                <!-- Placeholder visual de donde iría la foto recortada -->
                <div
                    class="border-4 border-mts-copper rounded-lg p-2 bg-white/10 backdrop-blur-sm transform rotate-3 mt-10">
                    <div class="bg-gray-300 h-96 w-full flex items-center justify-center text-gray-500 font-bold">
                        [FOTO CANDIDATO AQUÍ]
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROPUESTAS DESTACADAS (HOOKS) -->
    <section id="propuestas" class="py-20 bg-mts-light -mt-20 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-display font-bold text-4xl text-mts-green mb-4">MEDIDAS URGENTES</h2>
                <div class="w-24 h-1 bg-mts-copper mx-auto"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Acciones inmediatas para mejorar la calidad de vida de
                    las familias alteñas.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-b-4 border-mts-copper hover:shadow-2xl transition transform hover:-translate-y-2 group">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-mts-green transition">
                        <i class="fas fa-bus text-3xl text-mts-green group-hover:text-white transition"></i>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-gray-800 mb-3">Pasaje Cero</h3>
                    <p class="text-gray-600">Transporte gratuito en Wayna Bus para <strong>niños menores de 12
                            años</strong> y adultos mayores. Apoyo directo a la economía familiar.</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-b-4 border-mts-copper hover:shadow-2xl transition transform hover:-translate-y-2 group">
                    <div
                        class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-mts-copper transition">
                        <i class="fas fa-dog text-3xl text-mts-copper group-hover:text-white transition"></i>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-gray-800 mb-3">Seguridad Canina</h3>
                    <p class="text-gray-600">Rescate de canes callejeros para entrenarlos como <strong>unidad de
                            patrullaje policial</strong>. Seguridad ciudadana con bienestar animal.</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-b-4 border-mts-copper hover:shadow-2xl transition transform hover:-translate-y-2 group">
                    <div
                        class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 group-hover:bg-mts-green transition">
                        <i class="fas fa-pills text-3xl text-mts-green group-hover:text-white transition"></i>
                    </div>
                    <h3 class="font-display font-bold text-2xl text-gray-800 mb-3">Farmacias del Pueblo</h3>
                    <p class="text-gray-600">Venta de medicamentos genéricos de calidad a <strong>precio de
                            costo</strong>. Sin intermediarios, directo de laboratorios al vecino.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- EL PLAN DE GOBIERNO (GRID DETALLADO) -->
    <section id="plan" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <h2 class="font-display font-bold text-4xl text-mts-green">LOS 7 PILARES DEL CAMBIO</h2>
                    <p class="text-gray-500 mt-2">Un plan estructurado para el desarrollo integral.</p>
                </div>
                <button class="hidden md:block text-mts-copper font-bold hover:text-orange-700 underline">Descargar
                    documento PDF</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pilar 1 -->
                <div class="p-6 border border-gray-100 rounded-lg bg-gray-50 hover:bg-white hover:shadow-md transition">
                    <i class="fas fa-university text-mts-green text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Institucionalidad</h4>
                    <p class="text-sm text-gray-600">Aprobación inmediata de la Carta Orgánica Municipal.</p>
                </div>
                <!-- Pilar 2 -->
                <div
                    class="p-6 border border-gray-100 rounded-lg bg-gray-50 hover:bg-white hover:shadow-md transition">
                    <i class="fas fa-shield-alt text-mts-green text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Seguridad Inteligente</h4>
                    <p class="text-sm text-gray-600">Centro de Control Municipal con monitoreo en tiempo real.</p>
                </div>
                <!-- Pilar 3 -->
                <div
                    class="p-6 border border-gray-100 rounded-lg bg-gray-50 hover:bg-white hover:shadow-md transition">
                    <i class="fas fa-heartbeat text-mts-green text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Salud Universal</h4>
                    <p class="text-sm text-gray-600">Vacunación 100% y fortalecimiento de infraestructura.</p>
                </div>
                <!-- Pilar 4 -->
                <div
                    class="p-6 border border-gray-100 rounded-lg bg-gray-50 hover:bg-white hover:shadow-md transition">
                    <i class="fas fa-wifi text-mts-green text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Educación Digna</h4>
                    <p class="text-sm text-gray-600">Calefacción en aulas y WiFi gratuito en escuelas.</p>
                </div>
                <!-- Pilar 5 -->
                <div
                    class="p-6 border border-gray-100 rounded-lg bg-gray-50 hover:bg-white hover:shadow-md transition">
                    <i class="fas fa-recycle text-mts-green text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Medio Ambiente</h4>
                    <p class="text-sm text-gray-600">Convertir basura en energía y plantas de reciclaje.</p>
                </div>
                <!-- Pilar 6 -->
                <div
                    class="p-6 border border-gray-100 rounded-lg bg-gray-50 hover:bg-white hover:shadow-md transition">
                    <i class="fas fa-road text-mts-green text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Infraestructura</h4>
                    <p class="text-sm text-gray-600">Mantenimiento vial y ampliación de rutas Wayna Bus.</p>
                </div>
                <!-- Pilar 7 -->
                <div
                    class="p-6 border border-gray-100 rounded-lg bg-gray-50 hover:bg-white hover:shadow-md transition">
                    <i class="fas fa-coins text-mts-green text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Economía</h4>
                    <p class="text-sm text-gray-600">Banco Municipal de fomento y microcréditos.</p>
                </div>
                <!-- Pilar Extra (Humano) -->
                <div class="p-6 bg-mts-green text-white rounded-lg shadow-lg transform md:scale-105">
                    <i class="fas fa-hands-helping text-white text-2xl mb-4"></i>
                    <h4 class="font-display font-bold text-lg mb-2">Rostro Humano</h4>
                    <p class="text-sm opacity-90">Centro de rehabilitación integral y oportunidades reales.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION (LEAD MAGNET) -->
    <section id="unete" class="py-20 bg-mts-dark text-white relative overflow-hidden">
        <!-- Elemento decorativo de fondo -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-mts-green opacity-20 blur-3xl">
        </div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-mts-copper opacity-20 blur-3xl">
        </div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="font-display font-bold text-4xl mb-4">EL ALTO NECESITA TU FUERZA</h2>
            <p class="text-xl text-gray-300 mb-8">El cambio lo construimos entre todos. Únete al equipo digital y
                recibe las noticias de campaña.</p>

            <form class="bg-white/10 backdrop-blur-md p-8 rounded-xl border border-white/10 max-w-lg mx-auto">
                <div class="space-y-4">
                    <input type="text" placeholder="Tu Nombre Completo"
                        class="w-full px-4 py-3 rounded bg-white/90 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-mts-copper">

                    <div class="flex gap-2">
                        <select class="px-2 py-3 rounded bg-gray-100 text-gray-700 border-none outline-none">
                            <option>+591</option>
                        </select>
                        <input type="tel" placeholder="Número de WhatsApp"
                            class="w-full px-4 py-3 rounded bg-white/90 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-mts-copper">
                    </div>

                    <button type="button"
                        class="w-full bg-mts-copper hover:bg-orange-600 text-white font-bold py-4 rounded shadow-lg transition text-lg">
                        <i class="fab fa-whatsapp mr-2"></i> QUIERO PARTICIPAR
                    </button>
                    <p class="text-xs text-gray-400 mt-2">Tus datos están protegidos. Movimiento Tercer Sistema.</p>
                </div>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-black text-white py-12 border-t border-gray-800">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <h3 class="font-display font-bold text-2xl text-mts-green">DAVID VARGAS</h3>
                <p class="text-gray-500 text-sm mt-1">Candidato a la Alcaldía de El Alto 2026</p>
            </div>

            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-mts-copper text-2xl transition"><i
                        class="fab fa-facebook"></i></a>
                <a href="#" class="text-gray-400 hover:text-mts-copper text-2xl transition"><i
                        class="fab fa-tiktok"></i></a>
                <a href="#" class="text-gray-400 hover:text-mts-copper text-2xl transition"><i
                        class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-400 hover:text-mts-copper text-2xl transition"><i
                        class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="text-center mt-8 pt-8 border-t border-gray-800 text-gray-600 text-sm">
            &copy; 2026 Movimiento Tercer Sistema. Todos los derechos reservados.
        </div>
    </footer>

    <!-- JS simple para menú móvil -->
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
                navbar.classList.add('shadow-lg');
                navbar.classList.remove('py-2');
            } else {
                navbar.classList.remove('shadow-lg');
                navbar.classList.add('py-2');
            }
        });
    </script>
</body>

</html>
