<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Users\Gerente;
use App\Models\Users\SuperAdministrator;

class CampusesController extends Controller
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
            'name' => 'required|string|between:3,100',
            'address' => 'required|string|between:5,50',
        ];
    }

    /**
     * Created an array that has the validations needed for editing the resource.
     *
     * @var array
     */
    public function editRules(){
        return [
            'name' => 'required|string|between:3,100',
            'address' => 'required|string|between:5,50',
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
        $data['campuses'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['campuses'] = Campus::all();
                break;
            default:
                break;
        }
        return view('campuses.campuses', $data);
    }

    /**
     * Show the form for creating a new carrier.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCreateCampus()
    {
        // $this->authorize('create', Carrier::class);

        $userable = Auth::user()->userable;

        switch (true) {
            case $userable instanceof SuperAdministrator:
                break;
            case $userable instanceof Employee:
            default:
                break;
        }
        return view('campuses.campus-create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateCampus(Request $request)
    {
        // $this->authorize('create', Carrier:class);

        validateData($request->all(), $this->createRules(), $this->createErrorMessages());

        try {
            $campus = Campus::create([
                'name' => $request->get('name'),
                'address' => $request->get('address'),
            ]);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('campuses.error_edit_room'));
        }
        Session::flash('flash_message', __('campuses.success_edit_room'));
        return redirect()->route('campuses');
    }

    /**
     * Display the specified resource.
     *
     * @param  Carrier  $company
     * @return \Illuminate\Http\Response
     */
    public function getCampus(Campus $campus)
    {
        $this->authorize('view', $campus);

        $data = [];
        $data["campus"] = $campus;
        return view('', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function postEditCampus(Request $request, Campus $campus)
    {
        // $this->authorize('update', $carrier);

        validateData($request->all(), $this->createRules());
        try {
            $campus->name = $request->get('name');
            $campus->address = $request->get('address');
            $campus->save();
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('campuses.error_edit_room'));
        }
        Session::flash('flash_message', __('campuses.success_edit_room'));
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
        // $this->authorize('delete', $campus);

        if ($campus->isDeletable()) {
            try {
                $campus->delete();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('campuses.error_edit_room'));
            }
            Session::flash('flash_message', __('campuses.success_edit_room'));
            return redirect()->route('campuses');
        } else {
            app()->make("lern")->record($e);
            return back()->withErrors(__('campuses.error_edit_room'));
        }
    }
}
