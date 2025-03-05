@extends('layouts.appUser')

    @section('content')
        <div class="container mx-auto max-w-4xl">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Materiales del Curso: {{ $course->name }}</h1>

            @foreach($materials as $material)
                <x-sectionMaterial :course_material="$material"/>
            @endforeach
        </div>
    @endsection
