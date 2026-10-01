<div class="min-h-screen flex">
    {{-- Sidebar --}}
    <aside class="hidden md:flex md:w-64 flex-col bg-emerald-700 text-emerald-50">
        <div class="px-6 py-5 border-b border-emerald-600">
            <p class="text-lg font-semibold">Bank Sampah</p>
            <p class="text-xs uppercase tracking-widest text-emerald-200">@yield('role_label')</p>
        </div>

        <nav class="flex-1 px-3 py-4 space-y-1">
            @yield('sidebar')
        </nav>

        <div class="px-3 py-4 border-t border-emerald-600">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-sm hover:bg-emerald-600">
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- Konten utama --}}
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white dark:bg-[#161615] shadow-sm border-b border-[#e3e3e0] dark:border-[#3E3E3A] px-6 py-4 flex items-center justify-between">
            <h1 class="font-medium text-lg">@yield('header', 'Dashboard')</h1>
            <div class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                {{ auth()->user()->name }} <span class="text-xs">({{ auth()->user()->role->value }})</span>
            </div>
        </header>

        <main class="flex-1 p-6">
            @if (session('status'))
                <div class="mb-4 px-4 py-3 rounded-md bg-emerald-100 text-emerald-800 border border-emerald-300">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 px-4 py-3 rounded-md bg-red-100 text-red-800 border border-red-300">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
