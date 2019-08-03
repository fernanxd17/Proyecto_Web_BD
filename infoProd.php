<?php

include 'modelo/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Productos</title>
    <?php include 'titulos/link.php'; ?>
</head>
<body id="container-page-product">
    <?php include 'titulos/barnav.php'; ?>
    <section id="infoproduct">
        <div class="container">
            <div class="row">
                <div class="page-header">
                    <h1>Tienda <small class="tittles-pages-logo">VentaCOL</small></h1>
                </div>
                <?php 
                    $CodigoProducto=$_GET['CodigoProd'];

                    $productoinfo=  ejecutarSQL::consultar("select * from producto where Cod_producto=".$CodigoProducto);
                   
                    while($fila=$productoinfo->fetch_assoc()){
                         
                         
                            
                        echo '
                            <div class="col-xs-12 col-sm-6">
                                <h3 class="text-center">Información de producto</h3>
                                <br><br>
                                <h4><strong>Nombre: </strong>'.$fila['Nombre'].'</h4><br>
                          
                                <h4><strong>Marca: </strong>'.$fila['Marca'].'</h4><br>
                                <h4><strong>Precio: </strong>$'.$fila['Precio'].'</h4>
                                <br>
                                <h4><strong>Descripcion: </strong>'.$fila['Descripcion'].'</h4>


                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <br><br><br>
                                <img class="img-responsive" src="assets/img-products/'.$fila['Imagen'].'">
                            </div>
                            <br><br><br>
                            <div class="col-xs-12 text-center">
                                <a href="product.php" class="btn btn-lg btn-primary"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;Regresar a la tienda</a> &nbsp;&nbsp;&nbsp; 
                                <button value="'.$fila['Cod_producto'].'" class="btn btn-lg btn-success botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; Añadir al carrito</button>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </section>
    <?php include 'titulos/footer.php'; ?>
</body>
</html>