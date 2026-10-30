<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class PublicRoutesTest extends TestCase
{
    public function test_inicio_route_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Kuroko no Basket');
    }

    public function test_menu_route_is_accessible(): void
    {
        $response = $this->get('/menu');
        $response->assertStatus(200);
        $response->assertSee('Generación de los Milagros');
    }

    public function test_nosotros_route_is_accessible(): void
    {
        $response = $this->get('/nosotros');
        $response->assertStatus(200);
        $response->assertSee('Detalles de la Obra');
    }

    public function test_capitulos_route_is_accessible(): void
    {
        $response = $this->get('/capitulos');
        $response->assertStatus(200);
        $response->assertSee('Temporadas y Película');
        $response->assertSee('Temporada 1');
        $response->assertSee('Temporada 2');
        $response->assertSee('Temporada 3');
    }

    public function test_tienda_redirects_unauthenticated_user(): void
    {
        $response = $this->get('/tienda');
        $response->assertRedirect('/login');
    }

    public function test_tienda_is_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/tienda');
        $response->assertStatus(200);
        $response->assertSee('Kuroko Store');
    }

    public function test_dashboard_is_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Publicar opinión de la tienda de Kuroko');
    }

    public function test_comunidad_is_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/comunidad');
        $response->assertStatus(200);
        $response->assertSee('Comunidad Kuroko');
    }
}
