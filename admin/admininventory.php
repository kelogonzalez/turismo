<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registrar Empresa</title>
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
              <h1 class="all-tittles">Sistema Turístico <small>Añadir Empresa</small></h1>
            </div>
        </div>
        <div class="container-fluid"  style="margin: 50px 0;">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <img src="../assets/img/flat-book.png" alt="pdf" class="img-responsive center-box" style="max-width: 110px;">
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                    Bienvenido a la sección para agregar nuevas empresas, deberas de llenar todos los campos para poder registrar.
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form action="../process/AddBook.php" method="POST" id="saveData" autocomplete="off" enctype="multipart/form-data">
                <div class="container-flat-form">
                    <div class="title-flat-form title-flat-blue">Nueva empresa</div>
                    <div class="row">
                       <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <legend><strong>Ficha Catastral Turística del cantón Naranjal</strong></legend><br>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí el numero de registro" name="bookCodeManual" pattern="[a-zA-Z0-9-]{1,100}" maxlength="100" data-toggle="tooltip" data-placement="top" title="Solamente números, letras y guiones">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Número de Registro</label>
                            </div>
                            <div class="group-material">
                                <span>Actividad</span>
                                <select class="tooltips-general material-control" name="bookCategory" data-toggle="tooltip" data-placement="top" title="Elige la actividad de la empresa">
                                    <option value="" disabled="" selected="">Selecciona una actividad</option>
                                    <?php
                                        $checkCategory= ejecutarSQL::consultar("SELECT * FROM categoria");
                                        while($fila=mysqli_fetch_array($checkCategory, MYSQLI_ASSOC)){
                                            echo '<option value="'.$fila['CodigoCategoria'].'">'.$fila['Nombre'].'</option>';
                                        }
                                        mysqli_free_result($checkCategory);
                                    ?>
                                </select>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí el nombre de la empresa" name="bookName" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre de la empresa">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre de la Empresa</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí la calle principal " name="bookAutor" required="" maxlength="500" data-toggle="tooltip" data-placement="top" title="Escribe la calle principal de la ubicación de la empresa">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Calle Principal</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí la parroquia" required="" name="bookCountry" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe la parroquia">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Parroquia</label>
                            </div>
                            <legend><strong>Otros datos</strong></legend><br>
                            <div class="group-material">
                                <span>Tipo de Turismo</span>
                                <select class="tooltips-general material-control" name="bookProvider" data-toggle="tooltip" data-placement="top" title="Elige el tipo de turismo">
                                    <option value="" disabled="" selected="">Clasificación MITUR</option>
                                    <?php
                                        $checkProvider= ejecutarSQL::consultar("select * from proveedor");
                                        while($fila=mysqli_fetch_array($checkProvider, MYSQLI_ASSOC)){
                                            echo '<option value="'.$fila['CodigoProveedor'].'">'.$fila['Nombre'].'</option>';
                                        }
                                        mysqli_free_result($checkProvider);
                                    ?>
                                </select>
                            </div>
                           <div class="group-material">
                               <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el correo electrónico de la Empresa" name="bookYear"  maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe la email de la Empresa">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Email</label>
                           </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el recinto/cooperativa de la empresa" name="bookEditorial" maxlength="70" data-toggle="tooltip" data-placement="top" title="Recinto/Cooperativa de la empresa">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Recinto / Cooperativa</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el barrio / ciudadela de la empresa" name="bookEdition" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe aqui el barrio / ciudadela de la empresa">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Barrio / Ciudadela</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"  placeholder="Escribe aquí la referencia de la ubicación" name="bookCopies"  maxlength="90" data-toggle="tooltip" data-placement="top" title="Escribe una referencia clara de la ubicación">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Referencia</label>
                            </div>
                            <!--<legend><strong>Ubicación, valor y resumen</strong></legend><br>-->
                            <div class="group-material">
                               <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el horario de atención" name="bookLocation" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Horarios de atención">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Horario de atención</label>
                            </div>


                    <div class="group-material">

                                <span>Cargo</span>

                                <select class="tooltips-general material-control" name="bookOffice" data-toggle="tooltip" data-placement="top" title="Elige el cargo del libro">
                                    <option value="" disabled="" selected="">Selecciona el cargo del libro</option>
                                    <option value="Entrega del ministerio">Entrega del ministerio</option>
                                    <option value="Donaciones">Donaciones</option>
                                    <option value="Compras con fondos propios">Compras con fondos propios</option>
                                    <option value="Presupuesto escolar">Presupuesto escolar</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>



                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el teléfono de la empresa" name="bookEstimated" required="" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                            <div class="group-material">
                                <span>Observaciones / Necesidades</span>
                                <textarea class="material-control" name="bookDescription" rows="7" placeholder="Escribe aquí las observaciones o necesidades de la empresa"></textarea>
                            </div>
                            <legend><strong>Foto del local y archivo PDF</strong></legend><br>
                            <div class="group-material">
                                <span class="lead"><i class="zmdi zmdi-image"></i> Foto</span>
                                <input type="file" name="bookPicture">
                                <small>Archivos permitidos: jpg, png<br>Tamaño máximo: 5MB</small>
                            </div>
                            <div class="group-material">
                                <span class="lead"><i class="zmdi zmdi-file"></i>Ficha firmada en PDF</span>
                                <input type="file" name="bookPDF">
                                <small>Archivos permitidos: PDF<br>Tamaño máximo: 100MB</small>
                            </div>
                            <div class="form-group">
                                <span class="lead">¿El archivo PDF será visible para los usuarios?</span><br>
                                <label for="download1">
                                    <input type="radio" name="bookDownload" id="download1" value="yes"> Si
                                </label>
                                <br>
                                <label for="download2">
                                    <input type="radio" name="bookDownload" id="download2" value="no"> No
                                </label>
                            </div>
                            <p class="text-center">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Guardar</button>
                            </p>
                       </div>
                   </div>
                </div>
            </form>
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
                    <?php include '../help/help-admininventory.php'; ?>
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
