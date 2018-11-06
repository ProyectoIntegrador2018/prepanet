@extends('layouts.app')
@section('header')
<h2 class="header white-text">{{__('tetras.tetra')}} {{$tetra->identifier}} </h2>
@stop

@section('content')
<div id="room">
    <div class="section">
        <div id="main" class="container">
            <div class="row grid">
                {{--  Staff  --}}
                <div class="col l12 m12 s12">
                    <form action="{{route('update-tetra', ['tetra' => $tetra])}}" method="POST">
                        @csrf
                        <br>
                        <div class="row">
                            <div class="input-field col s12 m4 l4">
                                <input id="identifier" name="identifier" type="text" class="validate" value="{{$tetra->identifier}}" required>
                                <label for="identifier">{{ __('tetras.identifier') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="year" name="year" type="number" class="validate" value="{{$tetra->year}}" required>
                                <label for="year">{{ __('tetras.year') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="type" name="type" type="number" class="validate" value="{{$tetra->type}}" min="0" max="2" required>
                                <label for="type">{{ __('tetras.type') }}</label>
                            </div>
                            <div class="input-field col s12 m4 l4">
                                <input id="goal" name="goal" goal="number" class="validate" value="{{$tetra->goal}}" required>
                                <label for="goal">{{ __('tetras.goal') }}</label>
                            </div>
                            <div class="input-field col s12">
                                <select id="campus" name="campus">
                                    <option value="{{$tetra->campus->id}}" disabled selected>{{$tetra->campus->identifier}}</option>

                                    @foreach($campuses as $campus)
                                        <option value="{{$campus->id}}" @if($campus->id == $tetra->campus->id) selected @endif>{{$campus->identifier}}</option>
                                    @endforeach

                                </select>
                                <label for="campus">{{__('tetras.campus')}}</label>
                            </div>
                        </div>
                        <div class="row center">
                            <div class="col s4 l4 center">
                                <button id="save-tetra" type="submit" class="primary-button waves-effect waves-light btn-large">{{ __('tetras.save') }}</button>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="#delete-tetra-modal" class="delete-tetra waves-effect waves-light btn-large modal-trigger red" data-tetra-id="{{$tetra->id}}">{{ __('common.delete') }}</a>
                            </div>
                            <div class="col s4 l4 center">
                                <a href="{{route('tetras')}}" class="waves-effect waves-light btn-large modal-trigger orange">{{ __('common.back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="delete-tetra-modal" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>{{__('tetras.delete_tetra')}}</h4>
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
    <script src="{{asset('/js/tetra.js')}}"></script>
@endsection
