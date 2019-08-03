<?php
    session_start();
    
    include ("modelo/consulSQL.php");
    sleep(2);
?>    
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html" charset="utf-8">
    <title>Caja</title>
    <?php include ("./titulos/link.php"); ?>
     <?php include ("./titulos/barnav.php"); ?>
    <script language="javascript">

      $(document).ready(function(){
        $("#cbx-dep").change(function(){

          $("#cbx-dep option:selected").each(function() {
            id_departamento = $(this).val();
            $.post("modelo/getMunicipio.php",{ id_departamento: id_departamento
            }, function(data){
              $("#cbx-mun").html(data);
            });
          });
      })
    });
       </script>
</head>
<body id="container-page-index">
  
    <section id="container-pedido">
        <div class="container">
            <div class="page-header">
              <h1>Confirmar pedido</h1>
            </div>
            <br><br><br>
            <div class="row">  

             <div class="col-xs-12 col-sm-6">
              <br>
              <br>
                 <table class="table table-bordered">
                  <?php
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
?>

</table>

<img class="img-responsive center-all-contens" src="assets/img/shopping-cart.png">
                                          <input type="hidden" name="clien-name" value="'.$_SESSION['nombreUser'].'">
                                          <input type="hidden" name="clien-pass" value="'.$_SESSION['claveUser'].'">
                                          <input type="hidden"  name="clien-number" value="log">
             </div>

                <div class="col-xs-12 col-sm-6">
                    <div id="form-compra">
                        <form action="controller/confirmcompra.php" method="post" role="form" class="FormCatElec" data-form="save">
                            
                                        <h1 class="text-center">¿Confirmar pedido?</h1>
                                        <p class="text-center">Para confirmar completa y verifica tus datos.</p>
                                        <br>
                                  <?php
                                $consulta=ejecutarSQL::consultar("select * from cliente where Email = '".$_SESSION['nombreUser']."'");
                                
                                $consulta = $consulta->fetch_assoc();
                                ?>

                                <div class='form-group'>
                              <div class='input-group'>
                                <div class='input-group-addon'><i class='fa fa-user'></i></div>
                                <?php
                               
                                 echo "
                                <input class='form-control all-elements-tooltip' type='text' readonly='readonly' placeholder='nombres' required name='nombreC' data-toggle='tooltip' data-placement='top' title='Ingrese sus nombres.(solamente letras)' pattern='[a-zA-Z ]{1,50}' maxlength='50' value='".$consulta['Nombres']."'>
                              ";
                                  ?>

                                  </div>
                            </div>
                    
                           <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                           <?php
                           echo "<input class='form-control all-elements-tooltip' type='text' readonly='readonly' placeholder='Apellidos' required name='apellidoC' data-toggle='tooltip' data-placement='top' title='Ingrese sus apellido(solamente letras)' pattern='[a-zA-Z ]{1,50}'' maxlength='50' value='".$consulta['Apellidos']."'>";

                           ?>
                            
                                
                              </div>
                            </div>
                         
                          <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>

                                <input class="form-control all-elements-tooltip" type="text" placeholder="Ingrese su documento"  data-toggle="tooltip" data-placement="top" title="Ingrese su número de Documento." maxlength="10" minlength="8" required name="cedulaC" pattern="[0-9-]{8-10}">
                              </div>
                            </div>
                           
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                <?php
                                  echo "<input class='form-control all-elements-tooltip' type='email' placeholder='E-mail' readonly='readonly' required name='emailC' data-toggle='tooltip' data-placement='top' title='Ingrese la dirección de su Email' maxlength='50' value ='".$_SESSION['nombreUser']."'>";
                                ?>
                                
                              </div>
                            </div>

                            
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="Telefono o celular"  data-toggle="tooltip" data-placement="top" title="Ingrese su número de Telefono o celular." maxlength="10" minlength="8"  name="telefonoC" pattern="[0-9-]{8-10}">
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                <select class="form-control" id="cbx-dep" name="depCl" >
                                    <option value="0">Seleccionar Departamento</option>
                                     <?php 
                                        $dep=  ejecutarSQL::consultar("select * from departamentos order by departamento ASC");
                                        while($d=$dep->fetch_assoc()){
                                            echo '<option value="'.$d['id_departamento'].'">'.utf8_encode($d["departamento"]).'</option>';
                                        }
                                    ?>
                                  </select>
                               
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                <select class="form-control" id="cbx-mun" name="cbx-mun" >
                                    <option value="0">Seleccionar Municipio</option>
                                     
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-home"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="Dirección" requerid name="direccionC" maxlength="50" data-toggle="tooltip" data-placement="top" title="Espeficique su dirección">
                                
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-credit-card"></i></div>
                                <select class="form-control" id="cbx-dep" name="depC" >
                                    <option value="0">Forma de pago</option>
                                     <?php 
                                        $dep=  ejecutarSQL::consultar("select * from forma_pago ");
                                        while($d=$dep->fetch_assoc()){
                                            echo '<option value="'.$d['Id_forma'].'">'.utf8_encode($d["forma"]).'</option>';
                                        }
                                    ?>
                                  </select>
                               
                              </div>
                            </div>
                                        <input type="hidden"  name="clien-number" value="notlog">
                                        <?php
                                        echo "<input type='hidden'  name='prodCodigo' value='".$codigoProdicto."' >";
                                        ?>
                                        <br>
                                        <p id="confirmar" class="text-center"><button class="btn btn-success" type="submit">Comprar YA</button></p>
                                    
                                
                           
                            <div class="ResForm" style="width: 100%; text-align: center; margin: 0;"></div>
                        </form>
                    </div>
                    
                

                                     
            </div>
        </div>
    </section>
    <?php include ("./titulos/footer.php"); ?>

</body>
</html>