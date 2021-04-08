<?php
	$bookCode=consultasSQL::CleanStringText($_POST['bookCodePm']);
	$startDate=consultasSQL::CleanStringText($_POST['startDatePm']);
	$endDate=consultasSQL::CleanStringText($_POST['endDatePm']);  
	$CantL=consultasSQL::CleanStringText($_POST['CantL']);

	$firstDate=strtotime($startDate);
	$secondDate=strtotime($endDate);
	if($firstDate<$secondDate || $firstDate==$secondDate){
		if(empty($_SESSION['prestmultiple'][$bookCode])){
			$CBS=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='$bookCode'");
			$dataCBS=mysqli_fetch_array($CBS, MYSQLI_ASSOC);
			$totalFree=($dataCBS['Existencias']-$dataCBS['Prestado']);
			if($totalFree>=$CantL){
				$_SESSION['prestmultiple'][$bookCode] =[
					'bookcode' => $bookCode, 
	            	'startdate' => $startDate,
	            	'enddate' => $endDate,
	            	'totalbooks' => $CantL
	            ];
	            echo '<script type="text/javascript">
				    swal({ 
				        title:"¡Libro Agregado!", 
				        text:"El libro se agrego a prestamos multiples", 
				        type: "success", 
				        confirmButtonText: "Aceptar" 
				    });
				</script>';
				unset($_POST);
			}else{
				echo '<script type="text/javascript">
				    swal({ 
				        title:"¡Ocurrió un error inesperado!", 
				        text:"No hay ejemplares suficientes del libro para prestar por favor verifique que hay libros disponibles o elija un número menor de libros a prestar", 
				        type: "error", 
				        confirmButtonText: "Aceptar" 
				    });
				</script>';
			}
			mysqli_free_result($CBS);
		}else{
			echo '<script type="text/javascript">
			    swal({ 
			        title:"¡Ocurrió un error inesperado!", 
			        text:"Este libro ya fue agregado a prestamos multiples", 
			        type: "error", 
			        confirmButtonText: "Aceptar" 
			    });
			</script>';
		}
	}else{
		echo '<script type="text/javascript">
		    swal({ 
		        title:"¡Ocurrió un error inesperado!", 
		        text:"La fecha de solicitud no puede ser mayor que la fecha de entrega, verifica e intenta nuevamente", 
		        type: "error", 
		        confirmButtonText: "Aceptar" 
		    });
		</script>';
	}