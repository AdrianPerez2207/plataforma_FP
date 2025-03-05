@props(['course_id'])

<form action="{{ route('registrations.update', ['course' => $course_id]) }}" method="post">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="course_id" value="{{ $course_id }}">
    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Cancelar Inscripción</button>
</form>
