<header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
    <div class="flex lg:justify-center lg:col-start-2 w-56 shadow-lg">
        <img src="https://campusdigitalfp.com/wp-content/uploads/2024/07/fpvirtual_logo_1024.png" alt="Imagen FP">
    </div>
    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            @auth
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
                    <a
                        href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                    >
                        Dashboard
                    </a>
                @else
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Cursos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('myCourses')" :active="request()->routeIs('myCourses')">
                        {{ __('Mis Cursos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                        {{ __('Perfil') }}
                    </x-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </x-nav-link>
                    </form>
                @endif
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
