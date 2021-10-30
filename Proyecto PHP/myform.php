<?php
// Arrancar la sesión
session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Validación de formulario</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    //Variables de sesión
    $_SESSION["favcolor"] = "amarillo";
    $_SESSION["usuario"] = "Sin nombre";
    echo "Las variables de sesion han sido creadas.<br>";

    //Establezco la cookie
    $cookie_name = "usuario";
    $cookie_value = "Vacío";
    setcookie($cookie_name, $cookie_value, time() + (300), "/"); // 8300 = 5 minutos

    //Miro si está la cookie
    if (!isset($_COOKIE[$cookie_name])) {
        echo "La cookie '" . $cookie_name . "' no se ha guardado";
    } else {
        echo "La cookie '" . $cookie_name . "' se ha guardado<br>";
        echo "Su valor es " . $_COOKIE[$cookie_name];
    }


    // Se definen las variables y se inicializan con un valor vacío
    $nameErr = $emailErr = $genderErr = $websiteErr = "";
    $nombre = $email = $sexo = $comentario = $sitioweb = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nombre"])) {
            $nameErr = "Por favor, rellene el campo Nombre.";
        } else {
            $nombre = test_input($_POST["nombre"]);
            // Comprueba si el nombre sólo contiene letras y espacios
            if (!preg_match("/^[a-zA-Z-' ]*$/", $nombre)) {
                $nameErr = "Sólo se permiten letras y espacios.";
            } else {
                $cookie_value = $nombre;
                setcookie($cookie_name, $cookie_value, time() + (300), "/"); // 8300 = 5 minutos
                $_SESSION["usuario"] = $nombre;
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
        }

        if (empty($_POST["sitioweb"])) {
            $sitioweb = "";
        } else {
            $sitioweb = test_input($_POST["sitioweb"]);
            // Comprueba si la URL es válida
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $sitioweb)) {
                $websiteErr = "URL inválida";
            }
        }

        if (empty($_POST["comentario"])) {
            $comentario = "";
        } else {
            $comentario = test_input($_POST["comentario"]);
        }

        if (empty($_POST["sexo"])) {
            $genderErr = "Por favor, rellene el campo Sexo.";
        } else {
            $sexo = test_input($_POST["sexo"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>Ejemplo de validación de formulario en PHP</h2>
    <p><span class="error">* campo requerido</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $nombre; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        Sitio Web: <input type="text" name="sitioweb" value="<?php echo $sitioweb; ?>">
        <span class="error"><?php echo $websiteErr; ?></span>
        <br><br>
        Comentario: <textarea name="comentario" rows="5" cols="40"><?php echo $comentario; ?></textarea>
        <br><br>
        Sexo:
        <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo == "femenino") echo "checked"; ?> value="femenino">Femenino
        <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo == "masculino") echo "checked"; ?> value="masculino">Masculino
        <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo == "otro") echo "checked"; ?> value="otro">No contesta
        <span class="error">* <?php echo $genderErr; ?></span>
        <br><br>
        <input type="submit" name="submit" value="Enviar">
    </form>

    <a href="holacookie.php" target="_blank">Para comprobar cookies y sesión</a> <br>

    <?php
    // Muestra las variables de la sesión activa
    echo "Mi color favorito es " . $_SESSION["favcolor"] . ".<br>";
    echo "Mi nombre de usuario es " . $_SESSION["usuario"] . ".<br>";

    echo "<h2>Su entrada:</h2>";
    echo $nombre;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $sitioweb;
    echo "<br>";
    echo $comentario;
    echo "<br>";
    echo $sexo;
    ?>
</body>

</html>