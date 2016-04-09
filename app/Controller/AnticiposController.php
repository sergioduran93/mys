<?php
class AnticiposController extends AppController {
	public $name = 'Anticipos';

	public function crear() {
		$fechaActual = date("Y-m-d");
		$fechaUnMesA = date("Y-m-d").' 23:59:59';
		//$fechaUnMesA = date('Y-m-d', strtotime('-1 month'));
		$user = $this->Auth->user();
		if($this->data['Anticipo']['oficina'] != '-1'){
			$anticipos = $this->Anticipo->find('all',array('recursive'=>0,'conditions'=>array('oficina'=>$user['oficina_id'],'fecha BETWEEN ? AND ?'=>array($fechaActual,$fechaUnMesA))));
		} else {
			$anticipos = $this->Anticipo->find('all',array('recursive'=>0,'conditions'=>array('fecha BETWEEN ? AND ?'=>array($fechaActual,$fechaUnMesA))));
		}
		$num = $this->Anticipo->find('count',array('conditions'=>array('oficina'=>$user['oficina_id'],'fecha BETWEEN ? AND ?'=>array($fechaActual,$fechaActual.' 23:59:59'))));
		$num = $num + 1;
		if(!empty($this->data['Anticipo']['valor'])){
		//	if($this->data['Anticipo']['inicio'] != '' && $this->data['Anticipo']['final'] != ''){
		//		$anticipos = $this->Anticipo->find('all',array('recursive'=>0,'conditions'=>array('fecha BETWEEN ? AND ?'=>array($this->data['Anticipo']['inicio'],$this->data['Anticipo']['final'].' 23:59:59'))));
		//	} else {
				$this->request->data['Anticipo']['hora']         = $this->data['Anticipo']['hora'].':'.$this->data['Anticipo']['min'].' '.$this->data['Anticipo']['m'];
				$this->request->data['Anticipo']['realizo']      = $user['name'];
				$this->request->data['Anticipo']['fecha_digito'] = date("Y-m-d");
				$this->request->data['Anticipo']['hora_digito']  = date("H:i:s");
				$this->request->data['Anticipo']['user_id']      = $user['id'];
				if($this->data['Anticipo']['id'] == ''){
					$this->Anticipo->create();
				}
				if($this->Anticipo->save($this->data)) {
	    			$this->Session->setFlash('','ok',array('mensaje'=>'El Anticipo se guardo con exito'));
				} else {
	    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el Anticipo. Por favor intente nuevamente'));
				}
		//	}
		}
		$this->data = null;
		$oficinas = $this->Anticipo->importModel('Oficina')->find('list');
		
		$oficinas['-1'] = "Todas las oficinas";
		$this->generateJSON('anticipos', $anticipos, array('Anticipo' => array('id','oficina','retiro_no','fecha','hora','valor','transaccion','realizo','fecha_digito','hora_digito')));
		$this->set(compact('num','anticipos','oficinas','fechaActual','fechaUnMesA'));
	}

	public function crea() {
		$fechaActual = date("Y-m-d");
		$fechaUnMesA = date('Y-m-d', strtotime('-1 month'));
		$user = $this->Auth->user();
		$anticipos = $this->Anticipo->find('all',array('recursive'=>0,'conditions'=>array('Anticipo.user_id'=>$user['id'],'fecha BETWEEN ? AND ?'=>array($fechaUnMesA,$fechaActual))));
		if(!empty($this->data)){
			if($this->data['Anticipo']['inicio'] != '' && $this->data['Anticipo']['final'] != ''){
				$anticipos = $this->Anticipo->find('all',array('recursive'=>0,'conditions'=>array('fecha BETWEEN ? AND ?'=>array($this->data['Anticipo']['inicio'],$this->data['Anticipo']['final']))));
			} else {
				$this->request->data['Anticipo']['hora']         = $this->data['Anticipo']['hora'].':'.$this->data['Anticipo']['min'].' '.$this->data['Anticipo']['m'];
				$this->request->data['Anticipo']['realizo']      = $user['name'];
				$this->request->data['Anticipo']['fecha_digito'] = date("Y-m-d");
				$this->request->data['Anticipo']['hora_digito']  = date("H:i:s");
				$this->request->data['Anticipo']['user_id']      = $user['id'];
				if($this->data['Anticipo']['id'] == ''){
					$this->Anticipo->create();
				}
				if($this->Anticipo->save($this->data)) {
	    			$this->Session->setFlash('','ok',array('mensaje'=>'El Anticipo se guardo con exito'));
				} else {
	    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el Anticipo. Por favor intente nuevamente'));
				}
			}
		}
		$oficinas = $this->Anticipo->importModel('Oficina')->find('list');
		$this->generateJSON('anticipos', $anticipos, array('Anticipo' => array('id','oficina','retiro_no','fecha','hora','valor','transaccion','realizo','fecha_digito','hora_digito')));
		$this->set(compact('anticipos','oficinas','fechaActual','fechaUnMesA'));
	}
}
?>
