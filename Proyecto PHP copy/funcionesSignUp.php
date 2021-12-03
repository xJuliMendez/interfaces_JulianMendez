<?php
include "baseDatos.php";
setcookie("user", "");
setcookie("correo", "");
if (!isset($GLOBALS["contraseña"]) && !isset($GLOBALS["user"]) && !isset($GLOBALS["correo"])) {
    $GLOBALS["contraseña"] = "Contraseña";
    $GLOBALS["user"] = "";
    $GLOBALS["correo"] = "";
}


$pass = $pass2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombreNuevo"])) {
        $GLOBALS["user"] = "N/D";
    }else{
		$GLOBALS["user"] = comprobarCadena($_POST["nombreNuevo"]);
        $_COOKIE["user"] = $GLOBALS["user"];
	}
    if (empty($_POST["password"])) {
        $GLOBALS["contraseña"] = "Introduzca una contraseña";
    }else{
        $pass = passEncrypt($_POST["password"]);
        if (!empty($_POST["password"])) {
            $pass2 = passEncrypt($_POST["password2"]);
        }
    }
    if(!empty($_POST["correo"])){
        if (filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL)) {
            $_COOKIE["correo"] = $GLOBALS["correo"] = $_POST["correo"];
        }else{
            $GLOBALS["correo"] = "Correo no valido";
        }
        
    }else{
        $GLOBALS["correo"] = "N/D";
    }
    if (!empty($_COOKIE["user"]) && !empty($_COOKIE["correo"]) && isSamePass($pass,$pass2)) {
        
        crearUsuario($_COOKIE["user"],$_COOKIE["correo"], $pass);
        header("location: http://localhost:3000/Proyecto%20PHP/mainpage.php");
        

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

function isSamePass($pass0, $pass1){
    if (strcmp($pass0,$pass1) == 0) {
        return true;
    }else{
        return false;
    }
}

function setPlaceholderUsuario()
{
    if ($GLOBALS["user"] == "") {
        return "Nombre de Usuario";
    } elseif ($GLOBALS["user"] == "N/D") {
        return "Introduzca un nombre de usuario";
    }
}
function setValueUsuario()
{
    if ($GLOBALS["user"] != "" && $GLOBALS["user"] != "N/D") {
        return $GLOBALS["user"];
    }
}
function comprobarPassword(){
	if(strcmp($_POST["password"],$_POST["password2"])==0){
		return true;
	}else{
		return false;
	}
}
function setPlaceholderCorreo()
{
    if ($GLOBALS["correo"] == "") {
        return "Correo electrónico";
    } elseif ($GLOBALS["correo"] == "N/D") {
        return "Introduzca un correo electrónico";
    }elseif ($GLOBALS["correo"] == "Correo no valido"){
        return $GLOBALS["correo"];
    }
}
function setValueCorreo()
{
    if ($GLOBALS["correo"] != "" && $GLOBALS["correo"] != "N/D" && $GLOBALS["correo"] != "Correo no valido") {
        return $GLOBALS["correo"];
    }
}