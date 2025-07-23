<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
            ['nombre' => 'Nissan', 'pais_origen' => 'Japón'],
            ['nombre' => 'Mazda', 'pais_origen' => 'Japón'],
            ['nombre' => 'Subaru', 'pais_origen' => 'Japón'],
            ['nombre' => 'Mitsubishi', 'pais_origen' => 'Japón'],
            ['nombre' => 'Peugeot', 'pais_origen' => 'Francia'],
            ['nombre' => 'Renault', 'pais_origen' => 'Francia'],
            ['nombre' => 'Fiat', 'pais_origen' => 'Italia'],
            ['nombre' => 'Alfa Romeo', 'pais_origen' => 'Italia'],
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }
    }
}
