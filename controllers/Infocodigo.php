<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Entidad Infocodigo encargada de obtener informacion
* para representar codigos QR o de Barras
*
* @autor Hugo Gallardo
*/
class Infocodigo extends CI_Controller {

	function __construct()
	{
			parent::__construct();
			$this->load->model('Infocodigos');
	}

	/**
	*  Devuelve vista para impresion de codigo QR de la tarea Pedido de Trabajo
	* @param array con datos para modal
	* @return view
	*/
	function pedidoTrabajo()
	{
		$data = $this->input->post();
		$this->load->view('codigos/qr_pedido_trabajo', $data);
	}

		/**
	*  Devuelve vista para impresion de codigo QR de la tarea Pedido de Trabajo
	* @param array con datos para modal
	* @return view
	*/
	function pedidoTrabajoFinal(){
		$data = $this->input->post();
		$data['fec_inicio'] = date('d-m-Y',strtotime($data['fec_inicio']));
		$this->load->view('codigos/qr_pedido_trabajo_sein', $data);
	}

	/**
	* Devuelve footer para impresion de codigo QR de la tarea revision inicial
	* @param array con datos de la view
	* @return view
	*/
	function pedidoTrabajoFooter()
	{
		$this->load->view('codigos/qr_pintado_final_footer');
	}

	/**
	*	Obtiene y devuelve datos para reimpresion
	* @param int infoid
	* @return array con datos mapeado para dibujar modal y codigo QR
	*/
	function mapeoDatos($infoid){
		$data= $this->Infocodigos->getDataQR($infoid);

		foreach ($data as $value) {
			switch ($value->name) {
				case 'email':
					$datos['email'] = $value->valor;
					break;

				case 'email_alternativo':
					$datos['email_alternativo'] = $value->valor;
					break;

				case 'ofi_tecnica':
					$datos['ofi_tecnica'] = str_replace(empresa()."-oficina_tecnica", "", $value->valor);
					break;

				default:

				break;
			}
		}

		echo json_encode($datos);
	}

}