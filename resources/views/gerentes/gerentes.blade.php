@extends('layouts.app')
@section('header')
    <h2 class="header white-text">{{__('gerentes.gerentes')}}</h2>
@stop

@section('content')
    <div id="super-admin">
        <div class="section">
            <div id="main" class="container">
                <div class="row grid">
                    @if($gerentes->count())
                        @foreach ($gerentes as $gerente)
                            <div class="col s12 m6 l4 grid-item">
                                <a href="{{route('gerente', ["gerente" => $gerente->id])}}">
                                    <div class="bordered-card card hoverable border-primary-color">
                                        <div class="card-content">
                                            <div class="row">
                                                <h5 class="bold black-text">{{$gerente->user->first_name}} {{$gerente->user->last_name}}</h5>
                                                <h5 class="black-text">{{$gerente->campus->name}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="center"><i class="material-icons big-icon">sentiment_dissatisfied</i></h3>
                        <h3 class="center">{{__('gerentes.no_gerente')}}</h3>
                        <p class="center"><a href="#new-super-admin-modal" class="modal-trigger">{{__('gerentes.try_adding')}}</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div id="new-super-admin-modal" class="modal">
            <div class="modal-content">
                <form class="col s12" role="form" method="POST">
                    @csrf
                    <h4 id="modal-title">{{__('gerentes.new_gerente')}}</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="email">{{__('gerentes.email')}}</label>
                            <input id="email" type="text" name="email" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="password">{{__('gerentes.password')}}</label>
                            <input id="password" type="password" name="password" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="confirm-password">{{__('gerentes.confirm_password')}}</label>
                            <input id="confirm-password" type="password" name="confirm-password" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="first_name">{{__('gerentes.first_name')}}</label>
                            <input id="first_name" type="text" name="first_name" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="last_name">{{__('gerentes.last_name')}}</label>
                            <input id="last_name" type="text" name="last_name" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="campus" name="campus">
                                <option value="" disabled selected>{{__('gerentes.select_campus')}}</option>

                                @foreach($campuses as $campus)
                                <option value="{{$campus->id}}">{{$campus->name}}</option>
                                @endforeach

                            </select>
                            <label for="campus">{{__('gerentes.campus')}}</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#!" class="red white-text modal-action modal-close waves-effect waves-red btn-flat">{{__('common.close')}}</a>
                        <button type="submit" class="green white-text waves-effect waves-green btn-flat" style="margin-right:1rem;">{{__('common.save')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="fixed-action-btn">
            <a href="#new-super-admin-modal" class="btn-floating btn-large primary-color modal-trigger @if(!$gerentes->count()) pulse @endif tooltipped" data-position="top" data-tooltip="{{__('common.add')}}">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('/js/masonry.min.js')}}"></script>
    <script src="{{asset('/js/masonry.js')}}"></script>
@endsection
