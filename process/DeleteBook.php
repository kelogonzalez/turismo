<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$primaryKey=consultasSQL::CleanStringText($_POST['primaryKey']);
$checkLoanBook=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$primaryKey."'");
$selectBook= ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$primaryKey."'");
$fila=mysqli_fetch_array($selectBook, MYSQLI_ASSOC);
if(mysqli_num_rows($checkLoanBook)<=0){
    if(consultasSQL::DeleteSQL("libro", "CodigoLibro='$primaryKey'")){
        if($fila['Imagen']!=""){
            chmod("../assets/uploads/img/".$fila['Imagen'], 0777);
            unlink("../assets/uploads/img/".$fila['Imagen']);

        }
        if($fila['PDF']!=""){
            chmod("../assets/uploads/pdf/".$fila['PDF'], 0777);
            unlink("../assets/uploads/pdf/".$fila['PDF']);
        }
        echo '<script type="text/javascript">
            swal({
                title:"¡Empresa eliminada!",
                text:"Los datos de la empresa se eliminaron exitosamente",
                type: "success",
                confirmButtonText: "Aceptar"
            },
            function(isConfirm){
                if (isConfirm) {
                   window.location="home.php";
                } else {
                    window.location="home.php";
                }
            });
        </script>';
    }else{
        echo '<script type="text/javascript">
            swal({
                title:"¡Ocurrió un error inesperado!",
                text:"No se pudo eliminar el libro del sistema, por favor intenta de nuevo",
                type: "error",
                confirmButtonText: "Aceptar"
            });
        </script>';
    }
}else{
    echo '<script type="text/javascript">
        swal({
            title:"¡Ocurrió un error inesperado!",
            text:"Este libro tiene préstamos registrados, no puedes eliminarlo",
            type: "error",
            confirmButtonText: "Aceptar"
        });
    </script>';
}
mysqli_free_result($checkLoanBook);
mysqli_free_result($selectBook);
