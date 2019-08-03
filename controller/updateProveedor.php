<?php

include '../modelo/consulSQL.php';

sleep(5);

$nitA=$_POST['nit'];
$nombreA=$_POST['nombreA'];
$nombre=$_POST['nombre'];
$telefonoA=$_POST['telefonoA'];
$telefono=$_POST['telefono'];
$sitioA = $_POST['sitioA'];
$sitio = $_POST['sitio'];

$nombreF = $nombreA;
if(!$nombre == ""){
    $nombreF = $nombre;
}
$telefonoF = $telefonoA;
if(!$telefono == ""){
    $telefonoF = $telefono;
}
$sitioF = $sitioA;
if(!$sitio == ""){
    $sitioF = $sitio;
}

$tabla = "proveedor";
$valores = "NIT='$nitA',Nombre='$nombreF',Telefono='$telefonoF',SitioWeb='$sitioF'";
$condicion = "NIT='$nitA'";
if(consultasSQL::UpdateSQL($tabla,$valores,$condicion)){
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