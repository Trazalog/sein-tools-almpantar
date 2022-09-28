<style>
.frm-save {
    display: none;
}
input[type=radio]{
  transform:scale(1.6);
}
</style>
<?php 
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalGenerico');
?>

<h3>Revision de OC (orden de compra) y archivo <small></small></h3>
<div id="form-dinamico" class="frm-new" data-form="58"></div>
<br><br>
<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Requiere anticipo? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true" onclick="ocultarForm()"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false" onclick="ocultarForm()"> No
            </label>
        </center>
    </div>
</form>
<br><br>  
<div id="form-dinamico-justificacion" class="frm-new" data-form="59"></div>

<script>
$('#nomb_cliente').val($('#cliente').val());
getFormData();
detectarForm();
initForm(); 
$('#form-dinamico-justificacion').hide();
$('#form-dinamico').show();
////////////////////////////////
function getFormData(){
    var array_form = {};
    $('#form-dinamico-cabecera').find(':input').each(function() {
      array_form[this.name] = this.value;
    });
}

function ocultarForm(){
    if($("#aprobar").is(":checked")){
       $('#form-dinamico-justificacion').show();
    }else{
        $('#form-dinamico-justificacion').hide();
    }
}

//////////////////////////////////
async function cerrarTareaform(){
    resp = {};
    if (frm_validar('#form-dinamico') && ($("#aprobar").is(":checked") || $("#rechazo").is(":checked"))) {
        resp.confirma = true;
        resp.info_id = await frmGuardarConPromesa($('#form-dinamico').find('form'));
        if($("#aprobar").is(":checked")){
            resp.info_id_justificacion = await frmGuardarConPromesa($('#form-dinamico-justificacion').find('form'));
        }
        
        return new Promise(resolve => {resolve(resp)});
    }else{
        error('Oops...','Debes completar los campos obligatorios (*)');
        resp.confirma = false;
            
        return new Promise(reject => {reject(resp)});
    }
}

async function cerrarTarea() {
    wo(); 
    var confirma = await cerrarTareaform();

    if(!resp.confirma){
      wc();
        return;
    }
 
    var id = $('#taskId').val();
    var dataForm = new FormData($('#generic_form')[0]);
    dataForm.append('frm_info_id', resp.info_id);
    resp.info_id_justificacion ? dataForm.append('frm_info_id_justificacion', resp.info_id_justificacion) : '';
  
    $.ajax({
        type: 'POST',
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        url: '<?php base_url() ?>index.php/<?php echo BPM ?>Proceso/cerrarTarea/' + id,
        success: function(data) {
            wc();
            var fun = () => {linkTo('<?php echo BPM ?>Proceso/');}
            confRefresh(fun);
        },
        error: function(data) {
            wc();
            error('',"Se produjo un error al cerrar la tarea");
        }
    });
}
</script>