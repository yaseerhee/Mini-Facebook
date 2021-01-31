<?php

require_once "_Varios.php";
require_once "DAO.php";

?>
<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/superhero/bootstrap.min.css">
</head>

<body>
    <?php DAO::pintarInfoSesion(); ?>
    <h1 class="text-success text-center">MiniFb</h1>
    <p class="text-info text-center">¡Bienvenido al MiniFb!</p>
    <p class="text-info text-center">Esto es una red social en la que bla, bla, bla, bla.</p>
    <p class="text-info text-center">Crea tu cuenta y participa.</p>
    <a class="btn btn-outline-success col" href='MuroVerGlobal.php'>Mira el muro global si ya tienes una cuenta.</a>
</body>

</html>