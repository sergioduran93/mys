<?php
class FacturasController extends AppController {
	public $name = 'Facturas';
	public $components = array('RequestHandler', 'Session');
    public $helpers = array('Html', 'Form', 'Time', 'Js');
    public $paginate = array(
    'limit' => 15,
    'order' => array(
    'Factura.id' => 'asc'
	)
	);

	public function crear() {
		$valor = 0;
		if(!empty($this->data)){
			$relacion = $this->Factura->Relacionfactura->find('first',array('conditions'=>array('Relacionfactura.id' => $this->data['Factura']['relacionfactura_id'])));
			$cliente = $this->Factura->importModel('Cliente')->find('first',array('conditions'=>array('Cliente.id'=>$relacion['Relacionfactura']['cliente_id'])));
			$plazo = empty($cliente['Cliente']['numero_guias']) ? 0 : floatval($cliente['Cliente']['numero_guias']);
			$this->request->data['Factura']['cliente']     = $relacion['Relacionfactura']['cliente_id'];
			$this->request->data['Factura']['cliente_nom'] = $cliente['Cliente']['listNombre'];
			$this->request->data['Factura']['cliente_cc']  = $cliente['Cliente']['documento'];
			$this->request->data['Factura']['cliente_dir'] = $cliente['Cliente']['direccion'];
			$this->request->data['Factura']['cliente_tel'] = $cliente['Cliente']['telefono'];
			$this->request->data['Factura']['fecha']  = date('Y-m-d h:m:s');
			$this->request->data['Factura']['vence']  = date('Y-m-d', strtotime(date('Y-m-d'). ' + '+$plazo+' days'));
			
			// aca sume el valor total de las ventas, para que vieras como sacar una suma de columna
			$valor = $this->Factura->importModel('Venta')->find('first',array('conditions'=>array('Venta.relacionfactura_id' => $this->data['Factura']['relacionfactura_id']),'fields'=>array('SUM(valor_total) as sumaValor')));
			$valor = $valor[0]['sumaValor'];
			$this->request->data['Factura']['valor']  = $valor;


			$user   = $this->Auth->user();
			$user   = $this->Factura->importModel('User')->read(null,$user['id']);
			$ofi    = $this->Factura->importModel('Oficina')->read(null,$user['Oficina']['id']);
			
			$numero = $user['Oficina']['codigo'].$user['User']['codigo'].(floatval($user['Oficina']['desde'])+floatval($user['Oficina']['consecutivo']));
			
			$this->request->data['Factura']['resolucion'] = $ofi['Oficina']['resolucion'];
			$this->request->data['Factura']['numero'] = $numero;
			$this->request->data['Factura']['estado'] = "FACTURADO";
			if($this->Factura->save($this->data)){
				$this->Factura->Relacionfactura->updateAll(array('Relacionfactura.estado' => 1), array('Relacionfactura.id' => $this->data['Factura']['relacionfactura_id']));
    			$ofi['Oficina']['consecutivo'] = floatval($ofi['Oficina']['consecutivo']) + 1;
    			$this->Factura->importModel('Oficina')->save($ofi);

    			$this->Session->setFlash('','ok',array('mensaje'=>'La factura se guardo con exito.'));
				$this->redirect(array('controller'=>'ventas','action' => 'imprimirfacturarel',$this->Factura->id));
				$this->log($this->data['Venta']['imprimir']);
				
		if($this->data['Venta']['imprimir'] != ""){
			$this->autoRender = false;
			
			$this->imprimirfacturarel($ventas, $this->data['Venta']['cliente'], $this->data['Venta']['desde'], $this->data['Venta']['hasta'], $this->data['Venta']['fecha']);
		}
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'La factura no se puedo guardar.'));
			}
		}

		$relaciones = $this->Factura->Relacionfactura->find('list', array('conditions' => array('Relacionfactura.estado' => 0)));
		$this->set(compact('relaciones','valor'));
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
	public function listafacturas()
	{
		$this->Factura->recursive=0;
		$this->paginate['Factura']['limit'] = 15;
		$this->paginate['Factura']['order'] = array('Factura.id' => 'asc');
		//$this->Paginator->settings = $this->paginate;


		$this->set('facturas', $this->paginate());

if(!empty($this->data)){
	$factura   = $this->Factura->find('all');
		$this->generateJSON('listafacturas', $facturas, array('Factura' => array('id','relacionfactura_id','cliente_nom','fecha','valor')));
	}
}
/*
public function listarelaciones()
	{
		$this->set('facturas', $this->Factura->find('all'));


if(!empty($this->data)){
	$factura   = $this->Factura->find('all');
		$this->generateJSON('listarelaciones', $facturas, array('Factura' => array('id','relacionfactura_id','cliente_nom','fecha','valor')));
	}
}
*/
public function ver($id = null)
{
	if(!$id){
		throw new NotFoundException('Datos Invalidos');
	}
	$factura = $this->Factura->findById($id);
	if(!$factura){
		throw new NotFoundExceptio('La factura no existe');
	}
	$this->set('factura', $factura);
}

	//	$clientes = $this->Factura->importModel('Cliente')->find('list',array('conditions'=>array('Cliente.id >'=>1)));
	//	$this->set(compact('clientes'));
	//}
	public function delete($id = null) {
		if($this->request->is('get'))
		{
			throw new MethodNotAllowedException();
		}else{
	if($this->Factura->delete($id)){
	   		$this->Session->setFlash('LA FACTURA SE ELIMINO CON EXITO');
    	$this->redirect(array('action' => 'listafacturas'));
    }
	}
}
    public function imprimirfacturarel ($facturaId){
		$factura = $this->Factura('Factura')->find('first',array('conditions'=>array('Factura.id'=>$facturaId)));
		$this->log($factura);
		/*
				(
		    [Factura] => Array
		        (
		            [id] => 15
		            [numero] => 115058
		            [cliente_nom] => MANDAR Y SERVIR S.A.
		            [cliente_cc] => 811023661
		            [cliente_dir] => CARRERA 46 # 42 - 79
		            [cliente_tel] => 4446033
		            [fecha] => 2016-03-16 11:03:39
		            [vence] => 2016-03-16 00:00:00
		            [relacionfactura_id] => 3
		            [cliente] => 2
		            [resolucion] => 110000513931 de 2012/12/21
		            [valor] => 2999.9700000000003
		            [estado] => 1
		            [usuario] => 1
		        )

		    [Relacionfactura] => Array
		        (
		            [id] => 3
		            [cliente_id] => 2
		            [dni] => 3
		            [fecha] => 2016-03-16 00:00:00
		            [usuario] => 1
		            [estado] => 1
		        )

		)
		*/
		//podes seguir camellando ya al PDF, cuadrar los campos... hay mira lo que tiene la variable factura
//listo?? listo hermano, muchisimas gracias, le voy a seguir cacharriando, para entender todo full, vloisyto a hacer tm. acmualuier cosa me avisas
		$this->set(compact('factura'));
//de
	}
	}
?>
