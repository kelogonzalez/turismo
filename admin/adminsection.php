<!DOCTYPE html>
<html lang="es">
<head>
    <title>Tipo de Turismo</title>
    <?php
        session_start();
        $LinksRoute="../";
        include '../inc/links.php';
    ?>
    <script src="../js/SendForm.js"></script>
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
              <h1 class="all-tittles">Sistema Turístico <small>Administración Institución</small></h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified"  style="font-size: 17px;">
              <li role="presentation"><a href="admininstitution.php">Institución</a></li>
              <li role="presentation"><a href="adminprovider.php">Departamentos</a></li>
              <li role="presentation"><a href="admincategory.php">Actividades</a></li>
              <li role="presentation"  class="active"><a href="adminsection.php">Tipo de Turismo</a></li>
            </ul>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/section.png" alt="user" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para registrar nuevos tipos de turismo al sistema, debes de seleccionar los datos en el siguiente formulario para registrar una sección
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 lead">
                    <ol class="breadcrumb">
                      <li class="active">Nuevo tipo de turismo</li>
                      <li><a href="adminlistsection.php">Listado de tipos de turismo</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="container-flat-form">
                <div class="title-flat-form title-flat-blue">Agregar un nuevo tipo de turismo</div>
                <form action="../process/AddSection.php" method="post" class="form_SRCB" data-type-form="save" autocomplete="off">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la clasificación" name="sectionGrade" required="" maxlength="13" pattern="[0-9]{1,13}" data-toggle="tooltip" data-placement="top" title="Solo números del 1 al 9">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Clasificación MINTUR</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la categoría" name="sectionSpecialty" required="" maxlength="31" pattern="[a-zA-ZáéíóúÁÉÍÓÚ() ]{5,31}" data-toggle="tooltip" data-placement="top" title="Por ejemplo: Informática, Enfermería, Hospedaje etc...">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Categoría</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la sección" name="sectionSection" required="" maxlength="1" pattern="[a-zA-ZáéíóúÁÉÍÓÚ]{1,1}" data-toggle="tooltip" data-placement="top" title="Por ejemplo: A, B, C, D etc...">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Sección</label>
                            </div>
                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                            </p>
                       </div>
                   </div>
                </form>
            </div>
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
                    <?php include '../help/help-adminsection.php'; ?>
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
