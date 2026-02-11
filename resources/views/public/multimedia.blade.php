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
                    <div id="album-cover"
                        class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-gray-200 group cursor-pointer">
                        <img src="/img/candidato/candidato3.png" alt="Cover del Álbum"
                            class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <!-- Botón Play (visible solo con hover) -->
                        <div
                            class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div
                                class="w-20 h-20 bg-mts-copper rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-play text-white text-3xl ml-1"></i>
                            </div>
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-6 pointer-events-none">
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
                        @php
                            $audioFiles = [];
                            try {
                                $audioFiles = collect(\Illuminate\Support\Facades\File::files(public_path('downloads')))
                                    ->filter(function ($file) {
                                        return strtolower($file->getExtension()) === 'mp3';
                                    })
                                    ->map(function ($file) {
                                        return $file->getFilename();
                                    })
                                    ->values();
                            } catch (\Exception $e) {
                                $audioFiles = collect();
                            }

                            $priority = 'cumbia_mayor_vargas.mp3';
                            $audioFiles = $audioFiles
                                ->sortBy(function ($file) use ($priority) {
                                    return $file === $priority ? '0-' . $file : '1-' . $file;
                                })
                                ->values();
                        @endphp

                        <audio id="album-audio" class="hidden" preload="metadata"></audio>

                        <div class="space-y-4" id="album-tracks">
                            @forelse ($audioFiles as $index => $file)
                                @php
                                    $name = pathinfo($file, PATHINFO_FILENAME);
                                    $label = ucwords(str_replace(['-', '_'], ' ', $name));
                                    $src = asset('downloads/' . $file);
                                @endphp
                                <div class="track-item p-3 rounded-lg hover:bg-gray-200 transition duration-300 group"
                                    data-track-index="{{ $index }}">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4 flex-1">
                                            <button type="button"
                                                class="track-play-btn w-10 h-10 bg-mts-copper text-white rounded-full flex items-center justify-center shadow-md group-hover:bg-mts-green transition"
                                                data-audio-src="{{ $src }}" data-audio-title="{{ $label }}"
                                                aria-label="Reproducir {{ $label }}">
                                                <i class="fas fa-play"></i>
                                            </button>
                                            <div class="flex-1">
                                                <p class="font-bold text-mts-dark group-hover:text-mts-green">
                                                    {{ $label }}</p>
                                                <p class="text-sm text-gray-500 track-duration">--:--</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <a href="{{ $src }}" download
                                                class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                                title="Descargar {{ $label }}"
                                                aria-label="Descargar {{ $label }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button type="button"
                                                class="text-gray-400 hover:text-mts-copper transition transform hover:scale-110"
                                                title="Compartir {{ $label }}"
                                                aria-label="Compartir {{ $label }}"
                                                data-share-title="{{ $label }}"
                                                data-share-url="{{ $src }}">
                                                <i class="fas fa-share-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Barra de progreso individual (oculta por defecto) -->
                                    <div class="track-progress-container hidden mt-3 px-14">
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="track-current-time text-xs text-gray-600 font-mono w-10">0:00</span>
                                            <div class="flex-1 relative">
                                                <input type="range"
                                                    class="track-progress-bar w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                                                    min="0" max="100" value="0" step="0.1"
                                                    style="background: linear-gradient(to right, #10b981 0%, #10b981 0%, #e5e7eb 0%, #e5e7eb 100%);">
                                            </div>
                                            <span
                                                class="track-duration-time text-xs text-gray-600 font-mono w-10">0:00</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center text-gray-500 py-6">
                                    No se encontraron canciones en la carpeta de descargas.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Compartir -->
        <div id="share-modal"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-mts-dark">Compartir Canción</h3>
                        <button type="button" id="close-share-modal" class="text-gray-400 hover:text-gray-600 transition">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <p id="share-song-title" class="text-gray-600 mb-6">Comparte esta canción</p>
                    <div class="grid grid-cols-2 gap-3">
                        <button type="button" data-share-platform="facebook"
                            class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 hover:border-blue-600 hover:bg-blue-50 transition group">
                            <i class="fab fa-facebook text-2xl text-blue-600"></i>
                            <span class="font-semibold text-gray-700 group-hover:text-blue-600">Facebook</span>
                        </button>
                        <button type="button" data-share-platform="whatsapp"
                            class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 hover:border-green-600 hover:bg-green-50 transition group">
                            <i class="fab fa-whatsapp text-2xl text-green-600"></i>
                            <span class="font-semibold text-gray-700 group-hover:text-green-600">WhatsApp</span>
                        </button>
                        <button type="button" data-share-platform="twitter"
                            class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 hover:border-sky-500 hover:bg-sky-50 transition group">
                            <i class="fab fa-twitter text-2xl text-sky-500"></i>
                            <span class="font-semibold text-gray-700 group-hover:text-sky-500">Twitter</span>
                        </button>
                        <button type="button" data-share-platform="telegram"
                            class="flex items-center gap-3 p-4 rounded-lg border-2 border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition group">
                            <i class="fab fa-telegram text-2xl text-blue-500"></i>
                            <span class="font-semibold text-gray-700 group-hover:text-blue-500">Telegram</span>
                        </button>
                        <button type="button" data-share-platform="copy"
                            class="col-span-2 flex items-center justify-center gap-3 p-4 rounded-lg border-2 border-gray-200 hover:border-mts-copper hover:bg-orange-50 transition group">
                            <i class="fas fa-copy text-xl text-mts-copper"></i>
                            <span class="font-semibold text-gray-700 group-hover:text-mts-copper">Copiar Enlace</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Video -->
        <div id="video-modal"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm">
            <div class="relative max-w-sm mx-4">
                <button type="button" id="close-video-modal"
                    class="absolute -top-14 left-1/2 transform -translate-x-1/2 text-white hover:text-mts-copper transition text-2xl bg-black/50 w-10 h-10 rounded-full flex items-center justify-center">
                    <i class="fas fa-times"></i>
                </button>
                <!-- Marco estilo móvil -->
                <div class="relative bg-gradient-to-b from-gray-800 via-gray-900 to-black rounded-3xl p-4 shadow-2xl"
                    style="box-shadow: 0 0 80px rgba(0,0,0,0.8);">
                    <!-- Notch/Cámara superior -->
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-32 h-6 bg-black rounded-b-3xl z-10">
                    </div>
                    <!-- Pantalla del video -->
                    <div class="relative bg-black rounded-2xl overflow-hidden" style="aspect-ratio: 9/16;">
                        <video id="album-video" controls class="w-full h-full object-cover" preload="metadata">
                            <source src="{{ asset('downloads/cumbia_mayor_vargas.mp4') }}" type="video/mp4">
                            Tu navegador no soporta la reproducción de video.
                        </video>
                    </div>
                    <!-- Botón home inferior -->
                    <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-32 h-1 bg-gray-600 rounded-full">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var audio = document.getElementById('album-audio');
            if (!audio) {
                return;
            }

            var trackButtons = document.querySelectorAll('.track-play-btn');
            var shareButtons = document.querySelectorAll('[data-share-url]');
            var trackItems = document.querySelectorAll('.track-item');
            var activeTrackItem = null;
            var activeButton = null;
            var isSeeking = false;

            // Modal de video
            var albumCover = document.getElementById('album-cover');
            var videoModal = document.getElementById('video-modal');
            var closeVideoModal = document.getElementById('close-video-modal');
            var albumVideo = document.getElementById('album-video');

            // Abrir modal de video al hacer clic en el cover
            if (albumCover && videoModal && albumVideo) {
                albumCover.addEventListener('click', function() {
                    videoModal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                    albumVideo.play().catch(function() {
                        // Manejar error de reproducción
                    });
                });

                // Cerrar modal de video
                closeVideoModal.addEventListener('click', function() {
                    albumVideo.pause();
                    albumVideo.currentTime = 0;
                    videoModal.classList.add('hidden');
                    document.body.style.overflow = '';
                });

                // Cerrar modal al hacer clic fuera del video
                videoModal.addEventListener('click', function(e) {
                    if (e.target === videoModal) {
                        albumVideo.pause();
                        albumVideo.currentTime = 0;
                        videoModal.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                });

                // Cerrar modal con tecla ESC
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !videoModal.classList.contains('hidden')) {
                        albumVideo.pause();
                        albumVideo.currentTime = 0;
                        videoModal.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                });
            }

            function formatTime(seconds) {
                if (isNaN(seconds) || seconds === Infinity) {
                    return '0:00';
                }
                var mins = Math.floor(seconds / 60);
                var secs = Math.floor(seconds % 60);
                return mins + ':' + (secs < 10 ? '0' : '') + secs;
            }

            function resetAllTracks() {
                trackButtons.forEach(function(button) {
                    button.classList.remove('bg-mts-green');
                    button.classList.add('bg-mts-copper');
                    var icon = button.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-pause');
                        icon.classList.add('fa-play');
                    }
                });
                trackItems.forEach(function(item) {
                    var progressContainer = item.querySelector('.track-progress-container');
                    if (progressContainer) {
                        progressContainer.classList.add('hidden');
                    }
                });
            }

            function markTrackPlaying(trackItem, button) {
                resetAllTracks();
                button.classList.remove('bg-mts-copper');
                button.classList.add('bg-mts-green');
                var icon = button.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-play');
                    icon.classList.add('fa-pause');
                }
                var progressContainer = trackItem.querySelector('.track-progress-container');
                if (progressContainer) {
                    progressContainer.classList.remove('hidden');
                }
            }

            function updateTrackProgress(trackItem) {
                if (!trackItem || isSeeking || !audio.duration) return;

                var progressBar = trackItem.querySelector('.track-progress-bar');
                var currentTimeEl = trackItem.querySelector('.track-current-time');
                var durationTimeEl = trackItem.querySelector('.track-duration-time');

                if (progressBar && currentTimeEl && durationTimeEl) {
                    var percent = (audio.currentTime / audio.duration) * 100;
                    progressBar.value = percent;
                    progressBar.style.background = 'linear-gradient(to right, #10b981 0%, #10b981 ' + percent +
                        '%, #e5e7eb ' + percent + '%, #e5e7eb 100%)';
                    currentTimeEl.textContent = formatTime(audio.currentTime);
                    durationTimeEl.textContent = formatTime(audio.duration);
                }
            }

            // Cargar duraciones de todas las canciones al inicio
            function loadAllDurations() {
                trackButtons.forEach(function(button) {
                    var src = button.getAttribute('data-audio-src');
                    var trackItem = button.closest('.track-item');
                    var durationEl = trackItem.querySelector('.track-duration');

                    if (src && durationEl) {
                        var tempAudio = new Audio();
                        tempAudio.preload = 'metadata';
                        tempAudio.addEventListener('loadedmetadata', function() {
                            durationEl.textContent = formatTime(tempAudio.duration);
                        });
                        tempAudio.src = src;
                    }
                });
            }

            // Cargar las duraciones al iniciar
            loadAllDurations();

            trackButtons.forEach(function(button, index) {
                var trackItem = button.closest('.track-item');

                button.addEventListener('click', function() {
                    var src = button.getAttribute('data-audio-src');
                    if (!src) {
                        return;
                    }

                    if (activeButton === button && !audio.paused) {
                        audio.pause();
                        resetAllTracks();
                        activeButton = null;
                        activeTrackItem = null;
                        return;
                    }

                    if (audio.src !== src) {
                        audio.src = src;
                    }

                    audio.play().then(function() {
                        activeButton = button;
                        activeTrackItem = trackItem;
                        markTrackPlaying(trackItem, button);
                    }).catch(function() {
                        resetAllTracks();
                        activeButton = null;
                        activeTrackItem = null;
                    });
                });

                // Configurar la barra de progreso de cada track
                var progressBar = trackItem.querySelector('.track-progress-bar');
                if (progressBar) {
                    progressBar.addEventListener('mousedown', function() {
                        isSeeking = true;
                    });

                    progressBar.addEventListener('mouseup', function() {
                        isSeeking = false;
                    });

                    progressBar.addEventListener('input', function() {
                        if (activeTrackItem === trackItem && audio.duration) {
                            var time = (progressBar.value / 100) * audio.duration;
                            audio.currentTime = time;
                            var percent = progressBar.value;
                            progressBar.style.background =
                                'linear-gradient(to right, #10b981 0%, #10b981 ' + percent +
                                '%, #e5e7eb ' + percent + '%, #e5e7eb 100%)';
                            var currentTimeEl = trackItem.querySelector('.track-current-time');
                            if (currentTimeEl) {
                                currentTimeEl.textContent = formatTime(time);
                            }
                        }
                    });
                }
            });

            audio.addEventListener('loadedmetadata', function() {
                if (activeTrackItem) {
                    var durationEl = activeTrackItem.querySelector('.track-duration');
                    var durationTimeEl = activeTrackItem.querySelector('.track-duration-time');
                    if (durationEl) {
                        durationEl.textContent = formatTime(audio.duration);
                    }
                    if (durationTimeEl) {
                        durationTimeEl.textContent = formatTime(audio.duration);
                    }
                }
            });

            audio.addEventListener('timeupdate', function() {
                if (activeTrackItem) {
                    updateTrackProgress(activeTrackItem);
                }
            });

            audio.addEventListener('ended', function() {
                resetAllTracks();
                activeButton = null;
                activeTrackItem = null;
            });

            // Variables para el modal de compartir
            var shareModal = document.getElementById('share-modal');
            var closeShareModal = document.getElementById('close-share-modal');
            var shareSongTitle = document.getElementById('share-song-title');
            var sharePlatformButtons = document.querySelectorAll('[data-share-platform]');
            var currentShareUrl = '';
            var currentShareTitle = '';

            // Abrir modal de compartir
            shareButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    currentShareTitle = button.getAttribute('data-share-title') || 'Canción';
                    currentShareUrl = button.getAttribute('data-share-url');

                    if (!currentShareUrl) {
                        return;
                    }

                    // Intentar usar Web Share API primero (móviles)
                    if (navigator.share) {
                        navigator.share({
                            title: currentShareTitle,
                            url: currentShareUrl
                        }).catch(function() {
                            // Si falla, mostrar modal
                            openShareModal();
                        });
                        return;
                    }

                    // Si no hay Web Share API, mostrar modal
                    openShareModal();
                });
            });

            function openShareModal() {
                shareSongTitle.textContent = currentShareTitle;
                shareModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeShareModalFunc() {
                shareModal.classList.add('hidden');
                document.body.style.overflow = '';
            }

            // Cerrar modal
            closeShareModal.addEventListener('click', closeShareModalFunc);
            shareModal.addEventListener('click', function(e) {
                if (e.target === shareModal) {
                    closeShareModalFunc();
                }
            });

            // Compartir en plataformas
            sharePlatformButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var platform = button.getAttribute('data-share-platform');
                    var text = encodeURIComponent('Escucha "' + currentShareTitle +
                        '" - David Vargas');
                    var url = encodeURIComponent(currentShareUrl);
                    var shareUrl = '';

                    switch (platform) {
                        case 'facebook':
                            shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
                            window.open(shareUrl, '_blank', 'width=600,height=400');
                            break;
                        case 'whatsapp':
                            shareUrl = 'https://wa.me/?text=' + text + '%20' + url;
                            window.open(shareUrl, '_blank');
                            break;
                        case 'twitter':
                            shareUrl = 'https://twitter.com/intent/tweet?text=' + text + '&url=' +
                                url;
                            window.open(shareUrl, '_blank', 'width=600,height=400');
                            break;
                        case 'telegram':
                            shareUrl = 'https://t.me/share/url?url=' + url + '&text=' + text;
                            window.open(shareUrl, '_blank');
                            break;
                        case 'copy':
                            if (navigator.clipboard && navigator.clipboard.writeText) {
                                navigator.clipboard.writeText(currentShareUrl).then(function() {
                                    // Cambiar el texto del botón temporalmente
                                    var span = button.querySelector('span');
                                    var icon = button.querySelector('i');
                                    var originalText = span.textContent;
                                    span.textContent = '¡Copiado!';
                                    icon.classList.remove('fa-copy');
                                    icon.classList.add('fa-check');
                                    setTimeout(function() {
                                        span.textContent = originalText;
                                        icon.classList.remove('fa-check');
                                        icon.classList.add('fa-copy');
                                    }, 2000);
                                }).catch(function() {
                                    alert('No se pudo copiar el enlace.');
                                });
                            } else {
                                alert('Enlace: ' + currentShareUrl);
                            }
                            break;
                    }

                    if (platform !== 'copy') {
                        closeShareModalFunc();
                    }
                });
            });
        });
    </script>
@endsection
