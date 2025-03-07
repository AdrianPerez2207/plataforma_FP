@props(['users'])


<div class="container mx-auto">
    <div class="mb-4">
        <a href="{{route('newUser')}}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Crear Nuevo Usuario
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg w-full">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellidos</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidad</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ciudad</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-4 py-4">{{ $user->last_name }}</td>
                        <td class="px-4 py-4">{{ $user->dni }}</td>
                        <td class="px-4 py-4">
                            @if($user->role == 'admin')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                    {{ $user->role }}
                                </span>
                            @elseif($user->role == 'teacher')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-300 text-blue-800">
                                    {{ $user->role }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-300 text-gray-800">
                                    {{ $user->role }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-4">{{ $user->specialty }}</td>
                        <td class="px-4 py-4">{{ $user->email }}</td>
                        <td class="px-4 py-4">{{ $user->phone_number }}</td>
                        <td class="px-4 py-4">{{ $user->address }}</td>
                        <td class="px-4 py-4">{{ $user->country }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{route('user.destroy', ['user' => $user->id])}}" class="text-red-600 hover:text-red-900 hover:underline mr-2">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
