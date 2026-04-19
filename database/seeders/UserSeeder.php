<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@blog.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Auteur 1',
            'email'    => 'auteur@blog.com',
            'password' => Hash::make('password'),
            'role'     => 'author',
        ]);

        User::create([
            'name'     => 'Lecteur 1',
            'email'    => 'lecteur@blog.com',
            'password' => Hash::make('password'),
            'role'     => 'reader',
        ]);
    }
}