<?php
// Dirección o IP del servidor MySQL
$host="localhost";

// Puerto del servidor MySQL
$puerto="3306";

// Nombre de usuario del servidor MySQL
$usuario="root";

// Contraseña del usuario
$contrasena="Suncion123";

// Nombre de la base de datos
$baseDeDatos="dbartesanias";

// Nombre de la tabla a trabajar
$tabla="productos";

function Conectarse(){
    global$host,$puerto,$usuario,$contrasena,$baseDeDatos,$tabla;
    if(!($link=mysqli_connect($host.":".$puerto,$usuario,$contrasena))){
        echo"Error conectando a la base de datos.<br>";
        exit();
    }/*else{
        echo"Listo, estamos conectados.<br>";
    }*/
    $link -> set_charset("utf8");

    if(!mysqli_select_db($link,$baseDeDatos)){
        echo"Error seleccionando la base de datos.<br>";
        exit();
    }/*else{
        echo"Obtuvimos la base de datos $baseDeDatos sin problema.<br>";
    }*/
    return $link;
}



?>