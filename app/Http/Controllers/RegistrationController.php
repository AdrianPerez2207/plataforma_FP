<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //---Sección API-----

    /**
     * We collect the data through the body and add a new registration.
     * @param Request $request
     */
    public function api_new_registration(Request $request){
        $course_id = $request->course_id;
        $student_id = $request->student_id;

        Registration::create([
            'course_id' => $course_id,
            'student_id' => $student_id,
        ]);
    }

    /**
     * We delete a registration that we receive through the URL.
     * @param Registration $registration
     */
    public function api_delete_registration(Registration $registration){
        $registration->delete();
    }

}
