<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['superadmin', 'admin', 'doctor', 'patient'];

        foreach ($roles as $role) {
            Role::factory()->create(['name' => $role]);
        }
    }
}
