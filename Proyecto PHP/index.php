<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="estilos.css">
  <title>Document</title>
</head>

<body>

  <?php
  //Ahora creamos las variables de la sesion ej: Usuario.
  $_SESSION["usuario"] = "N/D";

  //Ahora establecemos las cookies
  $cookie_name = "usuario";
  $cookie_value = "N/D";

  setcookie($cookie_name, $cookie_value, time() + 500, "/");

  //Ahora comprobamos si la cookie está setteada

  if (!isset($_COOKIE[$cookie_name])) {
    ;
  }

  //Ahora definimos las variables que vamos a usar y las inicializamos a un valor vacio
  $userBox = $passErr = "";
  $user = $password = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["nombre"])) {
      $usErr = $userBox = "Por favor introduzca un nombre de usuario";
    } else {
      $user = $userBox = comprobarCadena($_POST["nombre"]);
    }


    if (empty($_POST["password"])) {
      echo  "Por favor introduzca una contraseña";
    }
  }

  function comprobarCadena($cad)
  {
    $cad = trim($cad); //Elimina los caracteres en blanco la principio y al final          
    $cad = stripslashes($cad); //Quita las \ para que no haya secuencias de escape
    $cad = htmlspecialchars($cad); //Elimina las etiquetas html como script para que no nos metan un script malicioso.
    return $cad;
  }


  ?>

  <div class="wrapper fadeInDown">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <img id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" id="login" class="fadeIn second" name="nombre" placeholder="usuario" value="<?php echo $userBox; ?>">
        <input type="text" id="password" class="fadeIn third" name="login" placeholder="password">
        <input type="submit" class="fadeIn fourth" value="Log In">
      </form>

      <!-- Remind Passowrd -->
      <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
      </div>

    </div>
  </div>

</body>

</html>