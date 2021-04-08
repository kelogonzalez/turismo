<!DOCTYPE html>
<html lang="es">
<head>
    <title>Configuración de cuenta</title>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php'; 
    ?>
    <script src="./js/SendForm.js"></script>
    <script>
        $(document).ready(function(){
            $('.btnPass').on('click', function(){
                $('#ModalUpAccount').modal({
                    show: true,
                    backdrop: "static"
                });
            });
        });
    </script>
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
              <h1 class="all-tittles">Sistema bibliotecario <small>Configuración de cuenta</small></h1>
            </div>
        </div>
         <div class="container-fluid"  style="margin: 40px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="assets/img/settings.png" alt="settings" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido en esta sección podrás configurar tu cuenta de usuario. Puedes actualizar algunos datos relacionados con tu cuenta.
                </div>
            </div>
        </div>
        <div class="container-fluid" style="margin-bottom: 300px;">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="report-content">
                        <p class="text-center"><i class="zmdi zmdi-key zmdi-hc-4x btnPass"></i></p>
                        <h3 class="text-center all-tittles">actualizar contraseña</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ModalUpAccount" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <form class="form_SRCB modal-content" id="FORMSRCB" action="./process/UpdatePass.php"  method="post" data-type-form="save" autocomplete="off">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center all-tittles">actualizar contraseña</h4>
              </div>
                <div class="modal-body">
                    <legend><strong>Contraseña actual</strong></legend><br>
                    <input type="hidden" name="userPrivilege" value="<?php echo $_SESSION['UserPrivilege']; ?>">
                    <input type="hidden" name="userName" value="<?php echo $_SESSION['UserName']; ?>">
                    <input type="hidden" name="userKey" value="<?php echo $_SESSION['primaryKey']; ?>">
                    <div class="group-material">
                        <input type="password" class="material-control" placeholder="Contraseña Actual" name="userPass1" required="" maxlength="200">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Contraseña Actual</label>
                    </div>
                    <legend><strong>Nueva contraseña</strong></legend><br>
                    <div class="group-material">
                        <input type="password" class="material-control" placeholder="Nueva contraseña" name="userPass2" required="" maxlength="200">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Nueva contraseña</label>
                    </div>
                    <div class="group-material">
                        <input type="password" class="material-control" placeholder="Repite la nueva contraseña" name="userPass3" required="" maxlength="200">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>Repite la nueva contraseña</label>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Actualizar</button>
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
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <div class="msjFormSend"></div>
        <?php include './inc/footer.php'; ?>
    </div>
</body>
</html>