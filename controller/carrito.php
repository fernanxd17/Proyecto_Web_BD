<?php

error_reporting(E_PARSE);

include ("../modelo/consulSQL.php");
session_start();

$suma = 0;
if(isset($_GET['precio'])){
    $_SESSION['producto'][$_SESSION['contador']] = $_GET['precio'];
    $_SESSION['contador']++;
       
}

echo '<table class="table table-bordered">';
echo '<tr><td>Producto</td><td>Precio</td><td>Marca</td><td>Tipo</td>';
for($i = 0;$i< $_SESSION['contador'];$i++){
    $consulta=ejecutarSQL::consultar("select * from producto where Cod_producto='".$_SESSION['producto'][$i]."'");

    while($fila =$consulta->fetch_assoc()) {

    	$tipo = ejecutarSQL::consultar("select * from tipo_producto where id_tipo ='".$fila['Tipo_Producto']."'");
    	$tipo = $tipo->fetch_assoc();
            echo "<tr><td>".$fila['Nombre']."</td><td> ".$fila['Precio']."</td><td>".$fila['Marca']."</td><td>".$tipo['tipo']."</td></tr>";
    $suma += $fila['Precio'];
    }
}
echo "<tr><td>Total</td><td>$".number_format($suma,2)."</td></tr>";
echo "</table>";
$_SESSION['sumaTotal']=$suma;