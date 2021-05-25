<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
$bookCode=consultasSQL::CleanStringText($_POST['primaryKey']);
$bookCodeManual=consultasSQL::CleanStringText($_POST['bookCodeManual']);
$bookCategory=consultasSQL::CleanStringText($_POST['bookCategory']);
$bookName=consultasSQL::CleanStringText($_POST['bookName']);
$bookAutor=consultasSQL::CleanStringText($_POST['bookAutor']);
$bookCountry=consultasSQL::CleanStringText($_POST['bookCountry']);
$bookProvider=consultasSQL::CleanStringText($_POST['bookProvider']);
$bookYear=consultasSQL::CleanStringText($_POST['bookYear']);
$bookEditorial=consultasSQL::CleanStringText($_POST['bookEditorial']);
$bookEdition=consultasSQL::CleanStringText($_POST['bookEdition']);
$bookCopies=consultasSQL::CleanStringText($_POST['bookCopies']);
$bookLocation=consultasSQL::CleanStringText($_POST['bookLocation']);
$bookOffice=consultasSQL::CleanStringText($_POST['bookOffice']);
$bookEstimated=consultasSQL::CleanStringText($_POST['bookEstimated']);


$bookReferencia=consultasSQL::CleanStringText($_POST['bookReferencia']);
$bookIdioma=consultasSQL::CleanStringText($_POST['bookIdioma']);
$bookHombres=consultasSQL::CleanStringText($_POST['bookHombres']);
$bookMujeres=consultasSQL::CleanStringText($_POST['bookMujeres']);
$bookDiscapacidad=consultasSQL::CleanStringText($_POST['bookDiscapacidad']);
$bookGenero=consultasSQL::CleanStringText($_POST['bookGenero']);

$bookReservas=consultasSQL::CleanStringText($_POST['bookReservas']);
$bookSimples=consultasSQL::CleanStringText($_POST['bookSimples']);
$bookDobles=consultasSQL::CleanStringText($_POST['bookDobles']);
$bookTriples=consultasSQL::CleanStringText($_POST['bookTriples']);
$bookMatrimonio=consultasSQL::CleanStringText($_POST['bookMatrimonio']);
$bookFamilia=consultasSQL::CleanStringText($_POST['bookFamilia']);
$bookCamas=consultasSQL::CleanStringText($_POST['bookCamas']);
$bookPlazas=consultasSQL::CleanStringText($_POST['bookPlazas']);
$bookMesas=consultasSQL::CleanStringText($_POST['bookMesas']);
$bookBanosHombres=consultasSQL::CleanStringText($_POST['bookBanosHombres']);
$bookBanosMujeres=consultasSQL::CleanStringText($_POST['bookBanosMujeres']);
$bookEscape=consultasSQL::CleanStringText($_POST['bookEscape']);
$bookPagos=consultasSQL::CleanStringText($_POST['bookPagos']);
$bookParqueaderos=consultasSQL::CleanStringText($_POST['bookParqueaderos']);
$bookSeguridad=consultasSQL::CleanStringText($_POST['bookSeguridad']);
$bookMascotas=consultasSQL::CleanStringText($_POST['bookMascotas']);
$bookLimpieza=consultasSQL::CleanStringText($_POST['bookLimpieza']);
$bookFolleteria=consultasSQL::CleanStringText($_POST['bookFolleteria']);
$bookPromocion=consultasSQL::CleanStringText($_POST['bookPromocion']);
$bookCapacitacion=consultasSQL::CleanStringText($_POST['bookCapacitacion']);
$bookCapacidad=consultasSQL::CleanStringText($_POST['bookCapacidad']);
$bookSenaletica=consultasSQL::CleanStringText($_POST['bookSenaletica']);
$bookWifi=consultasSQL::CleanStringText($_POST['bookWifi']);
$bookOperadores=consultasSQL::CleanStringText($_POST['bookOperadores']);
$bookTurnos=consultasSQL::CleanStringText($_POST['bookTurnos']);
$bookBicicletas=consultasSQL::CleanStringText($_POST['bookBicicletas']);
$bookMaleteros=consultasSQL::CleanStringText($_POST['bookMaleteros']);
$bookChalecos=consultasSQL::CleanStringText($_POST['bookChalecos']);
$bookCompania=consultasSQL::CleanStringText($_POST['bookCompania']);
$bookLicencias=consultasSQL::CleanStringText($_POST['bookLicencias']);
$bookBoton=consultasSQL::CleanStringText($_POST['bookBoton']);
$bookCinturones=consultasSQL::CleanStringText($_POST['bookCinturones']);
$bookVehiculos=consultasSQL::CleanStringText($_POST['bookVehiculos']);
$bookPasajeros=consultasSQL::CleanStringText($_POST['bookPasajeros']);
$bookSocios=consultasSQL::CleanStringText($_POST['bookSocios']);
$bookChoferes=consultasSQL::CleanStringText($_POST['bookChoferes']);
$bookAsientos=consultasSQL::CleanStringText($_POST['bookAsientos']);
$bookTV=consultasSQL::CleanStringText($_POST['bookTV']);
$bookAC=consultasSQL::CleanStringText($_POST['bookAC']);
$bookMicrofono=consultasSQL::CleanStringText($_POST['bookMicrofono']);
$bookEstado=consultasSQL::CleanStringText($_POST['bookEstado']);
$bookSector=consultasSQL::CleanStringText($_POST['bookSector']);





$OLDbookPicture=consultasSQL::CleanStringText($_POST['OLDbookPicture']);
$OLDbookPDF=consultasSQL::CleanStringText($_POST['OLDbookPDF']);
$bookPictureTMP=consultasSQL::CleanStringText($_FILES['bookPicture']['tmp_name']);
$bookPictureName=consultasSQL::CleanStringText($_FILES['bookPicture']['name']);
$bookPictureType=consultasSQL::CleanStringText($_FILES['bookPicture']['type']);
$bookPictureSize=consultasSQL::CleanStringText($_FILES['bookPicture']['size']);
$bookPictureMaxSize=5120;
$bookPictureDir="../assets/uploads/img/".$OLDbookPicture;
$bookPDFTMP=consultasSQL::CleanStringText($_FILES['bookPDF']['tmp_name']);
$bookPDFName=consultasSQL::CleanStringText($_FILES['bookPDF']['name']);
$bookPDFType=consultasSQL::CleanStringText($_FILES['bookPDF']['type']);
$bookPDFSize=consultasSQL::CleanStringText($_FILES['bookPDF']['size']);
$bookPDFMaxSize=102400;
$bookPDFDir="../assets/uploads/pdf/".$OLDbookPDF;
$bookDownload=consultasSQL::CleanStringText($_POST['bookDownload']);
$bookDescription=consultasSQL::CleanStringText($_POST['bookDescription']);

$checkLoanBook=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$bookCode."' AND Estado='Prestamo'");
$checkLoanBook1=ejecutarSQL::consultar("SELECT * FROM prestamo WHERE CodigoLibro='".$bookCode."' AND Estado='Reservacion'");
if(mysqli_num_rows($checkLoanBook)<=0 && mysqli_num_rows($checkLoanBook1)<=0){
    if(($bookPictureType=="image/jpeg"||$bookPictureType=="image/png"||$bookPictureType=="")&&($bookPDFType=="application/pdf"||$bookPDFType=="")){
        if(($bookPictureSize/1024)<=$bookPictureMaxSize && ($bookPDFSize/1024)<=$bookPDFMaxSize){
            $bookDataSave="CodigoCategoria='$bookCategory',CodigoLibroManual='$bookCodeManual',Titulo='$bookName',Autor='$bookAutor',Pais='$bookCountry',CodigoProveedor='$bookProvider',Year='$bookYear',Editorial='$bookEditorial',Edicion='$bookEdition',Idioma='$bookIdioma',hombres='$bookHombres',mujeres='$bookMujeres',discapacidad='$bookDiscapacidad',genero='$bookGenero',reservas='$bookReservas',simples='$bookSimples',dobles='$bookDobles',triples='$bookTriples',matrimonio='$bookMatrimonio',familia='$bookFamilia',camas='$bookCamas',plazas='$bookPlazas',mesas='$bookMesas',banoshombres='$bookBanosHombres',banosmujeres='$bookBanosMujeres',escape='$bookEscape',pagos='$bookPagos',parqueaderos='$bookParqueaderos',seguridad='$bookSeguridad',mascotas='$bookMascotas',limpieza='$bookLimpieza',folleteria='$bookFolleteria',promocion='$bookPromocion',capacitacion='$bookCapacitacion',capacidad='$bookCapacidad',senaletica='$bookSenaletica',wifi='$bookWifi',operadores='$bookOperadores',turnos='$bookTurnos',bicicletas='$bookBicicletas',maleteros='$bookMaleteros',Chalecos='$bookChalecos',compania='$bookCompania',licencias='$bookLicencias',boton='$bookBoton',cinturones='$bookCinturones',vehiculos='$bookVehiculos',pasajeros='$bookPasajeros',socios='$bookSocios',choferes='$bookChoferes',asientos='$bookAsientos',tv='$bookTV',ac='$bookAC',microfono='$bookMicrofono',estado='$bookEstado',sector='$bookSector',referencia='$bookReferencia',Existencias='$bookCopies',Ubicacion='$bookLocation',Cargo='$bookOffice',Estimado='$bookEstimated',Download='$bookDownload',Descripcion='$bookDescription'";
            if($bookPictureType=="" && $bookPDFType==""){
                $moveFile=TRUE;
            }else{
                chmod($bookPictureDir, 0777);
                chmod($bookPDFDir, 0777);
                if($_FILES['bookPicture']['tmp_name']!="" && $_FILES['bookPDF']['tmp_name']!=""){
                      $moveFile=move_uploaded_file($_FILES['bookPicture']['tmp_name'], $bookPictureDir) && move_uploaded_file($_FILES['bookPDF']['tmp_name'], $bookPDFDir);
                }elseif($_FILES['bookPicture']['tmp_name']!=""){
                  $moveFile=move_uploaded_file($_FILES['bookPicture']['tmp_name'], $bookPictureDir);
                }elseif($_FILES['bookPDF']['tmp_name']!=""){
                  $moveFile=move_uploaded_file($_FILES['bookPDF']['tmp_name'], $bookPDFDir);
                }else{
                  $moveFile=FALSE;
                }
            }
            if($moveFile){
                if(consultasSQL::UpdateSQL("libro", $bookDataSave, "CodigoLibro='$bookCode'")){
                    echo '<script type="text/javascript">
                        swal({
                            title:"¡Datos de la empresa actualizados!",
                            text:"Los datos de la empresa se actualizaron correctamente",
                            type: "success",
                            confirmButtonText: "Aceptar"
                        },
                        function(isConfirm){
                            if (isConfirm) {
                               window.location="infobook.php?codeBook='.$bookCode.'";
                            } else {
                                window.location="infobook.php?codeBook='.$bookCode.'";;
                            }
                        });
                    </script>';
                }else{
                    echo '<script type="text/javascript">
                        swal({
                            title:"¡Ocurrió un error inesperado!",
                            text:"No hemos podido actualizar los datos del libro, por favor intenta nuevamente",
                            type: "error",
                            confirmButtonText: "Aceptar"
                        });
                    </script>';
                }
            }else{
              echo '<script type="text/javascript">
                  swal({
                     title:"¡Ocurrió un error inesperado!",
                     text:"No se pudo copiar los ficheros al servidor",
                     type: "error",
                     confirmButtonText: "Aceptar"
                  });
              </script>';
            }
        }else{
            echo '<script type="text/javascript">
              swal({
                 title:"¡Ocurrió un error inesperado!",
                 text:"Haz exedido el tamaño máximo de la imágen o del archivo PDF que se guardará, por favor vericar e intentar nuevamente",
                 type: "error",
                 confirmButtonText: "Aceptar"
              });
          </script>';
        }
    }else{
        echo '<script type="text/javascript">
            swal({
               title:"¡Ocurrió un error inesperado!",
               text:"Haz seleccionado un tipo de archivo no válido de la imágen o del archivo PDF, por favor vericar e intentar nuevamente",
               type: "error",
               confirmButtonText: "Aceptar"
            });
        </script>';
    }
}else{
    echo '<script type="text/javascript">
        swal({
            title:"¡Ocurrió un error inesperado!",
            text:"Esta empresa tiene préstamos o reservaciones vigentes, no puedes actualizar los datos",
            type: "error",
            confirmButtonText: "Aceptar"
        });
    </script>';
}
mysqli_free_result($checkLoanBook);
mysqli_free_result($checkLoanBook1);
