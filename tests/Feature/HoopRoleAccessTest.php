<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class HoopRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    private function client(array $attributes = []): User
    {
        return User::factory()->create(['role' => 'client'] + $attributes);
    }

    private function admin(array $attributes = []): User
    {
        return User::factory()->create(['role' => 'admin'] + $attributes);
    }

    private function assertNoStore(TestResponse $response): void
    {
        $response->assertHeader('Cache-Control');
        $this->assertStringContainsString(
            'no-store',
            (string) $response->headers->get('Cache-Control')
        );
    }

    // ----------------------------------------------------------------
    // Guests (logged out) must be sent to the login page
    // ----------------------------------------------------------------

    public function test_guests_cannot_open_admin_pages(): void
    {
        $this->get(route('hoop.admin.dashboard'))->assertRedirect(route('hoop.login'));
        $this->get(route('hoop.admin.products'))->assertRedirect(route('hoop.login'));
        $this->get(route('hoop.admin.customers'))->assertRedirect(route('hoop.login'));
        $this->get(route('hoop.admin.orders'))->assertRedirect(route('hoop.login'));
    }

    public function test_guests_cannot_open_client_pages(): void
    {
        $this->get(route('hoop.dashboard'))->assertRedirect(route('hoop.login'));
        $this->get(route('hoop.checkout'))->assertRedirect(route('hoop.login'));
        $this->get(route('hoop.orders'))->assertRedirect(route('hoop.login'));
    }

    public function test_guests_cannot_open_shared_account_pages(): void
    {
        $this->get(route('hoop.profile'))->assertRedirect(route('hoop.login'));
    }

    // ----------------------------------------------------------------
    // Clients cannot enter the admin area
    // ----------------------------------------------------------------

    public function test_clients_are_redirected_away_from_admin_pages(): void
    {
        $client = $this->client();

        $this->actingAs($client)
            ->get(route('hoop.admin.dashboard'))
            ->assertRedirect(route('hoop-shop'));

        $this->actingAs($client)
            ->get(route('hoop.admin.products'))
            ->assertRedirect(route('hoop-shop'));

        $this->actingAs($client)
            ->get(route('hoop.admin.customers'))
            ->assertRedirect(route('hoop-shop'));

        $this->actingAs($client)
            ->get(route('hoop.admin.orders'))
            ->assertRedirect(route('hoop-shop'));
    }

    // ----------------------------------------------------------------
    // Admins cannot enter the customer-only area
    // ----------------------------------------------------------------

    public function test_admins_are_redirected_away_from_client_pages(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->get(route('hoop.dashboard'))
            ->assertRedirect(route('hoop.admin.dashboard'));

        $this->actingAs($admin)
            ->get(route('hoop.checkout'))
            ->assertRedirect(route('hoop.admin.dashboard'));

        $this->actingAs($admin)
            ->get(route('hoop.orders'))
            ->assertRedirect(route('hoop.admin.dashboard'));
    }

    // ----------------------------------------------------------------
    // Admins and clients can both reach their own pages
    // ----------------------------------------------------------------

    public function test_admin_can_open_admin_dashboard(): void
    {
        $response = $this->actingAs($this->admin())
            ->get(route('hoop.admin.dashboard'));

        $response->assertOk();
        $this->assertNoStore($response);
    }

    public function test_client_can_open_own_orders_and_profile(): void
    {
        $client = $this->client();

        $response = $this->actingAs($client)->get(route('hoop.orders'));
        $response->assertOk();
        $this->assertNoStore($response);

        $response = $this->actingAs($client)->get(route('hoop.profile'));
        $response->assertOk();
        $this->assertNoStore($response);
    }

    public function test_admin_can_edit_own_profile(): void
    {
        $response = $this->actingAs($this->admin())->get(route('hoop.profile'));

        $response->assertOk();
        $this->assertNoStore($response);
    }

    // ----------------------------------------------------------------
    // After logging out, protected pages require login again
    // ----------------------------------------------------------------

    public function test_protected_pages_require_login_after_logout(): void
    {
        $client = $this->client();

        $this->actingAs($client)
            ->post(route('hoop.logout'))
            ->assertRedirect(route('hoop-shop'));

        $this->get(route('hoop.orders'))->assertRedirect(route('hoop.login'));
        $this->get(route('hoop.profile'))->assertRedirect(route('hoop.login'));

        $admin = $this->admin();
        $this->actingAs($admin)
            ->post(route('hoop.admin.logout'))
            ->assertRedirect(route('hoop.login'));

        $this->get(route('hoop.admin.dashboard'))->assertRedirect(route('hoop.login'));
    }
}
