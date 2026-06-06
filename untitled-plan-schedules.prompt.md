## Plan: Actualizar módulo de Horarios (schedules)

TL;DR - Implementar soporte backend para las nuevas tablas `schedules`, `schedule_days` y `schedule_days_times`, reutilizando la UI/JS existente; cambios mínimos en PHP (`asset/sendCrud.php`) para exponer CRUD y devolver JSON que consume `js/schedules.js`.

**Steps**
1. Añadir handlers en `asset/sendCrud.php` para: `send-schedule-create`, `send-schedule-update`, `send-schedule-delete`, `send-get-schedules` (dependencia: none).
2. Implementar métodos privados en `asset/sendCrud.php`: `scheduleCreate()`, `scheduleUpdate()`, `scheduleDelete()`, `scheduleGet()` que manejen transacciones y operen sobre `schedules`, `schedule_days`, `schedule_days_times`.
3. Mapear y validar la estructura POST que ya usa `js/schedules.js` (FormData: `role`, `days[]`, `times[][]`, `date_ranges[][]`, `notes`, `active`, `id` si actualiza) dentro de los métodos PHP.
3.1. Añadir columnas `start_date` (DATE NULL) y `end_date` (DATE NULL) a `schedule_days_times` para persistir `date_ranges` por franja horaria (evita crear tabla nueva). (Requiere alter table en la BD y backup previo.)
4. En `scheduleGet()` devolver JSON con la estructura esperada por frontend: {id, role, estado, days:[...], times:[{start_time,end_time,start_date,end_date}], notes, active}.
5. Añadir manejo de errores y respuestas consistentes (`dataType: 'json'`), códigos y mensajes en `sendCrud.php` para que el frontend muestre `divContent.success`/`divContent.error`.
6. (Opcional) Escribir pequeña migración SQL o script PHP para migrar datos desde la tabla antigua `horario` a las nuevas tablas, si se desea conservar horarios previos (separado, optativo).
7. Verificación: pruebas manual de crear/editar/eliminar/leer plantillas de horarios desde la interfaz `interfaces/schedules.php` y pruebas automáticas mínimas (curl/postman) a `asset/sendCrud.php` para cada handler.

**Relevant files**
- `asset/sendCrud.php` — Añadir handlers y métodos CRUD para schedules (principal cambio).
- `interfaces/schedules.php` — UI existente, **no cambiar** salvo ajustes mínimos si son necesarios para parámetros POST.
- `js/schedules.js` — JS existente; usar tal cual; validar que `scheduleGet()` devuelve la estructura esperada.
- `database.sql` — Esquema ya contiene `schedules`, `schedule_days`, `schedule_days_times`.
- `css/dashboard.css`, `css/manifest-styles.css` — Reusar clases existentes para estilo.

**Verification**
1. Ejecutar UI: abrir `interfaces/schedules.php` y crear una plantilla de horario; comprobar inserciones en `schedules`, `schedule_days`, `schedule_days_times` (MySQL client o phpMyAdmin).
2. Llamar `send-get-schedules` y verificar JSON coincide con lo que `js/schedules.js` consume (keys y tipos).
3. Editar una plantilla y comprobar que se actualiza (days/times reemplazados con nueva data) y que `estado` cambia al eliminar.
4. Comprobación rápida de regresión: ejecutar flujo de asistencia existente (si depende de `horario`) para asegurar que nada se rompe — documentar si se decide migrar o mantener `horario` antigua.

**Decisions / Assumptions**
- Mantener la UI/JS tal cual; el trabajo se centra en backend PHP.
- No se migrará automáticamente la tabla `horario` a menos que lo autorices (es opcional).
- Usar la misma librería jQuery y patrones AJAX existentes para coherencia.

**Further Considerations**
1. ¿Quieres que incluya la migración automática desde `horario` a las nuevas tablas? (Recomendado solo si hay datos relevantes).
2. ¿Prefieres que las operaciones devuelvan mensajes humanos en español o un esquema de respuesta estándar (code/message/data)?

---
Plan listo para refinamiento.
