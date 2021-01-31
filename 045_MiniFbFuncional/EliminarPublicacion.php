<?php

require_once "clases.php";
require_once "DAO.php";

$id = $_REQUEST["id"];

DAO::eliminarPublicacion($id);
redireccionar("MuroVerGlobal.php");
