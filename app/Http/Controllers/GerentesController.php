<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Users\Gerente;
use App\Models\Users\SuperAdministrator;

class GerentesController extends Controller
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
            'email' => 'email|max:255|unique:users|filled|required|',
            'password' => 'required|string',
            'confirm-password' => 'required|string',
            'first_name' => 'required|string|between:3,50',
            'last_name' => 'required|string|between:3,50',
            'campus' => 'required|exists:campuses,id',
        ];
    }

    /**
     * Created an array that has the validations needed for editing the resource.
     *
     * @var array
     */
    public function editRules(){
        return [
            // 'password' => 'required|string',
            // 'confirm-password' => 'required|string',
            'first_name' => 'required|string|between:3,50',
            'last_name' => 'required|string|between:3,50',
            'campus' => 'required|exists:campuses,id',
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
        $data['gerentes'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['gerentes'] = Gerente::all();
                $data['campuses'] = Campus::all();
                break;
            default:
                break;
        }
        return view('gerentes.gerentes', $data);
    }

    public function postGerente(Request $request)
    {
        // $this->authorize('create', Company::class);
        validateData($request->all(), $this->createRules());

        if($request->get('password') != $request->get('confirm-password'))
        {
            return back()->withErrors(__('gerentes.error_not_same_password'));
        }

        try {
            $gerente = Gerente::create([
                "campus_id" => $request->get('campus'),
            ]);

            $mainUser = new User(
                [
                    "first_name" => $request->get('first_name'),
                    "last_name" => $request->get('last_name'),
                    "password" => bcrypt($request->get('password')),
                    "email" => $request->get('email'),
                ]
            );
            $mainUser = $gerente->user()->save($mainUser);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('gerentes.error_add_gerente'));
        }
        Session::flash('flash_message', __("gerentes.new_gerente_created", ["gerente" => $gerente->user->first_name]));
        return redirect()->route('gerentes');
    }

    /**
     * Display the specified resource.
     *
     * @param  SuperAdministrator  $superAdministrator
     * @return \Illuminate\Http\Response
     */
    public function getGerente(Gerente $gerente)
    {
        $data = [];
        $data["gerente"] = $gerente;
        $data["campuses"] = Campus::all();
        return view('gerentes.gerente', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function updateGerente(Request $request, Gerente $gerente)
    {
        validateData($request->all(), $this->editRules());

        $user = $gerente->user;

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $gerente->campus_id = $request->get('campus');

        DB::transaction(function () use ($request, $user, $gerente) {
            try {
                $gerente->save();
                $user->save();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('gerentes.error_edit_gerente'));
            }
        });
        Session::flash('flash_message', __('gerentes.success_edit_gerente'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  Gerente  $gerente
     * @return \Illuminate\Http\Response
     */
    public function deleteGerente(Request $request, Gerente $gerente)
    {
        DB::transaction(function () use ($request, $gerente) {
            try {
                $gerente->completeDeleteUser();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('gerentes.error_delete_gerente'));
            }
        });
        Session::flash('flash_message', __('gerentes.success_delete_gerente'));
        return redirect()->route('gerentes');
    }
}
