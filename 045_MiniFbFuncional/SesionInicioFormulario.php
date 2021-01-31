<?php
require_once "_Varios.php";
require_once "DAO.php";

if (DAO::haySesionRamIniciada()) redireccionar("MuroVerGlobal.php");

$datosErroneos = isset($_REQUEST["datosErroneos"]);
?>



<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/superhero/bootstrap.min.css">
</head>



<body>

    <h1 class="text-center">Iniciar sesión</h1>

    <?php if ($datosErroneos) { ?>
        <p style='color: red;'>No se ha podido iniciar sesión con los datos proporcionados. Inténtelo de nuevo.</p>
    <?php } ?>

    <form action='SesionInicioComprobar.php' method="post">
        <input class="col-sm-5" type='text' name='identificador' placeholder="Identificador / Nombre de usuario"><br><br>
        <input class="col-sm-5" type='password' name='contrasenna' id='contrasenna' placeholder="Contraseña"><br><br>

        <label for='recordar'>Recuérdame aunque cierre el navegador</label>
        <input type='checkbox' name='recordar' id='recordar'><br><br>

        <input  class="btn btn-outline-success col-sm-5" type='submit' value='Iniciar Sesión'>
    </form>

    <p>O, si no tienes una cuenta aún, <a href='UsuarioNuevoFormulario.php'>créala aquí</a>.</p>

</body>

</html>