<?php
    
    include ("modelo/consulSQL.php");
    include ("controller/securityPanel.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Admin</title>
    <?php include ("titulos/link.php"); ?>
    <script type="text/javascript" src="js/admin.js"></script>
     <script language="javascript">
    $(document).ready(function(){
        $("#cbx-dep").change(function(){

          $("#cbx-dep option:selected").each(function() {

            id_departamento = $(this).val();
            $.post("library/getMunicipio.php",{ id_departamento: id_departamento

            }, function(data){

              $("#cbx-mun").html(data);
            });
          });
      })

    });
  </script>
</head>
<body id="container-page-configAdmin">
    <?php include ("titulos/barnav.php"); ?>
    <section id="prove-product-cat-config">
        <div class="container">
            <div class="page-header">
              <h1>Panel de administración <small class="tittles-pages-logo">VentaCOL</small></h1>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#Productos" role="tab" data-toggle="tab">Productos</a></li>
             
              <li role="presentation"><a href="#Categorias" role="tab" data-toggle="tab">Categorías</a></li>

              <li role="presentation"><a href="#Proveedores" role="tab" data-toggle="tab">Proveedores</a></li>
              <!--<li role="presentation"><a href="#Admins" role="tab" data-toggle="tab">Admin</a></li>-->
              <!--<li role="presentation"><a href="#Pedidos" role="tab" data-toggle="tab">Pedidos</a></li>-->
            </ul>
            <div class="tab-content">
                <!--*****Panel productos*****-->
                <div role="tabpanel" class="tab-pane fade in active" id="Productos">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-product">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un producto nuevo</h2>
                         
                            <form role="form" action="controller/regproduct.php" method="post" enctype="multipart/form-data">
                              
                              <div class="form-group">
                                <label>Nombre de producto</label>
                                <input type="text" class="form-control"  placeholder="Nombre" required maxlength="30" name="nombreProd">
                              </div>

                               <div class="form-group">
                                <label>Marca</label>

                                <select class="form-control" name="marcaProd">
                                    <?php

                                $consulta= ejecutarSQL::consultar("select * from proveedor"); 
                            echo '<option value="0">Seleccione Marca</option>';
                        while($marca=$consulta->fetch_assoc()){
                            echo '<option value="'.$marca['Nombre'].'">'.$marca['Nombre'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Precio</label>
                                <input type="text" class="form-control"  placeholder="Precio" required maxlength="20" pattern="[0-9]{1,20}" name="precioProd">
                              </div>

                              <div class="form-group">
                                <label>Categoría</label>
                                <select class="form-control" name="categoriaProd">
                                    <?php

                  $consulta= ejecutarSQL::consultar("select * from tipo_producto"); 
                            
                        while($catec=$consulta->fetch_assoc()){
                            echo '<option value="'.$catec['id_tipo'].'">'.$catec['tipo'].'</option>';
                                        }
                                    ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Descripcion de producto</label>
                                <input type="text" class="form-control"  placeholder="Descripcion" required maxlength="100" name="descripcionProd">
                              </div>
                             
                              <div class="form-group">
                                <label>Imagen de producto</label>
                                <input type="file" name="img">
                                <p class="help-block">Formato de imagenes admitido png, jpg, gif, jpeg</p>
                              </div>
                                <input type="hidden"  name="admin-name" value="<?php echo $_SESSION['nombreAdmin'] ?>">
                              <p class="text-center"><button type="submit" class="btn btn-primary">Agregar 
                              a la tienda</button></p>
                              <div id="res-form-add" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-prod-form">

                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un producto</h2>
                           
                             <form action="controller/eliminarprod.php" method="post" role="form">
                                 <div class="form-group">
                                     <label>Productos</label>
                                     <select class="form-control" name="Cod_producto">
                                         <?php 
                                          
                                          $resultado=  ejecutarSQL::consultar("select * from producto");

                                         
                                           
                                             while($prodc=$resultado->fetch_assoc()){
                                                 echo '<option value="'.$prodc['Cod_producto'].'">'.$prodc['Nombre'].' - '.$prodc['Marca'].'</option>';
                                             }
                                         ?>
                                     </select>
                                 </div>
                                 <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar</button></p>
                                 <br>
                                 <div id="res-form-del-prod" style="width: 100%; text-align: center; margin: 0;"></div>
                             </form>
                         </div>
                    </div>
                    <div class="col-xs-12">
                        <br><br>
                        <div class="panel panel-info">
                            <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar datos de producto</h3></div>
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead class="">
                                      <tr>
                                          
                                           <th class="text-center">Nombre Actual</th>
                                          <th class="text-center">Nombre Nuevo</th>
                                          <th class="text-center">Precio ($)</th>
                                          <th class="text-center">Precio Nuevo ($)</th>
                                          <th class="text-center">Marca</th>
                                          <th class="text-center">Marca Nueva</th>
                                          <th class="text-center">Descripción</th>
                                          <th class="text-center">Descripción Nueva</th>
                                          <th class="text-center">Opciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                  
                  $resultado= ejecutarSQL::consultar("select * from  producto");
                                       
                                       
                                        $upr=1;
                                        while($prod=$resultado->fetch_assoc()){
                                         
                                            echo '

                                                <div id="update-product">
                                                  <form method="post" action="controller/actualizarProducto.php" id="res-update-product-'.$upr.'">
                                                    <tr>
                                                       
                                                       <td><input class="form-control" readonly="readonly" type="text" name="nombrePA"  value="'.$prod['Nombre'].'"></td>

                                                        <td><input class="form-control" type="text" placeholder="Solo si desea modificar" name="nombreP" maxlength="30"  ></td>
                                                      

                                                         <td><input class="form-control" type="text"
                                                         readonly="readonly"  name="precioPA"  value='.$prod['Precio'].'></td>

                                                        <td><input class="form-control" placeholder="Solo si desea modificar" type="text" name="precioP"  ></td>


                                                        <td><input class="form-control" type="text" name="marcaPA" readonly="readonly" value='.$prod['Marca'].'></td>

                                                        <td><input class="form-control" type="text" name="marcaP" 
                                                        placeholder="Solo si desea modificar" ></td>

                                                          <td><input class="form-control" type="text" name="descripcionPA" readonly="readonly" value='.$prod['Descripcion'].'></td>

                                                        <td><input class="form-control" type="text" name="descripcionP" 
                                                        placeholder="Solo si desea modificar" ></td>
                                                          ';
                                                        
                  echo'
                                                        
                                                        
                                                       
                                                        <td class="text-center">
                                                            <button type="submit" class="btn btn-sm btn-primary button-UPR" value="res-update-product-'.$upr.'">Actualizar</button>
                                                            <div id="res-update-product-'.$upr.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                        </td>
                                                    </tr>
                                                  </form>
                                                </div>
                                                ';
                                            $upr=$upr+1;
                                        }
                                      ?>
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                </div>
                </div>
                



                <!--*******Panel Categorias*******-->
                <div role="tabpanel" class="tab-pane fade" id="Categorias">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="add-categori">
                                <h2 class="text-info text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar categoría</h2>
                                 
                                <form action="controller/agregarCategoria.php" method="post" role="form">
                                   
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input class="form-control" type="text" name="nombreCatg" placeholder="Nombre de categoria" maxlength="30" required="">
                                    </div>
                                    
                                    <p class="text-center"><button type="submit" class="btn btn-primary">Agregar categoría</button></p>
                                    <br>
                                    <div id="res-form-add-categori" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <br><br>
                            <div id="del-categori">
                                <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar una categoría</h2>

                                <form action="controller/elimCategoria.php" method="post" role="form">
                                    <div class="form-group">
                                        <label>Categorías</label>
                                        <select class="form-control" name="codCatg">
                <?php 
                    
                     $categoriav=  ejecutarSQL::consultar("select * from tipo_producto");
                                                while($categv=$categoriav->fetch_assoc()){
                                                    echo '<option value="'.$categv['id_tipo'].'">'.$categv['id_tipo'].' - '.$categv['tipo'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar categoría</button></p>
                                    <br>
                                    <div id="res-form-del-cat" style="width: 100%; text-align: center; margin: 0;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <br><br>
                            <div class="panel panel-info">
                                <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar categoría</h3></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="">
                                            <tr>
                                             
                                            <th class="text-center">Nombre Actual</th>
                                            <th class="text-center">Nombre Nuevo</th>
                                            <th class="text-center">Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                <?php
                
          $categorias=  ejecutarSQL::consultar("select * from tipo_producto");
                                              $ui=1;
                                              while($cate=$categorias->fetch_assoc()){
                                                  echo '
                                                      <div id="update-category">
                                                        <form method="post" action="controller/actualizarCategoria.php" id="res-update-category-'.$ui.'">
                                                          <tr>
                                                               <td><input class="form-control" type="text" name="nombreA" readonly="readonly" value='.$cate['tipo'].'></td>

                                                              <td>
                                                                <input class="form-control" type="text" name="nombre" placeholder="Solo si desea modificar">
                                                                
                                                              </td>

                                                              
                                                              
                                                              <td class="text-center">
                                                                  <button type="submit" class="btn btn-sm btn-primary button-UC" value="res-update-category-'.$ui.'">Actualizar</button>
                                                                  <div id="res-update-category-'.$ui.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                  $ui=$ui+1;
                                              }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>

                <!-- proveedores -->

                <div role="tabpanel" class="tab-pane fade" id="Proveedores">
                    <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="add-provee">
                            <h2 class="text-primary text-center"><small><i class="fa fa-plus"></i></small>&nbsp;&nbsp;Agregar un proveedor</h2>
                            <form action="controller/regprove.php" method="post" role="form">
                                <div class="form-group">
                                    <label>NIT</label>
                                    <input class="form-control" type="text" name="prove-nit" placeholder="NIT proveedor" maxlength="10" required="">
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" name="prove-name" placeholder="Nombre proveedor" maxlength="50" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input class="form-control" type="tel" name="prove-tel" placeholder="Número telefónico" pattern="[0-9]{1,20}" maxlength="10" required="">
                                </div>
                                <div class="form-group">
                                    <label>Página web</label>
                                    <input class="form-control" type="text" name="prove-web" placeholder="Página web proveedor" required="">
                                </div>
                                <p class="text-center"><button type="submit" class="btn btn-primary">Añadir proveedor</button></p>
                                <br>
                                <div id="res-form-add-prove" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <br><br>
                        <div id="del-prove">
                            <h2 class="text-danger text-center"><small><i class="fa fa-trash-o"></i></small>&nbsp;&nbsp;Eliminar un proveedor</h2>
                            <form action="controller/delprove.php" method="post" role="form">
                                <div class="form-group">
                                    <label>Proveedores</label>
                                    <select class="form-control" name="nit-prove">
                                        <?php 
                                            $proveNIT=  ejecutarSQL::consultar("select * from proveedor");
                                            while($PN=$proveNIT->fetch_assoc()){
                                                echo '<option value="'.$PN['NIT'].'">'.$PN['NIT'].' - '.$PN['Nombre'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <p class="text-center"><button type="submit" class="btn btn-danger">Eliminar proveedor</button></p>
                                <br>
                                <div id="res-form-del-prove" style="width: 100%; text-align: center; margin: 0;"></div>
                            </form>
                        </div>    
                    </div>
                    <div class="col-xs-12">
                        <br><br>
                        <div class="panel panel-info">
                            <div class="panel-heading text-center"><i class="fa fa-refresh fa-2x"></i><h3>Actualizar datos de proveedor</h3></div>
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead class="">
                                      <tr>
                                          <th class="text-center">NIT</th>
                                          <th class="text-center">Nombre Actual</th>
                                          <th class="text-center">Nombre Nuevo</th>
                                          <th class="text-center">Telefono Actual</th>
                                          <th class="text-center">Telefono Nuevo</th>
                                        <th class="text-center">Sitio web Actual</th>
                                          <th class="text-center">Sitio web Nuevo</th>
                                          <th class="text-center">Opciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                              $proveedores=  ejecutarSQL::consultar("select * from proveedor");
                                              $up=1;
                                              while($prov=$proveedores->fetch_assoc()){
                                                  echo '
                                                      <div id="update-proveedor">
                                                        <form method="post" action="controller/updateProveedor.php" id="res-update-prove-'.$up.'">
                                                          <tr>
                                                              <td>
                                                                <input class="form-control" type="text" name="nit" readonly="readonly" value="'.$prov['NIT'].'">
                                                                </td>


                                                              <td><input class="form-control" type="text" name="nombreA" maxlength = "50"   
                                                              readonly = "readonly" value="'.$prov['Nombre'].'"></td>

                                                              <td><input class="form-control" type="text-area" name="nombre"  placeholder="Solo si desea modificar" maxlength="25"
                                                              ></td>

                                                              <td><input class="form-control" type="tel" name="telefonoA" readonly="readonly"  value="'.$prov['Telefono'].'" </td>

                                                               <td><input class="form-control" type="tel" name="telefono" placeholder="Solo si desea modificar"  value="" </td>

                                                              <td><input class="form-control" type="text-area" name="sitioA"  readonly = "readonly" value="'.$prov['SitioWeb'].'"></td>

                                                              <td><input class="form-control" type="text" name="sitio"  maxlength="25" placeholder="Solo si desea modificar"></td>
                                                              <td class="text-center">

                                                                  <button type="submit" class="btn btn-sm btn-primary button-UP" value="res-update-prove-'.$up.'">Actualizar</button>
                                                                  <div id="res-update-prove-'.$up.'" style="width: 100%; margin:0px; padding:0px;"></div>
                                                              </td>
                                                          </tr>
                                                        </form>
                                                      </div>
                                                      ';
                                                  $up=$up+1;
                                              }
                                            ?>
                                  </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                </div>
                </div>
                <!--*****Agregar Administrador*****-->
               

               
                <!--*****Panel pedidos*****-->
                
            </div>
        </div>
    </section>
    <?php include ("titulos/footer.php"); ?>
</body>
</html>