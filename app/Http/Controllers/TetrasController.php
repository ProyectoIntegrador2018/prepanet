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
use App\Models\Users\SuperAdministrator;

class TetrasController extends Controller
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
            'identifier' => 'required|string',
            'year' => 'required|string',
            'type' => 'required|integer|in:0,1,2',
            'goal' => 'required|integer',
            'campus' => 'required|exists:campuses,id'
        ];
    }

    /**
     * Created an array that has the validations needed for editing the resource.
     *
     * @var array
     */
    public function editRules($campusName, $campusCode){
        return [
            'identifier' => 'required|string',
            'year' => 'required|string',
            'type' => 'required|integer|in:0,1,2',
            'goal' => 'required|integer',
            'campus' => 'required|exists:campuses,id'
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
        $data['tetras'] = null;
        $data['campuses'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['tetras'] = Tetra::all();
                $data['campuses'] = Campus::all();
                break;
            case $userable instanceof Gerente:
                $campus = $userable->campus;
                $data['campuses'] = $campus;
                $data['tetras'] = Tetra::where('campus_id', $campus->id);
                break;
            default:
                break;
        }
        return view('tetras.tetras', $data);
    }

    public function postTetra(Request $request)
    {
        // $this->authorize('create', Company::class);
        validateData($request->all(), $this->createRules());

        try {
            $tetra = Tetra::create([
                'identifier' => $request->get('identifier'),
                'type' => $request->get('type'),
                'goal' => $request->get('goal'),
                'year' => $request->get('year'),
                'campus_id' => $request->get('campus'),
            ]);
        } catch (\Exception $e) {
            app()->make("lern")->record($e);
            return back()->withErrors(__('tetras.error_add_tetra'));
        }
        Session::flash('flash_message', __("tetras.new_tetra_created", ["tetra" => $tetra->identifier]));
        return redirect()->route('tetras');
    }

    /**
     * Display the specified resource.
     *
     * @param  Carrier  $company
     * @return \Illuminate\Http\Response
     */
    public function getTetra(Tetra $tetra)
    {
        // $this->authorize('view', $campus);

        $data = [];
        $userable = Auth::user()->userable;
        $data["tetra"] = $tetra;
        $data['campuses'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['campuses'] = Campus::all();
                break;
            case $userable instanceof Gerente:
                $campus = $userable->campus;
                $data['campuses'] = $campus;
                break;
            default:
                break;
        }
        return view('tetras.tetra', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     * @param  Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function updateTetra(Request $request, Tetra $tetra)
    {
        validateData($request->all(), $this->editRules());

        $tetra->identifier = $request->get('identifier');
        $tetra->type = $request->get('type');
        $tetra->goal = $request->get('goal');
        $tetra->year = $request->get('year');
        $tetra->campus_id = $request->get('campus');
        DB::transaction(function () use ($request, $tetra) {
            try {
                $tetra->save();
            } catch (\Exception $e) {
                app()->make("lern")->record($e);
                return back()->withErrors(__('tetras.error_edit_tetra'));
            }
        });
        Session::flash('flash_message', __('tetras.success_edit_tetra'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  Carrier  $carrier
     * @return \Illuminate\Http\Response
     */
    public function deleteTetra(Request $request, Tetra $tetra)
    {
        if ($tetra->isDeletable()) {
            DB::transaction(function () use ($request, $tetra) {
                try {
                    $tetra->delete();
                } catch (\Exception $e) {
                    app()->make("lern")->record($e);
                    return back()->withErrors(__('tetras.error_delete_tetra'));
                }
            });
            Session::flash('flash_message', __('tetras.success_delete_tetra'));
            return redirect()->route('tetras');
        } else {
            return back()->withErrors(__('tetras.error_delete_tetra'));
        }
    }
}
