<?php

require_once "_Varios.php";
require_once "DAO.php";

if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) {
    redireccionar("SesionInicioFormulario.php");
} else {
    $id = $_REQUEST["id"];
    $where = "WHERE destinatarioId = " . $id;
    $publicaciones = DAO::obtenerTodasPublicacion($where);
}

$usuario = DAO::obtenerUsuarioPorId($id);
?>

<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/superhero/bootstrap.min.css">
</head>

<body>

    <?php DAO::pintarInfoSesion(); ?>

    <h1 class="text-center">Muro de <?= $usuario["nombre"] ?></h1>
    <table border='3' class="table table-hover col-10">
        <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Emisor</th>
            <th scope="col">Destianatario</th>
            <th scope="col">Destacada</th>
            <th scope="col">Asunto</th>
            <th scope="col">Contenido</th>
        </tr>
        <?php foreach ($publicaciones as $publicacion) { ?>
            <tr class="table-primary">
                <?php
                $emisor = DAO::obtenerUsuarioPorId($publicacion->getEmisorID());
                $destinatario = $publicacion->getDestinatarioID();
                if ($destinatario != null) {
                    $destinatarioId = DAO::obtenerUsuarioPorId($destinatario);
                } else {
                    $destinatarioId = null;
                }
                ?>
                <td> <?= $publicacion->getFecha() ?> </td>
                <td> <?= $emisor["nombre"] ?> </td>
                <td> <?php if ($destinatario != null) { ?>
                        <a href="MuroVerDe.php?id=<?= $destinatarioId["id"]; ?>"><?= $destinatarioId["nombre"]; ?></a>
                    <?php  } else { ?>
                        Sin Destinatario
                    <?php } ?>
                </td>
                <td> <?= $publicacion->getDestacadaHasta() ?> </td>
                <td> <?= $publicacion->getAsunto() ?> </td>
                <?php
                $destacado = $publicacion->getDestacadaHasta();
                if ($destacado != null) { ?>
                    <td> <strong> $publicacion->getContenido() <strong> </td>
                <?php } else { ?>
                    <td> <?= $publicacion->getContenido() ?> </td>
                <?php } ?>
                <td><a href="EliminarPublicacion.php?id=<?= $publicacion->getId() ?>"><img width="25px" height="25px" src="equis.png"></a></td>
            </tr>
        <?php } ?>
    </table><br>

    <h1 class="col-md-10">Escribe una Publicación</h1>
    <form class="col-md-10" action="PublicacionNuevaCrear.php">
        <input type="hidden" name="destinatario" value="<?= $id ?>">
        <input class="col-sm-5" type="text" name="asunto" placeholder="Asunto" size="100" required>
        <p></p>
        <input class="col-sm-5" type="date" name="destacado" placeholder="Destacado hasta: ">
        <p></p>
        <textarea class="col-sm-5" name="contenido" id="contenido" cols="100" rows="10" placeholder="Escribe el mensaje..." required></textarea>
        <p></p>
        <button class="btn btn-outline-success col-sm-5" type="submit"> Nueva publicación</button>
    </form>

    <a class="btn btn-outline-success col-sm-5" href='Index.php'>Ir al Inicio</a>
    <a class="btn btn-outline-success col-sm-5" href='MuroVerGlobal.php'>Ir al Muro Global</a>

</body>

</html>