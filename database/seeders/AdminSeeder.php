<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Buat akun admin awal (idempoten).
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@banksampah.test'],
            [
                'name' => 'Admin Bank Sampah',
                'password' => 'password',
                'role' => Role::Admin,
            ],
        );
    }
}
