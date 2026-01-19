@section('content')





@endsection




@extends('public.layouts.base')


@section('css')
@endsection

@section('breadcrumb')
    <section class="section parallax-container breadcrumbs-wrap" data-parallax-img="images/bg-breadcrumbs-1-1920x726.jpg">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <h3 class="breadcrumbs-custom-title"> aqui titulo</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="active"> titulo de pagina</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('title')
@endsection

@section('js')


@endsection
