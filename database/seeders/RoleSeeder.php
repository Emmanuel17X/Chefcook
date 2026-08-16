<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::count() < 2
            ? collect([
                Role::create([
                    'id_role' => 1,
                    'libelle' => 'user'
                ]),
                Role::create([
                    'id_role' => 2,
                    'libelle' => 'admin'
                ])
            ]):Role::take(2)->get();
    }
}
