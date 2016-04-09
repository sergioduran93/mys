<?php
class UtilComponent extends Component {
	var $key;
	var $controller;
	var $components = array('JqImgcrop');

	function startup(&$controller) {
		$this->controller=&$controller;
		$this->key = $this->controller->params['controller'];
	}

    public function getType($name = null){
		$data      = explode(".", $name);
		$extension = end($data);
		return $extension;
	}

	public function generateCode($length = 8){
		$password = "";
		$possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
		$maxlength = strlen($possible);
	  
		// check for length overflow and truncate if necessary
		if ($length > $maxlength) {
			$length = $maxlength;
		}
		
		$i = 0; 
		while ($i < $length) { 
			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, $maxlength-1), 1);

			if (!strstr($password, $char)) { 
				$password .= $char;
				$i++;
			}
		}
		//$password = date('Y_m_d_H_i_s') . '_'.$password;
		return $password;
	}
}
?>