<header class="bg-white shadow p-4 relative" x-data="{ open: false }">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-2xl font-bold flex items-center space-x-2">
            <p>ShoPperZ</p>
        </a>

        <!-- Centraliza a barra de pesquisa ou mantém um espaço vazio -->
        <div class="flex-1 flex justify-center">
            @if ($searchBar ?? false)
                <div class="relative w-full max-w-md lg:max-w-lg">
                    <input type="text" id="search" placeholder="O que você está procurando?"
                        class="px-4 py-2 w-full bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button type="submit" class="absolute top-0 right-0 mt-2 mr-4 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M10 16a6 6 0 100-12 6 6 0 000 12z" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Ícones e Menu -->
        <div class="flex items-center space-x-4">
            @if ($shortcuts ?? false)
                @foreach ($shortcuts as $shortcutKey)
                    @php
                        $shortcut = get_shortcut($shortcutKey);
                    @endphp
                    @if ($shortcut)
                        <a href="{{ url($shortcut['route']) }}" class="text-gray-600 hover:text-blue-500">
                            {!! $shortcut['icon'] !!}
                        </a>
                    @endif
                @endforeach
            @endif

            @if ($navLinks ?? false)
                <!-- Botão de Menu Hambúrguer -->
                <button @click="open = !open" class="text-2xl focus:outline-none">
                    <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" x-transition.opacity class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <!-- Menu Único -->
    @if ($navLinks ?? false)
        <nav x-show="open" x-transition.opacity @click.away="open = false"
            class="absolute top-full left-0 w-full bg-white shadow-md">
            <ul class="flex flex-col space-y-4 p-2">
                @foreach ($navLinks ?? [] as $link)
                    @php
                        $isActive = Request::routeIs($link['route'])
                            ? 'text-yellow-400 font-bold hover:text-blue-500'
                            : 'hover:text-blue-500';
                    @endphp

                    <li>
                        <a href="{{ route($link['route']) }}" class="{{ $isActive }}">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    @endif
</header>
