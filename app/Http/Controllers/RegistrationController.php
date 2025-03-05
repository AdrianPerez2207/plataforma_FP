<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Pest\Laravel\delete;

class RegistrationController extends Controller
{

    /**
     * Creamos una nueva inscripción recogiendo los datos del formulario y validando que el usuario no esté inscrito
     * @param Request $request
     */
    public function store(Request $request)
    {
        //Validamos los datos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);
        $user_id = $request->user_id;
        $course_id = $request->course_id;

        //Verificamos si el usuario ya tiene una inscripción
        if (Registration::where('student_id', $user_id)->where('course_id', $course_id)->exists()){
            return redirect()->back()->withErrors(['error-msg' => 'Ya estás inscrito en este curso']);
        }
        //Creamos la inscripción
        Registration::create([
            'student_id' => $user_id,
            'course_id' => $course_id,
        ]);
        return redirect()->route('welcome')->with('msg', 'Inscripción exitosa');
    }

    /**
     * Cancelamos una inscripción recogiendo los datos del formulario y validando que el usuario esté inscrito previamente
     * @param Request $request
     */
    public function update(Request $request)
    {
        //Validamos los datos
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);
        $user_id = $request->user_id;
        $course_id = $request->course_id;

        //Verificamos si el usuario está inscrito
        $registration = Registration::where('student_id', $user_id)->where('course_id', $course_id)->first();
        if ($registration !== null){
            //Actualizamos la inscripción
            $registration->status = 'cancelled';
            $registration->save();
            return redirect()->route('welcome')->with('msg', 'Inscripción cancelada');
        } else {
            return redirect()->route('welcome')->withErrors(['error-msg' => 'No estás inscrito en este curso']);
        }
    }


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

        $registration->status = 'rejected';

        if ($registration->update()){
            return response()->json($registration);
        } else {
            return response()->json(['msg' => 'Registration not rejected'], 400);
        }
    }

}
