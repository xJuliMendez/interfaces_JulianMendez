<?php
$userDB = "root";
$passDB = "";
$baseDatos = "accesodatos";

$GLOBALS["conn"] = mysqli_connect("localhost", $userDB, $passDB, $baseDatos);

function logInUsuario($usuario, $password)
{
    if ($GLOBALS["conn"] ) {

        $query = "select * from usuarios where user = '$usuario'";
        echo $query;
        $result = mysqli_query($GLOBALS["conn"] , $query);
        $resultSet = $result->fetch_assoc();
        if ($resultSet["password"] == $password) {
            return true;
        }else {
            return false;
        }
    } else {
        echo "pepe";
        return false;
    }
}
