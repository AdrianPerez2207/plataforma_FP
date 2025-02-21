<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //----Sección API----
    public function api_index(){
        $courses = Course::paginate(10);

        return CourseResource::collection($courses);
    }
    public function api_show($id){
        $course = Course::find($id);
        return CourseResource::make($course);
    }
}
