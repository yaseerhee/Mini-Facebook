<?php
// REQUERIMIENTOS
require_once "_Varios.php";
require_once "DAO.php";

// SI HAY SESION ME ENVIA DIRECTAMENTE AL MUROGLOBAL
if (DAO::haySesionRamIniciada()) redireccionar("MuroVerGlobal.php");
// SI HAY ERROR 
$datosErroneos = isset($_REQUEST["datosErroneos"]);
?>

<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/superhero/bootstrap.min.css">
</head>

<body>
    <?php if ($datosErroneos) { ?>
        <!-- SI HAY ERROR DE CREDENCIALES -->
        <p style='color: red;'>No se ha podido iniciar sesión con los datos proporcionados. Inténtelo de nuevo.</p>
    <?php } ?>
    <form class="col-md-12 text-center" action='SesionInicioComprobar.php' method="post">
        <h1 class="text-center">Iniciar sesión</h1>
        <input class="col-sm-5" type='text' name='identificador' placeholder="Identificador / Nombre de usuario"><br><br>
        <input class="col-sm-5" type='password' name='contrasenna' id='contrasenna' placeholder="Contraseña"><br><br>
        <label for='recordar'>Recuérdame aunque cierre el navegador</label>
        <input type='checkbox' name='recordar' id='recordar'><br><br>
        <input class="btn btn-outline-success col-sm-5" type='submit' value='Iniciar Sesión'>
        <p>O, si no tienes una cuenta aún, <a href='UsuarioNuevoFormulario.php'>créala aquí</a>.</p>
    </form>
</body>

</html>