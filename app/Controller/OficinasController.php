<?php
class OficinasController extends AppController {
	public $name = 'Oficinas';

	public function crear() {
		if(!empty($this->data)){
			$this->request->data['Oficina']['destinos'] = json_encode($this->data['Oficina']['destinos']);

			if($this->data['Oficina']['id'] == ''){
				$this->Oficina->create();
				$this->request->data['Oficina']['consecutivo'] = 0;
			}
			if($this->Oficina->save($this->data)) {
				$this->Oficina->importModel('Recaudo')->deleteAll(array('Recaudo.oficina'=>$this->Oficina->id));
				
                foreach ($this->data['Oficina']['recaudos'] as $key => $value) {
					$recaNuevo['Recaudo']['id']      = '';
					$recaNuevo['Recaudo']['oficina'] = $this->Oficina->id;
					$recaNuevo['Recaudo']['destino'] = $value;
					$this->Oficina->importModel('Recaudo')->save($recaNuevo);
                }
				//$this->Oficina->importModel('Recaudo')->saveAll();
    			$this->Session->setFlash('','ok',array('mensaje'=>'El Oficina se guardo con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'No se ha podido guardar el Oficina. Por favor intente nuevamente'));
			}
		}
		$oficinas    = $this->Oficina->find('all',array('recursive'=>0));
		$destinos    = $this->Oficina->importModel('Destino')->find('list');
		$recaudos    = $this->Oficina->importModel('Recaudo')->find('list',array('fields'=>array('Recaudo.destino','Recaudo.oficina')));
		if(count($recaudos) > 1){
			$destCon = array_keys($recaudos);
		} else {
			$aux     = array_keys($recaudos);
			$destCon = $recaudos[$aux[0]];
		}
		
		$destRecauda = $this->Oficina->importModel('Destino')->find('list',array('conditions'=>array('Destino.id !='=>$destCon)));

		foreach ($oficinas as $key => $value) {
			$oficinas[$key]['Oficina']['destinos']  = json_decode($oficinas[$key]['Oficina']['destinos'],true);
			$oficinas[$key]['Oficina']['ciudad']    = $destinos[$oficinas[$key]['Oficina']['destinos'][0]];
		}
		$this->generateJSON('oficinas', $oficinas, array('Oficina' => array('id','nit','codigo','prefijo','nombre','ciudad','telefono','ext','direccion')));

		$barras   = $this->Oficina->getEnumValues('barras');
		$imprimir = $this->Oficina->getEnumValues('imprimir');
		$this->set(compact('recaudos','destRecauda','oficinas','destinos','barras','imprimir'));

	}


}
?>
