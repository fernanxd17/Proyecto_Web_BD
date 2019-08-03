<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset ="UTF-8">
    <title>Registro</title>
    <?php include ("titulos/link.php"); ?>
    
</head>
<body id="container-page-registration">
    <?php include ("titulos/barnav.php"); ?>
    <section id="form-registration">
        <div class="container">
            <div class="row">
                <div class="page-header">
                  <h1>Registro de usuarios <small class="tittles-pages-logo">VentaCOL</small></h1>
                </div>
                <div class="col-xs-12 col-sm-6 text-center">
                   <br><br><br>
                    <p><i class="fa fa-users fa-5x"></i></p>
                    <p class="lead">
                        Al registrarse recibira notificaciones de nuestros productos y ofertas más recientes en nuestra tienda. Ademas al hacer una compra el proceso sera mas rapido.
                    </p>
                    <br>
                    <img src="assets/img/img-registration.png" alt="electrodomesticos" class="img-responsive">
                </div>

                <div class="col-xs-12 col-sm-6">
                   <br><br>
                    <div id="container-form">
                       <p style="color:#fff;" class="text-center lead">Debera de llenar todos los campos para registrarse</p>
                       <br><br>
                       <form class="form-horizontal FormCatElec" action="controller/regclien.php" role="form" method="post" data-form="save">

                           <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="nombres" required name="nombreC" data-toggle="tooltip" data-placement="top" title="Ingrese sus nombres.(solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                              </div>
                            </div>
                           
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input class="form-control all-elements-tooltip" type="text" placeholder="Apellidos" required name="apellidoC" data-toggle="tooltip" data-placement="top" title="Ingrese sus apellido(solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                              </div>
                            </div>
                         
                            <div class="form-group">
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                <input class="form-control all-elements-tooltip" type="email" placeholder="E-mail" required name="emailC" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de su Email" maxlength="50">
                              </div>
                            </div>

                            
                            <div class = "form-group">
                             <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                <input class="form-control all-elements-tooltip" type="password" placeholder="Contraseña" required name="claveC" minlength = "8" maxlength="8"  data-toggle="tooltip" data-placement="top" title="Ingrese su nueva contraseña para iniciar sesión">
                              </div>
                            </div>

                           
                                
                                <input  type="checkbox" title="Por favor, acepter los terminos y condiciones" required name="terminos"><p style="color:#fff;" >Aceptar Terminos y condiciones</p> </input>
                              

                            <br>
                            <p><button type="submit" class="btn btn-success btn-block"><i class="fa fa-pencil"></i>&nbsp; Registrarse</button></p>
                            <div class="ResForm" style="width: 100%; color: #fff; text-align: center; margin: 0;"></div>
                        </form> 
                    </div> 
                </div>
            </div>
        </div>
    </section>
    <?php include ("titulos/footer.php"); ?>
</body>
</html>