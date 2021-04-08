<!DOCTYPE html>
<html lang="es">
<head>
    <title>Prestamos multiples</title>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php'; 
    ?>
    <link rel="stylesheet" href="css/jquery.datetimepicker.css">
    <script src="js/SendForm.js"></script>
    <script src="js/jquery.datetimepicker.js"></script>
</head>
<body>
    <?php 
        include './library/configServer.php';
        include './library/consulSQL.php';
        if (!$_SESSION['UserPrivilege']=='Admin' && $_SESSION['SessionToken']=="") {
            header("Location: process/logout.php");
            exit();
        }
        include './inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php 
            include './inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema bibliotecario <small>Préstamos Múltiples</small></h1>
            </div>
        </div>
        <p class="container lead">
            Bienvenido a la sección de préstamos múltiples, primero elija todos los libros que va a prestar, luego digite el código del usuario y elija el tipo de usuario que es.
        </p>
        <div class="container">
            <div class="page-header">
              <h1><i class="zmdi zmdi-search-for"></i> Buscar libro</h1>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <form action="" method="POST" autocomplete="off">
                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <div class="group-material">
                                    <input type="text" class="material-control" name="bookCodeShopping" placeholder="Codigo del libro" required="">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label>Código del libro</label>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="group-material">
                                    <input type="submit" class="btn btn-primary btn-block" value="Buscar libro">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
            if(isset($_POST['bookCodePm'])){
                include "./process/AddToPm.php";
            }
            $currentDateForm=date("d.m.Y");
        ?>
        <div class="container-fluid">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"><i class="zmdi zmdi-shopping-cart-plus"></i> Agregar libro al carrito</h3>
                </div>
                <div class="panel-body">
                    <?php include "./process/AddBookShoppingKart.php" ?>
                </div>
            </div>

        </div>
        <section class="full-reset">
            <div class="container-fluid">
                <div class="row">
                    <?php  
                        if(isset($_POST['propresmulaction']) && isset($_SESSION['prestmultiple'])){
                            include "./process/processMultipleLoans.php";
                        }

                        if(isset($_POST['delpresmulaction'])){
                            unset($_SESSION['prestmultiple']);
                            echo '<script type="text/javascript">
                                swal({ 
                                    title:"¡Prestamos vaciados!", 
                                    text:"Los prestamos multiples se vaciaron con exito", 
                                    type: "success", 
                                    confirmButtonText: "Aceptar" 
                                });
                            </script>';
                        }
                    ?>
                    <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                        <div class="page-header">
                            <h1><i class="zmdi zmdi-shopping-cart"></i> Libros en el carrito</h1>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cantidad</th>
                                    <th>Fecha Solicitud</th>
                                    <th>Fecha Entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($_SESSION['prestmultiple']) && count($_SESSION['prestmultiple'])>=1){
                                        foreach($_SESSION['prestmultiple'] as $databook){
                                            echo '  
                                                <tr>
                                                    <td>'.$databook['bookcode'].'</td>
                                                    <td>'.$databook['totalbooks'].'</td>
                                                    <td>'.$databook['startdate'].'</td>
                                                    <td>'.$databook['enddate'].'</td>
                                                </tr>
                                            ';
                                        }
                                    }else{
                                        echo '<tr><td colspan="4" class="text-center">No hay libros agregados</td></tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12">
                        <div class="page-header">
                            <h1><i class="zmdi zmdi-shopping-basket"></i> Procesar o eliminar préstamos múltiples</h1>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Procesar préstamos múltiples</h3>
                            </div>
                            <div class="panel-body">
                                <form action="" method="POST" class="text-center" style="padding: 30px 0;">
                                    <input type="hidden" name="propresmulaction" value="1">
                                    <input type="hidden"  name="adminCode" value="<?php echo $_SESSION['primaryKey']; ?>">
                                    <div class="group-material">
                                        <input type="text" class="material-control" id="inputPersonals" placeholder="Codigo del usuario" name="userKey" required="">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Codigo del usuario</label>
                                    </div>
                                    <div class="group-material">
                                        <span>Tipo de usuario</span>
                                        <select name="userType" class="material-control">
                                            <option value="Student">Estudiante</option>
                                            <option value="Teacher">Docente</option>
                                            <option value="Personal">Personal administrativo</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="zmdi zmdi-floppy"></i> &nbsp;&nbsp; Procesar préstamos múltiples</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h3 class="panel-title">Vaciar prestamos multiples</h3>
                            </div>
                            <div class="panel-body">
                                <form action="" method="POST" class="text-center">
                                    <input type="hidden" name="delpresmulaction">
                                    <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i> &nbsp;&nbsp; Vaciar prestamos multiples</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include './inc/footer.php'; ?>
    </div>
    <?php
        $checkYear=ejecutarSQL::consultar("SELECT * FROM institucion");
        $year=mysqli_fetch_array($checkYear, MYSQLI_ASSOC);
    ?>
    <script>
        $(document).ready(function(){
            var Year=<?php echo $year['Year']; ?>;
            $('.StarCalendarInput').on('blur', function(){
                var startCal=$(this).val();
                var datainput=$(this).attr('data-input');
                var idinput="inputEnd-"+datainput;
                if(startCal!==""){
                    $('#'+idinput).removeClass('material-input-disabled').attr('placeholder','Fecha de entrega');
                }
            });
            jQuery('.StarCalendarInput').datetimepicker({
                format:'d.m.Y',
                lang:'es',
                timepicker:false,
                minDate:'0',
                maxDate:Year+'/12/31',
                yearStart:Year,
                yearEnd:Year,
                scrollInput:false
            });
            jQuery('.EndCalendarInput').datetimepicker({
                format:'d.m.Y',
                lang:'es',
                timepicker:false,
                minDate:'0',
                maxDate:Year+'/12/31',
                yearStart:Year,
                yearEnd:Year,
                scrollInput:false
            });
            $('.search-box-icon').on('click', function(){
                var formDiv="#"+$(this).attr('data-id');
                if($(formDiv).css('display')=="none"){
                    $(formDiv).fadeIn();
                }else{
                    $(formDiv).fadeOut();
                }
            });
            $('.inputUsersearch').on('keyup', function(){
                var user=$(this).attr('data-user');
                var divRes="#"+$(this).attr('data-res');
                var Name=$(this).val();
                $.ajax({
                url:"process/SearchDataUsers.php?userType="+user+"&&Name="+Name,
                success:function(data){
                  $(divRes).html(data);
                }
              });
            });
        });
    </script>
    <?php 
        mysqli_free_result($checkYear);
    ?>
</body>
</html>