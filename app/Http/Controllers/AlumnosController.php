<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\Tetra;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Users\Gerente;
use Illuminate\Validation\Rule;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use App\Models\Users\SuperAdministrator;

class AlumnosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Created an array that has the validations needed for registering the resource.
     *
     * @var array
     */
    public function createRules(){
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string',
            'birth_date' => 'required|date|before:today',
            'work_email' => 'required|email',
            'email' => 'required|email',
            'phone' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'tutor_type' => 'required|string',
            'carreer' => 'required|string',
            'business' => 'required|string',
            'gerente' => 'required|exists:gerentes,id',
            'tetra' => 'required|exists:tetras,id',
        ];
    }

    /**
     * Created an array that has the validations needed for editing the resource.
     *
     * @var array
     */
    public function editRules($campusName, $campusCode){
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string',
            'birth_date' => 'required|date|before:today',
            'work_email' => 'required|email',
            'email' => 'required|email',
            'phone' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'tutor_type' => 'required|string',
            'carreer' => 'required|string',
            'business' => 'required|string',
            'gerente' => 'required|exists:gerentes,id',
            'tetra' => 'required|exists:tetras,id',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $userable = Auth::user()->userable;
        $data['alumnos'] = null;
        $data['gerentes'] = null;
        $data['tetras'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['alumnos'] = Alumno::all();
                $data['gerentes'] = Gerente::all();
                $data['tetras'] = Tetra::all();
                break;
            case $userable instanceof Gerente:
                $data['alumnos'] = Alumno::all();
                $data['gerentes'] = $userable;
                $campus = $userable->campus;
                $data['tetras'] = Tetra::where('campus_id', $campus->id);
                break;
            default:
                break;
        }
        return view('alumnos.alumnos', $data);
    }

    public function postAlumno(Request $request)
    {
        // $this->authorize('create', Company::class);
        validateData($request->all(), $this->createRules());

        try {
            $alumno = Alumno::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'gender' => $request->get('gender'),
                'birth_date' => Carbon::createFromFormat('Y-m-d', $request->get('birth_date')),
                'work_email' => $request->get('work_email'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'country' => $request->get('country'),
                'tutor_type' => $request->get('tutor_type'),
                'carreer' => $request->get('carreer'),
                'business' => $request->get('business'),
                'gerente_id' => $request->get('gerente'),
                'tetra_id' => $request->get('tetra'),
            ]);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('alumnos.error_add_alumno'));
        }
        Session::flash('flash_message', __("alumnos.new_alumno_created", ["alumno" => $alumno->first_name]));
        return redirect()->route('alumnos');
    }

    /**
     * Display the specified resource.
     *
     * @param  Carrier  $company
     * @return \Illuminate\Http\Response
     */
    public function getAlumno(Alumno $alumno)
    {
        // $this->authorize('view', $campus);

        $data = [];
        $data["alumno"] = $alumno;
        $data['gerentes'] = null;
        $data['tetras'] = null;
        $userable = Auth::user()->userable;
        if($alumno->birth_date != null){
            $data['birth_date'] = ($alumno->birth_date)->format('Y-m-d');
        }
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['gerentes'] = Gerente::all();
                $data['tetras'] = Tetra::all();
                break;
            case $userable instanceof Gerente:
                $data['gerentes'] = $userable;
                $campus = $userable->campus;
                $data['tetras'] = Tetra::where('campus_id', $campus->id);
                break;
            default:
                break;
        }
        return view('alumnos.alumno', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function updateAlumno(Request $request, Alumno $alumno)
    {
        validateData($request->all(), $this->editRules());

        $alumno->first_name = $request->get('first_name');
        $alumno->last_name = $request->get('last_name');
        $alumno->gender = $request->get('gender');
        $alumno->birth_date = $request->get('birth_date');
        $alumno->work_email = $request->get('work_email');
        $alumno->email = $request->get('email');
        $alumno->phone = $request->get('phone');
        $alumno->city = $request->get('city');
        $alumno->state = $request->get('state');
        $alumno->country = $request->get('country');
        $alumno->tutor_type = $request->get('tutor_type');
        $alumno->carreer = $request->get('carreer');
        $alumno->business = $request->get('business');
        $alumno->gerente_id = $request->get('gerente');
        $alumno->tetra_id = $request->get('tetra');

        DB::transaction(function () use ($request, $alumno) {
            try {
                $alumno->save();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('alumnos.error_edit_alumno'));
            }
        });
        Session::flash('flash_message', __('alumnos.success_edit_alumno'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function deleteAlumno(Request $request, Alumno $alumno)
    {
        if ($alumno->isDeletable()) {
            DB::transaction(function () use ($request, $alumno) {
                try {
                    $alumno->delete();
                } catch (\Exception $e) {
                    app()->make("lern")->record($e);
                    return back()->withErrors(__('alumnos.error_delete_alumno'));
                }
            });
            Session::flash('flash_message', __('alumnos.success_delete_alumno'));
            return redirect()->route('alumnos');
        } else {
            return back()->withErrors(__('alumnos.error_delete_alumno'));
        }
    }
}
