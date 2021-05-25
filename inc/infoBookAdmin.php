<p class="lead">
    Puedes actualizar los datos de la empresa o eliminarlos
</p>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th colspan="2" class="text-center lead success"><strong>Datos de la empresa</strong></th>
            </tr>
        </thead>
        <tbody>
            <tr><td><strong>Código de la empresa</strong></td><td><?php if($fila['CodigoLibroManual']!=""){ echo $fila['CodigoLibroManual']; }else{ echo "Código de libro no definido"; } ?></td></tr>
            <tr>
                <td><strong>Actividad</strong></td>
                <td>
                    <?php
                        $nameCateg=ejecutarSQL::consultar("SELECT * FROM categoria WHERE CodigoCategoria='".$fila['CodigoCategoria']."'");
                        $nC=mysqli_fetch_array($nameCateg, MYSQLI_ASSOC);
                        echo $nC['Nombre'];
                        mysqli_free_result($nameCateg);
                    ?>
                </td>
            </tr>
            <tr><td><strong>Nombre de la empresa</strong></td><td><?php echo $fila['Titulo']; ?></td></tr>
            <tr><td><strong>Calle Principal</strong></td><td><?php echo $fila['Autor']; ?></td></tr>
            <tr><td><strong>Parroquia</strong></td><td><?php echo $fila['Pais']; ?></td></tr>
            <tr>
                <td><strong>Clasificación MITUR</strong></td>
                <td>
                    <?php
                        $nameProv=ejecutarSQL::consultar("SELECT * FROM proveedor WHERE CodigoProveedor='".$fila['CodigoProveedor']."'");
                        $nP=mysqli_fetch_array($nameProv, MYSQLI_ASSOC);
                        echo $nP['Nombre'];
                        mysqli_free_result($nameProv);
                    ?>
                </td>
            </tr>
            <tr><td><strong>E-mail</strong></td><td><?php echo $fila['Year']; ?></td></tr>
            <!--<tr><td><strong>Editorial</strong></td><td><?php echo $fila['Editorial']; ?></td></tr>-->
            <tr><td><strong>Barrio/Ciudadela</strong></td><td><?php echo $fila['Edicion']; ?></td></tr>
            <tr><td><strong>Referencia</strong></td><td><?php echo $fila['referencia']; ?></td></tr>
            <!--<tr><td><strong>En préstamo</strong></td><td><?php echo $fila['Prestado']; ?></td></tr>-->
            <tr><td><strong>Horario de atención</strong></td><td><?php echo $fila['Ubicacion']; ?></td></tr>
            <tr><td><strong>Sitio Web</strong></td><td><?php echo $fila['Cargo']; ?></td></tr>
            <tr><td><strong>Teléfono</strong></td><td><?php echo $fila['Estimado']; ?></td></tr>
            <tr><td><strong>Idioma que hablan</strong></td><td><?php echo $fila['idioma']; ?></td></tr>

            <tr>
                <th colspan="2" class="text-center lead success"><strong>Personal que labora</strong></th>
            </tr>
            <tr><td><strong>Hombres</strong></td><td><?php echo $fila['hombres']; ?></td></tr>
            <tr><td><strong>Mujeres</strong></td><td><?php echo $fila['mujeres']; ?></td></tr>
            <tr><td><strong>Con Discapacidad</strong></td><td><?php echo $fila['discapacidad']; ?></td></tr>
            <tr><td><strong>E. Genero</strong></td><td><?php echo $fila['genero']; ?></td></tr>

            <tr>
                <th colspan="2" class="text-center lead success"><strong>Especificaciones</strong></th>
            </tr>
            <tr><td><strong>Reservas</strong></td><td><?php echo $fila['reservas']; ?></td></tr>
            <tr><td><strong>Habitaciones Simples</strong></td><td><?php echo $fila['simples']; ?></td></tr>
            <tr><td><strong>Habitaciones Dobles</strong></td><td><?php echo $fila['dobles']; ?></td></tr>
            <tr><td><strong>Habitaciones Triples</strong></td><td><?php echo $fila['triples']; ?></td></tr>
            <tr><td><strong>Habitaciones Matrimoniales</strong></td><td><?php echo $fila['matrimonio']; ?></td></tr>
            <tr><td><strong>Habitaciones Familiares</strong></td><td><?php echo $fila['familia']; ?></td></tr>
            <tr><td><strong>Camas</strong></td><td><?php echo $fila['camas']; ?></td></tr>
            <tr><td><strong>Plazas</strong></td><td><?php echo $fila['plazas']; ?></td></tr>
            <tr><td><strong>Mesas</strong></td><td><?php echo $fila['mesas']; ?></td></tr>
            <tr><td><strong>Baños de hombres</strong></td><td><?php echo $fila['banoshombres']; ?></td></tr>
            <tr><td><strong>Baños de mujeres</strong></td><td><?php echo $fila['banosmujeres']; ?></td></tr>
            <tr><td><strong>Salidas de escape</strong></td><td><?php echo $fila['escape']; ?></td></tr>
            <tr><td><strong>Tipos de pago</strong></td><td><?php echo $fila['pagos']; ?></td></tr>
            <tr><td><strong>Parqueadero</strong></td><td><?php echo $fila['parqueaderos']; ?></td></tr>
            <tr><td><strong>Seguridad</strong></td><td><?php echo $fila['seguridad']; ?></td></tr>
            <tr><td><strong>Mascotas</strong></td><td><?php echo $fila['mascotas']; ?></td></tr>
            <tr><td><strong>Limpieza</strong></td><td><?php echo $fila['limpieza']; ?></td></tr>
            <tr><td><strong>Folleteria</strong></td><td><?php echo $fila['folleteria']; ?></td></tr>
            <tr><td><strong>Promoción</strong></td><td><?php echo $fila['promocion']; ?></td></tr>
            <tr><td><strong>Capacitación</strong></td><td><?php echo $fila['capacitacion']; ?></td></tr>
            <tr><td><strong>Capacidad</strong></td><td><?php echo $fila['capacidad']; ?></td></tr>
            <tr><td><strong>Señaletica</strong></td><td><?php echo $fila['senaletica']; ?></td></tr>
            <tr><td><strong>Wifi</strong></td><td><?php echo $fila['wifi']; ?></td></tr>
            <tr><td><strong>Operadores</strong></td><td><?php echo $fila['operadores']; ?></td></tr>
            <tr><td><strong>Turnos</strong></td><td><?php echo $fila['turnos']; ?></td></tr>
            <tr><td><strong>PortaBicicletas</strong></td><td><?php echo $fila['bicicletas']; ?></td></tr>
            <tr><td><strong>Maleteros</strong></td><td><?php echo $fila['maleteros']; ?></td></tr>
            <tr><td><strong>Chalecos</strong></td><td><?php echo $fila['chalecos']; ?></td></tr>
            <tr><td><strong>Compañia</strong></td><td><?php echo $fila['compania']; ?></td></tr>
            <tr><td><strong>Licencias</strong></td><td><?php echo $fila['licencias']; ?></td></tr>
            <tr><td><strong>Boton de ayuda</strong></td><td><?php echo $fila['boton']; ?></td></tr>
            <tr><td><strong>Cinturones de Seguridad</strong></td><td><?php echo $fila['cinturones']; ?></td></tr>
            <tr><td><strong>Vehiculos</strong></td><td><?php echo $fila['vehiculos']; ?></td></tr>
            <tr><td><strong>Pasajeros</strong></td><td><?php echo $fila['pasajeros']; ?></td></tr>
            <tr><td><strong>Socios</strong></td><td><?php echo $fila['socios']; ?></td></tr>
            <tr><td><strong>Choferes</strong></td><td><?php echo $fila['choferes']; ?></td></tr>
            <tr><td><strong>Asientos</strong></td><td><?php echo $fila['asientos']; ?></td></tr>
            <tr><td><strong>TV</strong></td><td><?php echo $fila['tv']; ?></td></tr>
            <tr><td><strong>Aire Acondicionado</strong></td><td><?php echo $fila['ac']; ?></td></tr>
            <tr><td><strong>Microfono</strong></td><td><?php echo $fila['microfono']; ?></td></tr>
            <tr><td><strong>Estado</strong></td><td><?php echo $fila['estado']; ?></td></tr>
            <tr><td><strong>Sector</strong></td><td><?php echo $fila['sector']; ?></td></tr>
            


            <tr><td><strong>PDF visible</strong></td><td><?php if($fila['Download']=="yes"){ echo "Si es visible"; }else{ echo "No es visible"; } ?></td></tr>
        </tbody>
  </table>
</div>
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-green">Observación o Necesidades de la Empresa </div>
        <div class="row">
            <div class="col-xs-12">
                <p class="lead" style="padding: 10px;"><?php if($fila['Descripcion']!=""){ echo $fila['Descripcion']; }else{ echo "Sin resumen"; } ?></p>
            </div>
        </div>
    </div>
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Gestión de la empresa</div>
        <div class="row">
            <div class="col-xs-6">
                <h2 class="text-center all-tittles"><i class="zmdi zmdi-refresh"></i> &nbsp; actualizar datos</h2>
                <p class="text-center">
                    <?php
                        $checkLoanBook=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$fila['CodigoLibro']."' AND Estado='Prestamo'");
                        $checkLoanBook1=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$fila['CodigoLibro']."' AND Estado='Reservacion'");
                        if(mysqli_num_rows($checkLoanBook)<=0 && mysqli_num_rows($checkLoanBook1)<=0){
                            echo '<button class="btn btn-success btn-update" data-code="'.$codeBook.'" data-url="./process/SelectDataBook.php"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Actualizar datos de la Empresa</button>';
                        }else{
                            echo '<button disabled="disabled" class="btn btn-success"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Actualizar datos de la Empresa</button>';
                        }
                        mysqli_free_result($checkLoanBook);
                        mysqli_free_result($checkLoanBook1);
                    ?>
                </p>
            </div>
            <div class="col-xs-6">
                <h2 class="text-center all-tittles"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar datos</h2>
                <?php
                    $checkLoanBook2=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$fila['CodigoLibro']."'");
                        if(mysqli_num_rows($checkLoanBook2)<=0){
                            echo '<form action="process/DeleteBook.php" method="post" class="form_SRCB" data-type-form="delete"><input value="'.$fila["CodigoLibro"].'" type="hidden" name="primaryKey"><p class="text-center"><button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i> &nbsp;&nbsp; Eliminar Empresa</button></p></form>';
                        }else{
                            echo '<p class="text-center"><button disabled="disabled" class="btn btn-danger"><i class="zmdi zmdi-delete"></i> &nbsp;&nbsp; Eliminar Empresa</button></p>';
                        }
                    mysqli_free_result($checkLoanBook2);
                ?>
            </div>
        </div>
    </div>
</div>
