<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DateFormatTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_screen_shows_correct_date()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee(now()->format('m/d/Y'));
    }

    public function test_register_saves_date_successfully()
    {
        $response = $this->post('/register', [
            'name' => 'Some name',
            'email' => 'some@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'start_date' => now()->format('m/d/Y')
        ]);
        $response->assertRedirect(RouteServiceProvider::HOME);
        Auth::logout();

        $this->assertDatabaseHas('users', [
            'name' => 'Some name',
            'email' => 'some@email.com',
            'start_date' => now()
        ]);

        $response = $this->get('/users');
        $response->assertSee('some@email.com');
        $response->assertSee(now()->format('m/d/Y'));

        $startDateFrom = now()->subDays(3)->format('m/d/Y');
        $startDateTo = now()->subDays(2)->format('m/d/Y');
        $response = $this->get('/users?start_date_from=' . $startDateFrom . '&start_date_to=' . $startDateTo);
        $response->assertDontSee('some@email.com');
        $response->assertDontSee(now()->format('m/d/Y'));
    }
}
