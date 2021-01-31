<?php

require_once "_Varios.php";
require_once "clases.php";

class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "MiniFb"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        $rs = $select->fetchAll();

        return $rs;
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): ?int
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $actualizacion = self::$pdo->prepare($sql);
        $sqlConExito = $actualizacion->execute($parametros);

        if (!$sqlConExito) return null;
        else return $actualizacion->rowCount();
    }
    ////PUBLICACION /////
    public static function PublicacionCrearDesdeRs(array $rs): Publicacion
    {
        return new Publicacion($rs["id"], $rs["fecha"], $rs["emisorId"], $rs["destinatarioId"], $rs["destacadaHasta"], $rs["asunto"], $rs["contenido"]);
    }


    public static function crearPublicacion($fecha, $emisorId, $destinatarioId, $destacadaHasta, $asunto, $contenido): bool
    {
        return self::ejecutarActualizacion(
            "INSERT INTO publicacion (fecha, emisorId, destinatarioId , destacadaHasta, asunto, contenido ) VALUES(?,?,?,?,?,?)",
            [$fecha, $emisorId, $destinatarioId, $destacadaHasta, $asunto, $contenido]
        );

        // los parametros que obtenemos son los qeu almacenamos en la base de datos
    }

    public static function obtenerTodasPublicacion($where)
    {
        $datos = [];
        $rs = self::ejecutarConsulta("SELECT * FROM Publicacion $where ORDER BY fecha DESC", []);
        foreach ($rs as $fila) {
            $publicacion = self::PublicacionCrearDesdeRs($fila);
            array_push($datos, $publicacion);
        }
        return $datos;
    }


    ///// USUARIO ////////
    public static function usuarioCrearDesdeRs(array $rs): Usuario
    {
        return new Usuario($rs["id"], $rs["identificador"], $rs["contrasenna"], $rs["nombre"], $rs["apellidos"]);
    }

    public static function crearUsuario($identificador, $contrasenna, $nombre, $apellidos): bool
    {
        return self::ejecutarActualizacion(
            "INSERT INTO usuario (identificador, contrasenna, nombre , apellidos ) VALUES(?,?,?,?)",
            [$identificador, $contrasenna, $nombre, $apellidos]
        );

        // los parametros que obtenemos son los qeu almacenamos en la base de datos
    }

    public static function actualizarUsuarioEnBD($arrayUsuario)
    {
        return self::ejecutarActualizacion(
            "UPDATE usuario SET identificador=?, contrasenna=?, nombre=?, apellidos=? WHERE id=?",
            [$arrayUsuario[0], $arrayUsuario[1], $arrayUsuario[2], $arrayUsuario[3], $arrayUsuario[4]]
        );
        // self::establecerSesionRam($arrayUsuario);
    }

    public static function obtenerUsuarioPorContrasenna(string $identificador, string $contrasenna): ?array
    {

        $rs = self::ejecutarConsulta(
            "SELECT * FROM Usuario WHERE identificador=? AND BINARY contrasenna=?",
            [$identificador, $contrasenna]
        );
        if ($rs) {
            return $rs[0];
        } else {
            return null;
        }
    }

    public static  function obtenerUsuarioPorCodigoCookie(string $identificador, string $codigoCookie): ?array
    {
        $conexion = obtenerPdoConexionBD();

        $sql = "SELECT * FROM Usuario WHERE identificador=? AND BINARY codigoCookie=?";
        $select = $conexion->prepare($sql);
        $select->execute([$identificador, $codigoCookie]);
        $rs = $select->fetchAll();

        // $rs[0] es la primera (y esperemos que única) fila que ha podido venir. Es un array asociativo.
        return $select->rowCount() == 1 ? $rs[0] : null;
    }

    public static function obtenerUsuarioPorId($id)
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Usuario WHERE id=?",
            [$id]
        );
        if ($rs) {
            return $rs[0];
        } else {
            return null;
        }
    }

    public static function usuarioFicha($id): Usuario
    {
        $rs = self::ejecutarConsulta("SELECT * FROM Usuario WHERE id=?", [$id]);
        $identificadorUsuario = $rs[0]["identificador"];
        $contrasennaUsuario = $rs[0]["contrasenna"];
        $nombreUsuario = $rs[0]["nombre"];
        $apellidosUsuario = $rs[0]["apellidos"];

        return new Usuario($id, $identificadorUsuario, $contrasennaUsuario, $nombreUsuario, $apellidosUsuario);
    }

    public static function actualizarCodigoCookieEnBD(?string $codigoCookie)
    {
        $conexion = self::obtenerPdoConexionBD();
        $sql = "UPDATE Usuario SET codigoCookie=? WHERE id=?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute([$codigoCookie, $_SESSION["id"]]);
        // TODO Comprobar si va bien con null.

        // TODO Para una seguridad óptima convendría anotar en la BD la fecha de caducidad de la cookie y no aceptar ninguna cookie pasada dicha fecha.
    }

    public static function establecerSesionRam(array $arrayUsuario)
    {
        // Anotar en el post-it como mínimo el id.
        $_SESSION["id"] = $arrayUsuario["id"];
        // Además, podemos anotar todos los datos que podamos querer tener a mano, sabiendo que pueden quedar obsoletos...
        $_SESSION["identificador"] = $arrayUsuario["identificador"];
        $_SESSION["tipoUsuario"] = $arrayUsuario["tipoUsuario"];
        $_SESSION["nombre"] = $arrayUsuario["nombre"];
        $_SESSION["apellidos"] = $arrayUsuario["apellidos"];
    }

    public static function haySesionRamIniciada(): bool
    {
        // Está iniciada si isset($_SESSION["id"])
        return isset($_SESSION["id"]);
    }

    public static function borrarCookies()
    {
        setcookie("identificador", "", time() - 3600); // Tiempo en el pasado, para (pedir) borrar la cookie.
        setcookie("codigoCookie", "", time() - 3600); // Tiempo en el pasado, para (pedir) borrar la cookie.}
    }


    public static function intentarCanjearSesionCookie(): bool
    {
        if (isset($_COOKIE["identificador"]) && isset($_COOKIE["codigoCookie"])) {
            $arrayUsuario = self::obtenerUsuarioPorCodigoCookie($_COOKIE["identificador"], $_COOKIE["codigoCookie"]);

            if ($arrayUsuario) {
                self::establecerSesionRam($arrayUsuario);
                self::establecerSesionCookie($arrayUsuario); // Para re-generar el numerito.
                return true;
            } else { // Venían cookies pero los datos no estaban bien.
                self::borrarCookies(); // Las borramos para evitar problemas.
                return false;
            }
        } else { // No vienen ambas cookies.
            self::borrarCookies(); // Las borramos por si venía solo una de ellas, para evitar problemas.
            return false;
        }
    }

    public static function pintarInfoSesion()
    {
        if (self::haySesionRamIniciada()) {
            echo "<span>Sesión iniciada por <a href='UsuarioPerfilVer.php'>$_SESSION[identificador]</a> ($_SESSION[nombre] $_SESSION[apellidos]) <a href='SesionCerrar.php'>Cerrar sesión</a></span>";
        } else {
            echo "<a class='btn btn-outline-success col' href='SesionInicioFormulario.php'>Iniciar sesión</a>";
        }
    }

    public static function establecerSesionCookie(array $arrayUsuario)
    {
        // Creamos un código cookie muy complejo (no necesariamente único).
        $codigoCookie = generarCadenaAleatoria(32); // Random...
        self::actualizarCodigoCookieEnBD($codigoCookie);

        // Enviamos al cliente, en forma de cookies, el identificador y el codigoCookie:
        setcookie("identificador", $arrayUsuario["identificador"], time() + 600);
        setcookie("codigoCookie", $codigoCookie, time() + 600);
    }

    public static function eliminarPublicacion($id): ?bool
    {
        $rs = self::ejecutarActualizacion("DELETE FROM publicacion where id=?", [$id]);
        return $rs ? true : null;
    }

    public static function destruirSesionRamYCookie()
    {
        session_destroy();
        self::actualizarCodigoCookieEnBD(Null);
        self::borrarCookies();
        unset($_SESSION); // Por si acaso
    }


    public static function ObtenerSesionIniciada($id): array
    {
        // Aqui obtenemos la sesion y comprobamos que esta iniciada desde el id_usuario que reciboimos
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE id=?",
            [$id]
        );
        $datos = array($rs["id"], $rs["identificador"], $rs["contrasenna"], $rs["nombre"], $rs["apellidos"]);
        // devolvemos el usuario en array
        return $datos;
    }
}
