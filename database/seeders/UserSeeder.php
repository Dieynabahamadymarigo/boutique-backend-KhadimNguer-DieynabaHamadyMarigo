<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        User::create([
            'name'=>'Admin',
            'email'=> 'admin@boutique.com',
            'password'=>'password123',
            'role'=>'admin',
        ]);

        //gestionnaire
        User::create([
            'name'=>'Gestionnaire',
            'email'=> 'gestionnaire@boutique.com',
            'password'=>'password123',
            'role'=>'gestionnaire',
        ]);

        //employe
        User::create([
            'name'=>'Employe',
            'email'=> 'employe@boutique.com',
            'password'=>'password123',
            'role'=>'employe',
        ]);
    }
}
