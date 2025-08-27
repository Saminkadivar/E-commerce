<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        $vendors = User::where('role', 'vendor')->get();
        $categories = Category::all();

        foreach ($vendors as $vendor) {
            foreach ($categories as $category) {
                Product::create([
                    'vendor_id' => $vendor->id,
                    'name' => $category->name . ' Product ' . $vendor->id,
                    'description' => 'Sample description for ' . $category->name,
                    'price' => rand(100, 1000),
                    'stock' => rand(10, 50),
                    'category_id' => $category->id,
                    'image_path' => 'products/default.jpeg',
                ]);
            }
        }
    }
}
