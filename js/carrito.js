$(document).ready(function() {
    $('#carrito-compras-tienda').load("controller/carrito.php");
   
    $(".botonCarrito").click(function(){
        $('#carrito-compras-tienda').load("controller/carrito.php?precio="+$(this).val()); //lo añade a la tabla
                                                                                        //del carrito en la bara
        $('.modal-carrito').modal('show'); //muestra el anuncio de que el producto ha sido añadido
    });
    $(".carrito-button-nav").click(function(){ //si esta logeado como administrador

    	
    	
        $("#container-carrito-compras").animate({height: 'toggle'},200); //muestra la imagen
    });
});
