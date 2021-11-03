<?php
require_once "baseDatos.php";

// Ahora creamos las variables de la sesion ej: Usuario.

$_SESSION["user"] = "";
$_SESSION["pass"] = "";
$_SESSION["userBox"] = "usuario";
$_SESSION["passBox"] = "contraseña";

// Ahora establecemos las cookies
$cookie_name = "usuario";
$cookie_value = "N/D";

setcookie($cookie_name, $cookie_value, time() + 500, "/");

// Ahora comprobamos si la cookie está setteada

if (!isset($_COOKIE[$cookie_name])) {;
}

// Ahora definimos las variables que vamos a usar y las inicializamos a un valor vacio

$user = $pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
        header("location: http://localhost:3000/index.php?status=user_empty");
    } else {
		$_SESSION["user"] = comprobarCadena($_POST["nombre"]);
		header("location: http://localhost:3000/index.php?status=". $_SESSION["user"]);
        if (empty($_POST["password"])) {
            $_SESSION["pass"] = $pass = "Por favor introduzca una contraseña";
            header("location: http://localhost:3000/index.php");
        } else {
            $_SESSION["pass"] = passEncrypt(comprobarCadena($_POST["password"]));

            if (logInUsuario($_SESSION["user"], $_SESSION["pass"])) {
                echo "<script>location.href='mainpage.php'</script>";
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
