<?php


namespace Tests\Feature\Maintenance;

use App\Models\MaintenanceRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewMaintenanceRequestsTest extends TestCase
{
    // use RefreshDatabase;

    // public function test_admin_sees_all_requests()
    // {
    //     $admin = User::factory()->create(['is_admin' => true]);
    //     $request = MaintenanceRequest::factory()->create();

    //     $this->actingAs($admin)
    //         ->get(route('requests.index'))
    //         ->assertSee($request->title);
    // }
}
