@props(['teachers', 'course'])

<x-guest-layout>
    <x-private.courses.formCourses :method="'PUT'" :action="route('courses.update', ['course' => $course->id])" :teachers="$teachers" :course="$course"/>
</x-guest-layout>
