@section('content')
    <section class="section section-variant-1 bg-gray-100 text-center">
        <div class="container">
            <div class="row row-30" data-lightgallery="group" id="galeria">


            </div>
            <a class="button button-lg button-primary" href="#" id="loadImg">
                Cargar más imagnes
            </a>
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
                <h3 class="breadcrumbs-custom-title"> Galería</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="active"> Galería de Imágenes</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('title')
@endsection

@section('js')


    <script src="{{ url('/js/public/galeria.js') }}"></script>
@endsection
