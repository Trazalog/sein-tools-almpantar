<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Entidad Infocodigos encargada de obtener informacion
* para representar codigos QR o de Barras
*
* @autor Hugo Gallardo
*/
class Infocodigos extends CI_Model
{
		function __construct()
		{
			parent::__construct();
		}

		/**
		*
		* @param
		* @return
		*/
		function getDataQR($infoid)
		{
			$aux = $this->rest->callAPI("GET",REST_FRM."/formulario/".$infoid);
		
			$aux =json_decode($aux["data"]);
			log_message('DEBUG', '#Model  -Infocodigo- SEIN >>  | $infoid: ' .json_encode($infoid));
			log_message('DEBUG', '#Model  -Infocodigo- SEIN >>  | $infocodigo: ' .json_encode($aux));
			return $aux->formulario->items->item;
		}

}
