<style>
.frm-save {
    display: none;
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

<h3>Solicitud de pago anticipo <small></small></h3>
<br> <br>
<div class="row">
<div class="col-md-10">
<div id="form-dinamico" class="frm-new" data-form="60"></div>
</div>
<div class="col-md-2">
    <button type="button" class="btn btn-sucess" title="Descargar cotización" data-dismiss="modal" id="descargar_Cotización" onclick="verModalCotizacion()">
        <i class="fa fa-download"aria-hidden="true"></i>
    </button>
</div>
</div>

<!-- 
<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿El cliente acepta presupuesto? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true"
                    onclick="mostrarForm();"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="mostrarForm()"> No
            </label>
        </center>
    </div>
</form>   -->
    <br><br>  

<script>

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

////////////////////////////////

$('#view').ready(function() {
wo();
    alertify.success("Cargando datos en la vista aguarde...");
    
    setTimeout(function() {
        wc();    
        tomarDatos();
}, 9000);
   
    
});

  detectarForm();
  initForm();


  function tomarDatos(){
    console.log("<?php echo  $pedido_trabajo->nombre_cliente; echo $pedido_trabajo->petr_id; ?>");
    debugger;

    $('#nom_cliente').val($('#cliente').val());

    $('#total').val('<?php echo '$'.(number_format($totalCotizacion,2))?>');

    $('#form-dinamico').find(':input').each(function() {
										var elemento= this;
										console.log("elemento.id="+ elemento.id); 
   
      if (elemento.id == 'nom_cliente') {
          $(elemento).attr('readonly', true); 
          $(elemento).attr('disabled',true);
        }

        if (elemento.id == 'total') {
          $(elemento).attr('readonly', true); 
          $(elemento).attr('disabled',true);
        }
									
												});
}  


$('#form-dinamico').show();

// $('#form-dinamico-rechazo').show();

$('#btnImpresion').hide();



function cerrarTarea() {
 debugger;
     
    
       if ( $("#rechazo").is(":checked")) {
       

        if ($('#motivo_rechazo_interno .form-control').val() == null ) {
       Swal.fire(
                        'Error!',
               'Por favor complete el campo Motivo de rechazo interno',
                 'error'
            )
          return;
      }

      if ($('#motivo_rechazo_cliente .form-control').val() == null) {
       Swal.fire(
                        'Error!',
               'Por favor complete el campo Motivo de rechazo al cliente',
                 'error'
            )
          return;
      }



         const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({

        title: 'Estas Seguro que desea rechazar el pedido de trabajo?',
       
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        debugger;
        console.log(result);
        if (result.value) {
            console.log('El usuario decidio rechazar el pedido de trabajo');
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

      $.ajax({
          type: 'POST',
          data: dataForm,
          cache: false,
          contentType: false,
          processData: false,
          url: '<?php  base_url() ?>index.php/<?php echo BPM ?>Proceso/cerrarTarea/' + id,
          success: function(data) {
              //wc();
          //   back();
          linkTo('<?php echo BPM ?>Proceso/');

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


        } else if (result.dismiss === Swal.DismissReason.cancel) {
            console.log('El usuario decidio NO rechazar el pedido de trabajo');
            swalWithBootstrapButtons.fire(
                'Cancelado',
                '',
                'error'
            )
        }
    })



//else (si el usuario indica si)
      } else{

//         var guardado = cerrarTareaform();

// if(!guardado){
//  return;
// }

        debugger;

      var frm_info_id = $('#form-dinamico .frm').attr('data-ninfoid');
     
      
      var id = $('#taskId').val();
      console.log(id);

      var dataForm = new FormData($('#generic_form')[0]);

      dataForm.append('taskId', $('#taskId').val());

      dataForm.append('frm_info_id', frm_info_id);

      $.ajax({
          type: 'POST',
          data: dataForm,
          cache: false,
          contentType: false,
          processData: false,
          url: '<?php // base_url() ?>index.php/<?php  echo BPM ?>Proceso/cerrarTarea/' + id,
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

    
  }



 
</script>

<script>  
  var band = 0;
  // Se peden hacer dos cosas: o un ajax buscando datos o directamente
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
          // info para immprimir  medidas_yudica
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

  function verModalCotizacion() {
    // levanto modal con img de Codigo
    $("#modalCotizacion").modal('show');
}

</script>


<!-- Modal descarga de Cotizacion -->
<div class='modal fade' id='modalCotizacion' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>

    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' onclick='cierraModalImpresion()' aria-label='Close'><span
                        aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Preview Cotización</h4>
            </div>
            <div class='modal-body modalBodyCodigos' id='modalBodyCodigos'>

                <div class="container-fluid">
                    <div class="col-md-6">
                    <img src="<?php echo base_url() ?>imagenes/sein/cabezera_presupuest.png" width="300" height="200"
                        id='imagenSein'>
                    </div>

                    <div class="col-md-6 center-block">
                   <h4>PRESUPUESTO</h4>
                   <br>
                 <strong><?php echo 'N° '. $cotizacion->petr_id .'-'. $cotizacion->coti_id;  ?></strong>
                   <p>Documento no valido como factura</p>
                   <br>
                   <p>FECHA</p>
                   <strong><?php echo $pedido_trabajo->fec_inicio ?></strong>
                   <br><br>
                   <p>C.U.I.T. N° 30-71038566-8 Ing.Brutos 918-651825-7</p>
                    </div>
                    <table class="col-md-12" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th class=""><?php echo $pedido_trabajo->nombre_cliente; ?></th>
                                <th class=""></th>
                                <th class=""></th>
                                <th class=""></th>
                                <th class=""></th>
                                <th class=""></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class=""><?php echo $pedido_trabajo->dir_entrega; ?></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                            </tr>
                            <tr>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                            </tr>
                            <tr>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                            </tr>
                            <tr>
                                <td class=""><strong>PLAZO DE ENTREGA</strong></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                            </tr>
                            <tr>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""></td>
                                <td class=""><strong>FORMA DE PAGO</strong></td>
                                <td class=""><?php echo str_replace(empresa()."-fopa_id", "", $cotizacion->fopa_id); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-------------------------------------------------------->




                    <div class="col-md-12 col-sm-12 col-xs-12 centrar">
                        <h5>VALIDEZ DEL PRESUPUESTO A PARTIR DE LA FECHA:</h5>
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
                                <tbody>
                                    <?php
							foreach($detallecotizacion as $rsp2){


								$cantidad = $rsp2->cantidad;
								$descripcion = $rsp2->descripcion;
								$precio_unitario = $rsp2->precio_unitario;
								$importe = $rsp2->importe;
								$coti_id = $rsp2->coti_id;
                                $deco_id = $rsp2->deco_id;

								echo "<tr id='$coti_id' data-json='" . json_encode($rsp2) . "'>";
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
                                <div class="col-sm-7"><strong>A LOS PRECIOS COTIZACIOS SE LES DEBE AGREGAR EL I.V.A CORRESPONDIENTE</strong></div>
                                <div class="col-sm-4">
                                    <label class="control-label" for="footer_table">Total:<strong
                                            style="color: #dd4b39">*</strong>:</label>
                                    <div class="input-group" style="display:inline-flex;">
                                        <input id="footer_table2" name="footer_table2" type="text"
                                            class="form-control input-md" value="<?php echo 'ARS $'.(number_format($totalCotizacion,2))?>" readonly> 
                                    </div>
                                </div>
                                <div class="col-sm-1"></div </div>
                                <!--_______ FIN TABLA PRODUCTOS ______-->
                            </div>
                        </div>
                        <br><br>
                     <strong>Esta mercadería será facturada en Pesos según cotización dólar BNA Vendedor del día anterior a la factura y ajustada con NC/ND según
CANTIDAD DESCRIPCION PRECIO UNIT.
PLAZO DE ENTREGA
VALIDEZ DEL PRESUPUESTO A PARTIR DE LA FECHA:
dólar BNA vendedor del día anterior al pago (+/- 1 %).</strong>
                    </fieldset>
                        </form>
<p>OBSERVACIONES</p>
                    </div>

                    <!-- / Bloque de cotizacion -->

                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-default' onclick='cierraModalImpresion()'>Cancelar</button>
                <button type='button' class='btn btn-primary' onclick='imprimirInfoQR()'>Imprimir</button>
            </div>
        </div>
    </div>
</div>
<!-- Fin modal descarga de Cotizacion -->

<script>
    // impresion de etiqueta
function imprimirInfoQR() {
    var base = "<?php echo base_url()?>";
    $('.modalBodyCodigos').printThis({
        debug: false,
        importCSS: false,
        importStyle: true,
        pageTitle: "TRAZALOG TOOLS",
        printContainer: true,
        //header: "<h1 style='text-align: center;'>Reporte Articulos Vencidos</h1>",
        loadCSS: "",
        copyTagClasses: true,
        afterPrint: function() {
            cierraModalImpresion();
        },
        base: base
    });
}
// cerrar modal
function cierraModalImpresion() {
    // levanto modal con img de Codigo
    $("#modalCotizacion").modal('hide');
}
</script>