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
                                <input type="text" class="tooltips-general material-control" placeholder="Escribe aquí la dirección " name="bookAutor" required="" maxlength="500" data-toggle="tooltip" data-placement="top" title="Escribe la dirección">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Dirección</label>
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
                                    <option value="" disabled="" selected="">Selecciona el tipo de turismo</option>
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
                               <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el teléfono de la empresa" name="bookYear" required="" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Solamente números, sin espacios">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                           </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la editorial del libro" name="bookEditorial" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Editorial del libro">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Editorial</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la edición del libro" name="bookEdition" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Edición del libro">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Edición</label>
                            </div>
                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general"  placeholder="Escribe aquí la cantidad de libros que registraras" name="bookCopies" required=" "pattern="[0-9]{1,7}" maxlength="7" data-toggle="tooltip" data-placement="top" title="¿Cuántos libros registraras?">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Ejemplares</label>
                            </div>
                            <legend><strong>Ubicación, valor y resumen</strong></legend><br>
                            <div class="group-material">
                               <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la ubicación del libro" name="bookLocation" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="¿Dónde se ubicara el libro?">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Ubicación</label>
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
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el precio estimado del libro" name="bookEstimated" required="" pattern="[0-9.]{1,7}" maxlength="7" data-toggle="tooltip" data-placement="top" title="Sólo números y un punto si el valor posee decimales. Ejemplo: 7.79">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Valor estimado</label>
                            </div>
                            <div class="group-material">
                                <span>Resumen del libro</span>
                                <textarea class="material-control" name="bookDescription" rows="7" placeholder="Escribe aquí el resumen del libro"></textarea>
                            </div>
                            <legend><strong>Imágen y archivo PDF</strong></legend><br>
                            <div class="group-material">
                                <span class="lead"><i class="zmdi zmdi-image"></i> Imágen</span>
                                <input type="file" name="bookPicture">
                                <small>Archivos permitidos: jpg, png<br>Tamaño máximo: 5MB</small>
                            </div>
                            <div class="group-material">
                                <span class="lead"><i class="zmdi zmdi-file"></i> PDF</span>
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
