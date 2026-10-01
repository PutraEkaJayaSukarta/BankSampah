<?php

namespace App\Support;

enum Role: string
{
    case Superuser = 'superuser';
    case Admin = 'admin';
    case User = 'user';

    /**
     * Redirect path after login for the given role.
     */
    public function dashboardPath(): string
    {
        return match ($this) {
            self::Superuser => '/superuser/dashboard',
            self::Admin => '/admin/dashboard',
            self::User => '/dashboard',
        };
    }
}
