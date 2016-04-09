<?php
class VentasController extends AppController {
	public $components = array('JqImgcrop','Util','Excel');
	public $name = 'Ventas';

/******************							INFORMES 									********
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************/
	public function cuentaRepre() {
		$desde    = date("Y-m-d");
		$hasta    = date("Y-m-d");
		$informe = array();

		if(!empty($this->data)){
			$desde = $this->data['Venta']['desde'];
			$hasta = $this->data['Venta']['hasta'].' 23:59:59';
			$id = $this->data['Venta']['representante'];
			$userId = $this->Venta->importModel('User')->find('first',array('conditions'=>array('User.representante_id'=>$id)));
			if(empty($userId)){
				$userId = -1;
			} else {
				$userId = $userId['User']['id'];
			}

			$ventasRepre   = $this->Venta->find('all',array('conditions'=>array('Venta.fecha BETWEEN ? and ?' => array($desde, $hasta),'OR'=>array('Venta.usuario'=>$userId,'Venta.usuario_confirm'=>$userId,'Venta.usuario_escan'=>$userId,'Venta.recaudador'=>$id))));
			$reempaRepre   = $this->Venta->importModel('Reempaque')->find('all',array('conditions'=>array('Reempaque.representante'=>$id,'Reempaque.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$reciboRepre   = $this->Venta->importModel('Recibo')->find('all',array('conditions'=>array('Recibo.usuario'=>$userId,'Recibo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$representante = $this->Venta->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$id)));

			foreach ($reempaRepre as $key => $value) {
				$informe['aaData'][] = array('Reempaque: '.$value['Reempaque']['id'],'',$value['Reempaque']['fecha'],$value['Reempaque']['valor'],'COMISIÓN X ENTREGA');
			}

			foreach ($ventasRepre as $key => $value) {
				if($value['Venta']['usuario_confirm'] == $userId){
					if($value['Venta']['clase'] == 'Especial'){
						$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],$representante['Representante']['digitar_espe'],'COMISIÓN X DIGITAR ENTREGA');
					} else {
						$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],$representante['Representante']['digitar'],'COMISIÓN X DIGITAR ENTREGA');
					}
				}
				if($value['Venta']['usuario_escan'] == $userId){
					if($value['Venta']['clase'] == 'Especial'){
						$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],$representante['Representante']['escanear_espe'],'COMISIÓN X ESCANEAR');
					} else {
						$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],$representante['Representante']['escanear'],'COMISIÓN X ESCANEAR');
					}
				}
				if($value['Venta']['recaudador'] == $id){
					if($value['Venta']['clase']=="Contraentrega"){
						$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],'-'.$value['Venta']['valor_total'],'RECAUDO CONTRAENTREGA');
					}
					if($value['Venta']['clase']=="Contado"){
						$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],'-'.$value['Venta']['valor_total'],'VENTA CONTADO');
					}
					
					$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
					$cantidad = 0;
					$valor    = 0;
					foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
						$cantidadU = floatval($empaquesInfo['cantidad'][$key2]);
						$flag      = true;
						if($flag){
							if($value['Venta']['clase'] == "Especial"){
								$flag2 = true;
								if($value2 == '1'){
									if($representante['Representante']['sobre_espe'] != ""){
										$valor = $valor + (floatval($representante['Representante']['sobre_espe'])*$cantidadU);
										$flag  = false;
										$flag2 = false;
									}
								} else if($value2 == '2'){
									if($representante['Representante']['paquete_espe'] != ""){
										$valor = $valor + (floatval($representante['Representante']['paquete_espe'])*$cantidadU);
										$flag  = false;
										$flag2 = false;
									}
								} else if($value2 == '3'){
									if($representante['Representante']['caja_espe'] != ""){
										$valor = $valor + (floatval($representante['Representante']['caja_espe'])*$cantidadU);
										$flag  = false;
										$flag2 = false;
									}
								}
								if($flag2){
									if($representante['Representante']['base_espe'] != ""){
										$valor = $valor + (floatval($representante['Representante']['base_espe'])*$cantidadU);
										$flag  = false;
									}
								}
							}
						}
						if($flag){
							$negoEmp = $this->Venta->importModel('Negociacion')->find('first',array('conditions'=>array('Negociacion.representante'=>$id,'Negociacion.clientes'=>$value['Venta']['cliente'])));
							if(!empty($negoEmp)){
								$flag2 = true;
								if($value2 == '1'){
									if($negoEmp['Negociacion']['sobre_clie'] != ""){
										$valor = $valor + (floatval($negoEmp['Negociacion']['sobre_clie'])*$cantidadU);
										$flag  = false;
										$flag2 = false;
									}
								} else if($value2 == '2'){
									if($negoEmp['Negociacion']['paquete_clie'] != ""){
										$valor = $valor + (floatval($negoEmp['Negociacion']['paquete_clie'])*$cantidadU);
										$flag  = false;
										$flag2 = false;
									}
								} else if($value2 == '3'){
									if($negoEmp['Negociacion']['caja_clie'] != ""){
										$valor = $valor + (floatval($negoEmp['Negociacion']['caja_clie'])*$cantidadU);
										$flag  = false;
										$flag2 = false;
									}
								}
								if($flag2){
									$valor = $valor + (floatval($negoEmp['Negociacion']['base_clie'])*$cantidadU);
									$flag  = false;
								}
							}
						}
						if($flag){
							$flag2 = true;
							if($value2 == '1'){
								if($representante['Representante']['sobre'] != ""){
									$valor = $valor + (floatval($representante['Representante']['sobre'])*$cantidadU);
									$flag2 = false;
								}
							} else if($value2 == '2'){
								if($representante['Representante']['paquete'] != ""){
									$valor = $valor + (floatval($representante['Representante']['paquete'])*$cantidadU);
									$flag2 = false;
								}
							} else if($value2 == '3'){
								if($representante['Representante']['caja'] != ""){
									$valor = $valor + (floatval($representante['Representante']['caja'])*$cantidadU);
									$flag2 = false;
								}
							}
							if($flag2){
								$valor = $valor + (floatval($representante['Representante']['base'])*$cantidadU);
							}
						}
						$cantidad = $cantidad + $cantidadU;
					}
					$rangos = json_decode($representante['Representante']['rangos'],true);
					foreach ($rangos['datos'] as $key3 => $value3) {
						if($value3['desde'] <= $cantidad && $cantidad <= $value3['hasta'] ){
							$valor = $valor - ($valor * (floatval($value3['porcentaje']/100)));
						}
					}
					if($value['Venta']['usuario'] == $userId){
						$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],$valor,'COMISIÓN X RECOGIDA');
						if($value['Venta']['clase'] == 'Especial'){
							$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],$representante['Representante']['digitar_espe'],'COMISIÓN X DIGITAR');
						} else {
							$informe['aaData'][] = array('Remesa: '.$value['Venta']['remesa'],$value['Venta']['documento1'],$value['Venta']['fecha'].' '.$value['Venta']['hora'],$representante['Representante']['digitar'],'COMISIÓN X DIGITAR');
						}
					}

				}				
			}

			foreach ($reciboRepre as $key => $value) {
				$informe['aaData'][] = array('Nro Recibo: '.$value['Recibo']['numero'],'',$value['Recibo']['fecha'],$value['Recibo']['flete'],'FLETES PAGADOS');
			}
		}
		APP::import('Utility','File');
		$file = new File(WWW_ROOT.'/sources/cuenta_repre.txt',true);
		$file->write(json_encode($informe));
		$file->close();
		$representantes = $this->Venta->importModel('Representante')->find('list');
		$this->set(compact('representantes','desde','hasta'));
	}
	
	public function merConfirmada() {
		$desde    = date("Y-m-d");
		$hasta    = date("Y-m-d");
		$clientes = $this->Venta->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteD = $this->Venta->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteT = $this->Venta->importModel('Cliente')->find('all',array('fields'=>array('Cliente.id','Cliente.direccion','Cliente.telefono','Cliente.email'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$areasL   = $this->Venta->importModel('Area')->find('list');
		$areas    = $this->Venta->importModel('Area')->find('list',array('fields'=>array('Area.destinos')));
		$destinos = $this->Venta->importModel('Destino')->find('list',array('fields'=>'Destino.nombre'));
		if(!empty($this->data)){
			$desde    = $this->data['Venta']['desde'];
			$hasta    = $this->data['Venta']['hasta'].' 23:59:59';
			$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.usuario_confirm !='=>null,'Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$empaques = $this->Venta->importModel('Empaque')->find('list');
			$oficinas = $this->Venta->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			foreach ($ventas as $key => $value) {
				$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
				$suma        = 0;
				$vlrFlete    = 0;
				foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
					$suma     = $suma + $value2;
					$vlrFlete = $vlrFlete + ($empaqueInfo['valor'][$key2]*$value2);
				}
				$ventas[$key]['Venta']['cantidad'] = $suma;
				$ventas[$key]['Venta']['vlrFlete'] = $vlrFlete;

				if(count($empaqueInfo['empaques']) > 1){
					$ventas[$key]['Venta']['empaque'] = 'Otros';
				} else {
					$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
				}
				if(is_numeric($value['Venta']['despachada'])){
					$ventas[$key]['Venta']['despachada'] = 'En: '.$oficinas[$value['Venta']['despachada']];
				}
				if(!empty($value['Venta']['despacho'])){
					$desp = $this->Venta->importModel('Despacho')->find('first',array('conditions'=>array('Despacho.id'=>$value['Venta']['despacho'])));
					$desp = explode(" ",$desp['Despacho']['fecha']);
					$ventas[$key]['Venta']['fecha_des'] = $desp[0];
				}
				if(!empty($value['Venta']['reempaque'])){
					$reem = $this->Venta->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['Venta']['reempaque'])));
					$reem = explode(" ",$reem['Reempaque']['fecha']);
					$ventas[$key]['Venta']['fecha_des'] = $reem[0];
				}
			}
			
			$this->generateJSON('mer_confirmada', $ventas, array('Venta' => array('id','remesa','documentoClien','nombreClien','documentoRemi','nombreRemi','documento1','origenNombre','destinoNombre','documentoDest','nombreDest','cantidad','empaque','despachada','fecha','fecha_des','fecha_confirm','clase','vlrFlete','valor_kilo_adic','desc_flete','desc_kilo','valor_seguro','valor_devolucion','valor_total')));
		}
		$tipo = array('Contado','Credito','Contraentrega','Credicontado','Especial');
		$this->set(compact('desde','hasta','clientes','clienteD','tipo','areas','areasL','destinos','clienteT'));
	}
	public function enviarMerConfirmada(){
		App::uses('CakeEmail', 'Network/Email');
		$this->layout = "empty";
		if(!empty($this->data)){
			if(empty($this->data['Venta']['desde'])){
				$fileName = $this->ExcelWrite->merConfirmada(json_decode($this->data['Venta']['informe'],true));
				$email = new CakeEmail('gmail');
				$email->to($this->data['Venta']['email']);
				$email->subject($this->data['Venta']['asunto']);
				$email->attachments(array('Informe Mov x Cliente.xlsx' => 'informes/'.$fileName));
				//$email->replyTo('webmaster@mys.com');
				$email->from ('teban.unal@gmail.com');
				$email->send($this->data['Venta']['msg']);
				unlink('informes/'.$fileName);
			}
		}
		return json_encode($this->data);
	}
	public function downMerConfirmada(){
		$this->autoRender = false;
		$file = $this->ExcelWrite->merConfirmada(json_decode($this->data['Venta']['informe'],true));
		return $file;
	}
	public function printMerConfirmada(){
		$this->layout = "empty";
		$info = json_decode($this->data['Venta']['informe'],true);
		$this->set(compact('info'));
	}



	public function despachoXRepre() {
		$desde          = date("Y-m-d");
		$hasta          = date("Y-m-d");
		$representantes = $this->Venta->importModel('Representante')->find('list');
		$areasL         = $this->Venta->importModel('Area')->find('list');
		$areas          = $this->Venta->importModel('Area')->find('list',array('fields'=>array('Area.destinos')));
		$destinos       = $this->Venta->importModel('Destino')->find('list',array('fields'=>'Destino.nombre'));
		if(!empty($this->data)){
			$desde    = $this->data['Venta']['desde'];
			$hasta    = $this->data['Venta']['hasta'].' 23:59:59';
			$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.fecha BETWEEN ? and ?' => array($desde, $hasta),'Venta.oficina'=>'7')));
			$empaques = $this->Venta->importModel('Empaque')->find('list');
			$oficinas = $this->Venta->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			foreach ($ventas as $key => $value) {
				$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
				$suma        = 0;
				$vlrFlete    = 0;
				foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
					$suma     = $suma + $value2;
					$vlrFlete = $vlrFlete + ($empaqueInfo['valor'][$key2]*$value2);
				}
				$ventas[$key]['Venta']['representante'] = $representantes[$value['Venta']['recaudador']];
				$ventas[$key]['Venta']['cantidad'] = $suma;
				$ventas[$key]['Venta']['vlrFlete'] = $vlrFlete;

				if(count($empaqueInfo['empaques']) > 1){
					$ventas[$key]['Venta']['empaque'] = 'Otros';
				} else {
					$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
				}
				if(is_numeric($value['Venta']['despachada'])){
					$ventas[$key]['Venta']['despachada'] = 'En: '.$oficinas[$value['Venta']['despachada']];
				}
				if(!empty($value['Venta']['despacho'])){
					$desp = $this->Venta->importModel('Despacho')->find('first',array('conditions'=>array('Despacho.id'=>$value['Venta']['despacho'])));
					$desp = explode(" ",$desp['Despacho']['fecha']);
					$ventas[$key]['Venta']['fecha_des'] = $desp[0];
				}
				if(!empty($value['Venta']['reempaque'])){
					$reem = $this->Venta->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['Venta']['reempaque'])));
					$reem = explode(" ",$reem['Reempaque']['fecha']);
					$ventas[$key]['Venta']['fecha_des'] = $reem[0];
				}
			}
			
			$this->generateJSON('despacho_x_repre', $ventas, array('Venta' => array('id','remesa','representante','documentoClien','nombreClien','nombreRemi','documento1','origenNombre','destinoNombre','documentoDest','nombreDest','cantidad','empaque','despachada','fecha','fecha_des','fecha_confirm','clase','vlrFlete','valor_kilo_adic','desc_flete','desc_kilo','valor_seguro','valor_devolucion','valor_total')));
		}
		$tipo = array('Contado','Credito','Contraentrega','Credicontado','Especial');
		$this->set(compact('desde','hasta','tipo','areas','areasL','destinos','representantes'));
	}
	public function downDespachoXRepre(){
		$this->autoRender = false;
		$file = $this->ExcelWrite->despachoXRepre(json_decode($this->data['Venta']['informe'],true));
		return $file;
	}
	public function printDespachoXRepre(){
		$this->layout = "empty";
		$info = json_decode($this->data['Venta']['informe'],true);
		$this->set(compact('info'));
	}


	public function despachoRepre() {
		$desde    = date("Y-m-d");
		$hasta    = date("Y-m-d");
		$repreA  = $this->Venta->importModel('Representante')->find('all',array('recursive'=>-1,'fields'=>array('Representante.id','Representante.direccion','Representante.telefono1')));
		$repreT  = $this->Venta->importModel('Representante')->find('list',array('fields'=>array('Representante.listNombre')));
		$repreD  = $this->Venta->importModel('Representante')->find('list',array('fields'=>array('Representante.identificacion')));
		$areasL   = $this->Venta->importModel('Area')->find('list');
		$areas    = $this->Venta->importModel('Area')->find('list',array('fields'=>array('Area.destinos')));
		$destinos = $this->Venta->importModel('Destino')->find('list',array('fields'=>'Destino.nombre'));
		if(!empty($this->data)){
			$desde    = $this->data['Venta']['desde'];
			$hasta    = $this->data['Venta']['hasta'].' 23:59:59';
			$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.reempaque !='=>null,'Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$empaques = $this->Venta->importModel('Empaque')->find('list');
			$oficinas = $this->Venta->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			$represen = $this->Venta->importModel('Representante')->find('all',array('fields'=>array('Representante.id','Representante.codigo','Representante.identificacion','Representante.listNombre')));
			
			foreach ($ventas as $key => $value) {
				$reempaque = $this->Venta->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['Venta']['reempaque']),'fields'=>array('Reempaque.representante','Reempaque.id')));
				if(!empty($reempaque)){
					$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
					$suma        = 0;
					foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
						$suma     = $suma + $value2;
					}
					$ventas[$key]['Venta']['cantidad'] = $suma;
					foreach ($represen as $key3 => $value3) {
						if($value3['Representante']['id'] == $reempaque['Reempaque']['representante']){
							$ventas[$key]['Venta']['repreCod'] = $value3['Representante']['codigo'];
							$ventas[$key]['Venta']['repreNit'] = $value3['Representante']['identificacion'];
							$ventas[$key]['Venta']['repreNom'] = $value3['Representante']['listNombre'];
						}
					}
					
					if(count($empaqueInfo['empaques']) > 1){
						$ventas[$key]['Venta']['empaque'] = 'Otros';
					} else {
						$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
					}
					if(is_numeric($value['Venta']['despachada'])){
						$ventas[$key]['Venta']['despachada'] = 'En: '.$oficinas[$value['Venta']['despachada']];
					}
					if(!empty($value['Venta']['despacho'])){
						$desp = $this->Venta->importModel('Despacho')->find('first',array('conditions'=>array('Despacho.id'=>$value['Venta']['despacho'])));
						$desp = explode(" ",$desp['Despacho']['fecha']);
						$ventas[$key]['Venta']['fecha_des'] = $desp[0];
					}
					if(!empty($value['Venta']['reempaque'])){
						$reem = $this->Venta->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['Venta']['reempaque'])));
						$reem = explode(" ",$reem['Reempaque']['fecha']);
						$ventas[$key]['Venta']['fecha_des'] = $reem[0];
					}
				} else {
					unset($ventas[$key]);
				}
			}
			$this->generateJSON('despacho_repre', $ventas, array('Venta' => array('id','remesa','documentoClien','nombreClien','documentoRemi','nombreRemi','documento1','repreCod','repreNit','repreNom','origenNombre','destinoNombre','documentoDest','nombreDest','cantidad','empaque','despachada','fecha','fecha_des','fecha_confirm')));
		}
		$tipo = array('Contado','Credito','Contraentrega','Credicontado','Especial');
		$this->set(compact('desde','hasta','recibos','repreA','repreD','repreT','tipo','areas','areasL','destinos'));
	}
	public function downDespachoRepre(){
		$this->autoRender = false;
		$file = $this->ExcelWrite->despachoRepre(json_decode($this->data['Venta']['informe'],true));
		return $file;
	}
	public function printDespachoRepre(){
		$this->layout = "empty";
		$info = json_decode($this->data['Venta']['informe'],true);
		$this->set(compact('info'));
	}


	public function movNatural() {
		$desde    = date("Y-m-d");
		$hasta    = date("Y-m-d");
		$conducA  = $this->Venta->importModel('Conductor')->find('all',array('recursive'=>-1,'fields'=>array('Conductor.id','Conductor.direccion','Conductor.telefono')));
		$conducT  = $this->Venta->importModel('Conductor')->find('list',array('fields'=>array('Conductor.listNombre')));
		$conducD  = $this->Venta->importModel('Conductor')->find('list',array('fields'=>array('Conductor.identificacion')));
		$areasL   = $this->Venta->importModel('Area')->find('list');
		$areas    = $this->Venta->importModel('Area')->find('list',array('fields'=>array('Area.destinos')));
		$destinos = $this->Venta->importModel('Destino')->find('list',array('fields'=>'Destino.nombre'));
		if(!empty($this->data)){
			$desde    = $this->data['Venta']['desde'];
			$hasta    = $this->data['Venta']['hasta'].' 23:59:59';
			$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$empaques = $this->Venta->importModel('Empaque')->find('list');
			$oficinas = $this->Venta->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			foreach ($ventas as $key => $value) {
				$recibo = $this->Venta->importModel('Recibo')->find('first',array('conditions'=>array('Recibo.tipo'=>"Natural",'Recibo.guia_id'=>$value['Venta']['id']),'fields'=>array('Recibo.documento','Recibo.negociador','Recibo.negociador_nom','Recibo.numero','Recibo.flete','Recibo.seguro','Recibo.fecha','Recibo.guia_id')));
				if(!empty($recibo)){
					$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
					$suma        = 0;
					foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
						$suma     = $suma + $value2;
					}
					$ventas[$key]['Venta']['cantidad'] = $suma;

					$ventas[$key]['Venta']['placa']     = $recibo['Recibo']['documento'];
					$ventas[$key]['Venta']['conducNit'] = $recibo['Recibo']['negociador'];
					$ventas[$key]['Venta']['conducNom'] = $recibo['Recibo']['negociador_nom'];
					$ventas[$key]['Venta']['numRecibo'] = $recibo['Recibo']['numero'];
					$ventas[$key]['Venta']['vlrFlete']  = $recibo['Recibo']['flete'];
					$ventas[$key]['Venta']['vlrSegur']  = $recibo['Recibo']['seguro'];

					if(count($empaqueInfo['empaques']) > 1){
						$ventas[$key]['Venta']['empaque'] = 'Otros';
					} else {
						$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
					}
					if(is_numeric($value['Venta']['despachada'])){
						$ventas[$key]['Venta']['despachada'] = 'En: '.$oficinas[$value['Venta']['despachada']];
					}
					if(!empty($value['Venta']['despacho'])){
						$desp = $this->Venta->importModel('Despacho')->find('first',array('conditions'=>array('Despacho.id'=>$value['Venta']['despacho'])));
						$desp = explode(" ",$desp['Despacho']['fecha']);
						$ventas[$key]['Venta']['fecha_des'] = $desp[0];
					}
					if(!empty($value['Venta']['reempaque'])){
						$reem = $this->Venta->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['Venta']['reempaque'])));
						$reem = explode(" ",$reem['Reempaque']['fecha']);
						$ventas[$key]['Venta']['fecha_des'] = $reem[0];
					}
				} else {
					unset($ventas[$key]);
				}
			}
			$this->generateJSON('mov_conductor', $ventas, array('Venta' => array('id','remesa','documentoClien','nombreClien','documentoRemi','nombreRemi','documento1','conducNit','conducNom','placa','origenNombre','destinoNombre','documentoDest','nombreDest','cantidad','empaque','despachada','numRecibo','vlrFlete','vlrSegur','fecha','fecha_des','fecha_confirm')));
		}
		$tipo = array('Contado','Credito','Contraentrega','Credicontado','Especial');
		$this->set(compact('desde','hasta','recibos','conducA','conducD','conducT','tipo','areas','areasL','destinos'));
	}
	public function downMovNatural(){
		$this->autoRender = false;
		$file = $this->ExcelWrite->movNatural(json_decode($this->data['Venta']['informe'],true));
		return $file;
	}
	public function printMovNatural(){
		$this->layout = "empty";
		$info = json_decode($this->data['Venta']['informe'],true);
		$this->set(compact('info'));
	}

	public function movJuridica() {
		$desde    = date("Y-m-d");
		$hasta    = date("Y-m-d");
		$transpA  = $this->Venta->importModel('Transportadora')->find('all',array('recursive'=>-1,'fields'=>array('Transportadora.id','Transportadora.direccion','Transportadora.telefono1')));
		$transpT  = $this->Venta->importModel('Transportadora')->find('list',array('fields'=>array('Transportadora.razon')));
		$transpD  = $this->Venta->importModel('Transportadora')->find('list',array('fields'=>array('Transportadora.nit')));
		$areasL   = $this->Venta->importModel('Area')->find('list');
		$areas    = $this->Venta->importModel('Area')->find('list',array('fields'=>array('Area.destinos')));
		$destinos = $this->Venta->importModel('Destino')->find('list',array('fields'=>'Destino.nombre'));
		if(!empty($this->data)){
			$desde    = $this->data['Venta']['desde'];
			$hasta    = $this->data['Venta']['hasta'].' 23:59:59';
			$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$empaques = $this->Venta->importModel('Empaque')->find('list');
			$oficinas = $this->Venta->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			foreach ($ventas as $key => $value) {
				$recibo = $this->Venta->importModel('Recibo')->find('first',array('conditions'=>array('Recibo.tipo'=>"Juridica",'Recibo.guia_id'=>$value['Venta']['id']),'fields'=>array('Recibo.documento','Recibo.razon','Recibo.numero','Recibo.flete','Recibo.seguro','Recibo.fecha','Recibo.guia_id')));
				if(!empty($recibo)){
					$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
					$suma        = 0;
					foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
						$suma     = $suma + $value2;
					}
					$ventas[$key]['Venta']['cantidad'] = $suma;

					$ventas[$key]['Venta']['transpNit'] = $recibo['Recibo']['documento'];
					$ventas[$key]['Venta']['transpNom'] = $recibo['Recibo']['razon'];
					$ventas[$key]['Venta']['numRecibo'] = $recibo['Recibo']['numero'];
					$ventas[$key]['Venta']['vlrFlete']  = $recibo['Recibo']['flete'];
					$ventas[$key]['Venta']['vlrSegur']  = $recibo['Recibo']['seguro'];

					if(count($empaqueInfo['empaques']) > 1){
						$ventas[$key]['Venta']['empaque'] = 'Otros';
					} else {
						$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
					}
					if(is_numeric($value['Venta']['despachada'])){
						$ventas[$key]['Venta']['despachada'] = 'En: '.$oficinas[$value['Venta']['despachada']];
					}
					if(!empty($value['Venta']['despacho'])){
						$desp = $this->Venta->importModel('Despacho')->find('first',array('conditions'=>array('Despacho.id'=>$value['Venta']['despacho'])));
						$desp = explode(" ",$desp['Despacho']['fecha']);
						$ventas[$key]['Venta']['fecha_des'] = $desp[0];
					}
					if(!empty($value['Venta']['reempaque'])){
						$reem = $this->Venta->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['Venta']['reempaque'])));
						$reem = explode(" ",$reem['Reempaque']['fecha']);
						$ventas[$key]['Venta']['fecha_des'] = $reem[0];
					}
				} else {
					unset($ventas[$key]);
				}
			}
			$this->generateJSON('mov_transportadora', $ventas, array('Venta' => array('id','remesa','documentoClien','nombreClien','documentoRemi','nombreRemi','documento1','transpNit','transpNom','origenNombre','destinoNombre','documentoDest','nombreDest','cantidad','empaque','despachada','numRecibo','vlrFlete','vlrSegur','fecha','fecha_des','fecha_confirm')));
		}
		$tipo = array('Contado','Credito','Contraentrega','Credicontado','Especial');
		$this->set(compact('desde','hasta','recibos','transpA','transpD','transpT','tipo','areas','areasL','destinos'));
	}
	public function downMovJuridica(){
		$this->autoRender = false;
		$file = $this->ExcelWrite->movJuridica(json_decode($this->data['Venta']['informe'],true));
		return $file;
	}
	public function printMovJuridica(){
		$this->layout = "empty";
		$info = json_decode($this->data['Venta']['informe'],true);
		$this->set(compact('info'));
	}

	public function movCliente() {
		$desde    = date("Y-m-d");
		$hasta    = date("Y-m-d");
		$clientes = $this->Venta->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteD = $this->Venta->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteT = $this->Venta->importModel('Cliente')->find('all',array('fields'=>array('Cliente.id','Cliente.direccion','Cliente.telefono','Cliente.email'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$areasL   = $this->Venta->importModel('Area')->find('list');
		$areas    = $this->Venta->importModel('Area')->find('list',array('fields'=>array('Area.destinos')));
		$destinos = $this->Venta->importModel('Destino')->find('list',array('fields'=>'Destino.nombre'));
		if(!empty($this->data)){
			$desde    = $this->data['Venta']['desde'];
			$hasta    = $this->data['Venta']['hasta'].' 23:59:59';
			$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$empaques = $this->Venta->importModel('Empaque')->find('list');
			$oficinas = $this->Venta->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			foreach ($ventas as $key => $value) {
				$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
				$suma        = 0;
				$vlrFlete    = 0;
				foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
					$suma     = $suma + $value2;
					$vlrFlete = $vlrFlete + ($empaqueInfo['valor'][$key2]*$value2);
				}
				$ventas[$key]['Venta']['cantidad'] = $suma;
				$ventas[$key]['Venta']['vlrFlete'] = $vlrFlete;

				if(count($empaqueInfo['empaques']) > 1){
					$ventas[$key]['Venta']['empaque'] = 'Otros';
				} else {
					$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
				}
				if(is_numeric($value['Venta']['despachada'])){
					$ventas[$key]['Venta']['despachada'] = 'En: '.$oficinas[$value['Venta']['despachada']];
				}
				if(!empty($value['Venta']['despacho'])){
					$desp = $this->Venta->importModel('Despacho')->find('first',array('conditions'=>array('Despacho.id'=>$value['Venta']['despacho'])));
					$desp = explode(" ",$desp['Despacho']['fecha']);
					$ventas[$key]['Venta']['fecha_des'] = $desp[0];
				}
				if(!empty($value['Venta']['reempaque'])){
					$reem = $this->Venta->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$value['Venta']['reempaque'])));
					$reem = explode(" ",$reem['Reempaque']['fecha']);
					$ventas[$key]['Venta']['fecha_des'] = $reem[0];
				}
			}
			
			$this->generateJSON('mov_cliente', $ventas, array('Venta' => array('id','remesa','documentoClien','nombreClien','documentoRemi','nombreRemi','documento1','origenNombre','destinoNombre','documentoDest','nombreDest','cantidad','empaque','despachada','fecha','fecha_des','fecha_confirm','clase','vlrFlete','valor_kilo_adic','desc_flete','desc_kilo','valor_seguro','valor_devolucion','valor_total')));
		}
		$tipo = array('Contado','Credito','Contraentrega','Credicontado','Especial');
		$this->set(compact('desde','hasta','clientes','clienteD','tipo','areas','areasL','destinos','clienteT'));
	}
	public function enviarMovCliente(){
		App::uses('CakeEmail', 'Network/Email');
		$this->layout = "empty";
		if(!empty($this->data)){
			if(empty($this->data['Venta']['desde'])){
				$fileName = $this->ExcelWrite->movCliente(json_decode($this->data['Venta']['informe'],true));
				$email = new CakeEmail('gmail');
				$email->to($this->data['Venta']['email']);
				$email->subject($this->data['Venta']['asunto']);
				$email->attachments(array('Informe Mov x Cliente.xlsx' => 'informes/'.$fileName));
				//$email->replyTo('webmaster@mys.com');
				$email->from ('teban.unal@gmail.com');
				$email->send($this->data['Venta']['msg']);
				unlink('informes/'.$fileName);
			}
		}
		return json_encode($this->data);
	}
	public function downMovCliente(){
		$this->autoRender = false;
		$file = $this->ExcelWrite->movCliente(json_decode($this->data['Venta']['informe'],true));
		return $file;
	}
	public function printMovCliente(){
		$this->layout = "empty";
		$info = json_decode($this->data['Venta']['informe'],true);
		$this->set(compact('info'));
	}



/******************							FORMULARIOS									********
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************
/***********************************************************************************************/




	public function crear() {
		if(!empty($this->data)){
			$this->request->data['Venta']['fecha'] = date("Y-m-d");
			$this->request->data['Venta']['hora']  = date("H:i:s");
			$empaqueInfo = array();
			$user         = $this->Auth->user();
			$user         = $this->Venta->importModel('User')->read(null,$user['id']);
			$this->request->data['Venta']['despachada'] = $user['Oficina']['id'];
			$this->request->data['Venta']['clase']      = 'Contado';
			$empaqueInfo['empaques']    = $this->data['Venta']['empaques'];
			$empaqueInfo['barras']      = $this->data['Venta']['cbarras'];
			$empaqueInfo['descripcion'] = $this->data['Venta']['descripcion'];
			$empaqueInfo['cantidad']    = $this->data['Venta']['cantidad'];
			$empaqueInfo['largo']       = $this->data['Venta']['largo'];
			$empaqueInfo['ancho']       = $this->data['Venta']['ancho'];
			$empaqueInfo['alto']        = $this->data['Venta']['alto'];
			$empaqueInfo['peso']        = $this->data['Venta']['peso'];
			$empaqueInfo['pesoVol']     = $this->data['Venta']['pesoVol'];
			$empaqueInfo['valor']       = $this->data['Venta']['valor'];
			$empaqueInfo['kiloAd']      = $this->data['Venta']['kiloAd'];
			$empaqueInfo['subtotal']    = $this->data['Venta']['subtotal'];
			$this->request->data['Venta']['empaque_info'] = json_encode($empaqueInfo);

			$user        = $this->Auth->user();
			$user        = $this->Venta->importModel('User')->read(null,$user['id']);
			$facturacion = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
			$rem         = $this->Venta->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
			$remesa      = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
			$this->request->data['Venta']['facturacion'] = $facturacion;
			$this->request->data['Venta']['remesa']      = $remesa; 

			if($this->Venta->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La venta se guardo con exito.'));
    			$ofi = $this->Venta->importModel('Oficina')->read(null,$this->data['Venta']['oficina']);
    			$ofi['Oficina']['consecutivo'] = floatval($ofi['Oficina']['consecutivo']) + 1;
    			$this->Venta->importModel('Oficina')->save($ofi);
				$Remite = $this->data['Venta']['checkRemitente'];
				$Archiv = $this->data['Venta']['checkArchivo'];
				$Destin = $this->data['Venta']['checkDestinatario'];
				$Prueba = $this->data['Venta']['checkPrueba'];
				$this->redirect(array('action' => 'imprimir',$this->Venta->id,$Remite,$Archiv,$Destin,$Prueba));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La venta no se puedo guardar.'));
			}
		}
		$user           = $this->Auth->user();
		$user           = $this->Venta->importModel('User')->read(null,$user['id']);
		$facturacion    = $user['Oficina']['prefijo'].'-'.(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
		$rem            = $this->Venta->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
		$remesa         = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($rem['Venta']['id'])+1);
		$tipo           = $this->Venta->getEnumValues('tipo');
		$firmado        = $this->Venta->getEnumValues('firmado');
		$destinos       = $this->Venta->importModel('Destino')->find('list');
		$empaques       = $this->Venta->importModel('Empaque')->find('list');
		
		$clientes       = $this->Venta->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesD      = $this->Venta->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'conditions'=>array('Cliente.id >'=>1)));
		
		$remitentes     = $this->Venta->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitentesD    = $this->Venta->importModel('Remitente')->find('list',array('fields'=>array('Remitente.documento')));
		
		$destinatarios  = $this->Venta->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->Venta->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));
		

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
		$ingresos  = $this->Venta->importModel('Ingreso')->find('list',array('fields'=>array('Ingreso.barras','Ingreso.cliente'),'conditions'=>array('Ingreso.estado'=>0)));
		$this->set(compact('ingresos','selectDep','facturacion','remesa','destinos','empaques','firmado','tipo','clientes','clientesD','remitentes','remitentesD','destinatarios','destinatariosD','destinatariosN'));
	}

	public function notaDevolucion(){
		if(!empty($this->data)){
			$user = $this->Auth->user();
			$devolModel = $this->Venta->importModel('Devolucion');
			if($this->data['Venta']['accion'] == "Terminar"){
				$cartaModel = $this->Venta->importModel('Cartaporte');

				$cartaNuevo = array();
				$cartaNuevo['Cartaporte']['id']      = '';
				$cartaNuevo['Cartaporte']['cliente'] = $this->data['Venta']['cliente'];
				$cartaNuevo['Cartaporte']['fecha']   = date("Y-m-d H:i:s");
				$cartaNuevo['Cartaporte']['usuario'] = $user['id'];
				$cartaNuevo['Cartaporte']['guias']   = json_encode($this->data['Venta']['codigo']);
				$cartaModel->save($cartaNuevo);

				foreach ($this->data['Venta']['codigo'] as $key => $value) {
					$guia = $this->Venta->read(null,$value);
					$guia['Venta']['cartaporte'] = $cartaModel->id;
					$this->Venta->save($guia);
				}
				$devolModel->deleteAll(array('Devolucion.cliente'=>$this->data['Venta']['cliente']),false);

    			$this->Session->setFlash('','ok',array('mensaje'=>'La nota de devolución Nro. '.$cartaModel->id.' se guardo con exito.'));
				$this->redirect(array('action' => 'imprimirNota',$cartaModel->id));
			} else {
				$devol = $devolModel->find('first',array('conditions'=>array('Devolucion.cliente'=>$this->data['Venta']['cliente'])));
				if(empty($devol)){
					$devol = array();
					$devol['Devolucion']['id']      = '';
					$devol['Devolucion']['cliente'] = $this->data['Venta']['cliente'];
				}
				$devol['Devolucion']['guias'] = json_encode($this->data['Venta']['codigo']);
				$devolModel->save($devol);
			}
		}
		$this->data = null;
		$nd = $this->Venta->find('all',array('conditions'=>array('Venta.firmado'=>"Si",'Venta.cartaporte'=>null)));
		$this->generateJSON('nota_devolucion', $nd, array('Venta' => array('id','remesa','nombreDest','nombreClien','destinoNombre','origenNombre','fecha_confirm')));
		$clientes = $this->Venta->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listNombre'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteD = $this->Venta->importModel('Cliente')->find('list',array('fields'=>array('Cliente.documento'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clienteT = $this->Venta->importModel('Cliente')->find('all',array('fields'=>array('Cliente.id','Cliente.direccion','Cliente.telefono','Cliente.email'),'recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		
		$this->set(compact('clientes','clienteD','clienteT'));
	}

	public function imprimirNota($id = null){
		$devolucion = $this->Venta->importModel('Cartaporte')->read(null,$id);
		$guias      = $this->Venta->find('all',array('fields'=>array('remesa','fecha','nombreDest','destinoNombre','nombreClien','direccionClien','origenNombre'),'conditions'=>array('Venta.id'=>json_decode($devolucion['Cartaporte']['guias'],true))));
		$user       = $this->Auth->user();
		
		$this->set(compact('devolucion','guias','user'));
	}

	public function getDevolucion($cliente = null) {
		$this->autoRender = false;
		$devol = "[]";
		if(!empty($cliente)){
			$devolModel = $this->Venta->importModel('Devolucion');
			$devol = $devolModel->find('first',array('conditions'=>array('Devolucion.cliente'=>$cliente)));
			if(empty($devol)){
				$devol['Devolucion']['guias'] = "[]";
			}
		}
		return $devol['Devolucion']['guias'];
	}

	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		$this->autoRender = false;
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->Venta->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->Venta->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->Venta->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->Venta->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		return json_encode($data);
	}

	public function caja() {
		$desde   = date("Y-m-d");
		$hasta   = date("Y-m-d");
		$oficina = 1;
		$post    = false;
		if(!empty($this->data)){
			$post    = true;
			$oficina = $this->data['Venta']['oficina'];
			$desde   = $this->data['Venta']['desde'].' 00:00:00';
			$hasta   = $this->data['Venta']['hasta'].' 23:59:59';
			$desde2  = '2000-01-01';
			$hasta2  = date("Y-m-d", strtotime($desde." -1 day"));
			if($oficina == -1){
				$anticipos2 = $this->Venta->importModel('Anticipo')->find('first',array('fields'=>array('SUM(Anticipo.valor) AS valorS'),'conditions'=>array('Anticipo.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$contados2  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Contado','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$contras2   = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$creditos2  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Credito','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$credicons2 = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Credicontado','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$fletes2    = $this->Venta->importModel('Recibo')->find('first',array('fields'=>array('SUM(Recibo.flete) AS valorS'),'conditions'=>array('Recibo.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));

				$anticipos = $this->Venta->importModel('Anticipo')->find('first',array('fields'=>array('SUM(Anticipo.valor) AS valorS'),'conditions'=>array('Anticipo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$contados  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Contado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$contras   = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$creditos  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Credito','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$credicons = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.clase'=>'Credicontado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$fletes    = $this->Venta->importModel('Recibo')->find('first',array('fields'=>array('SUM(Recibo.flete) AS valorS'),'conditions'=>array('Recibo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$fletesDes = $this->Venta->importModel('Despacho')->find('first',array('fields'=>array('SUM(Despacho.valor) AS valorS'),'conditions'=>array('Despacho.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			} else {
				$recaudos   = $this->Venta->importModel('Recaudo')->find('list',array('fields'=>array('Recaudo.destino'),'conditions'=>array('Recaudo.oficina'=>$oficina)));
				$reca       = array_values($recaudos);
				$anticipos2 = $this->Venta->importModel('Anticipo')->find('first',array('fields'=>array('SUM(Anticipo.valor) AS valorS'),'conditions'=>array('Anticipo.oficina'=>$oficina,'Anticipo.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$contados2  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Contado','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$contras2   = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.destino'=>$reca,'Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$creditos2  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Credito','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$credicons2 = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Credicontado','Venta.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				$fletes2    = $this->Venta->importModel('Recibo')->find('first',array('fields'=>array('SUM(Recibo.flete) AS valorS'),'conditions'=>array('Recibo.oficina'=>$oficina,'Recibo.fecha BETWEEN ? and ?' => array($desde2, $hasta2))));
				
				$anticipos = $this->Venta->importModel('Anticipo')->find('first',array('fields'=>array('SUM(Anticipo.valor) AS valorS'),'conditions'=>array('Anticipo.oficina'=>$oficina,'Anticipo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$contados  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Contado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$contras   = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$creditos  = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Credito','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$credicons = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Credicontado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$fletes    = $this->Venta->importModel('Recibo')->find('first',array('fields'=>array('SUM(Recibo.flete) AS valorS'),'conditions'=>array('Recibo.oficina'=>$oficina,'Recibo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$fletesDes = $this->Venta->importModel('Despacho')->find('first',array('fields'=>array('SUM(Despacho.valor) AS valorS'),'conditions'=>array('Despacho.oficina'=>$oficina,'Despacho.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			}
			$anticipo  = empty($anticipos[0]['valorS']) ? 0 : $anticipos[0]['valorS'];
			$contado   = empty($contados[0]['valorS'])  ? 0 : $contados[0]['valorS'];
			$contra    = empty($contras[0]['valorS'])   ? 0 : $contras[0]['valorS'];
			$credito   = empty($creditos[0]['valorS'])  ? 0 : $creditos[0]['valorS'];
			$credicon  = empty($credicons[0]['valorS']) ? 0 : $credicons[0]['valorS'];
			$flete     = empty($fletes[0]['valorS'])    ? 0 : $fletes[0]['valorS'];
			$fletesDe  = empty($fletesDes[0]['valorS'])    ? 0 : $fletesDes[0]['valorS'];
			$cliente   = 0;
			$recibo    = 0;
			$pago      = 0;
			$flete     = $flete + $fletesDe;
			$anticipo2 = empty($anticipos2[0]['valorS']) ? 0 : $anticipos2[0]['valorS'];
			$contado2  = empty($contados2[0]['valorS'])  ? 0 : $contados2[0]['valorS'];
			$contra2   = empty($contras2[0]['valorS'])   ? 0 : $contras2[0]['valorS'];
			$credito2  = empty($creditos2[0]['valorS'])  ? 0 : $creditos2[0]['valorS'];
			$credicon2 = empty($credicons2[0]['valorS']) ? 0 : $credicons2[0]['valorS'];
			$flete2    = empty($fletes2[0]['valorS'])    ? 0 : $fletes2[0]['valorS'];
			$saldoAnt = $anticipo2+$contado2+$contra2+$flete2;
			$saldo    = $anticipo+$contado+$contra-$flete+$recibo+$pago+$saldoAnt;
			$saldo2   = $credito+$cliente+$contra+$credicon;
		}
		$oficinas     = $this->Venta->importModel('Oficina')->find('list');
		$oficinas[-1] = 'TODAS LAS OFICINAS';
		$this->set(compact('post','saldoAnt','saldo','saldo2','cliente','oficinas','recibo','pago','credito','credicon','contado','contra','flete','oficina','desde','hasta','anticipos','anticipo'));
	}

	public function anticipo($oficina = null, $desde = null, $hasta = null) {
		$this->layout = 'empty';
		$anticipos    = $this->Venta->importModel('Anticipo')->find('all',array('conditions'=>array('Anticipo.oficina'=>$oficina,'Anticipo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
		$usuarios     = $this->Venta->importModel('User')->find('list');
		$oficinas     = $this->Venta->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));

		$this->set(compact('anticipos','usuarios','oficinas','oficina','desde','hasta'));
	}

	public function cajaExcel($tipo = null,$oficina = null, $desde = null, $hasta = null) {
		$destinos = $this->Venta->importModel('Destino')->find('list');

		//Configure::write('debug', 0);
		if($oficina != '-1'){
			if($tipo == "anticipo"){
				$anticipos    = $this->Venta->importModel('Anticipo')->find('all',array('conditions'=>array('Anticipo.oficina'=>$oficina,'Anticipo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$this->ExcelWrite->anticiposCaja($anticipos, $oficina, $desde, $hasta);
			} elseif ($tipo == "credito") {
				$creditos  = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Credito','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$creditos,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "contado") {
				$contados  = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Contado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$contados,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "cliente") {
				$clientes  = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Cliente','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$clientes,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "contra") {
				$contras  = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$contras,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "contrat") {
				$contras  = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$contras,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "credicon") {
				$credicons  = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>$oficina,'Venta.clase'=>'Credicontado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$credicons,$empaques, $oficina, $desde, $hasta);
			}  elseif ($tipo == "fletes") {
				$fletes      = $this->Venta->importModel('Recibo')->find('all',array('conditions'=>array('Recibo.oficina'=>$oficina,'Recibo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$fletesDes   = $this->Venta->importModel('Despacho')->find('all',array('conditions'=>array('Despacho.oficina'=>$oficina,'Despacho.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$conductores = $this->Venta->importModel('Conductor')->find('list');
				$vehiculos   = $this->Venta->importModel('Vehiculo')->find('list');
				
				$fleteArray = array();
				$i = 0;
				foreach ($fletes as $key => $value) {
					$fleteArray[$i]['fecha']     = $value['Recibo']['fecha'];
					$fleteArray[$i]['tipo']      = "Recibo (".$value['Recibo']['tipo'].")";
					$fleteArray[$i]['numero']    = $value['Recibo']['numero'];
					$fleteArray[$i]['destino']   = $destinos[$value['Recibo']['destino']];
					$fleteArray[$i]['documento'] = $value['Recibo']['documento'];
					$fleteArray[$i]['nombre']    = $value['Recibo']['negociador_nom'];
					$fleteArray[$i]['remesas']   = $value['Recibo']['guia_id'];
					$fleteArray[$i]['valor']     = $value['Recibo']['flete'];
					$i = $i + 1;
				}
				foreach ($fletesDes as $key => $value) {
					$fleteArray[$i]['fecha']     = $value['Despacho']['fecha'];
					$fleteArray[$i]['tipo']      = "P. Despacho";
					$fleteArray[$i]['numero']    = $value['Despacho']['id'];
					$fleteArray[$i]['destino']   = $destinos[$value['Despacho']['destino']];
					$fleteArray[$i]['documento'] = $vehiculos[$value['Despacho']['placa']];
					$fleteArray[$i]['nombre']    = $conductores[$value['Despacho']['conductor']];
					$fleteArray[$i]['remesas']   = $value['Despacho']['guias'];
					$fleteArray[$i]['valor']     = $value['Despacho']['valor'];
					$i = $i + 1;
				}
				// orden por fecha
				$tmp = array(); 
				foreach($fleteArray as $ma){
				    $tmp[] = $ma["fecha"]; 
				}
				array_multisort($tmp, $fleteArray);
				// fin orden
				$this->ExcelWrite->fletesCaja($fleteArray, $oficina, $desde, $hasta);
			}

		} else {
			if($tipo == "anticipo"){
				$anticipos    = $this->Venta->importModel('Anticipo')->find('all',array('conditions'=>array('Anticipo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$this->ExcelWrite->anticiposCaja($anticipos, $oficina, $desde, $hasta);
			} elseif ($tipo == "credito") {
				$creditos  = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Credito','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$creditos,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "contado") {
				$contados  = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Contado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$contados,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "cliente") {
				$clientes  = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Cliente','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques  = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$clientes,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "contra") {
				$recaudos = $this->Venta->importModel('Recaudo')->find('list',array('fields'=>array('Recaudo.destino'),'conditions'=>array('Recaudo.oficina'=>$oficina)));
				$reca     = array_values($recaudos);
				$contras  = $this->Venta->find('all',array('conditions'=>array('Venta.destino'=>$reca,'Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$contras,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "contrat") {
				$contras  = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$contras,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "credicon") {
				$credicons  = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Credicontado','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$empaques = $this->Venta->importModel('Empaque')->find('list');
				$this->ExcelWrite->contadosCaja($tipo,$credicons,$empaques, $oficina, $desde, $hasta);
			} elseif ($tipo == "fletes") {
				$fletes      = $this->Venta->importModel('Recibo')->find('all',array('conditions'=>array('Recibo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$fletesDes   = $this->Venta->importModel('Despacho')->find('all',array('conditions'=>array('Despacho.fecha BETWEEN ? and ?' => array($desde, $hasta))));
				$conductores = $this->Venta->importModel('Conductor')->find('list');
				$vehiculos   = $this->Venta->importModel('Vehiculo')->find('list');
				
				$fleteArray = array();
				$i = 0;
				foreach ($fletes as $key => $value) {
					$fleteArray[$i]['fecha']     = $value['Recibo']['fecha'];
					$fleteArray[$i]['tipo']      = "Recibo (".$value['Recibo']['tipo'].")";
					$fleteArray[$i]['numero']    = $value['Recibo']['numero'];
					$fleteArray[$i]['destino']   = $destinos[$value['Recibo']['destino']];
					$fleteArray[$i]['documento'] = $value['Recibo']['documento'];
					$fleteArray[$i]['nombre']    = $value['Recibo']['negociador_nom'];
					$fleteArray[$i]['remesas']   = $value['Recibo']['guia_id'];
					$fleteArray[$i]['valor']     = $value['Recibo']['flete'];
					$i = $i + 1;
				}
				foreach ($fletesDes as $key => $value) {
					$fleteArray[$i]['fecha']     = $value['Despacho']['fecha'];
					$fleteArray[$i]['tipo']      = "P. Despacho";
					$fleteArray[$i]['numero']    = $value['Despacho']['id'];
					$fleteArray[$i]['destino']   = $destinos[$value['Despacho']['destino']];
					$fleteArray[$i]['documento'] = $vehiculos[$value['Despacho']['placa']];
					$fleteArray[$i]['nombre']    = $conductores[$value['Despacho']['conductor']];
					$fleteArray[$i]['remesas']   = $value['Despacho']['guias'];
					$fleteArray[$i]['valor']     = $value['Despacho']['valor'];
					$i = $i + 1;
				}
				// orden por fecha
				$tmp = array(); 
				foreach($fleteArray as $ma){
				    $tmp[] = $ma["fecha"]; 
				}
				array_multisort($tmp, $fleteArray);
				// fin orden
				$this->ExcelWrite->fletesCaja($fleteArray, $oficina, $desde, $hasta);
			}
		}
		
	}

	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null){
		$venta               = $this->Venta->read(null,$id);
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
		$oficinaB              = $this->Venta->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['Venta']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['resolucion']   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
		$envio['fecha']        = $venta['Venta']['fecha'];
		$envio['vence']        = $venta['Venta']['fecha'];
		$envio['factura']      = $venta['Venta']['facturacion'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['Venta']['tipo'].' '.$venta['Venta']['documento1'].' '.$venta['Venta']['documento2'].' '.$venta['Venta']['documento3'];
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
		
		$origenB               = $this->Venta->importModel('Destino')->read(null,$venta['Venta']['origen']);
		$destinoB              = $this->Venta->importModel('Destino')->read(null,$venta['Venta']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->Venta->importModel('Destinatario')->read(null,$venta['Venta']['destinatario']);
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
			$empaqueB = $this->Venta->importModel('Empaque')->read(null, $empaqueAct);
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

		$usuarioB = $this->Venta->importModel('User')->read(null,$venta['Venta']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = substr(strtoupper($venta['Venta']['clase']),0,10) ;
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


	public function mercancia(){
		$oficinas = $this->Venta->importModel('Oficina')->find('list');
		$regiones = $this->Venta->importModel('Region')->find('list');
		$user     = $this->Auth->user();
		$user     = $this->Venta->importModel('User')->read(null,$user['id']);
		//$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.','or'=>array('Venta.despachada !='=>'Despachada','Venta.despachada !='=>'Confirmada','Venta.despachada !='=>'Escaneada'))));
		$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.despachada'=>$user['User']['oficina_id'])));
		$empaques = $this->Venta->importModel('Empaque')->find('list');
		$destinos = $this->Venta->importModel('Destino')->find('list');
		$destRegi = $this->Venta->importModel('Destino')->find('list',array('fields'=>array('Destino.region_id')));
		foreach ($ventas as $key => $value) {
			$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
			$suma = 0;
			foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
				$suma = $suma + $value2;
			}
			if(count($empaqueInfo['empaques']) > 1){
				$ventas[$key]['Venta']['empaque'] = 'Otros';
			} else {
				$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
			}
			$ventas[$key]['Venta']['cantidad'] = $suma;
			$ventas[$key]['Venta']['region']   = $destRegi[$value['Venta']['destino']];
			$ventas[$key]['Venta']['origenN']  = $destinos[$value['Venta']['origen']];
			$ventas[$key]['Venta']['destinoN'] = $destinos[$value['Venta']['destino']];
		}
		$this->generateJSON('sin_despachar', $ventas, array('Venta' => array('id','despachada','region','remesa','nombreDest','nombreClien','origenN','destinoN','cantidad','empaque')));
		$this->set(compact('oficinas','regiones'));
	}

	public function confirmacion($id = null){
		if(!empty($this->data)){
			$venta                                   = $this->Venta->read(null,$this->data['Venta']['id']);
			$venta['Venta']['usuario_confirm']       = $this->data['Venta']['usuario_confirm'];
			$venta['Venta']['fecha_confirm']         = date("Y-m-d H:i:s");
			$venta['Venta']['recibio']               = $this->data['Venta']['recibio'];
			$venta['Venta']['tipo_despacho']         = $this->data['Venta']['tipo_despacho'];
			$venta['Venta']['novedad ']              = $this->data['Venta']['novedad '];
			$venta['Venta']['cedula_recibio2 ']      = $this->data['Venta']['cedula_recibio2 '];
			$venta['Venta']['recibido2']             = $this->data['Venta']['recibido2'];
			$venta['Venta']['observaciones_recibio'] = $this->data['Venta']['observaciones_recibio'];
			$venta['Venta']['fecha_recibio']         = $this->data['Venta']['fecha_recibio'];
			$venta['Venta']['telefono_recibido']     = $this->data['Venta']['telefono_recibido'];
			$venta['Venta']['sello']                 = $this->data['Venta']['sello'];
			$venta['Venta']['cargo_recibido']        = $this->data['Venta']['cargo_recibido'];
			$venta['Venta']['cedula_recibio']        = $this->data['Venta']['cedula_recibio'];
			$venta['Venta']['despachada']            = 'Confirmada';
			
			
			if(!empty($this->data['Venta']['Si'])){
				$changes = array(
					'Venta.observaciones' => "Recibida por el representante"
				);
				$isOk = $this->Venta->updateAll($changes,array('Venta.id'=>$this->data['Venta']['Si']));
			}
			
			if($this->Venta->save($venta)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La confirmación se realizo con exito.'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La confirmación no se puedo guardar.'));
			}
		}
		$this->data  = null;
		$ventas      = $this->Venta->find('all',array('conditions'=>array('or'=>array('Venta.despachada'=>'Despachada'))));
		$ventasL     = $this->Venta->find('list',array('conditions'=>array('or'=>array('Venta.despachada'=>'Despachada'))));
		$recibos     = $this->Venta->importModel('Recibo')->find('all');
		$recibos     = Hash::combine($recibos, '{n}.Recibo.guia_id', '{n}');
		$conductores = $this->Venta->importModel('Conductor')->find('list',array('conditions'=>array('Conductor.conductor2'=>1)));
		$vehiculos   = $this->Venta->importModel('Vehiculo')->find('list');
		$auxiliares  = $this->Venta->importModel('Auxiliar')->find('list');
		$despachos   = $this->Venta->importModel('Despacho')->find('all');
		$reempaques  = $this->Venta->importModel('Reempaque')->find('all');
		$empaques    = $this->Venta->importModel('Empaque')->find('list');
		$novedades   = $this->Venta->importModel('Novedad')->find('list',array('fields'=>array('Novedad.novedad','Novedad.novedad'),'conditions'=>array('Novedad.tipo'=>'Entrega')));
		foreach ($despachos as $key => $value) {
			$despachos[$key]['Despacho']['conductor']  = $conductores[$value['Despacho']['conductor']];
			$despachos[$key]['Despacho']['negociador'] = $auxiliares[$value['Despacho']['negociador']];
			$despachos[$key]['Despacho']['placa']      = $vehiculos[$value['Despacho']['placa']];
			$despachos[$key]['Despacho']['guias']      = json_decode($value['Despacho']['guias'],true);
		}
		foreach ($reempaques as $key => $value) {
			$reempaques[$key]['Reempaque']['conductor']  = $conductores[$value['Reempaque']['conductor']];
			$reempaques[$key]['Reempaque']['negociador'] = $auxiliares[$value['Reempaque']['negociador']];
			$reempaques[$key]['Reempaque']['guias']      = json_decode($value['Reempaque']['guias'],true);
		}
		foreach ($ventas as $key => $value) {
			$empaqueInfo = json_decode($value['Venta']['empaque_info'], true);
			$suma = 0;
			foreach ($empaqueInfo['cantidad'] as $key2 => $value2) {
				$suma = $suma + $value2;
			}
			if(count($empaqueInfo['empaques']) > 1){
				$ventas[$key]['Venta']['empaque'] = 'Otros';
			} else {
				$ventas[$key]['Venta']['empaque'] = $empaques[$empaqueInfo['empaques'][0]];
			}
			$ventas[$key]['Venta']['cantidad'] = $suma;
			if($value['Venta']['tipo'] == "Reempaque"){
				$ventas[$key]['Venta']['guiaReemp'] = true;
			} else {
				$ventas[$key]['Venta']['guiaReemp'] = false;
			}
		}
		$this->generateJSON('sin_despachar_confir', $ventas, array('Venta' => array('id','tipo_despacho','remesa','nombreDest','nombreClien','origenNombre','destinoNombre','cantidad','empaque')));
		$this->set(compact('id','ventas','ventasL','novedades','recibos','despachos','reempaques'));
	}

	public function upload(){
		$this->autoRender = false;
		error_reporting(E_ALL | E_STRICT);
		App::uses('UploadHandler', 'Controller');
		$upload_handler = new UploadHandler();
	}
	public function escanear(){
		if(!empty($this->data)){
			if(count($this->data['Venta']['guia']) == 1){
				$this->request->data['Venta']['guia'] = $this->data['Venta']['guia'][0];
			}
        	$this->Venta->updateAll(
        		array('Venta.archivo'=>$this->data['Venta']['control'],'Venta.despachada'=>'"Escaneada"','Venta.usuario_escan'=>$this->data['Venta']['usuario_escan'],'Venta.fecha_escan'=>'"'.date("Y-m-d H:i:s").'"')
        		,array('Venta.id'=>$this->data['Venta']['guia']));
		}
		$guiasEsca = $this->Venta->find('list',array('recursive'=>'-1','conditions'=>array('Venta.archivo'=>null,'Venta.despachada'=>'Escaneada')));
		$guias     = $this->Venta->find('all',array('recursive'=>'-1','conditions'=>array('Venta.archivo'=>null,'Venta.despachada'=>array('Confirmada','Escaneada'))));
		$this->set(compact('guias','guiasEsca'));
	}

	public function ver($id = null){
		$guias   = $this->Venta->find('list',array('recursive'=>'-1','conditions'=>array('Venta.despachada'=>'Escaneada')));
		$this->set(compact('guias','id'));
	}

	public function trazabilidad($id = null) {
		$venta = $this->Venta->trazabilidad($id);
		$this->set(compact('venta'));
	}

	public function trazabilidad2($remesa = null) {
		$this->autoRender = false;
		$ventaSQL = $this->Venta->getVenta($remesa);
		if(!empty($ventaSQL)){
			$venta = $this->Venta->trazabilidad($ventaSQL[0]['Venta']['id']);
		} else {
			$venta = "";
		}

		return json_encode($venta);
	}

	public function clientes(){
		$post    = false;
		$desde   = date("Y-m-d");
		$hasta   = date("Y-m-d");
		$cliente = "";
		
		$saldo         = 0;
		$contado       = 0;
		$credito       = 0;
		$contraentrega = 0;
		$credicontado  = 0;
		if(!empty($this->data)){
			$post     = true;
			$desde    = $this->data['Venta']['desde'];
			$hasta    = $this->data['Venta']['hasta'].' 23:59:59';
			$cliente  = $this->data['Venta']['cliente'];
			$ventas   = $this->Venta->find('all',array('conditions'=>array('Venta.clase !='=>'Especial','Venta.cliente'=>$this->data['Venta']['cliente'])));
			foreach ($ventas as $key => $value) {
				if($value['Venta']['clase'] == "Contado"){
					$contado = $contado + $value['Venta']['valor_total'];
				} elseif ($value['Venta']['clase'] == "Credito") {
					$credito = $credito + $value['Venta']['valor_total'];
				} elseif ($value['Venta']['clase'] == "Contraentrega") {
					$contraentrega = $contraentrega + $value['Venta']['valor_total'];
				} elseif ($value['Venta']['clase'] == "Credicontado") {
					$credicontado = $credicontado + $value['Venta']['valor_total'];
				}
			}
			$saldo    = $contado + $credito + $contraentrega + $credicontado;
		}
		$clientes = $this->Venta->importModel('Cliente')->find('list',array('conditions'=>array('Cliente.id >'=>1)));
		$this->set(compact('clientes','post','cliente','desde','hasta','saldo','contado','credito','contraentrega','credicontado'));

	}

	public function clienteExcel($tipo = null,$cliente = null, $desde = null, $hasta = null) {
		$hasta = $hasta.' 23:59:59';
		Configure::write('debug', 0);
		$cliente  = $this->Venta->importModel('Cliente')->find('first',array('conditions'=>array('Cliente.id'=>$cliente)));
		$empaques = $this->Venta->importModel('Empaque')->find('list');
		//$destinos = $this->Venta->importModel('Destino')->find('list');
		if($tipo == "contado") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Contado','Venta.cliente'=>$cliente['Cliente']['id'])));
			$this->ExcelWrite->contadoCliente($tipo,$ventas, $cliente, $empaques, $desde, $hasta);
		} elseif($tipo == "credito") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Credito','Venta.cliente'=>$cliente['Cliente']['id'])));
			$this->ExcelWrite->contadoCliente($tipo,$ventas, $cliente, $empaques, $desde, $hasta);
		} elseif($tipo == "credicontado") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Credicontado','Venta.cliente'=>$cliente['Cliente']['id'])));
			$this->ExcelWrite->contadoCliente($tipo,$ventas, $cliente, $empaques, $desde, $hasta);
		} elseif($tipo == "contraentrega") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Contraentrega','Venta.cliente'=>$cliente['Cliente']['id'])));
			$this->ExcelWrite->contadoCliente($tipo,$ventas, $cliente, $empaques, $desde, $hasta);
		} elseif($tipo == "especial") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.clase'=>'Especial','Venta.cliente'=>$cliente['Cliente']['id'])));
			$this->ExcelWrite->contadoCliente($tipo,$ventas, $cliente, $empaques, $desde, $hasta);
		}
	}

	public function representantes(){
		$post          = false;
		$desde         = date("Y-m-d");
		$hasta         = date("Y-m-d");
		$representante = "";

		$planilla      = 0;
		$vender        = 0;
		$confirma      = 0;
		$escanea       = 0;
		$digitar       = 0;
		$fletes        = 0;
		$contraentrega = 0;
		$saldo         = 0;

		if(!empty($this->data)){
			$post          = true;
			$desde         = $this->data['Venta']['desde'];
			$hasta         = $this->data['Venta']['hasta'].' 23:59:59';

			$representante = $this->data['Venta']['representante'];

			$planillas      = $this->Venta->importModel('Reempaque')->find('first',array('fields'=>array('SUM(Reempaque.valor) AS valorS'),'conditions'=>array('Reempaque.representante'=>$representante,'Reempaque.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$comiVenta      = $this->Venta->importModel('Reempaque')->getNego($representante, $desde, $hasta);
			$contraentregas = $this->Venta->find('first',array('fields'=>array('SUM(Venta.valor_total) AS valorS'),'conditions'=>array('Venta.recaudador'=>$representante,'Venta.clase'=>'Contraentrega','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$vender         = $comiVenta['valor'];
			$digitar        = $comiVenta['digita'];
			$confirma       = $comiVenta['confirma'];
			$escanea        = $comiVenta['escanea'];
			$fletes         = $comiVenta['fletes'];
			$planilla       = empty($planillas[0]['valorS']) ? 0 : $planillas[0]['valorS'];
			$contraentrega  = empty($contraentregas[0]['valorS']) ? 0 : $contraentregas[0]['valorS'];

			$saldo = $planilla+$vender+$confirma+$escanea+$digitar+$fletes-$contraentrega;
		}
		$representantes = $this->Venta->importModel('Representante')->find('list',array('fields'=>array('Representante.codigo')));
		$this->set(compact('representantes','post','representante','desde','hasta','planilla','vender','confirma','escanea','digitar','fletes','contraentrega','saldo'));

	}

	public function representanteExcel($tipo = null,$representante = null, $desde = null, $hasta = null) {
		$hasta = $hasta.' 23:59:59';
		Configure::write('debug', 0);
		$representante = $this->Venta->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$representante)));
		$empaques      = $this->Venta->importModel('Empaque')->find('list');
		$destinos      = $this->Venta->importModel('Destino')->find('list');
		
		if($tipo == "planilla") {
			$auxiliares = $this->Venta->importModel('Auxiliar')->find('list',array('conditions'=>array('Auxiliar.negociar'=>"'Si'")));
			$planillas  = $this->Venta->importModel('Reempaque')->find('all',array('conditions'=>array('Reempaque.representante'=>$representante['Representante']['id'],'Reempaque.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			foreach ($planillas as $key => $value) {
				$planillas[$key]['Reempaque']['auxiliar'] = $auxiliares[$value['Reempaque']['negociador']];
				$planillas[$key]['Reempaque']['origen']   = $destinos[$value['Reempaque']['origen']];
				$planillas[$key]['Reempaque']['destino']  = $destinos[$value['Reempaque']['destino']];
				$planillas[$key]['Reempaque']['remesas']  = $this->Venta->find('list',array('fields'=>array('Venta.remesa'),'conditions'=>array('Venta.id'=>$value['Reempaque']['guias'])));
			}
			$this->ExcelWrite->planillasRepre($planillas, $representante, $desde, $hasta);

		} elseif ($tipo == "confirma") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>'7','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$this->ExcelWrite->confirmasRepre($ventas, $representante,$empaques, $desde, $hasta);
		} elseif ($tipo == "escanea") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>'7','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$this->ExcelWrite->escaneasRepre($ventas, $representante,$empaques, $desde, $hasta);
		} elseif ($tipo == "digita") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.oficina'=>'7','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$this->ExcelWrite->digitasRepre($ventas, $representante,$empaques, $desde, $hasta);
		} elseif ($tipo == "flete") {
			$fletes = $this->Venta->importModel('Recibo')->find('all',array('conditions'=>array('Recibo.usuario'=>$representante['Representante']['usuario'],'Recibo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$this->ExcelWrite->fletesRepre($fletes, $representante,$destinos, $desde, $hasta);
		} elseif ($tipo == "contra") {
			$ventas = $this->Venta->find('all',array('conditions'=>array('Venta.recaudador'=>$representante['Representante']['id'],'Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$this->ExcelWrite->contrasRepre($ventas, $representante,$empaques, $desde, $hasta);
		}
	}

	public function getDestinatarios() {
		$this->autoRender = false;
		
		$destinatarios  = $this->Venta->importModel('Destinatario')->find('all',array('recursive'=>-1));
		$destinatariosD = $this->Venta->importModel('Destinatario')->find('list',array('fields'=>array('Destinatario.documento')));

		$destinatariosN = array();
		foreach ($destinatarios as $key => $value) {
			$desN = json_decode($destinatarios[$key]['Destinatario']['destinos'],true);
			foreach ($desN as $key2 => $value2) {
				$destinatariosN[$value2][] = $destinatarios[$key]['Destinatario']['id'];
			}
		}
		$data['Nombre'] = $destinatariosN;
		$data['Todo']   = $destinatarios;
		return json_encode($data);
	}

	public function anular($id = null, $razon = null){
		
		$user  = $this->Auth->user();
		$user  = $this->Venta->importModel('User')->read(null,$user['id']);
		if($id != null){
			$guia                         = $this->Venta->read(null,$id);
			$guiaAnulada['Ventasanulada'] = $guia['Venta'];
			if($this->Venta->importModel('Ventasanulada')->save($guiaAnulada)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La guia '.$guia['Venta']['remesa'].' se anulo con exito.'));
    			$this->Venta->delete($id);
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La guia no se pudo anular.'));
			}
		}
		if($user['User']['role_id'] == 1){
			$guias = $this->Venta->find('all',array('conditions'=>array('Venta.despachada !='=>array('Despachada','DespachadaRepre','Confirmada','Escaneada'))));
			$guiasL = $this->Venta->find('all',array('conditions'=>array('Venta.despachada !='=>array('Despachada','DespachadaRepre','Confirmada','Escaneada'))));



			//$guias  = $this->Venta->find('all',array('recursive'=>-1));
			//$guiasL = $this->Venta->find('list',array('recursive'=>-1));
		} else {
			$desde  = date("Y-m-d");
			$hasta  = date("Y-m-d").' 11:59:59';
			$guias  = $this->Venta->find('all',array('conditions'=>array('Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
			$guiasL = $this->Venta->find('list',array('conditions'=>array('Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
		}
		
		$this->generateJSON('guias_anula', $guias, array('Venta' => array('id','remesa','nombreDest','nombreClien','origenNombre','destinoNombre')));
		$this->set(compact('guias','guiasL'));
	}

	public function getsoap($fecha = "") {
		$fecha = explode("-", $fecha);
		$fecha = implode("", $fecha);
	//	$this->autoRender = false;
		
		$requestParams = array("guiaDTO"=>array(
			"arrGuias"=>array("barrio"=>"","campana"=>"","celular"=>"","ciudad"=>"","ciudadDestinoDane"=>"","codInterno"=>"","contenido"=>"","departamento"=>"","direccion"=>"","fechaEmbarque"=>"","iva"=>"","mailPlan"=>"","nombre"=>"","nroCajas"=>"","nroGuia"=>"","nroOrden"=>"","origen"=>"","porteria"=>"","reempaque"=>"","telefono1"=>"","telefono2"=>"","valor"=>"","zona"=>""),
			"codPais"=>"57",
			"codTransportador"=>"7",
			"contrasena"=>"",
			"dsStatus"=>"",
			"dsTransportador"=>"GNMANYSER",
			"fechaEmbarque"=>$fecha,
			"status"=>"",
			"tipo"=>""
			)
		);
		$client = new SoapClient('http://leonisavirtualco.leonisa.com/TrackingTransportistas/EmbarqueBusinessService/EmbarqueBusinessService.wsdl');
		
		$response = $client->consultarGuiasEmbarque($requestParams);
		
		/*
		$response = new stdClass;
			$uno = new stdClass;
			$uno->barrio = "SAN MARTIN";
			$uno->campana = "1504";
			$uno->celular = "3208686779";
			$uno->ciudad = "ARAUQUITA";
			$uno->ciudadDestinoDane = "81065000";
			$uno->codInterno = "24246686";
			$uno->contenido = "PEDIDOS";
			$uno->departamento = "ARAUCA";
			$uno->direccion = "CALLE 3 # 5-20";
			$uno->fechaEmbarque = "20150324";
			$uno->iva = "72229.00";
			$uno->mailPlan = "O";
			$uno->nombre = "MARILUZ ALFONSO GUTIERREZ";
			$uno->nroCajas = "1";
			$uno->nroGuia = "6706552";
			$uno->nroOrden = "7596913";
			$uno->origen = "MEDELLIN - ANTIOQUIA";
			$uno->porteria = "N";
			$uno->reempaque = "S";
			$uno->telefono1 = "3208686779";
			$uno->telefono2 = "3208686779";
			$uno->valor = "531128.00";
			$uno->zona = "998";

			$dos = new stdClass;
			$dos->barrio = "SAN MARTIN";
			$dos->campana = "1504";
			$dos->celular = "3208686779";
			$dos->ciudad = "ARAUQUITA";
			$dos->ciudadDestinoDane = "81065000";
			$dos->codInterno = "24246686";
			$dos->contenido = "PEDIDOS";
			$dos->departamento = "ARAUCA";
			$dos->direccion = "CALLE 3 # 5-20";
			$dos->fechaEmbarque = "20150324";
			$dos->iva = "72229.00";
			$dos->mailPlan = "O";
			$dos->nombre = "MARILUZ ALFONSO GUTIERREZ";
			$dos->nroCajas = "1";
			$dos->nroGuia = "6706552";
			$dos->nroOrden = "7596913";
			$dos->origen = "MEDELLIN - ANTIOQUIA";
			$dos->porteria = "N";
			$dos->reempaque = "S";
			$dos->telefono1 = "3208686779";
			$dos->telefono2 = "3208686779";
			$dos->valor = "531128.00";
			$dos->zona = "998";

		$base = new stdClass;
		$base->arrGuias = array($uno,$dos);
		$base->dsStatus = "";
		$base->status = 0;
		$response->return = $base;
		*/

		return $response;
		/*
		$client = new SoapClient('http://127.0.0.1/wsdl/mys.php?wsdl');
		$response = $client->Hola();
		*/
	}

	public function leonisa(){
		$desde = date("Y-m-d");
		$auxx  = array();
		$auxx2 = array();
		if(!empty($this->data)){
			$leonisaCli = $this->Venta->importModel('Cliente')->find('first',array('conditions'=>array('Cliente.id'=>82)));
            if(!empty($this->data['Venta']['tipoguardar'])){
				$desde = $this->data['Venta']['fecha2'];
			} else {
				$desde = $this->data['Venta']['fecha'];
			}
			$guias = $this->getsoap($desde);
			$destinos = $this->Venta->importModel('Destino')->find('list',array('fields'=>array('Destino.codigo')));
			foreach ($guias->return->arrGuias as $key => $value) {
				$destId     = array_search(substr($value->ciudadDestinoDane,0,-3),$destinos);
				$tarifaJson = $this->getTarifa(82,1,$destId);
				$tarifa     = json_decode($tarifaJson,true);
				if(empty($tarifa['TarifaBase'])){
					$auxx[$key]['Venta']['estado'] = 0;
					$this->log("********************");
					$this->log("********************");
					$this->log("********************");
					$this->log($value->ciudadDestinoDane);
					$this->log("********************");
					$this->log("********************");
					$this->log("********************");
				} else {
					$auxx[$key]['Venta']['estado'] = 1;
				}
				$auxx[$key]['Venta']['tarifa']            = $tarifaJson;
				$auxx[$key]['Venta']['destino']           = $destId;
				$auxx[$key]['Venta']['ciudad']            = $value->ciudad;
				$auxx[$key]['Venta']['ciudadDestinoDane'] = $value->ciudadDestinoDane;
				$auxx[$key]['Venta']['nombre']            = $value->nombre;
				$auxx[$key]['Venta']['direccion']         = $value->direccion.' '.$value->barrio;
				$auxx[$key]['Venta']['telefono1']         = $value->telefono1;
				$auxx[$key]['Venta']['telefono2']         = $value->telefono2;
				$auxx[$key]['Venta']['nroCajas']          = $value->nroCajas;
				$auxx[$key]['Venta']['contenido']         = $value->contenido;
				$auxx[$key]['Venta']['nroGuia']           = $value->nroGuia;
				$auxx[$key]['Venta']['nroOrden']          = $value->nroOrden;
				$auxx[$key]['Venta']['campana']           = $value->campana;
				$auxx[$key]['Venta']['zona']              = $value->zona;
				$auxx[$key]['Venta']['valor']             = $value->valor;
				$auxx2[$value->nroGuia] = $auxx[$key]['Venta'];
			}
			if(!empty($this->data['Venta']['tipoconsultar'])){
				$this->generateJSON('leonisa', $auxx, array('Venta' => array('nroGuia','ciudad','nombre','direccion','telefono1','nroCajas','contenido','nroGuia','nroOrden','campana','zona','estado','valor')));
			}
			$user = $this->Auth->user();
			$user = $this->Venta->importModel('User')->read(null,$user['id']);
			
			$this->autoRender = true;

			if(!empty($this->data['Venta']['tipoguardar'])){
				$ventaAll = array();
				$ind = 0;
				foreach ($this->data['Venta']['codigo'] as $numGuia => $numBarra) {
					if($numBarra != ""){
						$empaqueInfo = array();
						$empaqueInfo['cantidad'] = $auxx2[$numGuia]['nroCajas'];
						$empaqueInfo['barras']   = array($numBarra);
						if($auxx2[$numGuia]['estado'] == "1"){
							$tarifaJson = $auxx2[$numGuia]['tarifa'];
							$tarifa = json_decode($tarifaJson,true);
							if(!empty($tarifa['Tarifa'])){
								foreach ($tarifa['Tarifa'] as $key => $value) {
									if($value['Tarifa']['empaque_id'] == "3"){
										$cantidad                = floatval($empaqueInfo['cantidad']);
										$empaqueInfo['largo']    = array($value['Tarifa']['largo']);
										$empaqueInfo['ancho']    = array($value['Tarifa']['ancho']);
										$empaqueInfo['alto']     = array($value['Tarifa']['alto']);
										$empaqueInfo['peso']     = array($value['Tarifa']['peso']);
										$empaqueInfo['pesoVol']  = array((($value['Tarifa']['largo']/100)*($value['Tarifa']['ancho']/100)*($value['Tarifa']['alto']/100))*400*$cantidad);
										$empaqueInfo['subtotal'] = array($cantidad*$value['Tarifa']['tarifa']);
										$flete = $empaqueInfo['subtotal'];
										$empaqueInfo['kiloAd']   = array($value['Tarifa']['max_kilo']*$cantidad);
										$empaqueInfo['valor']    = array($value['Tarifa']['tarifa']);
										$declarado               = floatval($value['Tarifa']['declarado']);
										$porcenDeclarado         = floatval($value['Tarifa']['porcen_declarado']);
									}
								}
							} else {
								foreach ($tarifa['TarifaBase'] as $key => $value) {
									if($value['Tarifa']['empaque_id'] == "3"){
										$cantidad                = floatval($empaqueInfo['cantidad']);
										$empaqueInfo['largo']    = array($value['Tarifa']['largo']);
										$empaqueInfo['ancho']    = array($value['Tarifa']['ancho']);
										$empaqueInfo['alto']     = array($value['Tarifa']['alto']);
										$empaqueInfo['peso']     = array($value['Tarifa']['peso']);
										$empaqueInfo['pesoVol']  = array((($value['Tarifa']['largo']/100)*($value['Tarifa']['ancho']/100)*($value['Tarifa']['alto']/100))*400*$cantidad);
										$empaqueInfo['subtotal'] = array($cantidad*$value['Tarifa']['tarifa']);
										$flete = $empaqueInfo['subtotal'];
										$empaqueInfo['kiloAd']   = array($value['Tarifa']['max_kilo']*$cantidad);
										$empaqueInfo['valor']    = array($value['Tarifa']['tarifa']);
										$declarado               = floatval($value['Tarifa']['declarado']);
										$porcenDeclarado         = floatval($value['Tarifa']['porcen_declarado']);
									}
								}
							}
							$empaqueInfo['empaques'] = array('3');
							
							$ventaAll[$ind]['Venta']['empaque_info'] = json_encode($empaqueInfo);
							$ventaAll[$ind]['Venta']['fecha']        = date("Y-m-d");
							$ventaAll[$ind]['Venta']['hora']         = date("H:i:s");
							$ventaAll[$ind]['Venta']['despachada']   = $user['Oficina']['id'];
							$ventaAll[$ind]['Venta']['clase']        = 'Credito';
							$ventaAll[$ind]['Venta']['remauto']      = $user['Oficina']['codigo'].$user['User']['codigo'].'-';
							$ventaAll[$ind]['Venta']['origen']       = 1;
							$ventaAll[$ind]['Venta']['destino']      = $auxx2[$numGuia]['destino'];
							$ventaAll[$ind]['Venta']['declarado']    = $auxx2[$numGuia]['valor'];
							$resta = $auxx2[$numGuia]['valor'] - $declarado;
							if($resta > 0){
								$ventaAll[$ind]['Venta']['valor_seguro'] = $auxx2[$numGuia]['valor']*($porcenDeclarado/100);
							} else {
								$ventaAll[$ind]['Venta']['valor_seguro'] = 0;
							}
							$ventaAll[$ind]['Venta']['valor_total']    = floatval($flete)+floatval($ventaAll[$ind]['Venta']['valor_seguro']);
							$ventaAll[$ind]['Venta']['nombreDest']     = $auxx2[$numGuia]['nombre'];
							$ventaAll[$ind]['Venta']['direccionDest']  = $auxx2[$numGuia]['direccion'];
							$ventaAll[$ind]['Venta']['telefonoDest']   = $auxx2[$numGuia]['telefono1'];
							$ventaAll[$ind]['Venta']['telefono2Dest']  = $auxx2[$numGuia]['telefono2'];
							$ventaAll[$ind]['Venta']['contenido']      = $auxx2[$numGuia]['contenido'];
							$ventaAll[$ind]['Venta']['cliente']        = 82;
							$ventaAll[$ind]['Venta']['nombreClien']    = $leonisaCli['Cliente']['nombres'];
							$ventaAll[$ind]['Venta']['direccionClien'] = $leonisaCli['Cliente']['direccion'];
							$ventaAll[$ind]['Venta']['telefonoClien']  = $leonisaCli['Cliente']['telefono1'];
							$ventaAll[$ind]['Venta']['telefono2Clien'] = $leonisaCli['Cliente']['telefono2'];
							$ventaAll[$ind]['Venta']['documento1']     = $auxx2[$numGuia]['nroGuia'];
							$ventaAll[$ind]['Venta']['documento2']     = $auxx2[$numGuia]['campana'];
							$ventaAll[$ind]['Venta']['documento3']     = $auxx2[$numGuia]['zona'];
							$ventaAll[$ind]['Venta']['usuario']        = $user['User']['id'];
							//$ventaAll[$ind]['Venta']['firmado']        = "Si";
							$ind = $ind + 1;
						}
					}
            	}
				$this->Venta->saveAll($ventaAll);
    			$this->Session->setFlash('','ok',array('mensaje'=>'Se guardo con exito.'));
            }

			/*$guias = $this->getsoap($this->data['Venta']['fecha']);
			foreach ($guias->return->arrGuias as $key => $value) {
				$auxx[$key]['Venta']['ciudad']    = $value->ciudad;
				$auxx[$key]['Venta']['nombre']    = $value->nombre;
				$auxx[$key]['Venta']['direccion'] = $value->direccion.' '.$value->barrio;
				$auxx[$key]['Venta']['telefono1'] = $value->telefono1;
				$auxx[$key]['Venta']['nroCajas']  = $value->nroCajas;
				$auxx[$key]['Venta']['contenido'] = $value->contenido;
				$auxx[$key]['Venta']['nroGuia']   = $value->nroGuia;
				$auxx[$key]['Venta']['nroOrden']  = $value->nroOrden;
				$auxx[$key]['Venta']['campana']   = $value->campana;
				$auxx[$key]['Venta']['zona']      = $value->zona;
			}
			$this->generateJSON('leonisa', $auxx, array('Venta' => array('nroGuia','ciudad','nombre','direccion','telefono1','nroCajas','contenido','nroGuia','nroOrden','campana','zona')));
			*/
		} else {
			//$this->generateJSON('leonisa', $auxx, array('Venta' => array('ciudad','nombre','direccion','telefono1','nroCajas','contenido','nroGuia','nroOrden','campana','zona')));
		}
		$this->set(compact('desde'));

	}



	public function reliquidar(){
		$user     = $this->Auth->user();
		$ventas   = $this->Venta->find('all',array('recursive'=>-1,'conditions'=>array('Venta.lista'=>0,'Venta.oficina'=>'7')));
		$this->generateJSON('reliquidar_repre', $ventas, array('Venta' => array('id','remesa','nombreDest','direccionDest','destinoNombre','telefonoDest')));
	}

	public function getReliquidar($id = null) {
		$this->layout = 'empty';
		$empaques = $this->Venta->importModel('Empaque')->find('list');
		$guia     = $this->Venta->read(null,$id);
		$recibo   = $this->Venta->importModel('Recibo')->find('count',array('conditions'=>array('Recibo.guia_id'=>$id)));
		if(!empty($this->data)){
			$guia = $this->Venta->read(null,$this->data['Venta']['id']);
			$empaqueInfo = array();
			$empaqueInfo['barras']   = $this->data['Venta']['cbarras'];
			$empaqueInfo['empaques'] = $this->data['Venta']['empaques'];
			$empaqueInfo['descripcion'] = $this->data['Venta']['descripcion'];
			$empaqueInfo['cantidad'] = $this->data['Venta']['cantidad'];
			$empaqueInfo['largo']    = $this->data['Venta']['largo'];
			$empaqueInfo['ancho']    = $this->data['Venta']['ancho'];
			$empaqueInfo['alto']     = $this->data['Venta']['alto'];
			$empaqueInfo['peso']     = $this->data['Venta']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['Venta']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['Venta']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['Venta']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['Venta']['subtotal'];
			$guia['Venta']['empaque_info']    = json_encode($empaqueInfo);
			$guia['Venta']['despachada']      = $this->data['Venta']['oficina_trae'];
			$guia['Venta']['lista']           = 1;
			$guia['Venta']['kilo_nego']       = $this->data['Venta']['kilo_nego'];
			$guia['Venta']['kilo_adic']       = $this->data['Venta']['kilo_adic'];
			$guia['Venta']['valor_kilo_adic'] = $this->data['Venta']['valor_kilo_adic'];
			$guia['Venta']['desc_flete']      = $this->data['Venta']['desc_flete'];
			$guia['Venta']['desc_kilo']       = $this->data['Venta']['desc_kilo'];
			$guia['Venta']['valor_total']     = $this->data['Venta']['valor_total'];
			if($this->Venta->save($guia)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La guia se reliquido exitosamente.'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La guia no se puedo reliquidar.'));
			}
		}
		if($id == null){
			$this->data = null;
		} else {
			$this->data = $guia;
		}
		
		$cliente = $guia['Venta']['cliente'];
		$origen  = $guia['Venta']['origen'];
		$destino = $guia['Venta']['destino'];

		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->Venta->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->Venta->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->Venta->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->Venta->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		$data = json_encode($data);

		$empaqueInfo = json_decode($guia['Venta']['empaque_info'],true);
		$empaqueKO   = array();
		$cantidadCheck = 0;
		foreach ($empaqueInfo['empaques'] as $key => $value) {
			$empaqueKO[$key]['empaques']    = $empaqueInfo['empaques'][$key];
			$empaqueKO[$key]['descripcion'] = $empaqueInfo['descripcion'][$key];
			$empaqueKO[$key]['cantidad']    = $empaqueInfo['cantidad'][$key];
			$cantidadCheck = $cantidadCheck + floatval($empaqueInfo['cantidad'][$key]);
			$empaqueKO[$key]['valKilo']     = 0;
			$empaqueKO[$key]['pesoUni']     = 0;
			$empaqueKO[$key]['largo']       = $empaqueInfo['largo'][$key];
			$empaqueKO[$key]['ancho']       = $empaqueInfo['ancho'][$key];
			$empaqueKO[$key]['alto']        = $empaqueInfo['alto'][$key];
			$empaqueKO[$key]['peso']        = $empaqueInfo['peso'][$key];
			$empaqueKO[$key]['pesoVol']     = number_format(floatval($empaqueInfo['pesoVol'][$key]),2);
			$empaqueKO[$key]['valor']       = $empaqueInfo['valor'][$key];
			$empaqueKO[$key]['kiloAd']      = $empaqueInfo['kiloAd'][$key];
		}
		$empaque_info = json_encode($empaqueKO);
		$costoSeguro  = $guia['Venta']['valor_seguro'];
		$costoDevol   = $guia['Venta']['valor_devolucion'];
		$this->set(compact('recibo','cantidadCheck','costoDevol','costoSeguro','empaques','data','empaque_info'));
	}







}
?>
