@extends('public.includes.main')

@section('contenido')
    <!-- HERO SECTION -->
    <section id="inicio"
        class="relative pt-32 pb-20 min-h-[40vh] flex items-center clip-diagonal bg-gray-900 overflow-hidden">
        <!-- Background Image Parallax -->
        <div class="absolute inset-0 z-0 transform scale-105">
            <img src="/img/candidato/IMG5.jpg" alt="El Alto Fondo" class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 hero-gradient"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center w-full" data-aos="fade-up">
            <h1 class="font-display font-bold text-5xl md:text-7xl text-white leading-tight mb-4 drop-shadow-lg">
                Multimedia
            </h1>
            <p class="text-xl md:text-2xl font-light text-gray-200 max-w-3xl mx-auto">
                El sonido y la imagen de nuestra campaña. Escucha nuestro álbum y mira los videoclips que marcan el
                ritmo del cambio.
            </p>
        </div>
    </section>

    <!-- SECCIÓN ÁLBUM DE CUMBIAS -->
    <section id="album-cumbias" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display font-bold text-4xl text-mts-green mb-4">ESCUCHA EL ÁLBUM DEL CAMBIO VOL. 1</h2>
                <div class="w-24 h-1.5 bg-mts-copper mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto text-lg">
                    La música que nos une y nos mueve. Dale play a la alegría de un pueblo que quiere un futuro digno.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                <!-- Cover del Álbum -->
                <div class="lg:col-span-1" data-aos="fade-right">
                    <div
                        class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-gray-200 group cursor-pointer">
                        <img src="/img/candidato/candidato3.png" alt="Cover del Álbum"
                            class="w-full h-auto object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6">
                            <div>
                                <h3 class="font-display text-white text-3xl font-bold">Álbum del Cambio</h3>
                                <p class="text-mts-copper font-semibold">David Vargas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Canciones -->
                <div class="lg:col-span-2" data-aos="fade-left">
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        <div class="space-y-3">
                            <!-- Canción 1 -->
                            <div
                                class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-200 transition duration-300 group">
                                <div class="flex items-center gap-4">
                                    <button
                                        class="w-10 h-10 bg-mts-copper text-white rounded-full flex items-center justify-center shadow-md group-hover:bg-mts-green transition">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <div>
                                        <p class="font-bold text-mts-dark group-hover:text-mts-green">La Cumbia del Mayor
                                            Vargas</p>
                                        <p class="text-sm text-gray-500">3:15</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Compartir">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- Canción 2 -->
                            <div
                                class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-200 transition duration-300 group bg-gray-100 border-l-4 border-mts-copper">
                                <div class="flex items-center gap-4">
                                    <button
                                        class="w-10 h-10 bg-mts-green text-white rounded-full flex items-center justify-center shadow-md">
                                        <i class="fas fa-pause"></i>
                                    </button>
                                    <div>
                                        <p class="font-bold text-mts-green">El Alto se Levanta (Remix)</p>
                                        <p class="text-sm text-gray-500">2:58</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Compartir">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- Canción 3 -->
                            <div
                                class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-200 transition duration-300 group">
                                <div class="flex items-center gap-4">
                                    <button
                                        class="w-10 h-10 bg-mts-copper text-white rounded-full flex items-center justify-center shadow-md group-hover:bg-mts-green transition">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <div>
                                        <p class="font-bold text-mts-dark group-hover:text-mts-green">Corazón Valiente
                                        </p>
                                        <p class="text-sm text-gray-500">3:40</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Compartir">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- Canción 4 -->
                            <div
                                class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-200 transition duration-300 group">
                                <div class="flex items-center gap-4">
                                    <button
                                        class="w-10 h-10 bg-mts-copper text-white rounded-full flex items-center justify-center shadow-md group-hover:bg-mts-green transition">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <div>
                                        <p class="font-bold text-mts-dark group-hover:text-mts-green">La Cumbia del Tercer
                                            Sistema</p>
                                        <p class="text-sm text-gray-500">3:05</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Descargar">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#"
                                        class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                        title="Compartir">
                                        <i class="fas fa-share-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN VIDEOCLIPS -->
    <section id="videoclips" class="py-24 bg-mts-dark text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'0 0 2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-display font-bold text-4xl text-white mb-4">VIDEOCLIPS OFICIALES</h2>
                <div class="w-24 h-1.5 bg-mts-copper mx-auto rounded-full"></div>
                <p class="mt-4 text-gray-300 max-w-2xl mx-auto text-lg">
                    Imágenes que hablan, historias que inspiran. Mira los momentos que definen nuestra campaña.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Video 1 -->
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-2xl overflow-hidden group transform hover:-translate-y-2 transition duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="relative aspect-video cursor-pointer">
                        <img src="/img/candidato/IMG5.jpg" alt="Thumbnail Video 1"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                            <div
                                class="w-16 h-16 bg-mts-copper rounded-full flex items-center justify-center text-white text-2xl">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-xl text-white mb-2">Spot Oficial: Un Alcalde Valiente
                        </h3>
                        <p class="text-sm text-gray-400">Un minuto que resume el porqué de nuestra lucha por El Alto.
                        </p>
                    </div>
                </div>

                <!-- Video 2 -->
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-2xl overflow-hidden group transform hover:-translate-y-2 transition duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="relative aspect-video cursor-pointer">
                        <img src="/img/candidato/candidato3.png" alt="Thumbnail Video 2"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                            <div
                                class="w-16 h-16 bg-mts-copper rounded-full flex items-center justify-center text-white text-2xl">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-xl text-white mb-2">Mensaje a la Juventud</h3>
                        <p class="text-sm text-gray-400">David Vargas habla sobre el futuro, la tecnología y las
                            oportunidades para los jóvenes alteños.</p>
                    </div>
                </div>

                <!-- Video 3 -->
                <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-2xl overflow-hidden group transform hover:-translate-y-2 transition duration-300"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="relative aspect-video cursor-pointer">
                        <img src="/img/mts/resenia1.jpg" alt="Thumbnail Video 3"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                            <div
                                class="w-16 h-16 bg-mts-copper rounded-full flex items-center justify-center text-white text-2xl">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-display font-bold text-xl text-white mb-2">Recorriendo los Distritos</h3>
                        <p class="text-sm text-gray-400">Escuchando a los vecinos, conociendo sus problemas de cerca.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-16" data-aos="fade-up">
                <a href="https://www.youtube.com" target="_blank"
                    class="bg-mts-copper hover:bg-mts-copperDark text-white px-8 py-4 rounded-lg font-bold text-lg shadow-xl transition transform hover:-translate-y-1">
                    Ver más en YouTube <i class="fab fa-youtube ml-2"></i>
                </a>
            </div>
        </div>
    </section>
@endsection
