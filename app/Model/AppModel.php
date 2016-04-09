<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	public function importModel($model){
        App::import('model', $model);
        $request = new $model();
        return $request;
    }


	function getEnumValues($columnName=null, $plural = false){
        if ($columnName==null) { return array(); }

        $db = ConnectionManager::getDataSource($this->useDbConfig);
        $tableName = $db->fullTableName($this, false);

        $result = $this->query("SHOW COLUMNS FROM {$tableName} LIKE '{$columnName}'");

        $types = null;
        if(isset($result[0]['COLUMNS']['Type'])){
            $types = $result[0]['COLUMNS']['Type'];
        }
        elseif(isset($result[0][0]['Type'])){
            $types = $result[0][0]['Type'];
        }
        else{
            return array();
        }

        $values = explode("','", preg_replace("/(enum)\('(.+?)'\)/","\\2", $types) );

        $assoc_values = array();
        foreach ( $values as $value ) {
            if($plural){
                $key = strtolower(Inflector::pluralize($value));
                $assoc_values[$key] = Inflector::humanize($value);
            }else{
                $assoc_values[$value] = Inflector::humanize($value);
            }
        }
        return $assoc_values;
    }


    public function generateCode($length = 3){
        $password = "";
        $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
        $maxlength = strlen($possible);
      
        // check for length overflow and truncate if necessary
        if ($length > $maxlength) {
            $length = $maxlength;
        }
        
        $i = 0; 
        while ($i < $length) { 
          $char = substr($possible, mt_rand(0, $maxlength-1), 1);
            
          if (!strstr($password, $char)) { 
            $password .= $char;
            $i++;
          }
        }
        return $password;
    }

}
