<?php
// REQUERIMIENTOS
require_once "_Varios.php";
require_once "DAO.php";

// OBTENEMOS LOS DATOS DE NUESTRO USUARIO
$id = $_SESSION["id"];
$identificador = $_REQUEST["identificador"];
$contrasenna = $_REQUEST["contrasenna"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];

// ALMACENAMOS LOS DATOS EN UN ARRAY
$arrayUsuario = [];
$arrayUsuario[0] = $identificador;
$arrayUsuario[1] = $contrasenna;
$arrayUsuario[2] = $nombre;
$arrayUsuario[3] = $apellidos;
$arrayUsuario[4] = $id;

//PASAMOS COMO PARAMETRO DICHO ARRAY QUE ACTUALIZA LOS NUEVOS DATOS DE NUESTRO USUARIO
$correcto = DAO::actualizarUsuarioEnBD($arrayUsuario);

if ($correcto) {
    // SI TODO ESTA BIEN ME REDIRIGES A MURO GLOBAL
    redireccionar("MuroVerGlobal.php");
} else {
    // EN CASO CONTRARIO
    echo "No hay cambios...";
}
