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
