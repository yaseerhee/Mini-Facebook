<?php
require_once "_Varios.php";
require_once "DAO.php";

// TODO ...$_REQUEST["..."]...
$identificador = $_REQUEST["identificador"];
$contrasenna = $_REQUEST["contrasenna"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
// TODO Intentar crear (añadir funciones en Varios.php para crear y tal).
//
// TODO Y redirigir a donde sea.

$arrayUsuario = DAO::crearUsuario($identificador, $contrasenna, $nombre, $apellidos);

// TODO ¿Excepciones?
if ($arrayUsuario) {
    redireccionar("SesionInicioFormulario.php");
} else {
    echo "FALTAN DATOS, no se ha creado";
}
