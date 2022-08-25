<style>
.frm-save {
    display: none;
}

input[type=radio] {
    transform: scale(1.6);
}
</style>
<hr>


<?php #kMarchan
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalGenerico');
?>

<h3>Evaluacion de estado de cuenta del cliente <small></small></h3>
    <div class="form-group">
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Código de pedido:</label>
            <div class="col-md-2">
                <input id="codigo_cliente" name="textinput" type="text" placeholder="" class="form-control input-md"
                    readonly>
            </div>

            <label class="col-md-2 control-label" for="textinput">Cliente:</label>
            <div class="col-md-2">
                <input id="nomb_cliente" name="textinput" type="text" placeholder="" class="form-control input-md"
                    readonly>
            </div>
            <label class="col-md-2 control-label" for="textinput">Email:</label>
            <div class="col-md-2">
                <input id="email_cliente" name="textinput" type="text" placeholder="" class="form-control input-md"
                    readonly>
            </div>

            
            <br>
            <br>
            <hr>
            
      <!-- Formulario dinamico de la vista       -->
<?php
// ver
// flata funcion que desplega formulario asociado a la vista
// los formularios dinamicos se cargar de la tabla pro.procesos_forms

 $aux =json_decode($data);


$formularios = $aux->formularios;

if($aux){
                                

  foreach ($formularios as $clave => $valor) {

    foreach ($valor as $v2) {
      if($v2->orden == '1'){
        echo '<div id="form-dinamico" class="frm-new" data-form="'.$v2->form_id.'"></div>';
      }
      else if($v2->orden == '2'){
        echo '<div id="form-dinamico-rechazo" class="frm-new" data-form="'.$v2->form_id.'"></div>';
      }
    else{
      echo '<div id="form-dinamico" class="frm-new" data-form="'.$v2->form_id.'"></div>';
    }
  }
 
          }
                     }
  

?>


  <form id="generic_form">
            <div class="form-group">
                <center>
                    <h3 class="text-danger"> ¿Cumple con los criterios de aceptación? </h3>
                    <label class="radio-inline">
                        <input id="aprobar" type="radio" name="result" value="true"> si
                    </label>
                    <label class="radio-inline">
                        <input id="rechazo" type="radio" name="result" value="false"> no
                    </label>
                </center>
            </div>


</form>



<button type="" class="btn btn-primary habilitar" data-dismiss="modal" id="btnImpresion"
    onclick="modalCodigos()">Impresion</button>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos del Comprobante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="comprobante" class="form-group motivo">
                    <table class="table" id="tbl_comprobante">
                        <thead>
                            <tr>
                                <th scope="col">Numero de cubiertas</th>
                                <th scope="col">Numero de pedido</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Medida</th>
                                <th scope="col">Marca</th>
                                <th scope="col">N° de Serie</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input id="num_cubiertas" name="num_cubiertas" type="text" value=""
                                        class="form-control input-md"></td>
                                <td><input id="num_pedido" name="num_pedido" type="text" value=""
                                        class="form-control input-md"></td>
                                <td><input id="medidas_yudica" name="medidas_yudica" type="text" value=""
                                        class="form-control input-md"></td>
                                <td><input id="marca_yudica" name="marca_yudica" type="text" value=""
                                        class="form-control input-md"></td>
                                <td><input id="num_serie" name="num_serie" type="text" value=""
                                        class="form-control input-md"></td>
                                <td><input id="banda_yudica" name="banda_yudica" type="text" value=""
                                        class="form-control input-md"></td>
                            </tr>

                        </tbody>
                    </table>
                    <br><br><br>
                    <a type="button" href="<?php echo base_url();?>" class="btn btn-primary" target="_blank">Imprimir
                        comprobante de Rechazo</a>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
function getFormData() {
    debugger;
    var array_form = {};
    $('#form-dinamico-cabecera').find(':input').each(function() {
        array_form[this.name] = this.value;

    });

    $.each(array_form, function(index, value) {
        console.log(index + ": " + value);

    });


}

getFormData();

detectarForm();
    initForm();
 
 
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
    
$('#codigo_cliente').val($('#codigo_proyecto').val());
    
$('#email_cliente').val($('#email').val());

$('#nomb_cliente').val($('#cliente').val());


}
 
    $('#form-dinamico').show();



function mostrarForm() {

    detectarForm();
    initForm();

    $('#form-dinamico').show();
    $('#titulo').show();
    $('#form-dinamico-rechazo').hide();
    $('#comprobante').hide();
    // oculta btn para imprimir
    $('#btnImpresion').hide();
}

function ocultarForm() {

    detectarForm();
    initForm();

    // $('#motivo').show();
    $('#form-dinamico-rechazo').show();

    $('#comprobante').show();
    $('#hecho').prop('disabled', false);
    $('#form-dinamico').hide();
    $('#titulo').hide();
    // muestra btn para imprimir
    $('#btnImpresion').show();

}
// ver esta parte
// $('#form-dinamico').hide();
// $('#titulo').hide();
$('#comprobante').hide();
// $('#motivo').show();
$('#form-dinamico-rechazo').show();

$('#btnImpresion').hide();



async function cerrarTareaform(){
    resp = {};
    if (!frm_validar('#form-dinamico')) {
  
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
   var confirma = await cerrarTareaform();

    if(!resp.confirma){
        wc();
        return;
    }
 
    var id = $('#taskId').val();
    var dataForm = new FormData($('#generic_form')[0]);
   
    dataForm.append('frm_info_id', resp.info_id);

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

<script>
// #HGallardo
var band = 0;
// Se peden hacer dos cosas: o un ajax buscando datos o directamente
// armar con los datos de la pantalla
function modalCodigos() {

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

function armarInfo(arraydatos) {

    $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>/Infocodigo/rechazado", arraydatos);
}
</script>