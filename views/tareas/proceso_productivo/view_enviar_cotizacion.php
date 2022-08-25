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
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalGenerico');
?>
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


$unme_tiempo = str_replace(empresa()."-unidades_medida", "", $unidad_medida_tiempo);	

$forma_pago = str_replace(empresa()."-forma_pago", "", $fopa_id);	

$divisa = str_replace(empresa()."-divisa", "", $divi_id);	




if($coti_id){
    $ci =& get_instance();
  // llamo al servicio para traer los Detalles de la cotizacion
    $resource3 = "/getDetalleCotizacion"; 
  
    $deta = $ci->rest->callAPI('GET',REST_SEIN.$resource3."/".$coti_id);
    log_message('DEBUG', 'SEIN - LLAMADA DE EJEMPLO A WSO2 ->' . json_encode($data));   
    

    $aux2 =json_decode($deta['data']);

    $detalles_cotizacion = $aux2->detalles_cotizacion->detalle_cotizacion;
}


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
                            <th style="width: 10% !important">Acciones</th>
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

								echo "<td class='text-center text-light-blue'>";
								echo '<i class="fa fa-trash-o" style="cursor: pointer;margin: 3px;" title="Eliminar" onclick="Eliminar(this)"></i>';
								echo '<i class="fa fa-print" style="cursor: pointer; margin: 3px;" title="Imprimir Comprobante" onclick="modalReimpresion(this)"></i>';
								echo '<i class="fa fa-search"  style="cursor: pointer;margin: 3px;" title="Ver Pedido" onclick="verPedido(this)"></i>';
								echo "</td>";
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
    <button type="button" class="btn btn-sucess" title="descargar Cotización" ><i class="fa fa-download" aria-hidden="true"></i></button>

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

debugger;


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
    wbox('#preview');  
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


/******************************************************************************* */
//Scripts para manipular data en tabla intermedia
//
//Agregar la informacion a la tabla
function agregarTabla(){
   //Informamos el campo vacio 
debugger;
  //  var reporte = validarCampos();
                                
    // if($('#frm-PedidoTrabajo')[0]){
        //Pantalla cargando
        wo();

        //Tomo los datos
        form = $('#frm-PedidoTrabajo')[0];
        datos = new FormData(form);
        data = formToObject(datos);
        //Si la operacion es agregar en la edicion, el service responde con el dedo_id
        //se lo agrego al json que se asigna al data-json en la tabla
       
        // dedo_id = "";

        //Armo JSON para la fila
        // cantidad_tabla = $('#cantidad').find(':selected').text();
        // medida = $('#medidas').find(':selected').text();

        tabla = $('#tabla_detalle').DataTable();

        //Caso remito no los tengo en cuenta
        // precio_total = "";
        // if(!$("#tipo_documento").select2('data')[0].text.toUpperCase().includes('REMITO')){

        //     precio_unitario = data.precio_unitario.split(" ");
        //     precio_total = precio_unitario[1] * data.cantidad;
            
        //     //Puede poseer o no descuento
        //     if(data.descuento){
        //         aux = data.descuento.split(" ");
        //         descuento =  parseFloat(precio_total * (aux[0] / 100)).toFixed(2);
        //         precio_total = parseFloat(precio_total - descuento).toFixed(2);
        //     }   
        // }else{
            
        // }
        fila = "<tr data-json= '"+ JSON.stringify(data) +"'>" +
                '<td><button  type="button" title="Editar"  class="fa fa-fw fa-edit text-light-blue btnEditar" data-toggle="modal" data-target="#modaleditar"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>&nbsp<button type="button" title="Eliminar" class="btn btn-primary btn-circle btnEliminar"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></button>&nbsp' +
                '<td>' + data.cantidad + '</td>' +
                '<td>' + data.descripcion + '</td>' +
                '<td>' + data.precio_unitario + '</td>' +
                '<td>' + data.total + '</td>' +
            '</tr>';

            tabla.row.add($(fila)).draw();

            wc();

        //Si la accion es editar y posee dedo_id, puedo editar directamente el detalle del documento
        //Si no posee dedo_id y es accion editar, agrego el detalle del documento
        //Remuevo los simbolos agregados por el INPUTMASK
        //DESCUENTO
        // descuento = data.descuento.split(" ");
        // descuento = descuento[0] / 100 ;

        //PRECIO UNITARIO
        // precio_unitario = data.precio_unitario.split(" ");
        // precio_unitario = precio_unitario[1];

        // data.precio_unitario = precio_unitario;
        // data.descuento = descuento;

        // if(accion == "editar"){

        //     if(data.dedo_id != ""){
        //         $.ajax({
        //             type: 'POST',
        //             data: {data},
        //             dataType: "json",
        //             url: "<?php // echo SICP; ?>inspeccion/editarDetalleDocumento",
        //             success: function(resp) {

        //                 if(resp.status){
        //                     //Agrego la fila a la tabla
        //                     tabla.row.add($(fila)).draw();

        //                     //Limpio los inputs y combos
        //                     $('#producto').val(null).trigger('change');
        //                     $('#medidas').val(null).trigger('change');
        //                     $('#cantidad').val('');
        //                     $('#unidades').val('');
        //                     $('#precio_unitario').val('');
        //                     $('#descuento').val('');
        //                     alertify.success("Se editó el detalle correctamente");
        //                 }else{
        //                     alertify.error("Error al agregar detalle");
        //                 }
        //                 //Cierro pantalla carga
        //                 wc();
        //             },
        //             error: function(data) {
        //                 //Cierro pantalla carga
        //                 wc();
        //                 alertify.error("Error al agregar detalle");
        //             }
        //         });

        //     }else{

        //         $.ajax({
        //             type: 'POST',
        //             data: {data},
        //             dataType: "json",
        //             url: "<?php // echo SICP; ?>inspeccion/agregarDetalleDocumento",
        //             success: function(resp) {

        //                 if(resp.status){

        //                     jsonDataResp = JSON.parse(resp.data);
        //                     data.dedo_id = jsonDataResp.respuesta.dedo_id;

                            //Agrego la fila a la tabla
                            // tabla.row.add($(fila)).draw();

                            //Limpio los inputs y combos
                //             $('#producto').val(null).trigger('change');
                //             $('#medidas').val(null).trigger('change');
                //             $('#cantidad').val('');
                //             $('#unidades').val('');
                //             $('#precio_unitario').val('');
                //             $('#descuento').val('');

                //             alertify.success("Se editó el detalle correctamente");
                //         }else{
                //             alertify.error("Error al agregar detalle");
                //         }

                //         //Cierro pantalla carga
                //         wc();
                //     },
                //     error: function(data) {
                //         //Cierro pantalla carga
                //         wc();
                //         alertify.error("Error al agregar detalle");
                //     }
                // });
            // }
        // }else{

        //     //Agrego la fila a la tabla
        //     tabla.row.add($(fila)).draw();

        //     //Limpio los inputs y combos
        //     $('#producto').val(null).trigger('change');
        //     $('#medidas').val(null).trigger('change');
        //     $('#cantidad').val('');
        //     $('#unidades').val('');
        //     $('#precio_unitario').val('');
        //     $('#descuento').val('');

        //     //Cierro pantalla carga
        //     wc();
        //     alertify.success(`Se agrego ${producto} correctamente!`);
        // }

    }
//     else{
//         Swal.fire(
//             'Error..',
//             reporte,
//             'error'
//         );
//     }             
// }




function validarCampos(){
        var valida = '';
        //Producto
		if($("#producto").val() == null){
			valida = "Seleccione producto!";
		}
        //Unidad de Medida
		if($("#medidas").val() == null){
			valida = "Seleccione unidad de medida!";
		}
        //Tipo Documento
		if($("#tipo_documento").select2('data')[0].text == null){
			valida = "Seleccione tipo de documento!";
		}
        //Numero documento
		if($("#numero").val() == ""){
			valida = "Seleccione número de documento!";
		}
        //Cantidad
		if($("#cantidad").val() == ""){
			valida = "Complete cantidad!";
		}
        //Unidades
		// if($("#unidades").val() == ""){
		// 	valida = "Complete unidades!";
		// }
        if(! $("#tipo_documento").select2('data')[0].text.toUpperCase().includes('REMITO')){
            //Precio Unitario
            if($("#precio_unitario").val() == ""){
                valida = "Complete precio unitario!";
            }
            //Descuento
            if($("#descuento").val() == ""){
                valida = "Complete descuento!";
            }
        }
		return valida;
    }


    function guardarDetalle(){
    wo();
    //VALIDACIONES
    //valido el formulario
    if(!frm_validar('#frm-PedidoTrabajo')){
        wc();
        Swal.fire(
            'Error..',
            'Debes completar los campos obligatorios (*)',
            'error'
        );
        return;
    }
    //Valido seleccion de foto
    if(!$('.fotos').hasClass("selected")){
        wc();
        Swal.fire(
            'Error..',
            'Debe seleccionar una foto!',
            'error'
        );
        return;
    }
    //valído tabla no vacia
    tabla = $('#tabla_detalle').DataTable(); 
    if ( ! tabla.data().any() ) {
        wc();
        Swal.fire(
            'Error..',
            'No se cargaron datos en la tabla!',
            'error'
        );
        return;
    }
    //Luego de validar, guardo los formularios
    //Accion discrimina si guarda todo junto o solo edita detalles
    if(accion == "nuevo"){
        agregarDetalle().then((result) => {
            wc();
            alertify.success(result);
            cerrarDetalle();

        }).catch((err) => {
            wc();
            console.log(err);
        });
    }else{
        editarDocumento().then((result) => {
            wc();
            alertify.success(result);
            cerrarDetalle();

        }).catch((err) => {
            wc();
            alertify.error(err);
            console.log(err);
        });
    }
    //Luego de guardar cierro el detalle del documento
    //Vuelvo a la pantalla principal de la tarea
    
}
//
// Guardo la documentacion cargada y su respectivo detalle
async function agregarDetalle () {

    
    tabla = $('#tabla_detalle').DataTable();

debugger;

    //tomo el formulario
    datos = new FormData($('#frm-PedidoTrabajo')[0]);
    datos.append('case_id', $("#caseId").val());

    let detalle = new Promise( function(resolve,reject){
        
        $.ajax({
            type: 'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            url: "<?php echo SICP; ?>inspeccion/agregarDetalle",
            success: function(data) { 
                
                rsp = JSON.parse(data);
                //Si es correcto, guardo los detalles de los documentos
                if(rsp.status){

                    // Uso el valor que dejo en Numero y Tipo para evitar fallo en la FK, en caso de que cambie antes de guardar detalle
                
                    // num_documento = $("#numero").val();
                    // tipo_factura = $("#tipo_documento").select2('data')[0].id;
                    
                    //Loopeo sobre las filas de la tabla
                    //Formateo precio_unitario y descuento porque tiene los prefijos
                    detalles = [];
                    tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                        var datos = this.data();
                        nodo = this.node();
                        
                        var json = JSON.parse($(nodo).attr('data-json'));

                        // json.num_documento = num_documento;
                        // json.tido_id = tipo_factura;

                        // descuento = json.descuento.split(" ");
                        // descuento = descuento[0] / 100 ;

                        // precio_unitario = json.precio_unitario.split(" ");
                        // precio_unitario = precio_unitario.pop();

                        json.precio_unitario = precio_unitario;

                        // json.descuento = descuento;

                        detalles[rowIdx] = json;
                    });

                    $.ajax({
                        type: 'POST',
                        data: {detalles},
                        dataType: "json",
                        url: "<?php echo SICP; ?>inspeccion/guardarDetallesCotizacion",
                        success: function(resp) {
                            if(resp.status){
                                resolve("Se agrego cotizacion y su detalle correctamente");
                            }else{
                                reject("Se agrego correctamente la cotizacion, pero fallo al agregar el detalle");
                            }
                        
                        },
                        error: function(data) {
                            alert("Error al agregar los detalles de la cotizacion");
                            reject("Error");
                        }
                    });

                }else{
                    console.log(rsp.message);
                    reject("Error al agregar la cotizacion");
                }
                 
            },
            error: function(data) {
                reject("Error al agregar la cotizacion");
            }
        });
    });

    return await detalle;
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


// ver esta parte
//  ------------------------------
     
//       if ($('#rechazo').prop('checked') && $('#motivo_rechazo .form-control').val() == '') {
//         Swal.fire(
//                 'Error!',
//                 'Por favor complete el campo Motivo de Rechazo...',
//                 'error'
//             )
//           return;
//       }

//       if ( $("#rechazo").is(":checked")) {
// 		debugger;

//  var guardado = cerrarTareaform();

//     if(!guardado){
//      return;
//     }
//     console.log('tarea cerrada');
//       var id = $('#taskId').val();
//       console.log(id);

//       var frm_info_id_rechazo = $('#form-dinamico-rechazo .frm').attr('data-ninfoid');

//      var dataForm = new FormData($('#generic_form')[0]);

//       dataForm.append('taskId', $('#taskId').val());

//       dataForm.append('frm_info_id', frm_info_id_rechazo);

//       $.ajax({
//           type: 'POST',
//           data: dataForm,
//           cache: false,
//           contentType: false,
//           processData: false,
//           url: '<?php // base_url() ?>index.php/<?php //echo BPM ?>Proceso/cerrarTarea/' + id,
//           success: function(data) {
//               //wc();
//           //   back();
//           linkTo('<?php //echo BPM ?>Proceso/');

//           setTimeout(() => {
//               Swal.fire(
                  
//                       'Perfecto!',
//                       'Se Finalizó la Tarea Correctamente!',
//                       'success'
//                   )
//       }, 6000);
      
//           },
//           error: function(data) {
//               alert("Error");
//           }
//       });


//       } else{

//         var guardado = cerrarTareaform();

// if(!guardado){
//  return;
// }

//         debugger;

//       var frm_info_id = $('#form-dinamico .frm').attr('data-ninfoid');
     
      
//       var id = $('#taskId').val();
//       console.log(id);

//       var dataForm = new FormData($('#generic_form')[0]);

//       dataForm.append('taskId', $('#taskId').val());

//       dataForm.append('frm_info_id', frm_info_id);

//       $.ajax({
//           type: 'POST',
//           data: dataForm,
//           cache: false,
//           contentType: false,
//           processData: false,
//           url: '<?php // base_url() ?>index.php/<?php // echo BPM ?>Proceso/cerrarTarea/' + id,
//           success: function(data) {
//               //wc();
//           //   back();
//           linkTo('<?php // echo BPM ?>Proceso/');

//           setTimeout(() => {
//               Swal.fire(
                  
//                       'Perfecto!',
//                       'Se Finalizó la Tarea Correctamente!',
//                       'success'
//                   )
//       }, 6000);
      
//           },
//           error: function(data) {
//               alert("Error");
//           }
//       });

//       }

    
  }







  var band = 0;

  // Se pueden hacer dos cosas: o un ajax buscando datos o directamente
  // armar con los datos de la pantalla

  function modalCodigos(){

      // si es rechazado el pedido debe llenar el input motivo
      var rechazo = $("#motivo_rechazo").val();
      if (rechazo == undefined) {
        Swal.fire(
                'Error!',
                'Por favor complete el campo Motivo de Rechazo...',
                'error'
            )
      
        return;
      }

      if (band == 0) {
        debugger;
          // configuracion de codigo QR
          var config = {};
              config.titulo = "Revision Inicial";
              config.pixel = "2";
              config.level = "S";
              config.framSize = "2";
          // info para immprimir  
          var arraydatos = {};
              arraydatos.N_orden = $('#petr_id').val();
              arraydatos.Cliente = $('#cliente').val();
              arraydatos.Medida = $('select[name="medidas_yudica"]').select2('data')[0].text;
              arraydatos.Marca = $('select[name="marca_yudica"]').select2('data')[0].text;
              arraydatos.Serie = $('#num_serie').val();
              arraydatos.Num = $('#num_cubiertas').val();

              arraydatos.Zona = $('#zona').val();
              arraydatos.Trabajo = $('#tipo_proyecto').val();
              arraydatos.Banda = $('select[name="banda_yudica"]').select2('data')[0].text;

              // si la etiqueta es derechazo
              arraydatos.Motivo = $('#motivo_rechazo').val();
          // info para grabar en codigo QR
          armarInfo(arraydatos);
      }
      // llama modal con datos e img de QR ya ingresados
      verModalImpresion();

      band = 1;
  }

  function armarInfo(arraydatos){

    $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>/Infocodigo/rechazado", arraydatos);
  }
</script>