@extends('layouts.dashboards')

@section('role_label', 'Admin')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}"
       class="block px-3 py-2 rounded-md text-sm hover:bg-emerald-600 {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-600 font-medium' : '' }}">
        Dashboard
    </a>
@endsection

@section('header', 'Dashboard Admin')

@section('content')
    <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6">
        <h2 class="font-medium">Selamat datang, {{ auth()->user()->name }}!</h2>
        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mt-1">
            Ini adalah dashboard admin. Fitur admin akan ditambahkan di sini nantinya.
        </p>
    </div>
@endsection
