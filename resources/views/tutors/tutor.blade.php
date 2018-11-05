@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('tutores.tutores')}} {{$tutor->name}} </h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row grid">
                {{--  Tutores  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('update-tutor', ['tutor' => $tutor])}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                            <div class="input-field col s12 m4 l4">
                                <input id="name" name="name" type="text" class="validate" value="{{tutores->name}}" required>
                                <label for="name">{{ __('tutores.name') }}</label>
                            </div>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="delete-tutor-modal" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>{{__('tutor.delete_tutor')}}</h4>
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
