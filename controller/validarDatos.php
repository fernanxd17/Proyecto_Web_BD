<?php
    session_start();
    
    include ("../modelo/consulSQL.php");
    sleep(2);

    $email=$_POST['emailC'];   
    $clave=$_POST['claveC'];
   
    if(!$email==""&&!$clave==""){
        
        
             $consulta= ejecutarSQL::consultar("select * from cliente where Email = '".$email."' and Password='".$clave."'");
            $UserC=mysqli_num_rows($consulta);
            if($UserC>0){
                $_SESSION['nombreUser']=$email;
                $_SESSION['claveUser']=$clave;
                echo '<script> location.href="caja.php"; </script>';
            }else{
                echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido';
            }
        
}
    