<?php
require_once "_Varios.php";
require_once "DAO.php";

$id = $_SESSION["id"];
$identificador = $_REQUEST["identificador"];
$contrasenna = $_REQUEST["contrasenna"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];

$arrayUsuario = [];
$arrayUsuario[0] = $identificador;
$arrayUsuario[1] = $contrasenna;
$arrayUsuario[2] = $nombre;
$arrayUsuario[3] = $apellidos;
$arrayUsuario[4] = $id;

$correcto = DAO::actualizarUsuarioEnBD($arrayUsuario);

if ($correcto) {
    redireccionar("MuroVerGlobal.php");
    // DAO::establecerSesionRam($arrayUsuario);
} else {
    redireccionar("UsuarioPerfilVer.php");
}
