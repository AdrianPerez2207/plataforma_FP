<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard/Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8">
            @if(session('msg'))
                <div class="alert alert-success bg-green-400 text-white w-100 text-center text-2xl rounded-md mb-4">
                    {{ session('msg') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger bg-red-400 text-white w-100 text-center text-2xl rounded-md mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg min-w-full">
                <div class="p-6 text-gray-900 min-w-full">
                    <x-private.users.users :users="$users"/>
                </div>
            </div>
            <div class="mt-5 mb-4">
                {{$users->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
