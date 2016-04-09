<?php
class Destino extends AppModel {
	public $name = 'Destino';
	
	public $virtualFields = array('listNombre' => 'SELECT concat(Destino.nombre," (",Departamento.nombre,")") FROM departamentos as Departamento WHERE Departamento.id = Destino.departamento_id');
	public $displayField = 'listNombre';
	public $actsAs = array( 'AuditLog.Auditable' );
	
	public $belongsTo = array('Region','Departamento');

	public $hasMany = array(
		'Representantexdestino' => array(
			'className'		=> 'Representantexdestino',
			'foreignKey'	=> 'destino_id',
			'dependent'		=> false
		)
	);
	public $validate = array(
		'nombre' => array(
			'unicoDepartamento' => array(
				'rule'    => 'unicoDepartamento',
				'message' => 'El destino ya existe para este departamento.'
			)
		)
	);
	function unicoDepartamento() {
		$count = $this->find('count',array('conditions'=>array('Destino.nombre'=>$this->data['Destino']['nombre'],'Destino.departamento_id'=>$this->data['Destino']['departamento_id'])));
		$this->log($this->data);
		$this->log($count);
		if($count > 0){
			return false;
		} else {
			return true;
		}
		return true;
	} 
/*
	public $validate = array(
		'nombre' => array(
			'isUnique' => array(
				'rule'    => 'isUnique',
				'message' => 'El destino ya existe.'
			),
			'notEmpty' => array(
				'rule'    => 'notEmpty',
				'message' => 'Este campo es obligatorio.'
			)
		)
	);
*/
}
?>
