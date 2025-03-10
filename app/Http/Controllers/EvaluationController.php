<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Evaluation;
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
}
