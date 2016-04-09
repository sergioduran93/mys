<?php
class NovedadesController extends AppController {
	public $name = 'Novedades';

	public function crear() {
		if(!empty($this->data)){
			if($this->data['Novedad']['id'] == ''){
				$this->Novedad->create();
			}
			if($this->Novedad->save($this->data)) {
    			$this->Session->setFlash('','ok',array('mensaje'=>'La Novedad se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar la Novedad. Por favor intente nuevamente'));
			}		
		}
		$novedades = $this->Novedad->find('all');
		$tipo      = $this->Novedad->getEnumValues('tipo');
		$max       = $this->Novedad->find('count');
		$max       = $max + 1;
		$this->generateJSON('novedades', $novedades, array('Novedad' => array('id','codigo','tipo','novedad')));
		$this->set(compact('novedades','max','tipo'));
	}


}
?>
