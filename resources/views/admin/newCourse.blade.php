@props(['teachers'])

<x-guest-layout>
    <x-private.courses.formCourses :method="'POST'" :action="route('create')" :teachers="$teachers"/>
</x-guest-layout>
