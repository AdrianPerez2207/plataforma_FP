@props(['courses'])


<div class="container mx-auto">
    <div class="mb-4">
        <a href="{{route('newCourse')}}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Crear Nuevo Curso
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profesor</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duración</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($courses as $course)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $course->name }}</td>
                        <td class="px-4 py-4">{{ $course->description }}</td>
                        <td class="px-4 py-4">{{ $course->category }}</td>
                        <td class="px-4 py-4">{{ $course->teacher->name }}</td>
                        <td class="px-4 py-4">{{ $course->duration }}</td>
                        <td class="px-4 py-4">
                            @if($course->status == 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                    {{ $course->status }}
                                </span>
                                    @elseif($course->status == 'cancelled')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                    {{ $course->status }}
                                </span>
                                    @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-300 text-gray-800">
                                    {{ $course->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{route('courses.modify', ['course' => $course->id])}}" class="text-indigo-600 hover:text-indigo-900 hover:underline mr-2">Modificar</a>
                            <a href="{{route('course.destroy', ['course' => $course->id])}}" class="text-red-600 hover:text-red-900 hover:underline mr-2">Eliminar</a>
                            <a href="{{route('course.finished', ['course' => $course->id])}}" class="text-gray-600 hover:text-gray-900 hover:underline">Finalizar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
