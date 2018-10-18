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
        ];
    }

    /**
     * Created an array that has the validations needed for editing the resource.
     *
     * @var array
     */
    public function editRules(){
        return [
            'email' => 'email|max:255|unique:users|filled|required|',
            'password' => 'required|string',
            'confirm-password' => 'required|string',
            'first_name' => 'required|string|between:3,50',
            'last_name' => 'required|string|between:3,50',
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

    public function postSuperAdministrator(Request $request)
    {
        // $this->authorize('create', Company::class);
        validateData($request->all(), $this->createRules());

        if($request->get('password') != $request->get('confirm-password'))
        {
            return back()->withErrors(__('super-administrators.error_not_same_password'));
        }

        try {
            $superAdmin = SuperAdministrator::create();
            $mainUser = new User(
                [
                    "first_name" => $request->get('first_name'),
                    "last_name" => $request->get('last_name'),
                    "password" => bcrypt($request->get('password')),
                    "email" => $request->get('email'),
                ]
            );
            $mainUser = $superAdmin->user()->save($mainUser);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('super-administrators.error_add_super_administrator'));
        }
        Session::flash('flash_message', __("super-administrators.new_super_administrator_created", ["superAdmin" => $superAdmin->user->first_name]));
        return redirect()->route('super-administrators');
    }

    /**
     * Display the specified resource.
     *
     * @param  SuperAdministrator  $superAdministrator
     * @return \Illuminate\Http\Response
     */
    public function getSuperAdministrator(SuperAdministrator $superAdministrator)
    {
        $data = [];
        $data["superAdmin"] = $superAdministrator;
        dd('aqui');
        return view('admins.admin', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function postEditCampus(Request $request, Campus $campus)
    {
        validateData($request->all(), $this->editRules());
        $campus->name = $request->get('name');
        $campus->address = $request->get('address');
        DB::transaction(function () use ($request, $campus) {
            try {
                $campus->save();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('campuses.error_edit_campus'));
            }
        });
        Session::flash('flash_message', __('campuses.success_edit_campus'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function postDeleteCampus(Request $request, Campus $campus)
    {
        if ($campus->isDeletable()) {
            DB::transaction(function () use ($request, $campus) {
                try {
                    $campus->delete();
                } catch (\Exception $e) {
                    app()->make("lern")->record($e);
                    return back()->withErrors(__('campuses.error_delete_campus'));
                }
            });
            Session::flash('flash_message', __('campuses.success_delete_campus'));
            return redirect()->route('campuses');
        } else {
            return back()->withErrors(__('campuses.error_delete_campus'));
        }
    }
}
