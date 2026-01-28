@php

    $listRoles = session('rolesUsuario')->rol;
@endphp


<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ url('img/mts/logo-legion-alt.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ url('img/mts/logo-legion-alt.png') }}" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ url('img/mts/logo-legion-alt.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ url('img/mts/logo-legion-alt.png') }}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.home') }}" aria-expanded="false">
                        <i class="mdi mdi-home"></i> <span data-key="t-inicio">Inicio</span>
                    </a>
                </li>

                @if ($listRoles == 'ADMINISTRADOR' || $listRoles == 'TÉCNICO')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#academia" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="academia">
                            <i class=" mdi mdi-cog"></i>
                            <span data-key="t-academia"> Partido Político</span>
                        </a>
                        <div class="collapse menu-dropdown" id="academia">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('sucursales.index') }}" class="nav-link" data-key="t-sucursales">
                                        Casas de Campaña </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('categorias.index') }}" class="nav-link" data-key="t-sucursales">
                                        Distritos </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('grupos-entrenamientos.index') }}" class="nav-link"
                                        data-key="t-sucursales"> Bloques Políticos </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif

                @if ($listRoles == 'ADMINISTRADOR' || $listRoles == 'TÉCNICO')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('personas.index') }}" aria-expanded="false">
                            <i class="mdi mdi-account"></i> <span data-key="t-personas">Personas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('inscripciones.index') }}" aria-expanded="false">
                            <i class="mdi mdi-account-multiple"></i> <span data-key="t-inscripciones">Inscripciones </span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('categorias.index') }}" aria-expanded="false">
                        <i class="mdi mdi-format-list-bulleted"></i> <span data-key="t-categorias">Categorías</span>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('seguimientos.index') }}" aria-expanded="false">
                        <i class="mdi mdi-format-list-bulleted"></i> <span data-key="t-seguimientos">Seguimientos</span>
                    </a>
                </li> --}}


                @endif


                @if ($listRoles == 'ADMINISTRADOR' || $listRoles == 'ENTRENADOR' || $listRoles == 'TÉCNICO')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#asistencia" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="asistencia">
                            <i class=" mdi mdi-cog"></i>
                            <span data-key="t-asistencias"> Asistencia</span>
                        </a>
                        <div class="collapse menu-dropdown" id="asistencia">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('asistencia.marcado') }}" class="nav-link"
                                        data-key="t-asistencia-estudiante"> Asistencia de  Actividades </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ route("asistencia.index") }}" class="nav-link" data-key="t-asistencia"> Asistencia </a>
                                </li> --}}
                            </ul>
                        </div>
                    </li>
                @endif

                @if ($listRoles == 'ADMINISTRADOR')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#seguridad" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="seguridad">
                            <i class=" mdi mdi-cog"></i>
                            <span data-key="t-seguridad"> Seguridad</span>
                        </a>
                        <div class="collapse menu-dropdown" id="seguridad">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('usuarios.index') }}" class="nav-link" data-key="t-usuarios">
                                        Usuarios </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    @php
        var_dump($listRoles);

    @endphp

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
