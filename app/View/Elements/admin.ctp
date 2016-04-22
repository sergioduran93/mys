<li class="dropdown menuP">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Base de Datos<b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li><?php echo $this->Html->link('Gestión',array('controller'=>'departamentos','action'=>'listar')); ?></li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Tarifa General</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Tarifas',array('controller'=>'tarifas','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Descuentos',array('controller'=>'tarifas','action'=>'tarifaDescuentos')); ?></li>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Convenios</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Tarifas',array('controller'=>'tarifas','action'=>'convenios')); ?></li>
				<li><?php echo $this->Html->link('Descuentos',array('controller'=>'tarifas','action'=>'conveniosDescuentos')); ?></li>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Clientes y Remitentes</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Clientes',array('controller'=>'clientes','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Remitentes',array('controller'=>'remitentes','action'=>'crear')); ?></li>
			</ul>
		</li>
		<li>
			<?php echo $this->Html->link('Conductores/Propietarios/Tenedores',array('controller'=>'conductores','action'=>'crear')); ?>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Vehiculos</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Vehiculos',array('controller'=>'vehiculos','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Vehiculos Negociación',array('controller'=>'vehiculos','action'=>'negociacion')); ?></li>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Representantes</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Crear Representantes',array('controller'=>'representantes','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Lista Cuentas',array('controller'=>'representantes','action'=>'listacuentas')); ?></li>
				<li><?php echo $this->Html->link('Lista Representantes',array('controller'=>'representantes','action'=>'listarepresentantes')); ?></li>
				<li><?php echo $this->Html->link('Credito',array('controller'=>'creditos','action'=>'nuevo')); ?></li>
				<!--<li><?php echo $this->Html->link('Historial Credito',array('controller'=>'creditos','action'=>'nuevo')); ?></li>-->
			</ul>
		</li>
		<li>
			<?php echo $this->Html->link('Transportadoras y agencias',array('controller'=>'transportadoras','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Actualizar plantilla x pagar',array('controller'=>'planillas','action'=>'actualizar')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Destinatarios',array('controller'=>'destinatarios','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Anticipos Caja',array('controller'=>'anticipos','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Oficinas',array('controller'=>'oficinas','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Novedades',array('controller'=>'novedades','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Auxiliares de Bodega',array('controller'=>'auxiliares','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Areas',array('controller'=>'areas','action'=>'crear')); ?>
		</li>
	</ul>
</li>
<li class="dropdown menuP">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Movimientos<b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Trazabilidad</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Guias',array('controller'=>'Ventas','action'=>'trazabilidad')); ?></li>
				<li><?php echo $this->Html->link('Reempaques',array('controller'=>'reempaques','action'=>'trazabilidad')); ?></li>
				<li><?php echo $this->Html->link('Despachos',array('controller'=>'despachos','action'=>'trazabilidad')); ?></li>
			</ul>
		</li>
		<li>
			<?php echo $this->Html->link('Control recogidas',array('controller'=>'recogidas','action'=>'listar')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Cotizar Ventas',array('controller'=>'liquidar','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Anular Guia',array('controller'=>'Ventas','action'=>'anular')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Ingreso de Mercancia',array('controller'=>'ingresos','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Notas de devolución',array('controller'=>'Ventas','action'=>'notaDevolucion')); ?>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Ventas Oficina</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Contado',array('controller'=>'Ventas','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Credito',array('controller'=>'VentasCredito','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Contraentrega',array('controller'=>'VentasContraentrega','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Credicontado',array('controller'=>'VentasCredicontado','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Especial',array('controller'=>'VentasEspecial','action'=>'crear')); ?></li>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Ventas Representante</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Contado',array('controller'=>'VentasRepre','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Credito',array('controller'=>'VentasCreditoRepre','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Contraentrega',array('controller'=>'VentasContraentregaRepre','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Especial',array('controller'=>'VentasEspecialRepre','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Reliquidar',array('controller'=>'Ventas','action'=>'reliquidar')); ?></li>
				<li><?php echo $this->Html->link('Actualizar recibo (Natural)',array('controller'=>'recibos','action'=>'naturalrepre')); ?></li>
				<li><?php echo $this->Html->link('Actualizar recibo (Juridica)',array('controller'=>'recibos','action'=>'juridicarepre')); ?></li>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Ventas Clientes</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Importar Guias',array('controller'=>'VentasCredito','action'=>'importar')); ?></li>
				<li><?php echo $this->Html->link('Reliquidar Guias',array('controller'=>'VentasCredito','action'=>'reliquidar')); ?></li>
				<li><?php echo $this->Html->link('Venta Cliente',array('controller'=>'VentasCredito','action'=>'clientes')); ?></li>
				<li><?php echo $this->Html->link('Planilla de Relación',array('controller'=>'VentasCredito','action'=>'relacion')); ?></li>
				<li><?php echo $this->Html->link('Leonisa Guias',array('controller'=>'Ventas','action'=>'leonisa')); ?></li>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Despachos</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Persona Juridica',array('controller'=>'recibos','action'=>'juridica')); ?></li>
				<li class="dropdown-submenu">
					<a tabindex="-1" href="#">Persona Natural</a>
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link('Actualizar recibo',array('controller'=>'recibos','action'=>'natural')); ?></li>
						<li><?php echo $this->Html->link('Planilla Despacho',array('controller'=>'despachos','action'=>'crear')); ?></li>
						<li><?php echo $this->Html->link('Planilla Despacho Especial',array('controller'=>'despachos','action'=>'crear2')); ?></li>
					</ul>
				</li>
				<li><?php echo $this->Html->link('Despacho Virtual',array('controller'=>'despachos','action'=>'virtual')); ?></li>
				<li><?php echo $this->Html->link('Planilla Reempaque',array('controller'=>'reempaques','action'=>'crear')); ?></li>
				<li><?php echo $this->Html->link('Traslado Local',array('controller'=>'despachos','action'=>'traslado')); ?></li>
				<li><?php echo $this->Html->link('Traslado Nacional',array('controller'=>'reempaques','action'=>'traslado')); ?></li>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a tabindex="-1" href="#">Despachos Representantes</a>
			<ul class="dropdown-menu">
				<li><?php echo $this->Html->link('Persona Juridica',array('controller'=>'recibos','action'=>'juridicaRepre')); ?></li>
				<li><?php echo $this->Html->link('Persona Natural',array('controller'=>'recibos','action'=>'naturalRepre')); ?></li>
			</ul>
		</li>
		<li>
			<?php echo $this->Html->link('Confirmar entregas',array('controller'=>'Ventas','action'=>'confirmacion')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Escanear',array('controller'=>'Ventas','action'=>'escanear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Ver',array('controller'=>'Ventas','action'=>'ver')); ?>
		</li>
	</ul>
</li>
<li class="dropdown menuP">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Informes<b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li><?php echo $this->Html->link('Mercancia sin despachar',array('controller'=>'Ventas','action'=>'mercancia')); ?></li>
		<li><?php echo $this->Html->link('Cuadre de Caja',array('controller'=>'Ventas','action'=>'caja')); ?></li>
		<li><?php echo $this->Html->link('Cuenta Representantes',array('controller'=>'Ventas','action'=>'cuentaRepre')); ?></li>
		<li><?php echo $this->Html->link('Cuenta Clientes',array('controller'=>'Ventas','action'=>'clientes')); ?></li>
		<li><?php echo $this->Html->link('Ingreso de mercancia',array('controller'=>'ingresos','action'=>'listar')); ?></li>
		<li><?php echo $this->Html->link('Movilización x Cliente',array('controller'=>'Ventas','action'=>'movCliente')); ?></li>
		<li><?php echo $this->Html->link('Movilización x Transportadora',array('controller'=>'Ventas','action'=>'movJuridica')); ?></li>
		<li><?php echo $this->Html->link('Movilización x Conductor',array('controller'=>'Ventas','action'=>'movNatural')); ?></li>
		<li><?php echo $this->Html->link('Movilización Credicontado',array('controller'=>'VentasCredicontado','action'=>'movCredicontado')); ?></li>
		<li><?php echo $this->Html->link('Despachos para el Representante',array('controller'=>'Ventas','action'=>'despachoRepre')); ?></li>
		<li><?php echo $this->Html->link('Despachos x Representante',array('controller'=>'Ventas','action'=>'despachoXRepre')); ?></li>
		<li><?php echo $this->Html->link('Mercancia Confirmada',array('controller'=>'Ventas','action'=>'merConfirmada')); ?></li>
	</ul>
</li>
<li class="dropdown menuP">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Facturación<b class="caret"></b></a>
	<ul class="dropdown-menu">
	<li class="dropdown-submenu">
	<a tabindex="-1" href="#">Facturación</a>
			<ul class="dropdown-menu">
		<li>
			<?php echo $this->Html->link('Facturar',array('controller'=>'facturas','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Lista de Facturas',array('controller'=>'facturas','action'=>'listafacturas')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Lista de Cartera',array('controller'=>'facturas','action'=>'listacartera')); ?>
		</li>
		</ul>
		</li>
		<li class="dropdown-submenu">
		<a tabindex="-1" href="#">Relacion Facturación</a>
			<ul class="dropdown-menu">
		<li>
			<?php echo $this->Html->link('Relacion Facturación',array('controller'=>'ventas','action'=>'relacionfacturas')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Lista de Relaciones',array('controller'=>'relacionfacturas','action'=>'listarelaciones')); ?>
		</li>
		</ul>
		</li>
		<li>
			<?php echo $this->Html->link('Cuentas contables',array('controller'=>'cuentas','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Egresos',array('controller'=>'contables','action'=>'egresos')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Ingresos',array('controller'=>'contables','action'=>'ingresos')); ?>
		</li>
		
		
	</ul>
</li>
<li class="dropdown menuP">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li>
			<?php echo $this->Html->link('Listar usuarios',array('controller'=>'users','action'=>'listar')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Crear usuario',array('controller'=>'users','action'=>'crear')); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Tipos de Usuario',array('controller'=>'users','action'=>'roles')); ?>
		</li>
	</ul>
</li>