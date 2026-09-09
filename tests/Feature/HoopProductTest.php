<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\HoopShopSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class HoopProductTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    private function productPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Test Jersey',
            'description' => 'A test product.',
            'price' => 500.00,
            'stock' => 10,
        ], $overrides);
    }

    public function test_admin_can_save_product_with_external_image_url(): void
    {
        $this->actingAs($this->admin())
            ->post(route('hoop.admin.products.store'), $this->productPayload([
                'image_url' => 'https://images.example.com/jersey.jpg',
            ]))
            ->assertRedirect(route('hoop.admin.products'));

        $this->assertDatabaseHas('products', [
            'name' => 'Test Jersey',
            'photo' => 'https://images.example.com/jersey.jpg',
        ]);
    }

    public function test_product_image_url_must_be_a_valid_url(): void
    {
        $this->actingAs($this->admin())
            ->post(route('hoop.admin.products.store'), $this->productPayload([
                'image_url' => 'not a valid url',
            ]))
            ->assertSessionHasErrors('image_url');

        $this->assertDatabaseMissing('products', ['name' => 'Test Jersey']);
    }

    public function test_admin_can_save_product_with_uploaded_image(): void
    {
        $file = UploadedFile::fake()->image('jersey.png', 100, 100);

        $this->actingAs($this->admin())
            ->post(route('hoop.admin.products.store'), $this->productPayload([
                'image_source' => 'upload',
                'photo' => $file,
            ]), ['Content-Type' => 'multipart/form-data'])
            ->assertRedirect(route('hoop.admin.products'));

        $product = Product::where('name', 'Test Jersey')->first();

        $this->assertNotNull($product);
        $this->assertNotNull($product->photo);
        $this->assertStringStartsWith('product_', $product->photo);
        $this->assertStringStartsWith(asset('_uploads/'), $product->photo_url);
    }

    public function test_editing_without_touching_image_keeps_the_photo(): void
    {
        $product = Product::create([
            'name' => 'Keep Me',
            'description' => 'x',
            'price' => 100,
            'stock' => 5,
            'photo' => 'https://images.example.com/original.jpg',
        ]);

        $this->actingAs($this->admin())
            ->put(route('hoop.admin.products.update', $product->id), $this->productPayload([
                'name' => 'Keep Me',
                'price' => 150,
            ]))
            ->assertRedirect(route('hoop.admin.products'));

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'price' => 150.00,
            'photo' => 'https://images.example.com/original.jpg',
        ]);
    }

    public function test_shop_seeder_seeds_fifty_products_idempotently(): void
    {
        $this->seed(HoopShopSeeder::class);

        $this->assertSame(50, Product::count());

        // Running it again must not create duplicates.
        $this->seed(HoopShopSeeder::class);
        $this->assertSame(50, Product::count());
        $this->assertSame(50, Product::distinct('name')->count('name'));
    }
}
