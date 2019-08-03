<?php

include ("../modelo/consulSQL.php");

sleep(5);

$nombreA=$_POST['nombreA'];
$nombre = $_POST['nombre'];

$nombreF = $nombreA;
if(!$nombre==""){
    $nombreF = $nombre;
}


    
    $tabla = "tipo_producto";
    $campos = "tipo = '$nombreF'";
    $condicion = "tipo = '$nombreA'";
  
    

if(consultasSQL::UpdateSQL($tabla, $campos, $condicion)){
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

