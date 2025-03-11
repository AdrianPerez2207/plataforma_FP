@props(['registration', 'method', 'action'])

<form method="{{$method}}" action="{{ $action }}">
    @csrf

    <!-- Course -->
    <div>
        <x-input-label for="course_id" :value="__('Curso')" />
        <x-text-input id="course_id" class="block mt-1 w-full" type="text" name="course_id"
                      value="{{old('course_id',$registration->course->name)}}"
                      required autofocus autocomplete="course_id" disabled/>
        <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
    </div>

    <!-- Student -->
    <div>
        <x-input-label for="student_id" :value="__('Alumno')" />
        <x-text-input id="student_id" class="block mt-1 w-full" type="text" name="student_id"
                      value="{{old('student_id',$registration->user->name)}}"
                      required autofocus autocomplete="student_id" disabled/>
        <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
    </div>

    <!-- Descripción -->
    <div class="mt-4">
        <x-input-label for="comment" :value="__('Comentario')" />
            <textarea id="comment" name="comment" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                      rows="3" required autofocus autocomplete="comment">
            </textarea>
        <x-input-error :messages="$errors->get('comment')" class="mt-2" />
    </div>

    <!-- Final_score -->
    <div class="mt-4">
        <x-input-label for="final_score" :value="__('Nota final')" />
        <x-text-input step="0.01" id="final_score" class="block mt-1 w-full" type="number" name="final_score"
                      required autofocus autocomplete="final_score"/>
        <x-input-error :messages="$errors->get('final_score')" class="mt-2" />
    </div>


    <div class="mt-4">
        <x-primary-button class="ms-4">
            {{ __('Evaluar') }}
        </x-primary-button>
    </div>
</form>
