<a href="{{ route('superuser.dashboard') }}"
   class="block px-3 py-2 rounded-md text-sm hover:bg-emerald-600 {{ request()->routeIs('superuser.dashboard') ? 'bg-emerald-600 font-medium' : '' }}">
    Dashboard
</a>
<a href="{{ route('superuser.admins.index') }}"
   class="block px-3 py-2 rounded-md text-sm hover:bg-emerald-600 {{ request()->routeIs('superuser.admins.*') ? 'bg-emerald-600 font-medium' : '' }}">
    Kelola Admin
</a>
