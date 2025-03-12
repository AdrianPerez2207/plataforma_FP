@props(['course', 'action', 'method'])

<form method="{{$method}}" action="{{ $action }}">
    @csrf

    <!-- Course -->
    <div>
        <x-input-label for="course" :value="__('Curso')" />
            <x-text-input id="course" class="block mt-1 w-full" type="text" name="course"
                      value="{{old('course',$course->name)}}" disabled/>
        <x-input-error :messages="$errors->get('course')" class="mt-2" />
    </div>

    <!-- Type -->
    <div class="mt-4">
        <x-input-label for="type" :value="__('Tipo')" />
            <select id="type" name="type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required autofocus autocomplete="type">
                <option value="video">Vídeo</option>
                <option value="link">Enlace</option>
                <option value="repository">Repositorio</option>
                <option value="pdf">Pdf</option>
            </select>
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    <!-- Url -->
    <div class="mt-4">
        <x-input-label for="url" :value="__('Url')" />
            <x-text-input id="url" class="block mt-1 w-full" type="text" name="url"
                      value="{{old('url')}}"
                      required autofocus autocomplete="url" />
        <x-input-error :messages="$errors->get('url')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-primary-button class="ms-4">
            {{ __('Añadir') }}
        </x-primary-button>
    </div>

</form>
