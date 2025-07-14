import axios from 'axios';
import $ from 'jquery';
console.log('📦 pacientes.ts cargado');


$(document).ready(() => {
    // Envío de formulario
    $('#form-create-paciente').on('submit', function (e) {
        e.preventDefault();

        const data = {
            nombre: $('#nombre').val(),
            apellido: $('#apellido').val(),
            email: $('#email').val(),
        };

        axios.post('/pacientes', data)
            .then(response => {
                $('#mensaje').html('<p>Paciente creado correctamente</p>');
                ($('#form-create-paciente')[0] as HTMLFormElement).reset();
                console.log('✅ Respuesta recibida:', response.data);
            })
            .catch(error => {
                if (error.response && error.response.status === 422) {
                    const errores = error.response.data.errors;
                    const mensajes = Object.values(errores)
                        .map((e: any) => `<li>${e}</li>`).join('');
                    $('#mensaje').html(`<ul>${mensajes}</ul>`);
                } else {
                    console.error('Error desconocido', error);
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
});
