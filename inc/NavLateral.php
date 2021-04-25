<?php
    if($LinksRoute=="../"){ $LinkRouteAdmin=""; }else{ $LinkRouteAdmin="./admin/"; }
?>
<div class="navbar-lateral full-reset">
    <div class="visible-xs font-movile-menu mobile-menu-button"></div>
    <div class="full-reset container-menu-movile custom-scroll-containers">
        <div class="logo full-reset all-tittles">
            <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i>
            sistema de turismo
        </div>
        <div class="full-reset" style="background-color:#806f6b; padding: 10px 0; color:#fff;">
            <figure>
                <img src="<?php echo $LinksRoute; ?>assets/img/iturp.png" alt="Biblioteca" class="img-responsive center-box" style="width:100%;">
            </figure>
          <!--  <p class="text-center" style="padding-top: 15px;">Sistema Turístico</p> -->
        </div>
        <div class="full-reset nav-lateral-list-menu">
            <ul class="list-unstyled">
                <?php
                if($_SESSION['UserPrivilege']=='Student'||$_SESSION['UserPrivilege']=='Teacher'||$_SESSION['UserPrivilege']=='Personal'):
                ?>
                <li><a href="catalog.php"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Catálogo</a></li>
                <li><a href="loansUsers.php"><i class="zmdi zmdi-time-restore zmdi-hc-fw"></i>&nbsp;&nbsp; Pendientes</a></li>
                <li><a href="reservations.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Reservaciones</a></li>
                <li><a href="configAccount.php"><i class="zmdi zmdi-account-box-o zmdi-hc-fw"></i>&nbsp;&nbsp; Configurar cuenta</a></li>
                <?php
                elseif($_SESSION['UserPrivilege']=='Admin'):
                ?>
                <li>
                    <a href="<?php echo $LinksRoute; ?>home.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a>
                </li>
                <li>
                    <div class="dropdown-menu-button">
                        <i class="zmdi zmdi-case zmdi-hc-fw"></i>&nbsp;&nbsp; Administración <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
                    </div>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>admininstitution.php">
                                <i class="zmdi zmdi-balance zmdi-hc-fw"></i>&nbsp;&nbsp; Datos institución
                            </a>
                        </li>


<!--
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminprovider.php">
                                <i class="zmdi zmdi-truck zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo proveedor
                            </a>
                        </li>
-->

                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>admincategory.php">
                                <i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Nueva actividad
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminsection.php">
                                <i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo tipo de turismo
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="dropdown-menu-button">
                        <i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; Registro de usuarios <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
                    </div>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminuser.php">
                                <i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo administrador
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminteacher.php">
                                <i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo personal
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminstudent.php">
                                <i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo usuario
                            </a>
                        </li>

<!--
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminpersonal.php">
                                <i class="zmdi zmdi-male-female zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo personal administrativo
                            </a>
                        </li>


-->

                    </ul>
                </li>
                <li>
                    <div class="dropdown-menu-button">
                        <i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; Empresas y Catálogo Turístico  <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
                    </div>
                    <ul class="list-unstyled">
                        <li>
                            <a class="btn-addBook" href="#" data-process="<?php echo $LinksRoute; ?>process/checkDataAdmin.php" data-href="<?php echo $LinkRouteAdmin; ?>admininventory.php">
                                <i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp; Nueva Empresa
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $LinksRoute; ?>catalog.php">
                                <i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Catálogo
                            </a>
                        </li>
                    </ul>
                </li>


<!--
                <li>
                    <a href="<?php echo $LinksRoute; ?>multipleloans.php">
                        <i class="zmdi zmdi-library zmdi-hc-fw"></i>&nbsp;&nbsp; Préstamos múltiples
                        <?php
                            if(isset($_SESSION['prestmultiple']) && count($_SESSION['prestmultiple'])>=1){
                                $npm=count($_SESSION['prestmultiple']);
                                echo '<span class="label label-danger pull-right label-mhover">'.$npm.'</span>';
                            }
                        ?>
                    </a>
                </li>



                <li>
                    <div class="dropdown-menu-button">
                        <i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; Préstamos y reservaciones <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw"></i>
                    </div>
                    <ul class="list-unstyled">
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminloan.php">
                                <i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp; Todos los préstamos
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminloanpending.php">
                                <i class="zmdi zmdi-time-restore zmdi-hc-fw"></i>&nbsp;&nbsp; Devoluciones pendientes
                                <?php
                                    $checkLoanPending1=ejecutarSQL::consultar("SELECT CodigoPrestamo FROM prestamo WHERE Estado='Prestamo'");
                                    if(mysqli_num_rows($checkLoanPending1)>0){
                                        echo '<span class="label label-danger pull-right label-mhover">'.mysqli_num_rows($checkLoanPending1).'</span>';
                                    }
                                    mysqli_free_result($checkLoanPending1);
                                ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $LinkRouteAdmin; ?>adminreservation.php">
                                <i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Reservaciones
                                <?php
                                    $checkReservation1=ejecutarSQL::consultar("SELECT CodigoPrestamo FROM prestamo WHERE Estado='Reservacion'");
                                    if(mysqli_num_rows($checkReservation1)>0){
                                        echo '<span class="label label-danger pull-right label-mhover">'.mysqli_num_rows($checkReservation1).'</span>';
                                    }
                                    mysqli_free_result($checkReservation1);
                                ?>
                            </a>
                        </li>
                    </ul>
                </li>

-->
<li>
    <a href="<?php echo $LinkRoute; ?>/turismo/localizador/index.html">
        <i class="zmdi zmdi-pin zmdi-hc-fw"></i>&nbsp;&nbsp; Localizador en Mapa
    </a>
</li>

                <li>
                    <a href="<?php echo $LinkRouteAdmin; ?>adminreport.php">
                        <i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>&nbsp;&nbsp; Reportes y estadísticas
                    </a>
                </li>
                <li>
                    <a href="<?php echo $LinkRouteAdmin; ?>adminadvancesettings.php">
                        <i class="zmdi zmdi-wrench zmdi-hc-fw"></i>&nbsp;&nbsp; Configuraciones avanzadas
                    </a>
                </li>
                <figure>
                    <img src="<?php echo $LinksRoute; ?>assets/img/logo.png" alt="Biblioteca" class="img-responsive center-box" style="width:76%;">
                </figure>



                <?php
                endif;
                ?>
            </ul>
        </div>
    </div>
</div>
