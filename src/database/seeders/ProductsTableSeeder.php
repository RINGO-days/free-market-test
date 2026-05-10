<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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

        $path = public_path('img/腕時計.jpg');
        $dummyImage = 'products/腕時計.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','良好')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => '腕時計',
            'image' => $dummyImage,
            'brand' => 'Rolax',
            'price' => '15000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => 'スタイリッシュなデザインのメンズ腕時計',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['ファッション','メンズ'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/HDD.jpg');
        $dummyImage = 'products/HDD.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','目立った傷や汚れなし')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'HDD',
            'image' => $dummyImage,
            'brand' => '西芝',
            'price' => '5000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '高速で信頼性の高いハードディスク',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['家電'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/玉ねぎ.jpg');
        $dummyImage = 'products/玉ねぎ.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','やや傷や汚れあり')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => '玉ねぎ３束',
            'image' => $dummyImage,
            'brand' => 'なし',
            'price' => '300',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '新鮮な玉ねぎ３束のセット',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['キッチン'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/靴.jpg');
        $dummyImage = 'products/靴.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','状態が悪い')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => '革靴',
            'image' => $dummyImage,
            'price' => '4000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => 'クラシックなデザインの革靴',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['ファッション','メンズ'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/ノートPC.jpg');
        $dummyImage = 'products/ノートPC.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','良好')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'ノートPC',
            'image' => $dummyImage,
            'price' => '45000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '高性能なノートパソコン',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['家電'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/マイク.jpg');
        $dummyImage = 'products/マイク.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','目立った傷や汚れなし')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'マイク',
            'image' => $dummyImage,
            'brand' => 'なし',
            'price' => '5000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '高音質のレコーディング用マイク',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['家電'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/ショルダーバック.jpg');
        $dummyImage = 'products/ショルダーバック.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','やや傷や汚れあり')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'ショルダーバック',
            'image' => $dummyImage,
            'price' => '3500',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => 'おしゃれなショルダーバック',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['ファッション','レディース'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/タンブラー.jpg');
        $dummyImage = 'products/タンブラー.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','状態が悪い')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'タンブラー',
            'image' => $dummyImage,
            'brand' => 'なし',
            'price' => '500',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '使いやすいタンブラー',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['キッチン'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/コーヒーミル.jpg');
        $dummyImage = 'products/コーヒーミル.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));
        $conditionId = Condition::where('content','良好')->value('id');
        $product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'コーヒーミル',
            'image' => $dummyImage,
            'brand' => 'Starbacks',
            'price' => '4000',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '手動のコーヒーミル',
            'condition_id' => 1,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['キッチン'])->pluck('id');
        $product->categories()->attach($categories);

        $path = public_path('img/メイクセット.jpg');
        $dummyImage = 'products/メイクセット.jpg';
        File::copy($path,storage_path('app/public/' . $dummyImage));$product = Product::create([
            'user_id' => $test_user->id,
            'name' => 'メイクセット',
            'image' => $dummyImage,
            'price' => '2500',
            'number_of_like' => 0,
            'number_of_comment' => 0,
            'description' => '便利なメイクアップセット',
            'condition_id' => $conditionId,
            'status' => 1
        ]);
        $categories = Category::whereIn('content',['レディース','コスメ'])->pluck('id');
        $product->categories()->attach($categories);
    }
}
