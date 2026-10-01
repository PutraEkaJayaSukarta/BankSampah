@extends('layouts.dashboards')

@section('role_label', 'Superuser')

@section('sidebar')
    @include('superuser.partials.sidebar')
@endsection

@section('header', 'Daftar Admin')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-medium">Daftar Admin ({{ $admins->total() }})</h2>
        <a href="{{ route('superuser.admins.create') }}"
           class="inline-flex px-4 py-2 rounded-md bg-emerald-700 text-white text-sm hover:bg-emerald-800">
            Tambah Admin
        </a>
    </div>

    <div class="bg-white dark:bg-[#161615] rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-left">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Dibuat</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($admins as $admin)
                    <tr class="border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <td class="px-4 py-3">{{ $admin->name }}</td>
                        <td class="px-4 py-3">{{ $admin->email }}</td>
                        <td class="px-4 py-3">{{ $admin->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-right">
                            <form method="POST"
                                  action="{{ route('superuser.admins.destroy', $admin) }}"
                                  onsubmit="return confirm('Hapus akun admin ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1.5 rounded-md bg-red-600 text-white text-xs hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
                        <td colspan="4" class="px-4 py-6 text-center text-[#706f6c] dark:text-[#A1A09A]">
                            Belum ada admin.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $admins->links() }}
    </div>
@endsection
