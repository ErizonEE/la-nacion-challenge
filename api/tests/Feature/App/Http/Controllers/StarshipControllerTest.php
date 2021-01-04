<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StarshipControllerTest extends TestCase
{
    // Deshabilito middlewares para evitar la comprobación del recurso en la api externa ya que no será necesaria en los tests
    use WithoutMiddleware, RefreshDatabase;
    // Genero un array de ids conocidos para los recursos externos
    private $ids = [2, 3, 5];

    /**
     * Verifica que el endpoint /api/starships sea devuelto con la estructura json adecuada
     */
    public function testIndex(): void
    {
        $response = $this->get('/api/starships');

        $response->assertStatus(200)->assertJsonStructure([
            'results' => [
                '*' => [
                    'count'
                ]
            ]
        ]);
    }
    /**
     * Verifica que el endpoint /api/starships/{id} responda con la estructura json adecuada
     */
    public function testShow(): void
    {
        $response = $this->get($this->getValidResourceUri());

        $response->assertStatus(200)->assertJsonStructure([
            'count'
        ]);
    }
    /**
     *  Verifica que el endpoint /api/starships/{id}/set-count reciba y procese correctamente la solicitud
     */
    public function testSetCounter(): void
    {
        $response = $this->postJson($this->getValidResourceUri() . 'set-counter', [
            "count" => rand(2, 103)
        ]);
        $response->assertStatus(204);
    }
    /**
     * Verifica que el endpoint /api/starships/{id}/increase-count reciba y procese correctamente la solicitud
     */
    public function testIncreaseCounter(): void
    {
        $response = $this->postJson($this->getValidResourceUri() . 'increase-counter', [
            "count" => rand(2, 103)
        ]);
        $response->assertStatus(204);
    }
    /**
     * Verifica que el endpoint /api/starships/{id}/decrease-count reciba y procese correctamente la solicitud
     */
    public function testDecreaseCounter(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->postJson($this->getValidResourceUri() . 'decrease-counter', [
            "count" => rand(2, 103)
        ]);
        $response->assertStatus(204);
    }
    /**
     * Agrego funcionalidad para reutilizar en los tests
     * Obtiene la url de algun resource de la lista de resource ids conocidos
     */
    public function getValidResourceUri(): String
    {
        $index = rand(0, count($this->ids) - 1);
        return '/api/starships/' . $this->ids[$index] . '/';
    }
}
