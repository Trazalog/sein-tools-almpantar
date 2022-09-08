<style>
.fa-edit{
  transform:scale(1.6);
}
</style>
<hr>
<?php
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalGenerico');
?>

<h3>Cotización de trabajo<small></small></h3>
<form class="form-inline" id="frm-Cotizacion">
                <fieldset>
           <div class="row">
                <!-- Codigo proyecto-->
                    <div class="col-md-3">
                    <label class="control-label" for="cod_proyecto">Código Pedido <strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">

                            <input id="cod_proyecto" name="cod_proyecto" type="text" placeholder="Código Pedido"  minlength="4" maxlength="10" size="12" class="form-control input-md" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->
                    <!-- Objetivo -->
                    <div class="col-md-3">
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
                    <div class="col-md-3" >
                    <label class="control-label" for="plazo_entrega">plazo de entrega<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex">

                            <div class="input-group" style="display:inline-flex;">
                                <input id="plazo_entrega" name="plazo_entrega" type="text" class="form-control input-md" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" required>

                                <select id="unme_id" name="unme_id" style="width: 100%;" class="select2 col-md-6" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" required>
                                <option value="" disabled selected> -Seleccionar- </option>
                                <!-- <option value="tipos_pedidos_trabajoneumaticos">Reparacion Neumaticos</option> 
							-->
							<?php 
                                if(is_array($unme_id)){
                                
                                $array = json_decode(json_encode($unme_id), true);

                                foreach ($array as $i) {
                                    $tabl_id= $i['tabl_id'];  $valor= $i['valor'];

                                    $valor1= strval ($valor);

                                echo '<option value ="'.$tabl_id.'"> '.$valor1.'</option>';
                                        }
                                                                }
                                ?>
                            </select>
                    
                           
                           
					  <!-- ***************** -->

                            </div>
                        </div>
                    </div>
                    <!-- ***************** -->
                    <!-- Cliente-->
                    <div class="col-md-3">
                    <label class="control-label" for="nomb_cliente">Cliente <strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group" style="display:inline-flex;">
                        <input type="text" class="form-control habilitar" id="nomb_cliente" name="nomb_cliente" value="" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->

            </div> <!-- end row -->
            <br>
            <div class="row">
                    <!-- Direccion Entrega -->
                    <div class="col-md-4 espaciado">
                    <label class=" control-label" for="dir_entrega_cliente" name="">Dirección de Entrega:</label>
                        <div class="form-group">

                            <input type="text" class="form-control habilitar" id="dir_entrega_cliente" name="dir_entrega_cliente" value="" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->
					 <!-- email -->
					 <div class="col-md-3">
           <label class=" control-label" for="email" name="">Email:</label>
                        <div class="form-group" style="display:inline-flex;">

                            <input type="text" class="form-control habilitar" id="email_cliente" name="email_cliente" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->
					 <!-- email alternativo -->
			          <div class="col-md-4">
            <label class="control-label" for="email_alternativo">email alternativo:</label>
                        <div class="form-group" style="display:inline-flex;">

                            <input type="text" id="email_alternativo_cliente" name="email_alternativo_cliente"  class="form-control input-md" >
                        </div>
                    </div>

            </div> <!-- end row -->
        <br>
            <div class="row">
                    <!-- forma de pago -->
                    <div class="col-md-3">
                    <label class="control-label" for="fopa_id">Forma de pago<strong style="color: #dd4b39">*</strong>:</label>
                    <div class="input-group" style="display:inline-flex;">
                  
                     <select id="fopa_id" name="fopa_id" style="width: 100%;" class="select2 col-md-6" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" required>
                                <option value="" disabled selected> -Seleccionar- </option>
                                <!-- <option value="tipos_pedidos_trabajoneumaticos">Reparacion Neumaticos</option> 
							-->
							<?php 
                                if(is_array($fopa_id)){
                                
                                $array = json_decode(json_encode($fopa_id), true);

                                foreach ($array as $i) {
                                    $tabl_id= $i['tabl_id'];  $valor= $i['valor'];

                                    $valor1= strval ($valor);

                                echo '<option value ="'.$tabl_id.'"> '.$valor1.'</option>';
                                        }
                                                                }
                                ?>
                            </select>
                    
                            </div>
                            </div>
					  <!-- ***************** -->
              <!-- forma de pago -->
              <div class="col-md-3">
              <label class="control-label" for="divisa">Divisa<strong style="color: #dd4b39">*</strong>:</label>
                    <div class="form-group">
                    <select id="divi_id" name="divi_id" style="width: 100%;" class="select2 col-md-6" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" required>
                                <option value="" disabled selected> -Seleccionar- </option>
                                <!-- <option value="tipos_pedidos_trabajoneumaticos">Reparacion Neumaticos</option> 
							-->
							<?php 
                                if(is_array($divi_id)){
                                
                                $array = json_decode(json_encode($divi_id), true);

                                foreach ($array as $i) {
                                    $tabl_id= $i['tabl_id'];  $valor= $i['valor'];

                                    $valor1= strval ($valor);

                                echo '<option value ="'.$tabl_id.'"> '.$valor1.'</option>';
                                        }
                                                                }
                                ?>
                            </select>
                    </div>
                    </div>
					  <!-- ***************** -->
            <!--Cantidad-->
            <div class="col-md-3">
            <label class="control-label" for="cantidad">Cantidad<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group">

                            <input type="text" id="cantidad" name="cantidad"  class="form-control input-md" onchange="calcularTotal(this)" required>
                        </div>
                    </div>
                    <!-- ***************** -->
                    <!-- precio_unitario -->
                    <div class="col-md-3">
                    <label class="control-label" for="precio_unitario">Precio Unitario<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group">

                            <input id="precio_unitario" name="precio_unitario" type="text" class="form-control input-md" onchange="calcularTotal(this)" required>
                        </div>
                    </div>
            </div> <!-- end row -->
           <br>
            <div class="row">
                    <!-- ***************** -->
					 <div class="col-md-12">
                        <div class="form-group" style="width: 100%">
                            <label class="control-label" for="descripcion_cotizacion">Descripción <strong style="color: #dd4b39">*</strong>:</label>
                            <div class="input-group" style="width:100%">
                                <textarea class="form-control" id="descripcion_cotizacion" name="descripcion_cotizacion" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" required></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- ***************** -->
             </div> <!-- end row -->
            <br>
             <div class="row">
                    <!-- importe -->
                <div class="col-md-3">
                    <label class="control-label" for="importe">Importe<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group">

                            <input id="importe" name="importe" placeholder="" class="form-control input-md" onchange="calcularTotal(this)" required readonly>
                        </div>
                    </div>
                    <!-- ***************** -->
                     <!-- iva -->
                     <div class="col-md-3">
                    <label class="control-label" for="iva">IVA<strong style="color: #dd4b39">*</strong>:</label>
                        <div class="form-group">

                            <input id="iva" name="iva" type="text" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <!-- ***************** -->
                     <!-- total -->
                     <div class="col-md-3">
                    <label class="control-label" for="total">Subtotal:</label>
                        <div class="form-group">

                            <input id="total" name="total" type="text" placeholder="" class="form-control input-md" readonly>
                        </div>
                    </div>
                    <!-- ***************** -->
                    <div class="col-md-12">
                        <div class="form-group" style="width: 100%">
                            <label class="control-label" for="observaciones">Observaciones <strong style="color: #dd4b39">*</strong>:</label>
                            <div class="input-group" style="width:100%">
                                <textarea class="form-control" id="observaciones" name="observaciones" data-bv-notempty data-bv-notempty-message="Campo Obligatorio *" required></textarea>
                            </div>
                        </div>
                    </div>
                   
                    <!-- ***************** -->
					 
                    <!-- ***************** -->
             </div> <!-- end row -->
                    <div class="col-md-1 espaciado">
                      <div class="form-group">
                      <!-- <i class='fa fa-fw fa-edit text-light-blue' style='cursor: pointer;' title='Editar' onclick='habilitarEdicion()'></i> -->
                       </div>
                    </div>

                    <div class="col-md-2">
                          <!--_________________ Agregar_________________-->
                <div class="form-group text-right">
                    <button type="button" class="btn btn-sucess" title="Agregar a la tabla de detalles" onclick="agregarTabla()" >Agregar</button>
                </div>
                <!--__________________________________-->
                    </div>

              </div> <!-- end row -->
                    <br>

                    <!-- Button -->



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
                    <!--_______ FIN TABLA  ______-->
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
            
                </div>
            </div>
<br><br>
              <!--_________________ >Guardar-->
              <div class="col-md-12 col-sm-12 col-xs-12 centrar form-group text-right">
                    <button type="button" class="btn btn-sucess" title="Guardar Cotización" onclick="guardarDetalle()">Guardar</button>
                </div>
                <!--__________________________________-->

                </fieldset>
            </form>


<script>
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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
                console.log(total);


                if (total > 0) {  
            // Total over this page
            var pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
            }

 console.log(pageTotal);
            // Update footer
            divisa = $('#divi_id').find(':selected').text();
            sub_total = divisa +' ' +'$'+pageTotal;
        $('#footer_table').val(sub_total);

            }
 
                
  
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
wo();
    alertify.success("Cargando datos en la vista aguarde...");

    setTimeout(function() {
        wc();
        tomarDatos();
}, 9000);


});


function tomarDatos(){

    $('#cod_proyecto').val($('#codigo_proyecto').val());

    $('#dir_entrega_cliente').val($('#dir_entrega').val());

    $('#email_cliente').val($('#email').val());

    $('#email_alternativo_cliente').val($('#email_alternativo').val());

    $('#nomb_cliente').val($('#cliente').val());

    $('#objetivo_proyecto').val($('#objetivo').val());

    $('#unidad_medida_tiempo').val($('#unidad_medida').val());

    $('#iva').val('0.21');

    }

  function calcularTotal() {

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
    // alertify.success("Calculando importe!");
     wc();

   }

    if ($("#cantidad").val()!='' && $("#precio_unitario").val()!='' ) {

      setTimeout(function() {
        wo();

        // alertify.success("Importe calculado!");

        $("#importe").val(calcular_importe);


        wc();
    }, 1500);


setTimeout(function() {
        wo();

        $("#total").val(calcular_total_iva);

        alertify.success("Echo.. subtotal calculado!");

        wc();
    }, 3000);


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





//Eliminar registro tabla intermedia
//
$(document).on('click','.btnEliminarCotizacion', function () {
debugger;


const swalWithBootstrapButtons = Swal.mixin({
										customClass: {
											confirmButton: 'btn btn-success',
											cancelButton: 'btn btn-danger'
										},
										buttonsStyling: false
										})

										swalWithBootstrapButtons.fire({
										title: 'Eliminar!',
										text: '¿Desea borrar el registro?',
										type: 'warning',
										showCancelButton: true,
										confirmButtonText: 'SI',
										cancelButtonText: 'No',
										reverseButtons: true
										}).then((result) => {
											debugger;
										if (result.value) {
                                            tabla.row( $(this).parents('tr') ).remove().draw(); 
                                            alertify.success("Registro eliminado correctamente!");
										} else if (
											/* Read more about handling dismissals below */
											result.dismiss === Swal.DismissReason.cancel
										) {
											swalWithBootstrapButtons.fire(
											'Cancelado',
											'registro contenido',
											'info'
											)

											
										}
										})
						
});





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
 
        wo();

        //Tomo los datos
        form = $('#frm-Cotizacion')[0];
        datos = new FormData(form);
        data = formToObject(datos);
 

        tabla = $('#tabla_detalle').DataTable();


        var reporte = validarCampos();
                                
        if(reporte == false){
        
        fila = "<tr data-json= '"+ JSON.stringify(data) +"'>" +
                '<td><button type="button" title="Eliminar" class="btn btn-primary btn-circle btnEliminarCotizacion"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></button>&nbsp' +
                '<td>' + data.cantidad + '</td>' +
                '<td>' + data.descripcion_cotizacion + '</td>' +
                '<td>' + data.precio_unitario + '</td>' +
                '<td>' + data.total + '</td>' +
            '</tr>';

            tabla.row.add($(fila)).draw();

            wc();
        }else{
           
        Swal.fire(
            'Error..',
            'Debes completar los campos obligatorios (*)',
            'error'
        );
        wc();
        return;

    }

}


function validarCampos(){

debugger;
        var bandera = false;
        //cantidad
		if($("#cantidad").val() == ''){
			valida = "Seleccione cantidad!";
            console.log(valida);
            bandera = true;
		}
        //precio unitario
		if($("#precio_unitario").val() == ''){
			valida = "Seleccione precio unitario!";
            console.log(valida);
            bandera = true;
		}
        //plazo entrega
        if($("#plazo_entrega").val() == ''){
			valida = "Seleccione plazo entrega!";
            console.log(valida);
            bandera = true;
		}
        //unidad de medida
        if($("#unme_id").val() == ''){
			valida = "Seleccione unidad de medida!";
            console.log(valida);
            bandera = true;
		}

        //forma de pago
        if($("#fopa_id").val() == ''){
			valida = "Seleccione forma de pago!";
            console.log(valida);
            bandera = true;
		}

        //divisa
        if($("#divi_id").val() == ''){
			valida = "Seleccione divisa!";
            console.log(valida);
            bandera = true;
		}

        //descripcion
        if($("#descripcion_cotizacion").val() == ''){
			valida = "Seleccione descripcion!";
            console.log(valida);
            bandera = true;
		}
        
        
		return bandera;
    }



    function guardarDetalle(){
    wo();
    //VALIDACIONES
    //valido el formulario
    if(!frm_validar('#frm-Cotizacion')){
        wc();
        Swal.fire(
            'Error..',
            'Debes completar los campos obligatorios (*)',
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
   
        agregarDetalle().then((result) => {
            wc();
            alertify.success(result);
            

        }).catch((err) => {
            wc();
            console.log(err);
        });
   

}
//


// Guardo la cotizacion cargada y su respectivo detalle
async function agregarDetalle() {


    tabla = $('#tabla_detalle').DataTable();

    validarCampos();
debugger;

    //tomo el formulario
    datos = new FormData($('#frm-Cotizacion')[0]);
    datos.append('petr_id', $("#petr_id").val());


    var datos_json = formToJson(datos);


console.log(datos_json);



    let cotizacion = new Promise( function(resolve,reject){

        $.ajax({
            type: 'POST',
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            url: "<?php echo SEIN; ?>Cotizacion/agregarCotizacion",
            success: function(data) {
                debugger;
                rsp = JSON.parse(data);
                respuesta=  JSON.parse(rsp.data);
                 rspA = JSON.parse(JSON.stringify(respuesta.respuesta));

                 //si se guarda bien guardo el id de cotizacion
                 coti_id = rspA['coti_id'];

                //Si es correcto, guardo los detalles de la cotizacion
                if(rsp.status){

                    debugger;
                    //Loopeo sobre las filas de la tabla
                    //Formateo precio_unitario y descuento porque tiene los prefijos
              
                    detalles = [];
                    tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
                        var datos = this.data();
                        nodo = this.node();
                        
                        var json = JSON.parse($(nodo).attr('data-json'));
                    
        
                        json.coti_id = coti_id;

                        json.cantidad = datos[1];

                        json.descripcion_cotizacion = datos[2];

                        json.precio_unitario = datos[3];

                        json.importe = datos[4];

                        detalles[rowIdx] = json;
                    });


                    $.ajax({
                        type: 'POST',
                        data: {detalles},
                        dataType: "json",
                        url: "<?php echo SEIN; ?>Cotizacion/guardarDetalleCotizacion ",
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

    return await cotizacion;
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


//  ------------------------------

      if ($('#rechazo').prop('checked') && $('#motivo_rechazo_interno .form-control').val() == '' && $('#motivo_rechazo_cliente .form-control').val() == '') {
       Swal.fire(
                        'Error!',
               'Por favor complete el campo Motivo de Rechazo...',
                 'error'
            )
          return;
      }

       if ( $("#rechazo").is(":checked")) {
 		debugger;

 var guardado = cerrarTareaform();

    if(!guardado){
         return;
        }
     console.log('tarea cerrada');
      var id = $('#taskId').val();
      console.log(id);

      var frm_info_id_rechazo = $('#form-dinamico-rechazo .frm').attr('data-ninfoid');

     var dataForm = new FormData($('#generic_form')[0]);

      dataForm.append('taskId', $('#taskId').val());

      dataForm.append('frm_info_id', frm_info_id_rechazo);

  }

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