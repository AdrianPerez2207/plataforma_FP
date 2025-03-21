@props(['course_material'])


<section class="mb-8">
    <h2 class="text-2xl font-semibold mb-4 text-gray-700 flex items-center">
        @if($course_material->type == 'pdf')
            <x-svgPDF/>
            PDF's
        @elseif($course_material->type == 'video')
            <x-svgVideo/>
            Vídeos
        @elseif($course_material->type == 'link')
            <x-svgLink/>
            Enlaces
        @elseif($course_material->type == 'repository')
            <x-svgRepository/>
            Repositorios
        @endif
    </h2>
    <ul class="space-y-2">
        <li class="bg-white p-4 rounded-lg shadow">
                @if($course_material->type == 'pdf')
                    <a href="{{$course_material->url}}" class="text-blue-600 hover:underline flex items-center">
                        <x-svgPDFLink/>
                        {{$course_material->url}}
                    </a>
                @elseif($course_material->type == 'video')
                    <a href="{{$course_material->url}}" class="text-blue-600 hover:underline flex items-center">
                        <x-svgVideoLink/>
                        {{$course_material->url}}
                    </a>
                @elseif($course_material->type == 'link')
                    <a href="{{$course_material->url}}" class="text-blue-600 hover:underline flex items-center">
                        <x-svgLinkLink/>
                        {{$course_material->url}}
                    </a>
                @elseif($course_material->type == 'repository')
                    <a href="{{$course_material->url}}" class="text-blue-600 hover:underline flex items-center">
                        <x-svgRepositoryLink/>
                        {{$course_material->url}}
                    </a>
                @endif
        </li>
    </ul>
</section>
