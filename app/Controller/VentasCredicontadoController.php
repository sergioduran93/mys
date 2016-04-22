<?php
class VentasCredicontadoController extends AppController {
	public $name = 'VentaCredicontado';

	public function crear() {
		if(!empty($this->data)){
			$this->request->data['VentaCredicontado']['fecha'] = date("Y-m-d");
			$this->request->data['VentaCredicontado']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$user         = $this->Auth->user();
			$user         = $this->VentaCredicontado->importModel('User')->read(null,$user['id']);
			$this->request->data['VentaCredicontado']['despachada'] = $user['Oficina']['id'];
			$this->request->data['VentaCredicontado']['clase']      = 'Credicontado';
			$empaqueInfo['empaques'] = $this->data['VentaCredicontado']['empaques'];
			$empaqueInfo['barras']      = $this->data['VentaCredicontado']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['VentaCredicontado']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['VentaCredicontado']['cantidad'];
			$empaqueInfo['largo']    = $this->data['VentaCredicontado']['largo'];
			$empaqueInfo['ancho']    = $this->data['VentaCredicontado']['ancho'];
			$empaqueInfo['alto']     = $this->data['VentaCredicontado']['alto'];
			$empaqueInfo['peso']     = $this->data['VentaCredicontado']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['VentaCredicontado']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['VentaCredicontado']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['VentaCredicontado']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['VentaCredicontado']['subtotal'];
			$this->request->data['VentaCredicontado']['empaque_info'] = json_encode($empaqueInfo);

			$user           = $this->Auth->user();
			$user           = $this->VentaCredicontado->importModel('User')->read(null,$user['id']);
			$rem    = $this->VentaCredicontado->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
			$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		
			$this->request->data['VentaCredicontado']['facturacion'] = '';
			$this->request->data['VentaCredicontado']['remesa']      = $remesa; 
			$this->request->data['Venta'] = $this->data['VentaCredicontado'];
			App::import('model', 'Venta');
        	$ventaImport = new Venta();
			if($ventaImport->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La VentaCredicontado se guardo con exito.'));
				$Remite = $this->data['VentaCredicontado']['checkRemitente'];
				$Archiv = $this->data['VentaCredicontado']['checkArchivo'];
				$Destin = $this->data['VentaCredicontado']['checkDestinatario'];
				$Prueba = $this->data['VentaCredicontado']['checkPrueba'];
				$this->redirect(array('action' => 'imprimir',$ventaImport->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La VentaCredicontado no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->VentaCredicontado->importModel('User')->read(null,$user['id']);
		$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
		$rem    = $this->VentaCredicontado->importModel('Venta')->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
		$remesa = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		$tipo           = $this->VentaCredicontado->getEnumValues('tipo');
		$firmado        = $this->VentaCredicontado->getEnumValues('firmado');
		$destinos       = $this->VentaCredicontado->importModel('Destino')->find('list');
		$empaques       = $this->VentaCredicontado->importModel('Empaque')->find('list');
		
		$clientes       = $this->VentaCredicontado->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesD      = $this->VentaCredicontado->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1)));
		
		$remitentes     = $this->VentaCredicontado->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->VentaCredicontado->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		
		$destinatarios  = $this->VentaCredicontado->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->VentaCredicontado->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));
		

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
		$ingresos  = $this->VentaCredicontado->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));
		$this->set(compact('ingresos','selectDep','facturacion','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','remitentes','remitentesD','destinatarios','destinatariosD','destinatariosN'));
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		$this->log($cliente.'-'.$origen.'-'.$destino);
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->VentaCredicontado->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->VentaCredicontado->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->VentaCredicontado->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->VentaCredicontado->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		$representante            = $this->VentaCredicontado->importModel("Representantexdestino")->find('first',array('recursive'=>0,'conditions'=>array('Representantexdestino.destino_id'=>$destino)));
		$data['Representante']    = $representante['Representante']['identificacion'].' - '.$representante['Representante']['listNombre'];
		$data['Representante_id'] = $representante['Representante']['id'];
		return json_encode($data);
	}


	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$venta               = $this->VentaCredicontado->importModel('Venta')->read(null,$id);
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
		$oficinaB              = $this->VentaCredicontado->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['Venta']['oficina'])));
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
		
		$origenB               = $this->VentaCredicontado->importModel('Destino')->read(null,$venta['Venta']['origen']);
		$destinoB              = $this->VentaCredicontado->importModel('Destino')->read(null,$venta['Venta']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->VentaCredicontado->importModel('Destinatario')->read(null,$venta['Venta']['destinatario']);
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
			$empaqueB = $this->VentaCredicontado->importModel('Empaque')->read(null, $empaqueAct);
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

		$usuarioB = $this->VentaCredicontado->importModel('User')->read(null,$venta['Venta']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CREDICONTA';
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

	public function movCredicontado() {
		$desde    = date("Y-m-d");
		$hasta    = date("Y-m-d");
		$clientes = $this->VentaCredicontado->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteD = $this->VentaCredicontado->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteT = $this->VentaCredicontado->importModel('Cliente')->find('all',array('fields'=>array('Cliente.id','Cliente.direccion','Cliente.telefono','Cliente.email'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
	
		if(!empty($this->data)){
			$desde    = $this->data['VentaCredicontadoVentaCredicontado']['desde'];
			$hasta    = $this->data['VentaCredicontado']['hasta'].' 23:59:59';
			$ventas   = $this->VentaCredicontado->find('all',array('conditions'=>array('VentaCredicontado.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$empaques = $this->VentaCredicontado->importModel('Empaque')->find('list');
			$oficinas = $this->VentaCredicontado->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			foreach ($ventas as $key => $value) {
				$empaqueInfo = json_decode($value['VentaCredicontado']['empaque_info'], true);
				$suma        = 0;
				$vlrFlete    = 0;
				foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
					$suma     = $suma + $value2;
					$vlrFlete = $vlrFlete + ($empaqueInfo['valor'][$key2]*$value2);
				}
				$ventas[$key]['VentaCredicontado']['cantidad'] = $suma;
				$ventas[$key]['VentaCredicontado']['vlrFlete'] = $vlrFlete;

				if(count($empaqueInfo['empaques']) > 1){
					$ventas[$key]['VentaCredicontado']['empaque'] = 'Otros';
				} else {
					$ventas[$key]['VentaCredicontado']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
				}
				if(is_numeric($value['VentaCredicontado']['despachada'])){
					$ventas[$key]['VentaCredicontado']['despachada'] = 'En: '.$oficinas[$value['VentaCredicontado']['despachada']];
				}
				
				if(!empty($value['VentaCredicontado']['reempaque'])){
					$reem = $this->VentaCredicontado->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['VentaCredicontado']['reempaque'])));
					$reem = explode(" ",$reem['Reempaque']['fecha']);
					$ventas[$key]['VentaCredicontado']['fecha_des'] = $reem[0];
				}
			}
			
			$this->generateJSON('mov_credicontado', $ventas, array('VentaCredicontado' => array('id','documentoClien','remesa','destino','remitente','destinatario','empaque_info','','valor_total','fecha','fecha_des','documento1')));
		}
		
		$this->set(compact('desde','hasta','clientes','clienteD','clienteT'));
	}
	public function enviarMovCredicontado(){
		App::uses('CakeEmail', 'Network/Email');
		$this->layout = "empty";
		if(!empty($this->data)){
			if(empty($this->data['VentaCredicontado']['desde'])){
				$fileName = $this->ExcelWrite->movCliente(json_decode($this->data['VentaCredicontado']['informe'],true));
				$email = new CakeEmail('gmail');
				$email->to($this->data['VentaCredicontado']['email']);
				$email->subject($this->data['VentaCredicontado']['asunto']);
				$email->attachments(array('Informe Mov x Cliente.xlsx' => 'informes/'.$fileName));
				//$email->replyTo('webmaster@mys.com');
				$email->from ('teban.unal@gmail.com');
				$email->send($this->data['VentaCredicontado']['msg']);
				unlink('informes/'.$fileName);
			}
		}
		return json_encode($this->data);
	}
	public function downMovCredicontado(){
		$this->autoRender = false;
		$file = $this->ExcelWrite->movCliente(json_decode($this->data['VentaCredicontado']['informe'],true));
		return $file;
	}
	public function printMovCredicontado(){
		$this->layout = "empty";
		$info = json_decode($this->data['VentaCredicontado']['informe'],true);
		$this->set(compact('info'));
	}
}
?>
