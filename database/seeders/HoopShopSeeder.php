<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HoopShopSeeder extends Seeder
{
    /**
     * Seed the Hoop Shop with an admin account and basketball apparel.
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

        $products = [
            // ---------- Jerseys ----------
            ['name' => 'Home Jersey - Custom Name & Number', 'description' => 'Breathable mesh basketball jersey. Add your name and number for a personalized fit.', 'price' => 549.00, 'stock' => 50],
            ['name' => 'Away Jersey - Custom Name & Number', 'description' => 'Same premium mesh as our home jersey in a contrasting away colorway.', 'price' => 549.00, 'stock' => 45],
            ['name' => 'Reversible Practice Jersey', 'description' => 'Two-in-one scrimmage jersey with a contrasting inner layer for team drills.', 'price' => 480.00, 'stock' => 25],
            ['name' => 'Youth Basketball Jersey', 'description' => 'Lightweight youth-sized jersey that is easy to move in and built to last the season.', 'price' => 429.00, 'stock' => 35],
            ['name' => 'Pro Stitched Swingman Jersey', 'description' => 'Premium stitched letters and numbers on a moisture-wicking pro-cut body.', 'price' => 1299.00, 'stock' => 18],
            ['name' => 'Retro Throwback Jersey', 'description' => 'Vintage 90s-style jersey with bold colors and a loose, comfortable cut.', 'price' => 999.00, 'stock' => 20],
            ['name' => 'Sublimated Team Jersey', 'description' => 'All-over sublimated design that never fades, cracks, or peels.', 'price' => 699.00, 'stock' => 30],
            ['name' => 'Mesh Shooting Shirt', 'description' => 'Lightweight pullover shooting shirt worn over your jersey for warm-ups.', 'price' => 599.00, 'stock' => 22],

            // ---------- Shorts ----------
            ['name' => 'Pro Basketball Shorts', 'description' => 'Lightweight quick-dry shorts with elastic waistband and side slits for full range of motion.', 'price' => 399.00, 'stock' => 40],
            ['name' => 'Reversible Practice Shorts', 'description' => 'Flip between two team colors without changing your whole uniform.', 'price' => 349.00, 'stock' => 30],
            ['name' => 'Compression Shorts', 'description' => 'Snug 7-inch compression shorts that reduce muscle fatigue during play.', 'price' => 449.00, 'stock' => 26],
            ['name' => 'Cargo Training Shorts', 'description' => 'Zippered cargo pockets keep your phone and keys secure during training.', 'price' => 499.00, 'stock' => 24],
            ['name' => 'Game-Day Elite Shorts', 'description' => 'Tailored pro-fit shorts with double-layer mesh for breathability.', 'price' => 550.00, 'stock' => 20],
            ['name' => 'Mesh Practice Shorts', 'description' => 'Affordable mesh shorts built for daily scrimmages and open runs.', 'price' => 329.00, 'stock' => 38],

            // ---------- Shoes ----------
            ['name' => 'High-Top Basketball Shoes', 'description' => 'Ankle-supporting high-tops with cushioned sole for indoor and outdoor play.', 'price' => 2499.00, 'stock' => 15],
            ['name' => 'Low-Cut Court Shoes', 'description' => 'Feather-light low-cuts with responsive cushioning for quick guards.', 'price' => 2199.00, 'stock' => 12],
            ['name' => 'Mid-Cut All-Court Shoes', 'description' => 'Balanced mid-cut support with a grippy herringbone outsole.', 'price' => 2299.00, 'stock' => 14],
            ['name' => 'Training & Run Shoes', 'description' => 'Multi-sport trainer for conditioning drills, sprints, and gym work.', 'price' => 1999.00, 'stock' => 16],
            ['name' => 'Kids Basketball Shoes', 'description' => 'Durable, easy-to-wear shoes sized for young ballers.', 'price' => 1499.00, 'stock' => 18],
            ['name' => 'Slip-On Court Sneakers', 'description' => 'Lace-free slip-ons for fast transitions between bench and court.', 'price' => 1799.00, 'stock' => 10],

            // ---------- Socks ----------
            ['name' => 'Basketball Crew Socks (3-Pack)', 'description' => 'Cushioned crew socks with arch support — perfect for training and game days.', 'price' => 299.00, 'stock' => 60],
            ['name' => 'No-Show Low-Cut Socks (5-Pack)', 'description' => 'Invisible-fit low socks that stay put inside your shoes.', 'price' => 249.00, 'stock' => 55],
            ['name' => 'Ankle Compression Socks', 'description' => 'Graduated compression for better blood flow during long sessions.', 'price' => 259.00, 'stock' => 48],
            ['name' => 'Knee-High Game Socks', 'description' => 'Classic knee-high game socks with a padded footbed.', 'price' => 279.00, 'stock' => 42],
            ['name' => 'Quarter Performance Socks', 'description' => 'Moisture-wicking quarter socks with reinforced heel and toe.', 'price' => 199.00, 'stock' => 65],

            // ---------- Balls ----------
            ['name' => 'Official Size 7 Game Ball', 'description' => 'FIBA-grade composite leather ball with deep channels for better grip.', 'price' => 1499.00, 'stock' => 20],
            ['name' => 'Size 5 Youth Ball', 'description' => 'Lighter, smaller ball sized for ages 9-11 learning the game.', 'price' => 899.00, 'stock' => 25],
            ['name' => 'Indoor/Outdoor Rubber Ball', 'description' => 'Tough rubber cover that stands up to concrete courts.', 'price' => 799.00, 'stock' => 28],
            ['name' => 'Mini Basketball (Souvenir)', 'description' => 'Mini hoops ball — great for desks, displays, and collecting.', 'price' => 399.00, 'stock' => 40],

            // ---------- Training Tops ----------
            ['name' => 'Compression Long Sleeve Shirt', 'description' => 'Moisture-wicking compression top that keeps you cool and dry during the game.', 'price' => 650.00, 'stock' => 30],
            ['name' => 'Compression Short Sleeve Tee', 'description' => 'Second-skin fit tee for layering under jerseys or solo gym sessions.', 'price' => 499.00, 'stock' => 32],
            ['name' => 'Dri-Fit Training Tank Top', 'description' => 'Sleeveless tank with open armholes for unrestricted shooting motion.', 'price' => 449.00, 'stock' => 34],
            ['name' => 'Practice Tee - Crew Neck', 'description' => 'Soft crew-neck practice tee for everyday drills and workouts.', 'price' => 399.00, 'stock' => 45],
            ['name' => 'Hooded Training Top', 'description' => 'Warm hooded pullover for pre-game warm-ups and cool mornings.', 'price' => 899.00, 'stock' => 18],

            // ---------- Outerwear ----------
            ['name' => 'Basketball Warm-Up Jacket', 'description' => 'Full-zip windbreaker-style jacket with team colors and cuffed sleeves.', 'price' => 1199.00, 'stock' => 15],
            ['name' => 'Track Pants', 'description' => 'Tapered track pants with elastic cuffs and zip pockets.', 'price' => 899.00, 'stock' => 22],
            ['name' => 'Reversible Warm-Up Suit Set', 'description' => 'Jacket and pants set that reverses between two colors.', 'price' => 1899.00, 'stock' => 10],

            // ---------- Accessories ----------
            ['name' => 'Headband (2-Pack)', 'description' => 'Sweat-wicking terry headbands that stay in place.', 'price' => 149.00, 'stock' => 70],
            ['name' => 'Wristbands (2-Pack)', 'description' => 'Classic absorbent wristbands for wiping sweat mid-play.', 'price' => 149.00, 'stock' => 70],
            ['name' => 'Knee Sleeve - Single', 'description' => 'Open-patella support sleeve for knees under stress.', 'price' => 249.00, 'stock' => 50],
            ['name' => 'Ankle Brace Support', 'description' => 'Figure-eight style ankle brace for sprain protection.', 'price' => 349.00, 'stock' => 30],
            ['name' => 'Shooting Sleeve', 'description' => 'Compression arm sleeve that keeps your shooting arm warm.', 'price' => 199.00, 'stock' => 55],
            ['name' => 'Finger Sleeve (3-Pack)', 'description' => 'Protects fingers from jams and bruises during rebounding.', 'price' => 179.00, 'stock' => 60],
            ['name' => 'Basketball Water Bottle', 'description' => 'Leak-proof 750ml squeeze bottle with a carry loop.', 'price' => 249.00, 'stock' => 40],
            ['name' => 'Microfiber Towel - Hoop Design', 'description' => 'Compact quick-dry towel with a basketball print.', 'price' => 199.00, 'stock' => 35],
            ['name' => 'Compression Arm Sleeves (2-Pack)', 'description' => 'UV-protective compression sleeves for outdoor courts.', 'price' => 299.00, 'stock' => 40],

            // ---------- Bags & Caps ----------
            ['name' => 'Team Duffel Bag', 'description' => 'Spacious duffel with a separate ventilated shoe compartment.', 'price' => 1299.00, 'stock' => 12],
            ['name' => 'Backpack - Ball Compartment', 'description' => 'Carry your ball, shoes, and gear in one organized backpack.', 'price' => 999.00, 'stock' => 15],
            ['name' => 'Ball Carry Net', 'description' => 'Classic mesh net that keeps your ball at your side.', 'price' => 349.00, 'stock' => 30],
            ['name' => 'Snapback Cap - Hoop Logo', 'description' => 'Adjustable snapback with embroidered hoop logo.', 'price' => 449.00, 'stock' => 25],
        ];

        foreach ($products as $item) {
            $photo = $item['photo'] ?? sprintf('https://picsum.photos/seed/%s/640/640', Str::slug($item['name']));

            $existing = Product::where('name', $item['name'])->first();

            if ($existing) {
                // Refresh details but keep a custom photo if the admin already uploaded one.
                $existing->update([
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'photo' => $existing->photo ?: $photo,
                ]);
            } else {
                Product::create($item + ['photo' => $photo]);
            }
        }
    }
}
