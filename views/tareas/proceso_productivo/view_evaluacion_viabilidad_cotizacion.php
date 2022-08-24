<style>
.frm-save {
    display: none;
}
input[type=radio]{
  transform:scale(1.6);
}
</style>
<hr>


<?php // #kMarchan
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalGenerico');
?>

<h3>Viabilidad de Cotización<small></small></h3>
<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Es viable cotizar? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true" onclick="mostrarForm()"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false" onclick="ocultarForm()"> No
            </label>
        </center>
    </div>
    <hr>

    <br>
 
</form>

<div id="form-dinamico-rechazo" class="frm-new" data-form="55"></div> 

<button type="" class="btn btn-primary habilitar" data-dismiss="modal" id="btnImpresion" onclick="modalCodigos()">Impresion</button>



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
      // $('#btnImpresion').show();

  }

  $('#form-dinamico').hide();
  $('#titulo').hide();
  $('#comprobante').hide();
   // $('#motivo').show();
   $('#form-dinamico-rechazo').show();

  $('#btnImpresion').hide();


 
 



    async function cerrarTareaform(){
    resp = {};

    if ( $("#rechazo").is(":checked")) {
    debugger; 

  if ($('#rechazo').prop('checked') && $('#motivo_rechazo_interno').val() == '' && $('#motivo_rechazo_cliente').val() == '') {
      Swal.fire(
        'Oops...',
        'Debes completar los campos Obligatorios (*)',
        'error'
          )
            
       }
    }

    if (!frm_validar('#form-dinamico-rechazo')) {
  
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
    var dataForm = new FormData();
   
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