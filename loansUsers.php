<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pendientes</title>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php'; 
    ?>
    <script src="js/SendForm.js"></script>
</head>
<body>
    <?php 
        include './library/configServer.php';
        include './library/consulSQL.php';
        include './process/SecurityUser.php';
        include './inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php 
            include './inc/NavUserInfo.php'; 
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema bibliotecario <small>Pendientes</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <p class="lead">
                        Bienvenido a la sección de préstamos pendientes, puedes ver los préstamos que no has entregado aun.
                </div>
                <div class="col-xs-12" style="margin: 100px 0 300px 0;">
                    
                    

                    <div class="div-table">
                        <div class="div-table-row div-table-head">
                            <div class="div-table-cell">Código</div>
                            <div class="div-table-cell">Nombre de libro</div>
                            <div class="div-table-cell">Libros prestados</div>
                            <div class="div-table-cell">Fecha Solicitud</div>
                            <div class="div-table-cell">Fecha Entrega</div>
                            <div class="div-table-cell">Estado</div>
                        </div>
                        <?php
                            $key=$_SESSION['primaryKey'];
                            if($_SESSION['UserPrivilege']=='Student'){
                                $table="prestamoestudiante";
                                $primaryKey="NIE";
                            }
                            if($_SESSION['UserPrivilege']=='Teacher'){
                                $table="prestamodocente";
                                $primaryKey="DUI";
                            }
                            if($_SESSION['UserPrivilege']=='Personal'){
                                $table="prestamopersonal";
                                $primaryKey="DUI";
                            }
                            $checkResSt=ejecutarSQL::consultar("SELECT * FROM ".$table." WHERE ".$primaryKey."='".$key."'");
                            if(mysqli_num_rows($checkResSt)>0){
                                while ($conySt=mysqli_fetch_array($checkResSt, MYSQLI_ASSOC)){
                                    $checkResStP=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoPrestamo='".$conySt['CodigoPrestamo']."' AND Estado='Prestamo'");
                                    while($conySt2=mysqli_fetch_array($checkResStP, MYSQLI_ASSOC)){
                                        $dataBooks=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='".$conySt2['CodigoLibro']."'");
                                        $contB=mysqli_fetch_array($dataBooks, MYSQLI_ASSOC);
                                        echo ' 
                                        <div class="div-table-row">
                                            <div class="div-table-cell">'.$contB['CodigoLibroManual'].'</div>
                                            <div class="div-table-cell">'.$contB['Titulo'].'</div>
                                            <div class="div-table-cell">'.$conySt['Cantidad'].'</div>
                                            <div class="div-table-cell">'.$conySt2['FechaSalida'].'</div>
                                            <div class="div-table-cell">'.$conySt2['FechaEntrega'].'</div>
                                            <div class="div-table-cell">'.$conySt2['Estado'].'</div>    
                                        </div>
                                        ';
                                        mysqli_free_result($dataBooks);
                                    }
                                    mysqli_free_result($checkResStP); 
                                }
                            }else{
                                echo ' 
                                <div class="div-table-row text-center">
                                    No hay prestamos pendientes
                                </div>
                                ';
                            }
                            mysqli_free_result($checkResSt);
                        ?>
                    </div>
                </div>
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
                    <?php include './help/help-reservations.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <?php include './inc/footer.php'; ?>
    </div>  
</body>
</html>