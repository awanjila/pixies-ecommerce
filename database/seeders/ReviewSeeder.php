<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Retrieve product IDs from the products table
        $productIds = \App\Models\Product::pluck('id')->toArray();

        // Seed reviews for each product
        foreach ($productIds as $productId) {
            Review::create([
                'product_id' => $productId,
                'user_name' => 'John Doe',
                'rating' => rand(1, 5), // Random rating between 1 and 5
                'review_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ]);

            // You can add more reviews or customize the data as needed
        }
    }
}