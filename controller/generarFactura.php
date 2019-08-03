
<?php 
session_start();
error_reporting(E_PARSE);
include ("../modelo/consulSQL.php");
		
	$fecha=strftime( "%d/%m/%Y", time() );
			$html = '<header class="clearfix">
      <div id="logo">
        <img src="../modelo/reportes/img/logo.png">
      </div>
      <div id="company">
        <h2 class="name">VentaCOL</h2>
        <div>455 Foggy Heights, AZ 85004, CO</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:ventacol@gmail.com">ventacol@gmail.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">FACTURAR A:</div>
          <h2 class="name">'.$_SESSION['nombre'].'</h2>
          <div class "address">CC.'.$_SESSION['cedula'].'</h2>
          <div class="address">'.$_SESSION['direccion'].'</div>
          <div class="email"><a href="mailto:john@example.com">'.$_SESSION['email'].'</a></div>
        </div>
        <div id="invoice">
          <h1>FACTURA '.$_SESSION['compra'].'</h1>
          <div class="date">Fecha de Factura: '.$fecha.'</div>
          <div class="date">
          Vence: 13/12/2017</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">PRODUCTO</th>
            <th class="unit">PRECIO UNITARIO</th>
            <th class="qty">CANTIDAD</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>';

        $productos = ejecutarSQL::consultar("select * from subcompra where Id_compra =".$_SESSION['compra']."");
        $i = 1;
        $total = 0;
        while($fila = $productos->fetch_assoc()){


        	$producto = ejecutarSQL::consultar("select * from producto where Cod_producto='".$fila['Cod_Producto']."'");
        	$producto = $producto->fetch_assoc();
        	$html =$html."<tr>
            <td class='no'>".$i."</td>
            <td class='desc'><h3>".$producto['Nombre']."</h3></td>
            <td class='unit'>$".$producto['Precio']."</td>
            <td class='qty'>".$fila['Cantidad']."</td>
            <td class='total'>$".$fila['PrecioTotal']."</td>
          </tr>";
          $total += $fila['PrecioTotal'];
          $i++;
        }

          
          $html= $html."
        </tbody>
        <tfoot>
          <tr>
            <td colspan='2'></td>
            <td colspan='2'>SUBTOTAL</td>
            <td>$".$total."</td>
          </tr>
          
          <tr>
            <td colspan='2'></td>
            <td colspan='2'>TOTAL</td>
            <td>$".$total."</td>
          </tr>
        </tfoot>
      </table>
      <div id='thanks'>Gracias!</div>
      <div>--------------------------------------------------------------------</div>
      <div id='notices'>
        <div>NOTICE:</div>
        <div class='notice'>Pagar en el Banco de Bogota no.0035241252.</div>

      </div>
    </main>";
    require ('../modelo/pdf/mpdf.php');

    $mpdf = new mPDF('c','A4');

	$cs = file_get_contents('../modelo/reportes/css/style.css');

	$mpdf->writeHTML($cs,1);
		
	$mpdf->writeHTML($html);
		
	
	$mpdf->Output('factura.pdf','I');
		
		





 ?>