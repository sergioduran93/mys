<?php

class RelacionfacturasController extends AppController {
public $name = 'Relacionfacturas';
public $components = array('RequestHandler', 'Session');
    public $helpers = array('Html', 'Form', 'Time', 'Js');
    public $paginate = array(
    'limit' => 15,
    'order' => array(
    'Relacionfactura.id' => 'asc'
	)
	);

	//public $components = array('Session');
	//public $helpers = array('Html', 'Form', 'Time');

	public function listarelaciones(){
		$relacionfacturas = $this->Relacionfactura->find('all');
		$this->log($relacionfacturas);
		$this->set('relacionfacturas', $relacionfacturas);
		
	}
public function ver($id = null)
{
	if(!$id){
		throw new NotFoundException('Datos Invalidos');
	}
	$relacionfactura = $this->Relacionfactura->findById($id);
	if(!$relacionfactura){
		throw new NotFoundExceptio('La factura no existe');
	}
	$this->set('relacionfactura', $relacionfactura);
	
}

	public function delete($id = null) {
		if($this->request->is('get'))
		{
			throw new MethodNotAllowedException();
		}else{
	if($this->Relacionfactura->delete($id)){
	   		$this->Session->setFlash('LA RELACION SE ELIMINO CON EXITO');
    	$this->redirect(array('action' => 'listarelaciones'));
    }
	}
}

public function add()
{
	$this->loadModel('Venta', 'RequestHandler'); //llamando al modelo ventas y recuperando la informacion

	$relacionfactura_item =$this->Venta->find('all', array('relacionfactura' => 'Venta.id ASC'));

	//debug($relacionfactura_item);

	if(count($relacionfactura_item) > 0)
	{
		$total_venta =$this->Venta->find('all', array('fields' =>('SUM(Venta.valor_total) as valor_total')));
		$mostrar_total_ventas = $total_venta[0][0][0][0][0][0][0][0][0][0][0]['valor_total'];

		$cliente = $this->Relacionfactura-find('list');
		$this->set(compact('relacionfactura_item', 'mostrar_total_ventas', 'cliente'));

		if($this->request->is('post'))
		{
			$this->Relacionfactura->create();
			if($this->Relacionfactura->save($this->request->data))
			{
				$id_relacionfactura = $this->Relacionfactura->id;
			}
			$this->Session->setFlash('La Factura fue procesada con éxito', 'default');

	}
}
}
}



?>