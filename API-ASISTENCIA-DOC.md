# API de Asistencia - Documentación

## Autenticación

Todos los endpoints (excepto login y register) requieren autenticación mediante JWT.

### Headers requeridos:
```
Authorization: Bearer {token}
Content-Type: application/json
Accept: application/json
```

---

## 📋 Endpoints de Actividades

### 1. Listar Actividades
**GET** `/api/actividades`

Query params opcionales:
- `fecha`: Filtrar por fecha específica (Y-m-d)
- `activas`: true para solo actividades futuras
- `per_page`: Número de resultados por página (default: 15)

**Respuesta:**
```json
{
  "data": [
    {
      "id": 1,
      "nombre_actividad": "Entrenamiento",
      "fecha_actividad": "2026-02-05",
      "descripcion": "...",
      "created_at": "...",
      "updated_at": "..."
    }
  ],
  "current_page": 1,
  "total": 10
}
```

### 2. Actividades de Hoy
**GET** `/api/actividades/hoy`

**Respuesta:**
```json
{
  "fecha": "2026-02-04",
  "actividades": [...],
  "total": 3
}
```

### 3. Ver Detalle de Actividad
**GET** `/api/actividades/{id}`

**Respuesta:**
```json
{
  "actividad": {
    "id": 1,
    "nombre_actividad": "...",
    "asistencias": [...]
  },
  "total_asistencias": 25,
  "con_permiso": 2
}
```

### 4. Crear Actividad
**POST** `/api/actividades`

**Body:**
```json
{
  "nombre_actividad": "Entrenamiento Matutino",
  "fecha_actividad": "2026-02-05",
  "descripcion": "Descripción opcional"
}
```

### 5. Actualizar Actividad
**PUT** `/api/actividades/{id}`

**Body:** (mismo que crear)

### 6. Eliminar Actividad
**DELETE** `/api/actividades/{id}`

⚠️ No se puede eliminar si tiene asistencias registradas

---

## ✅ Endpoints de Asistencia

### 1. Registrar Entrada
**POST** `/api/asistencia/entrada`

**Body:**
```json
{
  "id_actividad_fk": 1,
  "id_persona_fk": 1,
  "observacion": "Opcional"
}
```

**Respuesta:**
```json
{
  "message": "Entrada registrada exitosamente",
  "asistencia": {...},
  "hora_entrada": "08:30:00"
}
```

### 2. Registrar Salida
**POST** `/api/asistencia/salida`

**Body:**
```json
{
  "id_asistencia": 1,
  "observacion": "Opcional"
}
```

**Respuesta:**
```json
{
  "message": "Salida registrada exitosamente",
  "asistencia": {...},
  "hora_salida": "10:30:00",
  "duracion": "02:00:00"
}
```

### 3. Consultar Mi Registro de Hoy
**GET** `/api/asistencia/mi-registro-hoy`

Query params:
- `id_actividad_fk`: ID de la actividad (requerido)
- `id_persona_fk`: ID de la persona (requerido)

**Respuesta:**
```json
{
  "tiene_registro": true,
  "asistencia": {...},
  "hora_entrada": "08:30:00",
  "hora_salida": "10:30:00",
  "duracion": "02:00:00"
}
```

### 4. Historial de Asistencias
**GET** `/api/asistencia/historial`

Query params:
- `id_persona_fk`: ID de la persona (requerido)
- `fecha_inicio`: Fecha inicio (opcional)
- `fecha_fin`: Fecha fin (opcional)
- `per_page`: Resultados por página (default: 15)

**Respuesta:** Paginación con listado de asistencias

### 5. Asistencias por Actividad
**GET** `/api/asistencia/actividad/{id_actividad}`

**Respuesta:**
```json
{
  "actividad": {...},
  "asistencias": {
    "data": [...]
  },
  "estadisticas": {
    "total": 30,
    "con_salida": 28,
    "sin_salida": 2,
    "con_permiso": 3
  }
}
```

### 6. Registrar Permiso
**POST** `/api/asistencia/permiso`

**Body:**
```json
{
  "id_actividad_fk": 1,
  "id_persona_fk": 1,
  "observacion": "Motivo del permiso (requerido)"
}
```

### 7. Estadísticas de Asistencia
**GET** `/api/asistencia/estadisticas`

Query params opcionales:
- `id_persona_fk`: Filtrar por persona
- `id_actividad_fk`: Filtrar por actividad
- `fecha_inicio`: Desde
- `fecha_fin`: Hasta

**Respuesta:**
```json
{
  "total_registros": 50,
  "presentes": 45,
  "permisos": 5,
  "con_salida_registrada": 43,
  "sin_salida_registrada": 2
}
```

---

## 🔐 Flujo de Uso para App Móvil

### 1. Login
```
POST /api/auth/login
Body: { "login": "usuario", "password": "password" }
→ Guardar access_token (válido 4 horas)
```

### 2. Consultar Actividades del Día
```
GET /api/actividades/hoy
→ Mostrar lista de actividades
```

### 3. Verificar Si Ya Marqué Hoy
```
GET /api/asistencia/mi-registro-hoy?id_actividad_fk=1&id_persona_fk=1
→ Si tiene_registro=false, mostrar botón "Marcar Entrada"
→ Si tiene entrada pero no salida, mostrar botón "Marcar Salida"
```

### 4. Marcar Entrada
```
POST /api/asistencia/entrada
Body: { "id_actividad_fk": 1, "id_persona_fk": 1 }
→ Mostrar confirmación con hora de entrada
```

### 5. Marcar Salida
```
POST /api/asistencia/salida
Body: { "id_asistencia": 1 }
→ Mostrar confirmación con duración total
```

### 6. Ver Mi Historial
```
GET /api/asistencia/historial?id_persona_fk=1
→ Listar asistencias previas
```

---

## ⚠️ Códigos de Error Comunes

- **401**: Token inválido o expirado → Hacer login nuevamente
- **404**: Recurso no encontrado
- **422**: Validación fallida (ver campo "errors")
- **500**: Error del servidor

---

## 📱 Recomendaciones para App Móvil

1. **Almacenar token de forma segura** (SecureStorage/Keychain)
2. **Implementar refresh automático** antes de que expire el token
3. **Caché local** de actividades del día
4. **Sincronización offline** para registros pendientes
5. **Validar conectividad** antes de llamadas a API
6. **Mostrar hora local** del dispositivo en registros
