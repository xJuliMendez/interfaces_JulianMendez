<?php
include "baseDatos.php";

session_start();


if (!isset($_COOKIE["user"])) {
    setcookie("user", "");
}

if (!isset($GLOBALS["pass"])) {
    $GLOBALS["pass"] = "Contraseña";
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $GLOBALS["pass"] = "Por favor introduzca contraseña";

    if (empty($_POST["nombre"])) {
        $_COOKIE["user"] = "";
    } else {
        $user = comprobarCadena($_POST["nombre"]);
        $_COOKIE["user"] = $user;
        $_SESSION["user"] = $user;
        if (empty($_POST["password"])) {
            $GLOBALS["pass"] = "Por favor introduzca una contraseña";
        } else {
            $contra = passEncrypt(comprobarCadena($_POST["password"]));

            if (logInUsuario($user, $contra)) {
                header("location: http://localhost:3000/Proyecto%20PHP/mainpage.php");
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

function setPlaceholder()
{
    if (!isset($_COOKIE["user"])) {
        return "Usuario";
    }elseif (isset($_COOKIE["user"])) {
        return "Introduzca un nombre de usuario";
    }
}
function setValue()
{
    if (isset($_COOKIE["user"]) && !empty($_COOKIE["user"])) {
        echo $_COOKIE["user"];
    }
}