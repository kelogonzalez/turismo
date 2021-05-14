<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';
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
$bookBorrowed=0;
$bookLocation=consultasSQL::CleanStringText($_POST['bookLocation']);
$bookOffice=consultasSQL::CleanStringText($_POST['bookOffice']);
$bookEstimated=consultasSQL::CleanStringText($_POST['bookEstimated']);



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
$bookReferencia=consultasSQL::CleanStringText($_POST['bookReferencia']);






$bookPictureTMP=consultasSQL::CleanStringText($_FILES['bookPicture']['tmp_name']);
$bookPictureName=consultasSQL::CleanStringText($_FILES['bookPicture']['name']);
$bookPictureType=consultasSQL::CleanStringText($_FILES['bookPicture']['type']);
$bookPictureSize=consultasSQL::CleanStringText($_FILES['bookPicture']['size']);
$bookPictureMaxSize=5120;
$bookPictureDir="../assets/uploads/img/";
$bookPDFTMP=consultasSQL::CleanStringText($_FILES['bookPDF']['tmp_name']);
$bookPDFName=consultasSQL::CleanStringText($_FILES['bookPDF']['name']);
$bookPDFType=consultasSQL::CleanStringText($_FILES['bookPDF']['type']);
$bookPDFSize=consultasSQL::CleanStringText($_FILES['bookPDF']['size']);
$bookPDFMaxSize=102400;
$bookPDFDir="../assets/uploads/pdf/";
$bookDownload=consultasSQL::CleanStringText($_POST['bookDownload']);
$bookDescription=consultasSQL::CleanStringText($_POST['bookDescription']);


$checkAllBookReg=ejecutarSQL::consultar("SELECT * FROM libro");
$checktotalBookReg=mysqli_num_rows($checkAllBookReg);
$numB=$checktotalBookReg+1;
$bookCheckInstitution=ejecutarSQL::consultar("SELECT * FROM institucion");
$dataInst=mysqli_fetch_array($bookCheckInstitution, MYSQLI_ASSOC);
$bookInstitution=$dataInst['CodigoInfraestructura'];
$codigo="";
$longitud=4;
for ($i=1; $i<=$longitud; $i++){
    $numero = rand(0,9);
    $codigo .= $numero;
}
$bookCode="I".$dataInst['CodigoInfraestructura']."Y".$dataInst['Year']."C".$bookCategory."B".$numB."N".$codigo."";
if(mysqli_num_rows($bookCheckInstitution)>0){
    if($bookCategory!="" && $bookProvider!="" && $bookOffice!=""){
      if(($bookPictureType=="image/jpeg"||$bookPictureType=="image/png"||$bookPictureType=="")&&($bookPDFType=="application/pdf"||$bookPDFType=="")){
        if(($bookPictureSize/1024)<=$bookPictureMaxSize && ($bookPDFSize/1024)<=$bookPDFMaxSize){
          if($bookPictureType=="" && $bookPDFType==""){
           if(consultasSQL::InsertSQL("libro", "CodigoLibro, CodigoLibroManual, CodigoCategoria, CodigoProveedor, CodigoInfraestructura, Autor, Pais, Year, Estimado, idioma, hombres, mujeres, discapacidad, genero, reservas, simples, dobles, triples, matrimonio, familia, camas, plazas, mesas, banoshombres, banosmujeres, escape, pagos, parqueaderos, seguridad, mascotas, limpieza, folleteria, promocion, capacitacion, capacidad, senaletica, wifi, operadores, turnos, bicicletas, maleteros, chalecos, compania, licencias, boton, cinturones, vehiculos, pasajeros, socios, choferes, asientos, tv, ac, microfono, estado, sector, referencia, Titulo, Edicion, Ubicacion, Cargo, Editorial, Existencias, Prestado, Descripcion", "'$bookCode','$bookCodeManual','$bookCategory','$bookProvider','$bookInstitution','$bookAutor','$bookCountry','$bookYear','$bookEstimated','$bookIdioma','$bookHombres','$bookMujeres','$bookDiscapacidad','$bookGenero','$bookReservas','$bookSimples','$bookDobles','$bookTriples','$bookMatrimonio','$bookFamilia','$bookCamas','$bookPlazas','$bookMesas','$bookBanosHombres','$bookBanosMujeres','$bookEscape','$bookPagos','$bookParqueaderos','$bookSeguridad','$bookMascotas','$bookLimpieza','$bookFolleteria','$bookPromocion','$bookCapacitacion','$bookCapacidad','$bookSenaletica','$bookWifi','$bookOperadores','$bookTurnos','$bookBicicletas','$bookMaleteros','$bookChalecos','$bookCompania','$bookLicencias','$bookBoton','$bookCinturones','$bookVehiculos','$bookPasajeros','$bookSocios','$bookChoferes','$bookAsientos','$bookTV','$bookAC','$bookMicrofono','$bookEstado','$bookSector','$bookReferencia','$bookName','$bookEdition','$bookLocation','$bookOffice','$bookEditorial','$bookCopies','$bookBorrowed','$bookDescription'")){
               echo '<script type="text/javascript">
                    swal({
                       title:"Empresa registrada!",
                       text:"Los datos de la empresa se registraron correctamente",
                       type: "success",
                       confirmButtonText: "Aceptar"
                    });
                    $("#saveData")[0].reset();
                </script>';
           }else{
            echo '<script type="text/javascript">
                swal({
                   title:"¡Ocurrió un error inesperado!",
                   text:"No se pudo registrar la empresa, por favor intenta nuevamente",
                   type: "error",
                   confirmButtonText: "Aceptar"
                });
            </script>';
           }
          }else{
            if($_FILES['bookPDF']['tmp_name']!=""){
              if($bookDownload==""){
                echo '<script type="text/javascript">
                    swal({
                       title:"¡Ocurrió un error inesperado!",
                       text:"Por favor elija si el archivo podrá ser visible para los usuarios",
                       type: "error",
                       confirmButtonText: "Aceptar"
                    });
                </script>';
                exit();
              }elseif(is_file("../assets/uploads/pdf/".$_FILES['bookPDF']['name'])){
                echo '<script type="text/javascript">
                    swal({
                       title:"¡Ocurrió un error inesperado!",
                       text:"El archivo PDF que has seleccionado ya se encuentra almacenado en el sistema, por favor cambia el nombre",
                       type: "error",
                       confirmButtonText: "Aceptar"
                    });
                </script>';
                exit();
              }
            }
            if($_FILES['bookPicture']['name']!=""){
              if(is_file("../assets/uploads/img/".$_FILES['bookPicture']['name'])){
                echo '<script type="text/javascript">
                    swal({
                       title:"¡Ocurrió un error inesperado!",
                       text:"La imagen que has seleccionado ya se encuentra almacenada en el sistema, por favor cambia el nombre",
                       type: "error",
                       confirmButtonText: "Aceptar"
                    });
                </script>';
                exit();
              }
            }
            chmod($bookPictureDir, 0777);
            chmod($bookPDFDir, 0777);
            switch ($bookPictureType) {
              case 'image/jpeg':
                $extPicture=".jpg";
              break;
              case 'image/png':
                $extPicture=".png";
              break;
            }
            $finalPDFName=$bookCode.".pdf";
            $finalPictureName=$bookCode.$extPicture;
            if($_FILES['bookPicture']['tmp_name']!="" && $_FILES['bookPDF']['tmp_name']!=""){
              $moveFile=move_uploaded_file($_FILES['bookPicture']['tmp_name'], $bookPictureDir.$finalPictureName) && move_uploaded_file($_FILES['bookPDF']['tmp_name'], $bookPDFDir.$finalPDFName);
            }elseif($_FILES['bookPicture']['tmp_name']!=""){
              $moveFile=move_uploaded_file($_FILES['bookPicture']['tmp_name'], $bookPictureDir.$finalPictureName);
            }elseif($_FILES['bookPDF']['tmp_name']!=""){
              $moveFile=move_uploaded_file($_FILES['bookPDF']['tmp_name'], $bookPDFDir.$finalPDFName);
            }else{
              $moveFile=FALSE;
            }
            if($moveFile){
              if(consultasSQL::InsertSQL("libro", "CodigoLibro, CodigoLibroManual, CodigoCategoria, CodigoProveedor, CodigoInfraestructura, Autor, Pais, Year, Estimado, idioma, hombres, mujeres, discapacidad, genero, reservas, simples, dobles, triples, matrimonio, familia, camas, plazas, mesas, banoshombres, banosmujeres, escape, pagos, parqueaderos, seguridad, mascotas, limpieza, folleteria, promocion, capacitacion, capacidad, senaletica, wifi, operadores, turnos, bicicletas, maleteros, chalecos, compania, licencias, boton, cinturones, vehiculos, pasajeros, socios, choferes, asientos, tv, ac, microfono, estado, sector, referencia,Titulo, Edicion, Ubicacion, Cargo, Editorial, Existencias, Prestado, Imagen, PDF, Download, Descripcion", "'$bookCode','$bookCodeManual','$bookCategory','$bookProvider','$bookInstitution','$bookAutor','$bookCountry','$bookYear','$bookEstimated','$bookIdioma','$bookHombres','$bookMujeres','$bookDiscapacidad','$bookGenero','$bookReservas','$bookSimples','$bookDobles','$bookTriples','$bookMatrimonio','$bookFamilia','$bookCamas','$bookPlazas','$bookMesas','$bookBanosHombres','$bookBanosMujeres','$bookEscape','$bookPagos','$bookParqueaderos','$bookSeguridad','$bookMascotas','$bookLimpieza','$bookFolleteria','$bookPromocion','$bookCapacitacion','$bookCapacidad','$bookSenaletica','$bookWifi','$bookOperadores','$bookTurnos','$bookBicicletas','$bookMaleteros','$bookChalecos','$bookCompania','$bookLicencias','$bookBoton','$bookCinturones','$bookVehiculos','$bookPasajeros','$bookSocios','$bookChoferes','$bookAsientos','$bookTV','$bookAC','$bookMicrofono','$bookEstado','$bookSector','$bookReferencia','$bookName','$bookEdition','$bookLocation','$bookOffice','$bookEditorial','$bookCopies','$bookBorrowed','$finalPictureName','$finalPDFName','$bookDownload','$bookDescription'")){
                echo '<script type="text/javascript">
                    swal({
                       title:"Empresa registrada!",
                       text:"Los datos de la empresa se registraron correctamente",
                       type: "success",
                       confirmButtonText: "Aceptar"
                    });
                    $("#saveData")[0].reset();
                </script>';
              }else{
                echo '<script type="text/javascript">
                    swal({
                       title:"¡Ocurrió un error inesperado!",
                       text:"No se pudo registrar la empresa, por favor intenta nuevamente",
                       type: "error",
                       confirmButtonText: "Aceptar"
                    });
                </script>';
                chmod($bookPictureDir.$finalPictureName, 0777);
                chmod($bookPDFDir.$finalPDFName, 0777);
                unlink($bookPictureDir.$finalPictureName);
                unlink($bookPDFDir.$finalPDFName);
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
               text:"Verifica que hayas seleccionado una categoría, proveedor, cargo y estado del libro válidos. Si aún tienes problemas verifica que tengas categorías y proveedores registrados en el sistema",
               type: "error",
               confirmButtonText: "Aceptar"
            });
        </script>';
    }
}else{
    echo '<script type="text/javascript">
        swal({
           title:"¡Ocurrió un error inesperado!",
           text:"No has registrado los datos de la institución, por favor registralos para poder guardar libros",
           type: "error",
           confirmButtonText: "Aceptar"
        });
    </script>';
}
mysqli_free_result($bookCheckInstitution);
mysqli_free_result($checkAllBookReg);
