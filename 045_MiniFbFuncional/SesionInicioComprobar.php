<?php

require_once "_Varios.php";
require_once "DAO.php";

$arrayUsuario = DAO::obtenerUsuarioPorContrasenna($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

if ($arrayUsuario) { // Identificador existía y contraseña era correcta.
    DAO::establecerSesionRam($arrayUsuario);

    if (isset($_REQUEST["recordar"])) {
        DAO::establecerSesionCookie($arrayUsuario);
    }

    redireccionar("MuroVerGlobal.php");
} else {
    redireccionar("SesionInicioFormulario.php?datosErroneos");
}
