<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$sectionCode=consultasSQL::CleanStringText($_POST['sectionCode']);
$teacherDUI=consultasSQL::CleanStringText($_POST['teacherDUI']);
$OldteacherDUI=consultasSQL::CleanStringText($_POST['OldteacherDUI']);
if($teacherDUI=="Sin asignar" && $OldteacherDUI!=""){
    $condition="DUI='$OldteacherDUI'";
    $values="CodigoSeccion='Sin asignar'";
    $updateVal=1;
}elseif($teacherDUI!="Sin asignar"){
    $condition="DUI='$teacherDUI'";
    $values="CodigoSeccion='$sectionCode'";
    $updateVal=1;
}elseif($teacherDUI=="Sin asignar"){
    $updateVal=0;
}
if($updateVal==1){
    if(consultasSQL::UpdateSQL("docente", $values, $condition)){
        echo '<script type="text/javascript">
            swal({ 
                title:"¡Sección actualizada!", 
                text:"Los datos de la sección se actualizaron correctamente", 
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
                text:"No se pudo actualizar los datos de la sección, por favor intenta nuevamente", 
                type: "error", 
                confirmButtonText: "Aceptar" 
            });
        </script>';
    }
}else{
    echo '<script type="text/javascript">
        swal({ 
            title:"¡Información!", 
            text:"No era necesario actualizar la sección", 
            type: "info", 
            confirmButtonText: "Aceptar" 
        });
    </script>';
}