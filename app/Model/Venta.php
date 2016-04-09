<?php
class Venta extends AppModel {
	public $name = 'Venta';

	public $virtualFields = array('destinoNombre' => 'SELECT Destino.nombre FROM destinos as Destino WHERE Destino.id = Venta.destino',
								  'origenNombre'  => 'SELECT Destino.nombre FROM destinos as Destino WHERE Destino.id = Venta.origen',
								  'remesa2'  => 'SELECT REPLACE(remesa,"-","")'
	);
	public $displayField = 'remesa';

	public function getVenta($remesa = null) {
		return $this->query("SELECT id FROM ventas AS Venta WHERE REPLACE(Venta.remesa,'-','') = '".$remesa."' LIMIT 1");
	}

	public function beforeDelete(){
		$this->request->data['Venta']['kilo_adic']        = str_replace(".",",",str_replace(",","",$this->data['Venta']['kilo_adic']));
		$this->request->data['Venta']['valor_kilo_adic']  = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_kilo_adic']));
		$this->request->data['Venta']['desc_flete']       = str_replace(".",",",str_replace(",","",$this->data['Venta']['desc_flete']));
		$this->request->data['Venta']['desc_kilo']        = str_replace(".",",",str_replace(",","",$this->data['Venta']['desc_kilo']));
		$this->request->data['Venta']['valor_devolucion'] = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_devolucion']));
		$this->request->data['Venta']['valor_seguro']     = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_seguro']));
		$this->request->data['Venta']['valor_total']      = str_replace(".",",",str_replace(",","",$this->data['Venta']['valor_total']));
		return true;
	}

	public function beforeSave(array $options = array()){
		if($this->data['Venta']['remauto'] != ""){
			$rem = $this->find('first', array('order' => array('Venta.id' =>'desc'),'fields'=>'Venta.id'));
			$this->data['Venta']['remesa'] = $this->data['Venta']['remauto'].(floatval($rem['Venta']['id'])+1);
		}
		if($this->data['Venta']['id'] == "" && $this->data['Venta']['oficina'] == "7"){
			$this->data['Venta']['lista'] = 0;
		} else {
			$this->data['Venta']['lista'] = 1;
		}

		//if($this->data['Venta']['id'] == "" || $this->data['Venta']['id'] == ""){
			$empInfo = json_decode($this->data['Venta']['empaque_info'],true);
	        $barras = implode(",", $empInfo['barras']);
	        $barras = explode(",", $barras);
	        $barras = array_filter($barras);
	        $bar = array();

	        foreach ($barras as $key => $value) {
	        	if($value != ""){
	        		$ingreso = $this->importModel('Ingreso')->find('first',array('conditions'=>array('Ingreso.barras'=>$value)));
	        		if(!empty($ingreso)){
	        			$ingreso['Ingreso']['estado'] = 1;
	        			$this->importModel('Ingreso')->save($ingreso);
	        		} else {
						$ingreso['Ingreso']['id']      = "";
						$ingreso['Ingreso']['cliente'] = $this->data['Venta']['cliente'];
						$ingreso['Ingreso']['barras']  = $value;
						$ingreso['Ingreso']['info']    = "";
						$ingreso['Ingreso']['estado']  = 1;
						$ingreso['Ingreso']['fecha']   = $this->data['Venta']['fecha'].' '.$this->data['Venta']['hora'];
	        			$this->importModel('Ingreso')->save($ingreso);
	        		}
	        	}
	        }
		//}
		return true;
	}


	public function getGuiaReemp($id){
		$guiaReemp = $this->find('first',array('conditions'=>array('Venta.documento1'=>$id,'Venta.tipo'=>'Reempaque')));
		return $guiaReemp;
	}

	public function trazabilidad($id = null){
		if($id != null){
			$venta    = $this->find('first',array('recursive'=>'-1','conditions'=>array('Venta.id'=>$id)));
			$destinos = $this->importModel('Destino')->find('list',array('fields'=>array('Destino.nombre')));
			$empaques = $this->importModel('Empaque')->find('list');
			$empa     = json_decode($venta['Venta']['empaque_info'],true);
			$html     = '<div style="margin:2px 0px 2px 0px;padding: 0px 5px;" class="bs-callout bs-callout-warning"><h4 style="color:rgb(226, 127, 0);padding:4px 0px;"><span class="glyphicon glyphicon-envelope"></span>Contenido: '.$venta['Venta']['contenido'].'</h4><table class="table empClass"><thead><tr><th>Empaque</th><th>Descripción</th><th>Cantidad</th><th>Largo</th><th>Ancho</th><th>Alto</th><th>Peso</th><th>Peso Vol</th></tr></thead><tbody>';
			foreach ($empa['empaques'] as $key2 => $value2) {
				$html = $html.'<tr><td>'.$empaques[$value2].'</td><td>'.$empa["descripcion"][$key2].'</td><td>'.$empa["cantidad"][$key2].'</td><td>'.$empa["largo"][$key2].'</td><td>'.$empa["ancho"][$key2].'</td><td>'.$empa["alto"][$key2].'</td><td>'.$empa["peso"][$key2].'</td><td>'.$empa["pesoVol"][$key2].'</td></tr>';
			}
			$venta['Venta']['html']  = $html.'</tboby></table></div>';

			$oficinas = $this->importModel('Oficina')->find('list',array('fields'=>array('Oficina.nombre')));
			if(is_numeric($venta['Venta']['despachada'])){
				$estado = '<span class="glyphicon glyphicon-home"></span>Oficina: '.$oficinas[$venta['Venta']['despachada']];
			} elseif($venta['Venta']['despachada'] == "Despachada"){
				$linkA  = Router::url(array('controller'=>'ventas', 'action'=>'confirmacion',$venta['Venta']['id']), false);
				$estado = '<a target="_blank" class="glyphicon glyphicon-earphone" style="color:white;" href="'.$linkA.'"><span>Confirmar Guia</span></a>';
			} else {
				$estado = $venta['Venta']['despachada'];
			}
			$linkVentas = Router::url(array('controller'=>'ventas', 'action'=>'imprimir'), false);

			if($venta['Venta']['archivo'] == 1){
				$control = '<span style="float:right;margin-top: 10px;font-size: initial;" class="label label-success"><span class="glyphicon glyphicon-folder-open"></span>En Archivo: SI</span>';
			} else {
				$control = '<span style="float:right;margin-top: 10px;font-size: initial;" class="label label-danger"><span class="glyphicon glyphicon-folder-open"></span>En Archivo: NO</span>';
			}
			$control = $control . '<a class="label label-success" style="float:right;margin-top:10px;font-size:initial;" target="_blank" href="'.$linkVentas.'/'.$venta['Venta']['id'].'/1"><span class="glyphicon glyphicon-print"></span>Imprimir</a>';
			$html2 = '<div style="margin:2px 0px 2px 0px;padding: 0px 5px;" class="bs-callout bs-callout-green"><h4 style="color: rgb(65, 126, 46);width: 50%;float: left;padding:4px 0px;"><span class="glyphicon glyphicon-random"></span>Trazabilidad de la Guia</h4>'.$control.'<span style="float:right;margin-top: 10px;font-size: initial;" class="label label-success">'.$estado.'</span><table class="table"><thead><tr><th>Evento</th><th>Información</th><th>Usuario</th><th>Fecha</th></tr></thead><tbody>';
			
			$users = $this->importModel('User')->find('list');
			$linkTraza = Router::url(array('controller'=>'ventas', 'action'=>'trazabilidad'), false);
			$html2 = $html2.'<tr><td><a target="_blank" href="'.$linkTraza.'/'.$venta['Venta']['id'].'">Registrada Remesa:'.$venta['Venta']['remesa'].'</a></td><td></td><td>'.$users[$venta['Venta']['usuario']].'</td><td>'.$venta['Venta']['fecha'].' '.$venta['Venta']['hora'].'</td>';
			
			$recibo = $this->importModel('Recibo')->find('all',array('conditions'=>array('Recibo.guia_id'=>$venta['Venta']['id']),'order'=>array('Recibo.fecha')));
			if(!empty($recibo)){
				foreach ($recibo as $key2 => $value2) {
					if($value2['Recibo']['tipo'] == 'Juridica'){
						$html2 = $html2.'<tr><td>Despachada</td><td>('.$destinos[$value2['Recibo']['destino']].') Recibo:'.$value2['Recibo']['numero'].' Transportadora:'.$value2['Recibo']['razon'].' Flete: $'.$value2['Recibo']['flete'].' Obs: '.$value2['Recibo']['obs'].'</td><td>'.$users[$value2['Recibo']['usuario']].'</td><td>'.$value2['Recibo']['fecha'].'</td>';
					} else {
						$html2 = $html2.'<tr><td>Despachada</td><td>('.$destinos[$value2['Recibo']['destino']].') Recibo:'.$value2['Recibo']['numero'].' Placa:'.$value2['Recibo']['documento'].' Flete: $'.$value2['Recibo']['flete'].' Obs: '.$value2['Recibo']['obs'].'</td><td>'.$users[$value2['Recibo']['usuario']].'</td><td>'.$value2['Recibo']['fecha'].'</td>';
					}
				}
			}
			if(!empty($venta['Venta']['virtual'])){
				$html2    = $html2.'<tr><td>Despachada Virtual</td><td></td><td>'.$users[$venta['Venta']['virtual']].'</td><td>'.$venta['Venta']['fecha_virtual'].'</td>';
			}
			$conductores = $this->importModel('Conductor')->find('list',array('conditions'=>array('Conductor.conductor2'=>1)));
			$traslados = $this->importModel('Traslado')->find('all',array('fields'=>array('Traslado.id','Traslado.guias','Traslado.destino','Traslado.placa','Traslado.usuario','Traslado.fecha')));
			foreach ($traslados as $key => $value) {
				$flag = substr_count($value['Traslado']['guias'], '"'.$id.'"');
				if($flag > 0){
					$vehiculo = $this->importModel('Vehiculo')->find('first',array('conditions'=>array('Vehiculo.id'=>$value['Traslado']['placa'])));
					$html2    = $html2.'<tr><td>Traslado Local</td><td>('.$oficinas[$value['Traslado']['destino']].') '.$vehiculo['Vehiculo']['placa'].': '.$conductores[$value['Traslado']['conductor']].'</td><td>'.$users[$value['Traslado']['usuario']].'</td><td>'.$value['Traslado']['fecha'].'</td>';
				}
			}
			$nacionales = $this->importModel('Nacional')->find('all',array('fields'=>array('Nacional.id','Nacional.guias','Nacional.destino','Nacional.representante','Nacional.usuario','Nacional.fecha')));
			foreach ($nacionales as $key => $value) {
				$flag = substr_count($value['Nacional']['guias'], '"'.$id.'"');
				if($flag > 0){
					$representante = $this->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$value['Nacional']['representante'])));
					$html2    = $html2.'<tr><td>Traslado Nacional</td><td>('.$destinos[$value['Nacional']['destino']].') '.$representante['Representante']['listNombre'].'</td><td>'.$users[$value['Nacional']['usuario']].'</td><td>'.$value['Nacional']['fecha'].'</td>';
				}
			}
			if(!empty($venta['Venta']['despacho'])){
				$despacho  = $this->importModel('Despacho')->find('first',array('conditions'=>array('Despacho.id'=>$venta['Venta']['despacho'])));
				$vehiculo  = $this->importModel('Vehiculo')->find('first',array('recursive'=>-1,'conditions'=>array('Vehiculo.id'=>$despacho['Despacho']['placa'])));
				$conductor = $this->importModel('Conductor')->find('first',array('recursive'=>-1,'conditions'=>array('Conductor.id'=>$despacho['Despacho']['conductor'])));
				$teleC[]   = $conductor['Conductor']['telefono'];
				$teleC[]   = $conductor['Conductor']['celular'];
				$teleC     = array_filter($teleC);
				$html2     = $html2.'<tr><td>Despacho #'.$despacho['Despacho']['id'].'</td><td>'.$vehiculo['Vehiculo']['placa'].': '.$conductor['Conductor']['listNombre'].' Tel: '.implode('-',$teleC).'</td><td>'.$users[$despacho['Despacho']['usuario']].'</td><td>'.$despacho['Despacho']['fecha'].'</td>';
			}
			
			$linkR     = Router::url(array('controller'=>'representantes', 'action'=>'crear'), false);
			$linkReemp = Router::url(array('controller'=>'reempaques', 'action'=>'trazabilidad'), false);
			$linkTraza = Router::url(array('controller'=>'ventas', 'action'=>'trazabilidad'), false);
			if(!empty($venta['Venta']['reempaque'])){
				$reempaque     = $this->importModel('Reempaque')->find('first',array('conditions'=>array('Reempaque.id'=>$venta['Venta']['reempaque'])));
				$representante = $this->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$reempaque['Reempaque']['representante'])));
				$teleR[]       = $representante['Representante']['telefono1'];
				$teleR[]       = $representante['Representante']['telefono2'];
				$teleR[]       = $representante['Representante']['telefono3'];
				$teleR[]       = $representante['Representante']['celular'];
				$teleR         = array_filter($teleR);
				$html2         = $html2.'<tr><td><a target="_blank" href="'.$linkReemp.'/'.$reempaque['Reempaque']['id'].'">Reempaque #'.$reempaque['Reempaque']['id'].'</a></td><td><a target="_blank" href="'.$linkR.'/'.$representante['Representante']['id'].'">'.$representante['Representante']['listNombre'].'</a> Tel: '.implode("-", $teleR).'</td><td>'.$users[$reempaque['Reempaque']['usuario']].'</td><td>'.$reempaque['Reempaque']['fecha'].'</td>';
				$guiaReemp     = $this->getGuiaReemp($reempaque['Reempaque']['id']);
				if(!empty($guiaReemp)){
					$html2 = $html2.'<tr><td><a target="_blank" href="'.$linkTraza.'/'.$guiaReemp['Venta']['id'].'">Guia Reempaque #'.$guiaReemp['Venta']['id'].'</a></td><td><a target="_blank" href="'.$linkR.'/'.$representante['Representante']['id'].'">'.$representante['Representante']['listNombre'].'</a> Tel: '.implode("-", $teleR).'</td><td>'.$users[$guiaReemp['Venta']['usuario']].'</td><td>'.$guiaReemp['Venta']['fecha'].' '.$guiaReemp['Venta']['hora'].'</td>';
				}
			}
			if(!empty($venta['Venta']['usuario_confirm'])){
				$html2    = $html2.'<tr><td>Confirmada</td><td>'.$venta['Venta']['recibio'].'</td><td>'.$users[$venta['Venta']['usuario_confirm']].'</td><td>'.$venta['Venta']['fecha_confirm'].'</td>';
			}
			$linkV = Router::url(array('controller'=>'ventas', 'action'=>'trazabilidad'), false);
			$linkV = str_replace("ventas/trazabilidad", "img/escaner/", $linkV);

			if(!empty($venta['Venta']['usuario_escan'])){
				$html2    = $html2.'<tr><td>Escaneada</td><td><a target="_blank" href="'.$linkV.$venta['Venta']['imagen'].'" id="verGuia" class="btn btn-info" style="padding: 5px 10px;margin: 0px;"><span class="glyphicon glyphicon-file"></span>VER</a></td><td>'.$users[$venta['Venta']['usuario_escan']].'</td><td>'.$venta['Venta']['fecha_escan'].'</td>';
			}
			$venta['Venta']['html2']  = $html2.'</tboby></table></div>';

		} else {
			$venta = "";
		}
		return $venta;
	}


}
?>
