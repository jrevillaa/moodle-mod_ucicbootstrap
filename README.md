Bootstrap Elements
============================
Bootstrap Elements gives you the ability to add modal and toggles to your courses, helping to improve the layout of courses. It is in essence an improved "label" resource type with an opton allowing you to set content to display as a:

* Modal box (popup box)
* Toggle (expandable / drop-down content
* Enhanced Label (with title, really designed so you can turn off Bootstrap features and have content display statically)

This will help teachers add more dynamic, interactive content within courses whilst consuming less space on the page. 

**Please note**: This plugin will only work with themes that are based on Bootstrap and have support for for the Bootstrap elements referenced by this plugin. 

Themes known to work with this plugin are:
* BCU Theme
* Essential Theme
* Shoehorn Theme

We will expand this list to include other themes as we confirm their compatibility.

**Future Plans**:

* Auto detect theme compatability and fall back on non supported themes (so multiple themes in the same site can be supported)
* Add Fontawesome options to easily add icons
* Add color options
* Add additional icon to Toggle to make it clear it is clickable
* Look at other elements such as callouts and possibly Tabs / Accordion

If you have any other suggestions for improvement please let us know!

Maintainer
----------
This plugin has been written and is currently maintained by Michael Grant working at Birmingham City University.


# Documentación de Stored Procedures - Sistema EDUCA+

## Package PQ_CONFIGURACION

| **Procedimiento** | **Descripción** | **Inputs** | **Outputs** | **Posibles Errores** |
|-------------------|-----------------|------------|-------------|---------------------|
| **USP_INSUPD_FECHAS_ETAPA** | Inserta o actualiza configuraciones de fechas para etapas de procesos | **IN OUT** p_id_fechas_etapa (NUMBER)<br/>**IN** p_anio (NUMBER)<br/>**IN** p_id_proceso (NUMBER)<br/>**IN** p_id_etapa (NUMBER)<br/>**IN** p_lote (VARCHAR2)<br/>**IN** p_fecha_inicio (DATE)<br/>**IN** p_fecha_fin (DATE)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-5**: Fecha inicio >= fecha fin<br/>**-2**: Configuración no encontrada<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores SQL |
| **USP_LISTAR_FECHAS_ETAPA** | Lista fechas de etapas con filtros opcionales y estado calculado | **IN** p_anio (NUMBER, DEFAULT NULL)<br/>**IN** p_id_proceso (NUMBER, DEFAULT NULL)<br/>**IN** p_vigente (CHAR, DEFAULT 'SI') | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_OBTENER_FECHAS_ETAPA** | Obtiene una configuración específica de fechas de etapa | **IN** p_id_fechas_etapa (NUMBER) | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_ENVIAR_NOTIFICACION** | Registra una notificación para envío posterior | **IN** p_id_usuario (NUMBER)<br/>**IN** p_asunto (VARCHAR2)<br/>**IN** p_mensaje (CLOB)<br/>**IN** p_id_plantilla (NUMBER, DEFAULT NULL) | **OUT** p_id_notificacion (NUMBER)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores de inserción |

## Package PQ_EVALUACIONES

| **Procedimiento** | **Descripción** | **Inputs** | **Outputs** | **Posibles Errores** |
|-------------------|-----------------|------------|-------------|---------------------|
| **USP_INSUPD_EVALUACION** | Inserta o actualiza una evaluación de iniciativa | **IN OUT** p_id_evaluacion (NUMBER)<br/>**IN** p_id_iniciativa (NUMBER)<br/>**IN** p_id_etapa (NUMBER)<br/>**IN** p_id_usuario_evaluador (NUMBER)<br/>**IN** p_id_rubrica (NUMBER)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-2**: Evaluación no encontrada<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores SQL |
| **USP_INSUPD_EVALUACION_DETALLE** | Inserta o actualiza el detalle de evaluación de criterios | **IN** p_id_evaluacion (NUMBER)<br/>**IN** p_id_criterio (NUMBER)<br/>**IN** p_id_valoracion (NUMBER)<br/>**IN** p_comentarios (VARCHAR2)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-3**: Criterio ya calificado<br/>**-4**: Valoración no encontrada<br/>**-2**: Detalle no encontrado<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores |
| **USP_OBTENER_EVALUACION** | Obtiene una evaluación completa con sus criterios | **IN** p_id_evaluacion (NUMBER) | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_CALCULAR_PROMEDIO_EVALUACION** | Calcula y actualiza el promedio ponderado de una evaluación | **IN** p_id_evaluacion (NUMBER) | **OUT** p_promedio (NUMBER)<br/>**OUT** p_clasificacion (VARCHAR2)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-2**: Sin datos para calcular<br/>**SQLCODE**: Errores de cálculo |

## Package PQ_INICIATIVAS

| **Procedimiento** | **Descripción** | **Inputs** | **Outputs** | **Posibles Errores** |
|-------------------|-----------------|------------|-------------|---------------------|
| **USP_INSUPD_INICIATIVA** | Inserta o actualiza una iniciativa de innovación/réplica | **IN OUT** p_id_iniciativa (NUMBER)<br/>**IN** p_tipo (CHAR)<br/>**IN** p_id_usuario_creador (NUMBER)<br/>**IN** p_titulo (VARCHAR2)<br/>**IN** p_objetivo (VARCHAR2)<br/>**IN** p_desarrollo (VARCHAR2)<br/>**IN** p_impacto_deseado (VARCHAR2)<br/>**IN** p_id_categoria (NUMBER)<br/>**IN** p_id_eje_tematico (NUMBER)<br/>**IN** p_id_programa (NUMBER)<br/>**IN** p_necesidad_identificada (VARCHAR2)<br/>**IN** p_resultados_aplicacion (VARCHAR2)<br/>**IN** p_ciclos (VARCHAR2)<br/>**IN** p_iniciativa_grupal (CHAR)<br/>**IN** p_autoria (CHAR)<br/>**IN** p_id_proceso (NUMBER)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-2**: Iniciativa no editable<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores SQL |
| **USP_LISTAR_INICIATIVA** | Lista iniciativas con filtros opcionales | **IN** p_id_usuario (NUMBER, DEFAULT NULL)<br/>**IN** p_estado (VARCHAR2, DEFAULT NULL)<br/>**IN** p_id_programa (NUMBER, DEFAULT NULL)<br/>**IN** p_vigente (CHAR, DEFAULT 'SI') | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_OBTENER_INICIATIVA** | Obtiene una iniciativa específica con toda su información | **IN** p_id_iniciativa (NUMBER) | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_CAMBIAR_ESTADO_INICIATIVA** | Cambia el estado y etapa de una iniciativa con historial | **IN** p_id_iniciativa (NUMBER)<br/>**IN** p_nuevo_estado (VARCHAR2)<br/>**IN** p_nueva_etapa (NUMBER)<br/>**IN** p_motivo (VARCHAR2)<br/>**IN** p_id_usuario (NUMBER) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-2**: Iniciativa no encontrada<br/>**SQLCODE**: Otros errores SQL |
| **USP_OBTENER_BANDEJA_EVALUADOR** | Obtiene la bandeja de trabajo de un evaluador con priorización SLA | **IN** p_id_usuario (NUMBER) | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |

## Package PQ_RUBRICAS

| **Procedimiento** | **Descripción** | **Inputs** | **Outputs** | **Posibles Errores** |
|-------------------|-----------------|------------|-------------|---------------------|
| **USP_INSUPD_RUBRICA** | Inserta o actualiza una rúbrica de evaluación | **IN OUT** p_id_rubrica (NUMBER)<br/>**IN** p_descripcion (VARCHAR2)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-2**: Rúbrica no encontrada<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores SQL |
| **USP_LISTAR_RUBRICA** | Lista rúbricas disponibles | **IN** p_vigente (CHAR, DEFAULT 'SI') | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_OBTENER_RUBRICA** | Obtiene una rúbrica con sus criterios y pesos | **IN** p_id_rubrica (NUMBER) | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_INSUPD_CRITERIO** | Inserta o actualiza un criterio de evaluación | **IN OUT** p_id_criterio (NUMBER)<br/>**IN** p_descripcion (VARCHAR2)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-2**: Criterio no encontrado<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores SQL |
| **USP_INSUPD_RUBRICA_CRITERIO** | Asocia un criterio a una rúbrica con validación de peso total | **IN** p_id_rubrica (NUMBER)<br/>**IN** p_id_criterio (NUMBER)<br/>**IN** p_peso (NUMBER)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-3**: Peso excede 100%<br/>**-4**: Criterio ya existe<br/>**-2**: Relación no encontrada<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores |

## Package PQ_PROGRAMAS

| **Procedimiento** | **Descripción** | **Inputs** | **Outputs** | **Posibles Errores** |
|-------------------|-----------------|------------|-------------|---------------------|
| **USP_INSUPD_PROGRAMA** | Inserta o actualiza un programa académico | **IN OUT** p_id_programa (NUMBER)<br/>**IN** p_codigo (VARCHAR2)<br/>**IN** p_nombre (VARCHAR2)<br/>**IN** p_descripcion (VARCHAR2)<br/>**IN** p_id_facultad (NUMBER)<br/>**IN** p_nivel (VARCHAR2)<br/>**IN** p_modalidad (VARCHAR2)<br/>**IN** p_duracion (NUMBER)<br/>**IN** p_usuario (NUMBER)<br/>**IN** p_operacion (CHAR) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-3**: Código duplicado<br/>**-2**: Programa no encontrado<br/>**-1**: Operación inválida<br/>**SQLCODE**: Otros errores SQL |
| **USP_LISTAR_PROGRAMA** | Lista programas académicos con filtros opcionales | **IN** p_id_facultad (NUMBER, DEFAULT NULL)<br/>**IN** p_vigente (CHAR, DEFAULT 'SI') | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_OBTENER_PROGRAMA** | Obtiene un programa específico con información completa | **IN** p_id_programa (NUMBER) | **OUT** p_resultado (SYS_REFCURSOR)<br/>**OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **SQLCODE**: Errores en consulta |
| **USP_ELIMINAR_PROGRAMA** | Marca un programa como eliminado con validación de dependencias | **IN** p_id_programa (NUMBER)<br/>**IN** p_usuario (NUMBER) | **OUT** p_error_code (NUMBER)<br/>**OUT** p_error_desc (VARCHAR2) | **-2**: Tiene iniciativas asociadas<br/>**-3**: Programa no encontrado<br/>**SQLCODE**: Otros errores SQL |

## Códigos de Error Estándar

| **Código** | **Descripción** |
|------------|-----------------|
| **0** | Operación exitosa |
| **-1** | Operación inválida (I/U) |
| **-2** | Registro no encontrado o no editable |
| **-3** | Violación de constraint o regla de negocio |
| **-4** | Registro duplicado o ya existe |
| **-5** | Validación de datos fallida |
| **SQLCODE** | Error específico de Oracle Database |

Fuentes
