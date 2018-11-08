@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('reportes.reporte_tutores')}}</h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row">
                <h1> Eliga los campus para los cuales quiere generar un reporte</h1>
            </div>
            <div class="row grid">
                {{--  Alumno  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('campus-tutores')}}" method="GET">
                        @csrf
                        <br>
                        <div class="row">
                            @foreach ($campuses as $campus)
                                <div class="switch col s4 m4 l4">
                                    <label id="status-switch" style="color: black; font-size:20px;"> {{$campus->name}}
                                        <br>
                                        {{ __('reportes.si') }}
                                        <input name="{{$campus->id}}" type="checkbox">
                                        <span class="lever"></span>
                                        {{ __('reportes.no') }}
                                        <br><br>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="row center">
                            <div class="col s6 l6 center">
                                <button id="save-alumno" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('common.next') }}</button>
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
