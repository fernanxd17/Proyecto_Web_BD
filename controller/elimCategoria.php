<?php
session_start();

include ("../modelo/consulSQL.php");

sleep(5);
$codeCateg= $_POST['codCatg'];

    $cone = new consultasSQL();
    $resultado= $cone->consultar("select * from categoria where CodigoCat='$codCatg'");


$totalcateg = mysqli_num_rows($resultado);

if($totalcateg>0){

	$tabla = "categoria";
	$condicion = "id_tipo='".$codeCateg."'"
    if($cone->DeleteSQL($tabla,$condicion)){
        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Categoría eliminada éxitosamente</p>';
    }else{
       echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
    }
}else{
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código de la categoria no existe</p>';
}
