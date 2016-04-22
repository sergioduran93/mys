<?php
class RepresentantesController extends AppController {
	public $name = 'Representantes';
public $components = array('RequestHandler', 'Session');
public $helpers = array('Html', 'Form', 'Time', 'Js');
public $paginate = array(
'limit' => 20,
'order' => array(
'Representante.id' => 'asc'
	)
	);



public function editar($id = null)
	{
		if(!$id)
		{
			throw new NotFoundException("Datos Invalidos");
		}
		$representante = $this->Representante->findById($id);
		if(!$representante)
		{
			throw new NotFoundException("El representante no ha sido encontrado");
		}
		if($this->request->is('post', 'put'))
		{
			$this->Representante->id = $id;
			if($this->Representante->save($this->request->data))
			{
				$this->Session->setFlash('El representante ha sido modificado', $element = 'default', $params = array('class' => 'success'));
				return $this->redirect(array('action' => 'listarepresentantes'));
			}
			$this->Session->setFlash('El registro no pudo ser modificado.');
		}
		if(!$this->request->data)
		{
			$this->request->data = $representante;
		}
	}

	public function crear($id = null) {
		$role = $this->data['Representante']['role'];
		if(!empty($this->data) && $role != 5 && $role != 6){
			$desti = $this->data['Representante']['destinos'];
			if($this->data['Representante']['id'] == ""){
				$this->Representante->create();
				App::import('model', 'Destinatario');
				$destinatarioImport                             = new Destinatario();
				$destinatarioNuevo['Destinatario']              = $this->data['Representante'];
				$destinatarioNuevo['Destinatario']['documento'] = $destinatarioNuevo['Destinatario']['identificacion'];
				$destinatarioNuevo['Destinatario']['telefono']  = $destinatarioNuevo['Destinatario']['telefono1'];
				$destinatarioNuevo['Destinatario']['destinos']  = json_encode($desti);
				$destinatarioNuevo['Destinatario']['tipo']      = 'Natural';
				$destinatarioImport->create();
				$destinatarioImport->save($destinatarioNuevo);
				$this->Representante->create();
				$this->Representante->save($this->data);
				$rxd['Representantexdestino']['representante_id'] = $this->Representante->id;
				$neg['Negociacion']['representante']              = $this->Representante->id;
			} else {				
				$this->Representante->save($this->data);
				$this->Representante->Representantexdestino->deleteAll(array('Representantexdestino.representante_id'=>$this->data['Representante']['id']));
				$this->Representante->importModel('Negociacion')->deleteAll(array('Negociacion.representante'=>$this->data['Representante']['id']));
				$rxd['Representantexdestino']['representante_id'] = $this->data['Representante']['id'];
				$neg['Negociacion']['representante']              = $this->data['Representante']['id'];
			}
			foreach ($desti as $key3 => $value3) {
				$this->Representante->Representantexdestino->create();
				$rxd['Representantexdestino']['destino_id'] = $value3;
				$this->Representante->Representantexdestino->save($rxd);
			}

			foreach ($this->data['Representante']['clientes'] as $key => $value) {
				$neg['Negociacion']['base_clie']    = $this->data['Representante']['base_clie'][$key];
				$neg['Negociacion']['caja_clie']    = $this->data['Representante']['caja_clie'][$key];
				$neg['Negociacion']['sobre_clie']   = $this->data['Representante']['sobre_clie'][$key];
				$neg['Negociacion']['paquete_clie'] = $this->data['Representante']['paquete_clie'][$key];
				$neg['Negociacion']['clientes']     = $this->data['Representante']['clientes'][$key];
				$this->Representante->importModel('Negociacion')->save($neg);
			}
		}
		$this->data = null;
		$tipo           = $this->Representante->getEnumValues('tipo');
		$marca          = $this->Representante->getEnumValues('marca');
		$oficina        = $this->Representante->getEnumValues('oficina');
		$banco          = $this->Representante->getEnumValues('banco');
		$tipo           = $this->Representante->getEnumValues('tipo');
		$contraentrega  = $this->Representante->getEnumValues('contraentrega');
		$servicio       = $this->Representante->getEnumValues('servicio');
		$giro           = $this->Representante->getEnumValues('giro');
		$destinos       = $this->Representante->importModel('Destino')->find('list');
		$representantes = $this->Representante->find('all',array('recursive'=>-1));
		$clientes       = $this->Representante->importModel('Cliente')->find('list',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		$empaques       = $this->Representante->importModel('Empaque')->find('list',array('recursive'=>-1));
		foreach ($representantes as $key => $value) {
			$des    = $this->Representante->Representantexdestino->find('all',array('recursive'=>-1,'fields'=>array('Representantexdestino.destino_id'),'conditions'=>array('Representantexdestino.representante_id'=>$value['Representante']['id'])));
			$neg    = $this->Representante->importModel('Negociacion')->find('all',array('recursive'=>-1,'order'=>'Negociacion.clientes','conditions'=>array('Negociacion.representante'=>$value['Representante']['id'])));
			$desti  = array();
			$negoci = array();
			foreach ($des as $key2 => $value2) {
				$desti[] = $value2['Representantexdestino']['destino_id'];
			}
			$representantes[$key]['Representante']['destinos']    = $desti;
			$representantes[$key]['Representante']['negociacion'] = $neg;
		}
		$this->generateJSON('representantes', $representantes, array('Representante' => array('id','identificacion','codigo','listNombre','telefono1','celular','oficina')));
		
		$this->set(compact('id','empaques','clientes','oficina','banco','tipo','contraentrega','servicio','giro','destinos','representantes','negoci'));
	
	}

	public function rangos($repreId = null) {
		$this->layout = 'empty';
		if($repreId != null){
			$repre  = $this->Representante->find('first',array('recursive'=>-1,'conditions'=>array('Representante.id'=>$repreId),'fields'=>array('Representante.rangos')));
			$rangos = $repre['Representante']['rangos'];
		} else {
			$rangos['datos'] = '';
		}
		$this->set(compact('rangos'));
	}

		public function ver($id = null)
{
	if(!$id){
		throw new NotFoundException('Datos Invalidos');
	}
	$representante = $this->Representante->findById($id);
	if(!$representante){
		throw new NotFoundExceptio('El Representante no existe');
	}
	$this->set('representante', $representante);
	
}

	public function listarepresentantes(){
		$this->Representante->recursive=0;
		$this->paginate['Representante']['limit'] = 20;
		$this->paginate['Representante']['order'] = array('Representante.id' => 'asc');
		//$this->Paginator->settings = $this->paginate;

		$this->set('representantes', $this->paginate());

        if(!empty($this->data)){
	       $representante   = $this->Representante->find('all');
		   $this->generateJSON('listarepresentantes', $representante, array('Representante' => array('id')));
	}
	}

	
	public function crear3() {
		if(!empty($this->data)){
			$desti = $this->data['Representante']['destinos'];
			if($this->data['Representante']['id'] == ""){
				$this->Representante->create();
				$this->Representante->save($this->data);
				$rxd['Representantexdestino']['representante_id'] = $this->Representante->id;
				$neg['Negociacion']['representante']              = $this->Representante->id;
			} else {				
				$this->Representante->save($this->data);
				$this->Representante->Representantexdestino->deleteAll(array('Representantexdestino.representante_id'=>$this->data['Representante']['id']));
				$this->Representante->importModel('Negociacion')->deleteAll(array('Negociacion.representante'=>$this->data['Representante']['id']));
				$rxd['Representantexdestino']['representante_id'] = $this->data['Representante']['id'];
				$neg['Negociacion']['representante']              = $this->data['Representante']['id'];
			}

			foreach ($desti as $key3 => $value3) {
				$this->Representante->Representantexdestino->create();
				$rxd['Representantexdestino']['destino_id'] = $value3;
				$this->Representante->Representantexdestino->save($rxd);
			}

			foreach ($this->data['Representante']['sobreespecial'] as $key => $value) {
				$neg['Negociacion']['sobreespecial'] = $this->data['Representante']['sobreespecial'][$key];
				$neg['Negociacion']['digitar']       = $this->data['Representante']['digitar'][$key];
				$neg['Negociacion']['escanear']      = $this->data['Representante']['escanear'][$key];
				$neg['Negociacion']['rangos']        = $this->data['Representante']['rangos'][$key];
				$neg['Negociacion']['clientes']      = $this->data['Representante']['clientes'][$key];
				$this->Representante->importModel('Negociacion')->save($neg);
			}
		}
		$tipo           = $this->Representante->getEnumValues('tipo');
		$marca          = $this->Representante->getEnumValues('marca');
		$oficina        = $this->Representante->getEnumValues('oficina');
		$banco          = $this->Representante->getEnumValues('banco');
		$tipo           = $this->Representante->getEnumValues('tipo');
		$contraentrega  = $this->Representante->getEnumValues('contraentrega');
		$servicio       = $this->Representante->getEnumValues('servicio');
		$giro           = $this->Representante->getEnumValues('giro');
		$destinos       = $this->Representante->importModel('Destino')->find('list');
		$representantes = $this->Representante->find('all',array('recursive'=>-1));
		$clientes       = $this->Representante->importModel('Cliente')->find('list',array('recursive'=>-1,'conditions'=>array('Cliente.id >'=>1)));
		foreach ($representantes as $key => $value) {
			$des    = $this->Representante->Representantexdestino->find('all',array('recursive'=>-1,'fields'=>array('Representantexdestino.destino_id'),'conditions'=>array('Representantexdestino.representante_id'=>$value['Representante']['id'])));
			$neg    = $this->Representante->importModel('Negociacion')->find('all',array('recursive'=>-1,'order'=>'Negociacion.clientes','conditions'=>array('Negociacion.representante'=>$value['Representante']['id'])));
			$desti  = array();
			$negoci = array();
			foreach ($des as $key2 => $value2) {
				$desti[] = $value2['Representantexdestino']['destino_id'];
			}
			$representantes[$key]['Representante']['destinos']    = $desti;
			$representantes[$key]['Representante']['negociacion'] = $neg;
		}
		$this->generateJSON('representantes', $representantes, array('Representante' => array('id','identificacion','codigo','listNombre','telefono1','celular','oficina')));
		
		$this->set(compact('clientes','oficina','banco','tipo','contraentrega','servicio','giro','destinos','representantes','negoci'));
	
	}

	public function eliminar($id = null) {
		if($this->Representante->delete($id)){
	   		$this->Session->setFlash('','ok',array('mensaje'=>'El Representante se elimino con exito'));
		} else {
	   		$this->Session->setFlash('','error',array('mensaje'=>'El Representante no se pudo eliminar'));
		}
    	$this->redirect(array('action' => 'crear'));
	}
	function imprimir($id = null, $Remite = null, $Archiv = null, $Destin = null, $Prueba = null, $ReciboId = null, $ReciboRemi = null,  $ReciboArch = null){
		$venta = $this->Representante->importModel('Venta')->read(null,$id);
		if($ReciboId != null){
			$recibo                         = $this->Representante->importModel('Recibo')->read(null,$ReciboId);
			$envio['reciboInfo']            = $recibo['Recibo'];
			$destinoB                       = $this->Representante->importModel('Destino')->read(null,$recibo['Recibo']['destino']);
			$envio['reciboInfo']['destino'] = $destinoB['Destino']['nombre'];
			$usuarioB = $this->Representante->importModel('User')->read(null,$recibo['Recibo']['usuario']);
			$envio['reciboInfo']['user'] = $usuarioB['User']['listNombre'];

			if($ReciboRemi == '1'){
				$envio['recibo'][] = '**REMITENTE**';
			}
			if($ReciboArch == '1'){
				$envio['recibo'][] = '**ARCHIVO**';
			}
		}
		
		if($Remite == '1'){
			$envio['hoja'][] = '**REMITENTE**';
		}
		if($Archiv == '1'){
			$envio['hoja'][] = '**ARCHIVO**';
		}
		if($Destin == '1'){
			$envio['hoja'][] = '**DESTINATARIO**';
		}
		if($Prueba == '1'){
			$envio['hoja'][] = '**PRUEBA DE ENTREGA**';
		}
		$envio['n']            = count($envio['hoja']);
		$envio['guia']         = $venta['Venta']['remesa'];
		$envio['contactoR']    = $venta['Venta']['contacto'];
		$envio['contactoTelR'] = $venta['Venta']['contacto_tel'];
		$oficinaB              = $this->Representante->importModel('Oficina')->find('first',array('recursive'=>-1,'fields'=>array('nombre','hasta','desde','resolucion','prefijo','codigo'),'conditions'=>array('Oficina.id'=>$venta['Venta']['oficina'])));
		$envio['oficina']      = $oficinaB['Oficina']['nombre'];
		$envio['resolucion']   = 'Res. '.$oficinaB['Oficina']['resolucion'].' Autoriza del: '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['desde'].' al '.$oficinaB['Oficina']['prefijo'].$oficinaB['Oficina']['hasta'];
		$envio['fecha']        = $venta['Venta']['fecha'];
		$envio['vence']        = $venta['Venta']['fecha'];
		$envio['factura']      = $venta['Venta']['facturacion'];
		$envio['servicio']     = 'Envío de Encomiendas';
		$envio['docRef']       = $venta['Venta']['tipo'].' '.$venta['Venta']['documento1'].' '.$venta['Venta']['documento2'].' '.$venta['Venta']['documento3'];
		$envio['hora']         = $venta['Venta']['hora'];
		$envio['cliente']      = $venta['Venta']['nombreClien'];
		$envio['nit']          = $venta['Venta']['documentoClien'];
		$envio['direccionC']   = $venta['Venta']['direccionClien'];
		$envio['telefonoC']    = $venta['Venta']['telefonoClien'];
		$envio['otro_remi']    = $venta['Venta']['otro_remi'];
		if($venta['Venta']['otro_remi'] == 0){
			$envio['otro_remi']  = false;
			$envio['remitente']  = "";
			$envio['nitR']       = "";
			$envio['direccionR'] = "";
			$envio['telefonoR']  = "";
		} else {
			$envio['otro_remi']  = true;
			$envio['remitente']  = $venta['Venta']['nombreRemi'];
			$envio['nitR']       = $venta['Venta']['documentoRemi'];
			$envio['direccionR'] = $venta['Venta']['direccionRemi'];
			$envio['telefonoR']  = $venta['Venta']['telefonoRemi'];		
		}
		
		$origenB               = $this->Representante->importModel('Destino')->read(null,$venta['Venta']['origen']);
		$destinoB              = $this->Representante->importModel('Destino')->read(null,$venta['Venta']['destino']);
		$envio['origen']       = $origenB['Destino']['nombre'];
		$envio['destino']      = $destinoB['Destino']['nombre'];
		$destinatarioB         = $this->Representante->importModel('Destinatario')->read(null,$venta['Venta']['destinatario']);
		$contactoB             = json_decode($destinatarioB['Destinatario']['contacto'],true);
		$envio['destinatario'] = $venta['Venta']['nombreDest'];
		$envio['ced']          = $venta['Venta']['documentoDest'];
		$envio['direccionD']   = $venta['Venta']['direccionDest'];
		$envio['telefonoD1']   = $venta['Venta']['telefonoDest'];
		$envio['telefonoD2']   = $contactoB[0]['telefono'];
		$envio['contacto']     = $contactoB[0]['nombre'];
		$empaques_info         = json_decode($venta['Venta']['empaque_info'],true);
		$empaquesIguales       = true;
		$sumaFlete             = 0;
		$sumaCantidad          = 0;
		$sumaPeso              = 0;
		$sumaAlto              = 0;
		$sumaAncho             = 0;
		$sumaLargo             = 0;
		$sumaPesoVol           = 0;
		$empaqueAct            = $empaques_info['empaques'][0];
		foreach ($empaques_info['empaques'] as $key => $value) {
			$sumaFlete    = $sumaFlete + ($empaques_info['cantidad'][$key]*$empaques_info['valor'][$key]);
			$sumaLargo    = $sumaLargo + $empaques_info['largo'][$key];
			$sumaAncho    = $sumaAncho + $empaques_info['ancho'][$key];
			$sumaAlto     = $sumaAlto + $empaques_info['alto'][$key];
			$sumaPeso     = $sumaPeso + ($empaques_info['cantidad'][$key]*$empaques_info['peso'][$key]);
			$sumaCantidad = $sumaCantidad + $empaques_info['cantidad'][$key];
			$sumaPesoVol  = $sumaPesoVol + ($empaques_info['cantidad'][$key]*(($empaques_info['largo'][$key]/100)*($empaques_info['ancho'][$key]/100)*($empaques_info['alto'][$key]/100)*400));
			
			if(($empaqueAct != $empaques_info['empaques'][$key]) && ($empaquesIguales)){
				$empaquesIguales = false;
			}
		}
		if($empaquesIguales){
			$empaqueB = $this->Representante->importModel('Empaque')->read(null, $empaqueAct);
			$envio['empaque'] = $empaqueB['Empaque']['nombre'];
		} else {
			$envio['empaque'] = 'Otros empaques';
		}
		$envio['cantidad']    = $sumaCantidad;
		$envio['peso']        = $sumaPeso;
		$envio['pesoVol']     = $sumaPesoVol;
		if(count($empaques_info['empaques']) > 1){
			$envio['largo']   = "";
			$envio['ancho']   = "";
			$envio['alto']    = "";
		} else {
			$envio['largo']   = $sumaLargo;
			$envio['ancho']   = $sumaAncho;
			$envio['alto']    = $sumaAlto;
		}

		$envio['barras']      = $venta['Venta']['barras'];
		$envio['observacion'] = $venta['Venta']['observaciones'];
		$envio['contenido']   = $venta['Venta']['contenido'];
		$decla                = str_replace(".",",",str_replace(",","",$venta['Venta']['declarado']));
		$envio['valorDecla']  = number_format(floatval($decla),0,'.',',');
		$envio['valorFlete']  = number_format($sumaFlete,0,'.',',');

		$usuarioB              = $this->Representante->importModel('User')->read(null,$venta['Venta']['usuario']);
		$envio['nombre']       = $usuarioB['User']['name'].' '.$usuarioB['User']['lastname'];
		$envio['formaPago']    = 'CONTADO';
		$envio['kiloAd']       = number_format($venta['Venta']['kilo_adic'],0,'.',',');
		$envio['valorKiloAd']  = number_format($venta['Venta']['valor_kilo_adic'],0,'.',',');
		$envio['descFlete']    = number_format($venta['Venta']['desc_flete'],0,'.',',');
		$envio['descKilo']     = number_format($venta['Venta']['desc_kilo'],0,'.',',');
		$envio['valorFirmado'] = number_format($venta['Venta']['valor_devolucion'],0,'.',',');
		$envio['valorSeguro']  = number_format($venta['Venta']['valor_seguro'],0,'.',',');
		$envio['valorTotal']   = number_format($venta['Venta']['valor_total'],0,'.',',');
		$envio['kiloNegoc']    = $venta['Venta']['kilo_nego'];

		$this->set(compact('envio'));
	//	$this->layout = 'pdf'; 
	//	$this->render(); 
	}

}

?>
