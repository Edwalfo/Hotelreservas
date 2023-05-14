var formularios_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e) {

    e.preventDefault();
    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");
    let tipo = this.getAttribute("data-form");
    let encabezados = new Headers();


    let config = {
        method: method,
        headers: encabezados,
        mode: 'cors',
        cache: 'no-cache',
        body: data
    }

    let texto_alerta;
    if (tipo === 'save') {
        texto_alerta = "Los datos quedaran guardados en el sistema";
    } else if (tipo === 'delete') {
        texto_alerta = "Los datos seran eliminados del sistema";
    } else if (tipo === 'update') {
        texto_alerta = "Los datos seran actualizados";
    } else if (tipo === 'seach') {
        texto_alerta = "Se eliminaran los termino de busqueda y tendra que escribir uno nuevo";
    } else if (tipo === 'loans') {
        texto_alerta = "Desea remove los datos seleccionado de reservas";
    } else if (tipo === 'exit') {
        texto_alerta = "Guardar registro de salida y mandar la habitacion a limpieza";
    } else {
        texto_alerta = "Quieres realizar la operacion solicitada";
    }

    Swal.fire({
        title: '¿Estas seguro?',
        text: texto_alerta,
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            fetch(action, config)
                .then(respuesta => respuesta.json())
                .then(respuesta => {
                    return alertas_ajax(respuesta);
                });
        }
    })
}

formularios_ajax.forEach(formularios => {
    formularios.addEventListener("submit", enviar_formulario_ajax);

});

function alertas_ajax(alerta) {
    if (alerta.Alerta === 'simple') {
        Swal.fire({
            type: alerta.Tipo,
            title: alerta.Titulo,
            text: alerta.Texto,
            confirmButtonText: 'Aceptar'
        });

    } else if (alerta.Alerta === 'recargar') {

        Swal.fire({
            type: alerta.Tipo,
            title: alerta.Titulo,
            text: alerta.Texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                location.reload();

            }
        })

    } else if (alerta.Alerta === 'limpiar') {
        Swal.fire({
            type: alerta.Tipo,
            title: alerta.Titulo,
            text: alerta.Texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.value) {
                location.reload();
                document.querySelector(".FormularioAjax");

            }
        })

    } else if (alerta.Alerta === 'redireccionar') {

        window.location.href = alerta.URL;

    }

}




