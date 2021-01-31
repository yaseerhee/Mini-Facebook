<?php

declare(strict_types=1);
session_start();

// FUNCION QUE REDIRECCIONA A LOS SCRIPTS DE PHP
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

//FUNCION QUE MUESTRA EL CONTENIDO
function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

// FUNCION QUE GENERA UNA CADEA ALEATORIA PARA LAS COOKIES
function generarCadenaAleatoria(int $longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') - 1; $i != $longitud; $x = rand(0, $z), $s .= $a[$x], $i++);
    return $s;
}
