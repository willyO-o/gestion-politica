@extends('public.includes.main')


@section('contenido')
<!-- HERO SECTION -->
<section id="inicio" class="relative pt-20 min-h-[90vh] flex items-center clip-diagonal bg-gray-900 overflow-hidden">
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
                <a href="https://www.facebook.com/alcaldevaliente" target="_blank"
                    class="group flex items-center justify-center gap-3 px-8 py-4 rounded-lg border-2 border-white/30 hover:bg-white/10 text-white font-bold transition">
                    <i class="fab fa-facebook text-2xl group-hover:text-blue-500 transition-colors"></i> Síguenos
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
                <img src="/img/candidato/IMG6.jpeg" alt="David Vargas con el pueblo"
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

<section id="propuestas" class="py-24 bg-white clip-diagonal-reverse pb-32">
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
            <div onclick="abrirModalPilar(0)" class="cursor-pointer group/card p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 relative"
                data-aos="fade-up" data-aos-delay="0">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-shield-alt text-red-600 text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Seguridad</h4>
                <p class="text-sm text-gray-600 mb-4">Más patrullaje, iluminación pública, control de bares clandestinos
                    y trabajo conjunto con la Policía.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-mts-copper opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
            <!-- Pilar 2: Proyectos Estratégicos -->
            <div onclick="abrirModalPilar(1)" class="cursor-pointer group/card p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 relative"
                data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-city text-blue-600 text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Proyectos Estratégicos</h4>
                <p class="text-sm text-gray-600 mb-4">Carta orgánica, embovedado de ríos, autódromo, banco de sangre y
                    avenidas concluidas.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-mts-copper opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
            <!-- Pilar 3: Salud -->
            <div onclick="abrirModalPilar(2)" class="cursor-pointer group/card p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 relative"
                data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-full bg-teal-100 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-heartbeat text-teal-600 text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Salud</h4>
                <p class="text-sm text-gray-600 mb-4">Postas de salud, farmacias populares y centros de rehabilitación
                    accesibles.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-mts-copper opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
            <!-- Pilar 4: Educación -->
            <div onclick="abrirModalPilar(3)" class="cursor-pointer group/card p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 relative"
                data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-graduation-cap text-yellow-600 text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Educación</h4>
                <p class="text-sm text-gray-600 mb-4">Desayuno escolar nutritivo y aulas dignas para todos.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-mts-copper opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
            <!-- Pilar 5: Medio Ambiente -->
            <div onclick="abrirModalPilar(4)" class="cursor-pointer group/card p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 relative"
                data-aos="fade-up" data-aos-delay="400">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-leaf text-mts-green text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Medio Ambiente</h4>
                <p class="text-sm text-gray-600 mb-4">Industrialización de la basura y arborización urbana.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-mts-copper opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
            <!-- Pilar 6: Bienestar Animal -->
            <div onclick="abrirModalPilar(5)" class="cursor-pointer group/card p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 relative"
                data-aos="fade-up" data-aos-delay="500">
                <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-paw text-purple-600 text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Bienestar Animal</h4>
                <p class="text-sm text-gray-600 mb-4">Albergue hospital y cementerio municipal para mascotas.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-mts-copper opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
            <!-- Pilar 7: Ayuda Solidaria -->
            <div onclick="abrirModalPilar(6)" class="cursor-pointer group/card p-6 border border-gray-100 rounded-xl bg-gray-50 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition duration-300 relative"
                data-aos="fade-up" data-aos-delay="600">
                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-hands-helping text-mts-copper text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2 text-gray-800">Ayuda Solidaria</h4>
                <p class="text-sm text-gray-600 mb-4">Transporte gratuito para poblaciones vulnerables y guarderías
                    distritales.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-mts-copper opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
            <!-- Pilar Extra (Rostro Humano) -->
            <div onclick="abrirModalPilar(7)" class="cursor-pointer p-6 bg-gradient-to-br from-mts-green to-green-800 text-white rounded-xl shadow-lg transform md:scale-105 hover:shadow-2xl transition duration-300 group/card relative"
                data-aos="zoom-in" data-aos-delay="700">
                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center mb-4 group-hover/card:scale-110 transition duration-300">
                    <i class="fas fa-heart text-white text-xl"></i>
                </div>
                <h4 class="font-display font-bold text-lg mb-2">Rostro Humano</h4>
                <p class="text-sm opacity-90 mb-4">El centro de todo es la persona. Trato digno en oficinas públicas
                    garantizado.</p>
                <span class="inline-flex items-center gap-1 text-xs font-bold text-white/70 opacity-0 group-hover/card:opacity-100 transition duration-300"><i class="fas fa-plus-circle"></i> Ver proyectos</span>
            </div>
        </div>
    </div>
</section>


<!-- MODAL DE PILARES DEL CAMBIO -->
<div id="pilarModal" class="fixed inset-0 z-[100] pilar-modal-hidden" onclick="cerrarModalPilarBackdrop(event)">
    <!-- Fondo oscuro -->
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm pilar-modal-backdrop"></div>

    <!-- Contenedor del modal -->
    <div class="relative z-10 flex items-center justify-center w-full h-full p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden pilar-modal-content relative" onclick="event.stopPropagation()">
            <!-- Header del modal -->
            <div id="pilarModalHeader" class="sticky top-0 z-20 px-8 py-6 border-b border-gray-100 bg-white/95 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div id="pilarModalIcon" class="w-14 h-14 rounded-full flex items-center justify-center shrink-0">
                            <!-- Icono dinámico -->
                        </div>
                        <div>
                            <h3 id="pilarModalTitle" class="font-display font-bold text-2xl md:text-3xl text-mts-dark"></h3>
                            <p id="pilarModalSubtitle" class="text-sm text-gray-500 mt-1"></p>
                        </div>
                    </div>
                    <button onclick="cerrarModalPilar()" class="w-10 h-10 rounded-full bg-gray-100 hover:bg-red-100 flex items-center justify-center text-gray-500 hover:text-red-500 transition duration-200 shrink-0 ml-4">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Cuerpo del modal con proyectos -->
            <div id="pilarModalBody" class="px-8 py-6 overflow-y-auto" style="max-height: calc(90vh - 110px);">
                <!-- Descripción general -->
                <p id="pilarModalDesc" class="text-gray-600 text-base leading-relaxed mb-8 border-l-4 border-mts-copper pl-4"></p>

                <!-- Grid de proyectos (se llena dinámicamente) -->
                <div id="pilarModalProyectos" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Los proyectos se inyectan aquí por JavaScript -->
                </div>

                <!-- Nota al pie -->
                <div id="pilarModalFooterNote" class="mt-8 pt-6 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-400"><i class="fas fa-info-circle mr-1"></i> Los proyectos se irán actualizando conforme avance la planificación técnica.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECCIÓN MULTIMEDIA / VIDEO (NUEVA) -->
<section id="prensa" class="py-20 bg-mts-dark relative overflow-hidden">
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
                <a href="https://www.youtube.com/channel/UCbEmFFg1q9kdnykfOCMzGdw" target="_blank"
                    class="inline-flex items-center text-white font-bold hover:text-mts-copper transition">
                    Ver canal oficial de YouTube <i class="fas fa-external-link-alt ml-2"></i>
                </a>
            </div>
            <div style="border-radius: 10px; overflow: hidden">
                <iframe width="560" height="315"
                    src="https://www.youtube.com/embed/DNufAAlG0EM?si=g7czk6EbweN8vPOW" title="YouTube video player"
                    frameborder="0"
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

<section id="videos" class="py-20 bg-gray-50 relative overflow-hidden">
    <!-- Decoración sutil de fondo -->
    <div class="absolute top-0 right-0 w-72 h-72 bg-mts-green/5 rounded-full translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-56 h-56 bg-mts-copper/5 rounded-full -translate-x-1/3 translate-y-1/3"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-14" data-aos="fade-up">
            <h4 class="text-mts-copper font-bold tracking-widest uppercase mb-2 text-sm">Multimedia</h4>
            <h2 class="font-display font-bold text-3xl md:text-4xl text-mts-dark mb-3">Videos Destacados</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-mts-green to-mts-copper mx-auto rounded-full"></div>
            <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Conoce nuestras propuestas, actividades y el compromiso de David Vargas con El Alto a través de estos videos.</p>
        </div>

        <!-- Video Principal (destacado) -->
        <div class="mb-10" data-aos="zoom-in">
            <div class="relative max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-2xl border-4 border-gray-200 bg-black group">
                <div class="aspect-video">
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/pPD5Fd4_eOw" title="Video Destacado - David Vargas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>
        </div>

        <!-- Grid de videos secundarios -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Video 2 -->
            <div class="group" data-aos="fade-up" data-aos-delay="0">
                <div class="relative rounded-xl overflow-hidden shadow-lg border border-gray-200 bg-black hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                    <div class="aspect-video">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/V-uMyKPiNQ4" title="Video David Vargas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Video 3 -->
            <div class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="relative rounded-xl overflow-hidden shadow-lg border border-gray-200 bg-black hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                    <div class="aspect-video">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/PX3o_NEedQA" title="Video David Vargas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Video 4 -->
            <div class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="relative rounded-xl overflow-hidden shadow-lg border border-gray-200 bg-black hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                    <div class="aspect-video">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/QlkoMRs8_Cw" title="Video David Vargas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>

            <!-- Video 5 -->
            <div class="group" data-aos="fade-up" data-aos-delay="300">
                <div class="relative rounded-xl overflow-hidden shadow-lg border border-gray-200 bg-black hover:shadow-2xl hover:-translate-y-1 transition duration-300">
                    <div class="aspect-video">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/iyhvgb4XRnY" title="Video David Vargas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Short destacado -->
        <div class="mt-10 flex justify-center" data-aos="fade-up" data-aos-delay="400">
            <div class="relative max-w-xs w-full">
                <div class="text-center mb-4">
                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider shadow-md">
                        <i class="fab fa-youtube"></i> Short Viral
                    </span>
                </div>
                <div class="rounded-2xl overflow-hidden shadow-2xl border-2 border-gray-200 bg-black hover:shadow-xl transition duration-300 mx-auto" style="max-width: 315px;">
                    <div class="relative" style="padding-bottom: 177.78%;">
                        <iframe class="absolute inset-0 w-full h-full" src="https://www.youtube.com/embed/2fH7vUp-vig" title="Short David Vargas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón canal YouTube -->
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="https://www.youtube.com/channel/UCbEmFFg1q9kdnykfOCMzGdw" target="_blank"
                class="inline-flex items-center gap-3 bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1 hover:shadow-2xl text-lg">
                <i class="fab fa-youtube text-2xl"></i> Suscríbete a nuestro canal
                <i class="fas fa-external-link-alt text-sm opacity-70"></i>
            </a>
        </div>
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
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-mts-copper to-yellow-400">MAYOR
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
                        <div class="absolute top-4 right-4 text-2xl animate-bounce" style="animation-delay: 0.2s;">🎵
                        </div>
                        <div class="absolute top-12 left-4 text-xl animate-bounce" style="animation-delay: 0.5s;">
                            🎶</div>
                        <div class="absolute top-20 right-8 text-lg animate-bounce" style="animation-delay: 0.8s;">🎵
                        </div>

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
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 20px; animation-delay: 0.1s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 35px; animation-delay: 0.2s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 25px; animation-delay: 0.3s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 40px; animation-delay: 0.4s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 30px; animation-delay: 0.5s;">
            </div>
            <div class="w-2 bg-yellow-400 rounded-full animate-pulse" style="height: 50px; animation-delay: 0.6s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 35px; animation-delay: 0.7s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 45px; animation-delay: 0.8s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 25px; animation-delay: 0.9s;">
            </div>
            <div class="w-2 bg-yellow-400 rounded-full animate-pulse" style="height: 55px; animation-delay: 1s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 30px; animation-delay: 1.1s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 40px; animation-delay: 1.2s;">
            </div>
            <div class="w-2 bg-mts-copper rounded-full animate-pulse" style="height: 20px; animation-delay: 1.3s;">
            </div>
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

        <form class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/10 max-w-lg mx-auto shadow-2xl">
            <div class="space-y-4">
                <div>
                    <input type="text" id="nombreUsuario" placeholder="Tu Nombre Completo"
                        class="w-full px-4 py-3 rounded-lg bg-white/90 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-4 focus:ring-mts-copper/50 transition">
                </div>

                <div class="flex gap-2">
                    <select class="px-2 py-3 rounded-lg bg-gray-100 text-gray-700 border-none outline-none font-bold">
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

<!-- BOTONES FLOTANTES DE REDES SOCIALES -->
<div class="fixed left-6 top-[40%] -translate-y-1/2 z-50 flex flex-col gap-4" data-aos="fade-right" data-aos-delay="500">
    <!-- Facebook -->
    <a href="https://www.facebook.com/alcaldevaliente" target="_blank" rel="noopener noreferrer"
        class="group flex items-center justify-center w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-2xl relative overflow-hidden"
        aria-label="Síguenos en Facebook">
        <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform duration-300 rounded-full"></div>
        <i class="fab fa-facebook-f text-xl relative z-10"></i>
    </a>

    <!-- YouTube -->
    <a href="https://www.youtube.com/channel/UCbEmFFg1q9kdnykfOCMzGdw" target="_blank" rel="noopener noreferrer"
        class="group flex items-center justify-center w-14 h-14 bg-red-600 hover:bg-red-700 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-2xl relative overflow-hidden"
        aria-label="Suscríbete en YouTube">
        <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform duration-300 rounded-full"></div>
        <i class="fab fa-youtube text-xl relative z-10"></i>
    </a>

    <!-- TikTok -->
    <a href="https://www.tiktok.com/@davaflor" target="_blank" rel="noopener noreferrer"
        class="group flex items-center justify-center w-14 h-14 bg-black hover:bg-gray-900 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-2xl relative overflow-hidden border-2 border-white/20"
        aria-label="Síguenos en TikTok">
        <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform duration-300 rounded-full"></div>
        <i class="fab fa-tiktok text-xl relative z-10"></i>
    </a>

    <!-- Instagram -->
    <a href="https://www.instagram.com/david_vargas_alcalde" target="_blank" rel="noopener noreferrer"
        class="group flex items-center justify-center w-14 h-14 bg-gradient-to-br from-purple-600 via-pink-600 to-orange-500 hover:from-purple-700 hover:via-pink-700 hover:to-orange-600 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-2xl relative overflow-hidden"
        aria-label="Síguenos en Instagram">
        <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform duration-300 rounded-full"></div>
        <i class="fab fa-instagram text-xl relative z-10"></i>
    </a>

    <!-- WhatsApp -->
    <a href="https://whatsapp.com/channel/0029Vb7imk5EQIav20vde90Y" target="_blank" rel="noopener noreferrer"
        class="group flex items-center justify-center w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg transition-all duration-300 hover:scale-110 hover:shadow-2xl relative overflow-hidden animate-pulse"
        aria-label="Contáctanos por WhatsApp">
        <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform duration-300 rounded-full"></div>
        <i class="fab fa-whatsapp text-xl relative z-10"></i>
    </a>
</div>

@endsection
