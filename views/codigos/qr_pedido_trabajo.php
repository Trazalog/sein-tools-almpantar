<style>
     #numero_orden{
        margin-top: -1%;
        font-size: 60px ;
        } 

    
              #imagenYudi{
                margin-top: -20% ;
                width: 80px;
                height: 40px;
              }   

              #contenedorImagenYudi{
                padding-top: -20% ;
                padding-left: 72% ;
                padding-bottom: 0% ;
              } 

             #tabla  {
              margin-top: -20%;
              width: 250px ;
              height: 100px ;
              border: 1px solid #000 ;
              font-size: 16px ;
              } 

              #codigoImage{
                padding-top: -20% ;
                 padding-bottom: 0% ; 
                padding-left: 70% ;
              }
           

</style>
<div class='row'>
	<div class='col-md-6 col-sm-6 col-xs-6'>
		<p id='numero_orden'><?php echo " ".$N_orden; ?></p>
	</div>
				<!-- <div class='col-md-8 col-sm-8 col-xs-12'> -->
	<div class='col-md-6 col-sm-6 col-xs-6' id='contenedorImagenYudi'>
		<img src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="180" height="50" id='imagenYudi'>
	</div>

</div>
<div class='col-md-6 col-sm-6'>	
<table class="table table-hover table-bordered table-sm" id="tabla">
<thead>
  <tr>
    <td class='thead-dark'><strong>Cliente</strong></td>
    <td class='thead-dark'><strong><p><?php echo $Cliente ?></p></strong></td>
  </tr>
</thead>
<tbody>
  <tr>	
    <td class='thead-dark'><strong>Zona</strong></td>
    <td class='thead-dark'><strong><?php echo $Zona ?></strong></td>
  </tr>
  <tr>
    <td class='thead-dark'><strong>Medida</strong></td>
    <td class='thead-dark'><strong><?php echo $Medida ?></strong></td>
  </tr>
  <tr>
    <td class='thead-dark'><strong>Marca</strong></td>
    <td class='thead-dark'><strong><?php echo $Marca ?></strong></td>
  </tr>
  <tr>
    <td class='thead-dark'><strong>Banda</strong></td>
    <td class='thead-dark'><strong><?php echo $Banda ?></strong></td>
  </tr>
  <tr>
    <td class='thead-dark'><strong>Serie / N° interno</strong></td>
    <td class='thead-dark'><strong><?php echo $Serie ?></strong></td>
  </tr>
  <tr>
    <td class='thead-dark'><strong>Trabajo</strong></td>
    <td class='thead-dark'><strong><?php echo $Trabajo ?></strong></td>
  </tr>
  <tr>
    <td class='thead-dark'><strong>Cantidad</strong></td>
    <td class='thead-dark'><strong><?php echo $Num ?></strong></td>
  </tr>
</tbody>
</table>
</div>