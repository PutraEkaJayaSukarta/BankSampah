<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Buat akun user biasa awal (idempoten).
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@banksampah.test'],
            [
                'name' => 'User Bank Sampah',
                'password' => 'password',
                'role' => Role::User,
            ],
        );
    }
}
