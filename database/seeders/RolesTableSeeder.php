<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['aday', 'test uygulayıcısı', 'sistem yöneticisi'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
