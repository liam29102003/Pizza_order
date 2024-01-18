<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => "Liam",
            'email'=> "liampyne391@gmail.com",
            'phone'=>'091234',
            'gender'=>'male',
            'address'=>'Yangon',
            'role'=>'admin',
            'password'=>Hash::make('29102003')
        ]);
        // User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'phone' =>$input['phone'],
        //     'gender'=>$input['gender'],
        //     'address'=>$input['address'],
        //     'password' => Hash::make($input['password']),
        // ]);
    }
}