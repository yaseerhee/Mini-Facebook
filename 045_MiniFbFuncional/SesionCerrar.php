<?php
// REQUERIMIENTOS
require_once "_Varios.php";
require_once "DAO.php";

// ELIMINAMOS LA SESION Y LA COOKIE Y REDIRECCIONAMOS AL INICIO
DAO::destruirSesionRamYCookie();
redireccionar("Index.php");
