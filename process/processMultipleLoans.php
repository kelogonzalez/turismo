<?php
	$userCode=consultasSQL::CleanStringText($_POST['userKey']);
	$userType=consultasSQL::CleanStringText($_POST['userType']);
	$adminCode=consultasSQL::CleanStringText($_POST['adminCode']);

	if(count($_SESSION['prestmultiple'])>=1){

		if($userType=="Student"){
			$usertableLoans="prestamoestudiante";
			$userTable="estudiante";
			$userField="NIE";
			$userName="Estudiante";
		}

		if($userType=="Teacher"){
			$usertableLoans="prestamodocente";
			$userTable="docente";
			$userField="DUI";
			$userName="Docente";
		}

		if($userType=="Personal"){
			$usertableLoans="prestamopersonal";
			$userTable="personal";
			$userField="DUI";
			$userName="Personal Ad.";
		}

		$checkUsers=ejecutarSQL::consultar("SELECT * FROM ".$userTable." WHERE ".$userField."='".$userCode."'");
		if(mysqli_num_rows($checkUsers)>=1){
			$ec=0;
			$sc=0;
			foreach($_SESSION['prestmultiple'] as $databook){
				$bookCode=$databook['bookcode'];
				$startDate=$databook['startdate'];
				$endDate=$databook['enddate'];
				$loanState="Prestamo";  

				if($userType=="Student"){
					$totalBooks=$databook['totalbooks'];
				}

				if($userType=="Teacher"){
					$totalBooks=$databook['totalbooks'];
				}

				if($userType=="Personal"){
					$totalBooks=1;
				}

				$checkLoans=ejecutarSQL::consultar("SELECT * FROM prestamo");
				$totalLoans=mysqli_num_rows($checkLoans);
				$numLoans=$totalLoans+1;
				$codigo=""; 
				$longitud=4; 
				for ($i=1; $i<=$longitud; $i++){ 
				    $numero = rand(0,9); 
				    $codigo .= $numero; 
				}
				$loanCode="U".$userCode."P".$numLoans."N".$codigo."";

				$checkTotalsBooks=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$bookCode."'");
				$dataBook2=mysqli_fetch_array($checkTotalsBooks, MYSQLI_ASSOC);
				$bookUnits=$dataBook2['Prestado']+$totalBooks;
				$totalBL=($dataBook2['Existencias'])-($dataBook2['Prestado']+$totalBooks);

				if($totalBL>=0){
					if(consultasSQL::InsertSQL("prestamo", "CodigoPrestamo,CodigoLibro,CodigoAdmin,FechaSalida,FechaEntrega,Estado", "'$loanCode','$bookCode','$adminCode','$startDate','$endDate','$loanState'")){

						if($userType=="Teacher" || $userType=="Student"){
							if(consultasSQL::InsertSQL($usertableLoans, "CodigoPrestamo,$userField,Cantidad", "'$loanCode','$userCode','$totalBooks'")){
								if(consultasSQL::UpdateSQL("libro", "Prestado='$bookUnits'", "CodigoLibro='$bookCode'")){
									$sc++;
									unset($_SESSION['prestmultiple'][$bookCode]);
								}else{
									$ec++;
								}
							}else{
								$ec++;
							}
						}else{
							if(consultasSQL::InsertSQL($usertableLoans, "CodigoPrestamo,$userField", "'$loanCode','$userCode'")){
								if(consultasSQL::UpdateSQL("libro", "Prestado='$bookUnits'", "CodigoLibro='$bookCode'")){
									$sc++;
									unset($_SESSION['prestmultiple'][$bookCode]);
								}else{
									$ec++;
								}
							}else{
								$ec++;
							}
						}

					}else{
						$ec++;
					}
				}else{
					$ec++;
				}

				mysqli_free_result($checkLoans);
				mysqli_free_result($checkTotalsBooks);
			}

			if($ec<=0){
				echo '<script type="text/javascript">
		            swal({ 
		                title:"¡Prestamos realizados!", 
		                text:"Los '.$sc.' prestamos se procesaron con exito", 
		                type: "success", 
		                confirmButtonText: "Aceptar" 
		            });
		        </script>';
			}else{
				echo '<script type="text/javascript">
		            swal({ 
		                title:"¡Ocurrió un problema!", 
		                text:"algunos prestamos no se pudieron realizar debido a que no hay existencias disponibles", 
		                type: "info", 
		                confirmButtonText: "Aceptar" 
		            });
		        </script>';
			}
				
		}else{
			echo '<script type="text/javascript">
	            swal({ 
	                title:"¡Ocurrió un error inesperado!", 
	                text:"No se ha registrado ningún '.$userName.' con '.$userField.' numero '.$userCode.'", 
	                type: "error", 
	                confirmButtonText: "Aceptar" 
	            });
	        </script>';
		}

		mysqli_free_result($checkUsers);
	}else{
		echo '<script type="text/javascript">
            swal({ 
                title:"¡Ocurrió un error inesperado!", 
                text:"No haz agregado ningun libro a prestamos multiples", 
                type: "error", 
                confirmButtonText: "Aceptar" 
            });
        </script>';
	}