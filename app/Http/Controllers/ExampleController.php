<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Obtener lista de ejemplos
     */
    public function index()
    {
        return response()->json([
            'message' => 'Lista de ejemplos',
            'data' => [
                ['id' => 1, 'name' => 'Ejemplo 1', 'description' => 'Primer ejemplo'],
                ['id' => 2, 'name' => 'Ejemplo 2', 'description' => 'Segundo ejemplo'],
                ['id' => 3, 'name' => 'Ejemplo 3', 'description' => 'Tercer ejemplo'],
            ],
            'total' => 3
        ]);
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        return response()->json([
            'message' => 'Ejemplo creado exitosamente',
            'data' => [
                'id' => rand(4, 100),
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'created_at' => now()
            ]
        ], 201);
    }

    /**
     * Mostrar un ejemplo específico
     */
    public function show($id)
    {
        return response()->json([
            'message' => 'Detalle del ejemplo',
            'data' => [
                'id' => $id,
                'name' => "Ejemplo {$id}",
                'description' => "Descripción del ejemplo {$id}",
                'created_at' => now()->subDays(rand(1, 30))
            ]
        ]);
    }

    /**
     * Actualizar un ejemplo
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        return response()->json([
            'message' => 'Ejemplo actualizado exitosamente',
            'data' => [
                'id' => $id,
                'name' => $validated['name'] ?? "Ejemplo {$id}",
                'description' => $validated['description'] ?? "Descripción actualizada",
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Eliminar un ejemplo
     */
    public function destroy($id)
    {
        return response()->json([
            'message' => "Ejemplo {$id} eliminado exitosamente"
        ]);
    }
}
