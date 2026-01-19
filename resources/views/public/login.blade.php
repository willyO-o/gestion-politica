@section('content')
    <!-- Section Breadcrumbs-->

    <!-- Section Login/register-->
    <section class="section section-variant-1 bg-gray-100">
        <div class="container">
            <div class="row row-50 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="card-login-register" id="card-l-r">
                        <div class="card-top-panel">
                            <div class="card-top-panel-left">
                                <h5 class="card-title card-title-login text-center">Login</h5>
                            </div>

                        </div>
                        <div class="card-form card-form-login">
                            <form class="" id="formLogin" method="POST" action="#">

                                <div class="form-wrap">
                                    <label class="form-label" for="usuario">Usario</label>
                                    <input class="form-input" id="usuario" type="text" name="usuario" required>
                                </div>
                                <div class="form-wrap">
                                    <label class="form-label" for="form-login-password-1">Contraseña</label>
                                    <input class="form-input" id="form-login-password-1" type="password" name="password" required>
                                </div>
                                <div class="form-wrap">
                                    <img src="{{ route('captcha') }}" class="img-fluid" id="captchaImg" alt="">
                                    <button type="button" class="btn btn-primary" id="refreshCaptcha" data-bs-toggle="tooltip" data-bs-placement="top" tabindex="-1" title="Recargar Imagen de Captcha">
                                        <i class="fa fa-refresh"></i>
                                    </button>

                                </div>
                                <div class="form-wrap">
                                    <label class="form-label" for="captcha">Rellene el codigo de verificación Captcha</label>
                                    <input class="form-input" id="captcha" type="text" name="captcha" required>
                                </div>

                                {{-- <label class="checkbox-inline checkbox-inline-lg checkbox-light">
                                    <input name="input-checkbox-1" value="checkbox-1" type="checkbox">Remember Me
                                </label> --}}
                                <button class="button button-lg button-primary button-block" type="submit">
                                    Iniciar Sesión
                                </button>

                            </form>

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
                <h3 class="breadcrumbs-custom-title"> Iniciar Sesión</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="active"> Iniciar Sesión</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('title')
@endsection

@section('js')


<script src="{{ url("js/public/login.js")}}"></script>

@endsection
