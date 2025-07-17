import axios from 'axios';
import $ from 'jquery';
console.log('📦 pacientes.ts cargado');


// Asegura que Laravel identifique la petición como AJAX
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(document).ready(() => {
    // Envío de formulario
    $('#form-create-paciente').on('submit', function (e) {
        e.preventDefault();

        const data = {
            nombres: $('#nombres').val(),
            apellidos: $('#apellidos').val(),
            tipo_documento_id: $('#tipo_documento_id').val(),
            numero_documento: $('#numero_documento').val(),
            fecha_nacimiento: $('#fecha_nacimiento').val(),
            sexo: $('#sexo').val(),
            direccion: $('#direccion').val(),
            telefono: $('#telefono').val(),
        };

        axios.post('/pacientes', data)
            .then(response => {
                mostrarSnackbar('Paciente creado correctamente', 'success');
                ($('#form-create-paciente')[0] as HTMLFormElement).reset();
                $('[id^="error-"]').html('');


                //Recargar la tabla de pacientes via AJAX
                $.ajax({
                    url: '/pacientes',
                    type: 'GET',
                    success: function (html) {
                        $('#pacientes-content').html(html);
                    },
                    error: function (err) {
                        console.error('❌ Error al recargar pacientes', err);
                    }
                });
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    mostrarSnackbar('Por favor, complete los campos requeridos.', 'danger');
                    const errores = error.response.data.errors;

                    // Limpiar errores anteriores
                    $('[id^="error-"]').html('');

                    Object.entries(errores).forEach(([campo, mensajes]: [string, string[]]) => {
                        const mensaje = mensajes[0]; // Solo mostramos el primero
                        $(`#error-${campo}`).html(mensaje);
                    });
                } else {
                    console.error('Error desconocido', error);
                    mostrarSnackbar('Ocurrió un error inesperado. Intente nuevamente.', 'danger');
                }
            });
    });

    // Manejo AJAX de paginación
    $(document).on('click', 'nav[role="navigation"] a', function (e) {
        e.preventDefault();

        const url = $(this).attr('href');
        console.log('🧭 Link paginación clickeado:', url);

        if (url) {
            history.pushState({}, '', url); // Opcional: cambia URL sin recargar
            $.ajax({
                url,
                type: 'GET',
                success: function (data) {
                    $('#pacientes-content').html(data);
                },
                error: function (err) {
                    console.error('❌ Error en paginación AJAX', err);
                }
            });
        }
    });

    function mostrarSnackbar(mensaje: string, tipo: 'success' | 'danger' | 'info' | 'warning' = 'success'): void {
        const snackbar = $('#snackbar');
        const snackbarText = $('#snackbar-text');

        // Quitar clases anteriores y aplicar la clase correspondiente al tipo
        snackbar
            .removeClass('d-none bg-success bg-danger bg-info bg-warning')
            .addClass(`bg-${tipo}`)
            .fadeIn(300);

        snackbarText.text(mensaje);

        // Ocultar después de 3 segundos
        setTimeout(() => {
            snackbar.fadeOut(500, () => snackbar.addClass('d-none'));
        }, 3000);
    }

});
