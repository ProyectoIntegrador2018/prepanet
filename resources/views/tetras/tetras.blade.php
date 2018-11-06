@extends('layouts.app')
@section('header')
    <h2 class="header white-text">{{__('tetras.tetras')}}</h2>
@stop

@section('content')
    <div id="tetras">
        <div class="section">
            <div id="main" class="container">
                <div class="row grid">
                    @if($tetras->count() > 0)
                        @foreach ($tetras as $tetra)
                            <div class="col s12 m6 l4 grid-item">
                                <a href="{{route('tetra', ["tetra" => $tetra->id])}}">
                                    <div class="bordered-card card hoverable border-primary-color">
                                        <div class="card-content">
                                            <div class="row">
                                                <h5 class="bold black-text">{{$tetra->identifier}}</h5>
                                                <h5 class="black-text">{{$tetra->campus->name}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="center"><i class="material-icons big-icon">sentiment_dissatisfied</i></h3>
                        <h3 class="center">{{__('tetras.no_tetra')}}</h3>
                        <p class="center"><a href="#new-tetra-modal" class="modal-trigger">{{__('tetras.try_adding')}}</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div id="new-tetra-modal" class="modal">
            <div class="modal-content">
                <form class="col s12" role="form" method="POST">
                    @csrf
                    <h4 id="modal-title">{{__('tetras.new_tetra')}}</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="identifier">{{__('tetras.identifier')}}</label>
                            <input id="identifier" type="text" name="identifier" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="year">{{__('tetras.year')}}</label>
                            <input id="year" type="number" name="year" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="type">{{__('tetras.type')}}</label>
                            <input id="type" type="number" name="type" min="0" max="2" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="goal">{{__('tetras.goal')}}</label>
                            <input id="goal" type="number" name="goal" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="campus" name="campus">
                                <option value="" disabled selected>{{__('tetras.select_campus')}}</option>

                                @foreach($campuses as $campus)
                                    <option value="{{$campus->id}}">{{$campus->name}}</option>
                                @endforeach

                            </select>
                            <label for="campus">{{__('tetras.campus')}}</label>
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
            <a href="#new-tetra-modal" class="btn-floating btn-large primary-color modal-trigger @if(!$tetras->count()) pulse @endif tooltipped" data-position="top" data-tooltip="{{__('common.add')}}">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('/js/masonry.min.js')}}"></script>
    <script src="{{asset('/js/masonry.js')}}"></script>
@endsection
