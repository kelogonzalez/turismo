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
            <tr><td><strong>Código de libro</strong></td><td><?php if($fila['CodigoLibroManual']!=""){ echo $fila['CodigoLibroManual']; }else{ echo "Código de libro no definido"; } ?></td></tr>
            <tr>
                <td><strong>Categoría</strong></td>
                <td>
                    <?php
                        $nameCateg=ejecutarSQL::consultar("SELECT * FROM categoria WHERE CodigoCategoria='".$fila['CodigoCategoria']."'");
                        $nC=mysqli_fetch_array($nameCateg, MYSQLI_ASSOC);
                        echo $nC['Nombre'];
                        mysqli_free_result($nameCateg);
                    ?>
                </td>
            </tr>
            <tr><td><strong>Título</strong></td><td><?php echo $fila['Titulo']; ?></td></tr>
            <tr><td><strong>Autor</strong></td><td><?php echo $fila['Autor']; ?></td></tr>
            <tr><td><strong>País</strong></td><td><?php echo $fila['Pais']; ?></td></tr>
            <tr>
                <td><strong>Proveedor</strong></td>
                <td>
                    <?php
                        $nameProv=ejecutarSQL::consultar("SELECT * FROM proveedor WHERE CodigoProveedor='".$fila['CodigoProveedor']."'");
                        $nP=mysqli_fetch_array($nameProv, MYSQLI_ASSOC);
                        echo $nP['Nombre'];
                        mysqli_free_result($nameProv);
                    ?>
                </td>
            </tr>
            <tr><td><strong>Año</strong></td><td><?php echo $fila['Year']; ?></td></tr>
            <tr><td><strong>Editorial</strong></td><td><?php echo $fila['Editorial']; ?></td></tr>
            <tr><td><strong>Edición</strong></td><td><?php echo $fila['Edicion']; ?></td></tr>
            <tr><td><strong>Ejemplares</strong></td><td><?php echo $fila['Existencias']; ?></td></tr>
            <tr><td><strong>En préstamo</strong></td><td><?php echo $fila['Prestado']; ?></td></tr>
            <tr><td><strong>Ubicación</strong></td><td><?php echo $fila['Ubicacion']; ?></td></tr>
            <tr><td><strong>Cargo</strong></td><td><?php echo $fila['Cargo']; ?></td></tr>
            <tr><td><strong>Estimado</strong></td><td><?php echo $fila['Estimado']; ?></td></tr>
            <tr><td><strong>PDF visible para los usuarios</strong></td><td><?php if($fila['Download']=="yes"){ echo "Si es visible"; }else{ echo "No es visible"; } ?></td></tr>
        </tbody>
  </table>
</div>
<div class="container-fluid">
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-green">Resumen del libro</div>
        <div class="row">
            <div class="col-xs-12">
                <p class="lead" style="padding: 10px;"><?php if($fila['Descripcion']!=""){ echo $fila['Descripcion']; }else{ echo "Sin resumen"; } ?></p>
            </div>
        </div>
    </div>
    <div class="container-flat-form">
        <div class="title-flat-form title-flat-blue">Gestión de libro</div>
        <div class="row">
            <div class="col-xs-6">
                <h2 class="text-center all-tittles"><i class="zmdi zmdi-refresh"></i> &nbsp; actualizar datos</h2>
                <p class="text-center">
                    <?php
                        $checkLoanBook=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$fila['CodigoLibro']."' AND Estado='Prestamo'");
                        $checkLoanBook1=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$fila['CodigoLibro']."' AND Estado='Reservacion'");
                        if(mysqli_num_rows($checkLoanBook)<=0 && mysqli_num_rows($checkLoanBook1)<=0){
                            echo '<button class="btn btn-success btn-update" data-code="'.$codeBook.'" data-url="./process/SelectDataBook.php"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Actualizar datos de libro</button>';
                        }else{
                            echo '<button disabled="disabled" class="btn btn-success"><i class="zmdi zmdi-refresh"></i> &nbsp;&nbsp; Actualizar datos de libro</button>';
                        }
                        mysqli_free_result($checkLoanBook);
                        mysqli_free_result($checkLoanBook1);
                    ?>
                </p>
            </div>
            <div class="col-xs-6">
                <h2 class="text-center all-tittles"><i class="zmdi zmdi-delete"></i> &nbsp; eliminar datos</h2>
                <?php
                    $checkLoanBook2=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$fila['CodigoLibro']."'");
                        if(mysqli_num_rows($checkLoanBook2)<=0){
                            echo '<form action="process/DeleteBook.php" method="post" class="form_SRCB" data-type-form="delete"><input value="'.$fila["CodigoLibro"].'" type="hidden" name="primaryKey"><p class="text-center"><button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i> &nbsp;&nbsp; Eliminar Libro</button></p></form>';
                        }else{
                            echo '<p class="text-center"><button disabled="disabled" class="btn btn-danger"><i class="zmdi zmdi-delete"></i> &nbsp;&nbsp; Eliminar Libro</button></p>';
                        }
                    mysqli_free_result($checkLoanBook2);
                ?>
            </div>
        </div>
    </div>
</div>
