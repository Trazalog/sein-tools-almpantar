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
    public function agregarCotizacion($data){
        
        $post['_post_cotizacion'] = $data;
       
        $url = REST_SEIN."/cotizacion";

        $aux = $this->rest->callAPI("POST",$url,$post);

        log_message('DEBUG', "#TRAZA | #SEIN |Nueva Cotizacion | agregarCotizacaion()  resp: >> " . json_encode($aux));

        return $aux;
    }


 /**
	* Alta de los detalles de cotizacion
	* @param array datos de los detalles del cotizacion
	* @return bool
	*/
    public function guardarDetallesCotizacion($data){
        
        $url = REST_SEIN."/setDetalleCotizacion";
        // $batch_req = [];

    

        foreach ($data as $key) {
            $aux['cantidad'] = $key['cantidad'];
            $aux['descripcion'] =  $key['descripcion'];
            $aux['precio_unitario'] =  $key['precio_unitario'];
            $aux['importe'] =  $key['importe'];
            $aux['usuario_app'] = userNick();
            $aux['coti_id'] = $key['coti_id'];
        

            $batch_req['_post_cotdetlist_batch_req']['_post_cotdetlist'][] = $aux;

        }
    


        $rsp = $this->rest->callApi('POST', $url, $batch_req);

        log_message('DEBUG', "#TRAZA | #SEIN | Detalle de cotizacion | guardarDetallesCotizacion() ".json_encode($rsp));
        return $rsp;
    }



}