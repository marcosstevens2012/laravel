<?php

namespace Database\Seeders;

use App\Models\Auto;
use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las marcas existentes
        $marcas = Marca::all();

        if ($marcas->isEmpty()) {
            $this->command->warn('No hay marcas disponibles. Ejecuta primero MarcaSeeder.');
            return;
        }

        $autosData = [
            // Toyota
            ['marca' => 'Toyota', 'modelo' => 'Corolla', 'anio' => 2023, 'precio' => 25000.00, 'color' => 'Blanco'],
            ['marca' => 'Toyota', 'modelo' => 'Camry', 'anio' => 2024, 'precio' => 32000.00, 'color' => 'Negro'],
            ['marca' => 'Toyota', 'modelo' => 'RAV4', 'anio' => 2023, 'precio' => 35000.00, 'color' => 'Azul'],

            // Honda
            ['marca' => 'Honda', 'modelo' => 'Civic', 'anio' => 2023, 'precio' => 28000.00, 'color' => 'Rojo'],
            ['marca' => 'Honda', 'modelo' => 'Accord', 'anio' => 2024, 'precio' => 33000.00, 'color' => 'Gris'],
            ['marca' => 'Honda', 'modelo' => 'CR-V', 'anio' => 2023, 'precio' => 36000.00, 'color' => 'Plata'],

            // Ford
            ['marca' => 'Ford', 'modelo' => 'Fiesta', 'anio' => 2022, 'precio' => 20000.00, 'color' => 'Verde'],
            ['marca' => 'Ford', 'modelo' => 'Focus', 'anio' => 2023, 'precio' => 24000.00, 'color' => 'Amarillo'],
            ['marca' => 'Ford', 'modelo' => 'Mustang', 'anio' => 2024, 'precio' => 45000.00, 'color' => 'Rojo'],

            // BMW
            ['marca' => 'BMW', 'modelo' => 'Serie 3', 'anio' => 2024, 'precio' => 55000.00, 'color' => 'Negro'],
            ['marca' => 'BMW', 'modelo' => 'X3', 'anio' => 2023, 'precio' => 62000.00, 'color' => 'Blanco'],

            // Mercedes-Benz
            ['marca' => 'Mercedes-Benz', 'modelo' => 'Clase C', 'anio' => 2024, 'precio' => 58000.00, 'color' => 'Plata'],
            ['marca' => 'Mercedes-Benz', 'modelo' => 'GLC', 'anio' => 2023, 'precio' => 65000.00, 'color' => 'Negro'],
        ];

        foreach ($autosData as $autoData) {
            $marca = $marcas->where('nombre', $autoData['marca'])->first();

            if ($marca) {
                Auto::create([
                    'marca_id' => $marca->id,
                    'modelo' => $autoData['modelo'],
                    'anio' => $autoData['anio'],
                    'precio' => $autoData['precio'],
                    'color' => $autoData['color'],
                ]);
            }
        }

        // Crear algunos registros adicionales con factory
        Auto::factory(20)->create();
    }
}
