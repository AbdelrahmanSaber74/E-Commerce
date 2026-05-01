<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\MainCategories;
use Illuminate\Database\Seeder;

class EnterpriseDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Main Categories first
        $mainCats = [
            ['name' => 'Technology', 'image' => 'https://picsum.photos/seed/tech/800/600'],
            ['name' => 'Lifestyle', 'image' => 'https://picsum.photos/seed/life/800/600'],
        ];

        foreach ($mainCats as $mc) {
            $mainCategory = MainCategories::create([
                'name' => $mc['name'],
                'image' => $mc['image']
            ]);

            // 2. Create Sub-Categories for each Main Category
            $subCats = $mc['name'] === 'Technology' 
                ? ['Electronics', 'Computing', 'Smart Home']
                : ['Fashion', 'Beauty', 'Sports'];

            foreach ($subCats as $subName) {
                $category = Category::create([
                    'name' => $subName,
                    'image' => "https://picsum.photos/seed/{$subName}/800/600",
                    'parent_id' => $mainCategory->id
                ]);

                // 3. Create Products for each Sub-Category
                for ($i = 1; $i <= 3; $i++) {
                    Product::create([
                        'name' => $subName . " Premium Item " . $i,
                        'description' => "Experience the best of {$subName} with our premium collection. Durable, stylish, and highly rated.",
                        'image' => "https://picsum.photos/seed/" . uniqid() . "/800/800",
                        'price' => rand(200, 4500),
                        'discount_price' => rand(1, 10) > 7 ? rand(150, 1500) : null,
                        'category_id' => $category->id,
                        'status' => 1
                    ]);
                }
            }
        }
    }
}
