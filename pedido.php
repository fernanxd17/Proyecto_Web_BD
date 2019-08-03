

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Pedido</title>
    <?php include("./modelo/consulSQL.php"); ?>
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


             </div>

                <div class="col-xs-12 col-sm-6">
                    <div id="form-compra">
                        <form action="controller/validarDatos.php" method="post" role="form" class="FormCatElec" data-form="save">
                            <?php
                                if(!$_SESSION['nombreUser']=="" &&!$_SESSION['claveUser']==""){
                                    echo '
                                        <script> location.href="caja.php"; </script>
                                    ';
                                }else{
                                    echo '
                                        <h3 class="text-center">¿Confirmar el pedido?</h3>
                                        <p>
                                            ACCEDE A TU CUENTA DE
                                              <span class="tittles-pages-logo">VentaCOL</span>.o  <a href="registration.php"> registrate. </a>
                                        </p>

                                         <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                <input class="form-control all-elements-tooltip" type="email" placeholder="E-mail" required name="emailC" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de su Email" maxlength="50">
                              </div>
                            </div>

                            <div class = "form-group">
                             <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                <input class="form-control all-elements-tooltip" type="password" placeholder="Contraseña" required name="claveC" minlength = "8" maxlength="8"  data-toggle="tooltip" data-placement="top" title="Ingrese su  contraseña para iniciar sesión">
                              </div>
                            </div>

                            <input type="hidden"  name="clien-number" value="notlog">
                                      <br>
                                      <p class="text-center"><button class="btn btn-success" type="submit">Ingresar</button></p>
                                        
                                      ';}
                            ?>
                            <div class="ResForm" style="width: 100%; text-align: center; margin: 0;"></div>
                        </form>
                    </div>
                    
                

                                     
            </div>
        </div>
    </section>
    <?php include ("./titulos/footer.php"); ?>

</body>
</html>