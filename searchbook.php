<!DOCTYPE html>
<html lang="es">
<head>
    <title>Buscar Empresa</title>
    <?php
        session_start();
        $LinksRoute="./";
        include './inc/links.php';
    ?>
    <script>
        $(document).ready(function(){
           $('.btn-info-book').click(function(){
               window.location ="infobook.php?codeBook="+$(this).attr("data-code-book");
           });
        });
    </script>
</head>
<body>
    <?php
        include './library/configServer.php';
        include './library/consulSQL.php';
        include './process/SecurityUser.php';
        include './inc/NavLateral.php';
    ?>
    <div class="content-page-container full-reset custom-scroll-containers">
        <?php
            include './inc/NavUserInfo.php';
        ?>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema bibliotecario <small>Busqueda de libro</small></h1>
            </div>
        </div>
        <br><br><br>
        <?php
        $BookNameSearch=consultasSQL::CleanStringText($_GET["bookName"]);

        $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
        mysqli_set_charset($mysqli, "utf8");

        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $regpagina = 30;
        $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

        $checkNameBook= mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM libro WHERE Titulo LIKE '%".$BookNameSearch."%' OR CodigoLibroManual LIKE '%".$BookNameSearch."%' OR Autor LIKE '%".$BookNameSearch."%' ORDER BY Titulo ASC LIMIT $inicio, $regpagina");

        $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
        $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

        $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

        if(mysqli_num_rows($checkNameBook) > 0){
        ?>
        <br><h3 class="text-center all-tittles"><?php echo $totalregistros["FOUND_ROWS()"]; ?> resultados de la búsqueda  "<?php echo $BookNameSearch; ?>"</h3><br><br><br>
        <div class="container-fluid">
        <?php
            $countBook=$inicio+1;
            while ($bookNameInfo=mysqli_fetch_array($checkNameBook, MYSQLI_ASSOC)){
        ?>
        <div class="full-reset thumbnail-book">
        <figure class="full-reset thumbnail-book-img">
        <?php if($bookNameInfo['Imagen']!=""): ?>
        <img src="./assets/uploads/img/<?php echo $bookNameInfo['Imagen']; ?>" alt="<?php echo $bookNameInfo['CodigoLibro']; ?>">
        <?php else: ?>
        <img src="./assets/img/book.png" alt="<?php echo $bookNameInfo['CodigoLibro']; ?>">
        <?php endif; ?>
                    </figure>
                    <div class="full-reset thumbnail-book-title text-center"><?php echo $countBook.' - '.$bookNameInfo['Titulo']; ?></div>
                    <div class="full-reset thumbnail-book-data">
                        <p class="text-center"><i class="zmdi zmdi-assignment-o"></i> DATOS</p>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <strong><i class="zmdi zmdi-account-box"></i> Autor </strong><br>
                                    <?php echo $bookNameInfo['Autor']; ?><br>
                                    <strong><i class="zmdi zmdi-edit"></i> Editorial </strong><br>
                                    <?php echo $bookNameInfo['Editorial']; ?>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <strong><i class="zmdi zmdi-globe"></i> País </strong><br>
                                    <?php echo $bookNameInfo['Pais']; ?><br>
                                    <strong><i class="zmdi zmdi-calendar-note"></i> Año </strong><br>
                                    <?php echo $bookNameInfo['Year']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="full-reset thumbnail-book-options">
        <?php if($bookNameInfo['Download']=="yes"): ?>
        <a href="./assets/uploads/pdf/<?php echo $bookNameInfo['PDF']; ?>" download="<?php echo $bookNameInfo['Titulo']; ?>.pdf"  class="btn-pdf-book tooltips-general" data-placement="bottom" title="Descargar PDF">
            <i class="zmdi zmdi-cloud-download"></i>
        </a>
        <a href="./assets/uploads/pdf/<?php echo $bookNameInfo['PDF']; ?>" target="_blank" class="btn-watch-book tooltips-general" data-placement="bottom" title="Ver PDF">
            <i class="zmdi zmdi-eye"></i>
        </a>
        <?php else: ?>
        <span class="btn-pdf-book text-mutted"><i class="zmdi zmdi-cloud-off"></i></span>
        <span class="btn-watch-book text-mutted"><i class="zmdi zmdi-eye-off"></i></span>
        <?php endif; ?>
            <a href="#!" class="btn-info-book tooltips-general" data-placement="bottom" title="Préstamo" data-code-book="<?php echo $bookNameInfo['CodigoLibro']; ?>">
                    <i class="zmdi zmdi-library"></i>
                </a>
            </div>
        </div>
        <?php
               $countBook=$countBook+1;
            }
        ?>
        </div>
        <nav aria-label="Page navigation" class="text-center">
            <ul class="pagination">
                <?php if($pagina == 1): ?>
                    <li class="disabled">
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="searchbook.php?bookName=<?php echo $BookNameSearch; ?>&pagina=<?php echo $pagina-1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>


                <?php
                    for($i=1; $i <= $numeropaginas; $i++){
                        if($pagina == $i){
                            echo '<li class="active"><a href="searchbook.php?bookName='.$BookNameSearch.'&pagina='.$i.'">'.$i.'</a></li>';
                        }else{
                            echo '<li><a href="searchbook.php?bookName='.$BookNameSearch.'&pagina='.$i.'">'.$i.'</a></li>';
                        }
                    }
                ?>


                <?php if($pagina == $numeropaginas): ?>
                    <li class="disabled">
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="searchbook.php?bookName=<?php echo $BookNameSearch; ?>&pagina=<?php echo $pagina+1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php
        }else{
            echo '<h2 class="text-center"><i class="zmdi zmdi-mood-bad zmdi-hc-5x"></i><br><br>Lo sentimos, no hemos encontrado ningún libro que coincida con <strong>'.$BookNameSearch.'</strong> en el sistema</h2>';
        }
        mysqli_free_result($checkNameBook);
        echo'<br><br><br><br><br><br>';
        ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                    <?php include './help/help-searchbook.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <?php include './inc/footer.php'; ?>
    </div>
</body>
</html>
