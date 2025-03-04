<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegistrationResource;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{



    //----Sección API----
    public function api_user_registrations($dni){
        $user = User::where('dni', $dni);
        $registration = Registration::where('student_id', $user->id);
        return RegistrationResource::collection($registration);
    }
}
