<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Group;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $rootGroups = Group::factory()->count(5)->create(['id_parent' => null]);

        foreach ($rootGroups as $rootGroup) {
            $subGroupCount = random_int(1, 5);
            $subGroups = Group::factory()->count($subGroupCount)->create(['id_parent' => $rootGroup->id]);
            foreach ($subGroups as $subGroup) {
                $productCount = random_int(1, 10);
                $products = Product::factory()->count($productCount)->create(['id_group' => $subGroup->id]);
                foreach ($products as $product) {
                    Price::factory()->create(['id_product' => $product->id]);
                }
            }
        }
    }


}
