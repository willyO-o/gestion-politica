# Endpoint: Registrar Asistencia por Código QR

## Información General
**Método:** `POST`  
**URL:** `/api/asistencia/qr`  
**Autenticación:** Requerida (Bearer Token)

## Descripción
Permite registrar la asistencia de una persona escaneando un código QR. El código QR debe contener el MD5 del ID de la persona. Este endpoint valida la existencia de la actividad, persona y evita registros duplicados.

---

## Parámetros del Body (JSON)

| Parámetro | Tipo | Requerido | Descripción |
|-----------|------|-----------|-------------|
| `codigo` | string | Sí | Hash MD5 del id_persona |
| `id_actividad_fk` | integer | Sí | ID de la actividad |
| `observacion` | string | No | Observaciones adicionales (máx. 2000 caracteres) |

---

## Ejemplo de Petición

```http
POST /api/asistencia/qr
Content-Type: application/json
Authorization: Bearer {token}

{
  "codigo": "c81e728d9d4c2f636f067f89cc14862c",
  "id_actividad_fk": 1,
  "observacion": "Registro mediante app móvil"
}
```

### Generar el código MD5
Si el `id_persona` es `2`, el código será:
```javascript
// JavaScript
const codigo = CryptoJS.MD5("2").toString();
// Resultado: c81e728d9d4c2f636f067f89cc14862c
```

```php
// PHP
$codigo = md5(2);
// Resultado: c81e728d9d4c2f636f067f89cc14862c
```

---

## Respuestas

### ✅ Registro Exitoso (201 Created)

```json
{
  "success": true,
  "message": "¡Asistencia registrada exitosamente!",
  "data": {
    "asistencia": {
      "id_asistencia": 45,
      "id_actividad_fk": 1,
      "id_persona_fk": 2,
      "observacion": "Registro mediante app móvil",
      "ingreso": "2026-02-04 09:15:30",
      "salida": null,
      "fecha_asistencia": "2026-02-04",
      "estado_asistencia": "PRESENTE",
      "permiso": 0,
      "created_at": "2026-02-04T09:15:30.000000Z",
      "updated_at": "2026-02-04T09:15:30.000000Z"
    },
    "hora_entrada": "09:15:30",
    "fecha": "2026-02-04",
    "persona": {
      "nombre": "Juan",
      "paterno": "Pérez",
      "materno": "García"
    },
    "actividad": {
      "id": 1,
      "nombre": "Entrenamiento Matutino"
    }
  }
}
```

### ❌ Actividad no encontrada (404 Not Found)

```json
{
  "success": false,
  "message": "La actividad no existe o no está disponible",
  "tipo": "actividad_no_encontrada"
}
```

### ❌ Código QR inválido (404 Not Found)

```json
{
  "success": false,
  "message": "Código QR inválido o persona no registrada",
  "tipo": "persona_no_encontrada"
}
```

### ❌ Asistencia ya registrada (422 Unprocessable Entity)

```json
{
  "success": false,
  "message": "Ya registraste tu asistencia el día de hoy",
  "tipo": "asistencia_duplicada",
  "data": {
    "hora_entrada": "08:30:00",
    "fecha": "2026-02-04",
    "asistencia": {
      "id_asistencia": 43,
      "id_actividad_fk": 1,
      "id_persona_fk": 2,
      "ingreso": "2026-02-04 08:30:00",
      "salida": null,
      "fecha_asistencia": "2026-02-04",
      "estado_asistencia": "PRESENTE",
      "permiso": 0
    }
  }
}
```

### ❌ Datos inválidos (422 Unprocessable Entity)

```json
{
  "success": false,
  "message": "Datos inválidos",
  "errors": {
    "codigo": ["El campo codigo es obligatorio."],
    "id_actividad_fk": ["El campo id actividad fk es obligatorio."]
  }
}
```

### ❌ No autenticado (401 Unauthorized)

```json
{
  "message": "Unauthenticated."
}
```

---

## Flujo de Validación

1. ✅ Validar formato de datos
2. ✅ Verificar que la actividad exista
3. ✅ Buscar persona mediante MD5(id_persona)
4. ✅ Verificar que no tenga asistencia registrada hoy
5. ✅ Registrar asistencia con hora actual

---

## Manejo de Errores en la App Móvil

```javascript
async function registrarAsistenciaQR(codigo, idActividad) {
  try {
    const response = await fetch('/api/asistencia/qr', {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        codigo: codigo,
        id_actividad_fk: idActividad
      })
    });

    const data = await response.json();

    if (data.success) {
      // ✅ Registro exitoso
      mostrarExito(data.message, data.data);
    } else {
      // ❌ Error controlado
      switch(data.tipo) {
        case 'actividad_no_encontrada':
          mostrarError('La actividad no existe');
          break;
        case 'persona_no_encontrada':
          mostrarError('Código QR inválido');
          break;
        case 'asistencia_duplicada':
          mostrarAdvertencia(data.message, data.data.hora_entrada);
          break;
        default:
          mostrarError(data.message);
      }
    }
  } catch (error) {
    mostrarError('Error de conexión. Intenta de nuevo.');
  }
}
```

---

## Notas Importantes

1. **Seguridad del código QR**: El código MD5 se calcula en base al `id_persona`, por lo que cada persona tiene un código único e inmutable.

2. **Validación de fecha**: Solo se permite un registro por actividad por día. Si intenta registrarse nuevamente el mismo día, recibirá el error `asistencia_duplicada`.

3. **Hora de registro**: La hora de ingreso se registra automáticamente con `Carbon::now()` en la zona horaria configurada en Laravel.

4. **Campo `tipo`**: Todas las respuestas de error incluyen un campo `tipo` para facilitar el manejo en la aplicación móvil.

5. **Información retornada**: En caso exitoso, se retorna información completa de la persona y actividad para mostrar una confirmación detallada en la app.

---

## Ejemplo de Generación de QR

### Backend (Laravel)
```php
// Generar QR para una persona
use SimpleSoftwareIO\QrCode\Facades\QrCode;

$idPersona = 5;
$codigo = md5($idPersona);

// Generar imagen QR
QrCode::size(300)->generate($codigo);

// O guardar como archivo
QrCode::format('png')->size(300)->generate($codigo, storage_path('qr/persona_' . $idPersona . '.png'));
```

### Frontend (JavaScript con QR Scanner)
```javascript
// Escanear QR y registrar
const scanner = new Html5QrcodeScanner("reader", { 
  fps: 10, 
  qrbox: 250 
});

scanner.render((decodedText) => {
  // decodedText contiene el código MD5
  registrarAsistenciaQR(decodedText, actividadSeleccionada);
  scanner.clear();
});
```

---

## Testing

```bash
# Probar con cURL
curl -X POST http://localhost/control-politico/api/asistencia/qr \
  -H "Authorization: Bearer tu_token" \
  -H "Content-Type: application/json" \
  -d '{
    "codigo": "c81e728d9d4c2f636f067f89cc14862c",
    "id_actividad_fk": 1
  }'
```
