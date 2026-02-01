<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user list page loads
     */
    public function test_user_list_page_loads_successfully()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    /**
     * Test user can be created
     */
    public function test_user_can_be_created()
    {
        $response = $this->post('/users', [
            'name' => 'Gaurav Patil',
            'email' => 'gaurav@test.com',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'email' => 'gaurav@test.com'
        ]);

        $user = User::first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /**
     * Test validation errors on create
     */
    public function test_validation_errors_when_creating_user()
    {
        $response = $this->post('/users', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123'
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /**
     * Test user can be updated
     */
    public function test_user_can_be_updated()
    {
        $user = User::create([
            'name' => 'Old Name',
            'email' => 'old@test.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post("/users/{$user->id}/update", [
            'name' => 'New Name',
            'email' => 'new@test.com'
        ]);

        $response->assertRedirect('/users');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Name',
            'email' => 'new@test.com'
        ]);
    }

    /**
     * Test email must be unique on update
     */
    public function test_email_must_be_unique_on_update()
    {
        $user1 = User::create([
            'name' => 'User One',
            'email' => 'one@test.com',
            'password' => bcrypt('password123')
        ]);

        $user2 = User::create([
            'name' => 'User Two',
            'email' => 'two@test.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post("/users/{$user2->id}/update", [
            'name' => 'User Two',
            'email' => 'one@test.com'
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Test cache is cleared on create
     */
    public function test_cache_is_cleared_on_user_create()
    {
        Cache::put('users_cache', 'cached-data', 600);

        $this->post('/users', [
            'name' => 'Cache Test',
            'email' => 'cache@test.com',
            'password' => 'password123'
        ]);

        $this->assertFalse(Cache::has('users_cache'));
    }
}
