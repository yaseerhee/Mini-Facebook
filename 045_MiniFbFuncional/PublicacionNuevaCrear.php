<?php
// REQUERIMIENTOS
require_once "clases.php";
require_once "DAO.php";

// OBTENEMOS LA FECHA Y HOR AACTUAL
$tiempo = time();
$fecha = date("d-m-y (H:i:s)", $tiempo);
// OBTENEMOS AL USUARIO QUE ESCRIBE
$id = $_SESSION["id"];
// OBTENEMOS A QUIEN VA DEDICADO
$destinatario = $_REQUEST["destinatario"];
// SI ES GLOBAL PASAMOS NULO PARA QUE IMPRIMA sIN DESTINATARIO
if (!isset($destinatario)) {
    $destinatario = null;
}

// RECOGEMOS LA INFO QUE HEMOS ESCRIBIDO EN EL FORMULARIO
$asunto = $_REQUEST["asunto"];
$destacado = $_REQUEST["destacado"];
$contenido = $_REQUEST["contenido"];

// CREAMOS LA pUBLICACION EN LA BD Y REDIRECCIONAMOS A LA GLOBAL
DAO::crearPublicacion($fecha, $id, $destinatario, $destacado, $asunto, $contenido);
redireccionar("MuroVerGlobal.php");
