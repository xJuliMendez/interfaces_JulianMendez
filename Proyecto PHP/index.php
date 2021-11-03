<?php
require_once "funciones.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" media="screen" href="estilos.css">
	<title>Red Social</title>
</head>

<body>

	<?php



// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (empty($_POST["nombre"])) {
//         $userBox = "Por favor introduzca el nombre de usuario";
//         // header("location: http://localhost:3000/index.php");
//     } else {
//         $user = $userBox = comprobarCadena($_POST["nombre"]);
//         if (empty($_POST["password"])) {
//             $passBox = "Por favor introduzca una contraseña";
//             // header("location: http://localhost:3000/index.php");
//         } else {
//             $pass = passEncrypt(comprobarCadena($_POST["password"]));

//             if (logInUsuario($user, $pass)) {
//                 echo "<script>location.href='mainpage.php'</script>";
//             } else {
//                 // header("location: http://localhost:3000/index.php");
//                 // echo "<script>location.href='index.php'</script>";
//             }

//         }
//     }

// }

// function comprobarCadena($cad)
// {
//     $cad = trim($cad); // Elimina los caracteres en blanco la principio y al final
//     $cad = stripslashes($cad); // Quita las \ para que no haya secuencias de escape
//     $cad = htmlspecialchars($cad); // Elimina las etiquetas html como script para que no nos metan un script malicioso.
//     return $cad;
// }

// function passEncrypt($cad)
// {
//     return hash("sha256", $cad);
// }

?>

	<div class="wrapper fadeInDown">
		<div id="formContent">

			<div class="fadeIn first">
				<img id="icon" alt="User Icon" />
			</div>

			<form method="post" action="funciones.php">
				<input type="text" id="login" class="fadeIn second" name="nombre" placeholder="<?php if(isset($_GET["status"]) && $_GET["status"] == "user_empty"){
					echo "Introduzca nombre de usuario";
				}elseif (isset($_GET["status"])) {
					echo $_GET["status"];
				}
				else {
					echo "usuario";
				} ?>" value="<?php echo $_SESSION["user"]; ?>">
				<input type="password" id="password" class="fadeIn third" name="password" placeholder="<?php echo $_SESSION["passBox"]; ?>">
				<input type="submit" class="fadeIn fourth" value="Log In">
			</form>

			<div id="formFooter">
				<a class="underlineHover" href="signup.php">Crear Usuario</a>
			</div>

		</div>
	</div>

</body>

</html>