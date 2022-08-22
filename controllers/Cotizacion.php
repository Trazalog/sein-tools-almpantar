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

		$data['plazo_entrega'] = $this->input->post('plazo_entrega');
		$data['email_alternativo'] = $this->input->post('email_alternativo');
		$data['unme_id'] = "1-unidades_medidadia";
		$data['usuario_app'] = userNick();
		$data['petr_id'] = $this->input->post('petr_id');
		$data['fopa_id'] = "1-forma_pagocontado";
		$data['divi_id'] = "1-divisaARS";
		

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
		log_message('DEBUG', "#TRAZA | #SEIN | Cotizacion | guardarDetallesCotizacion()");
		$detalle = $this->input->post('detalles');

		$resp = $this->Cotizaciones->guardarDetallesCotizacion($detalle);

		if ($resp['status']) {
			echo json_encode($resp);
		} else {
			echo json_encode($resp);
		}
    }		


}