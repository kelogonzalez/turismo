<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$codeBook=consultasSQL::CleanStringText($_POST['code']);
$SdataB=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibro='$codeBook'");
$dBook=mysqli_fetch_array($SdataB, MYSQLI_ASSOC);
if(mysqli_num_rows($SdataB)>=1){
    echo '<input value="'.$dBook["CodigoLibro"].'" type="hidden" name="primaryKey">
    <legend><strong>Información básica</strong></legend><br>
    <div class="group-material">
        <input type="text" value="'.$dBook['CodigoLibroManual'].'" class="tooltips-general material-control" placeholder="Escribe aquí el código del libro" name="bookCodeManual" pattern="[a-zA-Z0-9-]{1,100}" maxlength="100" data-toggle="tooltip" data-placement="top" title="Solamente números, letras y guiones">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Código de la empresa</label>
    </div>
    <div class="group-material">
        <span>Actividad</span>
        <select class="tooltips-general material-control" name="bookCategory" data-toggle="tooltip" data-placement="top" title="Elige la categoría del libro">';
            $nameCateg=ejecutarSQL::consultar("SELECT * FROM categoria WHERE CodigoCategoria='".$dBook['CodigoCategoria']."'");
            $nC=mysqli_fetch_array($nameCateg, MYSQLI_ASSOC);
            echo '<option value="'.$nC['CodigoCategoria'].'">'.$nC['Nombre'].'</option>';
            $checkCategory=ejecutarSQL::consultar("SELECT * FROM categoria WHERE CodigoCategoria <> '".$dBook['CodigoCategoria']."'");
            while($row=mysqli_fetch_array($checkCategory, MYSQLI_ASSOC)){
                echo '<option value="'.$row['CodigoCategoria'].'">'.$row['Nombre'].'</option>';
            }
            mysqli_free_result($checkCategory);
            mysqli_free_result($nameCateg);
    echo '</select>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Titulo'].'" class="tooltips-general material-control" name="bookName" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre de la empresa">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Nombre de la empresa</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Autor'].'" class="tooltips-general material-control" name="bookAutor" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre de la calle principal">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Calle Principal</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Pais'].'" class="tooltips-general material-control" required="" name="bookCountry" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe la parroquia de la empresa">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Parroquia</label>
    </div>
    <legend><strong>Otros datos</strong></legend><br>
    <div class="group-material">
        <span>Clasificación MITUR</span>
        <select class="tooltips-general material-control" name="bookProvider" data-toggle="tooltip" data-placement="top" title="Elige la clasificación">';
            $nameProv=ejecutarSQL::consultar("SELECT * FROM proveedor WHERE CodigoProveedor='".$dBook['CodigoProveedor']."'");
            $nP=mysqli_fetch_array($nameProv, MYSQLI_ASSOC);
            echo '<option value="'.$nP['CodigoProveedor'].'">'.$nP['Nombre'].'</option>';
            $checkProvider=ejecutarSQL::consultar("SELECT * FROM proveedor WHERE CodigoProveedor <> '".$dBook['CodigoProveedor']."'");
            while($row=mysqli_fetch_array($checkProvider, MYSQLI_ASSOC)){
                echo '<option value="'.$row['CodigoProveedor'].'">'.$row['Nombre'].'</option>';
            }
            mysqli_free_result($checkProvider);
            mysqli_free_result($nameProv);
        echo '</select>
    </div>
    <div class="group-material">
       <input type="text" value="'.$dBook['Year'].'" class="material-control tooltips-general" name="bookYear" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Solamente números, sin espacios">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>E-mail</label>
    </div>

    <div class="group-material">
        <input type="text" value="'.$dBook['Edicion'].'" class="material-control tooltips-general" name="bookEdition" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Bario o Ciudadela">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Barrio/Ciudadela</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['referencia'].'" class="material-control tooltips-general" name="bookReferencia" required=" maxlength="100" data-toggle="tooltip" data-placement="top" title="Escribe una referencia de ubicación">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Referencia</label>
    </div>
    <legend><strong>Ubicación y resumen</strong></legend><br>
    <div class="group-material">
       <input type="text" value="'.$dBook['Ubicacion'].'" class="material-control tooltips-general" name="bookLocation" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="¿Cúales son sus horarios?">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Horario de atención</label>
    </div>

    <div class="group-material">
        <input type="text" value="'.$dBook['Cargo'].'" class="material-control tooltips-general" name="bookOffice" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Sitio WEb">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Sitio Web</label>
    </div>

    <div class="group-material">
        <input type="text" value="'.$dBook['Estimado'].'" class="material-control tooltips-general" name="bookEstimated" required="" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Teléfono</label>
    </div>
    <div class="group-material">
        <span>Resumen del libro</span>
        <textarea class="material-control" name="bookDescription" rows="7" placeholder="Escribe aquí el resumen del libro">'.$dBook['Descripcion'].'</textarea>
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
    <input type="hidden" value="'.$dBook['Imagen'].'" name="OLDbookPicture">
    <input type="hidden" value="'.$dBook['PDF'].'" name="OLDbookPDF">
    ';
    switch ($dBook['Download']) {
        case 'yes':
            echo '<div class="form-group">
                <span class="lead">¿El archivo PDF será visible para los usuarios?</span><br>
                <label for="download1">
                    <input type="radio" name="bookDownload" id="download1" checked="" value="yes"> Si
                </label>
                <br>
                <label for="download2">
                    <input type="radio" name="bookDownload" id="download2" value="no"> No
                </label>
            </div>';
            break;
        case 'no':
            echo '<div class="form-group">
                <span class="lead">¿El archivo PDF será visible para los usuarios?</span><br>
                <label for="download1">
                    <input type="radio" name="bookDownload" id="download1" value="yes"> Si
                </label>
                <br>
                <label for="download2">
                    <input type="radio" name="bookDownload" id="download2" checked="" value="no"> No
                </label>
            </div>';
            break;
        default:
            echo '<div class="form-group">
                <span class="lead">¿El archivo PDF será visible para los usuarios?</span><br>
                <label for="download1">
                    <input type="radio" name="bookDownload" id="download1" value="yes"> Si
                </label>
                <br>
                <label for="download2">
                    <input type="radio" name="bookDownload" id="download2" value="no"> No
                </label>
            </div>';
            break;
    }
}else{
    echo '<div class="alert alert-danger text-center" role="alert"><strong><i class="zmdi zmdi-alert-triangle"></i> &nbsp; ¡Error!:</strong> Lo sentimos ha ocurrido un error.</div>';
}
mysqli_free_result($SdataB);
