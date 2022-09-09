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

<?php
					// carga el modal de cotizacion
					$this->load->view(SEIN.'cotizacion/presupuesto.php');
?>
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