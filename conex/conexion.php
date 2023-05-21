<?php 
    function Conectarse(){
        $servidor = "localhost";
        $bd = "practica";
        $user = "root";
        $clave = "";
        $cn = mysqli_connect($servidor,$user,$clave) or die("la conexion fue rechazada");
        mysqli_select_db($cn, $bd) or die("Error al seleccionar la base de datos");
        return $cn;
    }
?>