<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<style>
.bs-callout {padding: 0px !important;}
</style>
<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>CONFIRMACIÓN DE ENTREGAS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario_confirm',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<div class="form-group col-md-12">
			<div class="col-md-12">
				<div class="col-md-6"><?php echo $this->Form->input('tipo',array('label'=>'Filtro: ','type'=>'select','options'=>array('Empresa'=>'Empresa','Vehiculo'=>'Vehiculo','Representante'=>'Representante'),'empty'=>'')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('remesa',array('label'=>'Remesa: ','type'=>'select','options'=>$ventasL,'empty'=>'')); ?></div>
			</div>
			<div id="guiaInfo" class="col-md-12" style="margin-top:50px;">
				<div class="bs-callout bs-callout-green" style="margin:2px 0px 2px 0px;">
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Remesa: <small id="guiaId"></small></h4></div>
						<div class="col-md-4"><h4>Origen: <small id="guiaOrigen"></small></h4></div>
						<div class="col-md-4"><h4>Destino: <small id="guiaDestino"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-3"><h4>Tipo: <small id="guiaTipoRef"></small></h4></div>
						<div class="col-md-3"><h4>Doc Ref 1: <small id="guiaRef1"></small></h4></div>
						<div class="col-md-3"><h4>Doc Ref 2: <small id="guiaRef2"></small></h4></div>
						<div class="col-md-3"><h4>Doc Ref 3: <small id="guiaRef3"></small></h4></div>
					</div>

				</div>
				<div class="bs-callout bs-callout-warning" style="margin:2px 0px 2px 0px;">
					<h4 style="color:rgb(226, 127, 0);">Cliente</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Doc cliente: <small id="guiaClienteDoc"></small></h4></div>
						<div class="col-md-4"><h4>Nombre cliente: <small id="guiaClienteNom"></small></h4></div>
						<div class="col-md-4"><h4>Dirección cliente: <small id="guiaClienteDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Teléfono cliente: <small id="guiaClienteTel"></small></h4></div>
						<div class="col-md-4"><h4>Fax cliente: <small id="guiaClienteFax"></small></h4></div>
						<div class="col-md-4"><h4>Email cliente: <small id="guiaClienteEma"></small></h4></div>
					</div>
				</div>
				<div id="remiDiv" class="bs-callout bs-callout-gray" style="margin:2px 0px 2px 0px;">
					<h4>Remitente</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Doc remitente: <small id="guiaRemitenteDoc"></small></h4></div>
						<div class="col-md-4"><h4>Nombre remitente: <small id="guiaRemitenteNom"></small></h4></div>
						<div class="col-md-4"><h4>Dirección remitente: <small id="guiaRemitenteDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Teléfono remitente: <small id="guiaRemitenteTel"></small></h4></div>
						<div class="col-md-4"><h4>Celular remitente: <small id="guiaRemitenteCel"></small></h4></div>
						<div class="col-md-4"><h4>Email remitente: <small id="guiaRemitenteEma"></small></h4></div>
					</div>
				</div>
				<div class="bs-callout bs-callout-info" style="margin:2px 0px 2px 0px;">
					<h4 style="color:rgb(55, 88, 131);">Destinatario</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Doc destinatario: <small id="guiaDestinatarioDoc"></small></h4></div>
						<div class="col-md-4"><h4>Nombre destinatario: <small id="guiaDestinatarioNom"></small></h4></div>
						<div class="col-md-4"><h4>Dirección destinatario: <small id="guiaDestinatarioDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Teléfono destinatario: <small id="guiaDestinatarioTel"></small></h4></div>
						<div class="col-md-4"><h4>Fax destinatario: <small id="guiaDestinatarioFax"></small></h4></div>
						<div class="col-md-4"><h4>Email destinatario: <small id="guiaDestinatarioEma"></small></h4></div>
					</div>
				</div>

				<div class="bs-callout bs-callout-warning" style="margin:2px 0px 2px 0px;">
					<h4 style="color:rgb(226, 127, 0);">Despacho</h4>
					<div class="form-group col-md-12">
						<div class="alinear col-md-3"><h4 id="negoLabel">Negociador:</h4><h4><small id="despachoNeg"></small></h4></div>
						<div class="alinear col-md-4"><h4 id="condLabel">Conductor:</h4><h4><small id="despachoCond"></small></h4></div>
						<div class="alinear col-md-3"><h4 id="placLabel">Placa:</h4><h4><small id="despachoPlaca"></small></h4></div>
						<div class="alinear col-md-2"><h4 id="planLabel">Planilla:</h4><h4><small id="despachoId" class="btn bord" data-toggle="modal" data-target="#myModal"></small></h4></div>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: hidden;">
					  <div class="modal-dialog" style="width:90%">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal"><span class="sr-only">Close</span></button>
					        <h4 class="modal-title" id="myModalLabel"></h4>
					      </div>
					      <div class="modal-body" id="tableDes">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>
					  </div>
					</div>

				</div>
				
				<div id="ReemDiv" class="bs-callout bs-callout-warning" style="margin:2px 0px 2px 0px;">
					<h4 style="color:rgb(226, 127, 0);">Reempaque Información</h4>
					<div class="form-group col-md-12">
						<div class="alinear col-md-4"><h4 id="negoLabel2">Auxiliar:</h4><h4><small id="despachoNeg2"></small></h4></div>
						<div class="alinear col-md-4"><h4 id="condLabel2">Conductor:</h4><h4><small id="despachoCond2"></small></h4></div>
						<div class="alinear col-md-2"><h4 id="planLabel2">Reempaque:</h4><h4><small id="despachoId2" class="btn bord" data-toggle="modal" data-target="#myModal2"></small></h4></div>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="overflow: hidden;">
					  <div class="modal-dialog" style="width:90%">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal"><span class="sr-only">Close</span></button>
					        <h4 class="modal-title" id="myModalLabel"></h4>
					      </div>
					      <div class="modal-body" id="tableDes2">
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>
					  </div>
					</div>

				</div>
				<div id="empaquesDiv"></div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('recibio',array('label'=>'Recibio: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('cedula_recibio',array('label'=>'CC: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('cargo_recibido',array('label'=>'Parentezco/Cargo: ','type'=>'text')); ?></div>
				<div style="float:left;width:25%;">
					<div class="col-md-12" style="margin-top:17px;"><?php echo $this->Form->input('sello',array('label'=>'Sello','type'=>'checkbox')); ?></div>
				</div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('fecha_recibio',array('label'=>'Fecha: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('cedula_recibio2',array('label'=>'CC: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('recibido2',array('label'=>'Confirmo recibido: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('telefono_recibido',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-6"><?php echo $this->Form->input('novedad',array('label'=>'Novedad: ','type'=>'select','options'=>$novedades,'empty'=>'')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('observaciones_recibio',array('label'=>'Observaciones: ','type'=>'text')); ?></div>
			</div>
			<div class="form-group col-md-12">			
				<div class="col-md-12"><?php echo $this->Form->input('totalidad',array('label'=>'RECIBIO TODO EL CONTENIDO DE LA MERCANCIA','type'=>'select','options'=>array('No','Si'))); ?></div>
			</div>

		</div>

		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>tipo</th>
					<th>Remesa</th>
					<th>Destinatario</th>
					<th>Cliente</th>
					<th>Origen</th>
					<th>Destino</th>
					<th>Cantidad</th>
					<th>Empaque</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>		
		<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin: 5px 30px 5px 0px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
		<?php echo $this->Form->end();?>
		</div>
</div>
<script>
	var ventas     = <?php echo json_encode($ventas); ?>;
	var recibos    = <?php echo json_encode($recibos); ?>;
	var despachos  = <?php echo json_encode($despachos); ?>;
	var reempaques = <?php echo json_encode($reempaques); ?>;
	var webroot    = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url        = <?php echo "'".Router::url('/')."ventas'"; ?>;

	function setTable(idSelect , isDespacho){
		if(isDespacho){
			var data  = "<table class='table'><thead><th>Remesa</th><th>Destino</th><th>Destinatario</th><th>Cantidad</th><th>Empaque</th></thead><tbody>";
			$("#myModalLabel").text("Planilla de Despacho");
			var guias = despachos[idSelect].Despacho.guias;
			for (var i = 0; i < guias.length; i++) {
				$.each( ventas ,function(key,value) {
					if(guias[i] == value.Venta.id){
						data = data + "<tr><td><a class='btn btn-info' target='_blank' href='"+ url + "/trazabilidad/" + guias[i] +"'>"+value.Venta.remesa+"</a></td>";
						data = data + "<td>"+value.Venta.destinoNombre+"</td>";
						data = data + "<td>"+value.Venta.nombreDest+"</td>";
						data = data + "<td>"+value.Venta.cantidad+"</td>";
						data = data + "<td>"+value.Venta.empaque+"</td>";
					}
					data = data + "</tr>";
				});
			};
		} else {
			var data  = "<table class='table'><thead><th>Remesa</th><th>Destino</th><th>Destinatario</th><th>Cantidad</th><th>Empaque</th><th>Recibida <input type='checkbox' id='checkboxSi'></th><th>No Recibida <input type='checkbox' id='checkboxNo'></th></thead><tbody>";
			$("#myModalLabel").text("Planilla de Reempaque");
			var guias = reempaques[idSelect].Reempaque.guias;
			for (var i = 0; i < guias.length; i++) {
				$.each( ventas ,function(key,value) {
					if(guias[i] == value.Venta.id){
						data = data + "<tr><td><a class='btn btn-info' target='_blank' href='"+ url + "/trazabilidad/" + guias[i] +"'>"+value.Venta.remesa+"</a></td>";
						data = data + "<td>"+value.Venta.destinoNombre+"</td>";
						data = data + "<td>"+value.Venta.nombreDest+"</td>";
						data = data + "<td>"+value.Venta.cantidad+"</td>";
						data = data + "<td>"+value.Venta.empaque+"</td>";
						data = data + "<td><input type='checkbox' class='si' name='data[Venta][Si][]' id='"+value.Venta.id+"' value='"+value.Venta.id+"'></td>";
						data = data + "<td><input type='checkbox' class='no' name='data[Venta][No][]' id='"+value.Venta.id+"' value='"+value.Venta.id+"'></td>";
					}
					data = data + "</tr>";
				});
			};
		}
		return data+"</tbody></table>";
	}
	var guiaId = <?php echo json_encode($id); ?>;
	function setTable2(idSelect){
		var data  = "<table class='table'><thead><th>Remesa</th><th>Destino</th><th>Destinatario</th><th>Cantidad</th><th>Empaque</th><th>Recibida <input type='checkbox' id='checkboxSi'></th><th>No Recibida <input type='checkbox' id='checkboxNo'></th></thead><tbody>";
		$.each( reempaques ,function(key,value) {
			if(idSelect == value.Reempaque.id){

				$("#despachoNeg2").text(value.Reempaque.negociador);
				$("#despachoCond2").text(value.Reempaque.conductor);
				$("#despachoId2").text(value.Reempaque.id);

				var guias = value.Reempaque.guias;
				for (var i = 0; i < guias.length; i++) {
					$.each( ventas ,function(key,value) {
						if(guias[i] == value.Venta.id){
							data = data + "<tr><td><a class='btn btn-info' target='_blank' href='"+ url + "/trazabilidad/" + guias[i] +"'>"+value.Venta.remesa+"</a></td>";
							data = data + "<td>"+value.Venta.destinoNombre+"</td>";
							data = data + "<td>"+value.Venta.nombreDest+"</td>";
							data = data + "<td>"+value.Venta.cantidad+"</td>";
							data = data + "<td>"+value.Venta.empaque+"</td>";
							data = data + "<td><input type='checkbox' class='si' name='data[Venta][Si][]' id='"+value.Venta.id+"' value='"+value.Venta.id+"'></td>";
							data = data + "<td><input type='checkbox' class='no' name='data[Venta][No][]' id='"+value.Venta.id+"' value='"+value.Venta.id+"'></td>";
						}
						data = data + "</tr>";
					});
				};

			}
		});
		return data+"</tbody></table>";
	}
$(document).ready(function(){

	$("#guiaInfo").on('change', '#checkboxSi', function(event) {
		var tmpAux = this;
		$(".si").prop('checked',$(tmpAux).prop('checked'));
	});

	$("#guiaInfo").on('change', '#checkboxNo', function(event) {
		var tmpAux = this;
		$(".no").prop('checked',$(tmpAux).prop('checked'));
	});

	$("#guiaInfo").hide();
	$("#VentaFechaRecibio").datepicker();
	
	$("#VentaRemesa").val(guiaId);
	$("#VentaRemesa").trigger("chosen:updated");
	if(guiaId != null){
		var desp = true;
		$("#despachoId").addClass("btn bord");
		$.each( despachos ,function(key2,value2) {
			for (var i = 0; i < value2.Despacho.guias.length; i++) {
				if(guiaId == value2.Despacho.guias[i]){
					desp = false;
					i    = value2.Despacho.guias.length;
					$("#negoLabel").text("Negociador:");
					$("#condLabel").text("Conductor:");
					$("#placLabel").text("Placa:");
					$("#planLabel").text("Despacho:");
					$("#tableDes").empty();
					$("#tableDes").append(setTable(key2,true));
					$("#despachoNeg").text(value2.Despacho.negociador);
					$("#despachoCond").text(value2.Despacho.conductor);
					$("#despachoPlaca").text(value2.Despacho.placa);
					$("#despachoId").text(value2.Despacho.id);
				}
			};
		});
		if(desp){
			$.each( reempaques ,function(key2,value2) {
				if(value2.Reempaque.guias != null){
					for (var i = 0; i < value2.Reempaque.guias.length; i++) {
						if(guiaId == value2.Reempaque.guias[i]){
							desp = false;
							i    = value2.Reempaque.guias.length;
							$("#negoLabel").text("Auxiliar:");
							$("#condLabel").text("Conductor:");
							$("#placLabel").text("");
							$("#planLabel").text("Reempaque:");
							$("#tableDes").empty();
							$("#tableDes").append(setTable(key2,false));
							$("#despachoNeg").text(value2.Reempaque.negociador);
							$("#despachoCond").text(value2.Reempaque.conductor);
							$("#despachoPlaca").text("");
							$("#despachoId").text(value2.Reempaque.id);
						}
					};
				}
			});
			
		}
		if(desp){
			if(recibos[guiaId].Recibo.tipo == "Juridica"){
				$("#negoLabel").text("Negociador:");
				$("#condLabel").text("Transportadora:");
				$("#placLabel").text("Recibo:");
				$("#planLabel").text("");
				$("#despachoNeg").text(recibos[guiaId].Recibo.negociador_nom);
				$("#despachoCond").text(recibos[guiaId].Recibo.razon);
				$("#despachoPlaca").text(recibos[guiaId].Recibo.numero);
				$("#despachoId").text("");
			} else {
				$("#negoLabel").text("Conductor:");
				$("#condLabel").text("Placa:");
				$("#placLabel").text("Recibo:");
				$("#planLabel").text("");
				$("#despachoNeg").text(recibos[guiaId].Recibo.negociador_nom);
				$("#despachoCond").text(recibos[guiaId].Recibo.documento);
				$("#despachoPlaca").text(recibos[guiaId].Recibo.numero);
				$("#despachoId").text("");
			}
			$("#despachoId").removeClass("btn bord");
		}
		$.each( ventas ,function(key,value) {
			if(guiaId == value.Venta.id){
				$("#empaquesDiv").empty();
				$("#empaquesDiv").append(value.Venta.html);
				if(value.Venta.otro_remi == 1){
					$("#remiDiv").show();
				} else {
					$("#remiDiv").hide();
				}
				if(value.Venta.guiaReemp){
					$("#tableDes2").empty();
					$("#tableDes2").append(setTable2(value.Venta.documento1,false));
					$("#ReemDiv").show();
				} else {
					$("#ReemDiv").hide();
				}
				$("#VentaId").val(value.Venta.id);
				$("#guiaId").text(value.Venta.remesa);
				$("#guiaTipoRef").text(value.Venta.tipo);
				$("#guiaRef1").text(value.Venta.documento1);
				$("#guiaRef2").text(value.Venta.documento2);
				$("#guiaRef3").text(value.Venta.documento3);
				$("#guiaOrigen").text(value.Venta.origenNombre);
				$("#guiaDestino").text(value.Venta.destinoNombre);
				$("#guiaClienteDoc").text(value.Venta.documentoClien);
				$("#guiaClienteNom").text(value.Venta.nombreClien);
				$("#guiaClienteDir").text(value.Venta.direccionClien);
				$("#guiaClienteTel").text(value.Venta.telefonoClien);
				$("#guiaClienteFax").text(value.Venta.faxClien);
				$("#guiaClienteEma").text(value.Venta.emailClien);
				$("#guiaRemitenteDoc").text(value.Venta.documentoRemi);
				$("#guiaRemitenteNom").text(value.Venta.nombreRemi);
				$("#guiaRemitenteDir").text(value.Venta.direccionRemi);
				$("#guiaRemitenteTel").text(value.Venta.telefonoRemi);
				$("#guiaRemitenteCel").text(value.Venta.celularRemi);
				$("#guiaRemitenteEma").text(value.Venta.emailRemi);
				$("#guiaDestinatarioDoc").text(value.Venta.documentoDest);
				$("#guiaDestinatarioNom").text(value.Venta.nombreDest);
				$("#guiaDestinatarioDir").text(value.Venta.direccionDest);
				$("#guiaDestinatarioTel").text(value.Venta.telefonoDest);
				$("#guiaDestinatarioFax").text(value.Venta.faxDest);
				$("#guiaDestinatarioEma").text(value.Venta.emailDest);
				$("#guiaKiloAd").text(value.Venta.kilo_adic);
				$("#guiaKiloNeg").text(value.Venta.kilo_nego);
				$("#guiaValKilo").text(value.Venta.valor_kilo_adic);
				$("#guiaSeguro").text(value.Venta.valor_seguro);
				$("#guiaDevolucion").text(value.Venta.valor_devolucion);
				$("#guiaTotal").text(value.Venta.valor_total);
				$("#guiaInfo").show();
			}
		});
	} else {
		$("#guiaInfo").hide();
	}


	$("#VentaTipo").chosen({
		no_results_text           : 'No se encuentra el filtro.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el filtro"
	});
	$("#VentaRemesa").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la guia"
	});
	$("#VentaRemesa").change(function(){
		oTable.fnFilter("",1);
		$("#VentaTipo").val("");
		$("#VentaTipo").trigger("chosen:updated");
		var guiaId = $("#VentaRemesa").val();
		if(guiaId != ""){
    		var desp = true;
			$("#despachoId").addClass("btn bord");
			$.each( despachos ,function(key2,value2) {
				for (var i = 0; i < value2.Despacho.guias.length; i++) {
					if(guiaId == value2.Despacho.guias[i]){
						desp = false;
						i    = value2.Despacho.guias.length;
						$("#negoLabel").text("Negociador:");
						$("#condLabel").text("Conductor:");
						$("#placLabel").text("Placa:");
						$("#planLabel").text("Despacho:");
						$("#tableDes").empty();
						$("#tableDes").append(setTable(key2,true));
						$("#despachoNeg").text(value2.Despacho.negociador);
						$("#despachoCond").text(value2.Despacho.conductor);
						$("#despachoPlaca").text(value2.Despacho.placa);
						$("#despachoId").text(value2.Despacho.id);
					}
				};
			});
			if(desp){
				$.each( reempaques ,function(key2,value2) {
					if(value2.Reempaque.guias != null){
						for (var i = 0; i < value2.Reempaque.guias.length; i++) {
							if(guiaId == value2.Reempaque.guias[i]){
								desp = false;
								i    = value2.Reempaque.guias.length;
								$("#negoLabel").text("Auxiliar:");
								$("#condLabel").text("Conductor:");
								$("#placLabel").text("");
								$("#planLabel").text("Reempaque:");
								$("#tableDes").empty();
								$("#tableDes").append(setTable(key2,false));
								$("#despachoNeg").text(value2.Reempaque.negociador);
								$("#despachoCond").text(value2.Reempaque.conductor);
								$("#despachoPlaca").text("");
								$("#despachoId").text(value2.Reempaque.id);
							}
						};
					}
				});
				

				
			}
			if(desp){
				if(recibos[guiaId].Recibo.tipo == "Juridica"){
					$("#negoLabel").text("Negociador:");
					$("#condLabel").text("Transportadora:");
					$("#placLabel").text("Recibo:");
					$("#planLabel").text("");
					$("#despachoNeg").text(recibos[guiaId].Recibo.negociador_nom);
					$("#despachoCond").text(recibos[guiaId].Recibo.razon);
					$("#despachoPlaca").text(recibos[guiaId].Recibo.numero);
					$("#despachoId").text("");
				} else {
					$("#negoLabel").text("Conductor:");
					$("#condLabel").text("Placa:");
					$("#placLabel").text("Recibo:");
					$("#planLabel").text("");
					$("#despachoNeg").text(recibos[guiaId].Recibo.negociador_nom);
					$("#despachoCond").text(recibos[guiaId].Recibo.documento);
					$("#despachoPlaca").text(recibos[guiaId].Recibo.numero);
					$("#despachoId").text("");
				}
				$("#despachoId").removeClass("btn bord");
			}
			$.each( ventas ,function(key,value) {
				if(guiaId == value.Venta.id){
					$("#empaquesDiv").empty();
					$("#empaquesDiv").append(value.Venta.html);
					if(value.Venta.otro_remi == 1){
						$("#remiDiv").show();
					} else {
						$("#remiDiv").hide();
					}

					if(value.Venta.guiaReemp){
						$("#tableDes2").append(setTable2(value.Venta.documento1,false));
						$("#ReemDiv").show();
					} else {
						$("#ReemDiv").hide();
					}
					$("#VentaId").val(value.Venta.id);
					$("#guiaId").text(value.Venta.remesa);
					$("#guiaTipoRef").text(value.Venta.tipo);
					$("#guiaRef1").text(value.Venta.documento1);
					$("#guiaRef2").text(value.Venta.documento2);
					$("#guiaRef3").text(value.Venta.documento3);
					$("#guiaOrigen").text(value.Venta.origenNombre);
					$("#guiaDestino").text(value.Venta.destinoNombre);
					$("#guiaClienteDoc").text(value.Venta.documentoClien);
					$("#guiaClienteNom").text(value.Venta.nombreClien);
					$("#guiaClienteDir").text(value.Venta.direccionClien);
					$("#guiaClienteTel").text(value.Venta.telefonoClien);
					$("#guiaClienteFax").text(value.Venta.faxClien);
					$("#guiaClienteEma").text(value.Venta.emailClien);
					$("#guiaRemitenteDoc").text(value.Venta.documentoRemi);
					$("#guiaRemitenteNom").text(value.Venta.nombreRemi);
					$("#guiaRemitenteDir").text(value.Venta.direccionRemi);
					$("#guiaRemitenteTel").text(value.Venta.telefonoRemi);
					$("#guiaRemitenteCel").text(value.Venta.celularRemi);
					$("#guiaRemitenteEma").text(value.Venta.emailRemi);
					$("#guiaDestinatarioDoc").text(value.Venta.documentoDest);
					$("#guiaDestinatarioNom").text(value.Venta.nombreDest);
					$("#guiaDestinatarioDir").text(value.Venta.direccionDest);
					$("#guiaDestinatarioTel").text(value.Venta.telefonoDest);
					$("#guiaDestinatarioFax").text(value.Venta.faxDest);
					$("#guiaDestinatarioEma").text(value.Venta.emailDest);
					$("#guiaKiloAd").text(value.Venta.kilo_adic);
					$("#guiaKiloNeg").text(value.Venta.kilo_nego);
					$("#guiaValKilo").text(value.Venta.valor_kilo_adic);
					$("#guiaSeguro").text(value.Venta.valor_seguro);
					$("#guiaDevolucion").text(value.Venta.valor_devolucion);
					$("#guiaTotal").text(value.Venta.valor_total);
					$("#guiaInfo").show();
				}
			});
		} else {
			$("#guiaInfo").hide();
		}

	});
	$("#VentaTipo").change(function(){
		var tipo = $(this).val();
		$("#VentaRemesa").val("");
		oTable.fnFilter(tipo,1);
	});

	$('#tabla_id').css('cursor', 'pointer');
	var odd = false;
	var even = false;
	$('#tabla_id').on('mouseenter', 'tr', function(event) {
		if ($(this).hasClass("odd")){
			odd = true;
			$(this).removeClass('odd').addClass('row-select');
		}
		if ($(this).hasClass("even")){
			even = true;
			$(this).removeClass('even').addClass('row-select');
		}
	});
	$('#tabla_id').on('mouseleave', 'tr', function(event) {
		if (odd){
			odd = false;
			$(this).removeClass('row-select').addClass('odd');
		}
		if (even){
			even = false;
			$(this).removeClass('row-select').addClass('even');
		}
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var guiaId = aData[0].replace(/(&nbsp;)*/g,"");
	    	if(guiaId != ""){
	    		var desp = true;
				$("#despachoId").addClass("btn bord");
				$.each( despachos ,function(key2,value2) {
					for (var i = 0; i < value2.Despacho.guias.length; i++) {
						if(guiaId == value2.Despacho.guias[i]){
							desp = false;
							i    = value2.Despacho.guias.length;
							$("#negoLabel").text("Negociador:");
							$("#condLabel").text("Conductor:");
							$("#placLabel").text("Placa:");
							$("#planLabel").text("Despacho:");
							$("#tableDes").empty();
							$("#tableDes").append(setTable(key2,true));
							$("#despachoNeg").text(value2.Despacho.negociador);
							$("#despachoCond").text(value2.Despacho.conductor);
							$("#despachoPlaca").text(value2.Despacho.placa);
							$("#despachoId").text(value2.Despacho.id);
						}
					};
				});
				if(desp){
					$.each( reempaques ,function(key2,value2) {
						for (var i = 0; i < value2.Reempaque.guias.length; i++) {
							if(guiaId == value2.Reempaque.guias[i]){
								desp = false;
								i    = value2.Reempaque.guias.length;
								$("#negoLabel").text("Auxiliar:");
								$("#condLabel").text("Conductor:");
								$("#placLabel").text("");
								$("#planLabel").text("Reempaque:");
								$("#tableDes").empty();
								$("#tableDes").append(setTable(key2,false));
								$("#despachoNeg").text(value2.Reempaque.negociador);
								$("#despachoCond").text(value2.Reempaque.conductor);
								$("#despachoPlaca").text("");
								$("#despachoId").text(value2.Reempaque.id);
							}
						};
					});
					
				}
				if(desp){
					if(recibos[guiaId].Recibo.tipo == "Juridica"){
						$("#negoLabel").text("Negociador:");
						$("#condLabel").text("Transportadora:");
						$("#placLabel").text("Recibo:");
						$("#planLabel").text("");
						$("#despachoNeg").text(recibos[guiaId].Recibo.negociador_nom);
						$("#despachoCond").text(recibos[guiaId].Recibo.razon);
						$("#despachoPlaca").text(recibos[guiaId].Recibo.numero);
						$("#despachoId").text("");
					} else {
						$("#negoLabel").text("Conductor:");
						$("#condLabel").text("Placa:");
						$("#placLabel").text("Recibo:");
						$("#planLabel").text("");
						$("#despachoNeg").text(recibos[guiaId].Recibo.negociador_nom);
						$("#despachoCond").text(recibos[guiaId].Recibo.documento);
						$("#despachoPlaca").text(recibos[guiaId].Recibo.numero);
						$("#despachoId").text("");
					}
					$("#despachoId").removeClass("btn bord");
				}
				$.each( ventas ,function(key,value) {
					if(guiaId == value.Venta.id){
						$("#empaquesDiv").empty();
						$("#empaquesDiv").append(value.Venta.html);
						if(value.Venta.otro_remi == 1){
							$("#remiDiv").show();
						} else {
							$("#remiDiv").hide();
						}
						if(value.Venta.guiaReemp){
							$("#tableDes2").append(setTable2(value.Venta.documento1,false));
							$("#ReemDiv").show();
						} else {
							$("#ReemDiv").hide();
						}
						$("#VentaId").val(value.Venta.id);
						$("#guiaId").text(value.Venta.remesa);
						$("#guiaTipoRef").text(value.Venta.tipo);
						$("#guiaRef1").text(value.Venta.documento1);
						$("#guiaRef2").text(value.Venta.documento2);
						$("#guiaRef3").text(value.Venta.documento3);
						$("#guiaOrigen").text(value.Venta.origenNombre);
						$("#guiaDestino").text(value.Venta.destinoNombre);
						$("#guiaClienteDoc").text(value.Venta.documentoClien);
						$("#guiaClienteNom").text(value.Venta.nombreClien);
						$("#guiaClienteDir").text(value.Venta.direccionClien);
						$("#guiaClienteTel").text(value.Venta.telefonoClien);
						$("#guiaClienteFax").text(value.Venta.faxClien);
						$("#guiaClienteEma").text(value.Venta.emailClien);
						$("#guiaRemitenteDoc").text(value.Venta.documentoRemi);
						$("#guiaRemitenteNom").text(value.Venta.nombreRemi);
						$("#guiaRemitenteDir").text(value.Venta.direccionRemi);
						$("#guiaRemitenteTel").text(value.Venta.telefonoRemi);
						$("#guiaRemitenteCel").text(value.Venta.celularRemi);
						$("#guiaRemitenteEma").text(value.Venta.emailRemi);
						$("#guiaDestinatarioDoc").text(value.Venta.documentoDest);
						$("#guiaDestinatarioNom").text(value.Venta.nombreDest);
						$("#guiaDestinatarioDir").text(value.Venta.direccionDest);
						$("#guiaDestinatarioTel").text(value.Venta.telefonoDest);
						$("#guiaDestinatarioFax").text(value.Venta.faxDest);
						$("#guiaDestinatarioEma").text(value.Venta.emailDest);
						$("#guiaKiloAd").text(value.Venta.kilo_adic);
						$("#guiaKiloNeg").text(value.Venta.kilo_nego);
						$("#guiaValKilo").text(value.Venta.valor_kilo_adic);
						$("#guiaSeguro").text(value.Venta.valor_seguro);
						$("#guiaDevolucion").text(value.Venta.valor_devolucion);
						$("#guiaTotal").text(value.Venta.valor_total);
						$("#guiaInfo").show();
					}
				});
			} else {
				$("#guiaInfo").hide();
			}
	    }
	});

	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/sin_despachar_confir.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="linkTrazabilidad btn btn-info" style="padding:0px;" title="Trazabilidad" href="'+url+'/trazabilidad/'+aData[0]+'">'+aData[2]+'</a></nav>';
			$('td:eq(0)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumns": [
			{ "sWidth": "0%" },
			{ "sWidth": "0%" },
			{ "sWidth": "5%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "2%" },
			{ "sWidth": "2%" }
		],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0,1 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

})
</script>