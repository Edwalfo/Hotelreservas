

const idUsuarios = document.querySelectorAll(".edictarUsuario");
const modelupdateUsuario = document.getElementById('model-updateUsuario');

function cargarId(event) {
    let valor = event.currentTarget.value;

    const datos = valor.split("-");
    console.log(valor)
    const modalTitle = modelupdateUsuario.querySelector('.modal-title')
    document.getElementById('input-Upid').value = datos[0];
    document.getElementById('input-UpusuarioNombre').value = datos[1];
    document.getElementById('input-UptipoUsuario').value = datos[2];
    document.getElementById('input-UpcorreoUsuario').value = datos[3];
    document.getElementById('input-upUser').value = datos[4];
    document.getElementById('input-UpusuarioPassword').value = datos[5];
    document.getElementById('input-UpusuarioPassword2').value = datos[5];
    document.getElementById('input-UpEstado').value = datos[6];


    modalTitle.textContent = `Actualizar usuario ${datos[1]}`


}

idUsuarios.forEach(id => {
    id.addEventListener("click", cargarId);

});

const idtipoHabitacion = document.querySelectorAll(".edictarTipohabitacion");
const modelupdateTipohabitacion = document.getElementById('model-upCategoria');

function cargarIdtipohabitacion(event) {
    let valor = event.currentTarget.value;

    const datos = valor.split("-");
    console.log(datos[2])



    document.getElementById('input-Upid').value = datos[0];
    document.getElementById('input-tipoNombreH').value = datos[1];
    document.getElementById('input-upcostoTipo').value = datos[2];
    document.getElementById('input-updescripcion').value = datos[3];
    document.getElementById('input-upEstadoHtipo').value = datos[4];


}

idtipoHabitacion.forEach(id => {
    id.addEventListener("click", cargarIdtipohabitacion);

});

const idHabitacion = document.querySelectorAll(".edictarHabitacion");
const modelupdatehabitacion = document.getElementById('model-upHabitacion');

function cargarIdhabitacion(event) {
    let valor = event.currentTarget.value;

    const datos = valor.split("-");
    console.log(valor)


    document.getElementById('input-Upid').value = datos[0];
    document.getElementById('input-upnumero').value = datos[1];
    document.getElementById('input-upestadoactual').value = datos[2];
    document.getElementById('input-upEstado').value = datos[3];
    document.getElementById('input-uptipoHabitacion').value = datos[4];


}

idHabitacion.forEach(id => {
    id.addEventListener("click", cargarIdhabitacion);

});

const idtipodocumento = document.querySelectorAll(".edictarTipodocumento");
const modelupdatedocumento = document.getElementById('model-uptipodocumento');

function cargarIdTdocumento(event) {
    let valor = event.currentTarget.value;

    const datos = valor.split("-");
    console.log(valor)

    document.getElementById('input-Upid').value = datos[0];
    document.getElementById('input-uptipoDocNombre').value = datos[1];
    document.getElementById('input-upestadoTdoc').value = datos[2];
}

idtipodocumento.forEach(id => {
    id.addEventListener("click", cargarIdTdocumento);

});

const idhuesped = document.querySelectorAll(".edictarhuesped");
const modeluphuesped = document.getElementById('model-upHuesped');

function cargarIdTdocumento(event) {
    let valor = event.currentTarget.value;

    const datos = valor.split("-");
    console.log(valor)

    document.getElementById('input-Upid').value = datos[0];
    document.getElementById('input-uphuespedNombre').value = datos[1];
    document.getElementById('input-uptipoDocumento').value = datos[2];
    document.getElementById('input-upDireccion').value = datos[7];
    document.getElementById('input-upTelefono').value = datos[8];
    document.getElementById('input-upcorreo').value = datos[9];
    document.getElementById('input-upestadohuesped').value = datos[10];
    document.getElementById('input-upnDocumento').value = datos[3];
    document.getElementById('input-upfNacimiento').value = datos[4] + "-" + datos[5] + "-" + datos[6];

}

idhuesped.forEach(id => {
    id.addEventListener("click", cargarIdTdocumento);

});


const aLimpiar = document.querySelectorAll(".aLimpiar");
const modelLimpiar = document.getElementById('modal-limpiar');

function traerID(event) {
    let valor = event.currentTarget.rel;

    const datos = valor.split("-");
    console.log(valor)

    const modalTitle = modelLimpiar.querySelector('.modal-title')
    document.getElementById('input-idhabitacion').value = datos[0];
    //document.getElementById('input-UpusuarioNombre').value = datos[1];



    modalTitle.textContent = `Limpiar habitación ${datos[1]}`


}

aLimpiar.forEach(id => {
    id.addEventListener("click", traerID);

});



const idtipo = document.querySelector('#input-tipoHab2');
const fcheckin = document.querySelector('#inputcheckin2');
const fcheckout = document.querySelector('#inputcheckout2');
const tmostrar = document.querySelector('#text-res');

fcheckin?.addEventListener("input", function (event) {
  
    if (tmostrar.textContent != "" || idtipo.value!=0) {
        ajax();

    }
});

fcheckout?.addEventListener("input", function (event) {
  
    if (tmostrar.textContent != "" || idtipo.value!=0) {
        ajax();

    }

});

function ajax() {
    dif = calcularDias(fcheckin.value, fcheckout.value);
    id = idtipo.value
    if (!isNaN(dif)) {
        $.ajax({
            url: '../ajax/reservaAjax.php',
            type: 'POST',
            data: { "id_tipo": id },
            success: function (res) {
                $('#text-res').html("Costo habitación $" + res + "<br>Número dias " + dif + "<br> Total  $" + res * dif);

            }

        })


    }

}
$('#input-tipoHab2')?.change(function () {

    ajax();

})












