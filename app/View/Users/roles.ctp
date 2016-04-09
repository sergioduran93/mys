	<div><h3><center>USUARIOS</center></h3></div>
	<fieldset>
	<?php echo $this->Form->create('User',array('class'=>'form-inline'));?>
	<div class="form-group col-md-12">
		<div class="col-md-6"><?php echo $this->Form->input('role_id',array('label'=>'Tipo de Usuario','type'=>'select','options'=>$roles,'empty'=>''));?></div>
	</div>
	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id" style="width:100% !important;">
		<thead>
			<tr>
				<th>Formulario</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Actualizar planilla x pagar</td>
				<td><input type='hidden' name='data[User][Link][Planillas/actualizar]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Planillas/actualizar]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Actualizar Recibo (Juridica)</td>
				<td><input type='hidden' name='data[User][Link][Recibos/juridica]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Recibos/juridica]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Actualizar Recibo (Natural)</td>
				<td><input type='hidden' name='data[User][Link][Recibos/natural]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Recibos/natural]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Actualizar Recibo Representante (Juridica)</td>
				<td><input type='hidden' name='data[User][Link][Recibos/juridicarepre]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Recibos/juridicarepre]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Actualizar Recibo Representante (Natural)</td>
				<td><input type='hidden' name='data[User][Link][Recibos/naturalrepre]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Recibos/naturalrepre]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Anticipos Caja</td>
				<td><input type='hidden' name='data[User][Link][Anticipos/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Anticipos/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Anular Guia</td>
				<td><input type='hidden' name='data[User][Link][Ventas/anular]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/anular]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Areas</td>
				<td><input type='hidden' name='data[User][Link][Areas/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Areas/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Auditoria</td>
				<td><input type='hidden' name='data[User][Link][Users/auditoria]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Users/auditoria]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Auxiliares de Bodega</td>
				<td><input type='hidden' name='data[User][Link][Auxiliares/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Auxiliares/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Clientes</td>
				<td><input type='hidden' name='data[User][Link][Clientes/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Clientes/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Conductores/Propietarios/Tenedores</td>
				<td><input type='hidden' name='data[User][Link][Conductores/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Conductores/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Confirmar Entregas</td>
				<td><input type='hidden' name='data[User][Link][Ventas/confirmacion]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/confirmacion]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Control Recogidas</td>
				<td><input type='hidden' name='data[User][Link][Recogidas/listar]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Recogidas/listar]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Convenios</td>
				<td><input type='hidden' name='data[User][Link][Tarifas/convenios]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Tarifas/convenios]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Cotizar venta</td>
				<td><input type='hidden' name='data[User][Link][Liquidar/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Liquidar/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Cuadre de Caja</td>
				<td><input type='hidden' name='data[User][Link][Ventas/caja]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/caja]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Cuenta Cliente</td>
				<td><input type='hidden' name='data[User][Link][Ventas/clientes]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/clientes]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Cuenta Representantes</td>
				<td><input type='hidden' name='data[User][Link][Ventas/representantes]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/representantes]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Despacho Virtual</td>
				<td><input type='hidden' name='data[User][Link][Despachos/virtual]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Despachos/virtual]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Destinatarios</td>
				<td><input type='hidden' name='data[User][Link][Destinatarios/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Destinatarios/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Escanear</td>
				<td><input type='hidden' name='data[User][Link][Ventas/escanear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/escanear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/listar]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/listar]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Editar Departamento)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/editarDepartamento]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/editarDepartamento]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Editar Destino)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/editarDestino]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/editarDestino]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Editar Empaque)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/editarEmpaque]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/editarEmpaque]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Editar Mercancia)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/editarMercancia]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/editarMercancia]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Editar Región)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/editarRegion]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/editarRegion]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Eliminar Departamento)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/eliminarDepartamento]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/eliminarDepartamento]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Eliminar Destino)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/eliminarDestino]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/eliminarDestino]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Eliminar Empaque)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/eliminarEmpaque]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/eliminarEmpaque]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Eliminar Mercancia)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/eliminarMercancia]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/eliminarMercancia]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Gestión (Eliminar Región)</td>
				<td><input type='hidden' name='data[User][Link][Departamentos/eliminarRegion]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Departamentos/eliminarRegion]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Ingreso de Mercancia</td>
				<td><input type='hidden' name='data[User][Link][Ingresos/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ingresos/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Ingreso de Mercancia (Informe)</td>
				<td><input type='hidden' name='data[User][Link][Ingresos/listar]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ingresos/listar]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Mercancia sin Despachar</td>
				<td><input type='hidden' name='data[User][Link][Ventas/mercancia]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/mercancia]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Novedades</td>
				<td><input type='hidden' name='data[User][Link][Novedades/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Novedades/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Oficinas</td>
				<td><input type='hidden' name='data[User][Link][Oficinas/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Oficinas/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Planilla de Despacho</td>
				<td><input type='hidden' name='data[User][Link][Despachos/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Despachos/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Planilla de Despacho Especial</td>
				<td><input type='hidden' name='data[User][Link][Despachos/crear2]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Despachos/crear2]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Planilla de Reempaque</td>
				<td><input type='hidden' name='data[User][Link][Reempaques/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Reempaques/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Planilla de Relación (Cliente)</td>
				<td><input type='hidden' name='data[User][Link][Ventascredito/relacion]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventascredito/relacion]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Remitentes</td>
				<td><input type='hidden' name='data[User][Link][Remitentes/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Remitentes/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Representantes</td>
				<td><input type='hidden' name='data[User][Link][Representantes/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Representantes/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Tarifas</td>
				<td><input type='hidden' name='data[User][Link][Tarifas/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Tarifas/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Transportadoras y agencias</td>
				<td><input type='hidden' name='data[User][Link][Transportadoras/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Transportadoras/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Traslado Local</td>
				<td><input type='hidden' name='data[User][Link][Despachos/traslado]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Despachos/traslado]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Traslado Nacional</td>
				<td><input type='hidden' name='data[User][Link][Reempaques/traslado]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Reempaques/traslado]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Trazabilidad de Despachos </td>
				<td><input type='hidden' name='data[User][Link][Despachos/trazabilidad]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Despachos/trazabilidad]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Trazabilidad de Guias</td>
				<td><input type='hidden' name='data[User][Link][Ventas/trazabilidad]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/trazabilidad]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Trazabilidad de Reempaques</td>
				<td><input type='hidden' name='data[User][Link][Reempaques/trazabilidad]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Reempaques/trazabilidad]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Vehículos</td>
				<td><input type='hidden' name='data[User][Link][Vehículos/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Vehículos/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Cliente</td>
				<td><input type='hidden' name='data[User][Link][Ventascredito/clientes]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventascredito/clientes]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Contado</td>
				<td><input type='hidden' name='data[User][Link][Ventas/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Contado (Representante)</td>
				<td><input type='hidden' name='data[User][Link][Ventasrepre/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventasrepre/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Contraentrega</td>
				<td><input type='hidden' name='data[User][Link][Ventascontraentrega/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventascontraentrega/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Contraentrega (Representante)</td>
				<td><input type='hidden' name='data[User][Link][Ventascontraentregarepre/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventascontraentregarepre/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Credicontado</td>
				<td><input type='hidden' name='data[User][Link][Ventascredicontado/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventascredicontado/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Credito</td>
				<td><input type='hidden' name='data[User][Link][Ventascredito/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventascredito/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Credito (Representante)</td>
				<td><input type='hidden' name='data[User][Link][Ventascreditorepre/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventascreditorepre/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Especial</td>
				<td><input type='hidden' name='data[User][Link][Ventasespecial/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventasespecial/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Venta Especial (Representante)</td>
				<td><input type='hidden' name='data[User][Link][Ventasespecialrepre/crear]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventasespecialrepre/crear]' value='1' style='height:20px;width:20px;'></td>
			</tr>
			<tr>
				<td>Ver Guia</td>
				<td><input type='hidden' name='data[User][Link][Ventas/ver]' value='0'><input type='checkbox' checked='checked' name='data[User][Link][Ventas/ver]' value='1' style='height:20px;width:20px;'></td>
			</tr>

		</tbody>
	</table>

	<div class="form-group" style="padding-left: 30px;">
		<?php echo $this->Form->button('Guardar',array('type'=>'submit','id'=>'btn-submit','class'=>'btn btn-primary push-right'));?>
		<?php echo $this->Form->end();?>
	</div>
<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."users'"; ?>;
	var permisos = <?php echo json_encode($permisos); ?>;


$(document).ready(function() {

	$("#UserRoleId").change(function(){
		var roleId = $(this).val();
		$("input[type='checkbox']").prop("checked",false);
		$.each(permisos[roleId],function(index,value){
			if(value == 0){
				$("input[name='data[User][Link]["+index+"]']").prop("checked","checked");
			}
		});
	});

	var oTable = $('#tabla_id').dataTable( {
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"sScrollXInner": "250px",
		"sScrollX": "2505px",
		"bScrollInfinite":true,
		"bScrollCollapse":true,
		"bFilter": false,
		"bSort": false,
		"bInfo": true,
		"bLengthChange": false,
		"iDisplayLength": -1,
		"bJQueryUI": true
	});

});
</script>