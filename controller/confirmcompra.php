<?php
session_start(); 

include ("../modelo/consulSQL.php");
$num=$_POST['clien-number'];
sleep(3);


   $cedulaC=$_POST['cedulaC'];
   $apellidoC=  $_POST['apellidoC'];
   $nombreC = $_POST['nombreC'];
   $emailC = $_POST['emailC'];
   $celularC = $_POST['telefonoC'];
   $depC = $_POST['depCl'];
   $munC = $_POST['cbx-mun'];
   $clienteDir = $_POST['direccionC'];
   
  $cliente = ejecutarSQL::consultar("select * from cliente where Email = '".$emailC."'");


  
  $cliente = $cliente->fetch_assoc();

  /*Datos de la tabla compra */
  $tabla = "compra";
  $campos = "Id_compra, Cod_cliente,Cedula,Celular,Id_departamento, Id_municipio,Direccion,Id_formaPago ";

  $valores = "null, ".$cliente['Cod_cliente'].",'".$cedulaC."','".$celularC."','".$depC."', '".$munC."', '".$clienteDir."', 1";
  
  /*Insertando datos en tabla compra*/
$cod = $cliente['Cod_cliente'];
 

    consultasSQL::InsertSQL($tabla, $campos,$valores);


  /*recuperando el número del pedido actual*/
  
  $compra = ejecutarSQL::consultar("Select * from compra order by Id_compra desc limit 1");
  

  $compra = $compra->fetch_assoc();
 
  /*Insertando datos en detalle de la venta*/
  $tabla = "subcompra";
  $campos = "Id_subcompra,Cod_Producto,Cantidad,PrecioTotal,Id_compra";
  for($i = 0;$i< $_SESSION['contador'];$i++){

      $existe = ejecutarSQL::consultar("select * from subcompra where Cod_Producto='".$_SESSION['producto'][$i]."' and Id_compra =".$compra['Id_compra']);
     
      $producto = ejecutarSQL::consultar("select * from producto where Cod_producto ='".$_SESSION['producto'][$i]."'");
        
        $producto = $producto->fetch_assoc();
      if(mysqli_num_rows($existe) > 0){
        /*actualizar */
          
        $condicion = "Id_compra = ".$compra['Id_compra']." and Cod_Producto = '".$_SESSION['producto'][$i]."'";
        $existe = $existe->fetch_assoc();
        $cantActual = $existe['Cantidad'];
        $campos = "Cantidad = ('$cantActual'+1)";
        consultasSQL::UpdateSQL($tabla,$campos,$condicion);
         

      }else{
        /*agregar */
         $campos = "Id_subcompra,Cod_Producto,Cantidad,PrecioTotal,Id_compra";
     
        $valores = "null,'".$_SESSION['producto'][$i]."',1,".$producto['Precio'].",".$compra['Id_compra'];
        consultasSQL::InsertSQL($tabla,$campos,$valores);
        
      }

      
      
     
   
     
   
    }

    /** hago el pdf **/
    $_SESSION['cedula'] = $cedulaC;
    $_SESSION['nombre'] = $nombreC." ".$apellidoC;
    $depC = ejecutarSQL::consultar("select * from departamentos where id_departamento =".$depC);
    $depC = $depC->fetch_assoc();

    $munC = ejecutarSQL::consultar("select * from municipios where id_municipio ='".$munC."'");
    $munC = $munC->fetch_assoc();

    $_SESSION['direccion'] = $clienteDir.", ".$munC['municipio'].", ".$depC['departamento'];
    $_SESSION['cedula'] = $cedulaC;
    $_SESSION['email'] = $emailC;
    $_SESSION['compra'] = $compra['Id_compra'];
     echo '<script> location.href="controller/generarFactura.php"; </script>'; 

    
    
    /*Vaciando el carrito*/
    unset($_SESSION['producto']);
    unset($_SESSION['contador']);

    /**echo '<script> location.href="index.php"; </script>';*/
    echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito';
  





?>


