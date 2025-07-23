<?php

// Script de prueba simple para verificar las rutas
use App\Models\Marca;
use App\Models\Auto;

// Configurar Laravel
require_once __DIR__ . '/bootstrap/app.php';

// Iniciailizar aplicación
$app = new \Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

echo "=== Prueba de Modelos ===\n";

// Probar obtener marcas
echo "Marcas totales: " . Marca::count() . "\n";
echo "Autos totales: " . Auto::count() . "\n";

// Obtener primera marca con autos
$marca = Marca::with('autos')->first();
if ($marca) {
    echo "Primera marca: {$marca->nombre} ({$marca->pais_origen})\n";
    echo "Autos de esta marca: " . $marca->autos->count() . "\n";
}

// Obtener primer auto con marca
$auto = Auto::with('marca')->first();
if ($auto) {
    echo "Primer auto: {$auto->modelo} - {$auto->marca->nombre} ({$auto->anio})\n";
    echo "Precio: $" . number_format($auto->precio, 2) . "\n";
}

echo "\n=== Test completado ===\n";
