<?php

abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Usuario extends Dato
{
    use Identificable;

    private $identificador;
    private $contrasenna;
    private $nombre;
    private $apellidos;

    public function __construct(int $id, $identificador, $contrasenna, $nombre, $apellidos)
    {
        $this->setId($id);
        $this->setIdentificador($identificador); //nombreUsuario
        $this->setContrasenna($contrasenna);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
    }

    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador)
    {
        $this->identificador = $identificador;
    }

    public function getContrasenna(): string
    {
        return $this->contrasenna;
    }

    public function setContrasenna(string $contrasenna)
    {
        $this->contrasenna = $contrasenna;
    }


    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }
}
class Publicacion extends Dato
{
    use Identificable;

    private string $fecha;
    private int $emisorID;
    private $destinatarioID;
    private $destacadaHasta;
    private string $asunto;
    private string $contenido;

    public function __construct(int $id, string $fecha, int $emisorID, $destinatarioID, $destacadaHasta, string $asunto, string $contenido)
    {
        $this->setId($id);
        $this->setFecha($fecha);
        $this->setEmisorID($emisorID);
        $this->setDestinatarioID($destinatarioID);
        $this->setDestacadaHasta($destacadaHasta);
        $this->setAsunto($asunto);
        $this->setContenido($contenido);
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getEmisorID(): int
    {
        return $this->emisorID;
    }

    public function setEmisorID(int $emisorID)
    {
        $this->emisorID = $emisorID;
    }

    public function getDestinatarioID(): ?int
    {
        return $this->destinatarioID;
    }

    public function setDestinatarioID($destinatarioID)
    {
        $this->destinatarioID = $destinatarioID;
    }

    public function getDestacadaHasta()
    {
        return $this->destacadaHasta;
    }

    public function setDestacadaHasta($destacadaHasta)
    {
        $this->destacadaHasta = $destacadaHasta;
    }

    public function getAsunto(): string
    {
        return $this->asunto;
    }

    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    public function getContenido(): string
    {
        return $this->contenido;
    }

    public function setContenido($contenido)
    {
        $this->contenido = $contenido;
    }
}
