@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('tutores.tutor')}} {{$tutor->first_name}} </h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row grid">
                {{--  Tutor  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('update-tutor', ['tutor' => $tutor])}}" method="POST">
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
                                <input id="email" name="email" type="text" class="validate" value="{{$tutor->email}}" required>
                                <label for="email">{{ __('tutores.email') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="phone" name="phone" type="text" class="validate" value="{{$tutor->phone}}" required>
                                <label for="phone">{{ __('tutores.phone') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="work_phone" name="work_phone" type="text" class="validate" value="{{$tutor->work_phone}}" required>
                                <label for="work_phone">{{ __('tutores.work_phone') }}</label>
                            </div>
                            <div class="input-field col s12">
                                <select id="gender" name="gender">
                                    <option value="M" @if($tutor->gender == "M") selected @endif>Mujer</option>
                                    <option value="H" @if($tutor->gender == "H") selected @endif>Hombre</option>
                                </select>
                                <label for="gender">{{__('tutores.gender')}}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="birth_date" name="birth_date" type="date" class="validate" value="{{$birth_date}}" required>
                                <label for="birth_date">{{ __('tutores.gender') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="street" name="street" type="text" class="validate" value="{{$tutor->street}}" required>
                                <label for="street">{{ __('tutores.street') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="street_number" name="street_number" type="text" class="validate" value="{{$tutor->street_number}}" required>
                                <label for="street_number">{{ __('tutores.street_number') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="neighborhood" name="neighborhood" type="text" class="validate" value="{{$tutor->neighborhood}}" required>
                                <label for="neighborhood">{{ __('tutores.neighborhood') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="community" name="community" type="text" class="validate" value="{{$tutor->community}}" required>
                                <label for="community">{{ __('tutores.community') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="city" name="city" type="text" class="validate" value="{{$tutor->city}}" required>
                                <label for="city">{{ __('tutores.city') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="zipcode" name="zipcode" type="text" class="validate" value="{{$tutor->zipcode}}" required>
                                <label for="zipcode">{{ __('tutores.zipcode') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="state" name="state" type="text" class="validate" value="{{$tutor->state}}" required>
                                <label for="state">{{ __('tutores.state') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="country" name="country" type="text" class="validate" value="{{$tutor->country}}" required>
                                <label for="country">{{ __('tutores.country') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="user_name" name="user_name" type="text" class="validate" value="{{$tutor->user_name}}" required>
                                <label for="user_name">{{ __('tutores.user_name') }}</label>
                            </div>

                            <div class="input-field col s12">
                                <select id="tetra" name="tetra">
                                    <option value="{{$tutor->tetra->id}}" selected>{{$tutor->tetra->identifier}}</option>
                                    @foreach($tetras as $tetra)
                                        <option value="{{$tetra->id}}" @if($tetra->id == $tutor->tetra->id) selected @endif>{{$tetra->identifier}}</option>
                                    @endforeach
                                </select>
                                <label for="tetra">{{__('tutores.tetra')}}</label>
                            </div>
                        <div class="input-field col s12">
                            <select id="gerente" name="gerente">
                                <option value="{{$tutor->gerente->id}}" selected>{{$tutor->gerente->user->first_name}} {{$tutor->gerente->user->last_name}}</option>
                                @foreach($gerentes as $gerente)
                                    <option value="{{$gerente->id}}" @if($gerente->id == $tutor->gerente->id) selected @endif>{{$gerente->user->first_name}} {{$gerente->user->last_name}}</option>
                                @endforeach
                            </select>
                            <label for="gerente">{{__('tutores.gerente')}}</label>
                        </div>
                        <div class="row center">
                            <div class="col s4 l4 center">
                                <button id="save-tutor" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('tutores.save') }}</button>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="#delete-tutor-modal" class="delete-tutor waves-effect waves-light btn-large modal-trigger red" data-tutor-id="{{$tutor->id}}">{{ __('common.delete') }}</a>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="{{route('tutores')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="delete-tutor-modal" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>{{__('tutores.delete_tutor')}}</h4>
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
    <script src="{{asset('/js/tutor.js')}}"></script>
@endsection
