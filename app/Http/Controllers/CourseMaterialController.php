<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_Material;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    /**
     * Buscamos los materiales de un curso en específico, si no encontramos materiales,
     * redirigimos al usuario a la página dónde estaba con un mensaje de error.
     * Ordenamos los materiales por tipo.
     * @param Course $course
     */
    public function materialByCourse(Course $course)
    {
        $materials = Course_Material::query()->where('course_id', $course->id)->orderBy('type')->get();

        if ($materials->count() == 0){
            return redirect()->back()->withErrors(['error-msg' => 'No hay materiales para este curso']);
        } else {
            return view('user.materials', compact('materials', 'course'));
        }
    }
}
