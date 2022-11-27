<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'09778844556',
            'address'=>'Yangon',
            'role'=>'admin',
            'gender'=>'female',
            'password'=>Hash::make('admin123')
        ]);
    }
}
