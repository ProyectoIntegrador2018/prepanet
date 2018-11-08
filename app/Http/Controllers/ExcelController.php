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
    public function indexTutores()
    {
        $data = [];
        $userable = Auth::user()->userable;
        $data['alumnos'] = null;
        $data['gerentes'] = null;
        $data['tetras'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['alumnos'] = Alumno::all();
                $data['gerentes'] = Gerente::all();
                $data['tetras'] = Tetra::all();
                break;
            case $userable instanceof Gerente:
                $data['alumnos'] = Alumno::where('gerente_id', $userable->id)->get();
                $data['gerentes'] = Gerente::where('id', $userable->id)->get();
                $campus = $userable->campus;
                $data['tetras'] = Tetra::where('campus_id', $campus->id)->get();
                break;
            default:
                break;
        }
        return view('alumnos.alumnos', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAlumnos()
    {
        $data = [];
        $userable = Auth::user()->userable;
        $data['alumnos'] = null;
        $data['gerentes'] = null;
        $data['tetras'] = null;
        switch (true) {
            case $userable instanceof SuperAdministrator:
                $data['alumnos'] = Alumno::all();
                $data['gerentes'] = Gerente::all();
                $data['tetras'] = Tetra::all();
                break;
            case $userable instanceof Gerente:
                $data['alumnos'] = Alumno::where('gerente_id', $userable->id)->get();
                $data['gerentes'] = Gerente::where('id', $userable->id)->get();
                $campus = $userable->campus;
                $data['tetras'] = Tetra::where('campus_id', $campus->id)->get();
                break;
            default:
                break;
        }
        return view('alumnos.alumnos', $data);
    }
}
