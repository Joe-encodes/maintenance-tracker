<?php

namespace Tests\Feature\Maintenance;

use App\Models\User;
use App\Models\MaintenanceRequest;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RequestStatusChanged;
use function Pest\Laravel\{actingAs, patch};

// it('sends notification on status change', function () {
//     Notification::fake();

//     $admin = User::factory()->create(['is_admin' => true]);
//     $user = User::factory()->create();
//     $request = MaintenanceRequest::factory()->create([
//         'user_id' => $user->id,
//         'status' => 'pending',
//     ]);

//     actingAs($admin);
//     patch("/maintenance/{$request->id}/status", [
//         'status' => 'in_progress',
//     ]);

//     Notification::assertSentTo($user, RequestStatusChanged::class);
// });
