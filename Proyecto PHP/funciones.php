<?php
require_once "baseDatos.php";
setcookie("user", "N/D");

// Ahora creamos las variables de la sesion ej: Usuario.

$_SESSION["pass"]="";
// Ahora establecemos las cookies

// Ahora comprobamos si la cookie está setteada

// Ahora definimos las variables que vamos a usar y las inicializamos a un valor vacio


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        setcookie("user", "");
        header("location: http://localhost:3000/index.php");
    } else {
        $user = comprobarCadena($_POST["nombre"]);
        setcookie("user", $user);
        if (empty($_POST["password"])) {
            $_SESSION["pass"] = "Por favor introduzca una contraseña";
            header("location: http://localhost:3000/index.php");
        } else {
            $_SESSION["pass"] = passEncrypt(comprobarCadena($_POST["password"]));

            if (logInUsuario($user, $_SESSION["pass"])) {
                echo $_COOKIE["user"];
                header("location: http://localhost:3000/mainpage.php");
            } else {
                header("location: http://localhost:3000/index.php");
                // echo "<script>location.href='index.php'</script>";
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
        return "Introduzca un nombre de usuario";
    }
    elseif ($_COOKIE["user"] == "N/D") {
        return "Usuario";
    } elseif (isset($_COOKIE["user"])) {
        return "Introduzca un nombre de usuario";
    }
}
function setValue()
{
    if (!isset($_COOKIE["user"])) {
    } elseif ($_COOKIE["user"] == "N/D") {
    } else {
        echo $_COOKIE["user"];
    }
}
