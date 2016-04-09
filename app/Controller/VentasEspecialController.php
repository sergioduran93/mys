<?php
class VentasEspecialController extends AppController {
	public $name = 'VentaEspecial';

	public function crear() {
		$this->layout = "grey";

		$clientes       = $this->VentaEspecial->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.Especial'=>'Si')));
		$clientesD      = $this->VentaEspecial->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1,'Cliente.Especial'=>'Si')));
		$clientesN      = $this->VentaEspecial->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'conditions'=>array('Cliente.id >'=>1,'Cliente.Especial'=>'Si')));

		if(!empty($this->data)){
			$this->request->data['VentaEspecial']['fecha'] = date("Y-m-d");
			$this->request->data['VentaEspecial']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$this->request->data['VentaEspecial']['nombreClien']    = $clientesN[$this->data['VentaEspecial']['nombreClien']];
			$this->request->data['VentaEspecial']['documentoClien'] = $clientesD[$this->data['VentaEspecial']['documentoClien']];
			$user         = $this->Auth->user();
			$user         = $this->VentaEspecial->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaEspecial']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaEspecial']['clase']      = 'Especial';
			$empaqueInfo['empaques'] = $this->data['VentaEspecial']['empaques'];
			$empaqueInfo['barras']      = $this->data['VentaEspecial']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentaEspecial']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['VentaEspecial']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaEspecial']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaEspecial']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaEspecial']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaEspecial']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaEspecial']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaEspecial']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaEspecial']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaEspecial']['subtotal'];
			$this->request->data['VentaEspecial']['empaque_info'] = json_encode($empaqueInfo);

			$user           = $this->Auth->user();
			$user           = $this->VentaEspecial->importModel('User')->read(null,$user['id']);
			$rem    = $this->VentaEspecial->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
			$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		
			$this->request->data['VentaEspecial']['remesa']      = $remesa; 
			$this->request->data['VentaEspecial']['facturacion'] = '';
			$this->request->data['Venta'] = $this->data['VentaEspecial'];
			App::import('model', 'Venta');
        	$ventaImport = new Venta();
			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
				$Remite = $this->data['VentaEspecial']['checkRemitente'];
				$Archiv = $this->data['VentaEspecial']['checkArchivo'];
				$Destin = $this->data['VentaEspecial']['checkDestinatario'];
				$Prueba = $this->data['VentaEspecial']['checkPrueba'];
				$this->redirect(array('action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user              = $this->Auth->user();
		$user              = $this->VentaEspecial->importModel('User')->read(null,$user['id']);
		$rem               = $this->VentaEspecial->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
		$remesa            = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		$tipo              = $this->VentaEspecial->importModel('Venta')->getEnumValues('tipo');
		
		$firmado           = $this->VentaEspecial->getEnumValues('firmado');
		$destinos          = $this->VentaEspecial->importModel('Destino')->find('list');
		$empaques          = $this->VentaEspecial->importModel('Empaque')->find('list');
		
		
		$remitentes     = $this->VentaEspecial->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaEspecial->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		$remitentesNom  = $this->VentaEspecial->importModel('Remitente')->find('list',array('fields'=>array('Remitente.nombre')));
		
		$destinatarios  = $this->VentaEspecial->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaEspecial->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));

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
			$clientes[$key]['Cliente']['remitentes'] = json_decode($value['Cliente']['remitentes'],true);
		}
		$ingresos  = $this->VentaEspecial->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));
		$this->set(compact('ingresos','selectDep','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','clientesN','remitentes','remitentesD','remitentesNom','destinatarios','destinatariosD','destinatariosN'));
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		//$this->log($cliente.'-'.$origen.'-'.$destino);
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentaEspecial->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentaEspecial->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentaEspecial->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentaEspecial->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$cupo = $this->VentaEspecial->importModel('Cliente')->find('first',array('recursive'=>-1,'fields'=>array('Cliente.cupo')));
		$suma = $this->VentaEspecial->find('all',array('fields'=>array('SUM(VentaEspecial.valor_total) AS saldoPend'),'conditions'=>array('VentaEspecial.cliente'=>$cliente)));
		if($suma[0][0]['saldoPend'] == null){
			$data['Saldo'] = 0;
		} else {
			$data['Saldo'] = $suma[0][0]['saldoPend'];
		}
		$data['Cupo']         = $cupo['Cliente']['cupo'];
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		return json_encode($data);
	}

	public function getReempaque($ref1 = null) {
		$this->autoRender = false;
		$reempaque = $this->VentaEspecial->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$ref1)));
		$data      = $reempaque['Reempaque'];
		return json_encode($data);
	}

	public function getDevolucion($ref1 = null) {
		$this->autoRender = false;
		$notaD = $this->VentaEspecial->importModel('Cartaporte')->find('first',array('conditions'=>array('Cartaporte.id'=>$ref1)));
		$guias = json_decode($notaD['Cartaporte']['guias'],true);
		$remesas = $this->VentaEspecial->importModel('Venta')->find('list',array('fields'=>array('Venta.remesa'),'conditions'=>array('Venta.id'=>$guias)));
		
		$notaD['Cartaporte']['guias'] = 'Remesas: '.implode(", ", $remesas);
		$notaD['Cartaporte']['cantidad'] = count($remesas);
		$notaD['Cartaporte']['origen'] = 1;
		$notaD['Cartaporte']['destino'] = 1;
		$notaD['Cartaporte']['destinatario'] = $notaD['Cartaporte']['cliente'];
		$data  = $notaD['Cartaporte'];

		return json_encode($data);
	}

	public function getNacional($ref1 = null) {
		$this->autoRender = false;
		$traslado = $this->VentaEspecial->importModel('Nacional')->find('first',array('conditions'=>array('Nacional.id'=>$ref1)));
		$data     = $traslado['Nacional'];
		return json_encode($data);
	}

	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$venta               = $this->VentaEspecial->importModel('Venta')->read(null,$id);
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
		$oficinaB              = $this->VentaEspecial->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['Venta']['oficina'])));
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
		
		$origenB               = $this->VentaEspecial->importModel('Destino')->read(null,$venta['Venta']['origen']);
		$destinoB              = $this->VentaEspecial->importModel('Destino')->read(null,$venta['Venta']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentaEspecial->importModel('Destinatario')->read(null,$venta['Venta']['destinatario']);
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
			$empaqueB = $this->VentaEspecial->importModel('Empaque')->read(null, $empaqueAct);
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

		$usuarioB = $this->VentaEspecial->importModel('User')->read(null,$venta['Venta']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'ESPECIAL';
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
