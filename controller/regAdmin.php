<?php
session_start();

include ("../modelo/consulSQL.php");

sleep(5);
$cedula = $_POST['cedula'];
$nombreAdmin= $_POST['nombreAdmin'];
$passAdmin= md5($_POST['passAdmin']);
$apellidos = $_POST['apellidos'];
$nacimiento = $_POST['nacimiento'];
$email = $_POST['email'];
$admin_departamento = $_POST['admin-departamento'];
$ingreso = $_POST['ingreso'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$admin_municipio = $_POST['admin-municipio'];

if(!$nombreAdmin=="" && !$passAdmin=="" && !$cedula == "" && !$apellidos == "" && !$nacimiento=="" && !$email == "" && !$admin_departamento == "" && !$ingreso=="" && !$telefono=="" && !$celular == "" && !$admin_municipio==""){
    $con = new Conectar();
    $verificar=  $con->consultar("select * from administrador where Cedula='".$cedula."'");
    $verificaltotal = mysqli_num_rows($verificar);
    if($verificaltotal<=0){
        $tabla = "administrador";
        $campos = "F_ingreso, Cedula, Email,Contraseña";
        $valores = "'$ingreso','$cedula','$email', '$passAdmin'";


        if($con->InsertSQL($tabla, $campos, $valores)){
            $tabla = "persona";
            $campos = "Cedula, Apellidos, Nombres, F_nacimiento, Email, Telefono, Celular, Id_municipio";
            $valores = "'$cedula','$apellidos', '$nombreAdmin','$nacimiento','$email','$telefono','$celular','$admin_municipio'";
            $con->InsertSQL($tabla,$campos,$valores);
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Administrador añadido éxitosamente</p>';
        }else{
           echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>'; 
        }
    }else{
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El nombre que ha ingresado ya existe.<br>Por favor ingrese otro nombre</p>';
    }
}else {
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Error los campos no deben de estar vacíos</p>';
}