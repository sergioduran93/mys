<?php
class UsersController extends AppController {

	public $name = 'Users';
	public $components = array('Cookie' ,'JqImgcrop', 'Util');

	
	/*

	*/
	//./Console/cake -app C://ruta AclExtras.AclExtras aco_sync
	function initDB($userId = null) {
	    //Permite a los administradores hacer todo

		$aro  = new Aro();
		$data = array(
			'alias' => 'Gollum',
			'parent_id' => null,
			'model' => 'User',
			'foreign_key' => $userId,
		);
		$aro->create();
		$aro->save($data);

	    $userModel =& $this->User;
	    $userModel->id = $userId;
	    $this->Acl->allow($userModel, 'controllers');
	    $this->Acl->deny($userModel, 'controllers/Users/crear');

	}

	function aroRole() {
		$groups = $this->User->Role->find('all');
		$aro = new Aro();
		foreach($groups as $group) {
			$aro->create();
			$aro->save(array(
				'alias'=>$group['Role']['name'],
				'foreign_key' => $group['Role']['id'],
				'model'=>'Role',
				'parent_id' => null
			));
		}
	}

	function initDB2() {
	    
		$this->aroRole();

	    $group =& $this->User->Role;
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');
		//
		$this->Acl->allow($group, 'controllers/Ventas/relacionfacturas');

		$group->id = 2;
		$this->Acl->allow($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Ventas/relacionfacturas');
		//
		$this->Acl->allow($group, 'controllers/Clientes/crear');
		$this->Acl->deny($group,  'controllers/Departamentos/editarDepartamento');
		$this->Acl->deny($group,  'controllers/Departamentos/editarRegion');
		$this->Acl->deny($group,  'controllers/Departamentos/editarDestino');
		$this->Acl->deny($group,  'controllers/Departamentos/editarEmpaque');
		$this->Acl->deny($group,  'controllers/Departamentos/editarMercancia');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarDepartamento');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarRegion');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarDestino');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarEmpaque');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarMercancia');
		$this->Acl->deny($group,  'controllers/Oficinas/crear');
		$this->Acl->deny($group,  'controllers/Novedades/crear');
		$this->Acl->deny($group,  'controllers/Areas/crear');

		$group->id = 3;
		$this->Acl->allow($group, 'controllers');
		$this->Acl->deny($group,  'controllers/Departamentos/editarDepartamento');
		$this->Acl->deny($group,  'controllers/Departamentos/editarRegion');
		$this->Acl->deny($group,  'controllers/Departamentos/editarDestino');
		$this->Acl->deny($group,  'controllers/Departamentos/editarEmpaque');
		$this->Acl->deny($group,  'controllers/Departamentos/editarMercancia');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarDepartamento');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarRegion');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarDestino');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarEmpaque');
		$this->Acl->deny($group,  'controllers/Departamentos/eliminarMercancia');
		$this->Acl->deny($group,  'controllers/Tarifas/crear');
		$this->Acl->deny($group,  'controllers/Tarifas/convenios');
		$this->Acl->deny($group,  'controllers/Tarifas/tarifaDescuentos');
		$this->Acl->deny($group,  'controllers/Tarifas/conveniosDescuentos');
		$this->Acl->deny($group,  'controllers/Planillas/actualizar');
		$this->Acl->deny($group,  'controllers/Oficinas/crear');
		$this->Acl->deny($group,  'controllers/Novedades/crear');
		$this->Acl->deny($group,  'controllers/Auxiliares/crear');
		$this->Acl->deny($group,  'controllers/Areas/crear');

		$group->id = 4;
		$this->Acl->allow($group, 'controllers');
		$this->Acl->deny($group,  'controllers/Departamentos');
		$this->Acl->deny($group,  'controllers/Tarifas/crear');
		$this->Acl->deny($group,  'controllers/Tarifas/convenios');
		$this->Acl->deny($group,  'controllers/Tarifas/tarifaDescuentos');
		$this->Acl->deny($group,  'controllers/Tarifas/conveniosDescuentos');
		$this->Acl->deny($group,  'controllers/Clientes/crear');
		$this->Acl->deny($group,  'controllers/Remitentes/crear');
		$this->Acl->deny($group,  'controllers/Conductores/crear');
		$this->Acl->deny($group,  'controllers/Vehiculos/crear');
		$this->Acl->deny($group,  'controllers/Representantes/crear');
		$this->Acl->deny($group,  'controllers/Transportadoras/crear');
		$this->Acl->deny($group,  'controllers/Planillas/actualizar');
		$this->Acl->deny($group,  'controllers/Destinatarios/crear');
		$this->Acl->deny($group,  'controllers/Anticipos/crear');
		$this->Acl->deny($group,  'controllers/Oficinas/crear');
		$this->Acl->deny($group,  'controllers/Novedades/crear');
		$this->Acl->deny($group,  'controllers/Auxiliares/crear');
		$this->Acl->deny($group,  'controllers/Areas/crear');

		$group->id = 5;
		$this->Acl->allow($group, 'controllers');
		$this->Acl->deny($group,  'controllers/Departamentos');
		$this->Acl->deny($group,  'controllers/Tarifas/crear');
		$this->Acl->deny($group,  'controllers/Tarifas/convenios');
		$this->Acl->deny($group,  'controllers/Tarifas/tarifaDescuentos');
		$this->Acl->deny($group,  'controllers/Tarifas/conveniosDescuentos');
		$this->Acl->deny($group,  'controllers/Remitentes/crear');
		$this->Acl->deny($group,  'controllers/Anticipos/crear');
		$this->Acl->deny($group,  'controllers/Oficinas/crear');
		$this->Acl->deny($group,  'controllers/Novedades/crear');
		$this->Acl->deny($group,  'controllers/Auxiliares/crear');
		$this->Acl->deny($group,  'controllers/Areas/crear');
		
		$group->id = 6;
		$this->Acl->allow($group, 'controllers');
		$this->Acl->deny($group,  'controllers/Departamentos');
		$this->Acl->deny($group,  'controllers/Tarifas/crear');
		$this->Acl->deny($group,  'controllers/Tarifas/convenios');
		$this->Acl->deny($group,  'controllers/Tarifas/tarifaDescuentos');
		$this->Acl->deny($group,  'controllers/Tarifas/conveniosDescuentos');
		$this->Acl->deny($group,  'controllers/Remitentes/crear');
		$this->Acl->deny($group,  'controllers/Planillas/actualizar');
		$this->Acl->deny($group,  'controllers/Anticipos/crear');
		$this->Acl->deny($group,  'controllers/Oficinas/crear');
		$this->Acl->deny($group,  'controllers/Novedades/crear');
		$this->Acl->deny($group,  'controllers/Auxiliares/crear');
		$this->Acl->deny($group,  'controllers/Areas/crear');
	}

	public function beforeFilter() {
		//$this->initDB2();
		parent::beforeFilter();
		$this->Auth->allow('login','logout');
	}


	public function roles() {
		App::import('Model', 'Permiso');
        $permModel = new Permiso();
		if(!empty($this->data)){
			$arrayCheck = array();
			foreach ($this->data['User']['Link'] as $key => $value) {
				if($value == 1){
					$arrayCheck[$key] = 0;
				} else {
					$arrayCheck[$key] = 1;
				}
			}
			$permiso = $permModel->find('first',array('fields'=>array('Permiso.id','Permiso.role_id','Permiso.aco'),'conditions'=>array('Permiso.role_id'=>$this->data['User']['role_id'])));
			$permiso['Permiso']['role_id'] = $this->data['User']['role_id'];
			
			$permiso['Permiso']['aco'] = json_encode($arrayCheck);
			$permModel->save($permiso);
		}
		$this->data = null;
		$permisoAll = $permModel->find('all');
		$permisos   = array();
		foreach ($permisoAll as $key => $value) {
			$permisos[$value['Permiso']['role_id']] = json_decode($value['Permiso']['aco'],true);
		}

		$roles = $this->User->Role->find('list');
	    $this->set(compact('roles','permisos'));

	}

	private function _uploadImage(&$data){
		$file     = $this->data['User']['foto'];
		$username = $this->data['User']['username'];
		$type     = $this->Util->getType($file['name']);
		$code     = $this->Util->generateCode(3);
		if(!empty($file['name'])){
			$file['name']         = $username."-".$code.'.'.$type;
			$uploaded             = $this->JqImgcrop->uploadImage($file, 'img/perfiles', '');
			$data['User']['foto'] = $file['name'];
		}else{
			unset($data['User']['foto']);
		}
	}

	public function perfil($id = null) {
		$user = $this->Auth->user();
		$user = $this->User->read(null,$user['id']);
		if($id != $user['User']['id']){
    		$this->Session->setFlash('','error',array('mensaje'=>'Usuario invalido, por favor intente nuevamente.'));
			$this->redirect(array('action' => 'index'));
		} else {
			if(!empty($this->data)){
				$this->_uploadImage($this->request->data);
				if ($this->data['User']['password'] == ""){
					$this->request->data['User']['password']  = $user['User']['password'];
					$this->request->data['User']['password2'] = $user['User']['password'];
				}
				if(!empty($this->data['User']['foto'])){
					$foto = $this->data['User']['foto'];
				} else {
					$foto = $user['User']['foto'];
				}
				$this->User->save($this->data);
			} else {
				$foto = $user['User']['foto'];
			}
			$user['User']['password'] = "";
			$this->data = $user;
			$this->set(compact('foto'));
		}
	}

	public function index() {

	}

	public function buildAcl() {
        $log = array();

        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
            $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
            $root = $aco->save();
            $root['Aco']['id'] = $aco->id;
            $log[] = 'Creado el nodo Aco para los controladores';
        } else {
            $root = $root[0];
        }

        App::import('Core', 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex !== false ) {
            unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';

        // miramos en cada controlador en app/controllers
        foreach ($Controllers as $ctrlName) {
            App::import('Controller', $ctrlName);
            $ctrlclass = $ctrlName . 'Controller';
            $methods = get_class_methods($ctrlclass);

            //buscar / crear nodo de controlador
            $controllerNode = $aco->node('controllers/'.$ctrlName);
            if (!$controllerNode) {
                $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                $controllerNode = $aco->save();
                $controllerNode['Aco']['id'] = $aco->id;
                $log[] = 'Creado el nodo Aco del controlador '.$ctrlName;
            } else {
                $controllerNode = $controllerNode[0];
            }

            //Limpieza de los metodos, para eliminar aquellos en el controlador
            //y en las acciones privadas
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
                $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                if (!$methodNode) {
                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                    $methodNode = $aco->save();
                    $log[] = 'Creado el nodo Aco para '. $method;
                }
            }
        }
        debug($log);
    }

	public function vista() {
	    parent::beforeFilter();
	    $this->Auth->allow('add','recuperar');
	}

	public function login() {
		$title_for_layout = "Ingreso";
		$this->layout='login';
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
				$user = $this->Auth->user();

//				$menuArray = $this->menu($user['id']);
				$this->Session->write('menu', $menuArray);
				//if($user['enabled'] == 0){
					$rnd = time();
					$usuario['User']            = $user;					
					$this->Cookie->write('User'.$usuario['User']['id'], $rnd,false);
					$usuario['User']            = $user;
					$usuario['User']['cookie']  = $rnd;
					$this->User->save($usuario);
					$this->Session->write('Auth', $usuario);
				//	$this->log($this->request->clientIp());
				/*} else {
					$usuario['User']            = $user;
					$usuario['User']['enabled'] = 2;
					$this->User->save($usuario);
				}*/



	            $this->redirect($this->Auth->redirect());   
	        } else {
	        	$this->Session->setFlash('','error',array('mensaje'=>'El usuario o la contraseña no son correctas'));
	        }
	    }
	    $this->set(compact('title_for_layout'));
	}
	
	public function recuperar() {
		$this->layout='login';
		if(!empty($this->data)){
			$usuario = $this->Usuario->find('first',array('conditions'=>array('User.email'=>$this->data['Recuperar']['email'])));
			if(empty($usuario)){
				$this->Session->setFlash('','error',array('mensaje'=>'El email no es valido.'));
			} else {				
				$this->Session->setFlash('','ok',array('mensaje'=>'La contraseña provisional fue mandada a su correo.'));
				$this->_crearUsuario($usuario['User']['email']);

			}
		}
	}
	
	private function _crearUsuario($correo = null){
		$password = "";  
		$i = 0;  
		$possible = "abcdfghjkmnpqrstvwxyz";   
		$possible2 = "0123456789";
		// agrega random  
		while ($i < 8) {
			if ($i==1 || $i==4){
		   		$char = substr($possible2, mt_rand(0, strlen($possible2)-1), 1);
			} else {
				$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			}
		   			
			if ($i==3 || $i==5){
		   		$char = strtoupper($char);
			}
			
		   if (!strstr($password, $char)) {  
		       $password .= $char;
		       $i++;  
		   }  
		}
		App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail('gmail');
        $email->from('teban.unal@gmail.com');
        $email->to($correo);
        $email->subject('Contraseña Provisional');
        $email->send($password);
	}


	public function pw() {
	 //   $this->redirect($this->Auth->logout());
		if(empty($this->data)){			


		} else {

			$numeros = 0;
			$mayusculas = 0;

			$sCadena = $this->data['Pw']['pw'];
			for($i=0; $i<strlen($sCadena); $i++){
				echo $sCadena[$i];
				if(ctype_upper($sCadena[$i])){
					$mayusculas = $mayusculas + 1;
				} else if(ctype_digit($sCadena[$i])){
					$numeros = $numeros + 1;
				}
			}

			if($numeros < 2 ){
				$this->Session->setFlash('','error',array('mensaje'=>'La contraseña tiene que tener minimo dos numeros.'));
			} else if($mayusculas < 2){
				$this->Session->setFlash('','error',array('mensaje'=>'La contraseña tiene que tener minimo dos letras mayusculas.'));
			} else if (strlen($sCadena)<8){
				$this->Session->setFlash('','error',array('mensaje'=>'La contraseña debe tener un tamaño minimo de ocho.'));
			} else {
				$this->Session->setFlash('','ok',array('mensaje'=>'Contraseña valida'));
			}
		}
		$this->set(compact('password'));

	}



	public function logout() {
		$this->Session->destroy();
	    $this->redirect($this->Auth->logout());
	}

	public function listar() {
		$usuarios = $this->User->find('all');
		$oficinas = $this->User->importModel('Oficina')->find('list');
		foreach ($usuarios as $key => $value) {
			$usuarios[$key]['User']['oficina'] = $oficinas[$value['User']['oficina_id']];
		}
		$this->generateJSON('usuarios', $usuarios, array('User' => array('id','codigo','name','lastname','oficina')));
	}
		
	public function editar($id = null) {
		if(!empty($this->data)){
			if ($this->User->save($this->data)) {
				//$this->initDB($this->User->id);
				$this->Session->setFlash('','ok',array('mensaje'=>'Usuario editado exitosamente.'));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('','error',array('mensaje'=>'El usuario no se pudo editar.'));
			}
		}
		$usuario = $this->User->read(null,$id);
		$usuario['User']['password'] = "";
		$this->data = $usuario;
		$clientes       = $this->User->importModel('Cliente')->find('list',array('conditions'=>array('Cliente.tipo'=>'Clientes')));
		$representantes = $this->User->importModel('Representante')->find('list');
		$destinos       = $this->User->importModel('Destino')->find('list');
		$oficinas       = $this->User->importModel('Oficina')->find('list');
		$roles          = $this->User->Role->find('list');
		$codigos = array();
		foreach ($oficinas as $idOfi => $value) {
			$codigo = $this->User->find('count',array('conditions'=>array('User.oficina_id'=>$idOfi)));
			$codigos[$idOfi] = $codigo + 1;
		}
		//	$this->generateJSON('usuarios', $usuarios, array('User' => array('id','nombres','telefono','email','oficina','role')));

		$this->set(compact('clientes','representantes','roles','oficinas','destinos','codigos'));

	}

	public function crear() {
		if(!empty($this->data)){
			if ($this->User->save($this->data)) {
				//$this->initDB($this->User->id);
				$this->Session->setFlash('','ok',array('mensaje'=>'Usuario creado exitosamente.'));
				//$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('','error',array('mensaje'=>'El usuario no se pudo crear.'));
			}
		}
		$this->data     = null;
		$clientes       = $this->User->importModel('Cliente')->find('list',array('conditions'=>array('Cliente.tipo'=>'Clientes')));
		$representantes = $this->User->importModel('Representante')->find('list');
		$destinos       = $this->User->importModel('Destino')->find('list');
		$oficinas       = $this->User->importModel('Oficina')->find('list');
		$roles          = $this->User->Role->find('list');
		$codigos = array();
		foreach ($oficinas as $idOfi => $value) {
			$codigo = $this->User->find('count',array('conditions'=>array('User.oficina_id'=>$idOfi)));
			$codigos[$idOfi] = $codigo + 1;
		}
		//	$this->generateJSON('usuarios', $usuarios, array('User' => array('id','nombres','telefono','email','oficina','role')));

		$this->set(compact('clientes','representantes','roles','oficinas','destinos','codigos'));
	}

	public function eliminar($id = null) {
		if(!empty($id)){
			if($this->User->delete($id)){
    			$this->Session->setFlash('','ok',array('mensaje'=>'El usuario se elimino con exito'));
			} else {
    			$this->Session->setFlash('','error',array('mensaje'=>'El usuario no se pudo eliminar'));
			}
		}
		$this->redirect(array('action' => 'listar'));
	}

	public function edit($id = null) {
		$this->Usuario->id = $id;
		
		if (!$this->Usuario->exists()) {
			throw new NotFoundException('Invalid user');
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Usuario->save($this->request->data)) {
				$this->Session->setFlash('The user has been saved');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.');
			}
		} else {
			$this->request->data = $this->Usuario->read();
		}
	}

	public function delete($id = null) {
		$this->User->delete($id);

		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if (!$id) {
			$this->Session->setFlash('Invalid id for user');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash('User deleted');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash('User was not deleted');
		$this->redirect(array('action' => 'index'));
	}


	public function auditoria() {
		$Model = new Model();
		$Model->bindModel(
			array( 'hasMany' => array( 'Audit' ) )
		);
		$Model->Audit->bindModel(
			array( 'hasMany' => array( 'AuditDelta' ) )
		);
		$aud = $Model->Audit->find('all',array('recursive'=>-1,'order'=>array('Audit.created DESC')));
		foreach ($aud as $key => $value) {
			$array = json_decode($value['Audit']['json_object'],true); 
			$info = "";
			foreach ($array[0] as $key2 => $value2) {
				$info = $info.'<div class="linea"><div class="halfs">'.$key2.'</div><div class="halfs">'.$value2.'</div></div>';
			}
			$aud[$key]['Audit']['values'] = '<div class="btn-group" style="width:100%"><div class="btn-group" style="width:100%"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ver Detalles<span class="caret"></span></button><ul class="dropdown-menu" style="width:100%"><li>'.$info.'</li></ul></div></div>';
		}
		$this->generateJSON('auditoria', $aud, array('Audit' => array('event','model','entity_id','source_id','created','values')));
	}

	public function menu($userId = null){
        $menu = array();
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Departamentos/listar')){
            $menu[] = 0;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Tarifas/crear')){
            $menu[] = 1;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Tarifas/tarifaDescuentos')){
            $menu[] = 2;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Tarifas/convenios')){
            $menu[] = 3;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Tarifas/conveniosDescuentos')){
            $menu[] = 4;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Clientes/crear')){
            $menu[] = 5;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Remitentes/crear')){
            $menu[] = 6;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Conductores/crear')){
            $menu[] = 7;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Vehiculos/crear')){
            $menu[] = 8;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Vehiculos/negociacion')){
            $menu[] = 9;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Representantes/crear')){
            $menu[] = 10;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Transportadoras/crear')){
            $menu[] = 11;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Planillas/actualizar')){
            $menu[] = 12;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Destinatarios/crear')){
            $menu[] = 13;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Anticipos/crear')){
            $menu[] = 14;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Oficinas/crear')){
            $menu[] = 15;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Novedades/crear')){
            $menu[] = 16;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Auxiliares/crear')){
            $menu[] = 17;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Areas/crear')){
            $menu[] = 18;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/trazabilidad')){
            $menu[] = 19;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Reempaques/trazabilidad')){
            $menu[] = 20;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Despachos/trazabilidad')){
            $menu[] = 21;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Recogidas/listar')){
            $menu[] = 22;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Liquidar/crear')){
            $menu[] = 23;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/anular')){
            $menu[] = 24;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ingresos/crear')){
            $menu[] = 25;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/crear')){
            $menu[] = 26;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascredito/crear')){
            $menu[] = 27;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascontraentrega/crear')){
            $menu[] = 28;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascredicontado/crear')){
            $menu[] = 29;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventasespecial/crear')){
            $menu[] = 30;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventasrepre/crear')){
            $menu[] = 31;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascreditorepre/crear')){
            $menu[] = 32;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascontraentregarepre/crear')){
            $menu[] = 33;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventasespecialrepre/crear')){
            $menu[] = 34;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Recibos/naturalrepre')){
            $menu[] = 35;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascredito/importar')){
            $menu[] = 36;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascredito/reliquidar')){
            $menu[] = 37;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascredito/clientes')){
            $menu[] = 38;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventascredito/relacion')){
            $menu[] = 39;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/leonisa')){
            $menu[] = 40;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Recibos/juridica')){
            $menu[] = 41;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Recibos/natural')){
            $menu[] = 42;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Despachos/crear')){
            $menu[] = 43;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Despachos/crear2')){
            $menu[] = 44;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Despachos/virtual')){
            $menu[] = 45;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Reempaques/crear')){
            $menu[] = 46;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Despachos/traslado')){
            $menu[] = 47;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Reempaques/traslado')){
            $menu[] = 48;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Recibos/juridicarepre')){
            $menu[] = 49;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Recibos/naturalrepre')){
            $menu[] = 50;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/confirmacion')){
            $menu[] = 51;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/escanear')){
            $menu[] = 52;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/ver')){
            $menu[] = 53;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/mercancia')){
            $menu[] = 54;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/caja')){
            $menu[] = 55;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/representantes')){
            $menu[] = 56;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/clientes')){
            $menu[] = 57;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ingresos/listar')){
            $menu[] = 58;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/movCliente')){
            $menu[] = 59;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/movJuridica')){
            $menu[] = 60;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/movNatural')){
            $menu[] = 61;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/despachoRepre')){
            $menu[] = 62;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/despachoXRepre')){
            $menu[] = 63;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Ventas/merConfirmada')){
            $menu[] = 64;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Users/listar')){
            $menu[] = 65;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Users/crear')){
            $menu[] = 66;
        }
        if($this->Acl->check(array('User'=>array('id'=>$userId)),'Users/roles')){
            $menu[] = 67;
        }
        return json_encode($menu);
    }
}
?>
