<?php
class Traslado extends AppModel {
	public $name = 'Traslado';
	public $displayField = 'nombre';
	public $actsAs = array('AuditLog.Auditable');
}
?>