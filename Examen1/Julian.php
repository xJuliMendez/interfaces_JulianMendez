<?php
//Inicia la sesión
session_start();

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        <style>
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        
        <?php
        
        
        //Variables de sesión
        $_SESSION["email"] = "Sin correo";

        //Establezco la cookie
        $cookie_name = "apellido";
        $cookie_value = "Vacío";
        setcookie($cookie_name, $cookie_value, 300);
        
        
        // Se definen las variables y se inicializan con un valor vacío
        $nameErr = $apellidoErr = $emailErr = $passErr = $genderErr =  "";
        $nombre = $apellido = $email = $password = $sexo  = $color = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["nombre"])) {
                $nameErr = "Por favor, rellene el campo Nombre.";
            } else {
                $nombre = test_input($_POST["nombre"]);
                // Comprueba si el nombre sólo contiene letras y espacios
                if (!preg_match("/^[a-zA-Z-' ]*$/",$nombre)) {
                    $nameErr = "Sólo se permiten letras y espacios.";
                }
            }

            if (empty($_POST["apellido"])) {
                $apellidoErr = "Por favor, rellene el campo Apellido.";
            } else {
                $apellido = test_input($_POST["apellido"]);
                // Comprueba si el apellido sólo contiene letras y espacios
                if (!preg_match("/^[a-zA-Z-' ]*$/",$apellido)) {
                    $apellidoErr = "Sólo se permiten letras y espacios.";
                } else {
                    $cookie_value = $apellido;
                    setcookie($cookie_name, $cookie_value, 300);
                }
            }
            
            if (empty($_POST["email"])) {
                $emailErr = "Por favor, rellene el campo Correo Electrónico.";
            } else {
                $email = test_input($_POST["email"]);
                // Comprueba si el e-mail está bien formado
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Formato inválido de correo.";
                }
                $_SESSION["email"] = $email;
            }
            //Comprueba si está rellenado el campo password
            if (empty($_POST["password"])) {
                $passErr = "Por favor, rellene el campo Contraseña.";
            } else {
                if (test_pass($_POST["password"])) {
                    $password = test_input($_POST["password"]);
                }else {
                    $passErr = "Número de caracteres incorrecto";
                }
                
            }
           //Si las variables tienen algun dato te lleva a inicio.php
            if (!empty($nombre) && !empty($apellido) && !empty($password)) {
                $_SESSION["email"] = $email;
                setcookie($cookie_name, $cookie_value, 300);
                header("location: http://localhost:3000/Examen1/inicio.php");
            }


        }
        //Comprueba que en la cadena no haya ningun script malicioso
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }
        //Comprueba que la contraseña sea mayor que 6 y menor que 12
        function test_pass($data){
            $data = test_input($data);
            if (strlen($data)>=6 && strlen($data) <= 12) {
                return true;
            }else{
                return false;
            }
        }
        ?>
        
        <h2>Examen PHP Julián Méndez</h2>
        <p><span class="error">* campo requerido</span></p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          Nombre: <input type="text" name="nombre"value="<?php echo $nombre;?>">
          <span class="error">* <?php echo $nameErr;?></span>
          <br><br>
          Apellido: <input type="text" name="apellido"value="<?php echo $apellido;?>">
          <span class="error">* <?php echo $apellidoErr;?></span>
          <br><br>
          E-mail: <input type="text" name="email" value="<?php echo $email;?>">
          <br><br>
          Contraseña: <input type="password" name="password" value="<?php echo $password;?>">
          <span class="error">* <?php echo $passErr;?></span>
          <br><br>
          Sexo:
          <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo=="femenino") echo "checked";?> value="femenino">Femenino
  		  <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo=="masculino") echo "checked";?> value="masculino">Masculino
  		  <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo=="otro"){ echo "checked";}?> value="otro" checked>No declarado
  		  <br><br>
          Color Favorito:
          <input type="checkbox" name="color" <?php if (isset($color) && $color=="rojo") echo "checked";?> value="rojo">Rojo
  		  <input type="checkbox" name="color" <?php if (isset($color) && $color=="verde") echo "checked";?> value="verde">Verde
  		  <input type="checkbox" name="color" <?php if (isset($color) && $color=="azul"){ echo "checked";}?> value="azul">Azul
  		  <input type="checkbox" name="color" <?php if (isset($color) && $color=="amarillo"){ echo "checked";}?> value="amarillo">Amarillo  
          <br><br>
          <input type="submit" name="submit" value="Enviar">  
          <?php

            
          ?>
          
	</form>

 	</body>
</html>