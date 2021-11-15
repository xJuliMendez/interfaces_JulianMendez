<?php
setcookie("usuario", "");
if (!isset($GLOBALS["contraseña"])) {
    $GLOBALS["contraseña"] = "Contraseña";
}
setcookie("email", "");

$user = $pass = $pass2 = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombreNuevo"])) {
        $_COOKIE["usuario"] = "";
		$GLOBALS["contraseña"] = "Por favor introduzca una contraseña";
    }else{
		$user = comprobarCadena($_POST["nombreNuevo"]);
        $_COOKIE["usuario"] = $user;
        if (empty($_POST["password"])) {
            $GLOBALS["contraseña"] = "Por favor introduzca una contraseña";
        } else {
			if(!empty($_POST["password2"]) && comprobarPassword()){
				$contra = passEncrypt(comprobarCadena($_POST["password"]));
				if(!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
					$_COOKIE["email"] = $_POST["email"];
				}
			}
            

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

function setPlaceholderUsuario()
{
    if (!isset($_COOKIE["usuario"])) {
        return "Nombre de Usuario";
    } elseif (isset($_COOKIE["usuario"])) {
        return "Introduzca un nombre de usuario";
    }
}
function setValueUsuario()
{
    if (isset($_COOKIE["usuario"]) && !empty($_COOKIE["usuario"])) {
        echo $_COOKIE["usuario"];
    }
}
function comprobarPassword(){
	if(strcmp($_POST["password"],$_POST["password2"])==0){
		return true;
	}else{
		return false;
	}
}