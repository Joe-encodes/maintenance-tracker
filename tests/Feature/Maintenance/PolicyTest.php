<?php

use App\Models\User;
use App\Models\MaintenanceRequest;
use function Pest\Laravel\{actingAs, patch};

// it('prevents non-admins from changing status', function () {
//     $user = User::factory()->create();
//     $request = MaintenanceRequest::factory()->create(['status' => 'pending']);

//     actingAs($user);
//     $response = patch("/maintenance/{$request->id}/status", [
//         'status' => 'completed',
//     ]);

//     $response->assertForbidden();
// });
