<?php
$LoanCheck=$_POST['loancheck'];
if(count($LoanCheck)>=1){
    $CountErrors=0;
    foreach ($LoanCheck as $LoanCheckFE) {
        $LDE=explode("-", $LoanCheckFE);
        $LoanKey=$LDE[0];
        $BookKey=$LDE[1];
        $typeUser=$LDE[2];
        
        $selectBook=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='$BookKey'");
        $dataBook=mysqli_fetch_array($selectBook, MYSQLI_ASSOC);
        if($typeUser=='Docente' || $typeUser=='Estudiante'){
            if($typeUser=='Docente'){
                $tblU="prestamodocente";
            }
            if($typeUser=='Estudiante'){
                $tblU="prestamoestudiante";
            }
            $selectLoan=ejecutarSQL::consultar("SELECT * FROM ".$tblU." WHERE CodigoPrestamo='$LoanKey'");
            $dataLoan=mysqli_fetch_array($selectLoan, MYSQLI_ASSOC);
            $numDesc=$dataLoan['Cantidad'];
        }
        if($typeUser=='Personal'||$typeUser=='Visitante'){ $numDesc=1; }
        $totalP=$dataBook['Prestado']-$numDesc;
        if($totalP<0){ $totalP=0; }
        if(consultasSQL::UpdateSQL("prestamo", "Estado='Entregado'", "CodigoPrestamo='$LoanKey'") && consultasSQL::UpdateSQL("libro", "Prestado='$totalP'", "CodigoLibro='$BookKey'")){
            
        }else{
            $CountErrors++;
        }
        mysqli_free_result($selectBook);
        mysqli_free_result($selectLoan);
    }
    if($CountErrors>=1){
        echo '<script type="text/javascript">
            swal({ 
                title:"¡Ocurrió un error inesperado!", 
                text:"Tubimos algunos problemas al realizar la operación solicitada, puede ser que algunos préstamos no se marcaron con entregados, por favor intenta nuevamente", 
                type: "error", 
                confirmButtonText: "Aceptar" 
            });
        </script>';
    }else{
        echo '<script type="text/javascript">
            swal({ 
                title:"¡Préstamos entregados!", 
                text:"Los préstamos ahora aparecerá como entregados", 
                type: "success", 
                confirmButtonText: "Aceptar" 
            },
            function(isConfirm){  
                 
            });
        </script>';
    }
}else{
    echo '<script type="text/javascript">
        swal({ 
            title:"¡Ocurrió un error inesperado!", 
            text:"No has marcado ningun préstamo", 
            type: "error", 
            confirmButtonText: "Aceptar" 
        });
    </script>';
}
