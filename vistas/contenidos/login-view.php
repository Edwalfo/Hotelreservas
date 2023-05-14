<body class="login-container">
    <div class="container-fluid">
        <div class="login-center">
            <div class="row">
                <div class="col-auto">
                    <div class="card border-dark">
                        <div class="card-header text-center  text-light bg-dark fw-bold">
                            <h5 class="fw-bold">Iniciar sesión</h5>

                        </div>
                        <div class="card-body">


                            <form action="" method="post" class="px-4 py-5" autocomplete="off">
                                <p class="fw-bold fs-4 text-success ">Bienvenido!</p>


                                <div class="input-group mb-3" id="usuario">

                                    <span class="input-group-text" id="input-user"><i class="bi bi-person-fill"></i></span>
                                    <input type="text" class="form-control  bg-light " name="inputUsuario" aria-describedby="input-user" placeholder="Usuario" maxlength="35" pattern="[a-zA-Z0-9]{1,35}" required>

                                </div>

                                <div class="input-group mb-3" id="input-pass">
                                    <span class="input-group-text"><i class=" bi bi-key-fill"></i></span>
                                    <input type="password" class="form-control bg-light" name="inputPassword" aria-describedby="input-pass" placeholder="Contraseña" maxlength="60" pattern="[A-Za-z\d$@$!%*?&]{5,60}" required>

                                </div>

                                <div class="mb-2 row">
                                    <div class=" col-xs-8 d-grid gap-3">
                                        <button type="submit" class="btn btn-success btnAction fw-bold">Acceder</button>
                                    </div>
                                </div>

                                <a href="">
                                    Recuperar contraseña
                                </a>


                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <footer class=" main-footer ">

        <div class=" text-muted">
            <strong> &copy;2022 Copyright: <b>Hotel</b> </strong>
        </div>

    </footer>

    <body>

    <?php
        if (isset($_POST['inputUsuario']) && isset($_POST['inputPassword'])) {
            require_once "./controladores/loginControlador.php";
            $ins_login = new loginControlador();

            echo $ins_login->iniciar_sesion_controlador();
        }
        ?>
