<?php
	$menuArray[0] = '<li>'.$this->Html->link('Gestión',array('controller'=>'departamentos','action'=>'listar')).'</li>';
	$menuArray[1] = '<li>'.$this->Html->link('Tarifas',array('controller'=>'tarifas','action'=>'crear')).'</li>';
	$menuArray[2] = '<li>'.$this->Html->link('Descuentos',array('controller'=>'tarifas','action'=>'tarifaDescuentos')).'</li>';
	$menuArray[3] = '<li>'.$this->Html->link('Tarifas',array('controller'=>'tarifas','action'=>'convenios')).'</li>';
	$menuArray[4] = '<li>'.$this->Html->link('Descuentos',array('controller'=>'tarifas','action'=>'conveniosDescuentos')).'</li>';
	$menuArray[5] = '<li>'.$this->Html->link('Clientes',array('controller'=>'clientes','action'=>'crear')).'</li>';
	$menuArray[6] = '<li>'.$this->Html->link('Remitentes',array('controller'=>'remitentes','action'=>'crear')).'</li>';
	$menuArray[7] = '<li>'.$this->Html->link('Conductores/Propietarios/Tenedores',array('controller'=>'conductores','action'=>'crear')).'</li>';
	$menuArray[8] = '<li>'.$this->Html->link('Vehiculos',array('controller'=>'vehiculos','action'=>'crear')).'</li>';
	$menuArray[9] = '<li>'.$this->Html->link('Vehiculos Negociación',array('controller'=>'vehiculos','action'=>'negociacion')).'</li>';
	$menuArray[10] = '<li>'.$this->Html->link('Representantes',array('controller'=>'representantes','action'=>'crear')).'</li>';
	$menuArray[11] = '<li>'.$this->Html->link('Transportadoras y agencias',array('controller'=>'transportadoras','action'=>'crear')).'</li>';
	$menuArray[12] = '<li>'.$this->Html->link('Actualizar plantilla x pagar',array('controller'=>'planillas','action'=>'actualizar')).'</li>';
	$menuArray[13] = '<li>'.$this->Html->link('Destinatarios',array('controller'=>'destinatarios','action'=>'crear')).'</li>';
	$menuArray[14] = '<li>'.$this->Html->link('Anticipos Caja',array('controller'=>'anticipos','action'=>'crear')).'</li>';
	$menuArray[15] = '<li>'.$this->Html->link('Oficinas',array('controller'=>'oficinas','action'=>'crear')).'</li>';
	$menuArray[16] = '<li>'.$this->Html->link('Novedades',array('controller'=>'novedades','action'=>'crear')).'</li>';
	$menuArray[17] = '<li>'.$this->Html->link('Auxiliares de Bodega',array('controller'=>'auxiliares','action'=>'crear')).'</li>';
	$menuArray[18] = '<li>'.$this->Html->link('Areas',array('controller'=>'areas','action'=>'crear')).'</li>';
	$menuArray[19] = '<li>'.$this->Html->link('Guias',array('controller'=>'ventas','action'=>'trazabilidad')).'</li>';
	$menuArray[20] = '<li>'.$this->Html->link('Reempaques',array('controller'=>'reempaques','action'=>'trazabilidad')).'</li>';
	$menuArray[21] = '<li>'.$this->Html->link('Despachos',array('controller'=>'despachos','action'=>'trazabilidad')).'</li>';
	$menuArray[22] = '<li>'.$this->Html->link('Control recogidas',array('controller'=>'recogidas','action'=>'listar')).'</li>';
	$menuArray[23] = '<li>'.$this->Html->link('Cotizar ventas',array('controller'=>'liquidar','action'=>'crear')).'</li>';
	$menuArray[24] = '<li>'.$this->Html->link('Anular Guia',array('controller'=>'ventas','action'=>'anular')).'</li>';
	$menuArray[25] = '<li>'.$this->Html->link('Ingreso de Mercancia',array('controller'=>'ingresos','action'=>'crear')).'</li>';
	$menuArray[26] = '<li>'.$this->Html->link('Contado',array('controller'=>'ventas','action'=>'crear')).'</li>';
	$menuArray[27] = '<li>'.$this->Html->link('Credito',array('controller'=>'ventascredito','action'=>'crear')).'</li>';
	$menuArray[28] = '<li>'.$this->Html->link('Contraentrega',array('controller'=>'ventascontraentrega','action'=>'crear')).'</li>';
	$menuArray[29] = '<li>'.$this->Html->link('Credicontado',array('controller'=>'ventascredicontado','action'=>'crear')).'</li>';
	$menuArray[30] = '<li>'.$this->Html->link('Especial',array('controller'=>'ventasespecial','action'=>'crear')).'</li>';
	$menuArray[31] = '<li>'.$this->Html->link('Contado',array('controller'=>'ventasrepre','action'=>'crear')).'</li>';
	$menuArray[32] = '<li>'.$this->Html->link('Credito',array('controller'=>'ventascreditorepre','action'=>'crear')).'</li>';
	$menuArray[33] = '<li>'.$this->Html->link('Contraentrega',array('controller'=>'ventascontraentregarepre','action'=>'crear')).'</li>';
	$menuArray[34] = '<li>'.$this->Html->link('Especial',array('controller'=>'ventasespecialrepre','action'=>'crear')).'</li>';
	$menuArray[35] = '<li>'.$this->Html->link('Actualizar recibo',array('controller'=>'recibos','action'=>'naturalrepre')).'</li>';
	$menuArray[36] = '<li>'.$this->Html->link('Importar Guias',array('controller'=>'ventascredito','action'=>'importar')).'</li>';
	$menuArray[37] = '<li>'.$this->Html->link('Reliquidar Guias',array('controller'=>'ventascredito','action'=>'reliquidar')).'</li>';
	$menuArray[38] = '<li>'.$this->Html->link('Venta Cliente',array('controller'=>'ventascredito','action'=>'clientes')).'</li>';
	$menuArray[39] = '<li>'.$this->Html->link('Planilla de Relación',array('controller'=>'ventascredito','action'=>'relacion')).'</li>';
	$menuArray[40] = '<li>'.$this->Html->link('Leonisa Guias',array('controller'=>'ventas','action'=>'leonisa')).'</li>';
	$menuArray[41] = '<li>'.$this->Html->link('Persona Juridica',array('controller'=>'recibos','action'=>'juridica')).'</li>';
	$menuArray[42] = '<li>'.$this->Html->link('Actualizar recibo',array('controller'=>'recibos','action'=>'natural')).'</li>';
	$menuArray[43] = '<li>'.$this->Html->link('Planilla Despacho',array('controller'=>'despachos','action'=>'crear')).'</li>';
	$menuArray[44] = '<li>'.$this->Html->link('Planilla Despacho Especial',array('controller'=>'despachos','action'=>'crear2')).'</li>';
	$menuArray[45] = '<li>'.$this->Html->link('Despacho Virtual',array('controller'=>'despachos','action'=>'virtual')).'</li>';
	$menuArray[46] = '<li>'.$this->Html->link('Planilla Reempaque',array('controller'=>'reempaques','action'=>'crear')).'</li>';
	$menuArray[47] = '<li>'.$this->Html->link('Traslado Local',array('controller'=>'despachos','action'=>'traslado')).'</li>';
	$menuArray[48] = '<li>'.$this->Html->link('Traslado Nacional',array('controller'=>'reempaques','action'=>'traslado')).'</li>';
	$menuArray[49] = '<li>'.$this->Html->link('Persona Juridica',array('controller'=>'recibos','action'=>'juridicarepre')).'</li>';
	$menuArray[50] = '<li>'.$this->Html->link('Persona Natural',array('controller'=>'recibos','action'=>'naturalrepre')).'</li>';
	$menuArray[51] = '<li>'.$this->Html->link('Confirmar entregas',array('controller'=>'ventas','action'=>'confirmacion')).'</li>';
	$menuArray[52] = '<li>'.$this->Html->link('Escanear',array('controller'=>'ventas','action'=>'escanear')).'</li>';
	$menuArray[53] = '<li>'.$this->Html->link('Ver',array('controller'=>'ventas','action'=>'ver')).'</li>';
	$menuArray[54] = '<li>'.$this->Html->link('Mercancia sin despachar',array('controller'=>'ventas','action'=>'mercancia')).'</li>';
	$menuArray[55] = '<li>'.$this->Html->link('Cuadre de Caja',array('controller'=>'ventas','action'=>'caja')).'</li>';
	$menuArray[56] = '<li>'.$this->Html->link('Cuenta Representantes',array('controller'=>'ventas','action'=>'representantes')).'</li>';
	$menuArray[57] = '<li>'.$this->Html->link('Cuenta Clientes',array('controller'=>'ventas','action'=>'clientes')).'</li>';
	$menuArray[58] = '<li>'.$this->Html->link('Ingreso de mercancia',array('controller'=>'ingresos','action'=>'listar')).'</li>';
	$menuArray[59] = '<li>'.$this->Html->link('Movilización x Cliente',array('controller'=>'ventas','action'=>'movCliente')).'</li>';
	$menuArray[60] = '<li>'.$this->Html->link('Movilización x Transportadora',array('controller'=>'ventas','action'=>'movJuridica')).'</li>';
	$menuArray[61] = '<li>'.$this->Html->link('Movilización x Conductor',array('controller'=>'ventas','action'=>'movNatural')).'</li>';
	$menuArray[62] = '<li>'.$this->Html->link('Despachos para el Representante',array('controller'=>'ventas','action'=>'despachoRepre')).'</li>';
	$menuArray[63] = '<li>'.$this->Html->link('Despachos x Representante',array('controller'=>'ventas','action'=>'despachoXRepre')).'</li>';
	$menuArray[64] = '<li>'.$this->Html->link('Mercancia Confirmada',array('controller'=>'ventas','action'=>'merConfirmada')).'</li>';
	$menuArray[65] = '<li>'.$this->Html->link('Listar usuarios',array('controller'=>'users','action'=>'listar')).'</li>';
	$menuArray[66] = '<li>'.$this->Html->link('Crear usuario',array('controller'=>'users','action'=>'crear')).'</li>';
	$menuArray[67] = '<li>'.$this->Html->link('Tipos de Usuario',array('controller'=>'users','action'=>'roles')).'</li>';
	$menu = json_decode($menu,true);

	echo '<li class="dropdown menuP"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Base de Datos<b class="caret"></b></a><ul class="dropdown-menu">';
	echo in_array(0, $menu) ? $menuArray[0] : "";
	if(in_array(1, $menu) || in_array(2, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Tarifa General</a><ul class="dropdown-menu">';
		echo in_array(1, $menu) ? $menuArray[1] : "";
		echo in_array(2, $menu) ? $menuArray[2] : "";
		echo '</ul></li>';
	}
	if(in_array(3, $menu) || in_array(4, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Convenios</a><ul class="dropdown-menu">';
		echo in_array(3, $menu) ? $menuArray[3] : "";
		echo in_array(4, $menu) ? $menuArray[4] : "";
		echo '</ul></li>';
	}
	if(in_array(5, $menu) || in_array(6, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Clientes</a><ul class="dropdown-menu">';
		echo in_array(5, $menu) ? $menuArray[5] : "";
		echo in_array(6, $menu) ? $menuArray[6] : "";
		echo '</ul></li>';
	}
	echo in_array(7, $menu) ? $menuArray[7] : "";
	if(in_array(8, $menu) || in_array(9, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Vehiculos</a><ul class="dropdown-menu">';
		echo in_array(8, $menu) ? $menuArray[8] : "";
		echo in_array(9, $menu) ? $menuArray[9] : "";
		echo '</ul></li>';
	}
	echo in_array(10, $menu) ? $menuArray[10] : "";
	echo in_array(11, $menu) ? $menuArray[11] : "";
	echo in_array(12, $menu) ? $menuArray[12] : "";
	echo in_array(13, $menu) ? $menuArray[13] : "";
	echo in_array(14, $menu) ? $menuArray[14] : "";
	echo in_array(15, $menu) ? $menuArray[15] : "";
	echo in_array(16, $menu) ? $menuArray[16] : "";
	echo in_array(17, $menu) ? $menuArray[17] : "";
	echo in_array(18, $menu) ? $menuArray[18] : "";
	echo '</ul></li><li class="dropdown menuP"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Movimientos<b class="caret"></b></a><ul class="dropdown-menu">';
	if(in_array(19, $menu) || in_array(20, $menu) || in_array(21, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Trazabilidad</a><ul class="dropdown-menu">';
		echo in_array(19, $menu) ? $menuArray[19] : "";
		echo in_array(20, $menu) ? $menuArray[20] : "";
		echo in_array(21, $menu) ? $menuArray[21] : "";
		echo '</ul></li>';
	}
	echo in_array(22, $menu) ? $menuArray[22] : "";
	echo in_array(23, $menu) ? $menuArray[23] : "";
	echo in_array(24, $menu) ? $menuArray[24] : "";
	echo in_array(25, $menu) ? $menuArray[25] : "";
	if(in_array(26, $menu) || in_array(27, $menu) || in_array(28, $menu) || in_array(29, $menu) || in_array(30, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Ventas Oficina</a><ul class="dropdown-menu">';
		echo in_array(26, $menu) ? $menuArray[26] : "";
		echo in_array(27, $menu) ? $menuArray[27] : "";
		echo in_array(28, $menu) ? $menuArray[28] : "";
		echo in_array(29, $menu) ? $menuArray[29] : "";
		echo in_array(30, $menu) ? $menuArray[30] : "";
		echo '</ul></li>';
	}
	if(in_array(31, $menu) || in_array(32, $menu) || in_array(33, $menu) || in_array(34, $menu) || in_array(35, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Ventas Representante</a><ul class="dropdown-menu">';
		echo in_array(31, $menu) ? $menuArray[31] : "";
		echo in_array(32, $menu) ? $menuArray[32] : "";
		echo in_array(33, $menu) ? $menuArray[33] : "";
		echo in_array(34, $menu) ? $menuArray[34] : "";
		echo in_array(35, $menu) ? $menuArray[35] : "";
		echo '</ul></li>';
	}
	if(in_array(36, $menu) || in_array(37, $menu) || in_array(38, $menu) || in_array(39, $menu) || in_array(40, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Ventas Clientes</a><ul class="dropdown-menu">';
		echo in_array(36, $menu) ? $menuArray[36] : "";
		echo in_array(37, $menu) ? $menuArray[37] : "";
		echo in_array(38, $menu) ? $menuArray[38] : "";
		echo in_array(39, $menu) ? $menuArray[39] : "";
		echo in_array(40, $menu) ? $menuArray[40] : "";
		echo '</ul></li>';
	}
	if(in_array(41, $menu) || in_array(42, $menu) || in_array(43, $menu) || in_array(44, $menu) || in_array(45, $menu) || in_array(46, $menu) || in_array(47, $menu) || in_array(48, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Despachos</a><ul class="dropdown-menu">';
		echo in_array(41, $menu) ? $menuArray[41] : "";
		if(in_array(42, $menu) || in_array(43, $menu) || in_array(44, $menu)){
			echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Persona Natural</a><ul class="dropdown-menu">';
			echo in_array(42, $menu) ? $menuArray[42] : "";
			echo in_array(43, $menu) ? $menuArray[43] : "";
			echo in_array(44, $menu) ? $menuArray[44] : "";
			echo '</ul></li>';
		}
		echo in_array(45, $menu) ? $menuArray[45] : "";
		echo in_array(46, $menu) ? $menuArray[46] : "";
		echo in_array(47, $menu) ? $menuArray[47] : "";
		echo in_array(48, $menu) ? $menuArray[48] : "";
		echo '</ul></li>';
	}
	if(in_array(49, $menu) || in_array(50, $menu)){
		echo '<li class="dropdown-submenu"><a tabindex="-1" href="#">Despachos Representantes</a><ul class="dropdown-menu">';
		echo in_array(49, $menu) ? $menuArray[49] : "";
		echo in_array(50, $menu) ? $menuArray[50] : "";
		echo '</ul></li>';
	}
	echo in_array(51, $menu) ? $menuArray[51] : "";
	echo in_array(52, $menu) ? $menuArray[52] : "";
	echo in_array(53, $menu) ? $menuArray[53] : "";
	echo '</ul></li><li class="dropdown menuP"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Informes<b class="caret"></b></a><ul class="dropdown-menu">';
	echo in_array(54, $menu) ? $menuArray[54] : "";
	echo in_array(55, $menu) ? $menuArray[55] : "";
	echo in_array(56, $menu) ? $menuArray[56] : "";
	echo in_array(57, $menu) ? $menuArray[57] : "";
	echo in_array(58, $menu) ? $menuArray[58] : "";
	echo in_array(59, $menu) ? $menuArray[59] : "";
	echo in_array(60, $menu) ? $menuArray[60] : "";
	echo in_array(61, $menu) ? $menuArray[61] : "";
	echo in_array(62, $menu) ? $menuArray[62] : "";
	echo in_array(63, $menu) ? $menuArray[63] : "";
	echo in_array(64, $menu) ? $menuArray[64] : "";
	echo '</ul></li><li class="dropdown menuP"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<b class="caret"></b></a><ul class="dropdown-menu">';
	echo in_array(65, $menu) ? $menuArray[65] : "";
	echo in_array(66, $menu) ? $menuArray[66] : "";
	echo in_array(67, $menu) ? $menuArray[67] : "";
	echo '</ul></li>';
?>
