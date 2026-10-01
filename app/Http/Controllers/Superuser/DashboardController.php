<?php

namespace App\Http\Controllers\Superuser;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $totalAdmins = User::where('role', Role::Admin)->count();
        $totalUsers = User::where('role', Role::User)->count();

        return view('superuser.dashboard', [
            'totalAdmins' => $totalAdmins,
            'totalUsers' => $totalUsers,
        ]);
    }
}
