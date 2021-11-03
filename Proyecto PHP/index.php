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
		require "funciones.php"
	?>

	<div class="wrapper fadeInDown">
		<div id="formContent">
			<!-- Tabs Titles -->

			<!-- Icon -->
			<div class="fadeIn first">
				<img id="icon" alt="User Icon" />
			</div>

			<!-- Login Form -->
			<form method="post" action="funciones.php">
				<input type="text" id="login" class="fadeIn second" name="nombre" placeholder="<?php echo $userBox; ?>" value="<?php echo $user; ?>">
				<input type="password" id="password" class="fadeIn third" name="password" placeholder="<?php echo $passBox; ?>">
				<input type="submit" class="fadeIn fourth" value="Log In">
			</form>

			<!-- Remind Passowrd -->
			<div id="formFooter">
				<a class="underlineHover" href="signup.php">Crear Usuario</a>
			</div>

		</div>
	</div>

</body>

</html>