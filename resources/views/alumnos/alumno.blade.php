@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('alumnos.alumno')}} {{$alumno->user->name}} </h2>
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
                              <input id="first_name" name="first_name" type="text" class="validate" value="{{$tutor->first_name}}" required>
                              <label for="first_name">{{ __('tutores.first_name') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="last_name" name="last_name" type="text" class="validate" value="{{$tutor->last_name}}" required>
                              <label for="last_name">{{ __('tutores.last_name') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="gender" name="gender" type="text" class="validate" value="{{$tutor->gender}}" required disabled>
                              <label for="gender">{{ __('tutores.gender') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="birth_date" name="birth_date" type="date" class="validate" value="{{$tutor->birth_date}}" required disabled>
                              <label for="birth_date">{{ __('tutores.gender') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="email" name="email" type="text" class="validate" value="{{$tutor->user->email}}" required disabled>
                              <label for="email">{{ __('tutores.email') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="phone" name="phone" type="text" class="validate" value="{{$tutor->phone}}" required disabled>
                              <label for="phone">{{ __('tutores.phone') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="city" name="city" type="text" class="validate" value="{{$tutor->city}}" required disabled>
                              <label for="city">{{ __('tutores.city') }}</label>
                          </div>

                          <div class="input-field col s12 m4 l4">
                              <input id="state" name="state" type="text" class="validate" value="{{$tutor->state}}" required disabled>
                              <label for="state">{{ __('tutores.state') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="country" name="country" type="text" class="validate" value="{{$tutor->country}}" required disabled>
                              <label for="country">{{ __('tutores.country') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="tutor_type" name="tutor_type" type="text" class="validate" value="{{$tutor->tutor_type}}" required disabled>
                              <label for="tutor_type">{{ __('tutores.tutor_type') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="carreer" name="carreer" type="text" class="validate" value="{{$tutor->carreer}}" required disabled>
                              <label for="carreer">{{ __('tutores.carreer') }}</label>
                          </div>
                          <div class="input-field col s12 m4 l4">
                              <input id="business" name="business" type="text" class="validate" value="{{$tutor->business}}" required disabled>
                              <label for="business">{{ __('tutores.business') }}</label>
                          </div>

                          <div class="input-field col s12">
                              <select id="gerente" name="gerente">
                                  <option value="{{$alumnos->gerentes->id}}" disabled selected>{{$alumnos->gerentes->first_name}}</option>

                                  @foreach($gerentes as $gerente)
                              <option value="{{$gerentes->id}}" @if($gerentes->id == $alumnos->gerentes->id) selected @endif>{{$gerentes->first_name}}</option>
                                  @endforeach

                              </select>
                              <label for="gerente">{{__('gerente.campus')}}</label>
                          </div>

                          <div class="input-field col s12">
                              <select id="tetra" name="tetra">
                                  <option value="{{$alumnos->tetras->id}}" disabled selected>{{$alumnos->tetras->name}}</option>

                                  @foreach($tetras as $tetra)
                              <option value="{{$tetras->id}}" @if($tetras->id == $alumnos->tetras->id) selected @endif>{{$tetras->name}}</option>
                                  @endforeach

                              </select>
                              <label for="tetra">{{__('tetra.campus')}}</label>
                          </div>
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
