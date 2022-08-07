<?php

namespace Tests\Unit;

use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * Checking the webpage renders properly
     *
     */
    public function test_home_page_renders()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
