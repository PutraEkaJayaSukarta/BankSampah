<?php

namespace App\Http\Middleware;

use App\Support\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Pastikan pengguna terautentikasi memiliki salah satu role yang diizinkan.
     *
     * @param  Closure(Request): (Response)  $next
     * @param  string  ...$roles  Role yang diizinkan mengakses route
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if ($user === null) {
            return redirect()->route('login');
        }

        $allowedRoles = array_map(
            fn (string $role): Role => Role::from($role),
            $roles,
        );

        if (! in_array($user->role, $allowedRoles, true)) {
            abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
        }

        return $next($request);
    }
}
