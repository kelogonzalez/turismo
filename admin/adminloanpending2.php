<!DOCTYPE html>
<html lang="es">
<head>
    <title>Prestamos</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>
    <script src="../js/SendForm.js"></script>
    <script>
        $(document).ready(function(){
           $('.btn-file-loan').click(function(){
               var user=$(this).attr('data-user');
               var codeL=$(this).attr('data-code-loan');
               swal({
                    title: "¿Quieres ver la ficha?",
                    text: "La ficha se generará en formato PDF y se abrirá una ventana nueva. Debes esperar un lapso de tiempo de 15 segundos para que el sistema genere la ficha",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#31B0D5",
                    confirmButtonText: "Si, ver ficha",
                    cancelButtonText: "No, cancelar",
                    animation: "slide-from-top",
                    closeOnConfirm: true 
                },function(){
                    if(user==="Docente"){
                       var file="../report/fichaDN.php?loanCode="+codeL;
                       window.open(file,"_blank");
                   }else if(user==="Estudiante"){
                       var file="../report/fichaEN.php?loanCode="+codeL;
                       window.open(file,"_blank");
                   }else if(user==="Visitante"){
                       var file="../report/fichaVN.php?loanCode="+codeL;
                       window.open(file,"_blank");
                   }else if(user==="Personal"){
                       var file="../report/fichaPN.php?loanCode="+codeL;
                       window.open(file,"_blank");
                   }else{
                        swal({
                           title:"¡Ocurrió un error inesperado!",
                           text:"Hemos tenido un error, por favor recarga la página e intenta nuevamente",
                           type: "error",
                           confirmButtonText: "Aceptar"
                        });
                   }
                });
           });
        });
    </script>
</head>
<body>
    <?php 
        include '../library/configServer.php';
        include '../library/consulSQL.php';
        include '../library/SelectMonth.php';
        include '../process/SecurityAdmin.php';
        include '../inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php 
            include '../inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema bibliotecario <small>préstamos y reservaciones</small></h1>
            </div>
        </div>
        <div class="conteiner-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
                <li><a href="adminloan.php">Todos los préstamos</a></li>
                <li class="active"><a href="adminloanpending.php">Devoluciones pendientes</a></li>
                <li><a href="adminreservation.php">Reservaciones</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/clock.png" alt="calendar" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a esta sección, aquí se muestran todos los préstamos de libros que no han sido devueltos por los docentes, estudiantes y personal administrativo
                </div>
            </div>
        </div>
        <?php 
            if(isset($_POST['loancheck'])){
                include "../process/UpdateLoan.php";
            }
        ?>
        <div class="container-fluid">
            <h2 class="text-center all-tittles">Listado de devoluciones pendientes</h2>
            <?php

                $ukeyl = isset($_GET['ukeyl']) ? consultasSQL::CleanStringText($_GET['ukeyl']) : "";
                $utypel = isset($_GET['utypel']) ? consultasSQL::CleanStringText($_GET['utypel']) : "";

                if($utypel==1){
                    $utableu="estudiante";
                    $utablel="prestamoestudiante";
                    $ufieldl="NIE";
                }elseif($utypel==2){
                    $utableu="docente";
                    $utablel="prestamodocente";
                    $ufieldl="DUI";
                }elseif($utypel==3){
                    $utableu="personal";
                    $utablel="prestamopersonal";
                    $ufieldl="DUI";
                }
                if($utypel==4){
                    $queryL=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibroManual='$ukeyl'");
                    $dataqueryL=mysqli_fetch_array($queryL, MYSQLI_ASSOC);
                    $checkLoansPending=ejecutarSQL::consultar("SELECT SQL_CALC_FOUND_ROWS * FROM prestamo WHERE CodigoLibro='".$dataqueryL['CodigoLibro']."' AND Estado='Prestamo'");
                    mysqli_free_result($queryL);
                }else{
                    $checkLoansPending=ejecutarSQL::consultar("SELECT SQL_CALC_FOUND_ROWS * FROM $utablel WHERE $ufieldl='$ukeyl'");
                }

                if(mysqli_num_rows($checkLoansPending)>=1){
        ?>
        <br><br><br>
        <div class="container-fluid">
            <p class="lead text-center">Buscar por Código Libro,DNI o NIE</p>
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <form action="" method="GET">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="group-material">
                                        <input type="search" class="material-control tooltips-general" placeholder="Código Libro,DNI o NIE" name="ukeyl" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el Código Libro,DNI o NIE">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="group-material">
                                        <select name="utypel" required="" class="material-control tooltips-general" data-toggle="tooltip" data-placement="top" title="Seleccione el tipo de busqueda">
                                            <option value="1">Estudiante</option>
                                            <option value="2">Docente</option>
                                            <option value="3">Personal Ad.</option>
                                            <option value="4">Código Libro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <p class="text-center">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br>
        <form action="" method="POST">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nombre de libro</th>
                        <th>DNI/NIE</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>F. Solicitud</th>
                        <th>F. Entrega</th>
                        <th>Marcar</th>
                        <th>Ver Ficha</th>
                    </tr>
                </thead>
                <tbody>
        <?php
            $f=0;
            if($utypel==4){
                while($data=mysqli_fetch_array($checkLoansPending, MYSQLI_ASSOC)){
                    $f++;
                    $checkLoanU1=ejecutarSQL::consultar("SELECT * FROM prestamodocente WHERE CodigoPrestamo='".$data['CodigoPrestamo']."'");
                    if(mysqli_num_rows($checkLoanU1)>=1){
                        $dataU1=mysqli_fetch_array($checkLoanU1, MYSQLI_ASSOC);
                        $selectTeacherData=ejecutarSQL::consultar("SELECT * FROM docente WHERE DUI='".$dataU1['DUI']."'");
                        $dataT=mysqli_fetch_array($selectTeacherData, MYSQLI_ASSOC);
                        $nameUser=$dataT['Nombre']." ".$dataT['Apellido'];
                        $typeUser='Docente';
                        $KeyU=$dataU1['DUI'];
                    }
                    $checkLoanU2=ejecutarSQL::consultar("SELECT * FROM prestamoestudiante WHERE CodigoPrestamo='".$data['CodigoPrestamo']."'");
                    if(mysqli_num_rows($checkLoanU2)>=1){
                        $dataU2=mysqli_fetch_array($checkLoanU2, MYSQLI_ASSOC);
                        $selectStudentData=ejecutarSQL::consultar("SELECT * FROM estudiante WHERE NIE='".$dataU2['NIE']."'");
                        $dataS=mysqli_fetch_array($selectStudentData, MYSQLI_ASSOC);
                        $nameUser=$dataS['Nombre']." ".$dataS['Apellido'];
                        $typeUser='Estudiante';
                        $KeyU=$dataU2['NIE'];
                    }
                    $checkLoanU3=ejecutarSQL::consultar("SELECT * FROM prestamovisitante WHERE CodigoPrestamo='".$data['CodigoPrestamo']."'");
                    if(mysqli_num_rows($checkLoanU3)>=1){
                        $dataU3=mysqli_fetch_array($checkLoanU3, MYSQLI_ASSOC);
                        $nameUser=$dataU3['Nombre'];
                        $typeUser='Visitante';
                        $KeyU=$dataU3['DUI'];
                    }
                    $checkLoanU4=ejecutarSQL::consultar("SELECT * FROM prestamopersonal WHERE CodigoPrestamo='".$data['CodigoPrestamo']."'");
                    if(mysqli_num_rows($checkLoanU4)>=1){
                        $dataU4=mysqli_fetch_array($checkLoanU4, MYSQLI_ASSOC);
                        $selectPersonalData=ejecutarSQL::consultar("SELECT * FROM personal WHERE DUI='".$dataU4['DUI']."'");
                        $dataP=mysqli_fetch_array($selectPersonalData, MYSQLI_ASSOC);
                        $nameUser=$dataP['Nombre']." ".$dataP['Apellido'];
                        $typeUser='Personal';
                        $KeyU=$dataU4['DUI'];
                    }
                    $selecBook=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$data['CodigoLibro']."'");
                    $file=mysqli_fetch_array($selecBook, MYSQLI_ASSOC);
        ?>
        <tr>
            <td><?php echo $f; ?></td>
            <td><?php echo $file['CodigoLibroManual']; ?></td>
            <td><?php echo $file['Titulo']; ?></td>
            <td><?php echo $KeyU; ?></td>
            <td><?php echo $nameUser; ?></td>
            <td><?php echo $typeUser; ?></td>
            <td><?php echo $data['FechaSalida']; ?></td>
            <td><?php echo $data['FechaEntrega']; ?></td>
            <td>
                <div class="checkbox text-center">
                    <input type="checkbox" name="loancheck[]" value="<?php echo $data['CodigoPrestamo'].'-'.$data['CodigoLibro'].'-'.$typeUser; ?>">
                </div>      
            </td>
            <td>
                <button type="button" class="btn btn-info btn-file-loan" data-user="<?php echo $typeUser; ?>" data-code-loan="<?php echo $data['CodigoPrestamo']; ?>"><i class="zmdi zmdi-file-text"></i></button>
            </td>
        </tr>
        <?php
                mysqli_free_result($checkLoanU1);
                mysqli_free_result($checkLoanU2);
                mysqli_free_result($checkLoanU3);
                mysqli_free_result($checkLoanU4);
                mysqli_free_result($selectTeacherData);
                mysqli_free_result($selectStudentData);
                mysqli_free_result($selectPersonalData);
                mysqli_free_result($selecBook);
                }
            }else{
            $query1=ejecutarSQL::consultar("SELECT * FROM $utableu WHERE $ufieldl='$ukeyl'");
            $udatau=mysqli_fetch_array($query1, MYSQLI_ASSOC);
            while($data2=mysqli_fetch_array($checkLoansPending, MYSQLI_ASSOC)){
                $query2=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoPrestamo='".$data2['CodigoPrestamo']."' AND Estado='Prestamo'");
                if(mysqli_num_rows($query2)>=1){
                    $data=mysqli_fetch_array($query2, MYSQLI_ASSOC);
                    $f++;
                    if($utypel==1){
                        $typeUser="Estudiante";
                    }elseif($utypel==2){
                        $typeUser="Docente";
                    }elseif($utypel==3){
                        $typeUser="Personal";
                    }

                    $query3=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$data['CodigoLibro']."'");
                    $file=mysqli_fetch_array($query3, MYSQLI_ASSOC);
                
        ?>
            <tr>
                <td><?php echo $f; ?></td>
                <td><?php echo $file['CodigoLibroManual']; ?></td>
                <td><?php echo $file['Titulo']; ?></td>
                <td><?php echo $ukeyl; ?></td>
                <td><?php echo $udatau['Nombre']." ".$udatau['Apellido']; ?></td>
                <td><?php echo $typeUser; ?></td>
                <td><?php echo $data['FechaSalida']; ?></td>
                <td><?php echo $data['FechaEntrega']; ?></td>
                <td>
                    <div class="checkbox text-center">
                        <input type="checkbox" name="loancheck[]" value="<?php echo $data['CodigoPrestamo'].'-'.$data['CodigoLibro'].'-'.$typeUser; ?>">
                    </div>      
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-file-loan" data-user="<?php echo $typeUser; ?>" data-code-loan="<?php echo $data['CodigoPrestamo']; ?>"><i class="zmdi zmdi-file-text"></i></button>
                </td>
            </tr>
        <?php
                }
            }
            }
        ?>

            <tbody></table></div>
            <p class="text-center">
                <button type="submit" class="btn btn-success"><i class="zmdi zmdi-time-restore"></i> Recibir todos los marcados</button>
            </p>
            </form>
        <?php
                }else{
                    echo '<br><br><br><p class="lead text-center all-tittles">No hay devoluciones pendientes</p><br><br><br><br><br><br>';
                }
                mysqli_free_result($checkLoansPending);
            ?>
        </div>
        <div class="msjFormSend"></div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include '../help/help-adminloanpending.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <?php include '../inc/footer.php'; ?>
    </div>
</body>
</html>