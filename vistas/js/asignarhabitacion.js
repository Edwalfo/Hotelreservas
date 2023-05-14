$(document).ready(function () {
    $('#select-huespedes').select2({
        placeholder: "Buscar huesped",
        theme: 'bootstrap-5',
        allowClear: true,

    });

});


const fechaEntrada = document.querySelector('#fechaEntrada');
const fechaSalida = document.querySelector('#fechaSalida');
const descuento = document.querySelector('#input-descuento');
const precio = document.getElementById('inputprecio-Habitacion');
const Talojamiento = document.getElementById('input-total-alojamiento');
const total = document.getElementById('inputTotal');
const formcheck = document.getElementById('form-checkin');
const metodoPago = document.querySelector('#select-metodo-pago');


function calcularDias(inicio,salida) {
    let diferencia = 0;

    let fechaInicio = new Date(inicio).getTime();
    let fechaFin = new Date(salida).getTime();

    let diff = fechaFin - fechaInicio;


    diferencia = diff / (1000 * 60 * 60 * 24);

    if (diferencia <= 0) {
        diferencia = 1;
    }

    return diferencia;

}


function calcular_total_pago() {

    let efectivo = parseInt(document.getElementById('input-efectivo').value);
    let tarjeta = parseInt(document.getElementById('input-tarjeta').value);
    let transferencia = parseInt(document.getElementById('input-transferencia').value);
    let otros = parseInt(document.getElementById('input-otros').value);

    return efectivo + tarjeta + transferencia + otros;
}

function calcular_costo_alojamiento() {
    dif = calcularDias(fechaEntrada.value,fechaSalida.value);

    valor = precio.value;

    let totalA = parseInt(valor) * parseInt(dif);
    return totalA
}


function calcularDescuento() {
    let desc = parseInt(descuento.value);
    if (isNaN(desc)) {
        desc = 0;

    }
    let total_alojamiento = parseInt(Talojamiento.value);
    if (desc > total_alojamiento) {
        document.getElementById('input-descuento').value = 0;

        Swal.fire({
            type: 'error',
            title: 'Ocurrio un error',
            text: 'Agrego un descuento muy alto',
            confirmButtonText: 'Aceptar'

        })

    }
    else {

        let resultado = total_alojamiento - desc;

        if (resultado <= 0) {
            resultado = 0;
        } else if (isNaN(resultado)) {

            resultado = 0;

        }
        return resultado;

    }

}
formcheck?.addEventListener("input", function (event) {

    document.getElementById('input-total-alojamiento').value = calcular_costo_alojamiento();
    resDescuento = calcularDescuento();
    if (resDescuento === undefined) {
        document.getElementById('inputTotal').value = Talojamiento.value;

    } else {
        document.getElementById('inputTotal').value = resDescuento;
    }

    document.getElementById('input-totalpagado').value = calcular_total_pago();
});


metodoPago?.addEventListener('change', (event) => {
    opcion = event.target.value;

    if (opcion == 1) {
        document.querySelector('.efectivo').style.display = 'block';

    } else if (opcion == 2) {

        document.querySelector('.tarjeta').style.display = 'block';

    } else if (opcion == 3) {
        document.querySelector('.transferencia').style.display = 'block';

    } else if (opcion == 4) {
        document.querySelector('.otros').style.display = 'block';

    }

    metodoPago.value = 0;

});

const btnefectivo = document.getElementById('eliminar-efectivo');
const btntarjeta = document.getElementById('eliminar-tarjeta');
const btntransferencia = document.getElementById('eliminar-transferencia');
const btnotros = document.getElementById('eliminar-otros');

btnefectivo?.addEventListener("click", function () {
    document.querySelector('.efectivo').style.display = 'none';
    document.getElementById('input-efectivo').value = 0;
    document.getElementById('input-totalpagado').value = calcular_total_pago();

});

btntarjeta?.addEventListener("click", function () {
    document.querySelector('.tarjeta').style.display = 'none';
    document.getElementById('input-tarjeta').value = 0;
    document.getElementById('input-totalpagado').value = calcular_total_pago();

});

btntransferencia?.addEventListener("click", function () {
    document.querySelector('.transferencia').style.display = 'none';
    document.getElementById('input-transferencia').value = 0;
    document.getElementById('input-totalpagado').value = calcular_total_pago();

});

btnotros?.addEventListener("click", function () {
    document.querySelector('.otros').style.display = 'none';
    document.getElementById('input-otros').value = 0;
    document.getElementById('input-totalpagado').value = calcular_total_pago();

});











