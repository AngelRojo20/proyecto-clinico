import axios from 'axios';
import $ from 'jquery';
import { mostrarSnackbar } from '../utils/snackbar';
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

    // Manejo de eventos para editar y eliminar pacientes
    let pacienteSeleccionadoId: number | null = null;

    // Referencias a botones
    const $btnGuardar = $('#btn-guardar');
    const $btnModificar = $('#btn-modificar');
    const $btnEliminar = $('#btn-eliminar');
    const $btnLimpiar = $('#btn-limpiar');

    // Estado inicial de botones
    $btnModificar.prop('disabled', true);
    $btnEliminar.prop('disabled', true);

    // Función para limpiar formulario
    function limpiarFormulario() {
        $('#form-create-paciente')[0].reset();
        pacienteSeleccionadoId = null;
        $btnGuardar.text('Guardar').data('accion', 'crear');
        $btnModificar.prop('disabled', true);
        $btnEliminar.prop('disabled', true);
        $('.fila-paciente').removeClass('table-active');
    }

    // Click sobre fila de paciente
    $(document).on('click', '.fila-paciente', function () {
        const id = $(this).data('id');
        if (!id) return;

        $('.fila-paciente').removeClass('table-active');
        $(this).addClass('table-active');

        pacienteSeleccionadoId = id;

        axios.get(`/pacientes/${id}`)
            .then(response => {
                const paciente = response.data;

                $('#nombres').val(paciente.nombres);
                $('#apellidos').val(paciente.apellidos);
                $('#tipo_documento_id').val(paciente.tipo_documento_id);
                $('#numero_documento').val(paciente.numero_documento);
                $('#fecha_nacimiento').val(paciente.fecha_nacimiento);
                $('#sexo').val(paciente.sexo);
                $('#direccion').val(paciente.direccion);
                $('#telefono').val(paciente.telefono);

                $btnModificar.prop('disabled', false);
                $btnEliminar.prop('disabled', false);
            })
            .catch(error => {
                console.error('❌ Error al obtener paciente', error);
            });
    });

    // Click en Modificar → activa modo edición
    $btnModificar.on('click', () => {
        $btnGuardar.text('Actualizar').data('accion', 'editar').prop('disabled', false);
    });

    // Click en Limpiar → limpia y resetea
    $btnLimpiar.on('click', () => {
        limpiarFormulario();
    });

    // Click en Guardar o Actualizar
    $btnGuardar.on('click', function (e) {
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

        const accion = $(this).data('accion') || 'crear';
        const url = accion === 'editar' ? `/pacientes/${pacienteSeleccionadoId}` : '/pacientes';

        // Para edición, usamos POST con _method='PUT'
        const payload = { ...data };
        if (accion === 'editar') {
            payload['_method'] = 'PUT';
        }

        axios.post(url, payload)
            .then(() => {
                mostrarSnackbar(`Paciente ${accion === 'editar' ? 'actualizado' : 'creado'} correctamente`, 'success');
                limpiarFormulario();
                recargarPacientes();
            })
            .catch(error => {
                if (error.response?.status === 422) {
                    mostrarSnackbar('Por favor, complete los campos requeridos.', 'danger');
                    const errores = error.response.data.errors;
                    $('[id^="error-"]').html('');
                    Object.entries(errores).forEach(([campo, mensajes]: [string, string[]]) => {
                        $(`#error-${campo}`).html(mensajes[0]);
                    });
                } else {
                    console.error('Error desconocido', error);
                    mostrarSnackbar('Ocurrió un error inesperado.', 'danger');
                }
            });
    });

    // Eliminar paciente
    $btnEliminar.on('click', () => {
        if (!pacienteSeleccionadoId) return;

        if (!confirm('¿Deseas eliminar este paciente?')) return;

        axios.delete(`/pacientes/${pacienteSeleccionadoId}`)
            .then(() => {
                mostrarSnackbar('Paciente eliminado correctamente.', 'success');
                limpiarFormulario();
                recargarPacientes();
            })
            .catch(error => {
                console.error('❌ Error al eliminar paciente', error);
                mostrarSnackbar('No se pudo eliminar el paciente.', 'danger');
            });
    });

    // Reutilizar recarga de la tabla
    function recargarPacientes() {
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
    }

});
