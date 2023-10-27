<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'avatar' => 'https://www.getillustrations.com/photos/pack/3d-avatar-male_lg.png',
            'full_name' => 'Quản trị viên',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'group_id' => 1,
            'created_at' => Date('y-m-d h:m:s'),
            'updated_at' => Date('y-m-d h:m:s'),
            'phone_number' => '0376173628',
        ]);
        DB::table('groups')->insert([
            ['id' => 1, 'name' => 'Quản trị viên', 'permissions' => '{"admin":["view"],"dashboard":["view"],"slider":["view","add","edit","delete"],"category":["view","add","edit","delete"],"product":["view","add","edit","delete"],"color":["view","add","edit","delete"],"size":["view","add","edit","delete"],"order":["view","add","edit","delete"],"post":["view","add","edit","delete"],"tag":["view","add","edit","delete"],"group":["view","add","edit","delete","permission"],"user":["view","add","edit","delete"],"media":["view"]}'],
            ['id' => 2, 'name' => 'Khách hàng', 'permissions' => ''],
        ]);
        DB::table('colors')->insert([
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
        ]);

        DB::table('sizes')->insert([
            ['name' => 'XS'],
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
        ]);
        DB::table('tags')->insert([
            ['name' => 'Thời trang'],
            ['name' => 'Đồng hồ'],
            ['name' => 'Trang sức'],
            ['name' => 'Giày dép'],
            ['name' => 'Túi xách'],
            ['name' => 'Phụ kiện'],
            ['name' => 'Áo khoác'],
            ['name' => 'Áo sơ mi'],
            ['name' => 'Quần âu'],
            ['name' => 'Quần jean'],
            ['name' => 'Váy đầm'],
            ['name' => 'Đồ bơi'],
            ['name' => 'Đồ lót'],
            ['name' => 'Đồ thể thao'],
            ['name' => 'Đồ công sở'],
            ['name' => 'Đồ dạ hội'],
            ['name' => 'Đồ da'],
            ['name' => 'Đồ len'],
            ['name' => 'Đồ nỉ'],
            ['name' => 'Đồ bông']
        ]);
        DB::table('modules')->insert([
            ['routeName' => 'admin', 'title' => 'Trang admin'],
            ['routeName' => 'dashboard', 'title' => 'Dashboard'],
            ['routeName' => 'slider', 'title' => 'Quản lý silder'],
            ['routeName' => 'category', 'title' => 'Quản lý danh mục'],
            ['routeName' => 'product', 'title' => 'Quản lý sản phẩm'],
            ['routeName' => 'color', 'title' => 'Quản lý màu'],
            ['routeName' => 'size', 'title' => 'Quản lý size'],
            ['routeName' => 'order', 'title' => 'Quản lý đặt hàng'],
            ['routeName' => 'post', 'title' => 'Quản lý bài viết'],
            ['routeName' => 'tag', 'title' => 'Quản lý thẻ tags'],
            ['routeName' => 'group', 'title' => 'Quản lý nhóm người'],
            ['routeName' => 'user', 'title' => 'Quản lý thành viên'],
            ['routeName' => 'media', 'title' => 'Quản lý media'],
        ]);
    }
}
