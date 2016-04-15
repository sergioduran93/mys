<?php
class CreditosController extends AppController
{
public $components = array('Session', 'RequestHandler');
public $helpers = array('Html', 'Form', 'Time');

public function nuevo()
{
	/*
	$prestamo = $this->request->data['prestamo'];
			$abono = $this->request->data['abono'];
			$subtotal = $prestamo - $abono;
			*/
	if($this->request->is('post'))
	{

		$this->Credito->create();
		if($this->Credito->save($this->request->data))
		{

			$this->Session->setFlash('EL CREDITO HA SIDO GUARDADO CON EXITO', 'default', array('class' => 'success'));
			return $this->redirect(array('controller' => 'representantes','action' => 'listarepresentantes'));
		}
		$this->Session->setFlash('NO SE PUDO CREAR CREDITO');
		$subtotal = $prestamo - $abono;
	}
	$representantes = $this->Credito->Representante->find('list');
	$this->set('representantes', $representantes);
}

public function ver()
{
	$this->set('creditos', $this->Credito->find('all', array('orden' => 'Credito.id ASC')));
	$total_creditos = $this->Credito->find('all', array('fields' => array('SUM(Credito.subtotal) as subtotal')));
	$mostrar_total_creditos = $total_creditos[0][0]['subtotal'];
	$this->set('total_creditos', $mostrar_total_creditos);

	//Vid 14
}

public function itemupdate()
{
	if($this->request->is('ajax'))
	{
		$id = $this->request->data['id'];
		$cantidad = isset($this->request->data['cantidad']) ? $this->request->data['cantidad'] : null;
		if($cantidad == 0)
		{
			$cantidad = 1;
		}
		$item = $this->Pedido->find('all', array('fields' => array('Pedido.id', 'Platillo.precio'), 
			'conditions' => array('Pedido.id' => $id)));
		$precio_item = $item[0]['PLatillo']['precio'];
		$subtotal_item = $cantidad * $precio_item;
		$item_update = array('id' => $id, 'cantidad' => $cantidad, 'subtotal' => $subtotal_item);
		$this->Pedido->saveAll($item_update);
	}
}

}
?>