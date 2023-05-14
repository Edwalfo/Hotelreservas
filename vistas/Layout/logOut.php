<script>
    let linkSalir = document.querySelector(".link-salir");
    linkSalir.addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({

            title: '¿Desea salir del sistema?',
            text: 'Tu sesion sera cerrada',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, aceptar',
            cancelButtonText: 'No, Cancelar'


        }).then((result) => {
            if (result.value) {

                let url = '<?php echo SERVERURL; ?>ajax/loginAjax.php';
                let token = '<?php echo $loginC->encryption($_SESSION['token_SHotel']); ?>';
                let usuario = '<?php echo $loginC->encryption($_SESSION['usuario_SHotel']); ?>';

           
                let datos = new FormData();
                datos.append("token", token);
                datos.append("usuario", usuario);
                fetch(url, {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        return alertas_ajax(respuesta);
                    });
            }

        });

    });
</script>