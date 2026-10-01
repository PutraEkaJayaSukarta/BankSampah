@extends('layouts.dashboards')

@section('role_label', 'Superuser')

@section('sidebar')
    <a href="{{ route('superuser.dashboard') }}"
       class="block px-3 py-2 rounded-md text-sm hover:bg-emerald-600 {{ request()->routeIs('superuser.dashboard') ? 'bg-emerald-600 font-medium' : '' }}">
        Dashboard
    </a>
    <a href="{{ route('superuser.admins.index') }}"
       class="block px-3 py-2 rounded-md text-sm hover:bg-emerald-600 {{ request()->routeIs('superuser.admins.*') ? 'bg-emerald-600 font-medium' : '' }}">
        Kelola Admin
    </a>
@endsection

@section('header', 'Dashboard Superuser')

@section('content')
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6">
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Total Admin</p>
            <p class="text-3xl font-semibold mt-2">{{ $totalAdmins }}</p>
        </div>
        <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6">
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Total User</p>
            <p class="text-3xl font-semibold mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 flex flex-col justify-between">
            <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">Aksi Cepat</p>
            <a href="{{ route('superuser.admins.create') }}"
               class="mt-3 inline-flex justify-center px-4 py-2 rounded-md bg-emerald-700 text-white text-sm hover:bg-emerald-800">
                Tambah Admin
            </a>
        </div>
    </div>

    <div class="mt-6 bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6">
        <h2 class="font-medium">Selamat datang, {{ auth()->user()->name }}!</h2>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
            Sebagai superuser, Anda dapat melihat daftar admin, membuat akun admin baru, dan menghapus akun admin.
        </p>
    </div>
@endsection
