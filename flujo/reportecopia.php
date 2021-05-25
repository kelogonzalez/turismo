<link rel="stylesheet" href="css/estilo.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php

	$conexion=mysqli_connect('localhost','root','','phpdesdecero');

	//cantidad de paginas


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Flujo de Ingresos de Turistas</title>
</head>
<body>


<center><h1>FLUJO DE INGRESOS DE TURISTAS</h1></center>
<br>

	<center><table class="table" >
		<tr>
			<th scope="col">Nombre de la Empresa</td>
			<th scope="col">Mes</td>
			<th scope="col">Año </td>
			<th scope="col">Adultos</td>
			<th scope="col">Niños</td>
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
 <nav aria-label="Page navigation example">
   <ul class="pagination">
     <li class="page-item"><a class="page-link" href="#">Previous</a></li>
     <li class="page-item"><a class="page-link" href="#">1</a></li>
     <li class="page-item"><a class="page-link" href="#">2</a></li>
     <li class="page-item"><a class="page-link" href="#">3</a></li>
     <li class="page-item"><a class="page-link" href="#">Next</a></li>
   </ul>
 </nav>




</center>
	<a href="./excel.php" class="btn btn-success btn-lg btn-block" >Descargar Excel</a>
	<a href="./index.html" class="btn btn-warning btn-lg btn-block" >Regresar</a>

</body>
</html>
