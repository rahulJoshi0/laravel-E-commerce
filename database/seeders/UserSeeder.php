<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            'name' =>'rahul',
            'email'=>'rahul@gmil.com',
            'password'=>1234,
        ];
        user::create($data);
    }
}
