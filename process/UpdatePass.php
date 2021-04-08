<?php
	session_start();
	include '../library/configServer.php';
	include '../library/consulSQL.php';
	include '../library/SED.php';
	$userPrivilege=consultasSQL::CleanStringText($_POST['userPrivilege']);
	$userKey=consultasSQL::CleanStringText($_POST['userKey']);
	$userName=consultasSQL::CleanStringText($_POST['userName']);
	$userPass1=consultasSQL::CleanStringText($_POST['userPass1']);
	$userPass2=consultasSQL::CleanStringText($_POST['userPass2']);
	$userPass3=consultasSQL::CleanStringText($_POST['userPass3']);
	if($_SESSION['UserPrivilege']=='Student'){
		$tableUser="estudiante";
	}
	if($_SESSION['UserPrivilege']=='Teacher'){
		$tableUser="docente";
	}
	if($_SESSION['UserPrivilege']=='Personal'){
		$tableUser="personal";
	}
	$Oldpass=SED::encryption($userPass1);
	$Newpass=SED::encryption($userPass2);
	$checkUser=ejecutarSQL::consultar("SELECT * FROM $tableUser WHERE NombreUsuario='$userName' AND Clave='$Oldpass'");
	if(mysqli_num_rows($checkUser)>=1){
		if($userPass2==$userPass3){
			if(consultasSQL::UpdateSQL("$tableUser", "Clave='$Newpass'", "NombreUsuario='$userName' AND Clave='$Oldpass'")){
				echo '<script type="text/javascript">
		            swal({ 
		                title:"¡Contraseña actualizada!", 
		                text:"La contraseña se actualizo correctamente", 
		                type: "success", 
		                confirmButtonText: "Aceptar" 
		            },
		            function(isConfirm){  
		                if (isConfirm) {     
		                    location.reload();
		                } else {    
		                    location.reload();
		                } 
		            });
		        </script>';
			}else{
				echo '<script type="text/javascript">
		            swal({ 
		                title:"¡Ocurrió un error inesperado!", 
		                text:"No se pudo actualizar la contraseña", 
		                type: "error", 
		                confirmButtonText: "Aceptar" 
		            });
		        </script>';
			}
		}else{
			echo '<script type="text/javascript">
	            swal({ 
	                title:"¡Ocurrió un error inesperado!", 
	                text:"Las nuevas contraseñas que acabas de ingresar no coinciden", 
	                type: "error", 
	                confirmButtonText: "Aceptar" 
	            });
	        </script>';
		}
	}else{
		echo '<script type="text/javascript">
            swal({ 
                title:"¡Ocurrió un error inesperado!", 
                text:"La contraseña que acabas de ingresar es incorrecta", 
                type: "error", 
                confirmButtonText: "Aceptar" 
            });
        </script>';
	}
	mysqli_free_result($checkUser);