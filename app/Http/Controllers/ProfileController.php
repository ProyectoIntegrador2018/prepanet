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

class ProfileController extends Controller
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
     * Created an array that has the validations needed for editing the resource.
     *
     * @var array
     */
    public function editRules(){
        return [
            'password' => 'required|string',
            'confirm-password' => 'required|string|same:password',
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
        $data['user'] = Auth::user();
        return view('profile.profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {
        validateData($request->all(), $this->editRules());

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->password = bcrypt($request->get('password'));

        DB::transaction(function () use ($request, $user) {
            try {
                $user->save();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('profile.error_edit_user'));
            }
        });
        Session::flash('flash_message', __('profile.success_edit_user'));
        return back();
    }

}
