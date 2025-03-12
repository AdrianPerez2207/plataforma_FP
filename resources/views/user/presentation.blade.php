@extends('layouts.appUser')

    @section('content')

        <!-- Contenido principal -->
        <main class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

            <!-- Introducción -->
            <section class="mb-16">
                <div class="max-w-3xl mx-auto text-center">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        En <span class="font-bold text-blue-600">FP Virtual</span>, creemos en el poder de la educación para transformar vidas y abrir nuevas oportunidades. Nuestra misión es brindar formación profesional de calidad, accesible y adaptada a las necesidades del mercado laboral actual.
                    </p>
                </div>
            </section>

            <!-- Quiénes Somos -->
            <section class="mb-16">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <div class="md:flex-shrink-0">
                            <img class="h-full w-full object-cover md:w-48" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80" alt="Equipo de profesionales">
                        </div>
                        <div class="p-8">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">¿Quiénes Somos?</h2>
                            <p class="text-gray-700 leading-relaxed">
                                Somos un equipo de profesionales apasionados por la enseñanza y la capacitación. Nos especializamos en desarrollar cursos prácticos, impartidos por expertos en cada área, con un enfoque 100% aplicado para que puedas adquirir habilidades reales y demandadas en el mundo laboral.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Nuestra Metodología -->
            <section class="mb-16">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Nuestra Metodología</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-laptop-code text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Aprendizaje práctico</h3>
                        <p class="text-gray-600">
                            Contenidos actualizados y enfocados en la empleabilidad.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-clock text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Flexibilidad</h3>
                        <p class="text-gray-600">
                            Cursos en línea y presenciales para adaptarnos a tu ritmo.
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="text-blue-600 mb-4">
                            <i class="fas fa-certificate text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Certificación</h3>
                        <p class="text-gray-600">
                            Obtén diplomas que validen tus conocimientos y potencien tu perfil profesional.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Nuestra Misión -->
            <section class="mb-16 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-8">
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Nuestra Misión</h2>
                    <p class="text-gray-700 text-center leading-relaxed mb-6">
                        Ayudarte a crecer profesionalmente con formación de calidad, accesible y orientada a resultados. Queremos ser el puente entre tu talento y el éxito laboral.
                    </p>
                    <p class="text-gray-700 text-center font-medium">
                        Únete a nuestra comunidad y comienza a construir el futuro que deseas. 🚀
                    </p>
                </div>
            </section>

            <!-- Contacto -->
            <section class="text-center">
                <div class="inline-block bg-blue-600 text-white px-8 py-4 rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
                    <a href="#" class="flex items-center gap-3">
                        <span>✉</span>
                        <span>Contáctanos para más información</span>
                    </a>
                </div>
            </section>
        </main>

    @endsection

