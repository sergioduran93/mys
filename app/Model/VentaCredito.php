<?php
class VentasCredito extends AppModel {
	public $name = 'VentasCredito';
	public $virtualFields = array('destinoNombre' => 'SELECT Destino.nombre FROM destinos as Destino WHERE Destino.id = VentasCredito.destino',
								  'origenNombre'  => 'SELECT Destino.nombre FROM destinos as Destino WHERE Destino.id = VentasCredito.origen'
	);
}
?>
