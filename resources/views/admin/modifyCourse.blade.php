@props(['teachers', 'course'])

<x-guest-layout>
    <x-private.courses.formCourses :method="'POST'" :action="route('courses.update', ['course' => $course])" :teachers="$teachers" :course="$course"/>
</x-guest-layout>
