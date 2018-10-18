<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Users\Gerente;
use Illuminate\Validation\Rule;
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
            'name' => 'required|string|unique:campuses,name|between:3,100',
            'code' => 'required|string|unique:campuses,code|size:3',
        ];
    }

    /**
     * Created an array that has the validations needed for editing the resource.
     *
     * @var array
     */
    public function editRules($campusName, $campusCode){
        return [
            'name' => [
                'required',
                'string',
                'between:3,100',
                Rule::unique('campuses')->ignore($campusName, 'name'),
            ],
            'code' => [
                'required',
                'string',
                'size:3',
                Rule::unique('campuses')->ignore($campusCode, 'code'),
            ],
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

    public function postCampus(Request $request)
    {
        // $this->authorize('create', Company::class);
        validateData($request->all(), $this->createRules());
        // dd($request);
        try {
            $campus = Campus::create([
                'name' => $request->get('name'),
                'code' => $request->get('code'),
            ]);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('campuses.error_add_campus'));
        }
        Session::flash('flash_message', __("campuses.new_campus_created", ["campus" => $campus->name]));
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
        // $this->authorize('view', $campus);

        $data = [];
        $data["campus"] = $campus;
        return view('campuses.campus', $data);
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
        validateData($request->all(), $this->editRules($campus->name, $campus->code));
        $campus->name = $request->get('name');
        $campus->code = $request->get('code');
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
