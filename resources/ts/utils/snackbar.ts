import $ from 'jquery';

export function mostrarSnackbar(mensaje: string, tipo: 'success' | 'danger' | 'info' | 'warning' = 'success'): void {
    const snackbar = $('#snackbar');
    const snackbarText = $('#snackbar-text');

    snackbar
        .removeClass('d-none bg-success bg-danger bg-info bg-warning')
        .addClass(`bg-${tipo}`)
        .fadeIn(300);

    snackbarText.text(mensaje);

    setTimeout(() => {
        snackbar.fadeOut(500, () => snackbar.addClass('d-none'));
    }, 3000);
}
