<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;
use App\Models\course;
use App\Models\enrollment;
use App\Models\schedule;
use App\Models\User;
use App\Models\grade;

class AdminController extends Controller
{
    /**
     * Summary of indexAdmin
     * @return \Illuminate\Contracts\View\View
     */
    public function indexAdmin(){
        return view('admin.dashboard');
    }

    public function indexMateria(){
        $materias = course::all();
        return view('admin.materias', compact('materias'));
    }

    public function indexGrupo(){
        $schedules = schedule::all();
        $groups = group::all();
        return view('admin.grupos', compact('schedules', 'groups'));
    }

    public function indexHorario(){
        $courses = course::all();
        $teachers = User::all();
        $horarios = schedule::all();
        return view('admin.horarios', compact('courses','teachers','horarios'));
    }

    public function saveMateria(Request $request){
        $nuevaMateria= new course();
        $nuevaMateria->name = $request->name;
        $nuevaMateria->code = $request->code;
        $nuevaMateria->save();
        return redirect()->back();
    }

    public function deleteMateria($id){
        $materiaEliminar = course::find($id);
        if ($materiaEliminar != null){
            $materiaEliminar->delete();
        }else{
            return redirect()->back()->withErrors('No se encontro la materia');
        }
        return redirect()->back();
    }
    public function editMateria($id){
        $materia = course::find($id);
        return view('admin.modificaMateria')->with('materia', $materia);
    }

    public function updateMateria(Request $request, $id){
        $materiaEditar = course::find($id);
        if ($materiaEditar != null){
            $materiaEditar->name = $request->name;
            $materiaEditar->code = $request->code;
            $materiaEditar->save();
        }else{
            return redirect()->back()->withErrors('No se encontro la materia');
        }
        return redirect('/materias');
    }

    public function saveHorario(Request $request){
        $nuevoHorario = new schedule();
        $nuevoHorario->start_time = $request->startTime;
        $nuevoHorario->end_time = $request->endTime;
        $nuevoHorario->course_id = $request->courseId;
        $nuevoHorario->teacher_id = $request->teacherId;
        $nuevoHorario->save();
        return redirect()->back();
    }

    public function deleteHorario($id){
        $horarioEliminar = schedule::find($id);
        if ($horarioEliminar != null){
            $horarioEliminar->delete();
        }else{
            return redirect()->back()->withErrors('No se encontro el horario');
        }
        return redirect()->back();
    }

    public function editHorario($id){
        $horario = schedule::find($id);
        $courses = course::all();
        $teachers = User::all();
        return view('admin.modificaHorario', compact('horario', 'courses', 'teachers'));
    }

    public function updateHorario(Request $request, $id){
        $horarioEditar = schedule::find($id);
        if ($horarioEditar != null){
            $horarioEditar->start_time = $request->startTime;
            $horarioEditar->end_time = $request->endTime;
            $horarioEditar->course_id = $request->courseId;
            $horarioEditar->teacher_id = $request->teacherId;
            $horarioEditar->save();
        }else{
            return redirect()->back()->withErrors('No se encontro el horario');
        }
        return redirect('/horarios');
    }

    public function saveGrupo(Request $request){
        $nuevoGrupo= new group();
        $nuevoGrupo->name = $request->name;
        $nuevoGrupo->schedule_id = $request->scheduleId;
        $nuevoGrupo->save();
        return redirect()->back();
    }

    public function deleteGrupo($id){
        $grupoEliminar = group::find($id);
        if ($grupoEliminar != null){
            $grupoEliminar->delete();
        }else{
            return redirect()->back()->withErrors('No se encontro el grupo');
        }
        return redirect()->back();
    }
    public function editGrupo($id){
        $grupo = group::find($id);
        $schedules = schedule::all();
        return view('admin.modificaGrupo',compact('grupo', 'schedules'));
    }

    public function updateGrupo(Request $request, $id){
        $grupoEditar = group::find($id);
        if ($grupoEditar != null){
            $grupoEditar->name = $request->name;
            $grupoEditar->schedule_id = $request->scheduleId;
            $grupoEditar->save();
        }else{
            return redirect()->back()->withErrors('No se encontro el grupo');
        }
        return redirect('/grupos');
    }
}
