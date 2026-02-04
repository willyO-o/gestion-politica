# Endpoint: Listar Asistencias por Actividad

## Información General
**Método:** `GET`  
**URL:** `/api/asistencia/actividad/{id_actividad}`  
**Autenticación:** Requerida (Bearer Token)

## Descripción
Obtiene la lista de asistencias registradas para una actividad específica, incluyendo información de las personas, estadísticas y opciones de filtrado avanzado.

---

## Parámetros

### Parámetro de Ruta (Requerido)
| Parámetro | Tipo | Descripción |
|-----------|------|-------------|
| `id_actividad` | integer | ID de la actividad |

### Parámetros de Query (Opcionales)
| Parámetro | Tipo | Default | Descripción |
|-----------|------|---------|-------------|
| `page` | integer | 1 | Número de página para paginación |
| `size` | integer | 15 | Cantidad de registros por página |
| `search` | string | - | Búsqueda por nombre, apellidos o número de documento |
| `fecha_inicio` | date | - | Fecha inicial del rango (formato: Y-m-d) |
| `fecha_fin` | date | - | Fecha final del rango (formato: Y-m-d) |

---

## Ejemplos de Uso

### 1. Listar todas las asistencias de una actividad
```http
GET /api/asistencia/actividad/1
Authorization: Bearer {token}
```

### 2. Buscar por nombre o documento
```http
GET /api/asistencia/actividad/1?search=Juan
Authorization: Bearer {token}
```

### 3. Filtrar por rango de fechas
```http
GET /api/asistencia/actividad/1?fecha_inicio=2026-02-01&fecha_fin=2026-02-28
Authorization: Bearer {token}
```

### 4. Paginación personalizada
```http
GET /api/asistencia/actividad/1?page=2&size=20
Authorization: Bearer {token}
```

### 5. Búsqueda con filtros combinados
```http
GET /api/asistencia/actividad/1?search=Juan&fecha_inicio=2026-02-01&fecha_fin=2026-02-28&size=10
Authorization: Bearer {token}
```

---

## Respuesta Exitosa (200 OK)

```json
{
  "actividad": {
    "id": 1,
    "nombre_actividad": "Entrenamiento Matutino",
    "fecha_actividad": "2026-02-05",
    "descripcion": "Sesión de entrenamiento físico",
    "created_at": "2026-02-01T10:00:00.000000Z",
    "updated_at": "2026-02-01T10:00:00.000000Z"
  },
  "asistencias": [
    {
      "id_asistencia": 1,
      "id_actividad_fk": 1,
      "id_persona_fk": 5,
      "observacion": "Llegada puntual",
      "ingreso": "2026-02-05 08:00:00",
      "salida": "2026-02-05 10:00:00",
      "fecha_asistencia": "2026-02-05",
      "estado_asistencia": "PRESENTE",
      "permiso": 0,
      "nombre": "Juan",
      "paterno": "Pérez",
      "materno": "García",
      "numero_documento": "12345678",
      "foto": "foto.jpg",
      "nombre_grupo": "Grupo A",
      "nombre_sucursal": "Sucursal Centro",
      "id_grupo_entrenamiento": 1
    },
    {
      "id_asistencia": 2,
      "id_actividad_fk": 1,
      "id_persona_fk": 8,
      "observacion": "Permiso médico",
      "ingreso": null,
      "salida": null,
      "fecha_asistencia": "2026-02-05",
      "estado_asistencia": "PERMISO",
      "permiso": 1,
      "nombre": "María",
      "paterno": "López",
      "materno": "Ramírez",
      "numero_documento": "87654321",
      "foto": null,
      "nombre_grupo": "Grupo B",
      "nombre_sucursal": "Sucursal Norte",
      "id_grupo_entrenamiento": 2
    }
  ],
  "estadisticas": {
    "total": 25,
    "con_salida": 23,
    "sin_salida": 2,
    "con_permiso": 3
  }
}
```

---

## Respuestas de Error

### 404 - Actividad no encontrada
```json
{
  "error": "Actividad no encontrada"
}
```

### 401 - No autenticado
```json
{
  "message": "Unauthenticated."
}
```

---

## Notas Importantes

1. **Búsqueda inteligente**: El parámetro `search` busca en:
   - Nombre completo (en cualquier orden)
   - Apellido paterno
   - Apellido materno
   - Número de documento

2. **Rango de fechas**: Ambos parámetros (`fecha_inicio` y `fecha_fin`) deben proporcionarse juntos para aplicar el filtro de fechas.

3. **Información adicional**: La respuesta incluye:
   - Datos completos de la persona (nombre, apellidos, documento, foto)
   - Grupo de entrenamiento al que pertenece
   - Sucursal asociada
   - Estadísticas resumidas de la actividad

4. **Paginación**: Los resultados están paginados automáticamente.

5. **Permisos**: Los registros con `permiso = 1` no tienen hora de ingreso/salida ya que son ausencias justificadas.

---

## Código de Ejemplo (JavaScript/Fetch)

```javascript
async function obtenerAsistencias(idActividad, filtros = {}) {
  const params = new URLSearchParams(filtros);
  const url = `http://tu-dominio.com/api/asistencia/actividad/${idActividad}?${params}`;
  
  const response = await fetch(url, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Accept': 'application/json'
    }
  });
  
  if (!response.ok) {
    throw new Error('Error al obtener asistencias');
  }
  
  return await response.json();
}

// Uso
const resultado = await obtenerAsistencias(1, {
  search: 'Juan',
  fecha_inicio: '2026-02-01',
  fecha_fin: '2026-02-28',
  page: 1,
  size: 20
});
```
