<?php 
	if(isset($_POST['bookCodeShopping'])){
		$SBSK=ejecutarSQL::consultar("SELECT * FROM libro WHERE CodigoLibroManual='".$_POST['bookCodeShopping']."'");
        if(mysqli_num_rows($SBSK)>0){
        	$dataBK=mysqli_fetch_array($SBSK, MYSQLI_ASSOC);
        	echo '
            <p class="text-center all-tittles">LIBRO</p>
            <p class="lead text-center"><strong>'.$dataBK['Titulo'].' ('.$dataBK['Autor'].')</strong></p>
			<form action="" class="row" method="POST">
                <input type="hidden"  name="bookCodePm" value="'.$dataBK['CodigoLibro'].'">
                <div class="col-xs-12">
                    <div class="group-material">
                        <div class="group-material">
                            <span>Cantidad de libros que prestará el usuario (Máximo '.($dataBK['Existencias']-$dataBK['Prestado']).')</span>
                            <input type="number" class="material-control" value="1" name="CantL">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="group-material">
                        <span>Fecha de solicitud</span>
                        <input type="text" readonly class="material-control StarCalendarInput" required="" name="startDatePm" value="'.$currentDateForm.'" placeholder="Fecha de solicitud">
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="group-material">
                        <span>Fecha de entrega</span>
                        <input type="text" readonly class="material-control EndCalendarInput" required="" name="endDatePm" value="'.$currentDateForm.'" placeholder="Primero debes seleccionar la fecha de solicitud">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="group-material text-center">
                        <input type="submit" class="btn btn-primary" value="Agregar al carrito">
                    </div>
                </div>
            </form>
        	';
        }else{
        	echo '<p class="lead text-center">No hemos encontrado ningún libro con el código "'.$_POST['bookCodeShopping'].'" en el sistema</p>';
        }
        mysqli_free_result($SBSK);
	}else{
		echo '<p class="lead text-center">Para agregar libros al carrito primero ingrese el código del libro y presione en "Buscar libro" en el formulario anterior, luego llene el formulario que aparecerá acá y haga clic en "Agregar al carrito"</p>';
	}