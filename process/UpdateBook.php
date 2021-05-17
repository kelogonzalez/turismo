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
            $bookDataSave="CodigoCategoria='$bookCategory',CodigoLibroManual='$bookCodeManual',Titulo='$bookName',Autor='$bookAutor',Pais='$bookCountry',CodigoProveedor='$bookProvider',Year='$bookYear',Editorial='$bookEditorial',Edicion='$bookEdition',referencia='$bookReferencia',Existencias='$bookCopies',Ubicacion='$bookLocation',Cargo='$bookOffice',Estimado='$bookEstimated',Download='$bookDownload',Descripcion='$bookDescription'";
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
