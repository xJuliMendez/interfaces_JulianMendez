<?php

$userDB = "root";
$passDB = "";
$baseDatos = "accesodatos";

$conn = mysqli_connect("localhost", $userDB, $passDB, $baseDatos);
$datos = comprobarUsuario($conn);

function comprobarUsuario($conexion)
{
    if (isAlive($conexion)) {
        $query = "select * from usuarios";
        $result = mysqli_query($conexion, $query) or die("no se ha podido hacer la query");
        return $result -> fetch_array();
    }else{
        $conexion = mysqli_connect("localhost", $GLOBALS["userDB"], $GLOBALS["passDB"], $GLOBALS["baseDatos"]);
        $query = "select * from usuarios";
        $result = mysqli_query($conexion, $query) or die("no se ha podido hacer la query");
        return $result -> fetch_array();
    }
}

function isAlive($conexion)
{
    if ($conexion) {
        return true;
    } else {
        return false;
    }
}