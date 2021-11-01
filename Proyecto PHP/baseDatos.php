<?php
    
    $userDB = "root";
    $passDB = "";
    $baseDatos = "accesodatos";

    $conexion = mysqli_connect("localhost", $userDB, $passDB, $baseDatos) or die("No se ha podido conectar");

    $query = "";
    $result = "";

    function comprobarUsuario(){
      
        $query = "select * from usuarios";
        $result = mysqli_query($conexion, $query) or die("no se ha podido hacer la query");
        return $result;
    }
?>