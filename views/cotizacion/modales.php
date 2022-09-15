<div class='modal fade' id='modalCotizacion' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
    <div class='modal-dialog modal-xl' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' onclick='cierraModal()' aria-label='Close'><span
                        aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title' id='myModalLabel'>Cotización</h4>
            </div>
            <div class='modal-body modalBodyCodigos' id='modalBodyCodigos'>

                <div class="container-fluid">
                    <div style="display: flex;">

















					
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
                        <tbody>
                        <?php

        $aux =json_decode($detalles_coti);

        $cotizacion = $aux->cotizacion;
        
							foreach($cotizacion as $rsp){


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
                        

				
			</div>
		</div>
	</body>
</html>




<!----------------------------------------------------->
                    </div>
                </div>
                <!-- Info qe va abajo del QR -->
                <div id="infoFooter"></div>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-default' onclick='cierraModalImpresion()'>Cancelar</button>
            <button type='button' class='btn btn-primary' onclick='imprimirInfoQR()'>Imprimir</button>
        </div>
    </div>
</div>


<script>
// trae codigo QR con los datos recibidos y agrega en modal
function getQR(config, data, direccion) {
    // debugger;
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: {
            config,
            data,
            direccion
        },
        url: 'index.php/<?php echo COD ?>Codigo/generarQR',
        success: function(result) {

            if (result != null) {
                var qr = '<img  id="codigoImage" src="' + result.filename + '" alt="codigo qr" >';

                // agrego codigo Qr al modal
                $('#contenedorCodigo').append(qr);
            }
        },
        error: function(result) {

        },
        complete: function() {

        }
    });
}
// impresion 
function imprimirInfo() {
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