<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class MarcaController extends Controller
{
    /**
     * Mostrar listado de marcas
     */
    public function index(): JsonResponse
    {
        try {
            $marcas = Marca::with('autos')->get();

            return response()->json([
                'success' => true,
                'data' => $marcas,
                'message' => 'Marcas obtenidas exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las marcas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear una nueva marca
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255|unique:marcas',
                'pais_origen' => 'required|string|max:255',
            ]);

            $marca = Marca::create($validatedData);

            return response()->json([
                'success' => true,
                'data' => $marca,
                'message' => 'Marca creada exitosamente'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar una marca específica
     */
    public function show(Marca $marca): JsonResponse
    {
        try {
            $marca->load('autos');

            return response()->json([
                'success' => true,
                'data' => $marca,
                'message' => 'Marca obtenida exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar una marca específica
     */
    public function update(Request $request, Marca $marca): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255|unique:marcas,nombre,' . $marca->id,
                'pais_origen' => 'required|string|max:255',
            ]);

            $marca->update($validatedData);

            return response()->json([
                'success' => true,
                'data' => $marca,
                'message' => 'Marca actualizada exitosamente'
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar una marca específica
     */
    public function destroy(Marca $marca): JsonResponse
    {
        try {
            // Verificar si la marca tiene autos asociados
            if ($marca->autos()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar la marca porque tiene autos asociados'
                ], 400);
            }

            $marca->delete();

            return response()->json([
                'success' => true,
                'message' => 'Marca eliminada exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener autos de una marca específica
     */
    public function autos(Marca $marca): JsonResponse
    {
        try {
            $autos = $marca->autos()->get();

            return response()->json([
                'success' => true,
                'data' => $autos,
                'message' => 'Autos de la marca obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los autos de la marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
