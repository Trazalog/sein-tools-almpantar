<div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="box-title">Informe del Proceso</h4>
    </div>
    <div class="box-body" id="mdl-vista">
     
    <?php
								echo "<td class='text-center text-light-blue'>";
								echo '<i class="fa fa-trash-o" style="cursor: pointer;margin: 3px;" title="Eliminar" onclick="Eliminar(this)"></i>';
								echo '<i class="fa fa-print" style="cursor: pointer; margin: 3px;" title="Imprimir Comprobante" onclick="modalReimpresion(this)"></i>';
								echo '<i class="fa fa-search"  style="cursor: pointer;margin: 3px;" title="Ver Pedido" onclick="verPedido(this)"></i>';
								echo "</td>";
							
			
						?>
          <div id="cabecera"></div>
<input id="tarea" data-info="" class="hidden">
<input type="text" class="form-control hidden" id="asignado" value="">
<input type="text" class="form-control hidden" id="taskId" value="">
<input type="text" class="form-control hidden" id="caseId" value="">

<div class="nav-tabs-custom ">
    <ul class="nav nav-tabs">
        <!-- <li class="active"><a href="#tab_4" data-toggle="tab" aria-expanded="false">Acciones</a></li> -->
        
        <li class="active"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Trazabilidad</a></li>
        <li class="privado"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Comentarios</a></li>
        <li class="privado"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Información</a></li>
        <li class="privado"><a href="#tab_5" data-toggle="tab" aria-expanded="true">Formulario</a></li>
        <!-- <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
				Dropdown <span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Vista Global</a></li>
				<li role="presentation" class="divider"></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
			</ul>
		</li> -->
        <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->

    </ul>
    <div class="tab-content">
  
        <div class="tab-pane" id="tab_1">
                  <div id="cargar_info_actual"></div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div id="cargar_comentario"></div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_3">
                <div id="cargar_trazabilidad"></div>
                </div>

                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_5">
                    <div id="cargar_form"></div>
                </div>
        </div>
    </div>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal modal-fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="xmodal-body">
  


            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- The Modal -->
<div class="modal modal-fade" id="mdl-form-dinamico" data-backdrop="static">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <br>
                        <div class="xmodal-body">
                            <br>
                            <div id="form-dinamico" data-frm-id="">

                      </div>
<br>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <br>
                            <button type="button" class="btn" onclick="cerrarModalform()">Cerrar</button>
                            <!--       <button type="button" id="btn-accion" class="btn btn-primary btn-guardar" onclick="guardarTodo()">Guardar</button>-->
                        </div>
                    </div>
                </div>
            </div>
<script>



//funcion ver pedido
// parametro petr_id y case_id
//
function verPedido(e) {
	wo();
	petr_id = $(e).closest('tr').attr('id');
	case_id = $(e).closest('tr').attr('case_id');
	console.log('trae pedido N°: ' + petr_id)
	console.log('trae case_id N°: ' + case_id)

	var url = "<?php echo base_url(BPM); ?>Pedidotrabajo/cargar_detalle_comentario?petr_id=" + petr_id + "&case_id=" + case_id;
	var url1 = "<?php echo base_url(BPM); ?>Pedidotrabajo/cargar_detalle_formulario?petr_id=" + petr_id + "&case_id=" + case_id;
	var url2 = "<?php echo base_url(BPM); ?>Pedidotrabajo/cargar_detalle_linetiempo?case_id=" + case_id;
	var url3 = "<?php echo base_url(BPM); ?>Pedidotrabajo/cargar_detalle_info_actual?case_id=" + case_id;
    header = "<?php echo base_url(BPM); ?>Pedidotrabajo/cargar_detalle_cabecera?case_id=" + case_id;

    $("#cabecera").empty();
    $("#cabecera").load(header);

	$("#cargar_comentario").empty();
	$("#cargar_comentario").load(url, () => {
		// $('#mdl-vista').modal('show');
		wc();
	});

	$("#cargar_form").empty();
	$("#cargar_form").load(url1, () => {
		// $('#mdl-vista').modal('show');
		wc();
	});

	$("#cargar_trazabilidad").empty();
	$("#cargar_trazabilidad").load(url2, () => {
		// $('#mdl-vista').modal('show');
		wc();
	});

	$("#cargar_info_actual").empty();
	$("#cargar_info_actual").load(url3, () => {
		// $('#mdl-vista').modal('show');
		wc();
	});
	
}



// obtine datos ya mapeados para QR y cuerpo de a etiqueta
function getDatos(datos, config) {

    var infoid = datos.info_id;
    var estado = datos.estado;
    var cliente = datos.nombre;
    var trabajo = datos.tipo_trabajo;
    var N_orden = datos.petr_id;
    var Cod_proyecto = datos.cod_proyecto;
    var motivo = datos.motivo_rechazo;

    $.ajax({
        type: 'GET',
        url: "<?php echo base_url(YUDIPROC); ?>Infocodigo/mapeoDatos/" + infoid,
        success: function(result) {
debugger;
            var datMapeado = JSON.parse(result);
            datMapeado.Cliente = cliente;
            datMapeado.Trabajo = trabajo;
            datMapeado.N_orden = N_orden;
            datMapeado.Motivo = motivo;

            console.log('data mapeado: ');
            console.table(datMapeado);
            // cargarInfoReimp(datMapeado, estado, config, 'codigosQR/Traz-comp-Yudica');
            cargarInfoReimp(datMapeado, estado, config, 'codigosQR/Traz-comp-Yudica');
        },
        error: function(result) {

        },
        complete: function() {

        }
    });

}
//  carga el modal con cuerpo y codigo QR
function cargarInfoReimp(datMapeado, estado, config, direccion) {
    // debugger;
    switch (estado) {
        case 'estados_yudicaEN_CURSO':
            //Comprobante 1
            //agrega cuerpo de la etiqueta
            $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>Infocodigo/pedidoTrabajo", datMapeado);
            // agrega codigo QR al modal impresion
            getQR(config, datMapeado, direccion);
            break;

        case 'estados_yudicaREPROCESO':
            //Comprobante 1
            $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>Infocodigo/pedidoTrabajo", datMapeado);
            // agrega codigo QR al modal impresion
            getQR(config, datMapeado, direccion);
            break;

        case 'estados_yudicaRECHAZADO':
            //Comprobante 2
            $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>Infocodigo/rechazado", datMapeado);
            // agrega codigo QR al modal impresion
            // getQR(config, datMapeado, direccion);
            break;

        case 'estados_yudicaENTREGADO':
            // Comprobante 3
            $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>Infocodigo/pedidoTrabajo", datMapeado);
            // agrega codigo QR al modal impresion
            getQR(config, datMapeado, direccion);
            $("#infoFooter").load("<?php echo base_url(YUDIPROC); ?>Infocodigo/pedidoTrabajoFooter");
            break;

        default:
            // code...
            break;
    }

    return;
}
</script>