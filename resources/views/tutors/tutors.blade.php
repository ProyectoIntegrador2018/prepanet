@extends('layouts.app')
@section('header')
    <h2 class="header white-text">{{__('tutores.tutores')}}</h2>
@stop

@section('content')
    <div id="tutores">
        <div class="section">
            <div id="main" class="container">
                <div class="row grid">
                    @if($tutores->count())
                        @foreach ($tutores as $tutor)
                            <div class="col s12 m6 l4 grid-item">
                                <a href="{{route('tutor', ["tutor" => tutor->id])}}">
                                    <div class="bordered-card card hoverable border-primary-color">
                                        <div class="card-content">
                                            <div class="row">
                                                <h5 class="bold black-text">{{$tutor->name}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="center"><i class="material-icons big-icon">sentiment_dissatisfied</i></h3>
                        <h3 class="center">{{__('tutor.no_tutores')}}</h3>
                        <p class="center"><a href="#new-tutor-modal" class="modal-trigger">{{__('tutores.try_adding')}}</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div id="new-tutor-modal" class="modal">
            <div class="modal-content">
                <form class="col s12" role="form" method="POST">
                    @csrf

                    <h4 id="modal-title">{{__('tutores.new_tutor')}}</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="name">{{__('tutores.name')}}</label>
                            <input id="name" type="text" name="name" required class="validate">
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
            <a href="#new-tutor-modal" class="btn-floating btn-large primary-color modal-trigger @if(!$tutores->count()) pulse @endif tooltipped" data-position="top" data-tooltip="{{__('common.add')}}">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('/js/masonry.min.js')}}"></script>
    <script src="{{asset('/js/masonry.js')}}"></script>
@endsection
