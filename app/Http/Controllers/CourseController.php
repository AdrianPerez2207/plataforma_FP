<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(22);

        return view('welcome', compact('courses'));
    }

    public function dashboardIndex()
    {
        $courses = Course::paginate(10);
        return view('admin.dashboard', compact('courses'));
    }

    public function studentCourses(Request $request)
    {
        $user = $request->user();
        $courses = Course::query()->where('status', 'active')
            ->whereHas('registrations', fn($query) => $query->where('student_id', $user->id)->where('status', 'approved'))
            ->paginate(16);


        return view('user.myCourses', compact('courses'));
    }

    /**
     * Llevamos a la página de creación de cursos y le damos la lista de profesores
     * @param Request $request
     */
    public function newCourse(Request $request)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.newCourse', compact('teachers'));

    }

    /**
     * Creamos un nuevo curso, comprobamos los datos que nos llegan de la request y si es correcto, creamos el curso
     * @param Request $request
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
        ]);
        //Verificamos si ya existe un curso con el mismo nombre
        if (Course::where('name', $request->name)->exists()){
            return redirect()->back()->withErrors(['error-msg' => 'Ya existe un curso con ese nombre']);
        }
        //Creamos el curso
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'duration' => $request->duration,
            'teacher_id' => $request->teacher_id,
        ]);
        if ($course != null){
            return redirect()->route('dashboard')->with('msg', 'Curso creado correctamente');
        } else {
            return redirect()->back()->withErrors(['error-msg' => 'Error al crear el curso']);
        }
    }

    /**
     * Buscamos los cursos que cumplan con los criterios de búsqueda.
     * Devolvemos en la misma vista de los cursos, pero ahora filtrados por los criterios de búsqueda.
     * @param Request $request
     */
    public function search(Request $request)
    {
        $courses = Course::query()->where('name', 'like', '%'.$request->nombre.'%')
            ->where('category', 'like', '%'.$request->categoria.'%')
            ->where('duration', '>=', '%'.$request->duracion.'%')
            ->where('status', 'active')
            ->paginate(16);

        return view('welcome', ['courses' => $courses]);
    }

    /**
     * Buscamos todos los cursos que coincidan con los datos que le pasamos y con el usuario que está logeado.
     * @param Request $request
     */
    public function mySearch(Request $request)
    {
        $user = $request->user();
        $courses = Course::query()->where('name', 'like', '%'.$request->nombre.'%')
            ->where('category', 'like', '%'.$request->categoria.'%')
            ->where('duration', '>=', '%'.$request->duracion.'%')
            ->where('status', 'active')
            ->whereHas('registrations', fn($query) => $query->where('student_id', $user->id)->where('status', 'approved'))
            ->paginate(16);

        return view('myCourses', ['courses' => $courses ]);
    }

    public function modify(Request $request, $id)
    {
        $course = Course::where('id', $id)->first();
        $teachers = User::where('role', 'teacher')
            ->where('id', '!=', $course->teacher_id)
            ->get();
        return view('admin.modifyCourse', compact('course', 'teachers'));
    }

    public function update(Request $request)
    {

    }




    //----Sección API----
    public function api_index(){
        $courses = Course::paginate(10);

        return CourseResource::collection($courses);
    }
    public function api_show($id){
        $course = Course::find($id);
        return CourseResource::make($course);
    }

    /**
     * We collect the data through the body and add a new course.
     * We check the teacher's ID that we receive and verify that they are a teacher.
     * @param Request $request
     */
    public function api_new_course(Request $request){
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $duration = $request->duration;
        $teacher_id = $request->teacher_id;

        $user = User::where('id', $teacher_id)->where('role', 'teacher')->first();
        if ($user != null){
            Course::create([
                'name' => $name,
                'description' => $description,
                'category' => $category,
                'duration' => $duration,
                'teacher_id' => $teacher_id,
            ]);
        } else{
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * We delete a course and all its enrollments; this action can only be performed by an administrator.
     * @param Course $course
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function api_delete_course(Course $course, Request $request){
        if ($request->user()->role === 'admin'){
            if ($course->delete()){
                return response()->json(['msg' => 'Course deleted']);
            } else {
                return response()->json(['msg' => 'Course not deleted'], 400);
            }
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
