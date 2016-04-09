<?php

App::uses('AppModel', 'Model');
App::uses('CakeEmail', 'Network/Email');

class User extends AppModel {
	public $name = 'User';
	public $virtualFields = array('listNombre' => 'concat(User.name, " ", User.lastname)');
	public $displayField = 'listNombre';
	
    public $actsAs = array('Acl' => array('type'=>'requester'));
	/*
	public $validate = array(
		'name'=>array(
			'Please enter your name.'=>array(
				'rule'=>'notEmpty',
				'message'=>'Please enter your name.'
			)
		),
		'username'=>array(
			'The username must be between 5 and 15 characters.'=>array(
				'rule'=>array('between', 5, 15),
				'message'=>'The username must be between 5 and 15 characters.'
			),
			'That username has already been taken'=>array(
				'rule'=>'isUnique',
				'message'=>'That username has already been taken.'
			)
		),
		'email'=>array(
			'Valid email'=>array(
				'rule'=>array('email'),
				'message'=>'Please enter a valid email address'
			)
		),
		'password'=>array(
		    'Match passwords'=>array(
		        'rule'=>'matchPasswords',
		        'message'=>'Las contraseñas no coinciden'
		    )
		),
		'password2'=>array(
		    'Not empty'=>array(
		        'rule'=>'notEmpty',
		        'message'=>'Please confirm your password'
		    )
		)
	);*/
	public $belongsTo = array('Role','Oficina');

	public function matchPasswords($data) {
	    if ($data['password'] == $this->data['User']['password2']) {
	        return true;
	    }
	    $this->invalidate('password2', 'Las contraseñas no coinciden');
	    return false;
	}
	
	public function beforeSave($options = Array()) {
	    if (isset($this->data['User']['password'])) {
	        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
	    }
	    return true;
	}
/*
	public function parentNode() {
		$this->log("Entra al parentNode User");
        if (!$this->id && empty($this->data))
        {
            return null;
        }

        $data = $this->data;

        if (empty($this->data))
        {
            $data = $this->read();
        }
        elseif(isset($this->id) && empty($data[$this->alias]['role_id']))
        {
            $data[$this->alias]['role_id'] = $this->field('role_id', array('User.id' => $this->id));
        }

        if (empty($data[$this->alias]['role_id']))
        {
            return null;
        }
        else
        {
            return array('Role' => array('id' => $data[$this->alias]['role_id']));
        }
    }*/
    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['role_id'])) {
            $roleId = $this->data['User']['role_id'];
        } else {
            $roleId = $this->field('role_id');
        }
        if (!$roleId) {
            return null;
        } else {
            return array('Role' => array('id' => $roleId));
        }
    }
    
}
?>
