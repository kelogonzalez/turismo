<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
              <h1 class="all-tittles">realizar <small>préstamo</small></h1>
            </div>
            <p class="lead">
                Para realizar un préstamo llena los campos correspondientes a el usuario que realizara el préstamo del libro
            </p>
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#loan5" aria-controls="messages" role="tab" data-toggle="tab">Préstamos múltibles</a></li>
                <li role="presentation"><a href="#loan1" aria-controls="home" role="tab" data-toggle="tab">Préstamo Estudiante</a></li>
                <li role="presentation"><a href="#loan2" aria-controls="profile" role="tab" data-toggle="tab">Préstamo Docente</a></li>
                <li role="presentation"><a href="#loan3" aria-controls="messages" role="tab" data-toggle="tab">Préstamo personal ad.</a></li>
                <li role="presentation"><a href="#loan4" aria-controls="messages" role="tab" data-toggle="tab">Préstamo Visitante</a></li>
            </ul>
            <div class="tab-content" style="padding: 50px 0;">

                <?php  
                    if(isset($_POST['bookCodePm'])){
                        include "./process/AddToPm.php";
                    }
                    $currentDateForm=date("d.m.Y");
                ?>
                <div role="tabpanel" class="tab-pane fade in active" id="loan5">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <form action="" method="POST" autocomplete="off"> 
                               <?php
                                    echo '<input type="hidden"  name="bookCodePm" value="'.$codeBook.'">';
                                ?>
                                <div class="group-material">
                                    <span>Cantidad de libros que prestará el usuario (Máximo <?php echo $total; ?>)</span>
                                    <input type="number" class="material-control" value="<?php if(isset($_POST['CantL'])){ echo $_POST['CantL']; }else{ echo 1;} ?>" name="CantL">
                                </div>
                                <div class="group-material">
                                    <span>Fecha de solicitud</span>
                                    <input type="text" readonly class="material-control StarCalendarInput" required="" name="startDatePm" value="<?php if(isset($_POST['startDatePm'])){ echo $_POST['startDatePm']; }else{ echo $currentDateForm; } ?>" placeholder="Fecha de solicitud">
                                </div>
                                <div class="group-material">
                                    <span>Fecha de entrega</span>
                                    <input type="text" readonly class="material-control EndCalendarInput" required="" name="endDatePm" value="<?php if(isset($_POST['endDatePm'])){ echo $_POST['endDatePm']; }else{ echo $currentDateForm; } ?>" placeholder="Primero debes seleccionar la fecha de solicitud">
                                </div>
                                <p class="text-center">
                                    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Agregar a préstamos múltiples</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>


                <div role="tabpanel" class="tab-pane fade" id="loan1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <form action="process/AddLoanStudent.php" method="post" class="form_SRCB" data-type-form="saveLoan" autocomplete="off">
                                <?php
                                    echo '<input type="hidden"  name="bookCode" value="'.$codeBook.'">';
                                    echo '<input type="hidden"  name="adminCode" value="'.$_SESSION['primaryKey'].'">';
                                    echo '<input type="hidden"  name="userType" value="'.$_SESSION['UserPrivilege'].'">';
                                    echo '<input type="hidden"  name="userLoan" value="Student">';
                                ?>
                                <div class="group-material">
                                    <span>Cantidad de libros que prestará el estudiante (Máximo <?php echo $total; ?>)</span>
                                    <input type="number" class="material-control" name="CantL">
                                </div>
                                <div class="search-box">
                                    <i class="zmdi zmdi-search search-box-icon tooltips-general" data-toggle="tooltip" data-placement="top" title="Haz clic aquí para buscar el NIE del estudiante" data-id="formStudents"></i>
                                    <div class="search-box-form" id="formStudents">
                                        <input type="text" class="material-control inputUsersearch" placeholder="Escribe el nombre del estudiante" data-user="Student" data-res="resultStudents">
                                        <div class="search-box-result" id="resultStudents">
                                        </div>
                                    </div>
                                </div>
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general" id="inputStudents" placeholder="Escribe aquí el NIE del alumno" name="userKey" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="NIE de estudiante">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>NIE</label>
                                </div>
                                <div class="group-material">
                                    <span>Fecha de solicitud</span>
                                    <input type="text" readonly class="material-control StarCalendarInput"  data-input="adminStudent" required="" name="startDate" placeholder="Fecha de solicitud">
                                </div>
                                <div class="group-material">
                                    <span>Fecha de entrega</span>
                                    <input type="text" readonly class="material-control EndCalendarInput material-input-disabled" id="inputEnd-adminStudent" required="" name="endDate" placeholder="Primero debes seleccionar la fecha de solicitud">
                                </div>
                                <p class="text-center">
                                    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Realizar préstamo</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>


                <div role="tabpanel" class="tab-pane fade" id="loan2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <form action="process/AddLoanTeacher.php" method="post" class="form_SRCB" data-type-form="saveLoan" autocomplete="off"> 
                                <?php
                                    echo '<input type="hidden"  name="bookCode" value="'.$codeBook.'">';
                                    echo '<input type="hidden"  name="adminCode" value="'.$_SESSION['primaryKey'].'">';
                                    echo '<input type="hidden"  name="userType" value="'.$_SESSION['UserPrivilege'].'">';
                                ?>
                                <div class="group-material">
                                    <span>Cantidad de libros que prestará el docente (Máximo <?php echo $total; ?>)</span>
                                    <input type="number" class="material-control" name="CantL">
                                </div>
                                <div class="search-box">
                                    <i class="zmdi zmdi-search search-box-icon tooltips-general" data-toggle="tooltip" data-placement="top" title="Haz clic aquí para buscar el DUI del docente" data-id="formTeachers"></i>
                                    <div class="search-box-form" id="formTeachers">
                                        <input type="text" class="material-control inputUsersearch" placeholder="Escribe el nombre del docente" data-user="Teacher" data-res="resultTeachers">
                                        <div class="search-box-result" id="resultTeachers">
                                        </div>
                                    </div>
                                </div>
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general" id="inputTeachers" placeholder="Escribe aquí el número de DUI del docente" name="userKey" pattern="[0-9-]{1,10}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Solamente números y guiones, 10 dígitos">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Número de DUI</label>
                                </div>
                                <div class="group-material">
                                    <span>Fecha de solicitud</span>
                                    <input type="text" readonly class="material-control StarCalendarInput" data-input="adminTeacher" required="" name="startDate" placeholder="Fecha de solicitud">
                                </div>
                                <div class="group-material">
                                    <span>Fecha de entrega</span>
                                    <input type="text" readonly class="material-control EndCalendarInput material-input-disabled" id="inputEnd-adminTeacher" required="" name="endDate" placeholder="Primero debes seleccionar la fecha de solicitud">
                                </div>
                                <p class="text-center">
                                    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Realizar préstamo</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <div role="tabpanel" class="tab-pane fade" id="loan3">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <form action="process/AddLoanUsers.php" method="post" class="form_SRCB" data-type-form="saveLoan" autocomplete="off"> 
                                <?php
                                    echo '<input type="hidden"  name="bookCode" value="'.$codeBook.'">';
                                    echo '<input type="hidden"  name="adminCode" value="'.$_SESSION['primaryKey'].'">';
                                    echo '<input type="hidden"  name="userType" value="'.$_SESSION['UserPrivilege'].'">';
                                    echo '<input type="hidden"  name="userLoan" value="Personal">';
                                ?>
                                <div class="search-box">
                                    <i class="zmdi zmdi-search search-box-icon tooltips-general" data-toggle="tooltip" data-placement="top" title="Haz clic aquí para buscar el DUI del personal ad." data-id="formPersonals"></i>
                                    <div class="search-box-form" id="formPersonals">
                                        <input type="text" class="material-control inputUsersearch" placeholder="Escribe el nombre del personal ad." data-user="Personal" data-res="resultPersonals">
                                        <div class="search-box-result" id="resultPersonals">
                                        </div>
                                    </div>
                                </div>
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general" id="inputPersonals" placeholder="Escribe aquí el número de DUI del personal administrativo" name="userKey" pattern="[0-9-]{1,10}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Solamente números y guiones, 10 dígitos">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Número de DUI</label>
                                </div>
                                <div class="group-material">
                                    <span>Fecha de solicitud</span>
                                    <input type="text" readonly class="material-control StarCalendarInput" data-input="adminPersonal" required="" name="startDate" placeholder="Fecha de solicitud">
                                </div>
                                <div class="group-material">
                                    <span>Fecha de entrega</span>
                                    <input type="text" readonly class="material-control EndCalendarInput material-input-disabled" id="inputEnd-adminPersonal" required="" name="endDate" placeholder="Primero debes seleccionar la fecha de solicitud">
                                </div>
                                <p class="text-center">
                                    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Realizar préstamo</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <div role="tabpanel" class="tab-pane fade" id="loan4">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                            <form action="process/AddLoanVisitor.php" method="post" class="form_SRCB" data-type-form="saveLoan" autocomplete="off"> 
                               <?php
                                    echo '<input type="hidden"  name="bookCode" value="'.$codeBook.'">';
                                    echo '<input type="hidden"  name="adminCode" value="'.$_SESSION['primaryKey'].'">';
                                ?>
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el número de DUI del visitante" name="visitorDUI" pattern="[0-9-]{1,10}" required="" maxlength="10" data-toggle="tooltip" data-placement="top" title="Solamente números y guiones, 10 dígitos">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Número de DUI</label>
                                </div>
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el nombre del visitante" name="visitorName" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,50}" required="" maxlength="50" data-toggle="tooltip" data-placement="top" title="Escribe el nombre del visitante, solamente letras">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Nombre</label>
                                </div>
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí la institución de donde visita" name="visitorInstitution" pattern="[a-zA-ZáéíóúÁÉÍÓÚ ]{1,60}" required="" maxlength="60" data-toggle="tooltip" data-placement="top" title="Escribe el nombre de la institución de donde visita">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Institución de donde visita</label>
                                </div>
                                <div class="group-material">
                                    <input type="text" class="material-control tooltips-general" placeholder="Escribe aquí el número de teléfono del visitante" name="visitorPhone" pattern="[0-9+]{5,20}" required="" maxlength="20" data-toggle="tooltip" data-placement="top" title="Solamente números y simbolo +">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Teléfono</label>
                                </div>
                                <div class="group-material">
                                    <span>Fecha de solicitud</span>
                                    <input type="text" readonly class="material-control StarCalendarInput" data-input="adminVisitor" required="" name="startDate" placeholder="Fecha de solicitud">
                                </div>
                                <div class="group-material">
                                    <span>Fecha de entrega</span>
                                    <input type="text" readonly class="material-control EndCalendarInput material-input-disabled" id="inputEnd-adminVisitor" required="" name="endDate" placeholder="Primero debes seleccionar la fecha de solicitud">
                                </div>
                                <p class="text-center">
                                    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Realizar préstamo</button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>