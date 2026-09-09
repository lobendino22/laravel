<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class HoopShopSeeder extends Seeder
{
    /**
     * Seed the Hoop Shop with an admin account and sample basketball apparel.
     */
    public function run(): void
    {
        // Admin account (idempotent)
        if (! User::where('email', 'admin@hoopshop.com')->exists()) {
            User::create([
                'name' => 'Hoop Shop Admin',
                'email' => 'admin@hoopshop.com',
                'password' => 'admin123',
                'role' => 'admin',
            ]);
        }

        // Sample basketball apparel products (only when the table is empty)
        if (Product::count() === 0) {
            $products = [
                [
                    'name' => 'Home Jersey - Custom Name & Number',
                    'description' => 'Breathable mesh basketball jersey. Add your name and number for a personalized fit.',
                    'price' => 549.00,
                    'stock' => 50,
                    'photo' => null,
                ],
                [
                    'name' => 'Pro Basketball Shorts',
                    'description' => 'Lightweight quick-dry shorts with elastic waistband and side slits for full range of motion.',
                    'price' => 399.00,
                    'stock' => 40,
                    'photo' => null,
                ],
                [
                    'name' => 'High-Top Basketball Shoes',
                    'description' => 'Ankle-supporting high-tops with cushioned sole for indoor and outdoor play.',
                    'price' => 2499.00,
                    'stock' => 15,
                    'photo' => null,
                ],
                [
                    'name' => 'Compression Long Sleeve Shirt',
                    'description' => 'Moisture-wicking compression top that keeps you cool and dry during the game.',
                    'price' => 650.00,
                    'stock' => 30,
                    'photo' => null,
                ],
                [
                    'name' => 'Basketball Crew Socks (3-Pack)',
                    'description' => 'Cushioned crew socks with arch support — perfect for training and game days.',
                    'price' => 299.00,
                    'stock' => 60,
                    'photo' => null,
                ],
                [
                    'name' => 'Reversible Practice Jersey',
                    'description' => 'Two-in-one scrimmage jersey with a contrasting inner layer for team drills.',
                    'price' => 480.00,
                    'stock' => 25,
                    'photo' => null,
                ],
            ];

            foreach ($products as $product) {
                Product::create($product);
            }
        }
    }
}