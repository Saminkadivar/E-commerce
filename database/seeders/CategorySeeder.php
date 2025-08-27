<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Category::truncate();

        Schema::enableForeignKeyConstraints();

        $categories = ['Clothing', 'Electronics', 'Toys', 'Books', 'Baby Products', 'Jewelry'];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'status' => 1,
            ]);
        }
    }
}
