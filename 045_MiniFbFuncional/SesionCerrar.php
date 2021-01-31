<?php

require_once "_Varios.php";
require_once "DAO.php";

DAO::destruirSesionRamYCookie();

redireccionar("Index.php");
