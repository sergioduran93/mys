<?php
class DepartamentosController extends AppController {
	public $name = 'Departamentos';

	public function excelDescargar() {
		$this->excel();
	}

	public function excelVer() {
		$this->excel("Ver");
	}

	public function excel($preview = null) {
		$destinos = $this->Departamento->Destino->find('all',array('fields'=>array('Destino.codigo','Destino.nombre','Region.codigo','Region.nombre','Departamento.codigo','Departamento.nombre')));
		Configure::write('debug', 0);
    	$this->ExcelWrite->destinos($destinos,$preview);
		$this->redirect(array('action' => 'listar'));
	}


	public function index() {		
			$departamentos = $this->Departamento->find('all');
			$regiones = $this->Departamento->Region->find('all'); 
			$destinos = $this->Departamento->Destino->find('all'); 


			foreach ($regiones as $key=>$value){
				$regiones[$key]['Region']['departamento']    = $regiones[$key]['Departamento']['nombre'];
			}
			foreach ($destinos as $key=>$value){
				$destinos[$key]['Destino']['departamento']   = $destinos[$key]['Departamento']['nombre'];
				$destinos[$key]['Destino']['region']         = $destinos[$key]['Region']['nombre'];
			}
			$empaques = $this->Departamento->importModel('Empaque')->find('all');
			$mercancias = $this->Departamento->importModel('Mercancia')->find('all');
			$this->set(compact('departamentos','regiones', 'destinos','empaques','mercancias'));
		
    	
	}

	public function editaDep() {
		$this->Session->setFlash('','error',array('mensaje'=>'Falta programar'));
		$this->redirect(array('action' => 'listar'));
	}

	public function registra() {
		//$this->request->data['Departamento']['nombre'] = strtoupper($this->data['Departamento']['nombre']);
		if($this->data['Departamento']['accion'] == 'dep'){
			$this->crearDepartamento();
		} elseif ($this->data['Departamento']['accion'] == 'reg'){
			$this->request->data['Region'] = $this->data['Departamento'];
			$this->crearRegion(2);
		} elseif ($this->data['Departamento']['accion'] == 'emp'){
			$this->request->data['Empaque'] = $this->data['Departamento'];
			$this->crearEmpaque(4);
		} elseif ($this->data['Departamento']['accion'] == 'mer'){
			$this->request->data['Mercancia'] = $this->data['Departamento'];
			$this->crearMercancia(5);
		} elseif ($this->data['Departamento']['accion'] == 'des'){
			$this->request->data['Destino'] = $this->data['Departamento'];
			$this->crearDestino(3);
		}
		$this->redirect(array('action' => 'listar'));
	}

	public function listar($accion = 1) {
		$departamentos = $this->Departamento->find('all');
		$regiones = $this->Departamento->Region->find('all'); 
		$destinos = $this->Departamento->Destino->find('all'); 
	
		$codDep = $this->Departamento->find('first',array('fields'=>'MAX(codigo) as codDep','recursive'=>-1));
		$codDep = $codDep[0]['codDep'] + 1;
		$codReg = $this->Departamento->Region->find('first',array('fields'=>'MAX(codigo) as codReg','recursive'=>-1));
		$codReg = $codReg[0]['codReg'] + 1;
		$codDes = $this->Departamento->Destino->find('first',array('fields'=>'MAX(codigo) as codDes','recursive'=>-1));
		$codDes = $codDes[0]['codDes'] + 1;
		$codMer = $this->Departamento->importModel('Mercancia')->find('first',array('fields'=>'MAX(codigo) as codMer','recursive'=>-1));
		$codMer = $codMer[0]['codMer'] + 1;
		$codEmp = $this->Departamento->importModel('Empaque')->find('first',array('fields'=>'MAX(codigo) as codEmp','recursive'=>-1));
		$codEmp = $codEmp[0]['codEmp'] + 1;

		foreach ($regiones as $key=>$value){
			$regiones[$key]['Region']['departamento']    = $regiones[$key]['Departamento']['nombre'];			
		}

		foreach ($destinos as $key=>$value){
			$destinos[$key]['Destino']['departamento']   = $destinos[$key]['Departamento']['nombre'];
			$destinos[$key]['Destino']['region']         = $destinos[$key]['Region']['nombre'];
		}

		$empaques   = $this->Departamento->importModel('Empaque')->find('all');
		$mercancias = $this->Departamento->importModel('Mercancia')->find('all');

		$this->generateJSON( 'departamentos', $departamentos, array('Departamento' => array('id','codigo','nombre')),2);
		$this->generateJSON( 'regiones', $regiones, array('Region' => array('id','codigo','nombre','departamento')),1);
		$this->generateJSON( 'destinos', $destinos, array('Destino' => array('id','codigo','nombre','departamento','region')));
		$this->generateJSON( 'empaques', $empaques, array('Empaque' => array('id','codigo','nombre')),2);
		$this->generateJSON( 'mercancias', $mercancias, array('Mercancia' => array('id','codigo','nombre')),2);


		$region = $this->Departamento->Region->find('list');
		$departamento = $this->Departamento->find('list');
		$this->set(compact('codDep','codReg','codDes','codMer','codEmp','region','departamento','accion'));
	}
	
	public function crearDepartamento() {
			if (!empty($this->data)) {				
				$this->Departamento->create();
				if ($this->Departamento->save($this->data)) {
					$this->Session->setFlash('','ok',array('mensaje'=>'El Departamento fue registrado correctamente.'));
    				$this->redirect(array('action' => 'listar'));
				} else {
					$this->Session->setFlash('','error',array('mensaje'=>'El Departamento no se pudo guardar. Por favor intente nuevamente'));
    			}
			}
    	
	}

	public function crearRegion($loc = 2) {
			if (!empty($this->data)) {
				$this->Departamento->Region->create();
				if ($this->Departamento->Region->save($this->data)) {
					$this->Session->setFlash('','ok',array('mensaje'=>'La Región fue registrada correctamente.'));
    				$this->redirect(array('action' => 'listar',$loc));
				} else {
					$this->Session->setFlash('','error',array('mensaje'=>'La Región no se pudo guardar. Por favor intente nuevamente'));
    			}
			}
			$departamentos = $this->Departamento->find('list');
			$this->set(compact('departamentos'));
    	
	}

	public function crearDestino($loc = 3) {
			if (!empty($this->data)) {
				$this->Departamento->Destino->create();
				if ($this->Departamento->Destino->save($this->data)) {
					$this->Session->setFlash('','ok',array('mensaje'=>'El Destino fue registrado correctamente.'));
    				$this->redirect(array('action' => 'listar',$loc));
				} else {
					$this->Session->setFlash('','error',array('mensaje'=>'El Destino no se pudo guardar. Compruebe que el nombre no exista.'));
    			}
			}
			$departamentos = $this->Departamento->find('list');
			$regiones = $this->Departamento->Region->find('list');
			$this->set(compact('departamentos','regiones'));
    	
	}

	public function crearEmpaque($loc = 4) {
			if (!empty($this->data)) {
				$this->Departamento->importModel('Empaque')->create();
				if ($this->Departamento->importModel('Empaque')->save($this->data)) {
					$this->Session->setFlash('','ok',array('mensaje'=>'El Empaque fue registrado correctamente.'));
    				$this->redirect(array('action' => 'listar',$loc));
				} else {
					$this->Session->setFlash('','error',array('mensaje'=>'El Empaque no se pudo guardar. Por favor intente nuevamente'));
    			}
			}
    	
	}

	public function crearMercancia($loc = 5) {
			if (!empty($this->data)) {
				$this->Departamento->importModel('Mercancia')->create();
				if ($this->Departamento->importModel('Mercancia')->save($this->data)) {
					$this->Session->setFlash('','ok',array('mensaje'=>'La Mercancía fue registrada correctamente.'));
    				$this->redirect(array('action' => 'listar',$loc));
				} else {
					$this->Session->setFlash('','error',array('mensaje'=>'La Mercancía no se pudo guardar. Por favor intente nuevamente'));
    			}
			}
    	
	}

	public function editarDepartamento($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Departamento no válido. Intente nuevamente'));
				$this->redirect(array('action' => 'listar'));
			} else {
				if (!empty($this->data)) {
					if ($this->Departamento->save($this->data)) {
						$this->Session->setFlash('','ok',array('mensaje'=>'El Departamento fue editado correctamente.'));
	    				$this->redirect(array('action' => 'listar'));
					} else {
						$this->Session->setFlash('','error',array('mensaje'=>'El Departamento no se pudo editar correctamente. Por favor intente nuevamente'));
	    				$this->redirect(array('action' => 'listar'));
	    			}
				}
				$this->data = $this->Departamento->read(null, $id);
			}			
    	
	}

	public function editarRegion($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Región no válida. Intente nuevamente'));
				$this->redirect(array('action' => 'listar'));
			} else {
				if (!empty($this->data)) {
					if ($this->Departamento->Region->save($this->data)) {
						$this->Departamento->Destino->updateAll(array('Destino.region_id'=>null),array('Destino.region_id'=>$this->data['Region']['id']));
						$this->Departamento->Destino->updateAll(array('Destino.region_id'=>$this->data['Region']['id']),array('Destino.id'=>$this->data['Region']['destinos']));
						$this->Session->setFlash('','ok',array('mensaje'=>'La Región fue editada correctamente.'));
	    				$this->redirect(array('action' => 'listar', 2));
					} else {
						$this->Session->setFlash('','error',array('mensaje'=>'La Región no se pudo editar correctamente. Por favor intente nuevamente'));
	    				$this->redirect(array('action' => 'listar', 2));
	    			}
				}
				$region         =  $this->Departamento->Region->find('first',array('recursive'=>-1,'conditions'=>array('Region.id'=>$id)));
				$destinosRegion = $this->Departamento->Destino->find('list',array('conditions'=>array('Destino.region_id'=>$id)));
				
				$this->data     = $region;
				$departamentos  = $this->Departamento->find('list');
				$destinos    = $this->Departamento->Destino->find('list',array('conditions'=>array('OR'=>array('Destino.region_id'=>array(null,0,$id)))));
				//$destinos    = $this->Departamento->Destino->find('list',array('conditions'=>array('AND'=>array('Destino.region_id !='=>null),'AND NOT'=>array('Destino.region_id'=>$id))));
				$this->set(compact('departamentos','destinos','destinosT','destinosRegion'));
			}			
    	
	}

	public function editarDestino($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Destino no válido. Intente nuevamente'));
				$this->redirect(array('action' => 'listar'));
			} else {
				if (!empty($this->data)) {
					if ($this->Departamento->Destino->save($this->data)) {
						$this->Session->setFlash('','ok',array('mensaje'=>'El Destino fue editado correctamente.'));
	    				$this->redirect(array('action' => 'listar',3));
					} else {
						$this->Session->setFlash('','error',array('mensaje'=>'El Destino no se pudo editar correctamente. Por favor intente nuevamente'));
	    				$this->redirect(array('action' => 'listar',3));
	    			}
				}
				$this->data = $this->Departamento->Destino->read(null, $id);

				$departamentos = $this->Departamento->find('list');
				$regiones = $this->Departamento->Region->find('list');
				$this->set(compact('departamentos','regiones'));
			}			
    	
	}

	public function editarEmpaque($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Tipo de Empaque no válido. Intente nuevamente'));
				$this->redirect(array('action' => 'listar'));
			} else {
				if (!empty($this->data)) {
					if ($this->Departamento->importModel('Empaque')->save($this->data)) {
						$this->Session->setFlash('','ok',array('mensaje'=>'El Tipo de Empaque fue editado correctamente.'));
	    				$this->redirect(array('action' => 'listar',4));
					} else {
						$this->Session->setFlash('','error',array('mensaje'=>'El Tipo de Empaque no se pudo editar correctamente. Por favor intente nuevamente'));
	    				$this->redirect(array('action' => 'listar',4));
	    			}
				}
				$this->data = $this->Departamento->importModel('Empaque')->read(null, $id);
			}			
    	
	}

	public function editarMercancia($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Tipo de Mercancía no válido. Intente nuevamente'));
				$this->redirect(array('action' => 'listar'));
			} else {
				if (!empty($this->data)) {
					if ($this->Departamento->importModel('Mercancia')->save($this->data)) {
						$this->Session->setFlash('','ok',array('mensaje'=>'El Tipo de Mercancía fue editado correctamente.'));
	    				$this->redirect(array('action' => 'listar',5));
					} else {
						$this->Session->setFlash('','error',array('mensaje'=>'El Tipo de Mercancía no se pudo editar correctamente. Por favor intente nuevamente'));
	    				$this->redirect(array('action' => 'listar',5));
	    			}
				}
				$this->data = $this->Departamento->importModel('Mercancia')->read(null, $id);
			}			
    	
	}

	public function eliminarDepartamento($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Departamento no válido. Intente nuevamente'));
			} else {
				if ($this->Departamento->delete($id)) {					
					$this->Session->setFlash('','ok',array('mensaje'=>'El Departamento fue eliminado correctamente.'));
    			} else {
					$this->Session->setFlash('','error',array('mensaje'=>'El Departamento no se pudo eliminar. Por favor intente nuevamente'));
    			}				
			}
			$this->redirect(array('action' => 'listar'));
    	

	}

	public function eliminarRegion($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Región no válida. Intente nuevamente'));
			} else {
				if ($this->Departamento->Region->delete($id)) {					
					$this->Session->setFlash('','ok',array('mensaje'=>'La Región fue eliminada correctamente.'));
    			} else {
					$this->Session->setFlash('','error',array('mensaje'=>'La Región no se pudo eliminar. Por favor intente nuevamente'));
    			}				
			}
			$this->redirect(array('action' => 'listar',2));
    	

	}

	public function eliminarDestino($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Destino no válido. Intente nuevamente'));
			} else {
				if ($this->Departamento->Destino->delete($id)) {					
					$this->Session->setFlash('','ok',array('mensaje'=>'El Destino fue eliminado correctamente.'));
    			} else {
					$this->Session->setFlash('','error',array('mensaje'=>'El Destino no se pudo eliminar. Por favor intente nuevamente'));
    			}				
			}
			$this->redirect(array('action' => 'listar',3));
    	

	}

	public function eliminarEmpaque($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Tipo de Empaque no válido. Intente nuevamente'));
			} else {
				if ($this->Departamento->importModel('Empaque')->delete($id)) {					
					$this->Session->setFlash('','ok',array('mensaje'=>'El Tipo de Empaque fue eliminado correctamente.'));
    			} else {
					$this->Session->setFlash('','error',array('mensaje'=>'El Tipo de Empaque no se pudo eliminar. Por favor intente nuevamente'));
    			}				
			}
			$this->redirect(array('action' => 'listar',4));
    	

	}

	public function eliminarMercancia($id = null) {

			if (empty($id)) {
				$this->Session->setFlash('','error',array('mensaje'=>'Tipo de Mercancía no válida. Intente nuevamente'));
			} else {
				if ($this->Departamento->importModel('Mercancia')->delete($id)) {					
					$this->Session->setFlash('','ok',array('mensaje'=>'El Tipo de Mercancía fue eliminada correctamente.'));
    			} else {
					$this->Session->setFlash('','error',array('mensaje'=>'El Tipo de Mercancía no se pudo eliminar. Por favor intente nuevamente'));
    			}				
			}
			$this->redirect(array('action' => 'listar',5));
    	

	}

}
?>
