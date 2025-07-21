import axios from 'axios';
import $ from 'jquery';
import { mostrarSnackbar } from '../utils/snackbar';
import {
    obtenerDatosFormulario,
    mostrarErroresValidacion,
    resetearFormulario,
    recargarContenidoAjax,
    bloquearInputsFormulario,
    desbloquearInputsFormulario
} from '../utils/formUtils';
import {
    establecerEstadoInicialBotones,
    establecerEstadoConRegistroSeleccionado,
    activarModoEdicion
} from '../utils/buttonStates';


console.log('📦 pacientes.ts cargado');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

$(() => {
    const camposPaciente = [
        'nombres', 'apellidos', 'tipo_documento_id', 'numero_documento',
        'fecha_nacimiento', 'sexo', 'direccion', 'telefono'
    ];

    // Envío de formulario
    $('#form-create-paciente').on('submit', function (e) {
        e.preventDefault();

        const data = obtenerDatosFormulario(camposPaciente);

        axios.post('/pacientes', data)
            .then(() => {
                mostrarSnackbar('Paciente creado correctamente', 'success');
                resetearFormulario('#form-create-paciente');
                recargarContenidoAjax('#pacientes-content', '/pacientes');
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    mostrarSnackbar('Por favor, complete los campos requeridos.', 'danger');
                    mostrarErroresValidacion(error.response.data.errors);
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

    const $btnGuardar = $('#btn-guardar');
    const $btnModificar = $('#btn-modificar');
    const $btnEliminar = $('#btn-eliminar');
    const $btnLimpiar = $('#btn-limpiar');

    establecerEstadoInicialBotones($btnGuardar, $btnModificar, $btnEliminar);


    function limpiarFormulario() {
        establecerEstadoInicialBotones($btnGuardar, $btnModificar, $btnEliminar);
        resetearFormulario('#form-create-paciente');
        desbloquearInputsFormulario('#form-create-paciente');
        pacienteSeleccionadoId = null;
        $('.fila-paciente').removeClass('table-active');
    }

    $(document).on('dblclick', '.fila-paciente', function () {
        const id = $(this).data('id');
        if (!id) return;

        $('.fila-paciente').removeClass('table-active');
        $(this).addClass('table-active');

        pacienteSeleccionadoId = id;

        axios.get(`/pacientes/${id}`)
            .then(response => {
                const paciente = response.data;

                //Cambiar por el Serialize
                $('#nombres').val(paciente.nombres);
                $('#apellidos').val(paciente.apellidos);
                $('#tipo_documento_id').val(paciente.tipo_documento_id);
                $('#numero_documento').val(paciente.numero_documento);
                $('#fecha_nacimiento').val(paciente.fecha_nacimiento);
                $('#sexo').val(paciente.sexo);
                $('#direccion').val(paciente.direccion);
                $('#telefono').val(paciente.telefono);

                bloquearInputsFormulario('#form-create-paciente');
                establecerEstadoConRegistroSeleccionado($btnGuardar, $btnModificar, $btnEliminar);
            })
            .catch(error => {
                console.error('❌ Error al obtener paciente', error);
            });
    });

    $btnModificar.on('click', () => {
        activarModoEdicion($btnGuardar, $btnModificar, $btnEliminar);
        desbloquearInputsFormulario('#form-create-paciente');
    });

    $btnLimpiar.on('click', () => {
        limpiarFormulario();
    });

    $btnGuardar.on('click', function (e) {
        e.preventDefault();

        const data = obtenerDatosFormulario(camposPaciente);
        const accion = $(this).data('accion') || 'crear';
        const url = accion === 'editar' ? `/pacientes/${pacienteSeleccionadoId}` : '/pacientes';

        const payload = { ...data };
        if (accion === 'editar') {
            payload['_method'] = 'PUT';
        }

        axios.post(url, payload)
            .then(() => {
                mostrarSnackbar(`Paciente ${accion === 'editar' ? 'actualizado' : 'creado'} correctamente`, 'success');
                limpiarFormulario();
                recargarContenidoAjax('#pacientes-content', '/pacientes');
            })
            .catch(error => {
                if (error.response?.status === 422) {
                    mostrarSnackbar('Por favor, complete los campos requeridos.', 'danger');
                    mostrarErroresValidacion(error.response.data.errors);
                } else {
                    console.error('Error desconocido', error);
                    mostrarSnackbar('Ocurrió un error inesperado.', 'danger');
                }
            });
    });

    $btnEliminar.on('click', () => {
        if (!pacienteSeleccionadoId) return;
        if (!confirm('¿Deseas eliminar este paciente?')) return;

        axios.delete(`/pacientes/${pacienteSeleccionadoId}`)
            .then(() => {
                mostrarSnackbar('Paciente eliminado correctamente.', 'success');
                limpiarFormulario();
                recargarContenidoAjax('#pacientes-content', '/pacientes');
            })
            .catch(error => {
                console.error('❌ Error al eliminar paciente', error);
                mostrarSnackbar('No se pudo eliminar el paciente.', 'danger');
            });
    });
});
