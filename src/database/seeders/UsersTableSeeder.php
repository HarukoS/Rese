<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => '鈴木一郎',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => '2025-07-11 00:00:00',
            'created_at' => '2025-07-11 00:00:00',
            'role' => '1',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '鈴木次郎',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => '2025-07-11 00:00:00',
            'created_at' => '2025-07-11 00:00:00',
            'role' => '2',
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => '鈴木花子',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => '2025-07-11 00:00:00',
            'created_at' => '2025-07-11 00:00:00',
        ];
        DB::table('users')->insert($param);
    }
}
