<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class proceso_tareas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // $this->load->model(ALM . 'Ordeninsumos');
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

  

    public function desplegarVista($tarea)
    {
        $ci =& get_instance();

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
    

        switch ($tarea->nombreTarea) {
            
            //paso 1 Evaluacion de Viabilidad.
        
                case 'Evalua si trabajo es viable':

                return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad', $data, true);

                log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);

                 break;
     
            //paso 2 Evaluación del estado de cuenta del cliente
                 case 'Evaluación del estado de cuenta del cliente':
                    
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evalua_estado_cuenta_cliente', $data, true);

                     log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
              
                     break;

            //paso 3 Evalua Viabilidad del Trabajo
                case 'Evalua Viabilidad del Trabajo':
                      
             
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad_cotizacion', $data, true);
             
                    log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
              
                     break;
                        
              //paso 4 Reevaluar pedido de cotización      
                case 'Reevaluar pedido de cotización':
 
                           
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_aprobacion_excepcional', $data, true);

                    log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
              
                         
             
                         break;  


              //paso 5 Cotización de trabajo           
                case 'Cotización de trabajo':

    
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad', $data, true);

                    log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
        
        
                    break;    
                    
            //paso 6   Evalua cotización         
                case 'Evalua cotización':

    
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad', $data, true);

                    log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
        
        
                    break;

            //paso 7 Enviar Cotización           
                case 'Enviar Cotización':

    
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad', $data, true);

                    log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
        
        
                    break;

            //paso 8 Espera respuesta de cliente          
                case 'Despacho':

    
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad', $data, true);

                    log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
        
        
                    break;

               
           //paso 9      Analiza Vigencia. Condiciones y Cantidades del presupuesto aprobado          
                case 'Analiza Vigencia. Condiciones y Cantidades del presupuesto aprobado':
        
            
                    return $this->load->view(SEIN . 'tareas/proceso_productivo/view_evaluacion_viabilidad', $data, true);

                    log_message('DEBUG', 'SEIN view -> Evalua si trabajo es viable' . $tarea->nombreTarea);
                
                
                    break;
                         
            default:
                                                 
            log_message('DEBUG', 'SEIN view -> default' . $tarea->nombreTarea);

                break;
        }
    }

// Guardar Pedido de Trabajo
public function guardarForms($data)
{
    $url = REST_PRO . '/pedidoTrabajo/tarea/form';
    $rsp = $this->rest->callApi('POST', $url, $data);
    return $rsp;
    
    if (!$rsp) {

        log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL FORM');

    } else {
        log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> TODO OK');

    }

}

    



    public function getContrato($tarea, $form)
    {
     $ci =& get_instance();
     $nom_tarea = $tarea->nombreTarea;
     $task_id = $tarea->taskId;
     $case_id = $tarea->caseId;
     $user_app = userNick();
     $aux = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
     $data_generico =json_decode($aux["data"]);
     $aux = $data_generico->pedidoTrabajo;


        switch ($tarea->nombreTarea) {
 //paso 1
    case 'Evalua si trabajo es viable':       

    $data['_post_pedidotrabajo_tarea_form'] = array(

            "nom_tarea" => "$nom_tarea",
            "task_id" => $task_id,
            "usuario_app" => $user_app,
            "case_id" => $case_id,
            "info_id" => $form['frm_info_id']
    
        );
    
       

        // $rsp = $this->proceso_tareas->guardarForms($data);
    
        // if (!$rsp) {
    
        //     log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Evalua si trabajo es viable');
    
        // } else {
        //     log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Evalua si trabajo es viable');
    
        // } 
       
                   
            $plazo_presupuesto = $form['plazo'];

            $unidad_medida_tiempo = $form['uni_tiempo'];

            $resultado_str = str_replace(empresa()."-unidades_tiempo", "", $unidad_medida_tiempo);	

            return;

            switch ($resultado_str) {

                case '1':
                   $variable_tiempo = is_int($plazo_presupuesto) *  is_int($resultado_str);
                   
                   $value = "00:10";

                    $time = explode(':',$value);

                    $ms = $time[0]*60000 + $time[1]*1000;
                    
                    break;

                case 'value':
                    # code...
                    break;

                case 'value':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }

            $contrato["trabajoViable"]  = $form['result'];

            $contrato["duracionTimer"]  = $ms;

              return $contrato;
         
        break;
    
    //paso 2
        case 'Evaluación del estado de cuenta del cliente':
     
            
        log_message('DEBUG', 'SEIN -Evaluación del estado de cuenta del cliente');

        $data['_post_pedidotrabajo_tarea_form'] = array(
        
            "nom_tarea" => "$nom_tarea",
            "task_id" => $task_id,
            "usuario_app" => $user_app,
            "case_id" => $case_id,
            "info_id" => $form['frm_info_id']
           
    
        );
    
    
        $rsp = $this->proceso_tareas->guardarForms($data);
    
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
          
            log_message('DEBUG', 'SEIN -Evaluación del estado de cuenta del cliente ' . $tarea->nombreTarea);
    
            $contrato["trabajoViableOfTecnica"]  = $form['result'];
              
                  
            return $contrato;

            break;

          
    //paso 5
            case 'Reevaluar pedido de cotización':
 
                log_message('DEBUG', 'SEIN -Evaluación del estado de cuenta del cliente ->' . $tarea->nombreTarea);
    
                $contrato["apruebaExcepcional"]  = $form['result'];
                  
                log_message('DEBUG', 'SEIN -Evaluación del estado de cuenta del cliente ->' . json_encode($contrato["apruebaExcepcional"]));      
                return $contrato;
    
        
                break;

        //paso 6
                case 'Pintado y acabado final':
 
                    log_message('DEBUG', 'YUDI Reparacion view-Pintado y acabado final->' . $tarea->nombreTarea);
            
                    if ($form['result'] == 'ok') {

                        log_message('DEBUG', 'YUDI Reparacion -Pintado y acabado final contrato', json_encode($form['result'],true) );
     
                        $contrato["retornaAPaso"]  = $form['result'];
                            
                                  
                             return $contrato;
                
                        break;


                    }else {

                       
                        $data['_post_pedidotrabajo_tarea_form'] = array(
            
                            "nom_tarea" => "$nom_tarea",
                            "task_id" => $task_id,
                            "usuario_app" => $user_app,
                            "case_id" => $case_id,
                            "info_id" => $form['frm_info_id']
                           
                    
                        );
                    
                    
                        $rsp = $this->Yudiproctareas->guardarForms($data);
                    
                        if (!$rsp) {
                    
                            log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Pintado y acabado final');
                    
                        } else {
                            log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Pintado y acabado final');
                    
                        }

                        log_message('DEBUG', 'YUDI Reparacion -Pintado y acabado final contrato', json_encode($form['result'],true) );
     
                        $contrato["retornaAPaso"]  = $form['result'];
                            
                                  
                             return $contrato;
                
                        break;
                    }

                   

case 'Despacho':
   

         log_message('DEBUG', 'YUDI Reparacion view- Reparacion -Despacho->' . $tarea->nombreTarea);
        
         $data['_post_pedidotrabajo_tarea_form'] = array(
 
             "nom_tarea" => "$nom_tarea",
             "task_id" => $task_id,
             "usuario_app" => $user_app,
             "case_id" => $case_id,
             "info_id" => $form['frm_info_id']
            
     
         );
     
     
         $rsp = $this->Yudiproctareas->guardarForms($data);
     
         if (!$rsp) {
     
             log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - YUDI -Despacho');
     
         } else {
             log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - YUDI -Despacho');
     
         }
     
            $contrato["controlTrabajoTerminado"]  = $form['result'];
        
              
         return $contrato;
 
         break;

            default:
                # code...
                break;
        }
    }

   
}