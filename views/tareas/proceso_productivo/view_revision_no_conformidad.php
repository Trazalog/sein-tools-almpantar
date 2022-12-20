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

<h3>Revision de no conformidad<small></small></h3>

<div id="form-dinamico" class="frm-new" data-form="63"></div>
<br> <br>

<form id="generic_form">
  <div class="form-group">
    <center>
        <h3 class="text-danger">¿El trabajo puede solucionarse?</h3>
        <label class="radio-inline">
            <input id="aprobar" type="radio" name="result" value="true"
            onclick="mostrarForm()"> Si
        </label>
        <label class="radio-inline">
            <input id="rechazo" type="radio" name="result" value="false"  onclick="ocultarForm()"> No
        </label>
    </center>
  </div>
</form>
<br><br> 
<div id="form-solucion" class="frm-new" data-form="64"></div>
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
    $('#form-dinamico').find(':input').each(function() {
      var elemento= this;
      console.log("elemento.id="+ elemento.id); 
      if (elemento.id == 'tipo_trabajo') {
        $(elemento).val('<?php echo $tipo_trajo ? $tipo_trajo : '' ?>');
          $(elemento).attr('readonly', true); 
        }
      if (elemento.id == 'descripcion') {
        $(elemento).val('<?php echo $descripcion ? $descripcion : '' ?>');
        $(elemento).attr('readonly', true); 
      }

      if (elemento.id == 'observaciones') {
        $(elemento).val('<?php echo $observaciones ? $observaciones : '' ?>');
        $(elemento).attr('readonly', true); 
      }

      if (elemento.id == 'justificacion') {
        $(elemento).val('<?php echo $justificacion ? $justificacion : '' ?>');
        $(elemento).attr('readonly', true); 
      }
  });
}  
  function getFormData(){
    var array_form = {};
    $('#form-dinamico-cabecera').find(':input').each(function() {
      array_form[this.name] = this.value;
    });
  }

  getFormData();
  detectarForm();
  initForm();
  $('#form-solucion').hide();

  function mostrarForm(){
    $('#form-solucion').show();
  }

function ocultarForm(){
  $('#form-solucion').hide();
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
  if ($('#aprobar').prop('checked')){
    if($('#propuesta_solucion').val() == '') {
      resp.confirma = false;
      error('Oops...','Debes completar la propuesta de solución (*)');
    }else{
      resp.confirma = true;
      resp.info_id = await frmGuardarConPromesa($('#form-dinamico').find('form'));
      resp.info_id_solucion = await frmGuardarConPromesa($('#form-solucion').find('form'));
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
  resp.info_id_solucion ? dataForm.append('frm_info_id_solucion', resp.info_id_solucion) : '';

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