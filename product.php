<?php

include ("./modelo/consulSQL.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Productos</title>
    <meta charset="UTF-8">
    <?php include ("./titulos/link.php"); ?>
</head>
<body id="container-page-product">
    <?php include ("./titulos/barnav.php"); ?>
    <section id="store">
       <br>
        <div class="container">
            <div class="page-header">
              <h1>Tienda <small class="tittles-pages-logo">VentaCOL</small></h1>
            </div>
            <br><br>
            <div class="row">
                <div class="col-xs-12">
                    <ul id="store-links" class="nav nav-tabs" role="tablist">
                      <li role="presentation"><a href="#all-product" role="tab" data-toggle="tab" aria-controls="all-product" aria-expanded="false">Todos los productos</a></li>
                      <li role="presentation" class="dropdown active">
                        <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="false">Categorías <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                          <!--  Lista categorias  -->
                          <?php

                         $consulta= ejecutarSQL::consultar("select * from tipo_producto");
                 
                            while($cate=$consulta->fetch_assoc()){
                                echo '
                                    <li>
                                        <a href="#'.$cate['id_tipo'].'" tabindex="-1" role="tab" id="'.$cate['tipo'].'-tab" data-toggle="tab" aria-controls="'.$cate['id_tipo'].'" aria-expanded="false">'.$cate['tipo'].'
                                        </a>
                                    </li>';
                            }
                          ?>
                          
                        </ul>
                      </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade" id="all-product" aria-labelledby="all-product-tab">
                          <br><br>
                        <div class="row">
                        <?php
                       $consulta= ejecutarSQL::consultar("select * from producto");
                         
                           
                            $totalproductos = mysqli_num_rows($consulta);
                            if($totalproductos>0){
                                while($fila=$consulta->fetch_assoc()){
                                   echo '
                                  <div class="col-xs-12 col-sm-6 col-md-4">
                                       <div class="thumbnail">
                                         <img src="assets/img-products/'.$fila['Imagen'].'">
                                         <div class="caption">
                                           <h3>'.$fila['Marca'].'</h3>
                                           <p>'.$fila['Nombre'].'</p>
                                           <p>$'.$fila['Precio'].'</p>
                                           <p class="text-center">
                                               <a href="infoProd.php?CodigoProd='.$fila['Cod_producto'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                               <button value="'.$fila['Cod_producto'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                           </p>

                                         </div>
                                       </div>
                                   </div>     
                                   ';
                               }   
                            }else{
                                echo '<h2>No hay productos en esta categoria</h2>';
                            }  
                        ?>
                        </div>
                      </div>
                      
                      <!-- Categorias  -->
                      <?php
                      $cone = ejecutarSQL::consultar("select * from tipo_producto");
                          
                          
                        
                        while($categ=$cone->fetch_assoc()){
                            echo '<div role="tabpanel" class="tab-pane fade active in" id="'.$categ['id_tipo'].'" aria-labelledby="'.$categ['id_tipo'].'-tab"><br>';
                                $coneAux = ejecutarSQL::consultar("select * from producto where Tipo_Producto='".$categ['id_tipo']."'");
                          
                          
                                
                                $totalprod = mysqli_num_rows($coneAux);
                                if($totalprod>0){
                                   while($prod=$coneAux->fetch_assoc()){
                                      echo '
                                        <div class="col-xs-12 col-sm-6 col-md-4">
                                             <div class="thumbnail">
                                               <img src="assets/img-products/'.$prod['Imagen'].'">
                                               <div class="caption">
                                                 <h3>'.$prod['Marca'].'</h3>
                                                 <p>'.$prod['Nombre'].'</p>
                                                 <p>$'.$prod['Precio'].'</p>
                                                 <p class="text-center">
                                                     <a href="infoProd.php?CodigoProd='.$prod['Cod_producto'].'" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                                     <button value="'.$prod['Cod_producto'].'" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                                 </p>

                                               </div>
                                             </div>
                                         </div>     
                                         ';    
                                   } 
                                } else {
                                   echo '<h2>No hay productos en esta categoría</h2>'; 
                                }
                            echo '</div>'; 
                        }
                      ?>
                      
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include ("./titulos/footer.php"); ?>
    <script>
        $(document).ready(function() {
            $('#store-links a:first').tab('show');
        });
    </script>
</body>
</html>