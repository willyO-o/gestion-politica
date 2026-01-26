@section('content')
    <!-- Privacy Policy-->



    <section class="section section-md bg-default">
        <input type="hidden" id="idInscripcion" value="{{ $inscripcion->id_inscripcion }}">
        <input type="hidden" id="fechaInicio" value="{{ $inscripcion->fecha_inicio }}">
        <input type="hidden" id="idGrupo" value="{{ $inscripcion->id_grupo_entrenamiento }}">
        <div class="container">

            <div class="row">

                <div class="col-md-6 col-xl-3">

                    <div class="block-voting">
                        <div class="group-md">
                            <!-- Player Voting Item-->
                            <div class="player-voting-item">
                                <div class="player-voting-item-figure"><img src="{{ url('storage/' . $inscripcion->foto) }}"
                                        alt="Foto no  encontrada" width="160" height="152">
                                    <div class="player-number">
                                        <p>
                                            <span class="material-icons-star"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="player-voting-item-title">
                                    <p>
                                        {{ $inscripcion->nombre }} {{ $inscripcion->paterno }} {{ $inscripcion->materno }}
                                    </p>
                                </div>
                                <div class="player-voting-item-progress">
                                    <!-- Linear progress bar-->
                                    <article class="progress-linear progress-bar-modern progress-bar-modern-red animated">
                                        <div class="progress-header">
                                            <p>
                                                Edad:
                                                <b> {{ calcEdad($inscripcion->fecha_nacimiento) }} Años</b>
                                            </p>
                                        </div>
                                        <div class="progress-header">
                                            <p>
                                                Género:
                                                <b> {{ $inscripcion->genero }}</b>
                                            </p>
                                        </div>
                                        <div class="progress-header">
                                            <p>
                                                Estado:
                                                <b class="text-primary"> {{ $inscripcion->estado_inscripcion }}</b>
                                            </p>
                                        </div>

                                    </article>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-9">
                    <div class="player-info-corporate player-info-other-team">
                        <div class="player-info-main">
                            <h4 class="player-info-title">Inscripción</h4>
                            <p class="player-info-subtitle"> N° : {{ $inscripcion->numero }} </p>
                            <hr>
                            <div class="player-info-table">
                                <div class="table-custom-wrap">
                                    <table class="table-custom">
                                        <tbody>
                                            <tr>
                                                <th colspan="2">Casa de Campaña</th>
                                                <th colspan="2">{{ $inscripcion->nombre_sucursal }}</th>

                                            </tr>
                                            <tr>
                                                <th colspan="2">Distrito</th>
                                                <th colspan="2">
                                                    {{ $inscripcion->nombre_categoria }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Fecha de Inscripción</th>
                                                <th colspan="2">
                                                    {{ fechaMesLiteral($inscripcion->fecha_registro) }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Fecha Inicio</th>
                                                <th>
                                                    {{ fechaMesLiteral($inscripcion->fecha_inicio) }}
                                                </th>
                                                <th>Fecha Finalización</th>
                                                <th>
                                                    {{ fechaMesLiteral($inscripcion->fecha_fin) }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Tipo de Inscripción</th>
                                                <th colspan="2">
                                                    {{ $inscripcion->tipo_inscripcion }}
                                                </th>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>



    <section class="section section-md bg-default">
        <div class="container">

            <div class="tabs-custom tabs-horizontal tabs-corporate product-single-additional">
                <!-- Nav tabs-->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="tab" aria-selected="false" tabindex="-1">
                        <a class="nav-link py-3 show active" href="#tabs-pagos" data-bs-toggle="tab" aria-selected="true"
                            role="tab">
                            Control de Asistencia
                        </a>
                    </li>
                    <li class="nav-item d-none" role="tab" aria-selected="false" tabindex="-1">
                        <a class="nav-link py-3" href="#tabs-asistencia" data-bs-toggle="tab" aria-selected="false"
                            role="tab" tabindex="-1">
                            Resumen de Pagos

                        </a>
                    </li>
                    <li class="nav-item d-none" role="tab" aria-selected="false" tabindex="-1">
                        <a class="nav-link py-3" href="#tabs-valoracion" data-bs-toggle="tab" aria-selected="false"
                            role="tab" tabindex="-1">
                            Valoración Física
                        </a>
                    </li>
                </ul>
                <!-- Tab panes-->
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tabs-pagos" role="tabpanel">


                                <h5 class="text-center">Tabla de Resumen de Asistencias del Inscrito</h5>
                                <p class="text-center">
                                    Asistencias a Actividades : {{ $inscripcion->dia }}
                                    @if($inscripcion->dia_extra)
                                    , {{ $inscripcion->dia_extra }}
                                    @endif
                                </p>
                                <p class="text-center">
                                    <small>
                                        <b>Nota:</b> Las celdas en blanco son los días que no corresponde a los días de actividades

                                    </small>
                                </p>

                        <div class="table-responsive mt-2">
                            <table class="table table-sm table-bordered text-center" id="tabla-asistencias">


                            </table>
                        </div>



                    </div>
                    <div class="tab-pane fade" id="tabs-asistencia" role="tabpanel">


                        <div class="table-responsive " style="height: 400px">
                            <table class="table  table-sm">
                                <thead class="sticky-top  table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Actividad</th>
                                        <th>Gestión</th>
                                        <th>Monto (Bs.)</th>
                                        <th>Saldo (Bs.)</th>
                                        <th>Total (Bs.)</th>
                                        <th>Fecha de Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagos as $pago)
                                        <tr>
                                            <td> {{ $loop->iteration }} </td>
                                            <td>{{ $pago->mes }}</td>
                                            <td>{{ $pago->gestion }}</td>
                                            <td>{{ formatoMoneda($pago->monto) }}</td>
                                            <td>{{ formatoMoneda($pago->saldo) }}</td>
                                            <td>{{ formatoMoneda($pago->monto + $pago->saldo) }}</td>
                                            <td>{{ fechaMesLiteral($pago->fecha_pago) }}</td>
                                        </tr>
                                    @endforeach

                                    @if (count($pagos) == 0)
                                        <tr>
                                            <td colspan="100%" class="text-center text-danger p-5">No se encontraron
                                                registros</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
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
    {{-- <section class="section parallax-container breadcrumbs-wrap" data-parallax-img="/assets/images/bg-breadcrumbs-1-1920x726.jpg"> --}}
    <section class="section parallax-container breadcrumbs-wrap" data-parallax-img="">
        <div class="parallax-content breadcrumbs-custom context-dark">
            <div class="container">
                <h3 class="breadcrumbs-custom-title">Detalles de Inscripción</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="active">Detalle inscripción</li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('title')
@endsection

@section('js')
    <script src="{{url("/js/public/detalleInscripcion.js")}}"> </script>
@endsection
