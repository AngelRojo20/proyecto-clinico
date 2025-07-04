import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const mensaje: string = '¡TypeScript está funcionando correctamente!';
    console.log(mensaje);

    const div = document.createElement('div');
    div.textContent = mensaje;
    div.style.background = '#0f766e';
    div.style.color = '#ffffff';
    div.style.padding = '1rem';
    div.style.marginTop = '1rem';
    div.style.borderRadius = '8px';
    div.style.fontWeight = 'bold';

    document.body.prepend(div);
});
