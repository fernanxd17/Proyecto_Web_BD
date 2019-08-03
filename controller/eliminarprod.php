<?php
 
 include ("../modelo/consulSQL.php");

 sleep(4);
 
 $codeProd= $_POST['Cod_producto'];
 

 $consulta= ejecutarSQL::consultar("select * from producto where Cod_producto=$codeProd");
 $totalproductos = mysqli_num_rows($consulta);
 $tmp=  $consulta->fetch_assoc();
 $imagen=$tmp['Imagen'];
 if($totalproductos>0){
        $tabla = "producto";
        $condicion = "Cod_producto=".$codeProd."";
    if($cone= consultasSQL::DeleteSQL($tabla,$condicion)){
        $carpeta=("../assets/img-products/");
        $directorio=$carpeta.$imagen;
        chmod($directorio, 0777);
        unlink($directorio);
        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">El producto se elimino de la tienda con éxito</p>';
    }else{
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
    }
 }else{
     echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código del producto no existe</p>';
 }