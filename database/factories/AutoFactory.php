<?php

namespace Database\Factories;

use App\Models\Auto;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auto>
 */
class AutoFactory extends Factory
{
    protected $model = Auto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modelos = [
            'Corolla', 'Camry', 'Prius', 'RAV4', 'Highlander',
            'Civic', 'Accord', 'CR-V', 'Pilot', 'Fit',
            'Fiesta', 'Focus', 'Mustang', 'Explorer', 'F-150',
            'Spark', 'Cruze', 'Malibu', 'Equinox', 'Tahoe',
            'Serie 3', 'Serie 5', 'X3', 'X5', 'i3',
            'Clase A', 'Clase C', 'Clase E', 'GLA', 'GLC',
            'A3', 'A4', 'Q3', 'Q5', 'TT',
            'Golf', 'Jetta', 'Passat', 'Tiguan', 'Touareg',
            'Accent', 'Elantra', 'Sonata', 'Tucson', 'Santa Fe',
            'Rio', 'Forte', 'Optima', 'Sorento', 'Sportage'
        ];

        $colores = [
            'Blanco', 'Negro', 'Plata', 'Gris', 'Azul',
            'Rojo', 'Verde', 'Amarillo', 'Naranja', 'Violeta'
        ];

        return [
            'marca_id' => function () {
                $marca = Marca::inRandomOrder()->first();
                return $marca ? $marca->id : Marca::factory();
            },
            'modelo' => $this->faker->randomElement($modelos),
            'anio' => $this->faker->numberBetween(2015, 2025),
            'precio' => $this->faker->randomFloat(2, 15000, 80000),
            'color' => $this->faker->randomElement($colores),
        ];
    }
}
