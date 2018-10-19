@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('super-administrators.super_admin')}} {{$superAdmin->name}} </h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row grid">
                {{--  Staff  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('update-super-administrator', ['super-administrator' => $superAdmin])}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                            <div class="input-field col s12 m4 l4">
                                <input id="first_name" name="first_name" type="text" class="validate" value="{{$superAdmin->user->first_name}}" required>
                                <label for="first_name">{{ __('super-administrators.first_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="last_name" name="last_name" type="text" class="validate" value="{{$superAdmin->user->last_name}}" required>
                                <label for="last_name">{{ __('super-administrators.last_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="email" name="email" type="text" class="validate" value="{{$superAdmin->user->email}}" required disabled>
                                <label for="email">{{ __('super-administrators.email') }}</label>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="col s4 l4 center">
                                <button id="save-super-administrator" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('super-administrators.save') }}</button>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="#delete-super-administrator-modal" class="delete-super-administrator waves-effect waves-light btn-large modal-trigger red" data-super-administrator-id="{{$superAdmin->id}}">{{ __('common.delete') }}</a>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="{{route('super-administrators')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="delete-super-administrator-modal" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>{{__('super-administrators.delete_super_administrator')}}</h4>
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
    <script src="{{asset('/js/super-administrator.js')}}"></script>
@endsection
