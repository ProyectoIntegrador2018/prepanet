@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('reportes.reporte_tutores')}}</h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row">
                <h1> Elija los campus para los cuales quiere generar un reporte</h1>
            </div>
            <div class="row grid">
                {{--  Alumno  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('reportes-tutores')}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                            <div class="input-field col s12">
                                <select id="tetra" name="tetra">
                                    <option value="" disabled selected>{{__('tetras.select_type')}}</option>

                                    @foreach($types as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach

                                </select>
                                <label for="tetra">{{__('tetras.type')}}</label>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($campuses as $campus)
                                <div class="switch col s4 m4 l4">
                                    <label id="status-switch" style="color: black; font-size:20px;"> {{$campus->name}}
                                        <br>
                                        {{ __('reportes.no') }}
                                        <input name="campuses[{{$campus->id}}]" type="checkbox" checked>
                                        <span class="lever"></span>
                                        {{ __('reportes.si') }}
                                        <br><br>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="row">
                            <div class="switch col s12 m12 l12 center">
                                <label id="status-switch" style="color: black; font-size:20px;"> Generar reporte sin seleccionar alumnos específicos de campus
                                    <br>
                                    {{ __('reportes.no') }}
                                    <input name="now" type="checkbox">
                                    <span class="lever"></span>
                                    {{ __('reportes.si') }}
                                    <br><br>
                                </label>
                            </div>
                        </div> --}}
                        <div class="row center">
                            <div class="col s6 l6 center">
                                <button id="save-alumno" type="submit" class="primary-button waves-effect waves-light btn-large">GENERAR</button>
                            </div>
                            <div class="col s6 l6 center">
                                <a href="{{route('alumnos')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
                            </div>
                        </div>
                    </form>
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
