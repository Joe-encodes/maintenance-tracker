<?php

use App\Models\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RequestControllerTest extends TestCase
{
    // use RefreshDatabase;


    // public function test_it_displays_requests_list()
    // {
    //     Request::factory()->count(3)->create();

    //     $response = $this->get(route('requests.index'));

    //     $response->assertStatus(200);
    //     $response->assertSee(Request::first()->title);
    // }

    // public function test_it_creates_a_request()
    // {
    //     $data = [
    //         'title' => 'Test title',
    //         'priority' => 'High',
    //         'status' => 'Pending',
    //     ];

    //     $response = $this->post(route('requests.store'), $data);

    //     $response->assertRedirect();
    //     $this->assertDatabaseHas('requests', $data);
    // }
}
