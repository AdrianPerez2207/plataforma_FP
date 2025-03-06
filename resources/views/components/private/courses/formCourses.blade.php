@props(['action', 'course' => null, 'teachers', 'method'])

<form method="{{$method}}" action="{{ $action }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Nombre')" />
        @if($course)
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                      value="{{old('name',$course->name)}}"
                      required autofocus autocomplete="name" />
        @else
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          value="{{old('name')}}"
                          required autofocus autocomplete="name" />
        @endif
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Descripción -->
    <div class="mt-4">
        <x-input-label for="description" :value="__('Descripción')" />
        @if($course)
            <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                      rows="3" required autofocus autocomplete="description">
                {{ old('description',$course->description) }}
            </textarea>
        @else
            <textarea id="description" name="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                      rows="3" required autofocus autocomplete="description">
            </textarea>
        @endif
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <!-- Category -->
    <div class="mt-4">
        <x-input-label for="category" :value="__('Categoría')" />
        @if($course)
            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required autofocus autocomplete="category">
                <option selected value="{{ $course->category }}">{{ $course->category }}</option>
                <option value="programming">Programación</option>
                <option value="design">Diseño</option>
                <option value="marketing">Marketing</option>
                <option value="business">Negocios</option>
            </select>
        @else
            <select id="category" name="category" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required autofocus autocomplete="category">
                <option value="programming">Programación</option>
                <option value="design">Diseño</option>
                <option value="marketing">Marketing</option>
                <option value="business">Negocios</option>
            </select>
        @endif
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>

    <!-- teacher -->
    <div class="mt-4">
        <x-input-label for="teacher_id" :value="__('Profesor')" />
        @if($course)
            <select id="teacher_id" name="teacher_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required autofocus autocomplete="teacher_id">
                <option value="{{ $course->teacher_id }}">{{ $course->teacher->name }}</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        @else
            <select id="teacher_id" name="teacher_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required autofocus autocomplete="teacher_id">
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        @endif
        <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
    </div>

    <!-- duration -->
    <div class="mt-4">
        <x-input-label for="duration" :value="__('Duración')" />
        @if($course)
        <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration"
                      value="{{old('duration',$course->duration)}}"
                      required autofocus autocomplete="duration" />
        @else
            <x-text-input id="duration" class="block mt-1 w-full" type="text" name="duration" value="{{old('duration')}}" required autofocus autocomplete="duration" />
        @endif
        <x-input-error :messages="$errors->get('duration')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-primary-button class="ms-4">
            @if($course)
                {{ __('Modificar') }}
            @else
                {{ __('Crear') }}
            @endif
        </x-primary-button>
    </div>
</form>
