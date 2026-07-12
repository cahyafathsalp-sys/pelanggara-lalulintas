<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();
        user::create([
            'name'=>'cahya',
            'email'=>'cahya@gmail.com',
            'password'=>bcrypt('12345678'),
        ]);
        
    }
}
