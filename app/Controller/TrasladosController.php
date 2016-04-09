<?php
class TrasladosController extends AppController {
	public $name = 'Traslados';

	function imprimir($id = null){
		$desti    = $this->Traslado->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
		$empaq    = $this->Traslado->importModel('Empaque')->find('list');
		$despa    = $this->Traslado->find('first',array('conditions'=>array('Traslado.id'=>$id)));
		$usuario  = $this->Traslado->importModel('User')->find('first',array('conditions'=>array('User.id'=>$despa['Traslado']['usuario'])));
		$negoc    = $this->Traslado->importModel('Auxiliar')->find('first',array('conditions'=>array('Auxiliar.id'=>$despa['Traslado']['negociador'])));
		$vehiculo = $this->Traslado->importModel('Vehiculo')->find('first',array('conditions'=>array('Vehiculo.id'=>$despa['Traslado']['placa'])));
		$venta    = $this->Traslado->importModel('Venta')->find('all',array('fields'=>array('Venta.remesa','Venta.nombreDest','Venta.direccionDest','Venta.telefonoDest','Venta.empaque_info','Venta.destinoNombre'),'conditions'=>array('Venta.id'=>json_decode($despa['Traslado']['guias'],true))));
		$despa['Traslado']['destino'] = $desti[$despa['Traslado']['destino']];
		$despa['Traslado']['origen']  = $desti[$despa['Traslado']['origen']];
		$despa['Traslado']['valor']   = number_format($despa['Traslado']['valor'], 0, '.', ',');
		
		$usuario   = $usuario['User']['listNombre'];
		$valores   = json_decode($despa['Traslado']['valores'],true);
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

		$this->set(compact('id','vehiculo','despa','negoc','venta','usuario','cantTotal'));
	}


}
?>
