@props(['course'])


<div class="bg-white shadow-lg overflow-hidden h-[425px]">
    <div class="p-6 h-[350px]">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $course->name }}</h3>
        <hr/>
        <div class="h-40 mb-4">
            <p class="text-gray-600 mb-2 mt-2">{{ $course->description }}</p>
        </div>
        <hr/>
        <div class="flex flex-wrap justify-between text-sm text-gray-500 mb-3 mt-5">
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                {{ $course->category }}
            </span>
            <span class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Duración: {{ $course->duration }}
            </span>
        </div>
        <div class="flex items-center text-sm text-gray-500">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Profesor: {{ $course->teacher->name }}
        </div>
    </div>
    <div class="px-6 py-6 bg-gray-200 flex flex-wrap justify-between">

        @php
            if (auth()->check()){
                $registration = auth()->user()->registrationByCourse($course);
            }
        @endphp
        @if(auth()->check() && $registration != null)
            @if($registration->status == 'approved' || $registration->status == 'pending')
                <!-- Formulario cancelación -->
                <x-cancelledForm :course_id="$course->id"/>
            @else
                <button type="submit" class="bg-blue-300 text-white font-bold py-2 px-4 rounded" disabled>Inscribirse</button>
                <span class="text-red-600 mt-2">Cancelada</span>
            @endif
        @else
            @if(auth()->check())
                <!-- Formulario de inscripción -->
                <x-registrationForm :course_id="$course->id"/>
                <a href="{{route('material.byCourse', ['course' => $course])}}" class="text-blue-600 hover:underline mt-2 cursor-pointer">Ver material</a>
            @else
                <button type="submit" class="bg-blue-300 text-white font-bold py-2 px-4 rounded" disabled>Inscribirse</button>
            @endif
        @endif
    </div>
</div>
