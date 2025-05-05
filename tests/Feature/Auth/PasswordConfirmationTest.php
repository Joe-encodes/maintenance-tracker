<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});

// test('password update fails with short password', function () {
//     $user = User::factory()->create();

//     $response = $this->actingAs($user)->put('/password', [
//         'current_password' => 'password',
//         'password' => 'short',
//         'password_confirmation' => 'short',
//     ]);

//     $response->assertSessionHasErrors('password');
// });


// test('password update fails with short password', function () {
//     // Create a user with a known password
//     $user = User::factory()->create(['password' => Hash::make('password')]); // Set the password

//     // Attempt to update the password with a short password
//     $response = $this->actingAs($user)->put('/password', [
//         'current_password' => 'password', // Use the correct current password
//         'password' => 'short', // New password is too short
//         'password_confirmation' => 'short',
//     ]);

//     // Assert that the session has errors for the 'password' field
//     $response->assertSessionHasErrors('password');
// });