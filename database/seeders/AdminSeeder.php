<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = User::count() < 4
            ? collect([
                User::create([
                    'id' => '1',
                    'username' => 'Gabriel FERNANDEZ',
                    'email' => 'gabrielfer@gmail.com',
                    'password' => 'ABC123(gab)',
                    'id_role' => '2'
                ]),
                User::create([
                    'id' => '2',
                    'username' => 'Isadora FERNANDEZ',
                    'email' => 'isadorafer@gmail.com',
                    'password' => 'ABC123(isa)',
                    'id_role' => '2'
                ]),
                User::create([
                    'id' => '3',
                    'username' => 'SANTA Mario',
                    'email' => 's@gmail.com',
                    'password' => 'Santa228',
                    'id_role' => '1'
                ]),
                User::create([
                    'id' => '4',
                    'username' => 'Thomas20',
                    'email' => 'thomas20@gmail.com',
                    'password' => 'Thomas20',
                    'id_role' => '1'
                ])
            ]):User::take(4)->get();
    }
}
