@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('alumnos.alumno')}} {{$alumno->first_name}} {{$alumno->last_name}} </h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row grid">
                {{--  Alumno  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('update-alumno', ['alumno' => $alumno])}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                          <div class="input-field col s12 m4 l4">
                              <input id="first_name" name="first_name" type="text" class="validate" value="{{$alumno->first_name}}" required>
                              <label for="first_name">{{ __('alumnos.first_name') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="last_name" name="last_name" type="text" class="validate" value="{{$alumno->last_name}}" required>
                              <label for="last_name">{{ __('alumnos.last_name') }}</label>
                          </div>

                          <div class="input-field col s12">
                            <select id="gender" name="gender">
                                <option value="M" @if($alumno->gender == "M") selected @endif>Mujer</option>
                                <option value="H" @if($alumno->gender == "H") selected @endif>Hombre</option>
                            </select>
                            <label for="gender">{{__('alumnos.gender')}}</label>
                        </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="birth_date" name="birth_date" type="date" class="validate" value="{{$birth_date}}" required>
                              <label for="birth_date">{{ __('alumnos.gender') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                                <input id="work_email" name="work_email" type="email" class="validate" value="{{$alumno->work_email}}" required>
                                <label for="work_email">{{ __('alumnos.work_email') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="email" name="email" type="email" class="validate" value="{{$alumno->email}}" required>
                              <label for="email">{{ __('alumnos.email') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="phone" name="phone" type="text" class="validate" value="{{$alumno->phone}}" required>
                              <label for="phone">{{ __('alumnos.phone') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="city" name="city" type="text" class="validate" value="{{$alumno->city}}" required>
                              <label for="city">{{ __('alumnos.city') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="state" name="state" type="text" class="validate" value="{{$alumno->state}}" required>
                              <label for="state">{{ __('alumnos.state') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="country" name="country" type="text" class="validate" value="{{$alumno->country}}" required>
                              <label for="country">{{ __('alumnos.country') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="tutor_type" name="tutor_type" type="text" class="validate" value="{{$alumno->tutor_type}}" required>
                              <label for="tutor_type">{{ __('alumnos.tutor_type') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="user_name" name="user_name" type="text" class="validate" value="{{$alumno->user_name}}" required>
                              <label for="user_name">{{ __('alumnos.user_name') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                            <input id="user_password" name="user_password" type="text" class="validate" value="{{$alumno->user_password}}" required>
                            <label for="user_password">{{ __('alumnos.user_password') }}</label>
                        </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="business" name="business" type="text" class="validate" value="{{$alumno->business}}" required>
                              <label for="business">{{ __('alumnos.business') }}</label>
                          </div>

                          <div class="input-field col s12">
                                <select id="tetra" name="tetra">
                                    <option value="{{$alumno->tetra->id}}" selected>{{$alumno->tetra->identifier}}</option>
                                    @foreach($tetras as $tetra)
                                        <option value="{{$tetra->id}}" @if($tetra->id == $alumno->tetra->id) selected @endif>{{$tetra->identifier}}</option>
                                    @endforeach
                                </select>
                                <label for="tetra">{{__('alumnos.tetra')}}</label>
                            </div>
                        <div class="input-field col s12">
                            <select id="gerente" name="gerente">
                                <option value="{{$alumno->gerente->id}}" selected>{{$alumno->gerente->user->first_name}} {{$alumno->gerente->user->last_name}}</option>
                                @foreach($gerentes as $gerente)
                                    <option value="{{$gerente->id}}" @if($gerente->id == $alumno->gerente->id) selected @endif>{{$gerente->user->first_name}} {{$gerente->user->last_name}}</option>
                                @endforeach
                            </select>
                            <label for="gerente">{{__('alumnos.gerente')}}</label>
                        </div>
                        <div class="row center">
                            <div class="col s4 l4 center">
                                <button id="save-alumno" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('alumnos.save') }}</button>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="#delete-alumno-modal" class="delete-alumno waves-effect waves-light btn-large modal-trigger red" data-alumno-id="{{$alumno->id}}">{{ __('common.delete') }}</a>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="{{route('alumnos')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="delete-alumno-modal" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>{{__('alumnos.delete_alumno')}}</h4>
        </div>
        <div class="modal-footer">
            <form method="POST" action="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="modal-action modal-close waves-effect waves-red btn-flat red white-text">@lang('common.yes')</button>
                <a class="modal-action modal-close waves-effect waves-blue btn-flat blue white-text">@lang('common.nevermind')</a>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
    <script src="{{asset('/js/masonry.min.js')}}"></script>
    <script src="{{asset('/js/masonry.js')}}"></script>
    <script src="{{asset('/js/alumno.js')}}"></script>
@endsection
