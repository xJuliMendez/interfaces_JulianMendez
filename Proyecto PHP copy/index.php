<?php
include "validationIndex.php";
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
	<div class="wrapper fadeInDown"> 
		<div id="formContent">
			<div class="fadeIn first">
				<img id="icon" alt="User Icon" />
			</div>
			
			<form method="post" action="index.php">
				<input type="text" id="login" class="fadeIn second" name="nombre" placeholder="<?php echo setUsuario(); ?>" value ="<?php echo setValue();?>">
				<input type="password" id="password" class="fadeIn third" name="password" placeholder="<?php echo setPassword() ?>">
				<input type="submit" class="fadeIn fourth" value="Log In">
			</form>

			<div id="formFooter">
				<a class="underlineHover" href="signup.php">Crear Usuario</a>
			</div>

		</div>
	</div>
</body>

</html>