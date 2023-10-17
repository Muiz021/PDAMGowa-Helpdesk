<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert(
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'roles' => 'admin'
            ],
        );
        DB::table('users')->insert(
            [
                'nama' => 'Muiz',
                'nosamb' => '123',
                'no_hp' => '081222343598',
                'alamat' => 'Samata',
                'is_verification' => true,
                'username' => 'user',
                'password' => Hash::make('user'),
                'roles' => 'user'
            ],
        );
    }
}
