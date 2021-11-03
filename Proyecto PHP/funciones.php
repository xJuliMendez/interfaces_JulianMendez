<?php
require "baseDatos.php";

// Ahora creamos las variables de la sesion ej: Usuario.
$_SESSION["usuario"] = "N/D";

// Ahora establecemos las cookies
$cookie_name = "usuario";
$cookie_value = "N/D";

setcookie($cookie_name, $cookie_value, time() + 500, "/");

// Ahora comprobamos si la cookie está setteada

if (!isset($_COOKIE[$cookie_name])) {;
}

// Ahora definimos las variables que vamos a usar y las inicializamos a un valor vacio
$user = $pass = $pass2 = $email = "";
$userBox = "usuario";
$passBox = "contraseña";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["nombre"])) {
		$userBox = "Por favor introduzca el nombre de usuario";
	} else {
		$user = $userBox = comprobarCadena($_POST["nombre"]);

		if (empty($_POST["password"])) {
			$passBox = "Por favor introduzca una contraseña";
		} else {
			$pass = passEncrypt(comprobarCadena($_POST["password"]));

			if(logInUsuario($user, $pass)){
				header("location: http://localhost:3000/Proyecto%20PHP/signup.php");
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
