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
<h3>Control final del trabajo<small></small></h3>
<div id="form-dinamico" class="frm-new" data-form="62"></div>
<br> <br>
<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Aprobar trabajo? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false" onclick="ocultarForm()"> No
            </label>
        </center>
    </div>
   
    </form>
    <br><br>  
<div id="form-dinamico-rechazo" class="frm-new" data-form="59"></div>
<script>
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
  $('#tipo_trajo').val($("#tipo_proyecto").val());
  $('textarea[name="descripcion"]').val($("#descripcion").val());
  $('#form-dinamico').find(':input').each(function() {
    var elemento= this;
    if (elemento.id == 'tipo_trajo') {
      $(elemento).attr('readonly', true); 
    }

    if (elemento.id == 'descripcion') {
      $(elemento).attr('readonly', true);
    }				
  });
}  

detectarForm();
initForm();
// $('#form-dinamico').show();
$('#form-dinamico-rechazo').hide();
function mostrarForm(){
  $('#form-dinamico').show();
  $('#titulo').show();
  $('#form-dinamico-rechazo').hide();
  $('#comprobante').hide();
  // oculta btn para imprimir
  $('#btnImpresion').hide();
}
function ocultarForm(){
  $('#form-dinamico-rechazo').show();
  $('#hecho').prop('disabled',false);

}
$('#form-dinamico').show();
$('#btnImpresion').hide();

async function validarRechazo(){
  let validacion = new Promise(function(res,rej){
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })
  
    swalWithBootstrapButtons.fire({
      title: '¿Está seguro que desea rechazar el pedido de trabajo?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        res(true);
      }else{
       res(false);
      }
    })
  });
  return await validacion;
}
async function cerrarTareaform(){
  resp = {};
  if ($('#rechazo').prop('checked')){
    if($('#justificacion').val() == '') {
      resp.confirma = false;
      error('Oops...','Debes completar la justificación (*)');
    }else{
      resp.confirma = true;
      resp.info_id = await frmGuardarConPromesa($('#form-dinamico').find('form'));
      resp.info_id_justificacion = await frmGuardarConPromesa($('#form-dinamico-rechazo').find('form'));
    }
  }else{
    resp.confirma = true;
    resp.info_id = await frmGuardarConPromesa($('#form-dinamico').find('form'));
  }
  return new Promise(resolve => {resolve(resp)});
}
async function cerrarTarea() {
  var validacion = await validarRechazo();
  if(!validacion) return;
  wo();
  var confirma = await cerrarTareaform();
  
  if(!resp.confirma){
    wc();
    return;
  }

  var id = $('#taskId').val();
  var dataForm = new FormData($('#generic_form')[0]);
  dataForm.append('frm_info_id', resp.info_id);
  dataForm.append('taskId', $('#taskId').val());
  resp.info_id_justificacion ? dataForm.append('frm_info_id_justificacion', resp.info_id_justificacion) : '';

  $.ajax({
      type: 'POST',
      data: dataForm,
      cache: false,
      contentType: false,
      processData: false,
      url: '<?php // base_url() ?>index.php/<?php  echo BPM ?>Proceso/cerrarTarea/' + id,
      success: function(data) {
        wc();
        var fun = () => {linkTo('<?php echo BPM ?>Proceso/');}
        confRefresh(fun);
      },
      error: function(data) {
        error("Error");
      }
  });
}
</script>