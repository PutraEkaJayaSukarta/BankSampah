@extends('layouts.app')

@section('title', 'Daftar - Bank Sampah')

@section('content')
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md">
            <div class="bg-white dark:bg-[#161615] rounded-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] p-8">
                <h1 class="text-xl font-semibold mb-1">Daftar</h1>
                <p class="text-sm text-[#706f6c] dark:text-[#A1A09A] mb-6">Buat akun nasabah Bank Sampah Anda</p>

                <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
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

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="w-full rounded-md border border-[#e3e3e0] dark:border-[#3E3E3A] bg-transparent px-3 py-2 text-sm">
                    </div>

                    <button type="submit"
                            class="w-full px-4 py-2 rounded-md bg-emerald-700 text-white text-sm font-medium hover:bg-emerald-800">
                        Daftar
                    </button>
                </form>

                <p class="text-sm text-center mt-6 text-[#706f6c] dark:text-[#A1A09A]">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-emerald-700 dark:text-emerald-400 hover:underline">
                        Masuk
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
