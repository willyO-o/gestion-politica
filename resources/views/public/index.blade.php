@section('content')
    <section class="section swiper-container swiper-slider swiper-classic bg-gray-2"
        data-swiper='{"autoplay":{"delay":4000},"simulateTouch":false,"effect":"fade"}'>
        <div class="swiper-wrapper">
            <div class="swiper-slide text-center" data-slide-bg="soccer/images/slider-1-slide-1-1920x671.jpg">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6">
                            <div class="swiper-slide-caption">
                                <h1 data-caption-animate="fadeInUp" data-caption-delay="100">CLUB DEPORTIVO R.T. <span
                                        class="text-warning">
                                        "NUEVAS ESTRELLAS" </span> </h1>
                                <h4 data-caption-animate="fadeInUp" data-caption-delay="200">FÚTBOL - FUTSAL</h4><a
                                    class="button button-primary" data-caption-animate="fadeInUp" data-caption-delay="300"
                                    href="{{ route('contacto') }}">Contactar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" data-slide-bg="soccer/images/slider-1-slide-2-1920x671.jpg">
                {{-- <div class="swiper-slide" data-slide-bg="img/logo/POR-1.jpg"> --}}
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-xl-5">
                            <div class="swiper-slide-caption">
                                <h1 data-caption-animate="fadeInUp" data-caption-delay="100">Descubre tu potencial</h1>
                                <h4 data-caption-animate="fadeInUp" data-caption-delay="200">Conoce nuestas Categorías</h4>
                                <a class="button button-primary" data-caption-animate="fadeInUp" data-caption-delay="300"
                                    href="{{ route('contacto') }}">Contactar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" data-slide-bg="soccer/images/slider-1-slide-3-1920x671.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5">
                            <div class="swiper-slide-caption">
                                <h1 data-caption-animate="fadeInUp" data-caption-delay="100">Descubre tu Talento</h1>
                                <h4 data-caption-animate="fadeInUp" data-caption-delay="200">Entrenamiento de Arqueros<br
                                        class="d-none d-xl-block"> Personalizado!!!</h4><a class="button button-primary"
                                    data-caption-animate="fadeInUp" data-caption-delay="300"
                                    href="{{ route('contacto') }}">Contactar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-button swiper-button-prev"></div>
        <div class="swiper-button swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </section>

    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-50">
                <div class="col-lg-8">
                    <div class="main-component">
                        <article class="heading-component ">
                            <div class="heading-component-inner">
                                <h5 class="heading-component-title">Temporada {{ date('Y') }}
                                </h5>
                            </div>
                        </article>

                        <div class="row row-30">
                            <div class="col-md-12">
                                <!-- Post Gloria-->
                                {{-- <article class="post-gloria"><img src="/img/logo/05.jpg" alt="" --}}
                                <article class="post-gloria"><img src="soccer/images/post-gloria-1-769x429.jpg"
                                        alt="" width="769" height="429">
                                    <div class="post-gloria-main">
                                        <h3 class="post-gloria-title"><a href="blog-post.html">¡APROVECHA TUS VACACIONES AL
                                                MAXIMO!</a></h3>
                                        <div class="post-gloria-meta">
                                            <!-- Badge-->
                                            <div class="badge badge-primary">Entrenando
                                            </div>
                                            <div class="post-gloria-time"><span class="icon mdi mdi-clock"></span>
                                                <time datetime="2022">Abril 15, 2023</time>
                                            </div>
                                        </div>
                                        <div class="post-gloria-text">
                                            <svg version="1.1" x="0px" y="0px" width="6.888px" height="4.68px"
                                                viewbox="0 0 6.888 4.68" enable-background="new 0 0 6.888 4.68"
                                                xml:space="preserve">
                                                <path
                                                    d="M1.584,0h1.8L2.112,4.68H0L1.584,0z M5.112,0h1.776L5.64,4.68H3.528L5.112,0z">
                                                </path>
                                            </svg>
                                            <p>Te invitamos a ser parte de la Gran Escuela de Futbol...</p>
                                        </div>
                                        <a class="button" href="#modal1" data-bs-toggle="modal">Ver video...</a>
                                    </div>
                                </article>
                            </div>
                        </div>
                        <!-- Heading Component-->

                        <article class="heading-component mt-3">
                            <div class="heading-component-inner">
                                <h5 class="heading-component-title">Temporada {{ date('Y') }} Horarios
                                </h5><a class="button button-xs button-gray-outline" href="news-1.html">Ver mas</a>
                            </div>
                        </article>

                        <div class="row row-30">
                            <div class="col-md-12">
                                <!-- Post Future-->
                                <div class="table-custom-responsive">
                                    <table class="table-custom table-standings table-classic">
                                        <thead>
                                            <tr>
                                                <th colspan="2">TURNO MAÑANA
                                                </th>
                                                <th>Martes</th>
                                                <th>Miercoles</th>
                                                <th>Viernes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span>1</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png" alt=""
                                                            width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 14</div>
                                                    </div>
                                                </td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                            </tr>

                                            <tr>
                                                <td><span>2</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 15</div>
                                                    </div>
                                                </td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                            </tr>

                                            <tr>
                                                <td><span>3</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 16</div>
                                                    </div>
                                                </td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                            </tr>

                                            <tr>
                                                <td><span>4</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 17</div>
                                                    </div>
                                                </td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                            </tr>

                                            <tr>
                                                <td><span>5</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 18</div>
                                                    </div>
                                                </td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                                <td>08:00 a 10:00</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <!-- Post Future-->
                                <div class="table-custom-responsive">
                                    <table class="table-custom table-standings table-classic">
                                        <thead>
                                            <tr>
                                                <th colspan="2">TURNO TARDE
                                                </th>
                                                <th>Martes</th>
                                                <th>Jueves</th>
                                                <th>Sábado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span>1</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 5</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>
                                            <tr>
                                                <td><span>2</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 6</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>
                                            <tr>
                                                <td><span>3</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 7</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>
                                            <tr>
                                                <td><span>4</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 8</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>
                                            <tr>
                                                <td><span>5</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 9</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>
                                            <tr>
                                                <td><span>6</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 10</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>
                                            <tr>
                                                <td><span>7</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 11</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>
                                            <tr>
                                                <td><span>8</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Sub 12</div>
                                                    </div>
                                                </td>
                                                <td>16:00 a 18:00</td>
                                                <td>14:00 a 18:00</td>
                                                <td>09:30 a 11:30</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <!-- Post Future-->
                                <div class="table-custom-responsive">
                                    <table class="table-custom table-standings table-classic">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Categoría Mayores
                                                </th>
                                                <th>Jueves</th>
                                                <th>Sábado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span>1</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Mayores
                                                            (edad 20+)</div>
                                                    </div>
                                                </td>
                                                <td>16:30 a 18:30</td>
                                                <td>07:00 a 9:00</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <!-- Post Future-->
                                <div class="table-custom-responsive">
                                    <table class="table-custom table-standings table-classic">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Arqueros
                                                </th>
                                                <th>Jueves</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span>1</span></td>
                                                <td class="team-inline">
                                                    <div class="team-figure"><img src="img/logo/cancha.png"
                                                            alt="" width="45" height="45">

                                                    </div>
                                                    <div class="team-title">
                                                        <div class="team-name">Arqueros (Personalizado)</div>
                                                    </div>
                                                </td>
                                                <td>08:00 a 10:00</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>


                        </div>
                    </div>


                    <div class="main-component">
                        <!-- Heading Component-->
                        <article class="heading-component">
                            <div class="heading-component-inner">
                                <h5 class="heading-component-title">ENTRENADORES
                                </h5><a class="button button-xs button-gray-outline" href="#">Calendar</a>
                            </div>
                        </article>
                        <!-- Game Result Bug-->
                        <div class="row row-30">

                            @foreach ($entrenadores as $entrenador)
                                <div class="col-sm-6 col-lg-4">
                                    <!-- Player Info Modern-->
                                    <div class="player-info-modern"><a class="player-info-modern-figure"
                                            href="player-page.html"><img src="soccer/images/roster-player-1-368x286.png"
                                                alt="" width="368" height="286"></a>
                                        <div class="player-info-modern-footer">
                                            <div class="player-info-modern-number">
                                                <p>
                                                    <i class="fa fa-user"></i>
                                                </p>
                                            </div>
                                            <div class="player-info-modern-content">
                                                <div class="player-info-modern-title">
                                                    <h5><a href="player-page.html">{{ $entrenador->nombre }}
                                                            {{ $entrenador->paterno }}</a></h5>
                                                    {{-- <p>Defender</p> --}}
                                                </div>
                                                <div class="player-info-modern-progress">
                                                    <!-- Linear progress bar-->
                                                    <article class="progress-linear progress-bar-modern animated">
                                                        <div class="progress-header">
                                                            <p>Pass Acc</p>
                                                        </div>
                                                        <div class="progress-bar-linear-wrap">
                                                            <div class="progress-bar-linear"
                                                                style="transition-duration: 1s; width: 95%;"></div>
                                                        </div><span class="progress-value">95</span>
                                                    </article>
                                                    <!-- Linear progress bar-->
                                                    <article class="progress-linear progress-bar-modern animated">
                                                        <div class="progress-header">
                                                            <p>Shots Acc</p>
                                                        </div>
                                                        <div class="progress-bar-linear-wrap">
                                                            <div class="progress-bar-linear"
                                                                style="transition-duration: 1s; width: 70%;"></div>
                                                        </div><span class="progress-value">70</span>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- Aside Block-->
                <div class="col-lg-4">
                    <aside class="aside-components">

                        <div class="aside-component">
                            <!-- Heading Component-->
                            <article class="heading-component">
                                <div class="heading-component-inner">
                                    <h5 class="heading-component-title">Nuestras Redes Sociales
                                    </h5>
                                </div>
                            </article>
                            <!-- Buttons Media-->
                            <div class="group-sm group-flex"><a class="button-media button-media-facebook"
                                    href="https://www.facebook.com/people/Escuela-de-f%C3%BAtbol-Ramiro-Ticona/100066934180223/"
                                    target="_blank">
                                    <h4 class="button-media-title">200+</h4>
                                    <p class="button-media-action">Me Gusta<span
                                            class="icon material-icons-add_circle_outline icon-sm"></span></p>
                                    <span class="button-media-icon fa-facebook"></span>
                                </a><a class="button-media button-media-google" target="_blank"
                                    href="https://www.tiktok.com/@academia.de.ftbol">
                                    <h4 class="button-media-title">600+</h4>
                                    <p class="button-media-action">Tiktok<span
                                            class="icon material-icons-add_circle_outline icon-sm"></span></p>
                                    <span class="button-media-icon  fa-tiktok"></span>
                                </a>
                                {{-- <a class="button-media button-media-google" href="#">
                                    <h4 class="button-media-title">15k</h4>
                                    <p class="button-media-action">Follow<span
                                            class="icon material-icons-add_circle_outline icon-sm"></span></p>
                                    <span class="button-media-icon fa-google"></span>
                                </a>
                                <a class="button-media button-media-instagram" href="#">
                                    <h4 class="button-media-title">85k</h4>
                                    <p class="button-media-action">Follow<span
                                            class="icon material-icons-add_circle_outline icon-sm"></span></p>
                                    <span class="button-media-icon fa-instagram"></span>
                                </a> --}}
                            </div>
                        </div>

                        <div class="aside-component">
                            <!-- Heading Component-->
                            <article class="heading-component">
                                <div class="heading-component-inner">
                                    <h5 class="heading-component-title">Nuestas Sucursales
                                    </h5><a class="button button-xs button-gray-outline" href="{{ route("sucursales") }}">Ver mas</a>
                                </div>
                            </article>
                            <!-- List Post Classic-->
                            <div class="list-post-classic">
                                <!-- Post Classic-->

                                @foreach ($sucursales as $sucursal)
                                    <article class="post-classic">
                                        <div class="post-classic-aside"><a class="post-classic-figure"
                                                href="#"><img src="soccer/images/blog-element-3-94x94.jpg"
                                                    alt="" width="94" height="94"></a></div>
                                        <div class="post-classic-main">
                                            <p class="post-classic-title">
                                                <a href="#">
                                                    {{ $sucursal->nombre_sucursal }}
                                                </a>
                                            </p>
                                            <div class="post-classic-time"><span class="icon mdi mdi-map-marker"></span>
                                                <p>
                                                    {{ $sucursal->direccion_sucursal }}
                                                </p>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach

                            </div>
                        </div>

                        <div class="aside-component">
                            <!-- Heading Component-->
                            <article class="heading-component">
                                <div class="heading-component-inner">
                                    <h5 class="heading-component-title">Reconocimientos
                                    </h5>
                                </div>
                            </article>
                            <!-- Owl Carousel-->
                            <div class="owl-carousel owl-carousel-dots-modern awards-carousel" data-items="1"
                                data-autoplay="true" data-autoplay-speed="4000" data-dots="true" data-nav="false"
                                data-stage-padding="0" data-loop="true" data-margin="0" data-mouse-drag="true">
                                <!-- Awards Item-->
                                <div class="awards-item">
                                    <div class="awards-item-main">
                                        <h4 class="awards-item-title"><span class="text-accent">Copa</span>Champions
                                        </h4>
                                        <div class="divider"></div>
                                        <h5 class="awards-item-time">Diciembre 2020</h5>
                                    </div>
                                    <div class="awards-item-aside"> <img
                                            src="soccer/images/thumbnail-minimal-1-67x147.png" alt=""
                                            width="67" height="147">
                                    </div>
                                </div>
                                <!-- Awards Item-->
                                {{-- <div class="awards-item">
                                    <div class="awards-item-main">
                                        <h4 class="awards-item-title"><span class="text-accent">Best</span>Forward
                                        </h4>
                                        <div class="divider"></div>
                                        <h5 class="awards-item-time">June 2015</h5>
                                    </div>
                                    <div class="awards-item-aside"> <img
                                            src="soccer/images/thumbnail-minimal-2-68x126.png" alt=""
                                            width="68" height="126">
                                    </div>
                                </div>
                                <!-- Awards Item-->
                                <div class="awards-item">
                                    <div class="awards-item-main">
                                        <h4 class="awards-item-title"><span class="text-accent">Best</span>Coach
                                        </h4>
                                        <div class="divider"></div>
                                        <h5 class="awards-item-time">November 2016</h5>
                                    </div>
                                    <div class="awards-item-aside"> <img
                                            src="soccer/images/thumbnail-minimal-3-73x135.png" alt=""
                                            width="73" height="135">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="aside-component">
                            <!-- Heading Component-->
                            <article class="heading-component">
                                <div class="heading-component-inner">
                                    <h5 class="heading-component-title">Galería de Imágenes
                                    </h5>
                                    <a class="button button-xs button-gray-outline" href="{{ route('galeria') }}">
                                        Ver mas
                                    </a>

                                </div>
                            </article>
                            <article class="gallery" data-lightgallery="group">
                                <div class="row row-10 row-narrow">
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-4"><a class="thumbnail-creative"
                                            data-lightgallery="item"
                                            href="rt/gallery/photo_1_2024-02-13_15-33-13.jpg"><img
                                                src="rt/gallery/photo_1_2024-02-13_15-33-13.jpg" alt="">
                                            <div class="thumbnail-creative-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-4"><a class="thumbnail-creative"
                                            data-lightgallery="item"
                                            href="rt/gallery/photo_2_2024-02-13_15-33-13.jpg"><img
                                                src="rt/gallery/photo_2_2024-02-13_15-33-13.jpg" alt="">
                                            <div class="thumbnail-creative-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-4"><a class="thumbnail-creative"
                                            data-lightgallery="item"
                                            href="rt/gallery/photo_2_2024-02-13_15-33-25.jpg"><img
                                                src="rt/gallery/photo_2_2024-02-13_15-33-25.jpg" alt="">
                                            <div class="thumbnail-creative-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-4"><a class="thumbnail-creative"
                                            data-lightgallery="item"
                                            href="rt/gallery/photo_3_2024-02-13_15-33-13.jpg"><img
                                                src="rt/gallery/photo_3_2024-02-13_15-33-13.jpg" alt="">
                                            <div class="thumbnail-creative-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-4"><a class="thumbnail-creative"
                                            data-lightgallery="item"
                                            href="rt/gallery/photo_4_2024-02-13_15-33-25.jpg"><img
                                                src="rt/gallery/photo_4_2024-02-13_15-33-25.jpg" alt="">
                                            <div class="thumbnail-creative-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-6 col-lg-4"><a class="thumbnail-creative"
                                            data-lightgallery="item"
                                            href="rt/gallery/photo_6_2024-02-13_15-33-13.jpg"><img
                                                src="rt/gallery/photo_6_2024-02-13_15-33-13.jpg" alt="">
                                            <div class="thumbnail-creative-overlay"></div>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div class="aside-component">
                            <!-- Heading Component-->
                            <article class="heading-component">
                                <div class="heading-component-inner">
                                    <h5 class="heading-component-title">Colaboradores
                                    </h5>
                                </div>
                            </article>
                            <div class="block-voting">
                                <div class="group-md">
                                    <!-- Player Voting Item-->
                                    <div class="player-voting-item">
                                        <div class="player-voting-item-figure"><img src="{{ url('/img/rt/avatar.png') }}"
                                                alt="" width="152" height="144">
                                            <div class="player-number">
                                                <p>
                                                    <i class="material-icons-thumb_up"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="player-voting-item-title">
                                            <p>{{ config('app.constants.colaborator2') }}</p>
                                        </div>

                                        <button class="button button-block button-icon button-icon-left button-primary"
                                            type="button"><span
                                                class="icon material-icons-thumb_up"></span><span>Contactar</span></button>
                                    </div>

                                    <div class="player-voting-item">
                                        <div class="player-voting-item-figure"><img src="{{ url('/img/rt/avatar.png') }}"
                                                alt="" width="152" height="144">
                                            <div class="player-number">
                                                <p>
                                                    <i class="material-icons-thumb_up"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="player-voting-item-title">
                                            <p>{{ config('app.constants.colaborator3') }}</p>
                                        </div>

                                        <button class="button button-block button-icon button-icon-left button-primary"
                                            type="button"><span
                                                class="icon material-icons-thumb_up"></span><span>Contactar</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </aside>
                </div>
            </div>
        </div>
    </section>


    <div class="modal modal-video fade" id="modal1" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        {{-- <iframe width="560" height="315" src="https://www.youtube.com/embed/42STRZ2DTEM"
                            allowfullscreen=""></iframe> --}}
                        <video controls>
                            <source src="{{ url('/rt/video/entrenamiento_1.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('public.layouts.base')


@section('css')
    {{-- <link href="{{ url('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('/assets/libs/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/croppie_2.6.5_croppie.min.css') }}"> --}}
@endsection

@section('breadcrumb')
    {{-- <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="javascript: void(0);"></a>Inicio</li>
            <li class="breadcrumb-item active">Administrar Seguimientos </li>
        </ol>
    </div> --}}
@endsection

@section('title')
    {{-- Administración de Seguimientos --}}
@endsection

@section('js')
    <!-- list.js min js -->
    {{-- <script src="{{ url('assets/libs/list.js/list.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/libs/list.pagination.js/list.pagination.min.js') }}"></script> --}}
    {{-- <script src="{{ url('/js/plugins/scrollpagination-container.js') }}"></script>

    <script src="{{ url('/assets/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ url('/js/plugins/croppie_2.6.5_croppie.min.js') }}"></script> --}}

    {{-- <script src="{{ url('/admin/js/valoracion/indexValoracion.js') }}"></script> --}}

    <!-- Sweet Alerts js -->
@endsection
