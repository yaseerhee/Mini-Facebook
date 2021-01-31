<?php
// REQUERIMIENTOS
require_once "_Varios.php";
require_once "DAO.php";

// SI NO HAY SESION NI COOKIE, NOS ENVÍA AL FORMULARIO
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) {
    redireccionar("SesionInicioFormulario.php");
} else {
    // EN CASO CONTRARIO
    // OBTENEMOS EL ID Y LOPASAMOS COMO CONDICION PARA OBTENEER LAS PUBLICACIONES
    $id = $_REQUEST["id"];
    $where = "WHERE destinatarioId = " . $id;
    $publicaciones = DAO::obtenerTodasPublicacion($where);
}
// OBTENEMOS AL USUARIO
$usuario = DAO::obtenerUsuarioPorId($id);
?>

<html>

<head>
    <meta charset='UTF-8'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/superhero/bootstrap.min.css">
</head>

<body>
    <!-- MOSTRAMOS LA INFORMACION DE LA SESION -->
    <!-- si no existe te muestra dos botones o para iniciar o registrarse -->
    <?php DAO::pintarInfoSesion(); ?>
    <h1 class="text-center">Muro de <?= $usuario["nombre"] ?></h1>
    <table class="table-primary table-hover col-10 ml-5 text-center">
        <tr class="m-5">
            <th class="p-2" scope="col">Fecha</th>
            <th class="p-2" scope="col">Emisor</th>
            <th class="p-2" scope="col">Destianatario</th>
            <th class="p-2" scope="col">Destacada</th>
            <th class="p-2" scope="col">Asunto</th>
            <th class="p-2" scope="col">Contenido</th>
            <th class="p-2" scope="col">Eliminar</th>
        </tr>
        <!-- MOSTRAMOS TODAS LAS FILAS QUE CUMPLAN CON LA CONDICION -->
        <?php foreach ($publicaciones as $publicacion) { ?>
            <tr class="table-warning">
                <?php
                $emisor = DAO::obtenerUsuarioPorId($publicacion->getEmisorID());
                $destinatario = $publicacion->getDestinatarioID();
                if ($destinatario != null) {
                    $destinatarioId = DAO::obtenerUsuarioPorId($destinatario);
                } else {
                    $destinatarioId = null;
                }
                ?>
                <td class="p-2"> <?= $publicacion->getFecha() ?> </td>
                <td class="p-2"> <?= $emisor["nombre"] ?> </td>
                <td class="p-2"> <?php if ($destinatario != null) { ?>
                        <a href="MuroVerDe.php?id=<?= $destinatarioId["id"]; ?>"><?= $destinatarioId["nombre"]; ?></a>
                    <?php  } else { ?>
                        Sin Destinatario
                    <?php } ?>
                </td>
                <td class="p-2"> <?= $publicacion->getDestacadaHasta() ?> </td>
                <td class="p-2"> <?= $publicacion->getAsunto() ?> </td>
                <?php
                $destacado = $publicacion->getDestacadaHasta();
                if ($destacado != null) { ?>
                    <td class="p-2"> <strong> $publicacion->getContenido() <strong> </td>
                <?php } else { ?>
                    <td class="p-2"> <?= $publicacion->getContenido() ?> </td>
                <?php } ?>
                <td class="p-2"><a href="EliminarPublicacion.php?id=<?= $publicacion->getId() ?>"><img width="25px" height="25px" src="IMG/equis.png"></a></td>
            </tr>
        <?php } ?>
    </table><br>
    <!-- PARA CREAR UNA NUEVA PUBLICACION -->
    <form class="col-md-12 text-center" action="PublicacionNuevaCrear.php">
        <h1 class="text-center">Escribe una Publicación</h1>
        <input type="hidden" name="destinatario" value="<?= $id ?>">
        <input class="col-sm-10" type="text" name="asunto" placeholder="Asunto" size="100" required>
        <p></p>
        <input class="col-sm-10" type="date" name="destacado" placeholder="Destacado hasta: ">
        <p></p>
        <textarea class="col-sm-10" name="contenido" id="contenido" cols="100" rows="10" placeholder="Escribe el mensaje..." required></textarea>
        <p></p>
        <button class="btn btn-outline-danger col-sm-3 mb-3" type="submit"> Nueva publicación</button>
        <!-- BOTONES -->
        <div class="text-center">
            <a class="btn btn-outline-success  col-sm-3 " href='Index.php'>Ir al Inicio</a><br>
            <a class="btn btn-outline-success col-sm-3" href='MuroVerGlobal.php'>Ir al Muro Global</a>
        </div>
    </form>

</body>

</html>