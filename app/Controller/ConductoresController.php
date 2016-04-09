<?php
class ConductoresController extends AppController {
	public $name = 'Conductores';

	public function crear() {
		$role = $this->data['Conductor']['role'];
		if(!empty($this->data) && $role != 5 && $role != 6){
			$this->request->data['Conductor']['fecha'] = date('Y-m-d',strtotime($this->data['Conductor']['fecha']));
			if($this->data['Conductor']['id'] != '') {
				$this->Conductor->create();
			}
			if($this->Conductor->save($this->data)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'Conductor/Propietario/Tenedor guardado con éxito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'Error al guardar. Intente nuevamente'));
			}
		}
		$this->data = null;
		$tipoPersona = $this->Conductor->getEnumValues('tipoP');
		$tipo_doc    = $this->Conductor->getEnumValues('tipo_doc');
		$destinos    = $this->Conductor->importModel('Destino')->find('list');
		$conductores = $this->Conductor->find('all',array('recursive'=>-1));
		foreach ($conductores as $key => $value) {
			$conductores[$key]['Conductor']['ciudad2'] = $destinos[$conductores[$key]['Conductor']['ciudad']];
			$tipo = array();
			if(!empty($conductores[$key]['Conductor']['conductor2'])){
				$tipo[] = 'Conductor';
			}
			if(!empty($conductores[$key]['Conductor']['propietario'])){
				$tipo[] = 'Propietario';
			}
			if(!empty($conductores[$key]['Conductor']['tenedor'])){
				$tipo[] = 'Tenedor';
			}
			$conductores[$key]['Conductor']['tipo'] = implode('/', $tipo);
		}
		$this->generateJSON('conductores', $conductores, array('Conductor' => array('id','identificacion','listNombre','telefono','celular','ciudad2','tipo')));
		$this->set(compact('tipoPersona','tipo_doc','destinos','conductores'));
	}

	public function eliminar($id = null) {
		if($this->Conductor->delete($id)){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'El conductor se elimino con exito'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'El conductor no se pudo eliminar'));
		}
    	$this->redirect(array('action' => 'crear'));
	}
}
?>
