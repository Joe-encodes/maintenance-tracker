<?php 

use App\Models\User;
use App\Models\MaintenanceRequest;
use function Pest\Laravel\{actingAs, patch};

// it('allows admin to update maintenance status', function () {
//     $admin = User::factory()->create(['is_admin' => true]);
//     $request = MaintenanceRequest::factory()->create(['status' => 'pending']);

//     actingAs($admin);
//     $response = patch("/maintenance/{$request->id}/status", [
//         'status' => 'completed',
//     ]);

//     $response->assertRedirect();
//     $this->assertDatabaseHas('maintenance_requests', [
//         'id' => $request->id,
//         'status' => 'completed',
//     ]);
// });
