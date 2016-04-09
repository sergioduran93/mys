<?php
class ContablesController extends AppController {
	public $name = 'Contables';

	public function egresos() {
		if(!empty($this->data)){
			$count = $this->Contabl->find('count',array('conditions'=>array('Contabl.tipo'=>"EGRESO")));
			$count += 1;
			$this->request->data['Contabl']['numero'] = $count;
			$this->request->data['Contabl']['fecha']  = date('Y-m-d h:i:s');
			$this->request->data['Contabl']['tipo']   = "EGRESO";
			if($this->Contabl->save($this->data)){
				$nuevoConcepto = array();
				$nuevoConcepto['Concepto']['tipo']   = "EGRESO";
				$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
				$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
				$nuevoConcepto['Concepto']['codigo'] = $this->data['Contabl']['concepto'];
				$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor'];
				$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
				$this->Contabl->importModel('Concepto')->save($nuevoConcepto);

				if($this->data['Contabl']['valor_iva'] != '0' || $this->data['Contabl']['valor_iva'] != ''){
					$nuevoConcepto = array();
					$nuevoConcepto['Concepto']['tipo']   = "EGRESO";
					$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
					$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
					$nuevoConcepto['Concepto']['codigo'] = '511570';
					$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor_iva'];
					$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
					$this->Contabl->importModel('Concepto')->save($nuevoConcepto);
				}
				if($this->data['Contabl']['valor_compra'] != '0' || $this->data['Contabl']['valor_compra'] != ''){
					$nuevoConcepto = array();
					$nuevoConcepto['Concepto']['tipo']   = "EGRESO";
					$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
					$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
					$nuevoConcepto['Concepto']['codigo'] = '2222222';
					$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor_compra'];
					$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
					$this->Contabl->importModel('Concepto')->save($nuevoConcepto);
				}
				if($this->data['Contabl']['valor_servicios'] != '0' || $this->data['Contabl']['valor_servicios'] != ''){
					$nuevoConcepto = array();
					$nuevoConcepto['Concepto']['tipo']   = "EGRESO";
					$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
					$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
					$nuevoConcepto['Concepto']['codigo'] = '3333333';
					$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor_servicios'];
					$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
					$this->Contabl->importModel('Concepto')->save($nuevoConcepto);
				}

	   			$this->Session->setFlash('','ok',array('mensaje'=>'El egreso se guardo con exito'));
    			$this->redirect(array('action' => 'imprimir',$this->Contabl->id));
			} else {
		   		$this->Session->setFlash('','error',array('mensaje'=>'El egreso no se pudo guardar'));
			}
		}
		$this->data = null;

		$count = $this->Contabl->find('count',array('conditions'=>array('Contabl.tipo'=>"EGRESO")));
		$count += 1;
		$cuentas  = $this->Contabl->importModel('Cuenta')->find('list');
		$oficinas = $this->Contabl->importModel('Oficina')->find('list');
		$this->set(compact('cuentas','oficinas','count'));
	}


	public function ingresos() {
		if(!empty($this->data)){
			$count = $this->Contabl->find('count',array('conditions'=>array('Contabl.tipo'=>"INGRESO")));
			$count += 1;
			$this->request->data['Contabl']['numero'] = $count;
			$this->request->data['Contabl']['fecha']  = date('Y-m-d h:i:s');
			$this->request->data['Contabl']['tipo']   = "INGRESO";
			if($this->Contabl->save($this->data)){
				$nuevoConcepto = array();
				$nuevoConcepto['Concepto']['tipo']   = "INGRESO";
				$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
				$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
				$nuevoConcepto['Concepto']['codigo'] = $this->data['Contabl']['concepto'];
				$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor'];
				$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
				$this->Contabl->importModel('Concepto')->save($nuevoConcepto);

				if($this->data['Contabl']['valor_iva'] != '0' || $this->data['Contabl']['valor_iva'] != ''){
					$nuevoConcepto = array();
					$nuevoConcepto['Concepto']['tipo']   = "INGRESO";
					$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
					$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
					$nuevoConcepto['Concepto']['codigo'] = '4444444';
					$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor_iva'];
					$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
					$this->Contabl->importModel('Concepto')->save($nuevoConcepto);
				}
				if($this->data['Contabl']['valor_compra'] != '0' || $this->data['Contabl']['valor_compra'] != ''){
					$nuevoConcepto = array();
					$nuevoConcepto['Concepto']['tipo']   = "INGRESO";
					$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
					$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
					$nuevoConcepto['Concepto']['codigo'] = '5555555';
					$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor_compra'];
					$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
					$this->Contabl->importModel('Concepto')->save($nuevoConcepto);
				}
				if($this->data['Contabl']['valor_servicios'] != '0' || $this->data['Contabl']['valor_servicios'] != ''){
					$nuevoConcepto = array();
					$nuevoConcepto['Concepto']['tipo']   = "INGRESO";
					$nuevoConcepto['Concepto']['ref']    = $this->Contabl->id;
					$nuevoConcepto['Concepto']['numero'] = $this->data['Contabl']['factura'];
					$nuevoConcepto['Concepto']['codigo'] = '666666';
					$nuevoConcepto['Concepto']['valor']  = $this->data['Contabl']['valor_servicios'];
					$nuevoConcepto['Concepto']['fecha']  = date('Y-m-d h:i:s');
					$this->Contabl->importModel('Concepto')->save($nuevoConcepto);
				}

	   			$this->Session->setFlash('','ok',array('mensaje'=>'El ingreso se guardo con exito'));
    			$this->redirect(array('action' => 'imprimir',$this->Contabl->id));
			} else {
		   		$this->Session->setFlash('','error',array('mensaje'=>'El ingreso no se pudo guardar'));
			}
		}
		$this->data = null;

		$count = $this->Contabl->find('count',array('conditions'=>array('Contabl.tipo'=>"INGRESO")));
		$count += 1;
		$cuentas  = $this->Contabl->importModel('Cuenta')->find('list');
		$oficinas = $this->Contabl->importModel('Oficina')->find('list');
		$this->set(compact('cuentas','oficinas','count'));
	}



	public function imprimir($id){
		$cont      = $this->Contabl->find('first',array('conditions'=>array('Contabl.id'=>$id)));
		$user      = $this->Contabl->importModel('User')->find('first',array('conditions'=>array('User.id'=>$cont['Contabl']['usuario'])));
		$oficina   = $this->Contabl->importModel('Oficina')->find('first',array('conditions'=>array('Oficina.id'=>$cont['Contabl']['oficina'])));
		$conceptos = $this->Contabl->importModel('Concepto')->find('all',array('fields'=>array('Concepto.codigo','Concepto.valor'),'conditions'=>array('Concepto.ref'=>$id)));
		foreach ($conceptos as $key => $value) {
			$cuenta = $this->Contabl->importModel('Cuenta')->find('first',array('conditions'=>array('Cuenta.id'=>$value['Concepto']['codigo'])));
			$conceptos[$key]['Concepto']['codigo'] = $cuenta['Cuenta']['numero'];
			$conceptos[$key]['Concepto']['descrip'] = $cuenta['Cuenta']['concepto'];
		}

		$this->set(compact('cont','user','oficina','conceptos'));
	}
}
?>
