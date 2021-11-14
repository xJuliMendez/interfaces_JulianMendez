<?php
	include "baseDatos.php";

	setcookie("usuario", "");
	$_SESSION["contraseñaNueva"]="";
	setcookie("email","");

	$user = $pass = $pass2 = $email = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty($_POST["nombreNuevo"]))
	}

	function comprobarCadena($cad)
	{
		$cad = trim($cad); // Elimina los caracteres en blanco la principio y al final
		$cad = stripslashes($cad); // Quita las \ para que no haya secuencias de escape
		$cad = htmlspecialchars($cad); // Elimina las etiquetas html como script para que no nos metan un script malicioso.
		return $cad;
	}

	function passEncrypt($cad){
		return hash("sha256", $cad);
	}

	?>