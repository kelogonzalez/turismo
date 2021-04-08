<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reservaciones</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php'; 
    ?>
    <script src="../js/SendForm.js"></script>
    <script>
        $(document).ready(function(){
            $('.btn-reservation').on('click', function(){
                var codeLoan=$(this).attr('data-code-loan');
                var userType=$(this).attr('data-user');
                $.ajax({
                    url:'../process/checkReservationData.php',
                    type: 'POST',
                    data: 'codeLoan='+codeLoan+'&userType='+userType,
                    success:function(data){
                        $('#modalDataLoan').html(data);
                        $('#modalR').modal({
                            show: true,
                            backdrop: "static"
                        });
                    }
                });
                return false;
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
                <li><a href="adminloanpending.php">Devoluciones pendientes</a></li>
                <li class="active"><a href="adminreservation.php">Reservaciones</a></li>
            </ul>
        </div>
         <div class="container-fluid" style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/calendar.png" alt="clock" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a esta sección, aquí se muestran las reservaciones de libros hechas por los docentes y estudiantes, las cuales están pendientes para ser aprobadas por ti
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <h2 class="text-center all-tittles">Listado de reservaciones</h2>
            <?php
                $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                mysqli_set_charset($mysqli, "utf8");

                $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                $regpagina = 40;
                $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                $checkingRservations=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM prestamo WHERE Estado='Reservacion' ORDER BY FechaSalida ASC LIMIT $inicio, $regpagina");

                $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
        
                $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);
                if(mysqli_num_rows($checkingRservations)>=1){
            ?>
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
                            <th>Aprobar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
                    $y=$inicio;
                    while($data=mysqli_fetch_array($checkingRservations, MYSQLI_ASSOC)){
                        $y++;
                        $checkReserU1=ejecutarSQL::consultar("SELECT * FROM prestamodocente WHERE CodigoPrestamo='".$data['CodigoPrestamo']."'");
                        if(mysqli_num_rows($checkReserU1)>=1){
                            $dataU1=mysqli_fetch_array($checkReserU1, MYSQLI_ASSOC);
                            $selectTeacherData=ejecutarSQL::consultar("SELECT * FROM docente WHERE DUI='".$dataU1['DUI']."'");
                            $dataT=mysqli_fetch_array($selectTeacherData, MYSQLI_ASSOC);
                            $nameUser=$dataT['Nombre']." ".$dataT['Apellido'];
                            $typeUser='Docente';
                            $table="prestamodocente";
                            $KeyU=$dataU1['DUI'];
                        }
                        $checkReserU2=ejecutarSQL::consultar("SELECT * FROM prestamoestudiante WHERE CodigoPrestamo='".$data['CodigoPrestamo']."'");
                        if(mysqli_num_rows($checkReserU2)>=1){
                            $dataU2=mysqli_fetch_array($checkReserU2, MYSQLI_ASSOC);
                            $selectStudentData=ejecutarSQL::consultar("SELECT * FROM estudiante WHERE NIE='".$dataU2['NIE']."'");
                            $dataS=mysqli_fetch_array($selectStudentData, MYSQLI_ASSOC);
                            $nameUser=$dataS['Nombre']." ".$dataS['Apellido'];
                            $typeUser='Estudiante';
                            $table="prestamoestudiante";
                            $KeyU=$dataU2['NIE'];
                        }
                        $checkReserU3=ejecutarSQL::consultar("SELECT * FROM prestamopersonal WHERE CodigoPrestamo='".$data['CodigoPrestamo']."'");
                        if(mysqli_num_rows($checkReserU3)>=1){
                            $dataU3=mysqli_fetch_array($checkReserU3, MYSQLI_ASSOC);
                            $selectPersonalData=ejecutarSQL::consultar("SELECT * FROM personal WHERE DUI='".$dataU3['DUI']."'");
                            $dataP=mysqli_fetch_array($selectPersonalData, MYSQLI_ASSOC);
                            $nameUser=$dataP['Nombre']." ".$dataP['Apellido'];
                            $typeUser='Personal';
                            $table="prestamopersonal";
                            $KeyU=$dataU3['DUI'];
                        }
                        $selecBook=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$data['CodigoLibro']."'");
                        $file=mysqli_fetch_array($selecBook, MYSQLI_ASSOC);
            ?>
                <tr>
                    <td><?php echo $y; ?></td>
                    <td><?php echo $file['CodigoLibroManual']; ?></td>
                    <td><?php echo $file['Titulo']; ?></td>
                    <td><?php echo $KeyU; ?></td>
                    <td><?php echo $nameUser; ?></td>
                    <td><?php echo $typeUser; ?></td>
                    <td><?php echo $data['FechaSalida']; ?></td>
                    <td><?php echo $data['FechaEntrega']; ?></td>
                    <td>
                        <button class="btn btn-success btn-reservation" data-user="<?php echo $typeUser; ?>" data-code-loan="<?php echo $data['CodigoPrestamo']; ?>"><i class="zmdi zmdi-timer"></i></button>
                    </td>
                    <td>
                        <form action="../process/DeleteReservation.php" method="post" class="form_SRCB" data-type-form="deleteReservation" style="width: 8%;">
                            <input type="hidden" value="<?php echo $data['CodigoPrestamo']; ?>" name="loanCode">
                            <input type="hidden" value="<?php echo $table; ?>" name="userTable">
                            <input type="hidden" value="adminreservation.php" name="urlRefresh">
                            <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i></button>
                        </form>
                    </td>
                </tr>
            <?php
                        mysqli_free_result($checkReserU1);
                        mysqli_free_result($checkReserU2);
                        mysqli_free_result($checkReserU3);
                        mysqli_free_result($selectTeacherData);
                        mysqli_free_result($selectStudentData);
                        mysqli_free_result($selecBook);
                        mysqli_free_result($selectPersonalData);
                    }
            ?>
            </tbody></table></div>
            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                    <?php if($pagina == 1): ?>
                        <li class="disabled">
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="adminreservation.php?pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    
                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="adminreservation.php?pagina='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="adminreservation.php?pagina='.$i.'">'.$i.'</a></li>';
                            }
                        }
                    ?>
                    
                    
                    <?php if($pagina == $numeropaginas): ?>
                        <li class="disabled">
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="adminreservation.php?pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php
                }else{
                    echo '<br><br><br><p class="lead text-center all-tittles">No hay reservaciones pendientes</p><br><br><br><br><br><br>';
                }
                mysqli_free_result($checkingRservations);
            ?>
        </div>
        <div class="msjFormSend"></div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modalR">
            <div class="modal-dialog" role="document">
                <form class="modal-content form_SRCB" action="../process/UpdateReservation.php" method="post" data-type-form="approveReservation" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title all-tittles text-center">selecciona el código correlativo</h4>
                    </div>
                    <div class="modal-body" id="modalDataLoan"></div>
                    <input type="hidden" name="AdminCode" value="<?php echo $_SESSION['primaryKey']; ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="zmdi zmdi-timer"></i>&nbsp; Aprobar reservación</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include '../help/help-adminreservation.php'; ?>
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