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
                        <a href="{{route('super-administrators')}}">
                            <div class="bordered-card card hoverable border-green">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver/Crear Super usuario</h5>
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
                        <a href="{{route('gerentes')}}">
                            <div class="bordered-card card hoverable border-yellow">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver/Crear Gerente</h5>
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
                    <a href="{{route('campuses')}}">
                            <div class="bordered-card card hoverable border-red">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver/Crear Campus</h5>
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
                    <div class="col s12 m6 l4 grid-item">
                        <a href="{{route('tetras')}}">
                            <div class="bordered-card card hoverable border-black">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver/Crear tetras</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon black-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col s12 m6 l4 grid-item">
                        <a href="{{route('tutores')}}">
                            <div class="bordered-card card hoverable border-blue">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver/Crear tutores</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon blue-text">accessibility</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col s12 m6 l4 grid-item">
                        <a href="{{route('alumnos')}}">
                            <div class="bordered-card card hoverable border-orange">
                                <div class="card-content">
                                    <div class="row valign-wrapper">
                                        <div class="col s6">
                                            <h5 class="bold black-text">Ver/Crear Alumnos</h5>
                                        </div>
                                        <div class="col s6 valign center">
                                            <i class="material-icons big-icon orange-text">accessibility</i>
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
