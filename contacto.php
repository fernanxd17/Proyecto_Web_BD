

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Contáctenos</title>
    <?php include("./modelo/consulSQL.php"); ?>
    <?php include ("./titulos/link.php"); ?>
     <?php include ("./titulos/barnav.php"); ?>

   
</head>
<body id="container-page-index">
  <div class="modal fade modal-msj" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="padding: 20px;">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <br>
            <p class="text-center"><i class="fa fa-shopping-cart fa-5x"></i></p>
            <p class="text-center">El mensaje ha sido enviado a los administradores</p>
            <p class="text-center"><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button></p>
          </div>
      </div>
    </div>
    <section id="container-pedido">

           <div class="container">
            <div class="row">
                <div class="page-header">
                  <h1>Registro de usuarios <small class="tittles-pages-logo">VentaCOL</small></h1>
                </div>
                <div class="col-xs-12 col-sm-6 text-center">
                   <br><br><br>
                    <p><i class="fa fa-users fa-5x"></i></p>
                    <p class="lead">
                        Al enviar el mensaje este llegara a un administrador el cual le dara respuesta a su solicitud. 
                        esta llegara su email en el plazo maximo de 3 dias.
                    <br>
                    <img src="assets/img/contacto.png" alt="electrodomesticos" class="img-responsive">
                </div>

                <div class="col-xs-12 col-sm-6">
                   <br><br>
                    <div id="container-form">
                       <p style="color:#fff;" class="text-center lead">Digite sus Datos Personales</p>
                       <br><br>
                       <form class="form-horizontal FormCatElec" data-form="save">

                           <div class="form-group">
                               <p style="color:#fff;">Digite su nombre y apellido*</p>
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input placeholder="nombres y apellidos" class="form-control all-elements-tooltip" type="text"  required name="nombreC" data-toggle="tooltip" data-placement="top" title="Ingrese sus nombres.(solamente letras)" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                              </div>
                            </div>
                           
                            <div class="form-group">
                              <p style="color:#fff;">Digite su telefono o celular</p>
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-mobile"></i></div>
                                <input class="form-control all-elements-tooltip" type="tel"  placeholder ="telefono"  name="telefono" data-toggle="tooltip" data-placement="top" title="Ingrese su telefono" pattern="[0-9]" maxlength="10">
                              </div>
                            </div>
                         
                            <div class="form-group">
                              <p style="color:#fff;">Digite su E-mail*</p>
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-at"></i></div>
                                <input class="form-control all-elements-tooltip" type="email" placeholder="E-mail" required name="emailC" data-toggle="tooltip" data-placement="top" title="Ingrese la dirección de su Email" maxlength="50">
                              </div>
                            </div>

                            <div class = "form-group">
                              <p style="color:#fff;">Por favor, sea especifico en su mensaje*</p>
                              <div class = "input-group">
                                <textarea placeholder="Mensaje..." required name="input_4" id="input_1_4" class="textarea medium" tabindex="5" aria-required="true" aria-invalid="false" rows="10" cols="76"></textarea>

                              </div>
                              </div>

                            <br>
                            <p><button type="submit" class="btn btn-success botonmsj"><i class="fa fa-pencil"></i>&nbsp; Enviar Mensaje</button></p>
                            <div class="ResForm" style="width: 100%; color: #fff; text-align: center; margin: 0;"></div>
                        </form> 
                    </div> 
                </div>
            </div>
        </div>
    </section>
    <?php include ("./titulos/footer.php"); ?>

</body>
</html>