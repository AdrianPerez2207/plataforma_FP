<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationEmail;
use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    /**
     * Sacamos todas las inscripciones de un usuario y las mostramos en la vista de inscripciones.
     * Comprobamos si el usuario es un administrador o un profesor y muestra las inscripciones de los cursos que pertenecen a él.
     * @param Request $request
     */
    public function dashboardRegistration(Request $request){
        if ($request->user()->role === 'admin'){
            $registrations = Registration::query()->orderBy('status', 'asc')->paginate(22);
            if ($registrations){
                return view('admin.dashboardRegistration', compact('registrations'));
            } else {
                return back()->withErrors(['error-msg' => 'No hay inscripciones']);
            }
        } else {
            // Obtener los cursos del profesor y con pluck obtenemos solo las columnas de los IDs
            $courses = Course::where('teacher_id', $request->user()->id)->pluck('id');

            if ($courses->isEmpty()) {
                return back()->withErrors(['error-msg' => 'No tienes cursos asignados']);
            }

            // Obtener las inscripciones de los cursos del profesor
            $registrations = Registration::whereIn('course_id', $courses)
                ->orderBy('status', 'asc')
                ->paginate(22);

            return view('admin.dashboardRegistration', compact('registrations'));
        }
    }

    /**
     * Cambiamos el estado de una inscripción de pendiente a aprobada.
     * @param Registration $registration
     */
    public function change(Registration $registration){

        $registration = Registration::where('id', $registration->id)->first();
        if ($registration->status == 'pending' || $registration->status == 'cancelled'){
            $registration->status = 'approved';
            if ($registration->update()){
                //Mandamos un email de confirmación
                Mail::to($registration->user->email)->send(new ConfirmationEmail($registration));
                return redirect()->route('dashboardRegistration', ['user' => Auth::user()])->with('msg', 'Inscripción cambiada');
            } else {
                return redirect()->back()->withErrors(['error-msg' => 'Error al cambiar la inscripción']);
            }
        } else {
            return redirect()->back()->withErrors(['error-msg' => 'La inscripción ya ha sido aprobada']);
        }
    }

    /**
     * Cambiamos el estado de una inscripción de aprobada a cancelada.
     * @param Registration $registration
     */
    public function cancelled(Registration $registration){

        $registration = Registration::where('id', $registration->id)->first();
        if ($registration->status == 'approved'){
            $registration->status = 'cancelled';
            if ($registration->update()){
                return redirect()->route('dashboardRegistration', ['user' => Auth::user()])->with('msg', 'Inscripción cancelada');
            } else {
                return redirect()->back()->withErrors(['error-msg' => 'Error al cambiar la inscripción']);
            }
        } else {
            return redirect()->back()->withErrors(['error-msg' => 'La inscripción ya ha sido cancelada']);
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
