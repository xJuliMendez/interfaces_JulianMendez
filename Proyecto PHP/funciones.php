<?php
include "baseDatos.php";
setcookie("user", "");

session_start();

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
        // setcookie("user", $user);
        if (empty($_POST["password"])) {
            $GLOBALS["pass"] = "Por favor introduzca una contraseña";
        } else {
            $pass = passEncrypt(comprobarCadena($_POST["password"]));

            if (logInUsuario($user, $pass)) {
                echo $_COOKIE["user"];
                header("location: http://localhost:3000/mainpage.php");
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
    } elseif ($_COOKIE["user"] == "N/D") {
        return "Introduzca un nombre de usuario";
    } elseif (isset($_COOKIE["user"])) {
        return "Introduzca un nombre de usuario";
    }
}
function setValue()
{
    if (isset($_COOKIE["user"]) && !empty($_COOKIE["user"])) {
        echo $_COOKIE["user"];
    }
}
function setPassPlaceholder()
{
    if (isset($GLOBALS["pass"]) && $GLOBALS["pass"] == "") {
        return "Contraseña";
    } else {
        return "Por favor introduzca la contraseña";
    }
}
