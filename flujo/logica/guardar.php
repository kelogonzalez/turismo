<?php
 require 'conexion.php';

 $nombre  = $_POST['nombre'];
 $mes  = $_POST['mes'];
 $anios  = $_POST['anios'];
 $adultos  = $_POST['adultos'];
 $ninos = $_POST['ninos'];
 $adultosmayores  = $_POST['adultosmayores'];
 $procedencia  = $_POST['procedencia'];
 $total  = $adultos + $ninos + $adultosmayores;

$insertar = "INSERT INTO clientes VALUES ('$nombre','$mes','$anios','$adultos','$ninos','$adultosmayores','$procedencia','$total') ";

$query = mysqli_query($conectar, $insertar);

if($query){

   echo "<script> alert('correcto');
    location.href = '../index.html';
   </script>";

}else{
    echo "<script> alert('incorrecto');
    location.href = '../index.html';
    </script>";
}






?>
