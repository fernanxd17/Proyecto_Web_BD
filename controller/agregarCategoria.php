<?php
session_start();

include ("../modelo/consulSQL.php");

sleep(5);

$nombreCateg= $_POST['nombreCatg'];


if( !$nombreCateg=="" ){
        
        $resultado= ejecutarSQL::consultar("select * from tipo_producto where tipo='".$nombreCateg."'");

    
    $verificaltotal = mysqli_num_rows($resultado);
    if($verificaltotal<=0){
        $tabla = "tipo_producto";
        $campos = "id_tipo,tipo";
        $valores = "null, '$nombreCateg'";
        if(consultasSQL::InsertSQL($tabla,$campos,$valores)){
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Categoría añadida éxitosamente</p>';
        }else{
           echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
        }
    }else{
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre que ha ingresado ya existe.<br>Por favor ingrese otro código</p>';
    }
}else {
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
}

