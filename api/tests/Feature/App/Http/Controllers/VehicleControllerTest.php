<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    // Deshabilito middlewares para evitar la comprobación del recurso en la api externa ya que no será necesaria en los tests
    use WithoutMiddleware, RefreshDatabase;
    //
    private $ids = [4,6];
    /**
     * Verifica que el endpoint /api/vehicles responda con la estructura json adecuada
     *
     * @return void
     */
    public function testIndex(): void
    {
        $response = $this->get('/api/vehicles');

        $response->assertStatus(200)->assertJsonStructure([
            'results' => [
                '*' => [
                    'count'
                ]
            ]
        ]);
    }
    /**
     * Verifica que el endpoint /api/vehicles/{id} responda con la estructura json adecuada
     * 
     * @return void
     */
    public function testShow(): void
    {
        
        $response = $this->get($this->getValidResourceUri());

        $response->assertStatus(200)->assertJsonStructure([
            'count'
        ]);
    }
    /**
     *  Verifica que el endpoint /api/vehicles/{id}/set-count reciba y procese correctamente la solicitud
     * 
     *  @return void
     */
    public function testSetCounter(): void
    {
        $response = $this->postJson($this->getValidResourceUri() . 'set-counter', [
            "count" => rand(2, 103)
        ]);
        $response->assertStatus(204);
    }
    /**
     * Verifica que el endpoint /api/vehicles/{id}/increase-count reciba y procese correctamente la solicitud
     * 
     * @return void
     */
    public function testIncreaseCounter(): void
    {
        $response = $this->postJson($this->getValidResourceUri() . 'increase-counter', [
            "count" => rand(2, 103)
        ]);
        $response->assertStatus(204);
    }
    /**
     * Verifica que el endpoint /api/vehicles/{id}/decrease-count reciba y procese correctamente la solicitud
     * 
     * @return void
     */
    public function testDecreaseCounter(): void
    {
        $response = $this->postJson($this->getValidResourceUri() . 'decrease-counter', [
            "count" => rand(2, 103)
        ]);
        $response->assertStatus(204);
    }
    /**
     * Agrego funcionalidad para reutilizar en los tests
     * Obtiene la url del primer vehiculo de la coleccion de vehiculos externa
     * 
     * @return string
     */
    public function getValidResourceUri(): String
    {
        $index = rand(0, count($this->ids) - 1);
        return '/api/vehicles/' . $this->ids[$index] . '/';
    }
}
