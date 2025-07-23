# API de Gestión de Autos y Marcas

Este documento describe las rutas y funcionalidades de la API para gestionar autos y marcas.

## Estructura de las Tablas

### Tabla `marcas`

-   `id`: ID único de la marca
-   `nombre`: Nombre de la marca (único)
-   `pais_origen`: País de origen de la marca
-   `created_at`, `updated_at`: Timestamps

### Tabla `autos`

-   `id`: ID único del auto
-   `marca_id`: ID de la marca (clave foránea)
-   `modelo`: Modelo del auto
-   `anio`: Año del auto
-   `precio`: Precio del auto (decimal)
-   `color`: Color del auto (opcional)
-   `created_at`, `updated_at`: Timestamps

## Rutas API

### Marcas

#### Listar todas las marcas

```
GET /api/marcas
```

#### Crear una nueva marca

```
POST /api/marcas
Content-Type: application/json

{
    "nombre": "Tesla",
    "pais_origen": "Estados Unidos"
}
```

#### Obtener una marca específica

```
GET /api/marcas/{id}
```

#### Actualizar una marca

```
PUT /api/marcas/{id}
Content-Type: application/json

{
    "nombre": "Tesla Motors",
    "pais_origen": "Estados Unidos"
}
```

#### Eliminar una marca

```
DELETE /api/marcas/{id}
```

#### Obtener todos los autos de una marca

```
GET /api/marcas/{id}/autos
```

### Autos

#### Listar todos los autos

```
GET /api/autos
```

#### Crear un nuevo auto

```
POST /api/autos
Content-Type: application/json

{
    "marca_id": 1,
    "modelo": "Model 3",
    "anio": 2024,
    "precio": 45000.00,
    "color": "Blanco"
}
```

#### Obtener un auto específico

```
GET /api/autos/{id}
```

#### Actualizar un auto

```
PUT /api/autos/{id}
Content-Type: application/json

{
    "marca_id": 1,
    "modelo": "Model 3 Performance",
    "anio": 2024,
    "precio": 55000.00,
    "color": "Rojo"
}
```

#### Eliminar un auto

```
DELETE /api/autos/{id}
```

#### Filtrar autos por marca

```
GET /api/autos/marca/{marca_id}
```

#### Filtrar autos por rango de precio

```
GET /api/autos/filtros/precio?precio_min=20000&precio_max=50000
```

#### Filtrar autos por rango de año

```
GET /api/autos/filtros/anio?anio_min=2020&anio_max=2024
```

## Ejemplos de Respuestas

### Respuesta exitosa

```json
{
    "success": true,
    "data": {
        "id": 1,
        "nombre": "Toyota",
        "pais_origen": "Japón",
        "created_at": "2025-07-23T23:11:15.000000Z",
        "updated_at": "2025-07-23T23:11:15.000000Z"
    },
    "message": "Marca obtenida exitosamente"
}
```

### Respuesta de error de validación

```json
{
    "success": false,
    "message": "Error de validación",
    "errors": {
        "nombre": ["El campo nombre es obligatorio."],
        "pais_origen": ["El campo país de origen es obligatorio."]
    }
}
```

### Respuesta de error del servidor

```json
{
    "success": false,
    "message": "Error al obtener la marca",
    "error": "Mensaje detallado del error"
}
```

## Comandos Artisan Útiles

### Ejecutar migraciones

```bash
php artisan migrate
```

### Ejecutar migraciones frescas con seeders

```bash
php artisan migrate:fresh --seed
```

### Crear un nuevo controlador

```bash
php artisan make:controller NombreController --api
```

### Crear un nuevo modelo con migración y factory

```bash
php artisan make:model NombreModelo -mf
```

### Crear un nuevo seeder

```bash
php artisan make:seeder NombreSeeder
```

## Validaciones Implementadas

### Marcas

-   `nombre`: requerido, string, máximo 255 caracteres, único
-   `pais_origen`: requerido, string, máximo 255 caracteres

### Autos

-   `marca_id`: requerido, debe existir en la tabla marcas
-   `modelo`: requerido, string, máximo 255 caracteres
-   `anio`: requerido, entero, mínimo 1900, máximo año actual + 1
-   `precio`: requerido, numérico, mínimo 0
-   `color`: opcional, string, máximo 100 caracteres

## Relaciones

-   Una **Marca** puede tener muchos **Autos** (relación uno a muchos)
-   Un **Auto** pertenece a una **Marca** (relación muchos a uno)
-   Al eliminar una marca, se verifica que no tenga autos asociados
-   Los autos se eliminan en cascada si se elimina la marca (configurado en la migración)

## Testing

Para probar la API puedes usar Thunder Client, Postman, o curl:

```bash
# Obtener todas las marcas
curl -X GET http://localhost:8000/api/marcas

# Crear una nueva marca
curl -X POST http://localhost:8000/api/marcas \
  -H "Content-Type: application/json" \
  -d '{"nombre":"Tesla","pais_origen":"Estados Unidos"}'

# Obtener todos los autos
curl -X GET http://localhost:8000/api/autos
```
