@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('gerentes.gerente')}} {{$gerente->user->name}} </h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row grid">
                {{--  Staff  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('update-gerente', ['gerente' => $gerente])}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                            <div class="input-field col s12 m4 l4">
                                <input id="first_name" name="first_name" type="text" class="validate" value="{{$gerente->user->first_name}}" required>
                                <label for="first_name">{{ __('gerentes.first_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="last_name" name="last_name" type="text" class="validate" value="{{$gerente->user->last_name}}" required>
                                <label for="last_name">{{ __('gerentes.last_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="email" name="email" type="text" class="validate" value="{{$gerente->user->email}}" required disabled>
                                <label for="email">{{ __('gerentes.email') }}</label>
                            </div>
                            <div class="input-field col s12">
                                <select id="campus" name="campus">
                                    <option value="{{$gerente->campus->id}}" disabled selected>{{$gerente->campus->name}}</option>

                                    @foreach($campuses as $campus)
                                <option value="{{$campus->id}}" @if($campus->id == $gerente->campus->id) selected @endif>{{$campus->name}}</option>
                                    @endforeach

                                </select>
                                <label for="campus">{{__('gerentes.campus')}}</label>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="col s4 l4 center">
                                <button id="save-gerente" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('gerentes.save') }}</button>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="#delete-gerente-modal" class="delete-gerente waves-effect waves-light btn-large modal-trigger red" data-gerente-id="{{$gerente->id}}">{{ __('common.delete') }}</a>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="{{route('gerentes')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="delete-gerente-modal" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>{{__('gerentes.delete_gerente')}}</h4>
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
    <script src="{{asset('/js/gerente.js')}}"></script>
@endsection
