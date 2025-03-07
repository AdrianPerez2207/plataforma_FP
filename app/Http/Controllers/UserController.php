<?php

namespace App\Http\Controllers;

use App\Http\Resources\RegistrationResource;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function dashboardUser()
    {
        $users = User::query()->orderBy('role', 'asc')->paginate(10);

        return view('admin.dashboardUser', compact('users'));
    }

    /**
     * Para eliminar un usuario, primero se debe asegurarse de que no existan registros pendientes asociados.
     * Si no existe, se elimina el usuario.
     * @param User $user
     */
    public function destroy(User $user)
    {
        $registrations = Registration::where('student_id', $user->id)->where('status', 'approved')->first();
        if ($registrations) {
            return redirect()->back()->withErrors(['error-msg' => 'El usuario tiene registros asociados']);
        } else {
            $user->delete();
            return redirect()->route('dashboardUser')->with('msg', 'Usuario eliminado correctamente');
        }

    }

    /**
     * Redirigimos a la página de creación de usuarios.
     */
    public function newUser()
    {
        return view('admin.newUser');
    }

    /**
     * Creamos un nuevo usuario, comprobamos los datos que nos llegan de la request y si es correcto, creamos el usuario.
     * @param Request $request
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'password_confirmation' => 'required|string|max:255',
        ]);
        //Verificamos si ya existe un usuario con ese DNI
        if (User::where('dni', $request->dni)->exists()){
            return redirect()->back()->withErrors(['error-msg' => 'Ya existe un usuario con ese DNI']);
        }
        //Creamos el usuario
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'dni' => $request->dni,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'country' => $request->country,
            'specialty' => $request->specialty,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user != null){
            return redirect()->route('dashboardUser')->with('msg', 'Usuario creado correctamente');
        } else {
            return redirect()->back()->withErrors(['error-msg' => 'Error al crear el usuario']);
        }
    }


    //----Sección API----
    public function api_user_registrations($dni){
        $user = User::where('dni', $dni);
        $registration = Registration::where('student_id', $user->id);
        return RegistrationResource::collection($registration);
    }
}
