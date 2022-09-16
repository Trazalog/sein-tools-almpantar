<style>
.frm-save {
    display: none;
}
</style>
<hr>
<!-- / Modal -->
<?php
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalGenerico');
?>

<h3>Paletizar y despachar<small></small></h3>
<br> <br>
<div id="form-dinamico" class="frm-new" data-form="66"></div>
<br> <br>

<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Hay más para entregar? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false" onclick="modalCodigos()"> No
            </label>
        </center>
    </div>
   
    </form>
    <br><br>  
    <input id="url_link" name="url_link" type="text"   class="form-control input-md">

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
  detectarForm();
      initForm();

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
   

    $('#codigo_pedido').val($('#codigo_proyecto').val());

    $('#descripcion_cotizacion').val($('#descripcion').val());
    
    
    $('#dir_entrega_cliente').val($('#dir_entrega').val());

    $('#form-dinamico').find(':input').each(function() {
	
        var elemento= this;
		console.log("elemento.id="+ elemento.id); 
   
      if (elemento.id == 'codigo_pedido') {
        //   $(elemento).attr('readonly', false); 
        //   $(elemento).attr('disabled',true);
        }

        if (elemento.id == 'descripcion_cotizacion') {
        //   $(elemento).attr('readonly', false); 
        //   $(elemento).attr('disabled',true);
        }

        if (elemento.id == 'dir_entrega_cliente') {
        //   $(elemento).attr('readonly', false); 
        //   $(elemento).attr('disabled',true);
        }
									
												});

    }


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


<!-- <button type="" class="btn btn-primary habilitar" data-dismiss="modal" id="btnImpresion"
    onclick="crearUrlQr()">Impresion</button> -->

    
<script>  

 function crearUrlQr() {
    debugger;
    var datos = {};

//    petr_id = $('#petr_id').val();
    case_id = $('#caseId').val();


    datos.id = case_id;
    datos.funcion= 'PRO.verEstadoPedidoTrabajo';


    $.ajax({
        type: 'POST',
        data: datos,
        url: '<?php echo COD ?>Url/generarLink',
        success: function(data) {
            url = JSON.parse(data)
            console.log("la url es:"+ url.url);

            dato_linck = url.url;

            $('#url_link').val(dato_linck);
        },
        error: function(data) {
            wc();
            error('',"Se produjo un error al cerrar la tarea");
        }
    });
}

crearUrlQr();

  var band = 0;
  // Se peden hacer dos cosas: o un ajax buscando datos o directamente
  // armar con los datos de la pantalla  

  function modalCodigos(){
debugger;
      


      if (band == 0) {
        debugger;
          // configuracion de codigo QR
          var config = {};
              config.titulo = "Servicios Industriales";
              config.pixel = "3";
              config.level = "S";
              config.framSize = "2";
          // info para immprimir  
          var arraydatos = {};
              arraydatos.N_orden = $('#petr_id').val();
              arraydatos.Fabricado = 'Servicios Industriales';
              arraydatos.Cliente = $('#cliente').val();
              arraydatos.fec_fabricacion = $('#fec_fabricacion').val();
              arraydatos.fec_entrega = $('#fec_entrega').val();
              arraydatos.dato_linck =   $('#url_link').val();
          // info para grabar en codigo QR
          armarInfo(arraydatos);

          getQR(config, arraydatos, 'codigosQR/Sein-almpantar');

      }
      // llama modal con datos e img de QR ya ingresados
      verModalImpresion();

      band = 1;
  }

  function armarInfo(arraydatos){

    $("#infoEtiqueta").load("<?php echo base_url(SEIN); ?>/Infocodigo/pedidoTrabajoFinal", arraydatos);
  }
</script>