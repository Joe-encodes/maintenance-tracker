<?php

use App\Models\User;
use App\Models\MaintenanceRequest;
use function Pest\Laravel\{actingAs, post};

// it('creates a maintenance request', function () {
//     $user = User::factory()->create();
//     actingAs($user);

//     $response = post('/requests', [
//         'title' => 'Fix AC',
//         'description' => 'The AC in Room 2 isnt working',
//         'status' => 'Pending',
//         'priority' => 'Low',
//     ]);

//     $response->assertRedirect(); // assuming redirect back
//     $this->assertDatabaseHas('maintenance_requests', [
//         'title' => 'Fix AC',
//         'user_id' => $user->id,
//     ]);
// });
