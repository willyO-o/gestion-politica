@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Heading Component-->
                    <article class="heading-component">
                        <div class="heading-component-inner">
                            <h5 class="heading-component-title">Nuestra Historia
                            </h5>
                        </div>
                    </article>
                    <div class="tabs-custom tabs-horizontal tabs-corporate tabs-corporate-boxed" id="tabs-1"
                        data-nav="true">
                        <div class="nav-wrap">
                            <button class="button button-nav button-prev" data-nav-prev=""><span
                                    class="icon mdi mdi-chevron-left"></span></button>
                            <!-- Nav tabs-->
                            <ul class="nav nav-tabs">
                                <li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-1-1"
                                        data-bs-toggle="tab"><span>2020-{{ date('Y') }}</span></a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-1-2"
                                        style="display:none" data-bs-toggle="tab"><span> 2001-2012</span></a></li>
                            </ul>
                            <button class="button button-nav button-next" data-nav-next=""><span
                                    class="icon mdi mdi-chevron-right"></span></button>
                        </div>
                        <!-- Tab panes-->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tabs-1-1">
                                <div class="tab-content-main">
                                    <div class="row row-30">
                                        <div class="col-lg-6">
                                            <h2>2021-{{ date('Y') }}</h2>
                                            <h4> Gestion 2026 </h4>
                                            <p>
                                                Nuevas Estrellas es una academia de fútbol fundada el 14 de diciembre de
                                                2020, inspirada en el legado y pasión de Ramiro Ticona, un referente del
                                                fútbol local que dedicó su vida a promover el deporte como herramienta de
                                                transformación social. Nuestro nombre rinde homenaje a su compromiso y
                                                visión, buscando formar no solo jugadores talentosos, sino también personas
                                                íntegras y líderes dentro y fuera de la cancha.
                                            </p>
                                            <p>En Nuevas Estrellas, creemos que cada niño y joven tiene el potencial de
                                                brillar. Ofrecemos un programa de formación integral que combina técnicas
                                                modernas de entrenamiento con valores fundamentales como el respeto, la
                                                disciplina y el trabajo en equipo.</p>
                                            <p>
                                                Nuestro objetivo es ser una cuna de talentos que impulse a futuras
                                                generaciones a alcanzar sus sueños deportivos, fomentando al mismo tiempo el
                                                amor por el deporte y una vida saludable. Únete a nosotros y sé parte de
                                                esta gran familia donde las estrellas no nacen, se forman.
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Owl Carousel-->
                                            <div class="owl-carousel owl-carousel-dots-modern" data-items="1"
                                                data-dots="true" data-nav="false" data-stage-padding="0" data-loop="false"
                                                data-margin="0" data-mouse-drag="false">
                                                <img src="{{ url('/rt/gallery/photo_27_2024-02-13_15-33-25-1.jpg') }}"
                                                    alt="" width="529" height="350">
                                                <img src="{{ url('/rt/gallery/photo_2024-02-13_15-32-27.jpg') }}"
                                                    alt="" width="529" height="350">
                                                <img src="{{ url('/rt/gallery/photo_24_2024-02-13_15-33-25.jpg') }}"
                                                    alt="" width="529" height="350">
                                                <img src="{{ url('/rt/gallery/photo_21_2024-02-13_15-33-25.jpg') }}"
                                                    alt="" width="529" height="350">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-thumbnail-minimal">
                                    <div class="row row-30">
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img
                                                        src="{{ url('/rt/gallery/photo_8_2024-02-13_15-33-25-1.JPG') }}"
                                                        alt="" width="67" height="147">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>Técnica</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>1</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img
                                                        src="{{ url('/rt/gallery/photo_2_2024-02-13_15-33-13-1.jpg') }}"
                                                        alt="" width="68" height="126">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>Táctica</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>2</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img
                                                        src="{{ url('/rt/gallery/photo_6_2024-02-13_15-33-25-1.jpg') }}"
                                                        alt="" width="73" height="135">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>Preparación Física</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>3</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img
                                                        src="{{ url('/rt/gallery/photo_15_2024-02-13_15-33-25-1.jpg') }}"
                                                        alt="" width="68" height="126">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>Preparación Psicológica</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>4</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-1-2">
                                <div class="tab-content-main">
                                    <div class="row row-30">
                                        <div class="col-lg-6">
                                            <h2>2001-2012</h2>
                                            <h4>Atletico starts a new era of world cup tournaments</h4>
                                            <p>In the 2002 World Cup under Bruce Arena, we reached the quarterfinals, our
                                                best finish in a World Cup since 1980. The team reached the knockout stage
                                                after a 1–1–1 record in the group stage. It started with a 3–2 upset win
                                                over Portugal.</p>
                                            <p>In the 2006 World Cup, after finishing top of the CONCACAF qualification
                                                tournament, our team was drawn into Group E along with the Czech Republic,
                                                Italy, and Ghana. Atletico opened its tournament with a 3–0 loss to the
                                                Czech Republic. The team then tied 1–1 against Italy, who went on to win the
                                                World Cup. We tried to achieve even more during the next decade.</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Owl Carousel-->
                                            <div class="owl-carousel owl-carousel-dots-modern" data-items="1"
                                                data-dots="true" data-nav="false" data-stage-padding="0"
                                                data-loop="false" data-margin="0" data-mouse-drag="false"><img
                                                    src="" alt="" width="529" height="350"><img
                                                    src="" alt="" width="529" height="350"><img
                                                    src="" alt="" width="529" height="350">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-thumbnail-minimal">
                                    <div class="row row-30">
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img src="" alt=""
                                                        width="67" height="147">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>European Cups</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>2</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img src="" alt=""
                                                        width="68" height="126">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>FIFA World Cups</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>1</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img src="" alt=""
                                                        width="73" height="135">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>American Cups</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>3</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <div class="thumbnail-minimal">
                                                <div class="thumbnail-minimal-figure"><img src="" alt=""
                                                        width="68" height="126">
                                                </div>
                                                <div class="thumbnail-minimal-title">
                                                    <p>International Cups</p>
                                                </div>
                                                <div class="thumbnail-minimal-counter">
                                                    <h2>1</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection




@extends('public.layouts.base')


@section('css')
@endsection

@section('breadcrumb')
    <section class="section parallax-container breadcrumbs-wrap" data-parallax-img="images/bg-breadcrumbs-1-1920x726.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <h3 class="breadcrumbs-custom-title">A cerca de nosotros</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="active">Quienes Somos</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('title')
@endsection

@section('js')
@endsection
