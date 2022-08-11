<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cotizacion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cotizaciones');
		
		// si esta vencida la sesion redirige al login
		$data = $this->session->userdata();
		// log_message('DEBUG','#Main/login | '.json_encode($data));
		if(!$data['email']){
			log_message('DEBUG','#TRAZA|DASH|CONSTRUCT|ERROR  >> Sesion Expirada!!!');
			redirect(DNATO.'main/login');
		}
    }


    /**
	* Agregar Cotizacion
	* @param array datos de la cotizacion
	* @return bool true o false segun resultado de servicio de guardado
	*/
    public function agregarCotizacion(){
		log_message('DEBUG', "#TRAZA | #SEIN | Cotizacion | agregarCotizacion()");
		
		$data['codigo_pedido'] = $this->input->post('cod_proyecto');
		$data['objetivo'] =  $this->input->post('objetivo_proyecto');
        $data['uni_medida'] = $this->input->post('unidad_medida_tiempo');
        $data['plazo_entrega'] =  $this->input->post('plazo_entrega');
        $data['uni_medida_plazo'] =  $this->input->post('unidad_medida_plazo');
        $data['cliente'] =  $this->input->post('nomb_cliente');
        $data['dir_entrega'] =  $this->input->post('dir_entrega_cliente');
        $data['email_cliente'] =  $this->input->post('email_cliente');
        $data['email_alternativo'] =  $this->input->post('email_alternativo');
        $data['forma_pago'] =  $this->input->post('forma_pago');
        $data['divisa'] =  $this->input->post('divisa');
        $data['usuario'] =  userNick();
        $data['usuario_app'] = userNick();
        $data['fecha_emision'] = date('Y-m-d');
        $data['case_id'] = $this->input->post('case_id');

		$resp = $this->Cotizaciones->agregarCotizacion($data);
        
		if ($resp['status']) {
			echo json_encode($resp);
		} else {
			echo json_encode($resp);
		}
    }


/**
	* Agrega el detalle para una cotizacion
	* @param array con datos para agregar a la cotizacion
	* @return bool true o false segun resultado de servicio
	*/
    public function guardarDetalleCotizacion(){
		log_message('DEBUG', "#TRAZA | #SEIN | Cotizacion | agregarDetalleCotizacion()");
		$detalle = $this->input->post('data');

		$resp = $this->Cotizaciones->agregarDetalleCotizacion($detalle);

		if ($resp['status']) {
			echo json_encode($resp);
		} else {
			echo json_encode($resp);
		}
    }		


}