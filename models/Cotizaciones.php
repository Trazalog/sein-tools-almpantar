<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Entidad Infocodigos encargada de obtener informacion
* para representar codigos QR o de Barras
*
* @autor Hugo Gallardo
*/
class Cotizaciones extends CI_Model
{
		function __construct()
		{
			parent::__construct();
		}

		

          /**
	* agregar Cotizacaion
	* @param array datos de la cotizacion
	* @return bool
	*/
    public function agregarCotizacaion($data){
        
        $post['_post_cotizacion'] = $data;
        $url = REST_SICP."/cotizacion";

        $aux = $this->rest->callAPI("POST",$url,$post);

        log_message('DEBUG', "#TRAZA | #SEIN | Cotizaciones | agregarCotizacaion()  resp: >> " . json_encode($aux));

        return $aux;
    }


 /**
	* Alta de los detalles de documento
	* @param array datos de los detalles del documento
	* @return bool
	*/
    public function guardarDetallesCotizacion($data){
        
        $url = REST_SICP."/_post_docdetlist_batch_req";
        $batch_req = [];

        foreach ($data as $key) {
            $aux['cantidad'] = $key['cantidad'];
            $aux['precio_unitario'] =  $key['precio_unitario'];
            $aux['unidades'] =  $key['unidades'];
            $aux['descuento'] =  $key['descuento'];
            $aux['usuario_app'] = userNick();
            $aux['docu_id'] = $key['num_documento'];
            $aux['tido_id'] = $key['tido_id'];
            $aux['tipr_id'] = $key['tipr_id'];
            $aux['unme_id'] = $key['unme_id'];

            $batch_req['_post_docdetlist_batch_req']['_post_docdetlist'][] = $aux;

        }
        
        $rsp = $this->rest->callApi('POST', $url, $batch_req);

        log_message('DEBUG', "#TRAZA | #SICPOA | Inspecciones | guardarDetallesDocumentos() ".json_encode($rsp));
        return $rsp;
    }



}
