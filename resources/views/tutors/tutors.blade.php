@extends('layouts.app')
@section('header')
    <h2 class="header white-text">{{__('tutores.tutores')}}</h2>
@stop

@section('content')
    <div id="tutor">
        <div class="section">
            <div id="main" class="container">
                <div class="row grid">
                    @if($tutors->count() > 0)
                        @foreach ($tutors as $tutor)
                            <div class="col s12 m6 l4 grid-item">
                                <a href="{{route('tutor', ["tutor" => $tutor->id])}}">
                                    <div class="bordered-card card hoverable border-primary-color">
                                        <div class="card-content">
                                            <div class="row">
                                                <h5 class="bold black-text">{{$tutor->first_name}} {{$tutor->last_name}}</h5>
                                                <h5 class="black-text">{{$tutor->tetra->identifier}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="center"><i class="material-icons big-icon">sentiment_dissatisfied</i></h3>
                        <h3 class="center">{{__('tutores.no_tutor')}}</h3>
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
                                    <label for="first_name">{{__('tutores.first_name')}}</label>
                                    <input id="first_name" type="text" name="first_name" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="last_name">{{__('tutores.last_name')}}</label>
                                    <input id="last_name" type="text" name="last_name" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="email">{{__('tutores.email')}}</label>
                                    <input id="email" type="email" name="email" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="phone">{{__('tutores.phone')}}</label>
                                    <input id="phone" type="text" name="phone" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="work_phone">{{__('tutores.work_phone')}}</label>
                                    <input id="work_phone" type="text" name="work_phone" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="gender" name="gender">
                                        <option value="" disabled selected>{{__('tutores.select_gender')}}</option>
                                        <option value="H">Hombre</option>
                                        <option value="M">Mujer</option>
                                    </select>
                                    <label for="gender">{{__('tutores.gender')}}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="birth_date">{{__('tutores.birth_date')}}</label>
                                    <input id="birth_date" type="date" name="birth_date" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="street">{{__('tutores.street')}}</label>
                                    <input id="street" type="text" name="street" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="street_number">{{__('tutores.street_number')}}</label>
                                    <input id="street_number" type="text" name="street_number" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="neighborhood">{{__('tutores.neighborhood')}}</label>
                                    <input id="neighborhood" type="text" name="neighborhood" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="community">{{__('tutores.community')}}</label>
                                    <input id="community" type="text" name="community" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="city">{{__('tutores.city')}}</label>
                                    <input id="city" type="text" name="city" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="zipcode">{{__('tutores.zipcode')}}</label>
                                    <input id="zipcode" type="text" name="zipcode" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="state">{{__('tutores.state')}}</label>
                                    <input id="state" type="text" name="state" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="country">{{__('tutores.country')}}</label>
                                    <input id="country" type="text" name="country" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="user_name">{{__('tutores.user_name')}}</label>
                                    <input id="user_name" type="text" name="user_name" required class="validate">
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="user_password">{{__('tutores.user_password')}}</label>
                                    <input id="user_password" type="text" name="user_password" required class="validate">
                                </div>
                            </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <select id="tetra" name="tetra">
                                    <option value="" disabled selected>{{__('tutores.select_tetra')}}</option>

                                    @foreach($tetras as $tetra)
                                        <option value="{{$tetra->id}}">{{$tetra->identifier}}</option>
                                    @endforeach

                                </select>
                                <label for="tetra">{{__('tutores.tetra')}}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <select id="gerente" name="gerente">
                                    <option value="" disabled selected>{{__('tutores.select_gerente')}}</option>

                                    @foreach($gerentes as $gerente)
                                        <option value="{{$gerente->id}}">{{$gerente->user->first_name}} {{$gerente->user->last_name}}</option>
                                    @endforeach

                                </select>
                                <label for="gerente">{{__('tutores.gerente')}}</label>
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
                <a href="#new-tutor-modal" class="btn-floating btn-large primary-color modal-trigger @if(!$tutors->count()) pulse @endif tooltipped" data-position="top" data-tooltip="{{__('common.add')}}">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        </div>
    @stop

    @section('scripts')
        <script src="{{asset('/js/masonry.min.js')}}"></script>
        <script src="{{asset('/js/masonry.js')}}"></script>
    @endsection
