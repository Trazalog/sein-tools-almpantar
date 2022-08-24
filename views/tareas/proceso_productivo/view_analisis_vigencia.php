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


    // $resource = "/getDetalleCotizacion";

    // $petr_id = "309";

    //    // llamo al servicio para traer datos de la cotizacion
    //    $data = $ci->rest->callAPI('GET',REST_SEIN.$resource."/".$petr_id);
    //    log_message('DEBUG', 'SEIN - datos de la cotizacion ->' . json_encode($data));      
?>
 <div class="row">
  <div class="col-md-12 col-sm-12">
  <h3>Analiza Vigencia. Condiciones y Cantidades<small></small></h3>
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
                    <div class="col-md-4 espaciado">
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
                    <div class="col-md-4 espaciado">
                    <label class="control-label" for="plazo_entrega">plazo de entrega<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">
                       
                            <div class="input-group" style="display:inline-flex;">
                                <input id="plazo_entrega" name="plazo_entrega" type="text" class="form-control input-md" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" readonly>
                            
                                <select name="unidad_medida_tiempo2" id="unidad_medida_tiempo2" class="form-control" style="width: auto" data-bv-notempty="false" readonly>
                                    <option value="" disabled selected> -Seleccionar- </option>
                                    <option value="dias" disabled selected>diás</option>
                                </select>
                            
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
					 <div class="col-md-4 espaciado">            
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
           <label class=" control-label" for="email_cliente2" name="">Email alternativo:</label>                            
                        <div class="form-group" style="display:inline-flex;">
                          
                            <input type="text" class="form-control habilitar" id="email_cliente2" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->   
            
                    <!-- forma de pago -->
                    <div class="col-md-4 espaciado">
                    <label class="control-label" for="forma_pago">Forma de pago<strong style="color: #dd4b39">*</strong>:</label>
                    <div class="input-group" style="display:inline-flex;">
                                <input id="forma_pago" name="forma_pago" type="text"  class="form-control input-md" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" readonly>
                            </div>
                    </div>  
					  <!-- ***************** --> 

                <!-- Divisa -->
                <div class="col-md-3 espaciado">
                <label class="control-label" for="divisa">Divisa<strong style="color: #dd4b39">*</strong>:</label>     
                    <div class="input-group" style="display:inline-flex;">
                    <input id="divisa" name="divisa" type="text"  class="form-control input-md" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" readonly>
        
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
                        
                        </tbody>
                    </table>
                    <!--_______ FIN TABLA PRODUCTOS ______-->
                </div>
            </div>
    <br><br>
          
                </fieldset>
            </form>                           
   
    </div>
    
    <!-- / Bloque de cotizacion -->
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
DataTable($('#tabla_detalle'));

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
wo();
    alertify.success("Cargando datos en la vista aguarde...");
    
    setTimeout(function() {
        wc();    
        tomarDatos();
}, 9000);
   
    
});


function tomarDatos(){
    //tomo los datos del formulario dinamico de cabecera
    //completo los campos del formulario. los imput pueden o no ser readonly.
    debugger;
    $('#cod_proyecto').val($('#codigo_proyecto').val());
    
    $('#dir_entrega_cliente').val($('#dir_entrega').val());

    //email cliente
    $('#email_cliente').val($('#email').val());
    
    //email alternativo cliente 
    $('#email_cliente2').val($('#email_alternativo').val());

    $('#nomb_cliente').val($('#cliente').val());

    $('#objetivo_proyecto').val($('#objetivo').val());

    $('#unidad_medida_tiempo').val($('#unidad_medida').val());

    $('#iva').val('0.21');

    $('#frm-Cotizacion').find(':input').each(function() {
		var elemento= this;
	console.log("elemento.id="+ elemento.id); 
   
    $(elemento).attr('readonly', false); 
          
          $(elemento).attr('disabled',true);
          $(elemento).attr('readonly', true); 
												});
   

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