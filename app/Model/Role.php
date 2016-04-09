<?php
class Role extends AppModel {
	public $name = 'Role';
	public $displayField = 'name';

	public $actsAs = array('Acl' => array('type' => 'controlled'));

	public function parentNode() {
        return null;
    }

    public $hasMany = array('User');
    
}
?>