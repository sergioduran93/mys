<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Cookie',
        'DebugKit.Toolbar',
        'Acl',
        'ExcelWrite',
        'Session',
        'Auth'=>array(
            'authError'=>"Usted no tiene acceso a esta pagina.",
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        )
    );

    public function isAuthorized($usuario) {
        //return $this->Auth->loggedIn();
        return false;
    }
    
    public function beforeFilter() {
        $this->Auth->allow('index', 'view');
        $this->set('session', $this->Auth->loggedIn());
        $user = $this->Auth->user();
        $this->set('usuario_actual', $user);

        //$this->log("***************");
        //$this->log($this->Acl->check(array('User'=>array('id'=>$user['id'])),'Clientes/crear'));
        //$this->log("***************");

        if(!empty($user) && $this->Session->check('Auth.User')){
            $this->set('menu', $this->Session->read('menu'));
            $this->loadModel('User');
            $usuario = $this->User->find('first',array('recursive'=>0,'field'=>array('User.cookie','User.id'),'conditions'=>array('User.id'=>$user['id'])));
            $this->set('role', $usuario['Role']['name']);
            $cookie  = $this->Cookie->read('User'.$user['id']);
            if($usuario['User']['cookie'] != $cookie){
                $this->Session->destroy();
                $this->Session->setFlash('','error',array('mensaje'=>'Se ha iniciado su sesión en otro lugar ó No cerro sesión adecuadamente.'));
            }
        }
        //Este metodo habilita las acciones para ser ingresadas desde cualquier usuario
        //Nota: en produccion comentar esta linea
        //$this->Auth->allow();

        $this->Auth->authorize = array(
            'Controller',
            'Actions' => array('actionPath' => 'controllers')
        );
        $this->Auth->authenticate = array(
            'Form' => array(
                'fields' => array(
                    'username' => 'username',
                    'password' => 'password'
                )
            )
        );
        $this->Auth->loginAction = array(
            'controller' => 'users',
            'action' => 'login',
            'admin' => false,
            'plugin' => false
        );
        $this->Auth->logoutRedirect = array(
            'controller' => 'users',
            'action' => 'login',
            'admin' => false,
            'plugin' => false
        );
        $this->Auth->loginRedirect = array(
            'controller' => 'users',
            'action' => 'index',
            'admin' => false,
            'plugin' => false
        );

    }



    public function sendEmail($email = null, $msg = null, $subject = null){
        App::uses('CakeEmail', 'Network/Email');
        $cakeMail = new CakeEmail('gmail');
        $cakeMail->emailFormat('html');
        //$cakeMail->attachments(array('MyS.png' => 'img/mys2.png'));
        $cakeMail->template('default');
        $cakeMail->from('teban.unal@gmail.com');
        $cakeMail->to($email);
        $cakeMail->subject($subject);
        $envio = $cakeMail->send("\n\n".$msg);
        return $envio;
    }
    
    public function generateJSON($name = null, $dataSource = array(), $fields = array(),$actions = null) {
        $data = array();
        foreach($dataSource as $key => $value){
            $temp = array();
            foreach($fields as $model => $dataFields){
                foreach($dataFields as $field){
                    $temp[] = mb_convert_encoding($value[$model][$field], 'UTF-8' );
                }
            }
            if(empty($actions)){
                $temp[] = '';
            } else {
                for ($i = 0; $i <= $actions; $i++) {
                    $temp[] = '';
                }
            } 
            $data['aaData'][] = $temp;
        }
        if(empty($dataSource)){
            $data['aaData'] = array();
        }

        APP::import('Utility','File');
        $file = new File(WWW_ROOT.'/sources/'.$name.'.txt',true);
        $file->write(json_encode($data));
        $file->close();
    }


}
