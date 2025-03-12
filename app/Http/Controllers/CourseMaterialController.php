<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Course_Material;
use Illuminate\Http\Request;

class CourseMaterialController extends Controller
{
    public function index(Course $course)
    {
        return view('admin.newMaterial', compact('course'));
    }

    /**
     * Creamos un nuevo material para un curso en específico.
     * @param Request $request
     * @param Course $course
     */
    public function create(Request $request, Course $course)
    {
        $request->validate([
            'type' => 'required',
            'url' => 'required',
        ]);

        $material = Course_Material::create([
            'type' => $request->type,
            'url' => $request->url,
            'course_id' => $course->id,
        ]);
        if ($material != null){
            return redirect()->route('dashboard', $course)->with('msg', 'Material creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al insertar materiales']);
        }
    }


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
