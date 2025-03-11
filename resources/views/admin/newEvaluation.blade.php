@props(['registration'])


<x-guest-layout>
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
    <x-private.evaluations.formEvaluation :method="'POST'" :action="route('create', ['registration' => $registration])" :registration="$registration"/>
</x-guest-layout>
