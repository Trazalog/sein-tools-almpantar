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

<h3>Generar Remito y Factura<small></small></h3>
<br> <br>
<div id="form-dinamico" class="frm-new" data-form="58"></div>
    <br><br>  


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

  function getFormData(){

    var array_form = {};
    $('#form-dinamico-cabecera').find(':input').each(function() {
      array_form[this.name] = this.value;

      });

    $.each(array_form, function( index, value ) {
        console.log( index + ": " + value );
 
    });


  }
  $('#nomb_cliente').val($('#cliente').val());
  
  getFormData();


  detectarForm();
  initForm();
 
  // $('#form-dinamico').show();
  $('#form-dinamico-rechazo').hide();

  

function ocultarForm(){


$('#form-dinamico-rechazo').show();


$('#hecho').prop('disabled',false);



}

$('#form-dinamico').show();

 //////////////////////////////////

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