@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('tutores.tutor')}} {{$tutor->user->name}} </h2>
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
                                <input id="first_name" name="first_name" type="text" class="validate" value="{{$tutor->user->first_name}}" required>
                                <label for="first_name">{{ __('tutores.first_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="last_name" name="last_name" type="text" class="validate" value="{{$tutor->user->last_name}}" required>
                                <label for="last_name">{{ __('tutores.last_name') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="email" name="email" type="text" class="validate" value="{{$tutor->user->email}}" required disabled>
                                <label for="email">{{ __('tutores.email') }}</label>
                            </div>
                            <div class="input-field col s12">
                                <select id="tetra" name="tetra">
                                    <option value="{{$tutor->tetra->id}}" disabled selected>{{$tutor->tetra->name}}</option>

                                    @foreach($tetras as $tetra)
                                <option value="{{$tetra->id}}" @if($tetra->id == $tutor->tetra->id) selected @endif>{{$tetra->name}}</option>
                                    @endforeach

                                </select>
                                <label for="tetra">{{__('tetra.campus')}}</label>
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
