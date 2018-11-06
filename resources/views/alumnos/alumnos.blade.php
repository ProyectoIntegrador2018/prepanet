@extends('layouts.app')
@section('header')
    <h2 class="header white-text">{{__('alumnos.alumnos')}}</h2>
@stop

@section('content')
    <div id="alumno">
        <div class="section">
            <div id="main" class="container">
                <div class="row grid">
                    @if($alumnos->count() > 0)
                        @foreach ($alumnos as $alumno)
                            <div class="col s12 m6 l4 grid-item">
                                <a href="{{route('alumno', ["alumno" => $alumno->id])}}">
                                    <div class="bordered-card card hoverable border-primary-color">
                                        <div class="card-content">
                                            <div class="row">
                                                <h5 class="bold black-text">{{$alumno->first_name}} {{$alumno->last_name}}</h5>
                                                <h5 class="black-text">{{$alumno->tetra->identifier}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h3 class="center"><i class="material-icons big-icon">sentiment_dissatisfied</i></h3>
                        <h3 class="center">{{__('alumnos.no_alumno')}}</h3>
                        <p class="center"><a href="#new-alumno-modal" class="modal-trigger">{{__('alumnos.try_adding')}}</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div id="new-alumno-modal" class="modal">
            <div class="modal-content">
                <form class="col s12" role="form" method="POST">
                    @csrf
                    <h4 id="modal-title">{{__('alumnos.new_alumno')}}</h4>
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="first_name">{{__('alumnos.first_name')}}</label>
                            <input id="first_name" type="text" name="first_name" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="last_name">{{__('alumnos.last_name')}}</label>
                            <input id="last_name" type="text" name="last_name" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="gender" name="gender">
                                <option value="" disabled selected>{{__('alumnos.select_gender')}}</option>
                                <option value="H">Hombre</option>
                                <option value="M">Mujer</option>
                            </select>
                            <label for="gender">{{__('alumnos.gender')}}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="birth_date">{{__('alumnos.birth_date')}}</label>
                            <input id="birth_date" type="date" name="birth_date" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="work_email">{{__('alumnos.work_email')}}</label>
                            <input id="work_email" type="text" name="work_email" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="email">{{__('alumnos.email')}}</label>
                            <input id="email" type="text" name="email" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="phone">{{__('alumnos.phone')}}</label>
                            <input id="phone" type="text" name="phone" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="city">{{__('alumnos.city')}}</label>
                            <input id="city" type="text" name="city" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="state">{{__('alumnos.state')}}</label>
                            <input id="state" type="text" name="state" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="country">{{__('alumnos.country')}}</label>
                            <input id="country" type="text" name="country" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="tutor_type">{{__('alumnos.tutor_type')}}</label>
                            <input id="tutor_type" type="text" name="tutor_type" required class="validate">
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <label for="carreer">{{__('alumnos.carreer')}}</label>
                            <input id="carreer" type="text" name="carreer" required class="validate">
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <label for="business">{{__('alumnos.business')}}</label>
                            <input id="business" type="text" name="business" required class="validate">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="tetra" name="tetra">
                                <option value="" disabled selected>{{__('alumnos.select_tetra')}}</option>

                                @foreach($tetras as $tetra)
                                    <option value="{{$tetra->id}}">{{$tetra->identifier}}</option>
                                @endforeach

                            </select>
                            <label for="tetra">{{__('alumnos.tetra')}}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="gerente" name="gerente">
                                <option value="" disabled selected>{{__('alumnos.select_gerente')}}</option>

                                @foreach($gerentes as $gerente)
                                    <option value="{{$gerente->id}}">{{$gerente->user->first_name}} {{$gerente->user->last_name}}</option>
                                @endforeach

                            </select>
                            <label for="gerente">{{__('alumnos.gerente')}}</label>
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
            <a href="#new-alumno-modal" class="btn-floating btn-large primary-color modal-trigger @if(!$alumnos->count()) pulse @endif tooltipped" data-position="top" data-tooltip="{{__('common.add')}}">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('/js/masonry.min.js')}}"></script>
    <script src="{{asset('/js/masonry.js')}}"></script>
@endsection
