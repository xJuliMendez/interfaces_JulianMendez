<?php 

    if (session_unset()) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>

    <h2>Bienvenido</h2>
    <p>Apellido: <?php echo $_COOKIE["apellido"];?></p>
    <p>Correo: <?php echo $_SESSION["email"];?></p>

    
</body>
</html>