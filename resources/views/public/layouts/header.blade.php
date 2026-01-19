<header class="section page-header rd-navbar-dark">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
            data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed"
            data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
            data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
            data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="166px" data-xl-stick-up-offset="166px"
            data-xxl-stick-up-offset="166px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-main"><span></span></button>
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel-inner container">
                    <div class="rd-navbar-collapse rd-navbar-panel-item rd-navbar-panel-item-left">
                        <!-- Owl Carousel-->
                        <div class="owl-carousel-navbar owl-carousel-inline-outer">
                            <div class="owl-inline-nav">
                                <button class="owl-arrow owl-arrow-prev"></button>
                                <button class="owl-arrow owl-arrow-next"></button>
                            </div>
                            <div class="owl-carousel-inline-wrap">
                                <div class="owl-carousel owl-carousel-inline" data-items="1" data-dots="false"
                                    data-nav="true" data-autoplay="true" data-autoplay-speed="3200"
                                    data-stage-padding="0" data-loop="true" data-margin="10" data-mouse-drag="false"
                                    data-touch-drag="false" data-nav-custom=".owl-carousel-navbar">
                                    <!-- Post Inline-->
                                    <article class="post-inline">
                                        <time class="post-inline-time" datetime="{{ date('Y') }}"> {{ date('Y') }} </time>
                                        <p class="post-inline-title">Legión alteña </p>

                                    </article>
                                    <article class="post-inline">
                                        <time class="post-inline-time" datetime="{{ date('Y') }}"> {{ date('Y') }} </time>
                                        <p class="post-inline-title"> Vota por el Cambio </p>
                                    </article>
                                    <article class="post-inline">
                                        <time class="post-inline-time" datetime="{{ date('Y') }}"> {{ date('Y') }} </time>
                                        <p class="post-inline-title">Elecciones Sub nacionales </p>

                                    </article>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rd-navbar-panel-item rd-navbar-panel-item-right">
                        <ul class="list-inline list-inline-bordered">

                            <li><a class="link link-icon link-icon-left link-classic" href="{{ route('login') }}"><span
                                        class="icon fl-bigmug-line-login12"></span><span class="link-icon-text">Iniciar
                                        Sesión</span></a></li>
                        </ul>
                    </div>
                    <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1"
                        data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
                </div>
            </div>
            <div class="rd-navbar-main">
                <div class="rd-navbar-main-top">
                    <div class="rd-navbar-main-container container">
                        <!-- RD Navbar Brand-->
                        <div class="rd-navbar-brand">
                            <a class="brand" href="{{ route('inicio') }}">
                                <img class="brand-logo " src="{{ url('img/mts/logo-mts.png') }}" width="95"
                                    height="126">
                            </a>
                        </div>
                        <!-- RD Navbar List-->
                        <ul class="rd-navbar-list">

                            <li class="rd-navbar-list-item"><a class="rd-navbar-list-link" href="#"><img
                                        src="{{ url('img/mts/logo-legion-alt.png') }}" alt="" width="79"
                                        height="52"></a></li>
                        </ul>
                        <!-- RD Navbar Search-->
                        <div class="rd-navbar-search">
                            <button class="rd-navbar-search-toggle"
                                data-rd-navbar-toggle=".rd-navbar-search"><span></span></button>
                            <form class="rd-search" action="#" data-search-live="rd-search-results-live"
                                method="GET">
                                <div class="form-wrap">
                                    <label class="form-label" for="rd-navbar-search-form-input">Buscar...</label>
                                    <input class="rd-navbar-search-form-input form-input"
                                        id="rd-navbar-search-form-input" type="text" autocomplete="off">
                                    <div class="rd-search-results-live" id="rd-search-results-live"></div>
                                </div>
                                <button class="rd-search-form-submit fl-budicons-launch-search81"
                                    type="buttom"></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="rd-navbar-main-bottom rd-navbar-darker">
                    <div class="rd-navbar-main-container container">
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li class="rd-nav-item active">
                                <a class="rd-nav-link" href="{{ url('/login') }}">Inicio</a>
                            </li>

                        </ul>
                        <div class="rd-navbar-main-element">
                            <ul class="list-inline list-inline-sm">
                                <li><a class="icon icon-xs icon-light fa fa-facebook"
                                        href="https://www.facebook.com/alcaldevaliente"
                                        target="_blank"></a></li>
                                {{-- <li><a class="icon icon-xs icon-light fa fa-twitter" href="#"></a></li> --}}
                                <li><a class="icon icon-xs icon-light fa fa-whatsapp" href="#"
                                        target="_blank"></a>
                                </li>
                                <li><a class="icon icon-xs icon-light fa fa-instagram"
                                        href="#" target="_blank"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
