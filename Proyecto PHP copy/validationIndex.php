<?php
include "baseDatos.php";

session_start();


    $user = "";
    $userErr = "";
    $password = "";
    $passErr = "";


if (!isset($_COOKIE["user"])) {
    setcookie("user", "");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["nombre"])) {
        $userErr = "Introduzca nombre de usuario";
        header("location: http://localhost:3000/Proyecto%20PHP%20copy/index.php?userErr=$userErr&passErr=$passErr");
    } else {
        $user = comprobarCadena($_POST["nombre"]);
        $_COOKIE["user"] = $user;
        if (empty($_POST["password"])) {
            $passErr = "Por favor introduzca una contraseña";
        } else {
            $password = passEncrypt(comprobarCadena($_POST["password"]));

            if (logInUsuario($user, $password)) {
                header("location: http://localhost:3000/Proyecto%20PHP/mainpage.php");
                
            }else {
                $userErr = "Nombre de usuario incorrecto";
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

    if (empty($userErr)) {
        return "Nombre de usuario";
    }else {
        return $userErr;
    }
}
function setValue()
{
    if (empty($user)) {
        return "";
    }else {
        return $user;
    }
}
function setPassword()
{
    if (empty($passErr)) {
        return "Contraseña";
    }else {
        return "Contraseña incorrecta";
    }
}