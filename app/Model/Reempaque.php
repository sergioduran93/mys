<?php
class Reempaque extends AppModel {
	public $name = 'Reempaque';



	public function getNego($repreId = null, $desde = null, $hasta = null) {
		$representante = $this->importModel('Representante')->find('first',array('conditions'=>array('Representante.id'=>$repreId)));
		$ventas        = $this->importModel('Venta')->find('all',array('conditions'=>array('Venta.oficina'=>'7','Venta.fecha BETWEEN ? and ?' => array($desde, $hasta))));
		$fletes        = $this->importModel('Recibo')->find('first',array('fields'=>array('SUM(Recibo.flete) AS valorS'),'conditions'=>array('Recibo.usuario'=>$representante['Representante']['usuario'],'Recibo.fecha BETWEEN ? and ?' => array($desde, $hasta))));
		$fletes        = empty($fletes[0]['valorS']) ? 0 : $fletes[0]['valorS'];
		$valorTotal    = 0;
		$valorConfirm  = 0;
		$valorEscanear = 0;
		$valorDigita   = 0;
		foreach ($ventas as $key => $value) {

			if($value['Venta']['usuario_confirm'] == $representante['Representante']['usuario']){
				if($value['Venta']['clase'] == 'Especial'){
					$valorConfirm = $valorConfirm + floatval($representante['Representante']['digitar_espe']);
				} else {
					$valorConfirm = $valorConfirm + floatval($representante['Representante']['digitar']);
				}
			}
			if($value['Venta']['usuario_escan'] == $representante['Representante']['usuario']){
				if($value['Venta']['clase'] == 'Especial'){
					$valorEscanear = $valorEscanear + floatval($representante['Representante']['escanear_espe']);
				} else {
					$valorEscanear = $valorEscanear + floatval($representante['Representante']['escanear']);
				}
			}
			if($value['Venta']['recaudador'] == $representante['Representante']['usuario']){
				if($value['Venta']['usuario'] == $representante['Representante']['usuario']){
					if($value['Venta']['clase'] == 'Especial'){
						$valorDigita = $valorDigita + floatval($representante['Representante']['digitar_espe']);
					} else {
						$valorDigita = $valorDigita + floatval($representante['Representante']['digitar']);
					}
				}
				$empaquesInfo = json_decode($value['Venta']['empaque_info'],true);
				$cantidad = 0;
				$valor    = 0;
				foreach ($empaquesInfo['empaques'] as $key2 => $value2) {
					$cantidadU = floatval($empaquesInfo['cantidad'][$key2]);
					$flag      = true;
					if($flag){
						if($value['Venta']['clase'] == "Especial"){
							$flag2 = true;
							if($value2 == '1'){
								if($representante['Representante']['sobre_espe'] != ""){
									$valor = $valor + (floatval($representante['Representante']['sobre_espe'])*$cantidadU);
									$flag  = false;
									$flag2 = false;
								}
							} else if($value2 == '2'){
								if($representante['Representante']['paquete_espe'] != ""){
									$valor = $valor + (floatval($representante['Representante']['paquete_espe'])*$cantidadU);
									$flag  = false;
									$flag2 = false;
								}
							} else if($value2 == '3'){
								if($representante['Representante']['caja_espe'] != ""){
									$valor = $valor + (floatval($representante['Representante']['caja_espe'])*$cantidadU);
									$flag  = false;
									$flag2 = false;
								}
							}
							if($flag2){
								if($representante['Representante']['base_espe'] != ""){
									$valor = $valor + (floatval($representante['Representante']['base_espe'])*$cantidadU);
									$flag  = false;
								}
							}
						}
					}
					if($flag){
						$negoEmp = $this->importModel('Negociacion')->find('first',array('conditions'=>array('Negociacion.representante'=>$repreId,'Negociacion.clientes'=>$value['Venta']['cliente'])));
						if(!empty($negoEmp)){
							$flag2 = true;
							if($value2 == '1'){
								if($negoEmp['Negociacion']['sobre_clie'] != ""){
									$valor = $valor + (floatval($negoEmp['Negociacion']['sobre_clie'])*$cantidadU);
									$flag  = false;
									$flag2 = false;
								}
							} else if($value2 == '2'){
								if($negoEmp['Negociacion']['paquete_clie'] != ""){
									$valor = $valor + (floatval($negoEmp['Negociacion']['paquete_clie'])*$cantidadU);
									$flag  = false;
									$flag2 = false;
								}
							} else if($value2 == '3'){
								if($negoEmp['Negociacion']['caja_clie'] != ""){
									$valor = $valor + (floatval($negoEmp['Negociacion']['caja_clie'])*$cantidadU);
									$flag  = false;
									$flag2 = false;
								}
							}
							if($flag2){
								$valor = $valor + (floatval($negoEmp['Negociacion']['base_clie'])*$cantidadU);
								$flag  = false;
							}
						}
					}
					if($flag){
						$flag2 = true;
						if($value2 == '1'){
							if($representante['Representante']['sobre'] != ""){
								$valor = $valor + (floatval($representante['Representante']['sobre'])*$cantidadU);
								$flag2 = false;
							}
						} else if($value2 == '2'){
							if($representante['Representante']['paquete'] != ""){
								$valor = $valor + (floatval($representante['Representante']['paquete'])*$cantidadU);
								$flag2 = false;
							}
						} else if($value2 == '3'){
							if($representante['Representante']['caja'] != ""){
								$valor = $valor + (floatval($representante['Representante']['caja'])*$cantidadU);
								$flag2 = false;
							}
						}
						if($flag2){
							$valor = $valor + (floatval($representante['Representante']['base'])*$cantidadU);
						}
					}
					$cantidad = $cantidad + $cantidadU;
				}
				$rangos = json_decode($representante['Representante']['rangos'],true);
				foreach ($rangos['datos'] as $key3 => $value3) {
					if($value3['desde'] <= $cantidad && $cantidad <= $value3['hasta'] ){
						$valor = $valor - ($valor * (floatval($value3['porcentaje']/100)));
					}
				}
				$data[$value['Venta']['id']] = $valor;
				$valorTotal = $valorTotal + $valor;
			}
			
		}

		$data['valor']    = $valorTotal;
		$data['digita']   = $valorDigita;
		$data['confirma'] = $valorConfirm;
		$data['escanea']  = $valorEscanear;
		$data['fletes']   = $fletes;
		return $data;
	}

}
?>
