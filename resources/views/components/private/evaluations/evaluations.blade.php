@props(['evaluations'])

<div class="container mx-auto">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg w-full">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alumno</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comentario</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nota final</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($evaluations as $evaluation)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $evaluation->course->name }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">{{ $evaluation->user->name }}</td>
                        <td class="px-4 py-4 whitespace-nowrap truncate max-w-sm">{{ $evaluation->comment }}</td>
                        <td class="px-4 py-4 text-center whitespace-nowrap"><small class="text-2xl bg-green-400 text-center size-10 rounded-md">{{ $evaluation->final_score }}</small></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
