<?php
class PlanillasController extends AppController {
	public $name = 'Planillas';

	public function actualizar() {
		if(!empty($this->data)){

			$this->Planilla->create();			
			if($this->Planilla->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'La planilla se actualizo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido actualizar la planilla. Por favor intente nuevamente'));
			}
		}
		
		$tipo  = $this->Planilla->getEnumValues('tipo');
		$representantes = $this->Planilla->importModel("Representante")->find('list',array('fields'=>array('Representante.codigo')));
		$vehiculos = $this->Planilla->importModel("Vehiculo")->find('list');
		$planillas = $this->Planilla->find('all');
		$this->generateJSON('planillas', $planillas, array('Planilla' => array('id','fecha','tipo','codigo','identificacion','valor','concepto')));

		$this->set(compact('tipo','representantes','planillas','vehiculos'));
	}

}
?>
