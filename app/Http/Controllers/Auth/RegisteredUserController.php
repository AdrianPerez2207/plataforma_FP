<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dni' => 'required|unique:users|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'email' => 'required|unique:users|max:255',
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
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user != null){
            event(new Registered($user));

            Auth::login($user);

            return redirect(route('welcome', absolute: false))->with('msg', 'Usuario creado correctamente');
        } else {
            return redirect()->back()->withErrors(['error-msg' => 'Error al crear el usuario']);
        }
    }
}
