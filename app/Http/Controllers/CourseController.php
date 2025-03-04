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
        $courses = Course::paginate(16);

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
