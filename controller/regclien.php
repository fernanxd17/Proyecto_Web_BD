<?php
include ("../modelo/consulSQL.php");
sleep(3);

$nombreC= $_POST['nombreC'];
$apellidoC= $_POST['apellidoC'];
$emailC = $_POST['emailC'];
$claveC = $_POST['claveC'];

   


if(!$nombreC=="" && !$apellidoC=="" &&!$emailC == "" && !$claveC == ""){

     $verificar= ejecutarSQL::consultar("select * from cliente where Email ='".$emailC."'");
   
    $verificaltotal = mysqli_num_rows($verificar);

    if($verificaltotal<=0){
          
            $tabla = "cliente";
            $campos = "Cod_cliente,Nombres, Apellidos, Email, Password";

            $valores = "null,'$nombreC','$apellidoC','$emailC','$claveC'";
            
        if(consultasSQL::InsertSQL($tabla,$campos,$valores)){
            
            echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El registro se completo con éxito';
        }else{
           echo '<img src="assets/img/error.png" class="center-all-contens"><br>Ha ocurrido un error.<br>Por favor intente nuevamente'; 
        }
    }else{
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>El E-MAIL que ha ingresado ya esta registrado.<br>Por favor ingrese otro número de E-MAIL';
    }
}else {
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error los campos no deben de estar vacíos';
}

