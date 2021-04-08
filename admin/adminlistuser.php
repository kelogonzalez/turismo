<!DOCTYPE html>
<html lang="es">
<head>
    <title>Administradores</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php';
    ?>
    <script src="../js/SendForm.js"></script>
    <script src="../js/jPages.js"></script>
    <script>
        $(document).ready(function(){
            $(function(){
              $("div.holder").jPages({
                containerID : "itemContainer",
                perPage: 10
              });
            });
        });
    </script>
</head>
<body>
    <?php
        include '../library/configServer.php';
        include '../library/consulSQL.php';
        include '../process/SecurityAdmin.php';
        include '../inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include '../inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema Turístico <small>Administración Usuarios</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation"  class="active"><a href="adminuser.php">Administradores</a></li>
              <li role="presentation"><a href="adminteacher.php">Personal de Turismo</a></li>
              <li role="presentation"><a href="adminstudent.php">Usuarios</a></li>
            <!--  <li role="presentation"><a href="adminpersonal.php">Personal administrativo</a></li>-->
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/user01.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección donde se encuentra el listado de los administradores, puedes desactivar la cuenta de cualquier administrador o eliminar los datos.
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                        <li><a href="adminuser.php">Nuevo administrador</a></li>
                        <li class="active">listado de administradores</li>
                    </ol>
                </div>
            </div>
        </div>
        <h2 class="text-center all-tittles">cuentas de administradores</h2>
        <ul id="itemContainer" class="container-fluid list-unstyled text-center" >
            <?php
                if($_SESSION['primaryKey']=="I777YA1N5802"){
                    $checkAdmin=ejecutarSQL::consultar("SELECT * FROM administrador");
                }else{
                    $checkAdmin=ejecutarSQL::consultar("SELECT * FROM administrador WHERE CodigoAdmin <> 'I777YA1N5802'");
                }
                if(mysqli_num_rows($checkAdmin)>0){
                    while($fila=mysqli_fetch_array($checkAdmin, MYSQLI_ASSOC)){
            ?>
            <li class="full-reset thumbnail-users">
                <div class="full-reset thumbnail-users-title text-center">
                    <?php echo $fila['Nombre']; ?><br>
                    <small>(<?php echo $fila['NombreUsuario']; ?>)</small>
                </div>
                <div class="full-reset thumbnail-users-data">
                    <figure class="full-reset">
                        <img src="../assets/img/user01.png" alt="Admin" class="img-responsive img-circle">
                    </figure>
                    <p class="text-center"><?php echo $fila['Email']; ?></p>
                    <p class="text-center">
                        <?php if($fila['Estado']=="Activo"): ?>
                        <span class="label label-primary">Cuenta Activa</span>
                        <?php else: ?>
                        <span class="label label-danger">Cuenta Desactivada</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="full-reset thumbnail-users-option">
                    <div class="full-reset users-option-left btn-update tooltips-general" data-toggle="tooltip" data-placement="bottom" title="Actualizar datos" data-code="<?php echo $fila['CodigoAdmin']; ?>" data-url="../process/SelectDataAdmin.php">
                        <i class="zmdi zmdi-refresh"></i>
                    </div>
                    <?php if($fila["CodigoAdmin"]=="I777YA1N5802"): ?>
                    <div class="full-reset users-option-center text-mutted">
                        <button class="users-option-btn"><i class="zmdi zmdi-swap"></i></button>
                    </div>
                    <?php else: ?>
                    <form class="full-reset users-option-center tooltips-general form_SRCB" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" method="POST" data-type-form="updateAccounAdmin" action="../process/ActivateAdmin.php">
                        <input value="<?php echo $fila["CodigoAdmin"]; ?>" type="hidden" name="primaryKey">
                        <input value="<?php echo $fila['Estado']; ?>" type="hidden" name="statusAccount">
                        <button class="users-option-btn"><i class="zmdi zmdi-swap"></i></button>
                    </form>
                    <?php
                    endif;
                    if($fila['Estado']=='Activo'):
                        $checkAdminLoan=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoAdmin='".$fila['CodigoAdmin']."'");
                        if(mysqli_num_rows($checkAdminLoan)>0){
                    ?>
                        <div class="full-reset users-option-right text-mutted">
                            <i class="zmdi zmdi-delete"></i>
                        </div>
                        <?php }else{ ?>
                        <form class="full-reset users-option-right form_SRCB tooltips-general" data-toggle="tooltip" data-placement="bottom" title="Eliminar cuenta" action="../process/DeleteAdmin.php" method="POST" data-type-form="delete">
                            <input value="<?php echo $fila["CodigoAdmin"]; ?>" type="hidden" name="primaryKey">
                            <button class="users-option-btn"><i class="zmdi zmdi-delete"></i></button>
                        </form>
                    <?php
                        }
                    else:
                    ?>
                    <div class="full-reset users-option-right text-mutted">
                        <i class="zmdi zmdi-delete"></i>
                    </div>
                    <?php endif; ?>
                </div>
            </li>
            <?php
                        mysqli_free_result($checkAdminLoan);
                    } //end while
                }else{
                    echo '<br><br><br><h2 class="text-center all-tittles">No hay administradores registrados en el sistema</h2><br><br><br>';
                }
                mysqli_free_result($checkAdmin);
            ?>
        </ul>
        <div class="holder"></div>
        <div class="msjFormSend"></div>
        <div class="modal fade" id="ModalUpdate" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <form class="form_SRCB modal-content" action="../process/UpdateAdmin.php" method="post" data-type-form="update"  autocomplete="off">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">Actualizar datos de administrador</h4>
              </div>
              <div class="modal-body" id="ModalData"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Guardar cambios</button>
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
                    <?php include '../help/help-adminlistuser.php'; ?>
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
