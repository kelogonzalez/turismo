<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reportes</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php';
    ?>
    <link rel="stylesheet" href="../css/timeline.css">
    <script>
        $(document).ready(function(){
            $('.btn-file').on('click', function(){
                var file; var uTipe; var urlData; var title1; var text1; var text2; var file_type=$(this).attr('data-type');
                if(file_type==="file"){
                    file=$(this).attr('data-file');
                    urlData='../process/checkInstitution.php';
                    title1="¿Quieres generar la ficha?";
                    text1="La ficha se generará en formato PDF y se abrirá en una ventana nueva. Debes esperar un lapso de tiempo de 15 segundos para que el sistema genere la ficha";
                }
                if(file_type==="report"){
                    file=$(this).attr('data-file');
                    title1="¿Quieres generar el reporte?";
                    text1="El reporte se generará en formato PDF y se abrirá en una ventana nueva. Debes esperar unos minutos para que el sistema genere el reporte";
                }
                if(file_type==="reportLP"){
                    uTipe=$(this).attr('data-user');
                    file='../report/ReportLoansPending.php?user='+uTipe;
                    title1="¿Quieres generar el reporte?";
                    text1="El reporte de devoluciones pendientes se generará en formato PDF y se abrirá en una ventana nueva. Debes esperar unos minutos para que el sistema genere el reporte";
                }
                swal({
                    title: title1,
                    text: text1,
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#31B0D5",
                    confirmButtonText: "Si, generar",
                    cancelButtonText: "No, cancelar",
                    animation: "slide-from-top",
                    closeOnConfirm: false
                },function(){
                    window.open(file,"_blank");
                    swal.close();
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
              <h1 class="all-tittles">Sistema Turístico <small>Reportes y estadísticas</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#reports" aria-controls="reports" role="tab" data-toggle="tab">Reportes y fichas</a></li>
                <li role="presentation"><a href="#bitacora" aria-controls="bitacora" role="tab" data-toggle="tab">Bitácora</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="reports">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="../assets/img/pdf.png" alt="pdf" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de reportes, aquí puedes generar reportes de las empresas turísticas del cantón Naranjal.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">



<!--


                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">fichas <small>vacías</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x btn-file" data-file="../report/fichaEN.php" data-type="file"></i>
                                    </p>
                                    <h3 class="text-center">Ficha estudiante</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x btn-file" data-file="../report/fichaDN.php" data-type="file"></i>
                                    </p>
                                    <h3 class="text-center">Ficha docente</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x btn-file" data-file="../report/fichaPN.php" data-type="file"></i>
                                    </p>
                                    <h3 class="text-center">Ficha personal administrativo</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-file-text zmdi-hc-5x btn-file" data-file="../report/fichaVN.php" data-type="file"></i>
                                    </p>
                                    <h3 class="text-center">Ficha visitante</h3>
                                </div>
                            </div>
                        </div>

-->





                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">reportes <small>generales</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x btn-file" data-file="../report/ReportGeneral.php" data-type="report"></i>
                                    </p>
                                    <h3 class="text-center">Reporte General de las Empresas</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x btn-file" data-file="../report/ReportBookCategories.php" data-type="report"></i>
                                    </p>
                                    <h3 class="text-center">Reporte Empresas por Actividades</h3>
                                </div>
                            </div>

<!--
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x btn-file" data-file="../report/ReportAllLoans.php" data-type="report"></i>
                                    </p>
                                    <h3 class="text-center">Préstamos entregados (por usuarios)</h3>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-trending-up zmdi-hc-5x btn-file" data-file="../report/ReportAllLoansBySection.php" data-type="report"></i>
                                    </p>
                                    <h3 class="text-center">Préstamos entregados (por sección)</h3>
                                </div>
                            </div>

                          -->
                        </div>


<!--


                        <div class="row">
                            <div class="page-header">
                                <h2 class="all-tittles">reportes <small>devoluciones pendientes</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x btn-file" data-type="reportLP" data-user="Teacher"></i>
                                    </p>
                                    <h3 class="text-center">Docentes</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x btn-file" data-type="reportLP" data-user="Personal"></i>
                                    </p>
                                    <h3 class="text-center">Personal Administrativo</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x btn-file" data-type="reportLP" data-user="Student"></i>
                                    </p>
                                    <h3 class="text-center">Estudiantes</h3>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                    <p class="text-center">
                                        <i class="zmdi zmdi-calendar-close zmdi-hc-5x btn-file" data-type="reportLP" data-user="Visitor"></i>
                                    </p>
                                    <h3 class="text-center">Visitantes</h3>
                                </div>
                            </div>
                        </div>
-->



                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="bitacora">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="../assets/img/user-sesion.png" alt="users-sesion" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de bitácora, aquí se muestran los registros de los últimos 15 usuarios (Administradores, personal de turismo y usuarios en general) que han iniciado sesión en el sistema. Recuerda eliminar los registros de la bitácora cada año para que el sistema funcione correctamente.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid"><?php include '../inc/bitacora.php'; ?></div>
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
                    <?php include '../help/help-adminreport.php'; ?>
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
