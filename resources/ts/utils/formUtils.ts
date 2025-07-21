import $ from 'jquery';

/**
 * Obtiene los valores de un conjunto de campos de formulario por ID.
 * @param campos Array de nombres de ID de campos (sin #)
 * @returns Un objeto con los pares clave-valor
 */

export function obtenerDatosFormulario(campos: string[]): Record<string, any> {
    const datos: Record<string, any> = {};
    campos.forEach(campo => {
        datos[campo] = $(`#${campo}`).val();
    });
    return datos;
}

/**
 * Muestra mensajes de error debajo de los campos correspondientes.
 * @param errores Objeto de errores provenientes de Laravel
 */

export function mostrarErroresValidacion(errores: Record<string, string[]>) {
    // Limpiar errores anteriores
    $('[id^="error-"]').html('');
    Object.entries(errores).forEach(([campo, mensajes]: [string, string[]]) => {
        const mensaje = mensajes[0]; // Solo mostramos el primero
        $(`#error-${campo}`).html(mensaje);
    });
}

/**
 * Resetea un formulario y limpia errores
 * @param selector ID del formulario (ej: '#form-create-paciente')
 */

export function resetearFormulario(selector: string) {
    ($(selector)[0] as HTMLFormElement).reset();
    $('[id^="error-"]').html('');
}

/**
 * Recarga contenido HTML vía AJAX y lo inyecta en un contenedor
 * @param selector ID del contenedor donde se inyectará el contenido
 * @param url Ruta que se solicitará por AJAX
 */

export function recargarContenidoAjax(selector: string, url: string) {
    $.ajax({
        url,
        type: 'GET',
        success: function (html) {
            $(selector).html(html);
        },
        error: function (err) {
            console.error(`❌ Error al recargar contenido desde ${url}`, err);
        }
    });
}

/**
 * Deshabilita todos los campos editables dentro de un formulario.
 * Excluye botones, botones de tipo submit/reset y campos ocultos.
 * @param selector ID del formulario (ej: '#form-create-paciente')
 */
export function bloquearInputsFormulario(selector: string) {
    $(`${selector} input, ${selector} select, ${selector} textarea`)
        .not(':button, [type="submit"], [type="reset"], [type="hidden"]')
        .prop('disabled', true);
}

/**
 * Habilita todos los campos editables dentro de un formulario.
 * @param selector ID del formulario (ej: '#form-create-paciente')
 */
export function desbloquearInputsFormulario(selector: string) {
    $(`${selector} input, ${selector} select, ${selector} textarea`)
        .not(':button, [type="submit"], [type="reset"], [type="hidden"]')
        .prop('disabled', false);
}
