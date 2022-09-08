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
        
        $url = REST_SEIN."/_post_cotdetlist_batch_req";
         $batch_req = [];

         
        
        foreach ($data as $key) {
            // $aux['cantidad'] = intval($key['cantidad']);
            $aux['cantidad'] = $key['cantidad'];
            $aux['descripcion'] =  $key['descripcion_cotizacion'];
            // $aux['precio_unitario'] = floatval( $key['precio_unitario']);
            $aux['precio_unitario'] = $key['precio_unitario'];
            // $aux['importe'] = floatval($key['importe']);
            $aux['importe'] = $key['importe'];
            $aux['usuario_app'] = userNick();
            $aux['coti_id'] = $key['coti_id'];
        

            $batch_req['_post_cotdetlist_batch_req']['_post_cotdetlist'][] = $aux;

        }
    


        $rsp = $this->rest->callApi('POST', $url, $batch_req);

        log_message('DEBUG', "#TRAZA | #SEIN | Detalle de cotizacion | guardarDetallesCotizacion() ".json_encode($rsp));
        return $rsp;
    }


 /**
	* Obtiene los datos cargados en core.tablas por empr_id
	* @param string columna tabla a buscar
	* @return array listado de coincidencias
	*/
    public function obtenerTablaEmpr_id($tabla)
    {
        $url = REST_CORE."/tabla/$tabla/empresa/".empresa();
        return wso2($url);
    }
   


}