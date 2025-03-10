@props(['registrations'])

<div class="container mx-auto">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg w-full">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alumno</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de inscripción</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($registrations as $registration)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $registration->course->name }}</td>
                        <td class="px-4 py-4">{{ $registration->user->name }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $registration->created_at }}</td>
                        @if($registration->status == 'approved')
                            <td class="px-4 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                    {{ $registration->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{route('registration.cancelled', ['registration' => $registration->id])}}" class="text-red-600 hover:text-red-900 hover:underline mr-2">Cancelar</a>
                            </td>
                        @elseif($registration->status == 'pending')
                            <td class="px-4 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-300 text-gray-800">
                                    {{ $registration->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{route('registration.change', ['registration' => $registration->id])}}" class="text-indigo-600 hover:text-indigo-900 hover:underline mr-2">Aprobar</a>
                                <a href="{{route('registration.cancelled', ['registration' => $registration->id])}}" class="text-red-600 hover:text-red-900 hover:underline mr-2">Cancelar</a>
                            </td>
                        @else
                            <td class="px-4 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 text-red-800">
                                    {{ $registration->status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{route('registration.change', ['registration' => $registration->id])}}" class="text-indigo-600 hover:text-indigo-900 hover:underline mr-2">Aprobar</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
