<?php

include ("../modelo/consulSQL.php");

sleep(5);



$nombrePA = $_POST['nombrePA'];
$nombreP  = $_POST['nombreP'];
$precioPA = $_POST['precioPA'];
$precioP  = $_POST['precioP'];
$marcaPA  = $_POST['marcaPA'];
$marcaP   = $_POST['marcaP'];
$descripcionPA = $_POST['descripcionPA'];
$descripcionP  = $_POST['descripcionP'];
     
    $tabla = "producto";
    $nombreF = $nombrePA;
    if(!$nombreP==""){
        $nombreF = $nombreP;
    }
    $precioF = $precioPA;
    if(!$precioP==""){
        $precioF = $precioP;
    }
    $marcaF = $marcaPA;
    if(!$marcaP==""){
        $marcaF = $marcaP;
    }
    $descripcionF = $descripcionPA;
    if(!$descripcionP==""){
        $descripcionF = $descripcionP;
    }    
   $campos = "Nombre='$nombreF',Precio=$precioF,Marca = '$marcaF', Descripcion = '$descripcionF'";
    $condicion = "Nombre='$nombrePA' and Marca= '$marcaPA'";


if($cone=consultasSQL::UpdateSQL($tabla,$campos,$condicion)){
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/Check.png">
    <p><strong>Hecho</strong></p>
    <p class="text-center">
        Recargando<br>
        en 7 segundos
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },7000);
    </script>
 ';
}else{
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/cancel.png">
    <p><strong>Error</strong></p>
    <p class="text-center">
        Recargando<br>
        en 7 segundos
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },7000);
    </script>
 ';
}