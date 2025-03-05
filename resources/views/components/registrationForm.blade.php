@props(['course_id'])

<form action="{{ route('registrations.store', ['course' => $course_id]) }}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="course_id" value="{{ $course_id }}">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Inscribirse</button>
</form>
