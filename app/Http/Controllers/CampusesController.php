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
            'phone' => 'required|string|between:8,20',
            'city' => 'required|string|between:3,20',
            'state' => 'required|string|between:3,20',
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
            'phone' => 'required|string|between:8,20',
            'city' => 'required|string|between:3,20',
            'state' => 'required|string|between:3,20',
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
        return view('campuses.campus', $data);
    }

    /**
     * Show the form for creating a new carrier.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCreateCarrier()
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
        return view('carriers.carrier-create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postCreateCarrier(Request $request)
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
            flash()->error(__('common.oops!'), __("campuses.error_add"));
            return back();
        }
        flash()->success(__('common.success!'), __("campuses.successful_add", ["campus" => $campus->name]));

        $createMore = $request->get('create_more') ? true : false;
        return $createMore? redirect()->route('create-campus') : redirect()->route('campuses');
    }

    /**
     * Display the specified resource.
     *
     * @param  Carrier  $company
     * @return \Illuminate\Http\Response
     */
    public function getCarrier(Campus $campus)
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
    public function postEditCarrier(Request $request, Campus $campus)
    {
        // $this->authorize('update', $carrier);

        validateData($request->all(), $this->createRules());
        try {
            $campus->name = $request->get('name');
            $campus->address = $request->get('address');
            $campus->save();
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            flash()->error(__('common.oops!'), __("campuses.error_edit"));
            return back();
        }
        flash()->success(__('common.success!'), __("campuses.successful_edit", ["campus" => $campus->name]));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function postDeleteCarrier(Request $request, Campus $campus)
    {
        // $this->authorize('delete', $campus);

        if ($campus->isDeletable()) {
            try {
                $campus->delete();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                flash()->error(__('common.oops!'), __("campuses.error_delete"));
                return back();
            }
            flash()->success(__('common.success!'), __("campuses.successful_delete", ["campus" => $campus->name]));
            return redirect()->route('campuses');
        } else {
            flash()->error(__('common.oops!'), __("campuses.error_users"));
            return back();
        }
    }
}
