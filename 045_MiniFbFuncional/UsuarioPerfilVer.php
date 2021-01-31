<?php

require_once "_Varios.php";
require_once "DAO.php";

$id = (int)$_SESSION["id"];
$usuario = DAO::obtenerUsuarioPorId($id);

?>

<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/superhero/bootstrap.min.css">
</head>



<body>

    <?php DAO::pintarInfoSesion(); ?>

    <h1>USUARIO</h1>
    <form method='post' action='UsuarioPerfilGuardar.php'>
        <input type='hidden' name='id' value='<?= $id ?>' />
        <label for='identificador'>Identificador: </label>
        <input type='text' name='identificador' value='<?= $usuario["identificador"] ?>' />
        <br />

        <label for='contrasenna'>Contraseña</label>
        <input type='text' name='contrasenna' value='<?= $usuario["contrasenna"] ?>' />
        <br />

        <label for='nombre'>Nombre</label>
        <input type='text' name='nombre' value='<?= $usuario["nombre"] ?>' />
        <br />

        <label for='apellidos'>Apellidos</label>
        <input type='text' name='apellidos' value='<?= $usuario["apellidos"] ?>' />
        <br />

        <br />
        <input type='submit' name='guardar' value='Guardar cambios' />
    </form>

</body>

</html>