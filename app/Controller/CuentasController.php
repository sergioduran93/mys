<?php
class CuentasController extends AppController {
	public $name = 'Cuentas';

	public function crear() {
		if(!empty($this->data)){
			if($this->Cuenta->save($this->data)){
	   			$this->Session->setFlash('','ok',array('mensaje'=>'La cuenta se guardo con exito'));
			} else {
		   		$this->Session->setFlash('','error',array('mensaje'=>'La cuenta no se pudo guardar'));
			}
		}
		$this->data = null;
		$cuentas = $this->Cuenta->find('all');
		$this->generateJSON('cuentas', $cuentas, array('Cuenta' => array('id','numero','concepto','naturaleza')));
	}

	public function eliminar($id = null) {
		if($this->Cuenta->delete($id)){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'La cuenta se elimino con exito'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'La cuenta no se pudo eliminar'));
		}
    	$this->redirect(array('action' => 'crear'));
	}
}
?>
