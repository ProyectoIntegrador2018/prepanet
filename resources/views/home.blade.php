@extends('layouts.app')
@section('header')
    <h2 class="header white-text">¡ Bienvenid@ {{\Auth::user()->getName()}} </h2>
@stop

@section('content')
    <div id="configurations">
        <div class="section">
            <div id="main" class="container">
                <div class="row grid">
                    @if(isSuperAdmin(\Auth::user()->userable))
                    <div class="col s12 m6 l4 grid-item">
                        <a href="">
                            <div class="bordered-card card hoverable border-green">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Crear Super Usuario</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon green-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(isSuperAdmin(\Auth::user()->userable))
                    <div class="col s12 m6 l4 grid-item">
                        <a href="">
                            <div class="bordered-card card hoverable border-yellow">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Crear Gerente</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon yellow-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(isSuperAdmin(\Auth::user()->userable))
                    <div class="col s12 m6 l4 grid-item">
                    <a href="">
                            <div class="bordered-card card hoverable border-red">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Crear Campus</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon red-text">business</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(isSuperAdmin(\Auth::user()->userable))
                    <div class="col s12 m6 l4 grid-item">
                        <a href="">
                            <div class="bordered-card card hoverable border-blue">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver tutores</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon blue-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @if(isSuperAdmin(\Auth::user()->userable))
                    <div class="col s12 m6 l4 grid-item">
                        <a href="">
                            <div class="bordered-card card hoverable border-orange">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver Alumnos</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon orange-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    <div class="col s12 m6 l4 grid-item">
                        <a href="">
                            <div class="bordered-card card hoverable border-secondary-color">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ingresar Tutor</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon secondary-color-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col s12 m6 l4 grid-item">
                        <a href="">
                            <div class="bordered-card card hoverable border-red">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ingresar Alumno</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon red-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('/js/masonry.min.js')}}"></script>
    <script src="{{asset('/js/masonry.js')}}"></script>
@endsection
