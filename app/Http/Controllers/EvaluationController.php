<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Evaluation;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    /**
     * Sacamos todas las evaluaciones y las mostramos en la vista de dashboardEvaluations.
     * Si el usuario es un administrador, muestra todas las evaluaciones.
     * Si el usuario es un profesor, muestra las evaluaciones de los cursos que pertenece.
     */
    public function dashboardEvaluations(Request $request)
    {
        if ($request->user()->role == 'admin') {
            $evaluations = Evaluation::query()->orderBy('created_at', 'asc')->paginate(10);

            if ($evaluations){
                return view('admin.dashboardEvaluations', compact('evaluations'));
            } else {
                return back()->withErrors(['error-msg' => 'No hay evaluaciones']);
            }
        } else{
            $courses = Course::where('teacher_id', $request->user()->id)->pluck('id');

            if ($courses->isEmpty()) {
                return back()->withErrors(['error-msg' => 'No tienes cursos asignados']);
            }

            $evaluations = Evaluation::whereIn('course_id', $courses)
                ->orderBy('created_at', 'asc')
                ->paginate(10);

            return view('admin.dashboardEvaluations', compact('evaluations'));
        }

    }

    /**
     * Redirigimos a la vista para evaluar a un alumno, le pasamos la inscripción y de ahí sacamos el curso y el alumno.
     * @param Registration $registration
     */
    public function newEvaluation(Registration $registration)
    {
        return view('admin.newEvaluation', compact('registration'));
    }
    public function create(Request $request, Registration $registration){
        $request->validate([
            'final_score' => 'required',
            'comment' => 'required'
        ]);

        $evaluation = Evaluation::create([
            'final_score' => $request->final_score,
            'comment' => $request->comment,
            'course_id' => $registration->course_id,
            'student_id' => $registration->student_id,
        ]);

        if ($evaluation != null){
            return redirect()->route('dashboardEvaluations', [Auth::user()])->with('msg', 'Evaluación creada');
        } else {
            return redirect()->back()->withErrors(['error-msg' => 'Error al crear la evaluación']);
        }
    }
}
