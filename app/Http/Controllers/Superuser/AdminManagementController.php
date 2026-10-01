<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminManagementController extends Controller
{
    /**
     * Tampilkan daftar admin.
     */
    public function index(): View
    {
        $admins = User::query()
            ->where('role', Role::Admin)
            ->latest()
            ->paginate(10);

        return view('superuser.admins.index', compact('admins'));
    }

    /**
     * Tampilkan form pembuatan admin.
     */
    public function create(): View
    {
        return view('superuser.admins.create');
    }

    /**
     * Simpan admin baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            ...$validated,
            'role' => Role::Admin,
        ]);

        return redirect()
            ->route('superuser.admins.index')
            ->with('status', 'Akun admin berhasil dibuat.');
    }

    /**
     * Hapus akun admin.
     *
     * Superuser tidak dapat dihapus lewat aksi ini.
     */
    public function destroy(User $admin): RedirectResponse
    {
        if ($admin->role !== Role::Admin) {
            return redirect()
                ->route('superuser.admins.index')
                ->with('error', 'Hanya akun admin yang dapat dihapus.');
        }

        $admin->delete();

        return redirect()
            ->route('superuser.admins.index')
            ->with('status', 'Akun admin berhasil dihapus.');
    }
}
