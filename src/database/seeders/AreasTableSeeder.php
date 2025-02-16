<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'area' => '東京都',
        ];
        DB::table('areas')->insert($param);
        $param = [
            'area' => '大阪府',
        ];
        DB::table('areas')->insert($param);
        $param = [
            'area' => '福岡県',
        ];
        DB::table('areas')->insert($param);
    }
}
