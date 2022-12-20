<style>
.fa-edit{
  transform:scale(1.6);
}
</style>
<hr>
<?php #kMarchan
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalGenerico');
?>

<?php
// funcion que desplega formulario asociado a la vista
// los formularios dinamicos se cargar de la tabla pro.procesos_forms
// $aux = json_decode($data);

// $cotizacion = $aux->cotizacion;
// $plazo_entrega = $cotizacion->plazo_entrega;
// $unidad_medida_tiempo = $cotizacion->unme_id;
// $fopa_id = $cotizacion->fopa_id;
// $divi_id = $cotizacion->divi_id;
// $coti_id = $cotizacion->coti_id;

if($cotizacion->coti_id){
    $ci =& get_instance();
  // llamo al servicio para traer los Detalles de la cotizacion
    $resource3 = "/getDetalleCotizacion"; 
  
    $deta = $ci->rest->callAPI('GET',REST_SEIN.$resource3."/".$cotizacion->coti_id);
    log_message('DEBUG', 'SEIN - LLAMADA DE EJEMPLO A WSO2 ->' . json_encode($data));   
    

    $aux2 =json_decode($deta['data']);

    $detalles_cotizacion = $aux2->detalles_cotizacion->detalle_cotizacion;
}
?>
<h3>Análisis de Vigencia, Condiciones y Cantidades<small></small></h3>
<div class="box" id="view_cotizacion">
    <div class="box-body">
        <form class="form-inline" id="frm-Cotizacion">
            <fieldset>
                <div class="row">
                    <!-- Codigo proyecto-->
                    <div class="col-md-3 espaciado">
                        <label class="control-label" for="cod_proyecto">Código Pedido <strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group">
                            <input id="cod_proyecto" name="cod_proyecto" type="text" placeholder="Código Pedido" size="12" class="form-control input-md" readonly value="<?php echo $pedido_trabajo->cod_proyecto; ?>">
                        </div>
                    </div>
                    <!-- ***************** -->  
                    <!-- Objetivo -->
                    <div class="col-md-4 espaciado">
                    <label class="control-label" for="objetivo">Objetivo<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">
                          
                            <div class="input-group" style="display:inline-flex;">
                                <input id="objetivo_proyecto" name="objetivo_proyecto" type="text" class="form-control input-md" data-bv-notempty readonly value="<?php echo $pedido_trabajo->objetivo; ?>">
                            </div>
                            <div class="input-group" style="display:inline-flex;">
                                <input id="unidad_medida_tiempo" name="unidad_medida_tiempo" class="form-control input-md" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" readonly value="<?php echo $pedido_trabajo->unidad_medida; ?>">
                            </div>

                        </div>
                    </div>
                     <!-- ***************** -->  
                     <!-- plazo de entrega -->
                    <div class="col-md-4 espaciado">
                        <label class="control-label" for="plazo_entrega">Plazo de entrega<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">
                            <div class="input-group" style="display:inline-flex;">
                                <input id="plazo_entrega" name="plazo_entrega" type="text" class="form-control input-md" value="<?php echo $cotizacion->plazo_entrega; ?>" readonly>
                                <input id="unme_tiempo" name="unme_tiempo" type="text" class="form-control input-md" value="<?php echo $cotizacion->unidad_medida; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- ***************** -->           
                </div> <!-- end row -->
                <br>
                <br>
                <div class="row">
                    <!-- Cliente-->
                    <div class="col-md-3 espaciado">
                        <label class="control-label" for="nomb_cliente">Cliente <strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group">
                            <input type="text" class="form-control habilitar" id="nomb_cliente" value="<?php echo $pedido_trabajo->nombre_cliente; ?>" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->
                    <!-- Direccion Entrega -->
                    <div class="col-md-4 espaciado">
                        <label class=" control-label" for="dir_entrega_cliente" name="">Dirección de Entrega:</label>                                 
                        <div class="form-group">
                            <input type="text" class="form-control habilitar" id="dir_entrega_cliente" value="<?php echo $pedido_trabajo->dir_entrega; ?>" readonly>
                        </div>
                    </div>
                    <!-- ***************** --> 
					 <!-- email -->
                    <div class="col-md-4 espaciado">            
                        <div class="form-group">  
                            <label class=" control-label" for="email" name="">Email:</label>                                
                            <input type="text" class="form-control habilitar" id="email_cliente" readonly value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <!-- ***************** --> 
                </div> <!-- end row -->  
                <br>
                <br>
                <div class="row"> 
                    <!-- email alternativo -->
                    <div class="col-md-4 espaciado">                
                        <div class="form-group">
                            <label class=" control-label" for="email_alternativo_cliente" name="">Email alternativo:</label>                            
                            <input type="text" class="form-control habilitar" id="email_alternativo_cliente" readonly value="<?php echo $email_alternativo; ?>">
                        </div>
                    </div>
                    <!-- ***************** -->
                    <!-- forma de pago -->
                    <div class="col-md-4 espaciado">
                        <div class="input-group">
                            <label class="control-label" for="forma_pago">Forma de pago<strong style="color: #dd4b39">*</strong>:</label>
                            <input id="forma_pago" name="forma_pago" type="text"  class="form-control input-md" value="<?php echo $cotizacion->forma_pago; ?>" readonly>
                        </div>
                    </div>  
                    <!-- ***************** --> 
                    <!-- Divisa -->
                    <div class="col-md-3 espaciado">
                        <label class="control-label" for="divisa">Divisa<strong style="color: #dd4b39">*</strong>:</label>     
                        <div class="input-group">
                            <input id="divisa" name="divisa" type="text"  class="form-control input-md" value="<?php echo $cotizacion->divisa; ?>" readonly>
                        </div>
                    </div>  
                    <br>
                </div> <!-- end row -->          
                <br>
                <br>
                <div class="col-md-12 col-sm-12 col-xs-12 centrar">
                    <h5>Detalles de cotización:</h5>
                    <div id="sec_productos">
                    <!-- ______ TABLA PRODUCTOS ______ -->
                    <table id="tabla_detalle" class="table table-bordered table-striped">
                        <thead class="thead-dark" bgcolor="#eeeeee">
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

								echo "<tr id='$petr_id' case_id='$case_id' data-json='" . json_encode($rsp) . "'>";
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
                        <div class="col-sm-1"></div>
                    </div>
                    <!--_______ FIN TABLA PRODUCTOS ______-->
                </div>
            </fieldset>
        </form>                           
    </div>
    <!-- / Bloque de cotizacion -->
</div>
<br><br><br>
<hr>   
<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Aprobar cotización? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"> No
            </label>
        </center>
    </div>
    <br>
</form>
<script>
    $('#tabla_detalle').dataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            var total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
                console.log(total);
            // Total over this page
            var pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 console.log(pageTotal);
            // Update footer
            
            sub_total = $('#divisa').val() +' ' +'$'+pageTotal;
        $('#footer_table').val(sub_total);
        }
    } );


  function getFormData(){
debugger;
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
    wbox('#view_cotizacion');  
    alertify.success("Cargando datos en la vista aguarde...");
    tomarDatos();
    setTimeout(function() {
          wbox();  
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

    $('#iva').val('0.21');

    }


    //////////////////////////////////

async function cerrarTareaform(){
    resp = {};
    if (!frm_validar('#form-Cotizacion')) {
  
        Swal.fire('Oops...','Debes completar los campos obligatorios (*)','error');
        resp.confirma = false;

        return new Promise(reject => {reject(resp)});
    }else{
        resp.confirma = true;
        resp.info_id = await frmGuardarConPromesa($('#form-dinamico').find('form'));
        console.log('Formulario guardado con éxito. Info ID: '+ resp.info_id);

        return new Promise(resolve => {resolve(resp)}); 
    }
}


async function cerrarTarea() {
  wo(); 
    debugger;
//    var confirma = await cerrarTareaform();

    // if(!resp.confirma){
    //   wc();
    //     return;
    // }
 
    var id = $('#taskId').val();
    var dataForm = new FormData($('#generic_form')[0]);
   
    // dataForm.append('frm_info_id', resp.info_id);

    $.ajax({
        type: 'POST',
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        url: '<?php base_url() ?>index.php/<?php echo BPM ?>Proceso/cerrarTarea/' + id,
        success: function(data) {
            wc();
            const confirm = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });

            confirm.fire({
                title: 'Perfecto!',
                text: "Se finalizó la tarea correctamente!",
                type: 'success',
                showCancelButton: false,
                confirmButtonText: 'Hecho'
            }).then((result) => {
                
                linkTo('<?php echo BPM ?>Proceso/');
                
            });
    
        },
        error: function(data) {
            wc();
            error('',"Se produjo un error al cerrar la tarea");
        }
    });
}



</script>