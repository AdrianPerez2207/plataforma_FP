@props(['teachers'])

<x-guest-layout>
    <form method="POST" action="{{ route('create') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Descripción -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Descripción')" />
            <textarea id="description" name="description" class="block mt-1 w-full" rows="3" required autofocus autocomplete="description"></textarea>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Category -->
        <div class="mt-4">
            <x-input-label for="category" :value="__('Categoría')" />
            <select id="category" name="category" class="block mt-1 w-full" required autofocus autocomplete="category">
                <option value="programming">Programación</option>
                <option value="design">Diseño</option>
                <option value="marketing">Marketing</option>
                <option value="business">Negocios</option>
            </select>
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>

        <!-- teacher -->
        <div class="mt-4">
            <x-input-label for="teacher_id" :value="__('Profesor')" />
            <select id="teacher_id" name="teacher_id" class="block mt-1 w-full" required autofocus autocomplete="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
        </div>

        <!-- duration -->
        <div class="mt-4">
            <x-input-label for="duration" :value="__('Duración')" />
            <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" :value="old('duration')" required autofocus autocomplete="duration" />
            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-primary-button class="ms-4">
                {{ __('Crear') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
