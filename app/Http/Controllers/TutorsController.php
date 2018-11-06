<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\Tetra;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Users\Gerente;
use Illuminate\Validation\Rule;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use App\Models\Users\SuperAdministrator;

class TutorsController extends Controller
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
            'email' => 'required|email',
            'phone' => 'required|string',
            'work_phone' => 'required|string',
            'gender' => 'required|char',
            'birth_date' => 'required|date|before:today',
            'street' => 'required|string',
            'street_number' => 'required|string',
            'neighborhood' => 'required|string',
            'community' => 'required|string',
            'city' => 'required|string',
            'zipcode' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',

            'user_name' => 'required|string',
            'user_password' => 'required|string',

            'gerente_id' => 'required|exists:gerentes,id',
            'tetra_id' => 'required|exists:tetras,id',
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
            'email' => 'required|email',
            'phone' => 'required|string',
            'work_phone' => 'required|string',
            'gender' => 'required|char',
            'birth_date' => 'required|date|before:today',
            'street' => 'required|string',
            'street_number' => 'required|string',
            'neighborhood' => 'required|string',
            'community' => 'required|string',
            'city' => 'required|string',
            'zipcode' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',

            'user_name' => 'required|string',
            'user_password' => 'required|string',

            'gerente_id' => 'required|exists:gerentes,id',
            'tetra_id' => 'required|exists:tetras,id',
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
        $data['tutors'] = null;
        $data['gerentes'] = null;
        $data['tetras'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['tutors'] = Tutor::all();
                $data['gerentes'] = Gerente::all();
                $data['tetras'] = Tetra::all();
                break;
            case $userable instanceof Gerente:
                $data['tutors'] = Tutor::where('gerente_id', $userable->id);
                $data['gerentes'] = $userable;
                $campus = $userable->campus;
                $data['tetras'] = Tetra::where('campus_id', $campus->id);
                break;
            default:
                break;
        }
        return view('tutors.tutors', $data);
    }

    public function postTutor(Request $request)
    {
        // $this->authorize('create', Company::class);
        validateData($request->all(), $this->createRules());

        try {
            $tutor = Tutor::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'work_phone' => $request->get('work_phone'),
                'gender' => $request->get('gender'),
                'birth_date' => $request->get('birth_date'),
                'street' => $request->get('street'),
                'street_number' => $request->get('street_number'),
                'neighborhood' => $request->get('neighborhood'),
                'community' => $request->get('community'),
                'city' => $request->get('city'),
                'zipcode' => $request->get('zipcode'),
                'state' => $request->get('state'),
                'country' => $request->get('country'),

                'user_name' => $request->get('user_name'),
                'user_password' => $request->get('user_password'),

                'gerente_id' => $request->get('gerente'),
                'tetra_id' => $request->get('tetra_id'),
            ]);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('tutores.error_add_alumno'));
        }
        Session::flash('flash_message', __("tutores.new_alumno_created", ["tutor" => $tutor->first_name]));
        return redirect()->route('tutores');
    }

    /**
     * Display the specified resource.
     *
     * @param  Carrier  $company
     * @return \Illuminate\Http\Response
     */
    public function getTutor(Tutor $tutor)
    {
        // $this->authorize('view', $campus);

        $data = [];
        $data["tutor"] = $tutor;
        return view('tutores.tutor', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function postEditTutor(Request $request, Tutor $tutor)
    {
        validateData($request->all(), $this->editRules());

        $tutor->first_name = $request->get('first_name');
        $tutor->last_name = $request->get('last_name');
        $tutor->email = $request->get('email');
        $tutor->phone = $request->get('phone');
        $tutor->work_phone = $request->get('work_phone');
        $tutor->gender = $request->get('gender');
        $tutor->birth_date = $request->get('birth_date');
        $tutor->street = $request->get('street');
        $tutor->street_number = $request->get('street_number');
        $tutor->neighborhood = $request->get('neighborhood');
        $tutor->community = $request->get('community');
        $tutor->city = $request->get('city');
        $tutor->zipcode = $request->get('zipcode');
        $tutor->state = $request->get('state');
        $tutor->country = $request->get('country');

        $tutor->user_name = $request->get('user_name');
        $tutor->user_password = $request->get('user_password');

        $tutor->gerente_id = $request->get('gerente');
        $tutor->tetra_id = $request->get('tetra_id');

        DB::transaction(function () use ($request, $tutor) {
            try {
                $tutor->save();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('tutores.error_edit_tutor'));
            }
        });
        Session::flash('flash_message', __('tutores.success_edit_tutor'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function postDeleteTutor(Request $request, Tutor $tutor)
    {
        if ($tutor->isDeletable()) {
            DB::transaction(function () use ($request, $tutor) {
                try {
                    $tutor->delete();
                } catch (\Exception $e) {
                    app()->make("lern")->record($e);
                    return back()->withErrors(__('tutores.error_delete_tutor'));
                }
            });
            Session::flash('flash_message', __('tutores.success_delete_tutor'));
            return redirect()->route('tutores');
        } else {
            return back()->withErrors(__('tutores.error_delete_tutor'));
        }
    }
}
