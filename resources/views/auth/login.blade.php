@extends('auth.layouts.app')

@section('content')
<div id="login">
    <div class="row">
        <div class="container">
            <div class="row login-form">
                <div class="col s12  m6 offset-m3">
                    <div class="card grey lighten-4">
                        <div class="card-content container">
                            <div class="row login-logo">
                                <div class="container center">
                                    <img src="{{asset('/images/logo.gif')}}" class="responsive-img">
                                </div>
                            </div>
                            <form role="form" method="POST" action="{{ url('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="email" name="email" type="email" class="validate" autocomplete="email">
                                        <label for="email">Correo Electrónico</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="password" name="password" type="password" class="validate">
                                        <label for="password">Contraseña</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="waves-effect waves-light btn-large col s12 primary-button">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
