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
        <label>Código de libro</label>
    </div>
    <div class="group-material">
        <span>Categoría</span>
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
        <input type="text" value="'.$dBook['Titulo'].'" class="tooltips-general material-control" name="bookName" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el título o nombre del libro">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Título</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Autor'].'" class="tooltips-general material-control" name="bookAutor" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del autor del libro">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Autor</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Pais'].'" class="tooltips-general material-control" required="" name="bookCountry" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el país del libro">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>País</label>
    </div>
    <legend><strong>Otros datos</strong></legend><br>
    <div class="group-material">
        <span>Proveedor</span>
        <select class="tooltips-general material-control" name="bookProvider" data-toggle="tooltip" data-placement="top" title="Elige el proveedor del libro">';
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
       <input type="text" value="'.$dBook['Year'].'" class="material-control tooltips-general" name="bookYear" required="" pattern="[0-9]{1,4}" maxlength="4" data-toggle="tooltip" data-placement="top" title="Solamente números, sin espacios">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Año</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Editorial'].'" class="material-control tooltips-general" name="bookEditorial" required="" maxlength="70" data-toggle="tooltip" data-placement="top" title="Editorial del libro">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Editorial</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Edicion'].'" class="material-control tooltips-general" name="bookEdition" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Edición del libro">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Edición</label>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Existencias'].'" class="material-control tooltips-general" name="bookCopies" required=" "pattern="[0-9]{1,7}" maxlength="7" data-toggle="tooltip" data-placement="top" title="¿Cuántos libros registraras?">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Ejemplares</label>
    </div>
    <legend><strong>Ubicación, valor y resumen</strong></legend><br>
    <div class="group-material">
       <input type="text" value="'.$dBook['Ubicacion'].'" class="material-control tooltips-general" name="bookLocation" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="¿Dónde se ubicara el libro?">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Ubicación</label>
    </div>
    <div class="group-material">
        <span>Cargo</span>
        <select class="tooltips-general material-control" name="bookOffice" data-toggle="tooltip" data-placement="top" title="Elige el cargo del libro">';
        switch ($dBook['Cargo']){
            case "Entrega del ministerio":
                echo ' 
                <option value="Entrega del ministerio">Entrega del ministerio</option>
                <option value="Donaciones">Donaciones</option>
                <option value="Compras con fondos propios">Compras con fondos propios</option>
                <option value="Presupuesto escolar">Presupuesto escolar</option>
                <option value="Otros">Otros</option>
                ';
                break;
            case "Donaciones":
                echo ' 
                <option value="Donaciones">Donaciones</option>
                <option value="Entrega del ministerio">Entrega del ministerio</option>
                <option value="Compras con fondos propios">Compras con fondos propios</option>
                <option value="Presupuesto escolar">Presupuesto escolar</option>
                <option value="Otros">Otros</option> 
                ';
                break;
            case "Compras con fondos propios":
                echo ' 
                <option value="Compras con fondos propios">Compras con fondos propios</option>
                <option value="Entrega del ministerio">Entrega del ministerio</option>
                <option value="Donaciones">Donaciones</option>
                <option value="Presupuesto escolar">Presupuesto escolar</option>
                <option value="Otros">Otros</option> 
                ';
                break;
            case "Presupuesto escolar":
                echo ' 
                <option value="Presupuesto escolar">Presupuesto escolar</option>
                <option value="Entrega del ministerio">Entrega del ministerio</option>
                <option value="Donaciones">Donaciones</option>
                <option value="Compras con fondos propios">Compras con fondos propios</option>
                <option value="Otros">Otros</option>
                ';
                break;
            case "Otros":
                echo ' 
                <option value="Otros">Otros</option>
                <option value="Entrega del ministerio">Entrega del ministerio</option>
                <option value="Donaciones">Donaciones</option>
                <option value="Compras con fondos propios">Compras con fondos propios</option>
                <option value="Presupuesto escolar">Presupuesto escolar</option>
                ';
                break;
            default : echo 'Error al recuperar el cargo';
        }
        echo '</select>
    </div>
    <div class="group-material">
        <input type="text" value="'.$dBook['Estimado'].'" class="material-control tooltips-general" name="bookEstimated" required="" pattern="[0-9.]{1,7}" maxlength="7" data-toggle="tooltip" data-placement="top" title="Sólo números y un punto si el valor posee decimales. Ejemplo: 7.79">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Valor estimado</label>
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