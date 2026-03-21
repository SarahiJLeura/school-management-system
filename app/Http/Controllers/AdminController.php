<?php

namespace App\Http\Controllers;

use App\Models\group;
use Illuminate\Http\Request;
use App\Models\course;
use App\Models\enrollment;
use App\Models\schedule;
use App\Models\User;
use App\Models\grade;

/**
 * Controller for Administrator where he can implement a CRUD (Create, Read, Update, Delete) with all modules.
 * There are 5 kind of functions:
 * - index -> returns module page
 * - save -> inserts into database the respective data
 * - edit -> displays another module with the information that will be updated
 * - update -> updates into database the respective information
 * - delete -> deletes the selected item into database
 */
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
        $nuevoHorario->days = implode(',', $request->days);
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
            $horarioEditar->days = implode(',', $request->days);
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

    /**
     * *
     * * *
     * * * * CALIFICACIONES
     * * *
     * *
     */

    public function indexCalificacion(Request $request){
        $groups = group::with('schedule.course', 'schedule.teacher')->get();
        $groupId = $request->group_filter;
        $enrollments = collect();
        if ($groupId) {
            // Traer inscripciones del grupo seleccionado
            $enrollments = Enrollment::with('user', 'group.schedule.course')
                ->where('group_id', $groupId)
                ->get();
        }
        return view('admin.calificaciones', compact('groups', 'enrollments', 'groupId'));
    }

    public function saveCalificacion(Request $request){
        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'grade' => 'required|numeric|min:0|max:100',
        ]);
        grade::create([
            'enrollment_id' => $request->enrollment_id,
            'grade' => $request->grade,
        ]);
        return redirect()->back()->with('success', 'Calificación guardada correctamente');
    }

    public function deleteCalificacion($id){
        $gradeDelete = grade::find($id);
        if ($gradeDelete != null){
            $gradeDelete->delete();
        }else{
            return redirect()->back()->withErrors('No se encontro la calificacion');
        }
        return redirect()->back();
    }

    public function editCalificacion($id){
        $gradeEdit = Grade::with('enrollment.user', 'enrollment.group.schedule.course')->findOrFail($id);
        $groups = Group::with('schedule.course', 'schedule.teacher')->get();
        return view('admin.modificaCalificacion', compact('gradeEdit', 'groups'));
    }

    public function updateCalificacion(Request $request, $id){
        $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
        ]);
        $gradeEdit = grade::find($id);
        if ($gradeEdit != null){
            $gradeEdit->grade = $request->grade;
            $gradeEdit->save();
        }else{
            return redirect()->back()->withErrors('No se encontro la calificacion');
        }
        return redirect()->route('index.calificaciones')->with('success', 'Calificación actualizada');
    }

    /**
     * *
     * * *
     * * * * INSCRIPCIONES
     * * *
     * *
     */

    public function indexInscripciones(Request $request){
        $groups = group::with('schedule.course', 'schedule.teacher')->get();
        // grupo seleccionado
        $groupId = $request->group_filter;
        //usuarios solo si hay un grupo seleccionado
        if ($groupId) {
            $users = User::whereDoesntHave('enrollments', function ($query) use ($groupId) {
                $query->where('group_id', $groupId);
            })->get();
        } else {
            $users = collect();
        }
        // inscripciones para tabla
        $enrollments = enrollment::with('user', 'group.schedule.course', 'group.schedule.teacher');
        if ($groupId) {
            $enrollments->where('group_id', $groupId);
        }
        $enrollments = $enrollments->get();
        return view('admin.inscripciones', compact('groups', 'users', 'enrollments', 'groupId'));
    }

    public function saveInscripcion(Request $request){
        $newEnrollment = new enrollment();
        $newEnrollment->user_id = $request->user_id;
        $newEnrollment->group_id = $request->group_id;
        $newEnrollment->save();
        return redirect()->back();
    }

    public function deleteInscripcion($idx){
        $enrollDelete = enrollment::find($idx);
        if ($enrollDelete != null){
            $enrollDelete->delete();
        }else{
            return redirect()->back()->withErrors('No se encontro la inscripcion');
        }
        return redirect()->back();
    }

    public function editInscripcion($id){
        $enrollEdit = enrollment::with('group.schedule.course', 'group.schedule.teacher')
            ->findOrFail($id);

        $groups = group::with('schedule.course', 'schedule.teacher')->get();

        // usuarios disponibles + el actual
        $users = User::where(function ($query) use ($enrollEdit) {
            $query->whereDoesntHave('enrollments', function ($q) use ($enrollEdit) {
                $q->where('group_id', $enrollEdit->group_id);
            })
            ->orWhere('id', $enrollEdit->user_id);
        })->get();

        return view('admin.modificaInscripcion', compact('enrollEdit', 'groups', 'users'));
    }

    public function updateInscripcion(Request $request, $id){
        $enrollEdit = enrollment::find($id);
        if ($enrollEdit != null){
            $enrollEdit->user_id = $request->user_id;
            $enrollEdit->group_id = $request->group_id;
            $enrollEdit->save();
        }else{
            return redirect()->back()->withErrors('No se encontro la calificacion');
        }
        return redirect('/inscripciones');
    }
}