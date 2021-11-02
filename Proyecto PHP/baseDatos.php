<?php
$userDB = "phpmyadmin";
$passDB = "password";
$baseDatos = "accesodatos";

$conn = mysqli_connect("localhost", $userDB, $passDB, $baseDatos);

function comprobarUsuario($usuario, $password)
{
    if ($GLOBALS["conn"]) {

        $query = "select * from usuarios where user = '$usuario'";
        $result = mysqli_query($GLOBALS["conn"], $query);
        $resultSet = mysqli_fetch_row($result);
        
        return $resultSet["user"];
        
//         if ($resultSet["user"] == $usuario) {
//             return 
//             if ($resultSet["password"] == $password) {
//                 echo  "contraseña igual";
//                 return true;
//             }
//         }else {
//             return false;
//         }
//     } else {
//         return false;
    }
}
?>