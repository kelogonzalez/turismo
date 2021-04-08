<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$primaryKey=consultasSQL::CleanStringText($_POST['primaryKey']);
$statusAccount=consultasSQL::CleanStringText($_POST['statusAccount']);
if($statusAccount=="Activo"){
    $statusAccount="Desactivado";
}elseif($statusAccount=="Desactivado"){
    $statusAccount="Activo";
}else{
    $statusAccount="Activo";
}
if(consultasSQL::UpdateSQL("administrador", "Estado='$statusAccount'", "CodigoAdmin='$primaryKey'")){
    echo '<script type="text/javascript">
            $(document).ready(function(){
                swal({ 
                    title:"¡Cuenta actualizada!", 
                    text:"Se cambio el estado de la cuenta del administrador", 
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
            });
        </script>'; 
}else{
    echo '<script type="text/javascript">
        swal({ 
            title:"¡Ocurrió un error inesperado!", 
            text:"No hemos podido realizar la operación solicitada, por favor intenta nuevamente", 
            type: "error", 
            confirmButtonText: "Aceptar" 
        });
    </script>';
}
