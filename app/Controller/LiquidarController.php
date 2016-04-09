<?php
class LiquidarController extends AppController {
	public $name = 'Liquidar';

	public function crear() {
		if(!empty($this->data)){
			//$this->log($this->data);
			if($this->data['Liquidar']['tipo'] == 1){
				if($this->data['Liquidar']['telefono'] != ""){
					$this->request->data['Liquidar']['cliente_id'] = $this->data['Liquidar']['telefono'];
				} else {
					if($this->data['Liquidar']['documento'] != ""){
						$this->request->data['Liquidar']['cliente_id'] = $this->data['Liquidar']['documento'];
					}
				}	
			} else {
				$this->request->data['Liquidar']['cliente_id'] = 1;
			}
			$this->request->data['Liquidar']['valKilo'] = $this->data['Liquidar']['valKilo'][0];
			$empaqueInfo = array();
			$empaqueInfo['empaques'] = $this->data['Liquidar']['empaques'];
			$empaqueInfo['cantidad'] = $this->data['Liquidar']['cantidad'];
			$empaqueInfo['largo']    = $this->data['Liquidar']['largo'];
			$empaqueInfo['ancho']    = $this->data['Liquidar']['ancho'];
			$empaqueInfo['alto']     = $this->data['Liquidar']['alto'];
			$empaqueInfo['peso']     = $this->data['Liquidar']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['Liquidar']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['Liquidar']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['Liquidar']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['Liquidar']['subtotal'];
			$this->request->data['Liquidar']['empaque_info'] = json_encode($empaqueInfo);

			if($this->Liquidar->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La cotización No. '.$this->Liquidar->id.' ha sido registrada con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La cotización no se puedo guardar.'));
			}
		}
		
		$destinos    = $this->Liquidar->importModel('Destino')->find('list');
		$empaques    = $this->Liquidar->importModel('Empaque')->find('list');
		$clientes    = $this->Liquidar->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.tipo'=>'Clientes')));
		$firmado     = $this->Liquidar->getEnumValues('firmado');
		$this->set(compact('destinos','empaques','firmado','clientes'));
	}

	public function crear2() {
		if(!empty($this->data)){
			//$this->log($this->data);
			if($this->data['Liquidar']['tipo'] == 1){
				if($this->data['Liquidar']['telefono'] != ""){
					$this->request->data['Liquidar']['cliente_id'] = $this->data['Liquidar']['telefono'];
				} else {
					if($this->data['Liquidar']['documento'] != ""){
						$this->request->data['Liquidar']['cliente_id'] = $this->data['Liquidar']['documento'];
					}
				}
			} else {
				$this->request->data['Liquidar']['cliente_id'] = 1;
			}
			$this->request->data['Liquidar']['valKilo']     = $this->data['Liquidar']['valKilo'][0];
			$empaqueInfo = array();
			$empaqueInfo['empaques'] = $this->data['Liquidar']['empaques'];
			$empaqueInfo['cantidad'] = $this->data['Liquidar']['cantidad'];
			$empaqueInfo['largo']    = $this->data['Liquidar']['largo'];
			$empaqueInfo['ancho']    = $this->data['Liquidar']['ancho'];
			$empaqueInfo['alto']     = $this->data['Liquidar']['alto'];
			$empaqueInfo['peso']     = $this->data['Liquidar']['peso'];
			$empaqueInfo['pesoVol']  = $this->data['Liquidar']['pesoVol'];
			$empaqueInfo['valor']    = $this->data['Liquidar']['valor'];
			$empaqueInfo['kiloAd']   = $this->data['Liquidar']['kiloAd'];
			$empaqueInfo['subtotal'] = $this->data['Liquidar']['subtotal'];
			$this->request->data['Liquidar']['empaque_info'] = json_encode($empaqueInfo);

			if($this->Liquidar->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'La cotización No. '.$this->Liquidar->id.' ha sido registrada con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La cotización no se puedo guardar.'));
			}
		}
		
		$destinos    = $this->Liquidar->importModel('Destino')->find('list');
		$empaques    = $this->Liquidar->importModel('Empaque')->find('list');
		$clientes    = $this->Liquidar->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1,'Cliente.tipo'=>'Clientes')));
		$firmado     = $this->Liquidar->getEnumValues('firmado');
		$this->set(compact('destinos','empaques','firmado','clientes'));
	}
	public function getTarifa($cliente = null,$origen = null, $destino = null) {
		$this->autoRender = false;
		$this->request->onlyAllow('ajax');
		$tarifas   = array();
		$convenios = array();
		if(!empty($cliente) && !empty($origen) && !empty($destino)){
			$tarifas    = $this->Liquidar->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>$cliente)));
			$convenios  = $this->Liquidar->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>$cliente)));
			if($cliente != 1){
				$tarifasB   = $this->Liquidar->importModel("Tarifa")->find('all',array('recursive'=>-1,'conditions'=>array('Tarifa.origen'=>$origen,'Tarifa.destino'=>$destino,'Tarifa.cliente_id'=>1)));
				$conveniosB = $this->Liquidar->importModel("Descuento")->find('all',array('recursive'=>-1,'conditions'=>array('Descuento.origen'=>$origen,'Descuento.destino'=>$destino,'Descuento.cliente_id'=>1)));
			} else {
				$tarifasB   = $tarifas;
				$conveniosB = $convenios;
			}
		}
		$descu = $this->Liquidar->importModel("Destino")->find('first',array('fields'=>array('Region.descuento'),'conditions'=>array('Destino.id'=>$destino)));
		$data['TarifaBase']   = $tarifasB;
		$data['ConvenioBase'] = $conveniosB;
		$data['Tarifa']       = $tarifas;
		$data['Convenio']     = $convenios;
		$data['Descuento']    = $descu['Region']['descuento'];
		return json_encode($data);
	}

	public function enviarLiquidacion() {
		$decode = json_decode($this->data['dataEmail'], true);
		$correo = $decode[0];
		$msg    = $decode[1];
		$this->autoRender = false;
		$this->request->onlyAllow('ajax');
		
		$envio = $this->sendEmail($correo, $msg, "Envió de cotización - Mandar y Servir S.A.S.");
		return json_encode($envio);
	}

}
?>
