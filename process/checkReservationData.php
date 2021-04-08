<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$codeLoan=consultasSQL::CleanStringText($_POST['codeLoan']);
$userType=consultasSQL::CleanStringText($_POST['userType']);
if($userType=="Docente"){ $fileUser="fichaDN"; }
if($userType=="Estudiante"){ $fileUser="fichaEN"; }
if($userType=="Personal"){ $fileUser="fichaPN"; }
$selectDataL=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoPrestamo='$codeLoan'");
$dataL=mysqli_fetch_array($selectDataL, MYSQLI_ASSOC);
if(mysqli_num_rows($selectDataL)>=1){
    $selectDataB=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$dataL['CodigoLibro']."'");
    $fila=mysqli_fetch_array($selectDataB, MYSQLI_ASSOC);
    $totalBook=$fila['Existencias']-$fila['Prestado'];
    if($totalBook>=1){
        echo "<p><strong>Hay ".$totalBook." libros disponibles de ".$fila['Titulo']." para prestar.</strong></p>";
        if($userType=="Docente" || $userType=="Estudiante"){
            if($userType=="Docente"){
                $tblU="prestamodocente";
            }
            if($userType=="Estudiante"){
                $tblU="prestamoestudiante";
            }
            $selectDataLT=ejecutarSQL::consultar("SELECT * FROM ".$tblU." WHERE CodigoPrestamo='$codeLoan'");
            $dataLT=mysqli_fetch_array($selectDataLT, MYSQLI_ASSOC);
            echo '<div class="alert alert-info text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante!:<br></strong>El usuario ha solicitado prestar <strong>'.$dataLT['Cantidad'].' libros</strong>. Para aprobar el préstamo haz click el botón "Aprobar reservación"</div>
            </div>
            <br>
            <div class="group-material">
                <input type="text" value="'.$dataLT['Cantidad'].'" class="tooltips-general material-control" placeholder="¿Cuantos libros se prestarán?" name="numDesc" required="" maxlength="7" data-toggle="tooltip" data-placement="top" title="¿Cuantos libros se prestarán?">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Total de libros a prestar</label>
            </div>';
        }else{
            echo '<div class="alert alert-info text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante!:</strong> Para aprobar el préstamo haz click el botón "Aprobar reservación"</div>
            <input type="hidden" value="1" name="numDesc">';
        }
    }else{
        echo '<div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Importante!:</strong><br>No hay libros disponibles para realizar el préstamo.</div>';
    }
    echo '<input type="hidden" value="'.$userType.'" name="userType" ><input type="hidden" value="'.$dataL['CodigoLibro'].'" name="bookCode" ><input type="hidden" value="'.$dataL['CodigoPrestamo'].'" name="loanCode" ><input type="hidden" value="'.$fileUser.'" name="userFile" >';
}else{
    echo '<div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Error!:</strong> Lo sentimos ha ocurrido un error.</div>';
}
mysqli_free_result($selectDataL);
mysqli_free_result($selectDataB);
mysqli_free_result($selectDataLT);