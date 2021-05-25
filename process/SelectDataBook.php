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
        <input type="text" value="'.$dBook['idioma'].'" class="material-control tooltips-general" name="bookIdioma" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Idioma">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Idioma que hablan</label>
    </div>

    <legend><strong>Personal que labora</strong></legend><br>
    <div class="group-material">
       <input type="text" value="'.$dBook['hombres'].'" class="material-control tooltips-general" name="bookHombres" maxlength="50" data-toggle="tooltip" data-placement="top" title="Hombres">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Hombres</label>
    </div>
    <div class="group-material">
       <input type="text" value="'.$dBook['mujeres'].'" class="material-control tooltips-general" name="bookMujeres" maxlength="50" data-toggle="tooltip" data-placement="top" title="Mujeres">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Mujeres</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['discapacidad'].'" class="material-control tooltips-general" name="bookDiscapacidad" maxlength="50" data-toggle="tooltip" data-placement="top" title="Discapacidad">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Con Discapacidad</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['genero'].'" class="material-control tooltips-general" name="bookGenero" maxlength="50" data-toggle="tooltip" data-placement="top" title="Genero">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>E. Genero</label>
    </div>

    <legend><strong>Especificaciones</strong></legend><br>
    <div class="group-material">
       <input type="text" value="'.$dBook['reservas'].'" class="material-control tooltips-general" name="bookReservas" maxlength="2" data-toggle="tooltip" data-placement="top" title="Reservas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Reservas</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['simples'].'" class="material-control tooltips-general" name="bookSimples" maxlength="100" data-toggle="tooltip" data-placement="top" title="Simples">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Habitaciones Simples</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['dobles'].'" class="material-control tooltips-general" name="bookDobles" maxlength="100" data-toggle="tooltip" data-placement="top" title="Dobles">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Habitaciones Dobles</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['triples'].'" class="material-control tooltips-general" name="bookTriples" maxlength="100" data-toggle="tooltip" data-placement="top" title="Triples">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Habitaciones Triples</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['matrimonio'].'" class="material-control tooltips-general" name="bookMatrimonio" maxlength="100" data-toggle="tooltip" data-placement="top" title="Matrimonio">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Habitaciones Matrimoniales</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['familia'].'" class="material-control tooltips-general" name="bookFamilia" maxlength="100" data-toggle="tooltip" data-placement="top" title="Familia">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Habitaciones Familiares</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['camas'].'" class="material-control tooltips-general" name="bookCamas" maxlength="100" data-toggle="tooltip" data-placement="top" title="Camas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Camas</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['plazas'].'" class="material-control tooltips-general" name="bookPlazas" maxlength="100" data-toggle="tooltip" data-placement="top" title="Plazas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Plazas</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['mesas'].'" class="material-control tooltips-general" name="bookMesas" maxlength="100" data-toggle="tooltip" data-placement="top" title="Mesas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Mesas</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['banoshombres'].'" class="material-control tooltips-general" name="bookBanosHombres" maxlength="100" data-toggle="tooltip" data-placement="top" title="Baños Hombres">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Baños Hombres</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['banosmujeres'].'" class="material-control tooltips-general" name="bookBanosMujeres" maxlength="100" data-toggle="tooltip" data-placement="top" title="Baños Mujeres">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Baños Mujeres</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['escape'].'" class="material-control tooltips-general" name="bookEscape" maxlength="2" data-toggle="tooltip" data-placement="top" title="Escape">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Salidas de Escape</label>
    </div>


    <div class="group-material">
       <input type="text" value="'.$dBook['pagos'].'" class="material-control tooltips-general" name="bookPagos" maxlength="100" data-toggle="tooltip" data-placement="top" title="Pagos">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Formas de Pago</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['parqueaderos'].'" class="material-control tooltips-general" name="bookParqueaderos" maxlength="2" data-toggle="tooltip" data-placement="top" title="Parqueaderos">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Parqueaderos</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['seguridad'].'" class="material-control tooltips-general" name="bookSeguridad" maxlength="100" data-toggle="tooltip" data-placement="top" title="Seguridad">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Seguridad</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['mascotas'].'" class="material-control tooltips-general" name="bookMascotas" maxlength="2" data-toggle="tooltip" data-placement="top" title="Mascotas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Mascotas</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['limpieza'].'" class="material-control tooltips-general" name="bookLimpieza" maxlength="2" data-toggle="tooltip" data-placement="top" title="Limpieza">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Limpieza</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['folleteria'].'" class="material-control tooltips-general" name="bookFolleteria" maxlength="2" data-toggle="tooltip" data-placement="top" title="Folleteria">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Folleteria</label>
    </div>


    <div class="group-material">
       <input type="text" value="'.$dBook['promocion'].'" class="material-control tooltips-general" name="bookPromocion" maxlength="100" data-toggle="tooltip" data-placement="top" title="Promoción">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Promoción</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['capacitacion'].'" class="material-control tooltips-general" name="bookCapacitacion" maxlength="2" data-toggle="tooltip" data-placement="top" title="Capacitacion">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Capacitación</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['capacidad'].'" class="material-control tooltips-general" name="bookCapacidad" maxlength="100" data-toggle="tooltip" data-placement="top" title="Capacidad">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Capacidad</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['senaletica'].'" class="material-control tooltips-general" name="bookSenaletica" maxlength="2" data-toggle="tooltip" data-placement="top" title="Señaletica">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Señaletica</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['wifi'].'" class="material-control tooltips-general" name="bookWifi" maxlength="2" data-toggle="tooltip" data-placement="top" title="Wifi">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Wifi</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['operadores'].'" class="material-control tooltips-general" name="bookOperadores" maxlength="2" data-toggle="tooltip" data-placement="top" title="Operadores">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Operadores</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['turnos'].'" class="material-control tooltips-general" name="bookTurnos" maxlength="100" data-toggle="tooltip" data-placement="top" title="Turnos">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Turnos</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['bicicletas'].'" class="material-control tooltips-general" name="bookBicicletas" maxlength="2" data-toggle="tooltip" data-placement="top" title="PortaBicicletas">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>PortaBicicletas</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['maleteros'].'" class="material-control tooltips-general" name="bookMaleteros" maxlength="2" data-toggle="tooltip" data-placement="top" title="Maleteros">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Maleteros</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['chalecos'].'" class="material-control tooltips-general" name="bookChalecos" maxlength="2" data-toggle="tooltip" data-placement="top" title="Chalecos">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Chalecos</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['compania'].'" class="material-control tooltips-general" name="bookCompania" maxlength="100" data-toggle="tooltip" data-placement="top" title="Compañia">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Compañia</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['licencias'].'" class="material-control tooltips-general" name="bookLicencias" maxlength="1" data-toggle="tooltip" data-placement="top" title="Licencias">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Licencia</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['boton'].'" class="material-control tooltips-general" name="bookBoton" maxlength="2" data-toggle="tooltip" data-placement="top" title="Boton">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Botón</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['cinturones'].'" class="material-control tooltips-general" name="bookCinturones" maxlength="2" data-toggle="tooltip" data-placement="top" title="Cinturones">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Cinturones</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['vehiculos'].'" class="material-control tooltips-general" name="bookVehiculos" maxlength="100" data-toggle="tooltip" data-placement="top" title="Vehiculos">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Vehiculos</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['pasajeros'].'" class="material-control tooltips-general" name="bookPasajeros" maxlength="100" data-toggle="tooltip" data-placement="top" title="Pasajeros">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Pasajeros</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['socios'].'" class="material-control tooltips-general" name="bookSocios" maxlength="100" data-toggle="tooltip" data-placement="top" title="Socios">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Socios</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['choferes'].'" class="material-control tooltips-general" name="bookChoferes" maxlength="100" data-toggle="tooltip" data-placement="top" title="Choferes">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Choferes</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['asientos'].'" class="material-control tooltips-general" name="bookAsientos" maxlength="100" data-toggle="tooltip" data-placement="top" title="Asientos">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Asientos</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['tv'].'" class="material-control tooltips-general" name="bookTV" maxlength="2" data-toggle="tooltip" data-placement="top" title="TV">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>TV</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['ac'].'" class="material-control tooltips-general" name="bookAC" maxlength="2" data-toggle="tooltip" data-placement="top" title="Aire Acondicionado">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Aire Acondicionado</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['microfono'].'" class="material-control tooltips-general" name="bookMicrofono" maxlength="2" data-toggle="tooltip" data-placement="top" title="Microfono">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Microfono</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['estado'].'" class="material-control tooltips-general" name="bookEstado" maxlength="100" data-toggle="tooltip" data-placement="top" title="Estado">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Estado</label>
    </div>

    <div class="group-material">
       <input type="text" value="'.$dBook['sector'].'" class="material-control tooltips-general" name="bookSector" maxlength="100" data-toggle="tooltip" data-placement="top" title="Sector">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>Sector</label>
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
