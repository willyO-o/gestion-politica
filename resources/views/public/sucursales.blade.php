@section('content')
    <section class="section section-md bg-gray-100">
        <div class="container">
            <div class="row row-50">
                <div class="col-sm-12">
                    <!-- Heading Component-->
                    <article class="heading-component">
                        <div class="heading-component-inner">
                            <h5 class="heading-component-title">Central
                            </h5>
                        </div>
                    </article>
                    <!-- Product - List build-->

                    <article class="product-single">
                        <div class="product-single-figure p-0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d956.2211890247495!2d-68.20877373033443!3d-16.5319147133481!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMTbCsDMxJzU0LjkiUyA2OMKwMTInMjkuMyJX!5e0!3m2!1ses!2sbo!4v1707860231576!5m2!1ses!2sbo"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>

                        </div>
                        <div class="product-single-main">
                            <div class="product-single-title heading-4"> Sucursal: {{ $central->nombre_sucursal }} - <span
                                    class="text-dark">Central</span> </div>
                            <ul class="product-list-info">

                                <li>
                                    <i class="icon mdi mdi-phone"></i>
                                </li>
                                <li>
                                    @if ($central->telefono)
                                        <a href="tel:+591{{ $central->telefono }}"
                                            target="_blank">{{ $central->telefono }}</a>
                                    @else
                                        -
                                    @endif

                                </li>
                            </ul>
                            <div class="product-single-text">
                                <h5>Dirección : </h5>
                                <p>
                                    <i class="icon mdi mdi-map-marker"></i>
                                    {{ $central->direccion_sucursal ?? '-' }}
                                </p>
                            </div>

                        </div>
                    </article>

                </div>


                <div class="col-sm-12">
                    <!-- Heading Component-->
                    <article class="heading-component">
                        <div class="heading-component-inner">
                            <h5 class="heading-component-title">Nuestras sucursales
                            </h5>
                        </div>
                    </article>
                    <div class="row row-30">


                        @foreach ($sucursales as $sucursal)
                            <div class="col-md-6 col-lg-4">
                                <!-- Product - Grid build-->
                                <article class="product">
                                    <header class="product-header">

                                        <div class="product-figure"><img src="soccer/images/blog-element-3-94x94.jpg"
                                                alt="" width="100%">
                                        </div>
                                        <div class="product-buttons">
                                            <div class="product-button product-button-share fl-bigmug-line-share27"
                                                style="font-size: 22px">
                                                <ul class="product-share">
                                                    <li class="product-share-item"><span>Share</span></li>
                                                    <li class="product-share-item"><a class="icon fa fa-facebook"
                                                            href="#"></a></li>
                                                    <li class="product-share-item"><a class="icon fa fa-instagram"
                                                            href="#"></a></li>
                                                    <li class="product-share-item"><a class="icon fa fa-twitter"
                                                            href="#"></a></li>
                                                    <li class="product-share-item"><a class="icon fa fa-google-plus"
                                                            href="#"></a></li>
                                                </ul>
                                            </div>
                                            <a class="product-button fl-bigmug-line-zoom60"
                                                href="images/shop/product-1-original.jpg" data-lightgallery="item"
                                                style="font-size: 25px">
                                            </a>
                                        </div>
                                    </header>
                                    <footer class="product-content">
                                        <h6 class="product-title"><a href="product-page.html">Sucursal:
                                                {{ $sucursal->nombre_sucursal }}</a>
                                        </h6>
                                        <div class="product-price"><span class="product-price-old"> <i
                                                    class="icon mdi mdi-phone"></i></span><span
                                                class="heading-6 product-price-new">
                                                @if ($sucursal->telefono)
                                                    <a href="tel:+591{{ $sucursal->telefono }}"
                                                        target="_blank">{{ $sucursal->telefono }}</a>
                                                @else
                                                    <a href="tel:+591{{ $central->telefono }}"
                                                        target="_blank">{{ $central->telefono }}</a>
                                                @endif

                                            </span>

                                        </div>
                                        <div class="product-single-text">
                                            <p>
                                                <i class="icon mdi mdi-map-marker"></i>
                                                {{ $sucursal->direccion_sucursal ?? '-' }}
                                            </p>
                                        </div>
                                    </footer>
                                </article>
                            </div>
                        @endforeach


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
                <h3 class="breadcrumbs-custom-title"> Sucursales</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="active"> Nuestras sucursales </li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('title')
@endsection

@section('js')
@endsection
