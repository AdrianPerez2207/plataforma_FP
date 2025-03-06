@props(['courses', 'route'])

<form method="post" action="{{ route($route) }}">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Filtro por Nombre del Curso -->
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Curso</label>
            @if(auth()->check())
                <input type="text" id="nombre" name="nombre" placeholder="Buscar por nombre..."
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            @else
                <input disabled type="text" id="nombre" name="nombre" placeholder="Buscar por nombre..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            @endif
        </div>

        <!-- Filtro por Categoría -->
        <div>
            <label for="categoria" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
            @if(auth()->check())
                <select id="categoria" name="categoria"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Todas las categorías</option>
                    <option value="design">Diseño</option>
                    <option value="marketing">Marketing</option>
                    <option value="business">Negocios</option>
                    <option value="programming">Programación</option>
                </select>
            @else
                <select disabled id="categoria" name="categoria"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Todas las categorías</option>
                </select>
            @endif
        </div>

        <!-- Filtro por Duración -->
        <div>
            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duración</label>
            @if(auth()->check())
                <input type="number" id="duration" name="duration" placeholder="Buscar por tiempo..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            @else
                <input disabled type="number" id="duration" name="duration" placeholder="Buscar por tiempo..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            @endif
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="mt-6 flex justify-end">
        @if(auth()->check())
            <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                Limpiar Filtros
            </button>
            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Aplicar Filtros
            </button>
        @else
            <button disabled type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 mr-3">
                Limpiar Filtros
            </button>
            <button disabled type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-300">
                Aplicar Filtros
            </button>
        @endif

    </div>
</form>
