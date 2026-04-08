<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'testtest'
        ]);

        $test_user = User::first();

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => '腕時計',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'brand' => 'Rolax',
            'price' => '15000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition_id' => 1
        ]);
        $product->categories()->attach([1,5]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'HDD',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
            'brand' => '西芝',
            'price' => '5000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '高速で信頼性の高いハードディスク',
            'condition_id' => 2
        ]);
        $product->categories()->attach([2]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => '玉ねぎ３束',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
            'brand' => 'なし',
            'price' => '300',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '新鮮な玉ねぎ３束のセット',
            'condition_id' => 3
        ]);
        $product->categories()->attach([10]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => '革靴',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
            'price' => '4000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => 'クラシックなデザインの革靴',
            'condition_id' => 4
        ]);
        $product->categories()->attach([1,5]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'ノートPC',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
            'price' => '45000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '高性能なノートパソコン',
            'condition_id' => 1
        ]);
        $product->categories()->attach([2]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'マイク',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'brand' => 'なし',
            'price' => '5000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '高音質のレコーディング用マイク',
            'condition_id' => 2
        ]);
        $product = Product::create([
            
            'user_id' => $test_user->id,
            'name' => 'ショルダーバック',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'price' => '3500',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => 'おしゃれなショルダーバック',
            'condition_id' => 3
        ]);
        $product->categories()->attach([1,4]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'タンブラー',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
            'brand' => 'なし',
            'price' => '500',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '使いやすいタンブラー',
            'condition_id' => 4
        ]);
        $product->categories()->attach([10]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'コーヒーミル',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
            'brand' => 'Starbacks',
            'price' => '4000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '手動のコーヒーミル',
            'condition_id' => 1
        ]);
        $product->categories()->attach([10]);

        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'メイクセット',
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
            'price' => '2500',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '便利なメイクアップセット',
            'condition_id' => 2
        ]);
        $product->categories()->attach([4,6]);
    }
}
