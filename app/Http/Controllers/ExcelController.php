<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Carbon\Carbon;
use App\Models\Tetra;
use App\Models\Campus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Models\Users\Gerente;
use Illuminate\Validation\Rule;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use App\Models\Users\SuperAdministrator;

class ExcelController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAlumno()
    {
        $data = [];
        $userable = Auth::user()->userable;
        $data['campuses'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['campuses'] = Campus::all();
                break;
            case $userable instanceof Gerente:
                $data['campuses'] = Campus::where('id', $userable->campus->id)->get();
                break;
            default:
                break;
        }
        return view('reportes-alumnos.campus', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTutor()
    {
        $data = [];
        $userable = Auth::user()->userable;
        $data['campuses'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['campuses'] = Campus::all();
                break;
            case $userable instanceof Gerente:
                $data['campuses'] = Campus::where('id', $userable->campus->id)->get();
                break;
            default:
                break;
        }
        return view('reportes-tutores.campus', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postAlumnos(Request $request)
    {
        $data = [];
        if ($request->get('campuses') != null){
            $campuses = $request->get('campuses');
            $campus_array = [];
            foreach ($campuses as $id => $value){
                if($value == "on"){
                    array_push($campus_array, $id);
                }
            }
            $campus_instances = Campus::find($campus_array);
            $data['campuses'] = $campus_array;
            return view('reportes-alumnos.reportes', $data);
        }
        return back()->withErrors(__('alumnos.error_add_alumno'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postTutores(Request $request)
    {
        $data = [];
        if ($request->get('campuses') != null){
            $campuses = $request->get('campuses');
            $campus_array = [];
            foreach ($campuses as $id => $value){
                if($value == "on"){
                    array_push($campus_array, $id);
                }
            }
            $campus_instances = Campus::find($campus_array);
            $data['campuses'] = $campus_array;
            return view('reportes-tutores.reportes', $data);
        }
        return back()->withErrors(__('alumnos.error_add_alumno'));
    }
}
