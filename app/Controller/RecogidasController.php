<?php
class RecogidasController extends AppController {
	public $name = 'Recogidas';

	public function listar($orden = 1) {
		$clientes    = $this->Recogida->importModel('Cliente')->find('all',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$clientesC   = $this->Recogida->importModel('Cliente')->find('list',array('recursive'=>-1,'fields'=>array('Cliente.contacto')));
		$remitenteN  = $this->Recogida->importModel('Remitente')->find('all',array('recursive'=>-1));
		$remitenteC  = $this->Recogida->importModel('Remitente')->find('list',array('recursive'=>-1,'fields'=>array('Remitente.contacto')));
		$remitentes  = array();
		foreach ($remitenteN as $key => $value) {
			$remitentes[$value['Remitente']['id']] = $value;
		}
		$destinos    = $this->Recogida->importModel('Destino')->find('list');
		$novedades   = $this->Recogida->importModel('Novedad')->find('list',array('conditions'=>array('Novedad.tipo'=>'Recogida')));
		$fechaActual = date("Y-m-d");
		$fechaUnMesA = date('Y-m-d', strtotime('-1 month'));
		if(!empty($this->data)){
			$user = $this->Auth->user();
			$this->request->data['Recogida']['usuario_registra']  = $user['name'].' '.$user['lastname'];
		//	$this->request->data['Recogida']['ciudad'] = $destinos[$this->data['Recogida']['ciudad']];
			$this->request->data['Recogida']['estado'] = 'Registrada';
			if($this->Recogida->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'La recogida se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la recogida. Por favor intente nuevamente'));
			}
		}
		$horaActual = date('h:i A');
		foreach ($clientes as $key => $value) {
			$clientes[$key]['Cliente']['remitentes'] = json_decode($value['Cliente']['remitentes'],true);
		}
		$vehiculos   = $this->Recogida->importModel('Vehiculo')->find('all',array('recursive'=>-1));
		$conductores = $this->Recogida->importModel('Conductor')->find('all',array('recursive'=>-1,'conditions'=>array('Conductor.conductor2'=>1)));
		$recogidasRegistradas = array();
		$recogidasAsignadas   = array();
		$recogidasAnuladas    = array();
		$recogidas = $this->Recogida->find('all',array('recursive'=>-1));
		foreach ($recogidas as $key => $value) {
			if($value['Recogida']['estado'] == 'Registrada'){
				$recogidasRegistradas[]['Recogida'] = $value['Recogida'];
			} else if($value['Recogida']['estado'] == 'Asignada'){
				$recogidasAsignadas[]['Recogida'] = $value['Recogida'];
			} else {
				$recogidasAnuladas[]['Recogida']  = $value['Recogida'];
			}
		}
		
		$this->generateJSON('conductores'         , $conductores, array('Conductor' => array('id','identificacion','listNombre','ciudad','telefono','celular','direccion')));
		$this->generateJSON('vehiculos'           , $vehiculos, array('Vehiculo' => array('id','placa','tipo','marca','modelo','numero_motor','numero_chasis')));
		$this->generateJSON('clientes'            , $clientes, array('Cliente' => array('id','documento','listNombre','telefono','telefono2','direccion','celular')));
		$this->generateJSON('recogidasRegistradas', $recogidasRegistradas, array('Recogida' => array('id','hora','fecha','direccion','clienteNom','cantidad','preguntar','telefono')));
		$this->generateJSON('recogidasAsignadas'  , $recogidasAsignadas, array('Recogida' => array('id','hora','fecha','direccion','clienteNom','cantidad','preguntar','telefono')));
		$this->generateJSON('recogidasAnuladas'   , $recogidasAnuladas, array('Recogida' => array('id','hora','fecha','direccion','clienteNom','cantidad','preguntar','telefono')));
		$this->set(compact('orden','recogidasRegistradas','recogidasAsignadas','recogidasAnuladas','destinos','horaActual','fechaActual','fechaUnMesA','clientes','clientesC','remitentes','remitenteC','vehiculos','conductores','novedades'));
	}

	public function listar2() {
		if(!empty($this->data)){
			$user = $this->Auth->user();
			$recogida = $this->Recogida->find('first',array('recursive'=>-1,'conditions'=>array('Recogida.id'=>$this->data['Recogida']['id3'])));
			$recogida['Recogida']['estado']           = 'Asignada';
			$recogida['Recogida']['observaciones2']   = $this->data['Recogida']['observaciones2'];
			$recogida['Recogida']['placa']            = $this->data['Recogida']['placa'];
			$recogida['Recogida']['conductor_nombre'] = $this->data['Recogida']['conductor_nombre'];
			$recogida['Recogida']['conductor_id']     = $this->data['Recogida']['conductor_id'];
			$recogida['Recogida']['hora_asig']        = $this->data['Recogida']['hora_asig'];
			$recogida['Recogida']['usuario_asigna']   = $user['name'].' '.$user['lastname'];
			$this->Recogida->save($recogida);
    		$this->Session->setFlash('','ok',array('mensaje'=>'La recogida se asigno con exito'));
		}
		$this->redirect(array('action' => 'listar'));
	}

	public function listar3() {
		if(!empty($this->data)){
			$user     = $this->Auth->user();
			$recogida = $this->Recogida->find('first',array('recursive'=>-1,'conditions'=>array('Recogida.id'=>$this->data['Recogida']['id2'])));
			$recogida['Recogida']['usuario_anula'] = $user['name'].' '.$user['lastname'];
			$recogida['Recogida']['anulo']         = $this->data['Recogida']['anulo'];
			$recogida['Recogida']['estado']        = 'Anulada';
			$this->Recogida->save($recogida);
    		$this->Session->setFlash('','ok',array('mensaje'=>'La recogida se anulo con exito'));
		}
		$this->redirect(array('action' => 'listar'));
	}


	public function eliminar($id = null) {
		if($this->Recogida->delete($id)){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'La Recogida se elimino con exito'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'La Recogida no se pudo eliminar'));
		}
    	$this->redirect(array('action' => 'listar'));
	}

	public function desasignar($id = null) {
		$this->Recogida->read(null, $id);
		$this->Recogida->set(array('estado' => 'Registrada'));
		if($this->Recogida->save()){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'La Recogida se desasigno con exito.'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'La Recogida no se pudo desasignar.'));
		}
    	$this->redirect(array('action' => 'listar'));
	}

}
?>
