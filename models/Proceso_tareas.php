<?php

use Google\Service\AIPlatformNotebooks\Status;

 if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Proceso_tareas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

         $this->load->model(SEIN . 'Cotizaciones');
        // $this->load->model(ALM . 'Notapedidos');
        // $this->load->model(ALM . 'new/Pedidosmateriales');
        // $this->load->model(ALM . 'Pedidoextra');

    }

    public function map($tarea)
    {
        $ci =& get_instance();
        $nom_tarea = $tarea->nombreTarea;
        $task_id = $tarea->taskId;
        $case_id = $tarea->caseId;
        $user_app = userNick();
        $aux_pedido = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
        $data_generico =json_decode($aux_pedido["data"]);
        $data =json_decode($aux_pedido["data"]);
        $aux_pedido = $data_generico->pedidoTrabajo;
        

        
        if(isset($case_id)){
            $aux = new StdClass();
            $aux->color = 'info'; //primary //secondary // success // danger // warning // info // light // dark //white 
            $aux->texto = "N° Orden:  $aux_pedido->petr_id";
            $array['info'][] = $aux;
            
            $aux = new StdClass();
            $aux->color = 'success'; 
            $aux->texto = "N° Codigo:  $aux_pedido->cod_proyecto";
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'primary';
            $aux->texto = "Objetivo:  $aux_pedido->objetivo   $aux_pedido->unidad_medida";
            $array['info'][] =$aux;

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "Estado: $aux_pedido->estado ";
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'danger';
            $aux->texto = "Fecha Inicio: ".formatFechaPG( $aux_pedido->fec_inicio);
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'default';
            $aux->texto = "Fecha Entrega: ".formatFechaPG( $aux_pedido->fec_entrega);
            $array['info'][] = $aux;

            $array['descripcion'] =  $aux_pedido->descripcion;
        }else{

          //  $data = $this->Notapedidios->getXCaseId($tarea->caseId);

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "N° Pedido: ".$data['pema_id'];
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "Estado: ".$data['estado'];
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'default';
            $aux->texto = "Fecha: ".formatFechaPG($data['fecha']);
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'default';
            $aux->texto = "Justificacion: ".$data['justificacion'];
            $array['info'][] = $aux;

        }


        return $array;
    }

     public function getXCaseId($tarea)
    {
        $ci =& get_instance();

        $case_id = $tarea->caseId;

        $aux = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
        $data_generico =json_decode($aux["data"]);
        $aux = $data_generico->pedidoTrabajo;
        return $aux;
    }
   

    public function desplegarCabecera($tarea)
    {
        $resp = infoproceso($tarea);
        return $resp;
    }

  

    public function desplegarVista($tarea){
        $ci =& get_instance();
        $case_id = $tarea->caseId;
        $aux_pedido = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
        $data_generico =json_decode($aux_pedido["data"]);
        $data =json_decode($aux_pedido["data"]);
        $aux_pedido = $data_generico->pedidoTrabajo;

        $nombre_tarea = $tarea->nombreTarea;

        //funcion para eliminar acentos del nombre de la tarea si es que los trae.
        function eliminar_acentos($cadena){
		
            //Reemplazamos la A y a
            $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
            );
    
            //Reemplazamos la E y e
            $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena );
    
            //Reemplazamos la I y i
            $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena );
    
            //Reemplazamos la O y o
            $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena );
    
            //Reemplazamos la U y u
            $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena );
    
            //Reemplazamos la N, n, C y c
            $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
            );
            
            return $cadena;
        }
        // remplaso los espacios en blanco del nombre de la tarea
        $str_nombre_tarea = str_replace(" ", "%20",$nombre_tarea);
        // elimino los acentos del nombre de la tarea
        $str_nombre_tarea2 = eliminar_acentos($str_nombre_tarea);
        // guardo la empresa en variable $empr_id
        $empr_id = empresa();
       
        // inico variables para concatenar el resource de la llamada a la API
        $a1 = "/proceso/tarea/";
        $a2 = "/empresa";
        $resource = $a1.$str_nombre_tarea2.$a2;
       
        // llamo al servicio para traer los formularios asociados a la vista del proceso
        $data = $ci->rest->callAPI('GET',REST_PRO.$resource."/".$empr_id);
        log_message('DEBUG', 'SEIN -traer los formularios asociados a la vista del proceso ->' . $tarea->nombreTarea);
        log_message('DEBUG', 'SEIN - Formularios asociados a la vista ->' . json_encode($data));      
     

        // llamo al servicio para traer los formularios asociados a la vista del proceso
        $data = $ci->rest->callAPI('GET',REST_PRO.$resource."/".$empr_id);
        switch ($tarea->nombreTarea) {
            //paso 1 Evaluacion de Viabilidad.
            case 'Evalua si trabajo es viable':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad', $data, true);
            break;
            //paso 2 Evaluación del estado de cuenta del cliente
            case 'Evaluación del estado de cuenta del cliente':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evalua_estado_cuenta_cliente', $data, true);
            break;
            //paso 3 Evalua Viabilidad del Trabajo
            case 'Evalua Viabilidad del Trabajo':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad_cotizacion', $data, true);
            break;      
            //paso 4 Reevaluar pedido de cotización      
            case 'Reevaluar pedido de cotización':              
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_aprobacion_excepcional', $data, true);
            break;
            //paso 5 Cotización de trabajo           
            case 'Cotización de trabajo':
                $data['unme_id'] = $this->Cotizaciones->obtenerTablaEmpr_id('unme_id')['data'];
                $data['fopa_id'] = $this->Cotizaciones->obtenerTablaEmpr_id('fopa_id')['data'];
                $data['divi_id'] = $this->Cotizaciones->obtenerTablaEmpr_id('divi_id')['data'];
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_cotizacion_trabajo', $data, true);
            break; 
            //paso 6   Evalua cotización         
            case 'Evalua cotización':
                // llamo al servicio para traer datos de la cotizacion
                $resource2 = "/getCotizacion";       
                $data = $ci->rest->callAPI('GET',REST_SEIN.$resource2."/".$aux_pedido->petr_id);
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | LLAMADA DE EJEMPLO A WSO2 ->' . json_encode($data));   
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_cotizacion_trabajo',$data, true);
            break;
            //paso 7 Enviar Cotización           
            case 'Enviar Cotización':
                // llamo al servicio para traer datos de la cotizacion
                $resource2 = "/getCotizacion";       
                $data = $ci->rest->callAPI('GET',REST_SEIN.$resource2."/".$aux_pedido->petr_id);
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | LLAMADA DE EJEMPLO A WSO2 ->' . json_encode($data));
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_enviar_cotizacion', $data, true);
            break;
            //paso 8 Espera respuesta del cliente         
            case 'Espera respuesta de cliente':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_espera_respuesta_cliente', $data, true);
            break; 
            //paso 9 Analiza Vigencia. Condiciones y Cantidades del presupuesto aprobado          
            case 'Analiza Vigencia. Condiciones y Cantidades del presupuesto aprobado':
                // llamo al servicio para traer datos de la cotizacion
                $resource2 = "/getCotizacion"; 
                $aux = $ci->rest->callAPI('GET',REST_SEIN.$resource2."/".$aux_pedido->petr_id);
                $data['cotizacion'] = json_decode($aux['data'])->cotizacion;
                $data['pedido_trabajo'] = $aux_pedido;
                $rsp = $this->getDataFormulario($aux_pedido->info_id);

                foreach ($rsp as $value) {
                    switch ($value->name) {
                        case 'email':
                            $data['email'] = $value->valor;
                            break;
        
                        case 'email_alternativo':
                            $data['email_alternativo'] = $value->valor;
                            break;
        
                        case 'ofi_tecnica':
                            $data['ofi_tecnica'] = str_replace(empresa()."-oficina_tecnica", "", $value->valor);
                            break;
        
                        default:
        
                        break;
                    }
                }
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | LLAMADA DE EJEMPLO A WSO2 ->' . json_encode($data));   
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_analisis_vigencia', $data, true);
            break;
            //paso 10 Recepción de OC y archivo        
            case 'Recepción de OC y archivo':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_revision_oc_archivo', $data, true);
            break;
            //paso 11 Solicita pago anticipo       
            case 'Solicita pago anticipo':     
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_solicita_pago_anticipo', $data, true);
            break;  
            //paso 12 Recibe pago anticipo       
            case 'Recibe pago anticipo':                 
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_recibo_pago_anticipo', $data, true);
            break;          
            //paso 13 Ejecuta el Trabajo - Tools Tareas      
            case 'Ejecuta el Trabajo - Tools Tareas':           
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_ejecuta_trabajo', $data, true);
            break;   
            //paso 14 Realiza Control final del Trabajo     
            case 'Realiza Control final del Trabajo':                 
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | ' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_realiza_control_final', $data, true);
            break;
            //paso 15 Revision de la No Confirmidad    
            case 'Revision de la No Confirmidad':           
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas |' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_revision_no_conformidad', $data, true);
            break;
            //paso 16 Generar remito
            case 'Generar remito y factura':          
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas |' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_generar_remito', $data, true);
            break;    
            //paso 17 Coordinar entrega con el cliente
            case 'Coordinar entrega con el cliente':         
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas |' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_coordinar_entrega', $data, true);
            break; 
            //paso 18 Cerrar servicio y archivar legajo
            case 'Cerrar servicio y archivar legajo':           
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas |' . $tarea->nombreTarea);
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_cerrar_servicio', $data, true);
            break;
            //paso 19  Paletizar y Despachar
            case 'Paletizar y Despachar':         
                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_paletizar_despachar', $data, true);
                log_message('DEBUG', 'SEIN view -> Paletizar y Despachar' . $tarea->nombreTarea);
            break;    
            default:                                        
                log_message('DEBUG', 'SEIN view -> default' . $tarea->nombreTarea);
            break;
        }
    }
// Guardar Pedido de Trabajo
public function guardarForms($data){
    $url = REST_PRO . '/pedidoTrabajo/tarea/form';
    $rsp = $this->rest->callApi('POST', $url, $data);
    return $rsp;
    
    if (!$rsp) {
        log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL FORM');
    } else {
        log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> TODO OK');
    }
}
////////////////////////////////////////////////////////////////
    public function getContrato($tarea, $form){
        $ci =& get_instance();
        $nom_tarea = $tarea->nombreTarea;
        $task_id = $tarea->taskId;
        $case_id = $tarea->caseId;
        $user_app = userNick();
        $aux = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
        $data_generico =json_decode($aux["data"]);
        $aux = $data_generico->pedidoTrabajo;

        switch ($tarea->nombreTarea) {
            //paso 1 Evalua si trabajo es viable
            case 'Evalua si trabajo es viable':       
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );  
                $plazo_presupuesto= intval($form['plazo']);
                $unidad_medida_tiempo = $form['uni_tiempo'];

                // un dia en milisegundos
                $un_dia = intval(86400000); 
                $resultado_str = str_replace(empresa()."-unidades_tiempo", "", $unidad_medida_tiempo);
                switch ($resultado_str) {
                    // valor de 1 dia en milisegundos 86400000
                    case '1':
                        $variable_tiempo = $plazo_presupuesto *  $un_dia;
                        log_message('DEBUG', 'SEIN -notificacion de plazo en milisegundos ->' . json_encode($variable_tiempo));              
                        break;

                    default:
                        $variable_tiempo = is_int($plazo_presupuesto) *  is_int($un_dia);
                        log_message('DEBUG', 'SEIN -notificacion de plazo en milisegundos ->' . json_encode($variable_tiempo));    
                    break;
                }

                $rsp = $this->Proceso_tareas->guardarForms($data);

                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Evalua si trabajo es viable');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Evalua si trabajo es viable');
                }

                $contrato["trabajoViable"]  = $form['result'];
                $contrato["duracionTimer"]  = $variable_tiempo;
                return $contrato;
            break;
            //paso 2 Evaluación del estado de cuenta del cliente
            case 'Evaluación del estado de cuenta del cliente':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Evaluación del estado de cuenta del cliente');
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);
            
                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Evaluación del estado de cuenta del cliente');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Evaluación del estado de cuenta del cliente');
                }
                $contrato["estadoCuentaClienteOk"]  = $form['result'];
                return $contrato;
            break;
            //paso 3 Evalua Viabilidad del Trabajo
            case 'Evalua Viabilidad del Trabajo': 
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | - Evalua Viabilidad del Trabajo ' . $tarea->nombreTarea);
                $contrato["trabajoViableOfTecnica"]  = $form['result'];
                return $contrato;
            break;
            //paso 5 Reevaluar pedido de cotización
            case 'Reevaluar pedido de cotización':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Reevaluar pedido de cotización ->' . $tarea->nombreTarea);
                $contrato["apruebaExcepcional"]  = $form['result'];
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Reevaluar pedido de cotización- valor del contrato apruebaExcepcional ->' . json_encode($contrato));      
                return $contrato;
            break;
            //paso 6  Evalua cotización
            case 'Evalua cotización':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Evalua cotización ->'  . $tarea->nombreTarea);
                if ($form['result'] == "true") {
                    $contrato["apruebaCotizacion"]  = "true";
                    $contrato["enviaVendedor"]  =  "true";
                    log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Evalua cotización - valor del contrato  apruebaCotizacion ->' . json_encode($contrato) );
                    log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Evalua cotización - valor del contrato  enviaVendedor ->' . json_encode($contrato) );

                } else {
                    $contrato["apruebaCotizacion"]  = "false";
                    $contrato["enviaVendedor"]  = "false";
                    log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Evalua cotización - valor del contrato  apruebaCotizacion ->' . json_encode($contrato) );
                    log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | -Evalua cotización - valor del contrato  enviaVendedor ->' . json_encode($contrato) );
                }
                return $contrato;
            break;
            //paso 7 Enviar Cotización           
            case 'Enviar Cotización':
                log_message('DEBUG', 'Enviar Cotización->' . $tarea->nombreTarea);
                $contrato["controlTrabajoTerminado"]  = $form['result'];
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Enviar Cotización - valor del contrato controlTrabajoTerminado ->' . json_encode($contrato) );
                return $contrato;
            break;
            //paso 8 Espera respuesta del cliente         
            case 'Espera respuesta de cliente':
                log_message('DEBUG', 'Espera respuesta de cliente->' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);
            
                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Espera respuesta de cliente');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Espera respuesta de cliente');
                }
                $contrato["clienteAceptaPresupuesto"]  = $form['result'];
                log_message('DEBUG', 'SEIN -Espera respuesta de cliente- valor del contrato  clienteAceptaPresupuesto ->' . json_encode($contrato) );
                    
                return $contrato;
            break;
            //paso 9 Analiza Vigencia. Condiciones y Cantidades del presupuesto aprobado         
            case 'Analiza Vigencia. Condiciones y Cantidades del presupuesto aprobado':
                log_message('DEBUG', 'Analiza Vigencia. Condiciones y Cantidades del presupuesto aprobado->' . $tarea->nombreTarea);
                $contrato["presupuestoVigente"]  = $form['result'];
                log_message('DEBUG', 'SEIN -Analiza Vigencia. Condiciones - valor del contrato  presupuestoVigente ->' . json_encode($contrato) );   
                return $contrato;
            break;
            //paso 10     Recepción de OC y archivo        
            case 'Recepción de OC y archivo':
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | case: ' . $tarea->nombreTarea);

                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);

                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Recepción de OC y archivo');
                } else {
                    log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | guardarForms asociado a la tarea >> GUARDADO OK FORM - Recepción de OC y archivo');
                }

                if ($form['result'] == "true" && !empty($form['frm_info_id_justificacion'])) {
                    log_message('DEBUG', 'Recepción de OC y archivo- form justificacion>' . $tarea->nombreTarea);
                    $data['_post_pedidotrabajo_tarea_form'] = array(
                        "nom_tarea" => "$nom_tarea". " justificacion",
                        "task_id" => $task_id,
                        "usuario_app" => $user_app,
                        "case_id" => $case_id,
                        "info_id" => $form['frm_info_id_justificacion']
                    );
                    $rsp = $this->Proceso_tareas->guardarForms($data);
                    if (!$rsp) {
                        log_message('ERROR', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Recepción de OC y archivo');
                    } else {
                        log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | guardarForms asociado a la tarea >> GUARDADO OK FORM - Recepción de OC y archivo');
                    }
                }
                $contrato["precisaAnticipo"]  = $form['result'];
                log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | valor del contrato precisaAnticipo ->' . json_encode($contrato) );      
                return $contrato;
            break;
            //paso 11 Solicita pago anticipo
            case 'Solicita pago anticipo':
                log_message('DEBUG', 'Solicita pago anticipo->' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);
                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Solicita pago anticipo');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Solicita pago anticipo');
                }
            break;
            //paso 12 Recibe pago anticipo       
            case 'Recibe pago anticipo':   
                log_message('DEBUG', 'Recibe pago anticipo->' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);
                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Recibe pago anticipo');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Recibe pago anticipo');
                }              
            break;          
            //paso 13 Ejecuta el Trabajo - Tools Tareas      
            case 'Ejecuta el Trabajo - Tools Tareas':               
                log_message('DEBUG', 'Ejecuta el Trabajo - Tools Tareas ->' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);
                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Ejecuta el Trabajo - Tools Tareas   ');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Ejecuta el Trabajo - Tools Tareas   ');
                }              
            break;    
            //paso 14 Realiza Control final del Trabajo     
            case 'Realiza Control final del Trabajo':
                            
                log_message('DEBUG', 'SEIN view -> Realiza Control final del Trabajo' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);

                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Realiza Control final del Trabajo');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Realiza Control final del Trabajo');
                }
                $contrato["apruebaControlFinal"]  = $form['result'];
                log_message('DEBUG', 'SEIN - Realiza Control final del Trabajo - valor del contrato  apruebaControlFinal ->' . json_encode($contrato) );   
                return $contrato;
            break;     
            //paso 15 Revision de la No Confirmidad    
            case 'Revision de la No Confirmidad':                
                log_message('DEBUG', 'SEIN view -> Revision de la No Confirmidad' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);
                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Revision de la No Confirmidad');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Revision de la No Confirmidad');
                }
                $contrato["resultadoRevision"]  = $form['result'];
                log_message('DEBUG', 'SEIN - Revision de la No Confirmidad - valor del contrato  resultadoRevision ->' . json_encode($contrato) );        
                return $contrato;
            break;     
            //paso 18 Cerrar servicio y archivar legajo
            case 'Cerrar servicio y archivar legajo':
                log_message('DEBUG', 'Cerrar servicio y archivar legajo ->' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
            $rsp = $this->Proceso_tareas->guardarForms($data);
            if (!$rsp) {
                log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Cerrar servicio y archivar legajo');
            } else {
                log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Cerrar servicio y archivar legajo');
            }
            break;
            //paso 19  Paletizar y Despachar
            case 'Paletizar y Despachar':
                log_message('DEBUG', 'Paletizar y Despachar ->' . $tarea->nombreTarea);
                $data['_post_pedidotrabajo_tarea_form'] = array(
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                );
                $rsp = $this->Proceso_tareas->guardarForms($data);
                if (!$rsp) {
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM -Paletizar y Despachar');
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Paletizar y Despachar');
                }
                $contrato["hayMasParaEntregar"]  = $form['result'];
                log_message('DEBUG', 'SEIN -  Paletizar y Despachar - valor del contrato  hayMasParaEntregar ->' . json_encode($contrato));
                return $contrato;
            break;     
            default:
                log_message('ERROR', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | se fue por el default');
            break;
        }
    }
    /**
	* Obtengo los campos de la instancia formulario recibida
	* @param integer info_id
	* @return array data instancia formulario
	*/
    function getDataFormulario($infoid){
        log_message('DEBUG', '#TRAZA | #SEIN-TOOLS-ALMPANTAR | Proceso_tareas | $infoid: ' . json_encode($infoid));
        $aux = $this->rest->callAPI("GET",REST_FRM."/formulario/".$infoid);
        $aux = json_decode($aux["data"]);
        return $aux->formulario->items->item;
    }
}