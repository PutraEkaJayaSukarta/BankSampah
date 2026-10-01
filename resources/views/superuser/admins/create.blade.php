@extends('layouts.dashboards')

@section('role_label', 'Superuser')

@section('sidebar')
    @include('superuser.partials.sidebar')
@endsection

@section('header', 'Tambah Admin')

@section('content')
    <div class="max-w-lg bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] p-6">
        <form method="POST" action="{{ route('superuser.admins.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium mb-1">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full rounded-md border border-[#e3e3e0] dark:border-[#3E3E3A] bg-transparent px-3 py-2 text-sm @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full rounded-md border border-[#e3e3e0] dark:border-[#3E3E3A] bg-transparent px-3 py-2 text-sm @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full rounded-md border border-[#e3e3e0] dark:border-[#3E3E3A] bg-transparent px-3 py-2 text-sm @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-4 py-2 rounded-md bg-emerald-700 text-white text-sm font-medium hover:bg-emerald-800">
                    Simpan Admin
                </button>
                <a href="{{ route('superuser.admins.index') }}"
                   class="text-sm text-[#706f6c] dark:text-[#A1A09A] hover:underline">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
