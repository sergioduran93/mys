<?php
class FacturasController extends AppController {
	public $name = 'Facturas';

	public function crear() {
		if(!empty($this->data)){
			$cliente = $this->Factura->importModel('Cliente')->find('first',array('conditions'=>array('Cliente.id'=>$this->data['Factura']['cliente'])));
			$plazo = empty($cliente['Cliente']['numero_guias']) ? 0 : floatval($cliente['Cliente']['numero_guias']);
			$this->request->data['Factura']['cliente_nom'] = $cliente['Cliente']['listNombre'];
			$this->request->data['Factura']['cliente_cc']  = $cliente['Cliente']['documento'];
			$this->request->data['Factura']['cliente_dir'] = $cliente['Cliente']['direccion'];
			$this->request->data['Factura']['cliente_tel'] = $cliente['Cliente']['telefono'];
			$this->request->data['Factura']['fecha']  = date('Y-m-d h:m:s');
			$this->request->data['Factura']['vence']  = date('Y-m-d', strtotime(date('Y-m-d'). ' + '+$plazo+' days'));
			
			$user   = $this->Auth->user();
			$user   = $this->Factura->importModel('User')->read(null,$user['id']);
			$ofi    = $this->Factura->importModel('Oficina')->read(null,$user['Oficina']['id']);
			
			$numero = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
			
			$this->request->data['Factura']['resolucion'] = $ofi['Oficina']['resolucion'];
			$this->request->data['Factura']['numero'] = $numero;
			$this->request->data['Factura']['estado'] = "1";
			$this->request->data['Factura']['guias']  = json_encode($this->data['Factura']['guias']);
			if($this->Factura->save($this->data)){

    			$ofi['Oficina']['consecutivo'] = floatval($ofi['Oficina']['consecutivo']) + 1;
    			$this->Factura->importModel('Oficina')->save($ofi);

    			$this->Session->setFlash('','ok',array('mensaje'=>'La factura se guardo con exito.'));
				$this->redirect(array('action' => 'imprimir',$this->Factura->id));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La factura no se puedo guardar.'));
			}
		}
		$destinos = $this->Factura->importModel('Destino')->find('list');
		$clientes = $this->Factura->importModel('Cliente')->find('list',array('fields'=>array('Cliente.listAll'),'conditions'=>array('Cliente.tipo'=>"Clientes",'Cliente.id >'=>1)));
		$this->set(compact('clientes','destinos'));
	}

	public function getGuias($cliente = null,$tipo = null, $desde = null , $hasta = null) {
		$this->autoRender = false;
		$hasta .= ' 23:59:59';
		$guias = $this->Factura->importModel('Venta')->find('all',array('fields'=>array('id','destino','fecha','remesa','documento1','documento2','documento3','nombreDest','destinoNombre','direccionDest','valor_total'),'conditions'=>array('Venta.cliente'=>$cliente,'Venta.clase'=>$tipo,'Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
		//$this->log($guias);
		$nom = 'fact_'.$cliente;
		$this->generateJSON($nom, $guias, array('Venta' => array('id','destino','fecha','remesa','documento1','documento2','documento3','nombreDest','destinoNombre','direccionDest','valor_total')));
		return $nom;
	}

	public function imprimir($id = null) {
		$factura = $this->Factura->find('first',array('conditions'=>array('Factura.id'=>$id)));
		$guiasId = json_decode($factura['Factura']['guias'],true);
		$guias   = $this->Factura->importModel('Venta')->find('all',array('conditions'=>array('Venta.id'=>$guiasId)));
		$this->set(compact('factura','guias'));
	}
}
?>
