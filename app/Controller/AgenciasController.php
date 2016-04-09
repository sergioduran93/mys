<?php
class AgenciasController extends AppController {
	public $name = 'Agencias';

	public function admin_crear() {
		$this->crear();
		$this->render('crear');
	}

	public function crear() {
		if(!empty($this->data)){
			if($this->data['Agencia']['id'] == ''){
				$this->Agencia->create();
				$this->Session->setFlash('','ok',array('mensaje'=>'La agencia se creo con exito'));
			} else {
    			$this->Session->setFlash('','ok',array('mensaje'=>'La agencia se edito con exito'));
			}
			if(!$this->Agencia->save($this->data)){
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la agencia. Por favor intente nuevamente'));
			}
		}

		$destinos = $this->Agencia->importModel('Destino')->find('list');
		$agencias = $this->Agencia->find('all');
		foreach ($agencias as $key => $value) {
			$agencias[$key]['Agencia']['municipio'] = $destinos[$value['Agencia']['destino']];
		}
		$agenciasJson = json_encode($agencias);

		$this->generateJSON('agencias', $agencias, array('Agencia' => array('id','municipio','contacto','telefono1','telefono2','celular')));
		$this->set(compact('agencias','agenciasJson','destinos'));
	}


}
?>
