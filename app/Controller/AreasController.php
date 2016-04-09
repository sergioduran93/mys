<?php
class AreasController extends AppController {
	public $name = 'Areas';

	public function crear() {
		if(!empty($this->data)){
			if($this->data['Area']['id'] == ''){
				$this->Area->create();
			}
			$this->request->data['Area']['destinos'] = json_encode($this->data['Area']['destinos']);
			if($this->Area->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'La Area se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la Area. Por favor intente nuevamente'));
			}
		}
		$areas    = $this->Area->find('all');
		$destinos = $this->Area->importModel('Destino')->find('list');
		foreach ($areas as $key => $value) {
			$areas[$key]['Area']['destinos'] = json_decode($value['Area']['destinos'],true);
		}
		$this->generateJSON('areas', $areas, array('Area' => array('id','codigo','nombre')));
		$this->set(compact('destinos','areas'));
	}

	public function eliminar($id = null) {
		if($this->Area->delete($id)){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'El area se elimino con exito'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'El area no se pudo eliminar'));
		}
    	$this->redirect(array('action' => 'crear'));
	}
}
?>
