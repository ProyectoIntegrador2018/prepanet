@extends('layouts.app')
@section('header')
<h2 class="header white-text">Perfil del Usuario</h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row grid">
                {{--  Staff  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('update-profile', ['user' => $user])}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                            <div class="input-field col s12 m4 l4">
                                <input id="email" name="email" type="text" class="validate" value="{{$user->email}}" required disabled>
                                <label for="email">{{ __('gerentes.email') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="first_name" name="first_name" type="text" class="validate" value="{{$user->first_name}}" required>
                                <label for="first_name">{{ __('gerentes.first_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="last_name" name="last_name" type="text" class="validate" value="{{$user->last_name}}" required>
                                <label for="last_name">{{ __('gerentes.last_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="password" name="password" type="text" class="validate" value="" required>
                                <label for="password">Nueva contraseña</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="confirm-password" name="confirm-password" type="text" class="validate" value="" required>
                                <label for="confirm-password">Confirmar nueva contraseña</label>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="col s4 l4 center">
                                <button id="save-profile" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('gerentes.save') }}</button>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="{{route('home')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
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
    <script src="{{asset('/js/gerente.js')}}"></script>
@endsection
