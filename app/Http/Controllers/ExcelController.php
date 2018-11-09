<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use Excel;
use Carbon\Carbon;
use App\Models\Tetra;
use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\Users\Gerente;
use Illuminate\Validation\Rule;
use App\Models\Aplicaciones\Tutor;
use App\Models\Aplicaciones\Alumno;
use App\Models\Users\SuperAdministrator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
            $alumnos = [];
            foreach ($campus_instances as $campus) {
                array_push($alumnos, $campus->alumnos);
            }
            $last_alumnos = collect($alumnos)->collapse();
            $data['alumnos'] = $last_alumnos;
            // $gerentes = [];
            // foreach ($campus_instances as $campus) {
            //     array_push($gerentes, $campus->gerentes);
            // }
            // $last_gerentes = collect($gerentes)->collapse();
            // $data['gerentes'] = $last_gerentes;
            return view('reportes-alumnos.reportes', $data);
        }
        return back()->withErrors(__('reportes.error_campuses'));
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
            $tutores = [];
            foreach ($campus_instances as $campus) {
                array_push($tutores, $campus->tutores);
            }
            $last_tutores = collect($tutores)->collapse();
            $data['tutores'] = $last_tutores;
            // $gerentes = [];
            // foreach ($campus_instances as $campus) {
            //     array_push($gerentes, $campus->gerentes);
            // }
            // $last_gerentes = collect($gerentes)->collapse();
            // $data['gerentes'] = $last_gerentes;
            return view('reportes-tutores.reportes', $data);
        }
        return back()->withErrors(__('reportes.error_campuses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postAlumnosExcel(Request $request)
    {
        $data = [];
        if ($request->get('alumnos') != null){
            $alumnos = $request->get('alumnos');
            $alumnos_array = [];
            foreach ($alumnos as $id => $value){
                if($value == "on"){
                    array_push($alumnos_array, $id);
                }
            }
            $alumnos_instances = Alumno::find($alumnos_array);
            return Excel::download(new \App\Exports\AlumnosExport($alumnos_instances), 'alumnos.xlsx');
            // return new \App\Exports\AlumnosExport($alumnos_array);
            // $alumnos = [];
            // foreach ($alumnos_instances as $campus) {
            //     array_push($alumnos, $campus->alumnos);
            // }
            // $last_alumnos = collect($alumnos)->collapse();
            // $data['alumnos'] = $last_alumnos;
            // return view('reportes-alumnos.reportes', $data);
        }
        return back()->withErrors(__('reportes.error_alumnos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postTutoresExcel(Request $request)
    {
        $data = [];
        if ($request->get('tutores') != null){
            $tutores = $request->get('tutores');
            $tutores_array = [];
            foreach ($tutores as $id => $value){
                if($value == "on"){
                    array_push($tutores_array, $id);
                }
            }
            $tutores_instance = Tutor::find($tutores_array);
            Excel::create('Laravel Excel', function($excel) {

                $excel->sheet('Productos', function($sheet) {

                    $products = Product::all();

                    $sheet->fromArray($products);

                });
            })->export('xls');
            // $tutores = [];
            // foreach ($campus_instances as $campus) {
            //     array_push($tutores, $campus->tutores);
            // }
            // $last_tutores = collect($tutores)->collapse();
            // $data['tutores'] = $last_tutores;
            // return view('reportes-tutores.reportes', $data);
        }
        return back()->withErrors(__('reportes.error_campuses'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new \App\Exports\AlumnosExport(), 'alumnos.xlsx');
    }
}
