<?php
class VentasContraentregaController extends AppController {
	public $name = 'VentaContraentrega';

	public function crear() {
		$this->layout = "red";
		if(!empty($this->data)){
			$this->request->data['VentaContraentrega']['fecha'] = date("Y-m-d");
			$this->request->data['VentaContraentrega']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$user         = $this->Auth->user();
			$user         = $this->VentaContraentrega->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaContraentrega']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaContraentrega']['clase']      = 'Contraentrega';
			$empaqueInfo['empaques'] = $this->data['VentaContraentrega']['empaques'];
			$empaqueInfo['barras']      = $this->data['VentaContraentrega']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentaContraentrega']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['VentaContraentrega']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaContraentrega']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaContraentrega']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaContraentrega']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaContraentrega']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaContraentrega']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaContraentrega']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaContraentrega']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaContraentrega']['subtotal'];
			$this->request->data['VentaContraentrega']['empaque_info'] = json_encode($empaqueInfo);

			$user           = $this->Auth->user();
			$user           = $this->VentaContraentrega->importModel('User')->read(null,$user['id']);
			$rem    = $this->VentaContraentrega->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
			$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		
			$this->request->data['VentaContraentrega']['facturacion'] = '';
			$this->request->data['VentaContraentrega']['remesa']      = $remesa; 
			$this->request->data['Venta'] = $this->data['VentaContraentrega'];
			App::import('model', 'Venta');
        	$ventaImport = new Venta();

			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
				$Remite = $this->data['VentaContraentrega']['checkRemitente'];
				$Archiv = $this->data['VentaContraentrega']['checkArchivo'];
				$Destin = $this->data['VentaContraentrega']['checkDestinatario'];
				$Prueba = $this->data['VentaContraentrega']['checkPrueba'];
				$this->redirect(array('controller'=>'ventas','action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentaContraentrega->importModel('User')->read(null,$user['id']);
		$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
		$rem    = $this->VentaContraentrega->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
		$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		$tipo           = $this->VentaContraentrega->getEnumValues('tipo');
		$firmado        = $this->VentaContraentrega->getEnumValues('firmado');
		$destinos       = $this->VentaContraentrega->importModel('Destino')->find('list');
		$empaques       = $this->VentaContraentrega->importModel('Empaque')->find('list');
		
		$clientes       = $this->VentaContraentrega->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesD      = $this->VentaContraentrega->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1)));
		
		$remitentes     = $this->VentaContraentrega->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaContraentrega->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		
		$destinatarios  = $this->VentaContraentrega->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaContraentrega->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));
		

		$remitentesN = array();
		foreach ($remitentes as $key => $value) {
			$remitentesN[$value['Remitente']['id']] = $value;
		}
		$remitentes = $remitentesN;

		$destinatariosN = array();
		foreach ($destinatarios as $key => $value) {
			$desN = json_decode($destinatarios[$key]['Destinatario']['destinos'],true);
			foreach ($desN as $key2 => $value2) {
				$destinatariosN[$value2][] = $destinatarios[$key]['Destinatario']['id'];
			}
		}
		foreach ($clientes as $key => $value) {
			/*
			$remitentesId = json_decode($value['Cliente']['remitentes'],true);
			$temp = array();
			$temp['id']    = $value['Cliente']['id'];
			$temp['value'] = $value['Cliente']['documento'];
			foreach ($remitentesId as $idR) {
				$temp['SubData'][$idR] = $remitentesD[$idR];
			}
			$selectDep[] = $temp;
			*/
			$clientes[$key]['Cliente']['remitentes'] = json_decode($value['Cliente']['remitentes'],true);
		}

		$ingresos  = $this->VentaContraentrega->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));
		$this->set(compact('ingresos','selectDep','facturacion','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','remitentes','remitentesD','destinatarios','destinatariosD','destinatariosN'));
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentaContraentrega->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentaContraentrega->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentaContraentrega->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentaContraentrega->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$recaudadores = array();
		$reca         = $this->VentaContraentrega->importModel("Representantexdestino")->find('all',array('conditions'=>array('Representantexdestino.destino_id'=>$destino)));
		foreach ($reca as $key => $value) {
			$recaudadores[$value['Representante']['id']] = $value['Representante']['identificacion'].' - '.$value['Representante']['listNombre'];
		}
		$data['Recaudadores'] = $recaudadores;
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		return json_encode($data);
	}



	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$venta               = $this->VentaContraentrega->importModel('Venta')->read(null,$id);
		if($Remite == '1'){
			$envio['hoja'][] = '**REMITENTE**';
		}
		if($Archiv == '1'){
			$envio['hoja'][] = '**ARCHIVO**';
		}
		if($Destin == '1'){
			$envio['hoja'][] = '**DESTINATARIO**';
		}
		if($Prueba == '1'){
			$envio['hoja'][] = '**PRUEBA DE ENTREGA**';
		}
		$envio['n']            = count($envio['hoja']);
		$envio['guia']         = $venta['Venta']['remesa'];
		$envio['contactoR']    = $venta['Venta']['contacto'];
		$envio['contactoTelR'] = $venta['Venta']['contacto_tel'];
		$oficinaB              = $this->VentaContraentrega->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['Venta']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['fecha']        = $venta['Venta']['fecha'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['Venta']['tipo'].' '.$venta['Venta']['documento1'];
		$envio['hora']         = $venta['Venta']['hora'];
		$envio['cliente']      = $venta['Venta']['nombreClien'];
		$envio['nit']          = $venta['Venta']['documentoClien'];
		$envio['direccionC']   = $venta['Venta']['direccionClien'];
		$envio['telefonoC']    = $venta['Venta']['telefonoClien'];
		$envio['otro_remi']    = $venta['Venta']['otro_remi'];
		if($venta['Venta']['otro_remi'] == 0){
			$envio['otro_remi']  = false;
			$envio['remitente']  = "";
			$envio['nitR']       = "";
			$envio['direccionR'] = "";
			$envio['telefonoR']  = "";
		} else {
			$envio['otro_remi']  = true;
			$envio['remitente']  = $venta['Venta']['nombreRemi'];
			$envio['nitR']       = $venta['Venta']['documentoRemi'];
			$envio['direccionR'] = $venta['Venta']['direccionRemi'];
			$envio['telefonoR']  = $venta['Venta']['telefonoRemi'];		
		}
		
		$origenB               = $this->VentaContraentrega->importModel('Destino')->read(null,$venta['Venta']['origen']);
		$destinoB              = $this->VentaContraentrega->importModel('Destino')->read(null,$venta['Venta']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentaContraentrega->importModel('Destinatario')->read(null,$venta['Venta']['destinatario']);
		$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
		$envio['destinatario'] = $venta['Venta']['nombreDest'];
		$envio['ced']          = $venta['Venta']['documentoDest'];
		$envio['direccionD']   = $venta['Venta']['direccionDest'];
		$envio['telefonoD1']   = $venta['Venta']['telefonoDest'];
		$envio['telefonoD2']   = $contactoB[0]['telefono'];
		$envio['contacto']     = $contactoB[0]['nombre'];
		$empaques_info         = json_decode($venta['Venta']['empaque_info'],true);
		$empaquesIguales       = true;
		$sumaFlete             = 0;
		$sumaCantidad          = 0;
		$sumaPeso              = 0;
		$sumaAlto              = 0;
		$sumaAncho             = 0;
		$sumaLargo             = 0;
		$sumaPesoVol           = 0;
		$empaqueAct            = $empaques_info['empaques'][0];
		foreach ($empaques_info['empaques'] as $key => $value) {
			$sumaFlete    = $sumaFlete + ($empaques_info['cantidad'][$key]*$empaques_info['valor'][$key]);
			$sumaLargo    = $sumaLargo + $empaques_info['largo'][$key];
			$sumaAncho    = $sumaAncho + $empaques_info['ancho'][$key];
			$sumaAlto     = $sumaAlto + $empaques_info['alto'][$key];
			$sumaPeso     = $sumaPeso + ($empaques_info['cantidad'][$key]*$empaques_info['peso'][$key]);
			$sumaCantidad = $sumaCantidad + $empaques_info['cantidad'][$key];
			$sumaPesoVol  = $sumaPesoVol + ($empaques_info['cantidad'][$key]*(($empaques_info['largo'][$key]/100)*($empaques_info['ancho'][$key]/100)*($empaques_info['alto'][$key]/100)*400));
			
			if(($empaqueAct != $empaques_info['empaques'][$key]) && ($empaquesIguales)){
				$empaquesIguales = false;
			}
		}
		if($empaquesIguales){
			$empaqueB = $this->VentaContraentrega->importModel('Empaque')->read(null, $empaqueAct);
			$envio['empaque'] = $empaqueB['Empaque']['nombre'];
		} else {
			$envio['empaque'] = 'Otros empaques';
		}
		$envio['cantidad']    = $sumaCantidad;
		$envio['peso']        = $sumaPeso;
		$envio['pesoVol']     = $sumaPesoVol;
		if(count($empaques_info['empaques']) > 1){
			$envio['largo']   = "";
			$envio['ancho']   = "";
			$envio['alto']    = "";
		} else {
			$envio['largo']   = $sumaLargo;
			$envio['ancho']   = $sumaAncho;
			$envio['alto']    = $sumaAlto;
		}

		$envio['barras']      = $venta['Venta']['barras'];
		$envio['observacion'] = $venta['Venta']['observaciones'];
		$envio['contenido']   = $venta['Venta']['contenido'];
		$decla = str_replace(".",",",str_replace(",","",$venta['Venta']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB = $this->VentaContraentrega->importModel('User')->read(null,$venta['Venta']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CONTRAENTR';
		$envio['kiloAd']       = number_format($venta['Venta']['kilo_adic'],0,'.',',');
		$envio['valorKiloAd']  = number_format($venta['Venta']['valor_kilo_adic'],0,'.',',');
		$envio['descFlete']    = number_format($venta['Venta']['desc_flete'],0,'.',',');
		$envio['descKilo']     = number_format($venta['Venta']['desc_kilo'],0,'.',',');
		$envio['valorFirmado'] = number_format($venta['Venta']['valor_devolucion'],0,'.',',');
		$envio['valorSeguro']  = number_format($venta['Venta']['valor_seguro'],0,'.',',');
		$envio['valorTotal']   = number_format($venta['Venta']['valor_total'],0,'.',',');
		$envio['kiloNegoc']    = $venta['Venta']['kilo_nego'];

		$this->set(compact('envio'));
	//	$this->layout = 'pdf'; 
	//	$this->render(); 
	}

}
?>
