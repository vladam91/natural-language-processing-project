<?php

namespace Tests\Feature\routes;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicRouteTest extends TestCase
{
    public function testAcces(){
        $this->assertTrue(true);

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
    }
}
