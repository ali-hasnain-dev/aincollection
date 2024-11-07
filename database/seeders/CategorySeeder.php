<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ProductCategory::create([
            'name' => 'Soap',
            'slug' => 'soap',
            'status' => true,
            'created_by' => 1
        ]);

        ProductCategory::create([
            'name' => 'Bath Soap',
            'slug' => 'bath-soap',
            'status' => true,
            'parent_id' => $category->id,
            'created_by' => 1
        ]);
    }
}