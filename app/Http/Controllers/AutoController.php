<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AutoController extends Controller
{
    /**
     * Mostrar listado de autos
     */
    public function index(): JsonResponse
    {
        try {
            $autos = Auto::with('marca')->get();

            return response()->json([
                'success' => true,
                'data' => $autos,
                'message' => 'Autos obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los autos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear un nuevo auto
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'marca_id' => 'required|exists:marcas,id',
                'modelo' => 'required|string|max:255',
                'anio' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'precio' => 'required|numeric|min:0',
                'color' => 'nullable|string|max:100',
            ]);

            $auto = Auto::create($validatedData);
            $auto->load('marca');

            return response()->json([
                'success' => true,
                'data' => $auto,
                'message' => 'Auto creado exitosamente'
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
                'message' => 'Error al crear el auto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar un auto específico
     */
    public function show(Auto $auto): JsonResponse
    {
        try {
            $auto->load('marca');

            return response()->json([
                'success' => true,
                'data' => $auto,
                'message' => 'Auto obtenido exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el auto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar un auto específico
     */
    public function update(Request $request, Auto $auto): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'marca_id' => 'required|exists:marcas,id',
                'modelo' => 'required|string|max:255',
                'anio' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'precio' => 'required|numeric|min:0',
                'color' => 'nullable|string|max:100',
            ]);

            $auto->update($validatedData);
            $auto->load('marca');

            return response()->json([
                'success' => true,
                'data' => $auto,
                'message' => 'Auto actualizado exitosamente'
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
                'message' => 'Error al actualizar el auto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Eliminar un auto específico
     */
    public function destroy(Auto $auto): JsonResponse
    {
        try {
            $auto->delete();

            return response()->json([
                'success' => true,
                'message' => 'Auto eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el auto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Filtrar autos por marca
     */
    public function porMarca(Marca $marca): JsonResponse
    {
        try {
            $autos = $marca->autos()->with('marca')->get();

            return response()->json([
                'success' => true,
                'data' => $autos,
                'message' => 'Autos filtrados por marca obtenidos exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al filtrar autos por marca',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Filtrar autos por rango de precio
     */
    public function porPrecio(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'precio_min' => 'nullable|numeric|min:0',
                'precio_max' => 'nullable|numeric|min:0',
            ]);

            $query = Auto::with('marca');

            if (isset($validatedData['precio_min'])) {
                $query->where('precio', '>=', $validatedData['precio_min']);
            }

            if (isset($validatedData['precio_max'])) {
                $query->where('precio', '<=', $validatedData['precio_max']);
            }

            $autos = $query->get();

            return response()->json([
                'success' => true,
                'data' => $autos,
                'message' => 'Autos filtrados por precio obtenidos exitosamente'
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
                'message' => 'Error al filtrar autos por precio',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Filtrar autos por año
     */
    public function porAnio(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'anio_min' => 'nullable|integer|min:1900',
                'anio_max' => 'nullable|integer|max:' . (date('Y') + 1),
            ]);

            $query = Auto::with('marca');

            if (isset($validatedData['anio_min'])) {
                $query->where('anio', '>=', $validatedData['anio_min']);
            }

            if (isset($validatedData['anio_max'])) {
                $query->where('anio', '<=', $validatedData['anio_max']);
            }

            $autos = $query->get();

            return response()->json([
                'success' => true,
                'data' => $autos,
                'message' => 'Autos filtrados por año obtenidos exitosamente'
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
                'message' => 'Error al filtrar autos por año',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
