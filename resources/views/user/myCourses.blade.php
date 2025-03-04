@extends('layouts.appUser')

    @section('content')
        <!-- Mensajes de error o de éxito -->
        @if(session('msg'))
            <div class="alert alert-success bg-green-400 text-white w-80 text-center text-2xl rounded-md mb-4">
                {{ session('msg') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger bg-red-400 text-white w-80 text-center text-2xl rounded-md mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="font-semibold text-3xl text-gray-800 leading-tight mb-6">
            Mis Cursos
        </h2>
        <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-4 lg:gap-8">
            @foreach($courses as $course)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <x-course-card :course="$course"/>
                </div>
            @endforeach
        </div>
        <div class="mt-5 mb-4">
            {{$courses->links()}}
        </div>
    @endsection
