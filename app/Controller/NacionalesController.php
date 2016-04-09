<?php
class NacionalesController extends AppController {
	public $name = 'Nacionales';

		function imprimir($id = null){
		$desti   = $this->Nacional->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
		$empaq   = $this->Nacional->importModel('Empaque')->find('list');
		$reemp   = $this->Nacional->find('first',array('conditions'=>array('Nacional.id'=>$id)));
		$usuario = $this->Nacional->importModel('User')->find('first',array('conditions'=>array('User.id'=>$reemp['Nacional']['usuario'])));
		$negoc   = $this->Nacional->importModel('Auxiliar')->find('first',array('conditions'=>array('Auxiliar.id'=>$reemp['Nacional']['negociador'])));
		$repre   = $this->Nacional->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$reemp['Nacional']['representante'])));
		$venta   = $this->Nacional->importModel('Venta')->find('all',array('fields'=>array('Venta.remesa','Venta.nombreDest','Venta.direccionDest','Venta.telefonoDest','Venta.empaque_info','Venta.destinoNombre'),'conditions'=>array('Venta.id'=>json_decode($reemp['Nacional']['guias'],true))));
		$reemp['Nacional']['destino'] = $desti[$reemp['Nacional']['destino']];
		$reemp['Nacional']['origen']  = $desti[$reemp['Nacional']['origen']];
		$reemp['Nacional']['valor']   = number_format($reemp['Nacional']['valor'], 0, '.', ',');
		
		$usuario = $usuario['User']['listNombre'];
		$valores = json_decode($reemp['Nacional']['valores'],true);
		$cantTotal = 0;
		foreach ($venta as $key => $value) {
			$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
			if(count(array_unique($empaquesInfo['empaques'])) > 1){
				$venta[$key]['Venta']['empaque'] = 'Otros';
			} else {
				$venta[$key]['Venta']['empaque'] = $empaq[$empaquesInfo['empaques'][0]];
			}
			$cant = 0;
			foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
				$cant = $cant + $empaquesInfo['cantidad'][$key2];
			}
			$venta[$key]['Venta']['cantidad'] = $cant;
			$cantTotal = $cantTotal + $cant;
			$venta[$key]['Venta']['valor']    = number_format($valores[$key], 0, '.', ',');
			unset($venta[$key]['Venta']['empaque_info']);
		}

		$this->set(compact('id','repre','reemp','negoc','venta','usuario','cantTotal'));
	}


}
?>
