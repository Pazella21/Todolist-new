<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'status'=>'active','role'=>'admin', 'password' => 'admin123']);
        // User::create(['name' => 'staff', 'email' => 'staff@gmail.com', 'status'=>'active','role'=>'staff', 'password' => 'staff123']);
        // User::create(['name' => 'customer', 'email' => 'customer@gmail.com', 'status'=>'active','role'=>'customer', 'password' => 'customer123']);

        User::create(['name'=>'admin','email'=>'admin@gmail.com','status'=>'active','role'=>'admin','password'=>Hash::make('admin')]);
        User::create(['name'=>'staff','email'=>'staff@gmail.com','status'=>'active','role'=>'staff','password'=>Hash::make('staff')]);
        User::create(['name'=>'customer','email'=>'customer@gmail.com','status'=>'active','role'=>'customer','password'=>Hash::make('customer')]);  
    }
}
