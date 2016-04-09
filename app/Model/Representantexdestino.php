<?php
class Representantexdestino extends AppModel {
	public $name = 'Representantexdestino';

	public $belongsTo = array('Representante','Destino');

}
?>
