<!-- Página que crea la publicación que recibe en $_REQUEST y redirige al muro correspondiente. 
Este script no tiene HTML. -->
<?php
require_once "clases.php";
require_once "DAO.php";


$tiempo = time();
$fecha = date("d-m-y (H:i:s)", $tiempo);
$id = $_SESSION["id"];
$destinatario = $_REQUEST["destinatario"];

if (!isset($destinatario)) {
    $destinatario = null;
}
$asunto = $_REQUEST["asunto"];
$destacado = $_REQUEST["destacado"];
$contenido = $_REQUEST["contenido"];


DAO::crearPublicacion($fecha, $id, $destinatario, $destacado, $asunto, $contenido);
redireccionar("MuroVerGlobal.php");
