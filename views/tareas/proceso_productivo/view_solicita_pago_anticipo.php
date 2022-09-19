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
<br><br>  
<div id="form-dinamico" class="frm-new" data-form="60"></div>
<br> <br>
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
    debugger;

    $('#nom_cliente').val($('#cliente').val());

    $('#total').val('ARS $3630.00');

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
</script>