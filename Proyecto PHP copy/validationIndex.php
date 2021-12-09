<?php
include "baseDatos.php";

session_start();


$user = "";
$userErr = 0;
$password = "";
$passErr = 0;

if (!isset($_COOKIE["user"])) {
    setcookie("user", "");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["nombre"])) {
        $userErr = 1;
    } else {
        $_SESSION["user"] = $user = comprobarCadena($_POST["nombre"]);
        setcookie("user", $user);
        if (empty($_POST["password"])) {
            $passErr = 1;
        } else {
            $password = passEncrypt(comprobarCadena($_POST["password"]));

            if (logInUsuario($user, $password)) {
                header("location: http://localhost:3000/Proyecto%20PHP%20copy/main.php");
                
            }else {
                $user = "";
                $passErr = 1;
                $userErr = 2;
            }
        }
    }
}

function comprobarCadena($cad)
{
    $cad = trim($cad); // Elimina los caracteres en blanco la principio y al final
    $cad = stripslashes($cad); // Quita las \ para que no haya secuencias de escape
    $cad = htmlspecialchars($cad); // Elimina las etiquetas html como script para que no nos metan un script malicioso.
    return $cad;
}

function passEncrypt($cad)
{
    return hash("sha256", $cad);
}

function setUsuario()
{

    if (empty($GLOBALS["userErr"])) {
        return "Nombre de usuario";
    }elseif ($GLOBALS["userErr"] == 2) {
        return "Nombre de usuario incorrecto";
    }
    else {
        return "Introduzca nombre de usuario";
    }
}
function setValue()
{
    if (empty($GLOBALS["user"])) {
        return "";
    }elseif (isset($_SESSION["user"])) {
        return $_SESSION["user"];
    }
    else {
        return $GLOBALS["user"];
    }
}
function setPassword()
{
    if (empty($GLOBALS["passErr"])) {
        return "Contraseña";
    }else {
        return "Contraseña incorrecta";
    }
}