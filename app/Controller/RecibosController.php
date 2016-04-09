<?php
class RecibosController extends AppController {
	public $name = 'Recibos';

	public function juridica() {
		if(!empty($this->data)){
			if($this->data['Recibo']['id'] == ''){
				$this->Recibo->create();
			}
			$this->request->data['Recibo']['fecha'] = date("Y-m-d H:i:s");
			if($this->Recibo->save($this->data)) {
				$this->Recibo->importModel('Venta')->updateAll(array('Venta.despachada'=>"'Despachada'",'Venta.tipo_despacho'=>"'Juridica'"),array('Venta.id'=>$this->data['Recibo']['guia_id']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'La actualización del recibo se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La actualización del recibo no se pudo guardar. Por favor intente nuevamente'));
			}
		}
		$user            = $this->Auth->user();
		$recibos         = $this->Recibo->find('all',array('recursive'=>-1));
		$ventas          = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1,'conditions'=>array('Venta.lista'=>1,'Venta.despachada'=>$user['oficina_id'])));
		//$ventas          = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1));
		$destinos        = $this->Recibo->importModel('Destino')->find('list');
		$empaques        = $this->Recibo->importModel('Empaque')->find('list');
		$transportadoras = $this->Recibo->importModel('Transportadora')->find('all',array('recursive'=>-1,'fields'=>array('Transportadora.nit','Transportadora.razon','Transportadora.credito')));
		$negociadores    = $this->Recibo->importModel('Auxiliar')->find('all',array('recursive'=>-1,'fields'=>array('Auxiliar.documento','Auxiliar.nombre'),'conditions'=>array('Auxiliar.negociar'=>'Si')));
		$empaques        = $this->Recibo->importModel('Empaque')->find('list');
		$forma           = $this->Recibo->getEnumValues('forma_pago');
		$ventasL         = array();

		foreach ($ventas as $key => $value) {
			$ventas[$key]['Venta']['origen']  = $destinos[$value['Venta']['origen']];
			$ventas[$key]['Venta']['destino'] = $destinos[$value['Venta']['destino']];
			$empa                             = json_decode($value['Venta']['empaque_info'],true);
			$html                             = '<div class="bs-callout bs-callout-warning"><h4 style="font-weight:bold;font-size:160%;color:rgb(224, 135, 64);">Mercancia</h4><table class="table"><thead><tr><th>Empaque</th><th>Cantidad</th><th>Largo</th><th>Ancho</th><th>Alto</th><th>Peso</th><th>Peso Vol</th></tr></thead><tbody>';
			foreach ($empa['empaques'] as $key2 => $value2) {
				$html = $html.'<tr><td>'.$empaques[$value2].'</td><td>'.$empa["cantidad"][$key2].'</td><td>'.$empa["largo"][$key2].'</td><td>'.$empa["ancho"][$key2].'</td><td>'.$empa["alto"][$key2].'</td><td>'.$empa["peso"][$key2].'</td><td>'.$empa["pesoVol"][$key2].'</td></tr>';
			}
			$ventas[$key]['Venta']['html']  = $html.'</tboby></table></div>';
			$ventasL[$value['Venta']['id']] = 'Remesa:'.str_replace('-','',$value['Venta']['remesa'])." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
		}
		$reciboG = array();
		foreach ($recibos as $key => $value) {
			$reciboG[$value['Recibo']['guia_id']] = $value;
		}
		$this->set(compact('destinos','reciboG','ventasL','ventas','transportadoras','negociadores','forma'));
	}

	public function natural() {
		$fecha = date("Y-m-d H:i:s");
		if(!empty($this->data)){
			if($this->data['Recibo']['id'] == ''){
				$this->Recibo->create();
			}
			$this->request->data['Recibo']['fecha'] = $fecha;
			if($this->Recibo->save($this->data)) {
				$this->Recibo->importModel('Venta')->updateAll(array('Venta.despachada'=>"'Despachada'",'Venta.tipo_despacho'=>"'Natural'"),array('Venta.id'=>$this->data['Recibo']['guia_id']));
    			$this->Session->setFlash('','ok',array('mensaje'=>'La actualización del recibo se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La actualización del recibo no se pudo guardar. Por favor intente nuevamente'));
			}
		}
		$this->data  = null;
		$user         = $this->Auth->user();
		$recibos     = $this->Recibo->find('all',array('recursive'=>-1));
		$ventas      = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1,'conditions'=>array('Venta.lista'=>1,'Venta.despachada'=>$user['oficina_id'])));
		//$ventas    = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1));
		$destinos    = $this->Recibo->importModel('Destino')->find('list');
		$empaques    = $this->Recibo->importModel('Empaque')->find('list');
		$vehiculos   = $this->Recibo->importModel('Vehiculo')->find('list');
		$vehiculos   = array_values($vehiculos);
		$conductores = $this->Recibo->importModel('Conductor')->find('all',array('recursive'=>-1,'fields'=>array('Conductor.identificacion','Conductor.listNombre'),'conditions'=>array('Conductor.conductor2'=>'1')));
		$empaques    = $this->Recibo->importModel('Empaque')->find('list');
		$forma       = $this->Recibo->getEnumValues('forma_pago');
		$ventasL     = array();

		foreach ($ventas as $key => $value) {
			$ventas[$key]['Venta']['origen']  = $destinos[$value['Venta']['origen']];
			$ventas[$key]['Venta']['destino'] = $destinos[$value['Venta']['destino']];
			$empa                             = json_decode($value['Venta']['empaque_info'],true);
			$html                             = '<div class="bs-callout bs-callout-warning"><h4 style="font-weight:bold;font-size:160%;color:rgb(224, 135, 64);">Mercancia</h4><table class="table"><thead><tr><th>Empaque</th><th>Cantidad</th><th>Largo</th><th>Ancho</th><th>Alto</th><th>Peso</th><th>Peso Vol</th></tr></thead><tbody>';
			foreach ($empa['empaques'] as $key2 => $value2) {
				$html = $html.'<tr><td>'.$empaques[$value2].'</td><td>'.$empa["cantidad"][$key2].'</td><td>'.$empa["largo"][$key2].'</td><td>'.$empa["ancho"][$key2].'</td><td>'.$empa["alto"][$key2].'</td><td>'.$empa["peso"][$key2].'</td><td>'.$empa["pesoVol"][$key2].'</td></tr>';
			}
			$ventas[$key]['Venta']['html']  = $html.'</tboby></table></div>';
			$ventasL[$value['Venta']['id']] = 'Remesa:'.str_replace('-','',$value['Venta']['remesa'])." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
		}
		$reciboG = array();
		foreach ($recibos as $key => $value) {
			$reciboG[$value['Recibo']['guia_id']] = $value;
		}
		$this->set(compact('destinos','fecha','reciboG','ventasL','ventas','vehiculos','conductores','forma'));
	}

	public function juridicarepre() {
		$fecha = date("Y-m-d H:i:s");
		if(!empty($this->data)){
			if($this->data['Recibo']['id'] == ''){
				$this->Recibo->create();
			}
			$this->request->data['Recibo']['fecha'] = $fecha;
			if($this->Recibo->save($this->data)) {
				$this->Recibo->importModel('Venta')->updateAll(array('Venta.despachada'=>"'DespachadaRepre'",'Venta.tipo_despacho'=>"'Juridica'"),array('Venta.id'=>$this->data['Recibo']['guia_id']));
				$this->Session->setFlash('','ok',array('mensaje'=>'La actualización del recibo se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La actualización del recibo no se pudo guardar. Por favor intente nuevamente'));
			}
		}
		$user         = $this->Auth->user();
		$recibos         = $this->Recibo->find('all',array('recursive'=>-1));
		$ventas          = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1,'conditions'=>array('Venta.despachada'=>$user['oficina_id'])));
		//$ventas        = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1));
		$destinos        = $this->Recibo->importModel('Destino')->find('list');
		$empaques        = $this->Recibo->importModel('Empaque')->find('list');
		$transportadoras = $this->Recibo->importModel('Transportadora')->find('all',array('recursive'=>-1,'fields'=>array('Transportadora.nit','Transportadora.razon','Transportadora.credito')));
		$representantesD = $this->Recibo->importModel('Representante')->find('list',array('recursive'=>-1,'fields'=>array('Representante.identificacion')));
		$representantesN = $this->Recibo->importModel('Representante')->find('list');
		$empaques        = $this->Recibo->importModel('Empaque')->find('list');
		$forma           = $this->Recibo->getEnumValues('forma_pago');
		$ventasL         = array();

		foreach ($ventas as $key => $value) {
			$ventas[$key]['Venta']['origen']  = $destinos[$value['Venta']['origen']];
			$ventas[$key]['Venta']['destino'] = $destinos[$value['Venta']['destino']];
			$empa                             = json_decode($value['Venta']['empaque_info'],true);
			$html                             = '<div class="bs-callout bs-callout-warning"><h4 style="font-weight:bold;font-size:160%;color:rgb(224, 135, 64);">Mercancia</h4><table class="table"><thead><tr><th>Empaque</th><th>Cantidad</th><th>Largo</th><th>Ancho</th><th>Alto</th><th>Peso</th><th>Peso Vol</th></tr></thead><tbody>';
			foreach ($empa['empaques'] as $key2 => $value2) {
				$html = $html.'<tr><td>'.$empaques[$value2].'</td><td>'.$empa["cantidad"][$key2].'</td><td>'.$empa["largo"][$key2].'</td><td>'.$empa["ancho"][$key2].'</td><td>'.$empa["alto"][$key2].'</td><td>'.$empa["peso"][$key2].'</td><td>'.$empa["pesoVol"][$key2].'</td></tr>';
			}
			$ventas[$key]['Venta']['html']  = $html.'</tboby></table></div>';
			$ventasL[$value['Venta']['id']] = 'Remesa:'.str_replace('-','',$value['Venta']['remesa'])." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
		}
		$reciboG = array();
		foreach ($recibos as $key => $value) {
			$reciboG[$value['Recibo']['guia_id']] = $value;
		}
		$this->set(compact('destinos','fecha','reciboG','ventasL','ventas','transportadoras','representantesD','representantesN','forma'));
	}

	public function naturalrepre() {
		$fecha = date("Y-m-d H:i:s");
		if(!empty($this->data)){
			if($this->data['Recibo']['id'] == ''){
				$this->Recibo->create();
			}
			$this->request->data['Recibo']['fecha'] = $fecha;
			if($this->Recibo->save($this->data)) {
				$this->Recibo->importModel('Venta')->updateAll(array('Venta.despachada'=>"'DespachadaRepre'",'Venta.tipo_despacho'=>"'Natural'"),array('Venta.id'=>$this->data['Recibo']['guia_id']));
				$this->Session->setFlash('','ok',array('mensaje'=>'La actualización del recibo se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La actualización del recibo no se pudo guardar. Por favor intente nuevamente'));
			}
		}
		$user        = $this->Auth->user();
		$recibos     = $this->Recibo->find('all',array('recursive'=>-1));
		$ventas      = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1,'conditions'=>array('Venta.despachada'=>$user['oficina_id'],'Venta.usuario'=>$user['id'])));
		//$ventas    = $this->Recibo->importModel('Venta')->find('all',array('recursive'=>-1));
		$destinos    = $this->Recibo->importModel('Destino')->find('list');
		$empaques    = $this->Recibo->importModel('Empaque')->find('list');
		$vehiculos   = $this->Recibo->importModel('Vehiculo')->find('list');
		$vehiculos   = array_values($vehiculos);
		$conductores = $this->Recibo->importModel('Conductor')->find('all',array('recursive'=>-1,'fields'=>array('Conductor.identificacion','Conductor.listNombre'),'conditions'=>array('Conductor.conductor2'=>'1')));
		$empaques    = $this->Recibo->importModel('Empaque')->find('list');
		$forma       = $this->Recibo->getEnumValues('forma_pago');
		$ventasL     = array();

		foreach ($ventas as $key => $value) {
			$ventas[$key]['Venta']['origen']  = $destinos[$value['Venta']['origen']];
			$ventas[$key]['Venta']['destino'] = $destinos[$value['Venta']['destino']];
			$empa                             = json_decode($value['Venta']['empaque_info'],true);
			$html                             = '<div class="bs-callout bs-callout-warning"><h4 style="font-weight:bold;font-size:160%;color:rgb(224, 135, 64);">Mercancia</h4><table class="table"><thead><tr><th>Empaque</th><th>Cantidad</th><th>Largo</th><th>Ancho</th><th>Alto</th><th>Peso</th><th>Peso Vol</th></tr></thead><tbody>';
			foreach ($empa['empaques'] as $key2 => $value2) {
				$html = $html.'<tr><td>'.$empaques[$value2].'</td><td>'.$empa["cantidad"][$key2].'</td><td>'.$empa["largo"][$key2].'</td><td>'.$empa["ancho"][$key2].'</td><td>'.$empa["alto"][$key2].'</td><td>'.$empa["peso"][$key2].'</td><td>'.$empa["pesoVol"][$key2].'</td></tr>';
			}
			$ventas[$key]['Venta']['html']  = $html.'</tboby></table></div>';
			$ventasL[$value['Venta']['id']] = 'Remesa:'.str_replace('-','',$value['Venta']['remesa'])." || ".$destinos[$value['Venta']['destino']]." || ".$value['Venta']['nombreDest'];
		}
		$reciboG = array();
		foreach ($recibos as $key => $value) {
			$reciboG[$value['Recibo']['guia_id']] = $value;
		}
		$this->set(compact('destinos','fecha','reciboG','ventasL','ventas','vehiculos','conductores','forma'));
	}

}
?>
