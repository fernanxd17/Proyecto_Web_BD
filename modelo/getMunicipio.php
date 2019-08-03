<?php
     
   include 'consulSQL.php';

    $id_departamento = $_POST['id_departamento'];
  

        
        $consulta= ejecutarSQL::consultar("select id_municipio, municipio from municipios where departamento_id = '$id_departamento' order by municipio ASC");
        
       $html  ="<option value='0'>Seleccionar Municipio</option>";
  		while($rowM = $consulta->fetch_assoc()){
  			$html = $html."<option value='".$rowM['id_municipio']."'>".utf8_encode($rowM['municipio'])."</option>";
  		}

  		echo $html;
?>

