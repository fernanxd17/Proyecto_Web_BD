<?php
session_start();

include ("../modelo/consulSQL.php");

sleep(5);
$Id_pedido= $_POST['codPedido'];
    $cone = new consultasSQL();
    $resultado= $cone->consultar("select * from pedido where Id_pedido='$Id_pedido'");

$totalP= mysqli_num_rows($resultado);

if($totalP>0){
	$tabla = "venta";
	$condicion = "Id_pedido='".$Id_pedido."'";
    if($cone->DeleteSQL($tabla,$condicion)){
  
        echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Pedido eliminado éxitosamente</p>';
    }else{
       echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
    }
}else{
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El pedido no existe</p>';
}
