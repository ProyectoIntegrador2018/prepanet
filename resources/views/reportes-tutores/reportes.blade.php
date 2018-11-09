@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('reportes.reporte_tutores')}}</h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row">
                <h1> Eliga los tutores para los cuales quiere generar el reporte </h1>
            </div>
            <div class="row grid">
                {{--  Alumno  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('excel-tutores')}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                            @foreach ($tutores as $tutor)
                                <div class="switch col s12 m12 l12">
                                <label id="status-switch" style="color: black; font-size:20px;"> Tutor: {{$tutor->first_name}} {{$tutor->last_name}} || Gerente: {{$tutor->gerente->user->first_name}} {{$tutor->gerente->user->last_name}} || Campus: {{$tutor->tetra->campus->name}} || Tetra: {{$tutor->tetra->identifier}} - {{$tutor->tetra->tipoTetra()}}
                                        <br>
                                        {{ __('reportes.no') }}
                                        <input name="tutores[{{$tutor->id}}]" type="checkbox" checked>
                                        <span class="lever"></span>
                                        {{ __('reportes.si') }}
                                        <br><br>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="row center">
                            <div class="col s6 l6 center">
                                <button id="save-alumno" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('common.generar') }}</button>
                            </div>
                            <div class="col s6 l6 center">
                                <a href="{{route('campus-tutores')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
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
