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
                                <input type="text" class="material-control tooltips-general"  placeholder="Escribe aquí la referencia de la ubicación" name="bookReferencia"  maxlength="90" data-toggle="tooltip" data-placement="top" title="Escribe una referencia clara de la ubicación" >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Referencia</label>
                            </div>


                            <div class="group-material">
                                <input type="hidden" value="1" class="material-control tooltips-general"  placeholder="Escribe aquí la referencia de la ubicación" name="bookCopies"  maxlength="90" data-toggle="tooltip" data-placement="top" title="Escribe una referencia clara de la ubicación" >
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
                               <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el sitio web de la empresa" name="bookOffice"  maxlength="50" data-toggle="tooltip" data-placement="top" title="Sitio Web">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Página Web</label>
                            </div>

<!--
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

-->

                            <div class="group-material">
                                <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el teléfono de la empresa" name="bookEstimated" required="" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>


<!--NUEVOS CAMPOS -->

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí los idiomas que maneja la empresa" name="bookIdioma" maxlength="200" data-toggle="tooltip" data-placement="top" title="Idioma">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Idioma</label>
</div>

  <legend><strong>Personal que labora</strong></legend><br>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantos hombres trabajan en la empresa" name="bookHombres" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Hombres</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas mujeres trabajan en la empresa" name="bookMujeres" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Mujeres</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas personas con discapacidad trabajan en la empresa" name="bookDiscapacidad" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Con Discapacidad</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas personas con E. Genero trabajan en la empresa" name="bookGenero" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>E. Genero</label>
  </div>


  <legend><strong>Especificaciones (Aplicar según corresponda)</strong></legend><br>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookReservas" maxlength="2" data-toggle="tooltip" data-placement="top" title="Reservas">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Reservas</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas habitaciones simples tiene" name="bookSimples" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Habitaciones Simples</label>
  </div>
  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas habitaciones dobles tiene" name="bookDobles" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Habitaciones Dobles</label>
  </div>
  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas habitaciones triples tiene" name="bookTriples" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Habitaciones Triples</label>
  </div>
  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas habitaciones matrimoniales tiene" name="bookMatrimonio" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Habitaciones Matrimoniales</label>
  </div>
  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí cuantas habitaciones familiares tiene" name="bookFamilia" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Habitaciones Familiares</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el total de camas que tiene" name="bookCamas" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Total de camas</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el total de plazas que tiene" name="bookPlazas" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Total de plazas</label>
  </div>
  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el total de mesas que tiene" name="bookMesas" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Total de mesas</label>
  </div>
  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el total de baños para hombres que tiene" name="bookBanosHombres" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Total de baños para hombres</label>
  </div>
  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el total de baños para mujeres que tiene" name="bookBanosMujeres" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Total de baños para mujeres</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookEscape" maxlength="2" data-toggle="tooltip" data-placement="top" title="Salida de Escape">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Salidas de escape</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el tipo de pago" name="bookPagos" maxlength="100" data-toggle="tooltip" data-placement="top" title="Efectivo, tarjeta de credito, canje, etc...">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Tipos de pago</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookParqueaderos" maxlength="2" data-toggle="tooltip" data-placement="top" title="Parqueaderos">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Parqueadero</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe con que tipo de seguridad cuentan" name="bookSeguridad" maxlength="100" data-toggle="tooltip" data-placement="top" title="Guardiania, Cámaras, etc...">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Seguridad</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookMascotas" maxlength="2" data-toggle="tooltip" data-placement="top" title="Mascotas">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Mascotas</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookLimpieza" maxlength="2" data-toggle="tooltip" data-placement="top" title="Limpieza">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Limpieza</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookFolleteria" maxlength="2" data-toggle="tooltip" data-placement="top" title="Folleteria">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Inf/Folleteria</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe otros medios de promoción" name="bookPromocion" maxlength="100" data-toggle="tooltip" data-placement="top" title="Radio, Televisión, Internet, etc...">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Otros medios de promoción</label>
  </div>

  <div class="group-material">
      <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookCapacitacion" maxlength="2" data-toggle="tooltip" data-placement="top" title="Capacitación">
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Capacitación del personal</label>
  </div>

<legend><strong>Vehiculos</strong></legend><br>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la capacidad de carga" name="bookCapacidad" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Capacidad de carga</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookSenaletica" maxlength="2" data-toggle="tooltip" data-placement="top" title="Señaletica">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Señaletica</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookWifi" maxlength="2" data-toggle="tooltip" data-placement="top" title="Accesibilidad / Wifi">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Accesibilidad / Wifi</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookOperadores" maxlength="2" data-toggle="tooltip" data-placement="top" title="Operadores">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Operadores / Agencias / Guias</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí los N° de turnos" name="bookTurnos" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>N° de Turnos</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookBicicletas" maxlength="2" data-toggle="tooltip" data-placement="top" title="Portabicicletas">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Portabicicletas</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookMaleteros" maxlength="2" data-toggle="tooltip" data-placement="top" title="Maleteros">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Maleteros</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookChalecos" maxlength="2" data-toggle="tooltip" data-placement="top" title="Chalecos salvavidas">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Chalecos salvavidas</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe el nombre de la compañia" name="bookCompania" maxlength="100" data-toggle="tooltip" data-placement="top" title="Compañia">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Compañia</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe el tipo de licencia" name="bookLicencias" maxlength="1" data-toggle="tooltip" data-placement="top" title="A, B, C...">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Tipo de licencia</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookBoton" maxlength="2" data-toggle="tooltip" data-placement="top" title="Botón o cámara">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Botón o cámara</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookCinturones" maxlength="2" data-toggle="tooltip" data-placement="top" title="Cinturones de seguridad">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Cinturones de seguridad</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el N° de vehiculos" name="bookVehiculos" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>N° de Vehiculos</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el N° de pasajeros" name="bookPasajeros" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Pasajeros</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el N° de socios" name="bookSocios" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Total de socios</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el N° de choferes" name="bookChoferes" pattern="[0-9]{1,10}" maxlength="10" data-toggle="tooltip" data-placement="top" title="Sólo números">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Choferes</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookAsientos" maxlength="2" data-toggle="tooltip" data-placement="top" title="Asientos Reclinables">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Asientos reclinables</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookTV" maxlength="2" data-toggle="tooltip" data-placement="top" title="Servicio de TV">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Servicio de TV</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookAC" maxlength="2" data-toggle="tooltip" data-placement="top" title="Servicio de A/C">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Servicio de A/C</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe Si o No" name="bookMicrofono" maxlength="2" data-toggle="tooltip" data-placement="top" title="Servicio de microfono">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Servicio de microfono</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe el estado" name="bookEstado" maxlength="100" data-toggle="tooltip" data-placement="top" title="Excelente, Bueno, Muy Bueno, etc...">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Estado</label>
</div>

<div class="group-material">
    <input type="text" class="material-control tooltips-general" placeholder="Escribe el sector turístico" name="bookSector" maxlength="100" data-toggle="tooltip" data-placement="top" title="Sector Turístico">
    <span class="highlight"></span>
    <span class="bar"></span>
    <label>Sector Turístico</label>
</div>

<!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->







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
