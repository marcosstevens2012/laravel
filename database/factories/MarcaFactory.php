<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Marca>
 */
class MarcaFactory extends Factory
{
    protected $model = Marca::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $marcas = [
            ['nombre' => 'Toyota', 'pais_origen' => 'Japón'],
            ['nombre' => 'Honda', 'pais_origen' => 'Japón'],
            ['nombre' => 'Ford', 'pais_origen' => 'Estados Unidos'],
            ['nombre' => 'Chevrolet', 'pais_origen' => 'Estados Unidos'],
            ['nombre' => 'BMW', 'pais_origen' => 'Alemania'],
            ['nombre' => 'Mercedes-Benz', 'pais_origen' => 'Alemania'],
            ['nombre' => 'Audi', 'pais_origen' => 'Alemania'],
            ['nombre' => 'Volkswagen', 'pais_origen' => 'Alemania'],
            ['nombre' => 'Hyundai', 'pais_origen' => 'Corea del Sur'],
            ['nombre' => 'Kia', 'pais_origen' => 'Corea del Sur'],
        ];

        $marca = $this->faker->randomElement($marcas);

        return [
            'nombre' => $marca['nombre'],
            'pais_origen' => $marca['pais_origen'],
        ];
    }
}
