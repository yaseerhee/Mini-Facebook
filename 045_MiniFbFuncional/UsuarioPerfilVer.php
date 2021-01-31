<?php
// REQUERIMIENTOS
require_once "_Varios.php";
require_once "DAO.php";

// OBTENEMOS LA INFO DEL USUARIO QUE ESTAMOS USANDO
$id = (int)$_SESSION["id"];
$usuario = DAO::obtenerUsuarioPorId($id);
?>

<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/superhero/bootstrap.min.css">
</head>

<body>
    <!-- MOSTRAMOS LA INFORMACION DE LA SESION -->
    <!-- si no existe te muestra dos botones o para iniciar o registrarse -->
    <div class="container">
        <?php DAO::pintarInfoSesion() ?>
        <form class="col-md-12 text-center" method='post' action='UsuarioPerfilGuardar.php'>
            <h1 class="text-center">USUARIO</h1>
            <input type='hidden' name='id' value='<?= $id ?>' />
            <label class="col-sm-5 text-center" for='identificador' style="font-size:22px;">Identificador</label> <br>
            <input class="col-sm-5" type='text' name='identificador' value='<?= $usuario["identificador"] ?>' />
            <br />
            <label class="col-sm-5 text-center" for='contrasenna' style="font-size:22px;">Contraseña</label> <br>
            <input class="col-sm-5" type='text' name='contrasenna' value='<?= $usuario["contrasenna"] ?>' />
            <br />

            <label class="col-sm-5 text-center" for='nombre' style="font-size:22px;">Nombre</label><br>
            <input class="col-sm-5" type='text' name='nombre' value='<?= $usuario["nombre"] ?>' />
            <br />

            <label class="col-sm-5 text-center" for='apellidos' style="font-size:22px;">Apellidos</label><br>
            <input class="col-sm-5" type='text' name='apellidos' value='<?= $usuario["apellidos"] ?>' />
            <br />

            <br />
            <input class="btn btn-outline-danger col-sm-5 mb-3" type='submit' name='guardar' value='Guardar cambios' /><br>
            <a class="btn btn-outline-success col-sm-5" href='MuroVerGlobal.php'>Ir al Muro Global</a><br>
            <a class="btn btn-outline-success col-sm-5" href='MuroVerDe.php?id=<?= $_SESSION["id"] ?>'>Ir a mi muro.</a><br>

        </form>
    </div>
</body>

</html>