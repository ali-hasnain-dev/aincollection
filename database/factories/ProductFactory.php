<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = ProductCategory::where('parent_id', '!=', null)->first();
        return [
            'name' => fake()->unique()->name(),
            'slug' => fake()->unique()->slug(),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(100, 1000),
            'sale_price' => fake()->numberBetween(100, 1000),
            'cost_per_piece' => fake()->numberBetween(100, 1000),
            'image' => fake()->imageUrl(),
            'product_category_id' => $category->id,
            'stock' => fake()->numberBetween(1, 100),
            'allowed_quantity' => fake()->numberBetween(1, 100),
            'is_visible' => 1,
            'sku' => fake()->unique()->numberBetween(1, 100),
            'created_by' => 1
        ];
    }
}