<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=archivo.xls");
$conexion=mysqli_connect('localhost','root','','phpdesdecero');
 ?>
 <table class="table" border = "1">
   <tr>
     <th scope="col">Nombre de la Empresa</td>
     <th scope="col">Mes</td>
     <th scope="col">A&ntilde;o</td>
     <th scope="col">Adultos</td>
     <th scope="col">Ni&ntilde;os</td>
     <th scope="col">Adultos Mayores</td>
     <th scope="col">Total de personas</td>
     <th scope="col">Lugar de procedencia</td>
   </tr>

   <?php
   $sql="SELECT * from clientes";
   $result=mysqli_query($conexion,$sql);

   while($mostrar=mysqli_fetch_array($result)){
    ?>

   <tr>
     <td><?php echo $mostrar['nombre'] ?></td>
     <td><?php echo $mostrar['mes'] ?></td>
     <td><?php echo $mostrar['anios'] ?></td>
     <td><?php echo $mostrar['adultos'] ?></td>
     <td><?php echo $mostrar['ninos'] ?></td>
     <td><?php echo $mostrar['adultosmayores'] ?></td>
     <td><?php echo $mostrar['total'] ?></td>
     <td><?php echo $mostrar['procedencia'] ?></td>
   </tr>
 <?php
 }
  ?>
 </table>
