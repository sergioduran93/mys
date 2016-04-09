<?php
class AuxiliaresController extends AppController {
	public $name = 'Auxiliares';

	public function crear() {
		if(!empty($this->data)){
			if($this->data['Auxiliar']['id'] == ''){
				$this->Auxiliar->create();
			}
			if($this->Auxiliar->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'El Auxiliar se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el Auxiliar. Por favor intente nuevamente'));
			}		
		}
		$auxiliares = $this->Auxiliar->find('all');
		$oficinas   = $this->Auxiliar->importModel('Oficina')->find('list');
		$negociar   = $this->Auxiliar->getEnumValues('negociar');
		$this->generateJSON('auxiliares', $auxiliares, array('Auxiliar' => array('id','documento','nombre','oficina','negociar')));
		$this->set(compact('auxiliares','negociar','oficinas'));
	}


}
?>
