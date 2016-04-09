<?php
class Area extends AppModel {
	public $name = 'Area';
	public $displayField = 'nombre';
	public $actsAs = array('AuditLog.Auditable');
}
?>