<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HoopShopSeeder extends Seeder
{
    /**
     * Seed HoopShop with admin account and basketball products.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin Account
        |--------------------------------------------------------------------------
        */

        User::updateOrCreate(
            ['email' => 'admin@hoopshop.com'],
            [
                'name' => 'Hoop Shop Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        $products = [

            // ==============================================================
            // JERSEYS
            // ==============================================================

            [
                'name' => 'Home Jersey - Custom Name & Number',
                'description' => 'Breathable mesh basketball jersey with customizable name and number.',
                'price' => 549.00,
                'stock' => 50,
                'photo' => 'https://images.pexels.com/photos/34917397/pexels-photo-34917397.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Away Basketball Jersey',
                'description' => 'Lightweight away jersey designed for comfortable game-day performance.',
                'price' => 499.00,
                'stock' => 45,
                'photo' => 'https://images.pexels.com/photos/38398244/pexels-photo-38398244.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Reversible Practice Jersey',
                'description' => 'Two-sided reversible jersey ideal for basketball practices and scrimmages.',
                'price' => 599.00,
                'stock' => 35,
                'photo' => 'https://images.pexels.com/photos/38398236/pexels-photo-38398236.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Youth Basketball Jersey',
                'description' => 'Comfortable basketball jersey made for young players.',
                'price' => 399.00,
                'stock' => 40,
                'photo' => 'https://images.pexels.com/photos/39228514/pexels-photo-39228514.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Pro Stitched Swingman Jersey',
                'description' => 'Premium stitched basketball jersey with a professional-inspired design.',
                'price' => 899.00,
                'stock' => 25,
                'photo' => 'https://images.pexels.com/photos/13234760/pexels-photo-13234760.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Retro Throwback Jersey',
                'description' => 'Classic-inspired basketball jersey featuring a retro look.',
                'price' => 749.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/20613103/pexels-photo-20613103.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Sublimated Team Jersey',
                'description' => 'Full sublimated team jersey suitable for basketball leagues and tournaments.',
                'price' => 649.00,
                'stock' => 50,
                'photo' => 'https://images.pexels.com/photos/3776963/pexels-photo-3776963.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Mesh Shooting Shirt',
                'description' => 'Lightweight mesh shooting shirt for warm-ups and training.',
                'price' => 449.00,
                'stock' => 35,
                'photo' => 'https://images.pexels.com/photos/8979887/pexels-photo-8979887.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // SHORTS
            // ==============================================================

            [
                'name' => 'Pro Basketball Shorts',
                'description' => 'Lightweight basketball shorts with breathable fabric and flexible fit.',
                'price' => 449.00,
                'stock' => 50,
                'photo' => 'https://images.pexels.com/photos/12882017/pexels-photo-12882017.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Reversible Practice Shorts',
                'description' => 'Reversible practice shorts designed for training and scrimmages.',
                'price' => 499.00,
                'stock' => 40,
                'photo' => 'https://images.pexels.com/photos/8337266/pexels-photo-8337266.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Compression Shorts',
                'description' => 'Stretch compression shorts providing support during intense activities.',
                'price' => 349.00,
                'stock' => 45,
                'photo' => 'https://images.pexels.com/photos/8695271/pexels-photo-8695271.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Cargo Training Shorts',
                'description' => 'Durable training shorts with a practical athletic design.',
                'price' => 399.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/18991014/pexels-photo-18991014.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Game-Day Elite Shorts',
                'description' => 'Premium basketball shorts made for competitive game-day performance.',
                'price' => 549.00,
                'stock' => 25,
                'photo' => 'https://images.pexels.com/photos/8980125/pexels-photo-8980125.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Mesh Practice Shorts',
                'description' => 'Breathable mesh shorts designed for everyday basketball training.',
                'price' => 379.00,
                'stock' => 45,
                'photo' => 'https://images.pexels.com/photos/8337302/pexels-photo-8337302.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // SHOES
            // ==============================================================

            [
                'name' => 'High-Top Basketball Shoes',
                'description' => 'High-top basketball shoes designed for stability and court movement.',
                'price' => 2499.00,
                'stock' => 20,
                'photo' => 'https://images.pexels.com/photos/10942730/pexels-photo-10942730.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Low-Cut Court Shoes',
                'description' => 'Lightweight low-cut basketball shoes for quick movements.',
                'price' => 2299.00,
                'stock' => 25,
                'photo' => 'https://images.pexels.com/photos/4695156/pexels-photo-4695156.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Mid-Cut All-Court Shoes',
                'description' => 'Versatile mid-cut shoes suitable for indoor and outdoor basketball courts.',
                'price' => 2399.00,
                'stock' => 20,
                'photo' => 'https://images.pexels.com/photos/39301567/pexels-photo-39301567.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Training & Run Shoes',
                'description' => 'Multi-purpose athletic shoes for basketball training and running.',
                'price' => 1999.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Kids Basketball Shoes',
                'description' => 'Comfortable basketball shoes designed for young players.',
                'price' => 1599.00,
                'stock' => 25,
                'photo' => 'https://images.pexels.com/photos/15693841/pexels-photo-15693841.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Slip-On Court Sneakers',
                'description' => 'Easy-to-wear court sneakers with a lightweight athletic design.',
                'price' => 1399.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/4053668/pexels-photo-4053668.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // SOCKS
            // ==============================================================

            [
                'name' => 'Performance Basketball Socks',
                'description' => 'Breathable athletic socks designed for basketball players.',
                'price' => 199.00,
                'stock' => 80,
                'photo' => 'https://images.pexels.com/photos/5746098/pexels-photo-5746098.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Athletic Sports Socks',
                'description' => 'Comfortable sports socks suitable for training and everyday use.',
                'price' => 179.00,
                'stock' => 75,
                'photo' => 'https://images.pexels.com/photos/7318754/pexels-photo-7318754.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Compression Sports Socks',
                'description' => 'Supportive compression socks designed for active athletes.',
                'price' => 249.00,
                'stock' => 60,
                'photo' => 'https://images.pexels.com/photos/7238948/pexels-photo-7238948.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Basketball Crew Socks',
                'description' => 'Classic crew socks with a comfortable basketball-inspired design.',
                'price' => 189.00,
                'stock' => 70,
                'photo' => 'https://images.pexels.com/photos/5746037/pexels-photo-5746037.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Premium Athletic Socks',
                'description' => 'Soft and durable athletic socks for everyday basketball sessions.',
                'price' => 229.00,
                'stock' => 65,
                'photo' => 'https://images.pexels.com/photos/5746026/pexels-photo-5746026.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // BASKETBALLS
            // ==============================================================

            [
                'name' => 'Official Size Basketball',
                'description' => 'Official-size basketball designed for competitive play and training.',
                'price' => 899.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/12954258/pexels-photo-12954258.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Indoor Outdoor Basketball',
                'description' => 'Durable basketball suitable for both indoor and outdoor courts.',
                'price' => 799.00,
                'stock' => 35,
                'photo' => 'https://images.pexels.com/photos/26705108/pexels-photo-26705108.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Court Training Basketball',
                'description' => 'Reliable basketball for everyday drills and practice sessions.',
                'price' => 699.00,
                'stock' => 40,
                'photo' => 'https://images.pexels.com/photos/8084767/pexels-photo-8084767.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Mini Basketball',
                'description' => 'Compact mini basketball suitable for casual play and beginners.',
                'price' => 399.00,
                'stock' => 45,
                'photo' => 'https://images.pexels.com/photos/10913962/pexels-photo-10913962.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // TRAINING TOPS
            // ==============================================================

            [
                'name' => 'Basketball Compression Shirt',
                'description' => 'Stretch compression shirt designed for basketball training.',
                'price' => 499.00,
                'stock' => 40,
                'photo' => 'https://images.pexels.com/photos/16085236/pexels-photo-16085236.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Performance Compression Top',
                'description' => 'Athletic compression top providing a fitted training feel.',
                'price' => 549.00,
                'stock' => 35,
                'photo' => 'https://images.pexels.com/photos/20110495/pexels-photo-20110495.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Basketball Tank Top',
                'description' => 'Sleeveless athletic top for basketball workouts and training.',
                'price' => 399.00,
                'stock' => 45,
                'photo' => 'https://images.pexels.com/photos/20400632/pexels-photo-20400632.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Training Performance Shirt',
                'description' => 'Lightweight training shirt for workouts and basketball practice.',
                'price' => 449.00,
                'stock' => 40,
                'photo' => 'https://images.pexels.com/photos/8554993/pexels-photo-8554993.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Training Pullover Hoodie',
                'description' => 'Comfortable athletic hoodie for warm-ups and outdoor training.',
                'price' => 699.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/16976087/pexels-photo-16976087.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // OUTERWEAR
            // ==============================================================

            [
                'name' => 'Basketball Warm-Up Jacket',
                'description' => 'Lightweight warm-up jacket designed for pre-game sessions.',
                'price' => 899.00,
                'stock' => 25,
                'photo' => 'https://images.pexels.com/photos/11000094/pexels-photo-11000094.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Sports Track Pants',
                'description' => 'Comfortable athletic track pants for training and warm-ups.',
                'price' => 749.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/3207453/pexels-photo-3207453.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Basketball Warm-Up Suit',
                'description' => 'Complete warm-up outfit designed for teams and athletes.',
                'price' => 1299.00,
                'stock' => 20,
                'photo' => 'https://images.pexels.com/photos/3764534/pexels-photo-3764534.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // ACCESSORIES
            // ==============================================================

            [
                'name' => 'Performance Headband',
                'description' => 'Sweat-wicking athletic headband for basketball sessions.',
                'price' => 149.00,
                'stock' => 80,
                'photo' => 'https://images.pexels.com/photos/5275252/pexels-photo-5275252.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Basketball Wristbands',
                'description' => 'Comfortable wristbands designed to help manage sweat during games.',
                'price' => 129.00,
                'stock' => 80,
                'photo' => 'https://images.pexels.com/photos/1103829/pexels-photo-1103829.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Knee Compression Sleeve',
                'description' => 'Stretch knee sleeve designed for athletic support and comfort.',
                'price' => 249.00,
                'stock' => 50,
                'photo' => 'https://images.pexels.com/photos/38121344/pexels-photo-38121344.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Ankle Support Sleeve',
                'description' => 'Lightweight ankle support sleeve for training and court activities.',
                'price' => 229.00,
                'stock' => 50,
                'photo' => 'https://images.pexels.com/photos/7991959/pexels-photo-7991959.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Basketball Arm Sleeve',
                'description' => 'Athletic arm sleeve designed for basketball players.',
                'price' => 199.00,
                'stock' => 60,
                'photo' => 'https://images.pexels.com/photos/7322505/pexels-photo-7322505.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Finger Compression Sleeve',
                'description' => 'Lightweight finger sleeve for added comfort during basketball activities.',
                'price' => 99.00,
                'stock' => 70,
                'photo' => 'https://images.pexels.com/photos/6203700/pexels-photo-6203700.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Sports Water Bottle',
                'description' => 'Reusable sports water bottle for training and game days.',
                'price' => 249.00,
                'stock' => 50,
                'photo' => 'https://images.pexels.com/photos/5274535/pexels-photo-5274535.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Microfiber Sports Towel',
                'description' => 'Quick-drying microfiber towel for workouts and basketball games.',
                'price' => 179.00,
                'stock' => 60,
                'photo' => 'https://images.pexels.com/photos/6455950/pexels-photo-6455950.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Compression Arm Sleeve',
                'description' => 'Stretch compression sleeve suitable for basketball and training.',
                'price' => 219.00,
                'stock' => 55,
                'photo' => 'https://images.pexels.com/photos/18003717/pexels-photo-18003717.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            // ==============================================================
            // BAGS & CAPS
            // ==============================================================

            [
                'name' => 'Basketball Duffel Bag',
                'description' => 'Spacious sports duffel bag for shoes, jerseys, and training gear.',
                'price' => 899.00,
                'stock' => 25,
                'photo' => 'https://images.pexels.com/photos/5384401/pexels-photo-5384401.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Basketball Training Backpack',
                'description' => 'Athletic backpack designed for carrying basketball essentials.',
                'price' => 999.00,
                'stock' => 25,
                'photo' => 'https://images.pexels.com/photos/6764357/pexels-photo-6764357.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Basketball Ball Bag',
                'description' => 'Dedicated ball bag for convenient basketball transport.',
                'price' => 499.00,
                'stock' => 30,
                'photo' => 'https://images.pexels.com/photos/8554900/pexels-photo-8554900.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],

            [
                'name' => 'Sports Snapback Cap',
                'description' => 'Classic snapback cap with a sporty basketball-inspired style.',
                'price' => 299.00,
                'stock' => 45,
                'photo' => 'https://images.pexels.com/photos/6963097/pexels-photo-6963097.jpeg?auto=compress&cs=tinysrgb&w=800&h=800&fit=crop',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Insert / Update Products
        |--------------------------------------------------------------------------
        */

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Success Message
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            'HoopShop seeded successfully: '
            . count($products)
            . ' products.'
        );
    }
}
