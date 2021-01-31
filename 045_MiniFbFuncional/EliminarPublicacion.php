<?php
// REQUERIMIENTOS
require_once "clases.php";
require_once "DAO.php";

// OBTIENE LA ID QUE LE PASAMOS POR LA X
$id = $_REQUEST["id"];

// ELIMINAMOS DE LA BD Y LO REDIRECCIONAMOS AL GLOBAL
DAO::eliminarPublicacion($id);
redireccionar("MuroVerGlobal.php");
