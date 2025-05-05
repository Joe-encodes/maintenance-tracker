<?php

use App\Models\User;
use App\Models\MaintenanceRequest;
use Database\Factories\MaintenanceRequestFactory;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});


test('regular users are redirected to dashboard after login', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ])->assertRedirect(route('dashboard'));
});


// test('non-admin can access their own request edit page', function () {
//     $user = User::factory()->create();
//     $userRequest = MaintenanceRequest::factory()->create(['user_id' => $user->id]);
    
//     $this->actingAs($user)
//          ->get(route('requests.edit', $userRequest))
//          ->assertOk();
// });

// test('admin can access any request edit page', function () {
//     $admin = User::factory()->create(['is_admin' => true]);
//     $otherUserRequest = MaintenanceRequest::factory()->create();
    
//     $this->actingAs($admin)
//          ->get(route('requests.edit', $otherUserRequest))
//          ->assertOk();
// });


test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

// test('non-admins cannot view others requests', function () {
//     $user = User::factory()->create();
//     $otherRequest = MaintenanceRequestFactory::factory()->create();

//     $this->actingAs($user)
//          ->get(route('requests.show', $otherRequest))
//          ->assertForbidden();
// });

test('guest is redirected to login when accessing profile', function () {
    $response = $this->get('/profile');

    $response->assertRedirect('/login');
});

