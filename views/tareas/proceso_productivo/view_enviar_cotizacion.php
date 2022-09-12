<style>
.fa-edit{
  transform:scale(1.6);
}
input[type=radio]{
  transform:scale(1.6);
}
</style>
<hr>
<?php 


 
// funcion que desplega formulario asociado a la vista
// los formularios dinamicos se cargar de la tabla pro.procesos_forms
$aux =json_decode($data);

$cotizacion = $aux->cotizacion;

$plazo_entrega = $cotizacion->plazo_entrega;
$unidad_medida_tiempo = $cotizacion->unme_id;
$fopa_id = $cotizacion->fopa_id;
$divi_id = $cotizacion->divi_id;
$coti_id = $cotizacion->coti_id;


$unme_tiempo = str_replace(empresa()."-unme_id", "", $unidad_medida_tiempo);	

$forma_pago = str_replace(empresa()."-fopa_id", "", $fopa_id);	

$divisa = str_replace(empresa()."-divi_id", "", $divi_id);	




if($coti_id){
    $ci =& get_instance();
  // llamo al servicio para traer los Detalles de la cotizacion
    $resource3 = "/getDetalleCotizacion"; 
  
    $deta = $ci->rest->callAPI('GET',REST_SEIN.$resource3."/".$coti_id);
    log_message('DEBUG', 'SEIN - LLAMADA DE EJEMPLO A WSO2 ->' . json_encode($data));   
    

    $aux2 =json_decode($deta['data']);

    $detalles_cotizacion = $aux2->detalles_cotizacion->detalle_cotizacion;
}

$detalles_coti = $detalles_cotizacion;

?>























 <div class="row">
  <div class="col-md-9 col-sm-9">
  <h3>Envio de Cotización<small></small></h3>
<form class="form-inline" id="frm-Cotizacion">
                <fieldset>
           <div class="row">
                <!-- Codigo proyecto-->
                    <div class="col-md-3 espaciado">
                    <label class="control-label" for="cod_proyecto">Código Pedido <strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">
                           
                            <input id="cod_proyecto" name="cod_proyecto" type="text" placeholder="Código Pedido"  minlength="4" maxlength="10" size="12" class="form-control input-md" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->  
                    <!-- Objetivo -->
                    <div class="col-md-3 espaciado">
                    <label class="control-label" for="objetivo">Objetivo<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">
                          
                            <div class="input-group" style="display:inline-flex;">
                                <input id="objetivo_proyecto" name="objetivo_proyecto" type="text" class="form-control input-md" data-bv-notempty readonly>
                            </div>
                            <div class="input-group" style="display:inline-flex;">
                                <input id="unidad_medida_tiempo" name="unidad_medida_tiempo" class="form-control input-md" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" readonly>
                            </div>

                        </div>
                    </div>
                     <!-- ***************** -->  
                     <!-- plazo de entrega -->
                    <div class="col-md-3 espaciado">
                    <label class="control-label" for="plazo_entrega">plazo de entrega<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">
                       
                            <div class="input-group" style="display:inline-flex;">
                            <input id="plazo_entrega" name="plazo_entrega" type="text" class="form-control input-md" value="<?php echo $plazo_entrega; ?>"readonly>
                                <input id="unme_tiempo" name="unme_tiempo" type="text" class="form-control input-md" value="<?php echo $unme_tiempo; ?>"readonly>
                                <!--<select name="unidad_medida_tiempo2" id="unidad_medida_tiempo2" class="form-control" style="width: auto" data-bv-notempty="false" readonly>
                                    <option value="" disabled selected> -Seleccionar- </option>
                                    <option value="dias" disabled selected>diás</option>
                                </select> -->
                            
                            </div>
                        </div>
                    </div>
                    <!-- ***************** -->           
                   

            </div> <!-- end row -->
            <br>   <br>
            <div class="row">
          <!-- Cliente-->
          <div class="col-md-3 espaciado">
                    <label class="control-label" for="nomb_cliente">Cliente <strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex;">
                        <input type="text" class="form-control habilitar" id="nomb_cliente" value="" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->


                    <!-- Direccion Entrega -->
                    <div class="col-md-4 espaciado">
                    <label class=" control-label" for="dir_entrega_cliente" name="">Dirección de Entrega:</label>                                 
                        <div class="form-group">
                           
                            <input type="text" class="form-control habilitar" id="dir_entrega_cliente" value="" readonly>
                        </div>
                    </div>
                    <!-- ***************** --> 
					 <!-- email -->
					 <div class="col-md-3 espaciado">            
           <label class=" control-label" for="email" name="">Email:</label>                                
                        <div class="form-group" style="display:inline-flex;">
                            
                            <input type="text" class="form-control habilitar" id="email_cliente" readonly>
                        </div>
                    </div>
                    <!-- ***************** --> 
					
         </div> <!-- end row -->  
        <br>   <br>
            <div class="row"> 
             <!-- email alternativo -->
					 <div class="col-md-4 espaciado">                
           <label class=" control-label" for="email_alternativo_cliente" name="">Email alternativo:</label>                            
                        <div class="form-group" style="display:inline-flex;">
                          
                            <input type="text" class="form-control habilitar" id="email_alternativo_cliente" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->   
            
                    <!-- forma de pago -->
                    <div class="col-md-4 espaciado">
                    <label class="control-label" for="forma_pago">Forma de pago<strong style="color: #dd4b39">*</strong>:</label>
                    <div class="input-group" style="display:inline-flex;">
                    <input id="forma_pago" name="forma_pago" type="text"  class="form-control input-md" value="<?php echo $forma_pago; ?>" readonly>
                            </div>
                    </div>  
					  <!-- ***************** --> 

                <!-- Divisa -->
                <div class="col-md-3 espaciado">
                <label class="control-label" for="divisa">Divisa<strong style="color: #dd4b39">*</strong>:</label>     
                    <div class="input-group" style="display:inline-flex;">
                    <input id="divisa" name="divisa" type="text"  class="form-control input-md" value="<?php echo $divisa; ?>" readonly>
        
                            </div>
                    </div>  
                     
                   
                    <br>
          </div> <!-- end row -->          
                    <!-- Button -->

                    <br>   <br>

            <div class="col-md-12 col-sm-12 col-xs-12 centrar">
                <h5>Detalles de cotización:</h5>
                <div id="sec_productos">
                    <!-- ______ TABLA PRODUCTOS ______ -->
                    <table id="tabla_detalle" class="table table-bordered table-striped">
                        <thead class="thead-dark" bgcolor="#eeeeee">
                            <!-- <th style="width: 10% !important">Acciones</th> -->
                            <th>Cantidad</th>
                            <th>Descripción</th>
                            <th>P. Unitario</th>
                            <th>Importe</th>
                        </thead>
                        <tbody >
                        <?php
							foreach($detalles_cotizacion as $rsp){


								$cantidad = $rsp->cantidad;
								$descripcion = $rsp->descripcion;
								$precio_unitario = $rsp->precio_unitario;
								$importe = $rsp->importe;
								$coti_id = $rsp->coti_id;
                                $deco_id = $rsp->deco_id;

								echo "<tr id='$coti_id' data-json='" . json_encode($rsp) . "'>";

								// echo "<td class='text-center text-light-blue'>";
								// echo '<i class="fa fa-trash-o" style="cursor: pointer;margin: 3px;" title="Eliminar" onclick="Eliminar(this)"></i>';
								// echo '<i class="fa fa-print" style="cursor: pointer; margin: 3px;" title="Imprimir Comprobante" onclick="modalReimpresion(this)"></i>';
								// echo '<i class="fa fa-search"  style="cursor: pointer;margin: 3px;" title="Ver Pedido" onclick="verPedido(this)"></i>';
								// echo "</td>";
								echo '<td>'.$cantidad.'</td>';
								echo '<td>'.$descripcion.'</td>';
                                echo '<td>'.$precio_unitario.'</td>';
								echo '<td>'.$importe.'</td>';
			            
								echo '</tr>';
						}
						?>  
                        
       
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-7"></div>
                        <div class="col-sm-4">
                            <label class="control-label" for="footer_table">Total:<strong style="color: #dd4b39">*</strong>:</label>     
                            <div class="input-group" style="display:inline-flex;">
                            <input id="footer_table" name="footer_table" type="text" class="form-control input-md" readonly>
                            </div>
                        </div>
                        <div class="col-sm-1"></div
                    </div>
                    <!--_______ FIN TABLA PRODUCTOS ______-->
                </div>
            </div>
    <br><br>
          
                </fieldset>
            </form>                           
   
    </div>
    
    <!-- / Bloque de cotizacion -->

    <!-- Bloque preview cotizacion -->
    <div class="col-md-3 centrar">
      <br><br><br>
     <div class='' id='preview'>
		<img src="<?php echo base_url() ?>imagenes/sein/preview_cotizacion.jpg" alt="sein preview" width="150" height="150" id='imagenSein'>
    <br><br> <br><br>
   <div class="">
   <button type="button" class="btn btn-sucess" title="preview Cotización" ><i class="fa fa-search" aria-hidden="true"></i></button>
    <button type="button" class="btn btn-sucess" title="descargar_Cotización"data-dismiss="modal" id="descargar_Cotización" onclick="verModalCotizacion()"><i class="fa fa-download" aria-hidden="true"></i></button>
   </div>
    <br>

  </div>
  
      </div>
        </div>
  </div>

<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Vendedor realiza el envio de cotización? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"> No
            </label>
        </center>
    </div>
    <br><br><br>
</form>

<script>
function verModalCotizacion() {
    // levanto modal con img de Codigo
    $("#modalCotizacion").modal('show');
}


$('#tabla_detalle').dataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            debugger;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            if (end > 0) {    
            var total = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
                console.log(total);


                if (total > 0) {  
            // Total over this page
            var pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
            }

 console.log(pageTotal);
            // Update footer
            divisa = $('#divisa').val();
            sub_total = divisa +' ' +'$'+pageTotal;
        $('#footer_table').val(sub_total);

            }
             
        }
    } );



  function getFormData(){

    var array_form = {};
    $('#form-dinamico-cabecera').find(':input').each(function() {
      array_form[this.name] = this.value;

      });

    $.each(array_form, function( index, value ) {
        console.log( index + ": " + value );
 
    });
  }

  getFormData();

/// mascaras de input numericos
  $("#cantidad").inputmask({ regex: "[0-9]*" });

  $("#precio_unitario").inputmask({ regex: "[0-9]*" });

  $("#importe").inputmask({ regex: "[0-9]*" });

////////////////////////////////

$('#view').ready(function() {
    wo();
    alertify.success("Cargando datos en la vista aguarde...");
    tomarDatos();
    setTimeout(function() {
         wc();
}, 6000);
   
    
});


function tomarDatos(){
       //tomo los datos del formulario dinamico de cabecera
    //completo los campos del formulario. los imput pueden o no ser readonly.
    
    $('#cod_proyecto').val($('#codigo_proyecto').val());
    
    $('#dir_entrega_cliente').val($('#dir_entrega').val());

    $('#email_cliente').val($('#email').val());
    
    $('#email_alternativo_cliente').val($('#email_alternativo').val());

    $('#nomb_cliente').val($('#cliente').val());

    $('#objetivo_proyecto').val($('#objetivo').val());

    $('#unidad_medida_tiempo').val($('#unidad_medida').val());


//     $('#form-dinamico').find(':input').each(function() {
	
//     var elemento= this;
//     console.log("elemento.id="+ elemento.id); 

//   if (elemento.id == 'cod_proyecto') {
//       $(elemento).attr('readonly', true); 
//       $(elemento).attr('disabled',true);
//     }
    // objetivo_proyecto
    // unidad_medida_tiempo
    // plazo_entrega
    // unme_tiempo
    // nomb_cliente
    // if (elemento.id == 'descripcion_cotizacion') {
    // //   $(elemento).attr('readonly', false); 
    // //   $(elemento).attr('disabled',true);
    // }

    // if (elemento.id == 'dir_entrega_cliente') {
    // //   $(elemento).attr('readonly', false); 
    // //   $(elemento).attr('disabled',true);
    // }
                                
                                            // });

}


  function calcularTotal() {
debugger;

var valor_cantidad = $("#cantidad").val();

var valor_precio_unitario = $("#precio_unitario").val();

var valor_iva = $("#iva").val();

var calcular_importe = valor_cantidad * valor_precio_unitario;

var calcular_total = calcular_importe * valor_iva;

var calcular_total_iva = calcular_total + calcular_importe;

if ( valor_cantidad !='' && valor_precio_unitario ==''){
   
    alertify.warning("Indique precio unitario!");
   
  }

if (valor_precio_unitario !=''){
     
     wo();
    alertify.success("Calculando importe!");
     wc();   

   }

    if ($("#cantidad").val()!='' && $("#precio_unitario").val()!='' ) {
        
      setTimeout(function() {
        wo();
        
        alertify.success("Importe calculado!");  
        
        $("#importe").val(calcular_importe);


        wc(); 
    }, 3000);

      
setTimeout(function() {
        wo();

        $("#total").val(calcular_total_iva);

        alertify.success("Echo.. total calculado!");

        wc(); 
    }, 5000);


      }

  }

  function mostrarForm(){

      detectarForm();
      initForm();

      $('#form-dinamico').show();
      $('#titulo').show();
      $('#form-dinamico-rechazo').hide();
      $('#comprobante').hide();
      // oculta btn para imprimir
      $('#btnImpresion').hide();
  }

  function ocultarForm(){

    detectarForm();
    initForm();

     // $('#motivo').show();
      $('#form-dinamico-rechazo').show();
    
      $('#comprobante').show();
      $('#hecho').prop('disabled',false);
      $('#form-dinamico').hide();
      $('#titulo').hide();
      // muestra btn para imprimir
      $('#btnImpresion').show();

  }

  $('#form-dinamico').hide();
  $('#titulo').hide();
  $('#comprobante').hide();
   // $('#motivo').show();
   $('#form-dinamico-rechazo').show();

  $('#btnImpresion').hide();


  function cerrarTareaform(){
    debugger;

    if ( $("#rechazo").is(":checked")) {
	
    var bandera = true ;


    if ($('#rechazo').prop('checked') && $('#motivo_rechazo .form-control').val() == '') {
        Swal.fire(
					'Oops...',
					'Debes completar los campos Obligatorios (*)',
					'error'
				)
                bandera = false;
       return bandera;
	 		}

    else{
     $('#form-dinamico-rechazo .frm').attr('id','rechazo-form'); 
    frmGuardar($('#form-dinamico-rechazo.frm-new').find('form'),false,false);
        var info_id = $('#form-dinamico-rechazo .frm').attr('data-ninfoid');
        console.log('info_id:' + info_id);
         console.log('Formulario Guardado con exito -function cerrarTareaform');
        }

        return bandera; 
  }
  else if ( $("#aprobar").is(":checked")) {
    debugger;
    var bandera = true ;

      if (!frm_validar('#form-dinamico')) {

        console.log("Error al guardar Formulario");
          Swal.fire(
            'Oops...',
            'Debes completar los campos Obligatorios (*)',
            'error'
          )
      bandera = false;
        return bandera;

      }
      else{
      frmGuardar($('#form-dinamico.frm-new').find('form'),false,false);
          var info_id = $('#form-dinamico .frm').attr('data-ninfoid');
          console.log('info_id:' + info_id);
          console.log('Formulario Guardado con exito -function cerrarTareaform');
          }

          return bandera; 

    }
}



  function cerrarTarea() {
 debugger;
 var id = $('#taskId').val();
 var dataForm = new FormData($('#generic_form')[0]);

 $.ajax({
          type: 'POST',
          data: dataForm,
          cache: false,
          contentType: false,
          processData: false,
          url: '<?php  base_url() ?>index.php/<?php  echo BPM ?>Proceso/cerrarTarea/' + id,
          success: function(data) {
              //wc();
          //   back();
          linkTo('<?php  echo BPM ?>Proceso/');

          setTimeout(() => {
              Swal.fire(
                  
                      'Perfecto!',
                      'Se Finalizó la Tarea Correctamente!',
                      'success'
                  )
      }, 6000);
      
          },
          error: function(data) {
              alert("Error");
          }
      });

    }

</script>