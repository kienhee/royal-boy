<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $colors = [
            ['name' => 'Đỏ', 'code' => '#FF0000'],
            ['name' => 'Xanh lá cây', 'code' => '#00FF00'],
            ['name' => 'Xanh dương', 'code' => '#0000FF'],
            ['name' => 'Vàng', 'code' => '#FFFF00'],
            ['name' => 'Cam', 'code' => '#FFA500'],
            ['name' => 'Tím', 'code' => '#800080'],
            ['name' => 'Hồng', 'code' => '#FFC0CB'],
            ['name' => 'Nâu', 'code' => '#A52A2A'],
            ['name' => 'Xanh lơ', 'code' => '#00FFFF'],
            ['name' => 'Đỏ hoa', 'code' => '#FF00FF'],
            ['name' => 'Chanh', 'code' => '#00FF00'],
            ['name' => 'Xanh lam', 'code' => '#008080'],
            ['name' => 'Lam', 'code' => '#4B0082'],
            ['name' => 'Tím nhạt', 'code' => '#9400D3'],
            ['name' => 'Nâu đậm', 'code' => '#800000'],
            ['name' => 'Ô liu', 'code' => '#808000'],
            ['name' => 'Hải quân', 'code' => '#000080'],
            ['name' => 'Ngọc biển', 'code' => '#00FFBF'],
            ['name' => 'Ngọc lam', 'code' => '#40E0D0'],
            ['name' => 'Xám bạc', 'code' => '#708090'],
            ['name' => 'Nâu đất', 'code' => '#A0522D'],
            ['name' => 'Xanh dương hoàng gia', 'code' => '#4169E1'],
            ['name' => 'Xanh lá cây nhạt', 'code' => '#98FB98'],
            ['name' => 'Cam đậm', 'code' => '#FF4500'],
            ['name' => 'Tím đậm', 'code' => '#9370DB'],
            ['name' => 'Hoa lavender', 'code' => '#E6E6FA'],
            ['name' => 'Vàng', 'code' => '#FFD700'],
            ['name' => 'Đỏ gạch', 'code' => '#B22222'],
            ['name' => 'Hồng đậm', 'code' => '#FF1493'],
            ['name' => 'Cocola', 'code' => '#D2691E'],
            ['name' => 'Xanh biển sĩ', 'code' => '#5F9EA0'],
        ];

        DB::table('colors')->insert($colors);
    }
}
