<?php
    session_start();
    
    include ("../modelo/consulSQL.php");
    sleep(2);

    $email=$_POST['email-login'];   
    $clave=$_POST['clave-login'];
    $radio=$_POST['optionsRadios'];
    if(!$email==""&&!$clave==""){
        if($radio=="option2"){
           
           
            $consulta= ejecutarSQL::consultar("select * from administrador where Email = '".$email."' and Password='".$clave."'");
            
            if(mysqli_num_rows($consulta)>0){
             
                $_SESSION['nombreAdmin']=$email;
                $_SESSION['claveAdmin']=$clave;
                echo '<script> location.href="index.php"; </script>';
            }else{
              echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido'; 
            }
        }
        
        if($radio=="option1"){
             $consulta= ejecutarSQL::consultar("select * from cliente where Email = '".$email."' and Password='".$clave."'");
            $UserC=mysqli_num_rows($consulta);
            if($UserC>0){
                $_SESSION['nombreUser']=$email;
                $_SESSION['claveUser']=$clave;
                echo '<script> location.href="index.php"; </script>';
            }else{
                echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error nombre o contraseña invalido';
            }
        }

    }else{
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
    }