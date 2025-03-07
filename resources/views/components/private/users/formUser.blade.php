

<form method="POST" action="{{ route('user.create') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Nombre')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Apellidos -->
    <div class="mt-4">
        <x-input-label for="last_name" :value="__('Apellidos')" />
        <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
    </div>

    <!-- DNI -->
    <div class="mt-4">
        <x-input-label for="dni" :value="__('DNI')" />
        <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" required autofocus autocomplete="dni" />
        <x-input-error :messages="$errors->get('dni')" class="mt-2" />
    </div>

    <!-- phone_number -->
    <div class="mt-4">
        <x-input-label for="phone_number" :value="__('Teléfono')" />
        <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
    </div>

    <!-- address -->
    <div class="mt-4">
        <x-input-label for="address" :value="__('Dirección')" />
        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
        <x-input-error :messages="$errors->get('address')" class="mt-2" />
    </div>

    <!-- country -->
    <div class="mt-4">
        <x-input-label for="country" :value="__('Ciudad')" />
        <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required autofocus autocomplete="country" />
        <x-input-error :messages="$errors->get('country')" class="mt-2" />
    </div>

    <!-- Especialidad -->
    <div class="mt-4">
        <x-input-label for="specialty" :value="__('Especialidad')" />
        <x-text-input id="specialty" class="block mt-1 w-full" type="text" name="specialty" :value="old('specialty')" required autofocus autocomplete="specialty" />
        <x-input-error :messages="$errors->get('specialty')" class="mt-2" />
    </div>

    <!-- Role -->
    <div class="mt-4">
        <x-input-label for="role" :value="__('Rol')" />
        <select id="role" name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required autofocus autocomplete="role">
            <option value="admin">Administrador</option>
            <option value="teacher">Profesor</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Contraseña')" />

        <x-text-input id="password" class="block mt-1 w-full"
                      type="password"
                      name="password"
                      required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                      type="password"
                      name="password_confirmation" required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Crear') }}
        </x-primary-button>
    </div>
</form>
