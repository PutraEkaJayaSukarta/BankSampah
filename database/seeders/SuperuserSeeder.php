<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperuserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Buat akun superuser awal (idempoten).
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'superuser@banksampah.test'],
            [
                'name' => 'Superuser Bank Sampah',
                'password' => 'password',
                'role' => Role::Superuser,
            ],
        );
    }
}
