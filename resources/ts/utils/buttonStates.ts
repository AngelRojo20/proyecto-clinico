import $ from 'jquery';

/**
 * Estado inicial: Solo el botón Guardar habilitado (modo "crear").
 */
export function establecerEstadoInicialBotones(
    $btnGuardar: JQuery,
    $btnModificar: JQuery,
    $btnEliminar: JQuery
) {
    $btnGuardar.text('Guardar').data('accion', 'crear').prop('disabled', false);
    $btnModificar.prop('disabled', true);
    $btnEliminar.prop('disabled', true);
}

/**
 * Después de seleccionar un registro de la tabla:
 * Solo Modificar habilitado, Guardar y Eliminar deshabilitados.
 */
export function establecerEstadoConRegistroSeleccionado(
    $btnGuardar: JQuery,
    $btnModificar: JQuery,
    $btnEliminar: JQuery
) {
    $btnGuardar.prop('disabled', true);
    $btnModificar.prop('disabled', false);
    $btnEliminar.prop('disabled', true);
}

/**
 * Cuando se presiona Modificar:
 * Todos habilitados. Guardar cambia a modo "Actualizar".
 */
export function activarModoEdicion(
    $btnGuardar: JQuery,
    $btnModificar: JQuery,
    $btnEliminar: JQuery
) {
    $btnGuardar.text('Actualizar').data('accion', 'editar').prop('disabled', false);
    $btnModificar.prop('disabled', false);
    $btnEliminar.prop('disabled', false);
}
