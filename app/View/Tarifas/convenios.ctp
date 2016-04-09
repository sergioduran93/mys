<?php	
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('jquery.fancybox');
	echo $this->Html->css('jquery.fancybox'); 

?>
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Convenio',array('class'=>'form-inline'));?>
		<div><h3><center>CONVENIOS</center></h3></div>
	    <fieldset>
				<?php echo $this->Html->link('', array('action'=>'excelVer'),array('class'=>'excelLink hidden')); ?>
				<?php echo $this->Html->link('', array('action'=>'excelVerD'),array('class'=>'excelLinkD hidden')); ?>
			    <?php echo $this->Form->input('otros_empaques',array('type'=>'hidden','value'=>'')); ?>
			    <?php echo $this->Form->input('cliente_id',array('type'=>'hidden')); ?>
			    <?php echo $this->Form->input('destino_id',array('type'=>'hidden')); ?>
			    <div class="form-group col-md-12">
			        <div class="col-md-3"><?php echo $this->Form->input('cliente',array('label'=>'Cliente NIT: ','type'=>'text')); ?></div>
			        <div class="col-md-3"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text','style'=>'width:100%')); ?></div>
			        <div class="col-md-6" style="padding-top:25px;">
			        	<?php
						$options=array('TodasRegiones'=>'Todas las regiones ','Region'=>'Región ','Destino'=>'Destino ');
						$attributes=array('legend'=>false,'default'=>'Destino');
						echo $this->Form->radio('tarifa',$options,$attributes);
						?>
					</div>
			    </div>
			    <div class="form-group col-md-12">
			        <div class="col-md-3 ConvenioRegion"><?php echo $this->Form->input('region',array('label'=>'Region: ','type'=>'select','options'=>$regiones,'empty'=>'','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			        <div class="col-md-3 ConvenioDestino1"><?php echo $this->Form->input('destino1',array('label'=>'Cod. Destino: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			        <div class="col-md-3 ConvenioDestino2"><?php echo $this->Form->input('destino2',array('label'=>"Nom. Destino:",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			        <div class="col-md-3"><?php echo $this->Form->input('destino3',array('label'=>'Ciudad origen: ','type'=>'select','options'=>$destinosList)); ?></div>
			    </div>
			    <div>
					<div class="bs-callout bs-callout-warning" style="margin: 0px 0px 5px 30px;padding:2px;">
						<h4 style="width:50%;float:left;">Empaques</h4>
    					<div style="width:50%;float:left;">
    						<a id="btn-medidas" href="javascript:;" style="float:right;margin-right:30px;" class="btn bord">Medidas Estandar</a>
							<a id="fancybox-otros" href="javascript:;" style="float:right;" class="btn bord">Otros empaques</a>
    					</div>
					    <div class="form-group col-md-12">
							<div class="col-md-20"><?php echo $this->Form->input('valor_sobre',array('label'=>'($) Sobre:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('valor_paquete',array('label'=>'($) Paquete:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('valor_caja',array('label'=>'($) Caja:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('valor_devol',array('label'=>'($) Sobre devolución:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('valor_otros',array('label'=>'($) Otros empaques:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
						</div>
					    <div class="form-group col-md-12">
							<div class="col-md-20"><?php echo $this->Form->input('max_sobre',array('label'=>'(Kg Max) Sobre:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('max_paquete',array('label'=>'(Kg Max) Paquete:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('max_caja',array('label'=>'(Kg Max) Caja:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('max_devol',array('label'=>'(Kg Max) Sobre devol:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('max_otros',array('label'=>'(Kg Max) Otros Emp:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
						</div>
					</div>
					<div id="medidas" class="bs-callout bs-callout-info" style="margin: 0px 0px 5px 30px;padding:2px;">
						<h4>Medidas</h4>
					    <div class="form-group col-md-12">
							<div class="col-md-20"><?php echo $this->Form->input('largo_sobre',array('label'=>'(Largo) Sobre:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('largo_paquete',array('label'=>'(Largo) Paquete:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('largo_caja',array('label'=>'(Largo) Caja:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('largo_devol',array('label'=>'(Largo) Sobre devol:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('largo_otros',array('label'=>'(Largo) Otros:','type'=>'text','default'=>'0')); ?></div>
						</div>
					    <div class="form-group col-md-12">
							<div class="col-md-20"><?php echo $this->Form->input('ancho_sobre',array('label'=>'(Ancho) Sobre:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('ancho_paquete',array('label'=>'(Ancho) Paquete:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('ancho_caja',array('label'=>'(Ancho) Caja:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('ancho_devol',array('label'=>'(Ancho) Sobre devol:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('ancho_otros',array('label'=>'(Ancho) Otros:','type'=>'text','default'=>'0')); ?></div>
						</div>
					    <div class="form-group col-md-12">
							<div class="col-md-20"><?php echo $this->Form->input('alto_sobre',array('label'=>'(Alto) Sobre:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('alto_paquete',array('label'=>'(Alto) Paquete:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('alto_caja',array('label'=>'(Alto) Caja:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('alto_devol',array('label'=>'(Alto) Sobre devol:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('alto_otros',array('label'=>'(Alto) Otros:','type'=>'text','default'=>'0')); ?></div>
						</div>
					    <div class="form-group col-md-12">
							<div class="col-md-20"><?php echo $this->Form->input('peso_sobre',array('label'=>'(Peso) Sobre:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('peso_paquete',array('label'=>'(Peso) Paquete:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('peso_caja',array('label'=>'(Peso) Caja:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('peso_devol',array('label'=>'(Peso) Sobre devol:','type'=>'text','default'=>'0')); ?></div>
							<div class="col-md-20"><?php echo $this->Form->input('peso_otros',array('label'=>'(Peso) Otros:','type'=>'text','default'=>'0')); ?></div>
						</div>
					</div>
				    <div class="form-group col-md-12">
						<div class="col-md-20"><?php echo $this->Form->input('valor_adicional',array('label'=>'($) Valor kilo adicional','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
						<div class="col-md-20"><?php echo $this->Form->input('declarado',array('label'=>'Valor declarado:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
						<div class="col-md-20"><?php echo $this->Form->input('porcen_declarado',array('label'=>'(%)','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
					</div>
				</div>
			<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
				<thead>
					<tr>
						<th>id</th>
						<th>id region</th>
						<th>Documento</th>
						<th>Nombre</th>
						<th>Teléfono</th>
						<th>Teléfono2</th>
						<th>Dirección</th>
						<th>Celular</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		<!--
		<div style="margin-left: 30px;">
		<div class="panel panel-info thumbnail col-md-6">
			<div class="panel-heading">
				<span style="font-weight: bold">Rango unidades:</span>
			</div>
			<table>
				<tr>
					<th>Desde</th>
					<th>Hasta</th>
					<th>Porcentaje (%)</th>
				</tr>
				<tbody data-bind="foreach: unidades">
					<tr>
						<td><input type="text" name="data[Convenio][rangoUnidad][desde][]" data-bind='value: desde'/></td>
						<td><input type="text" name="data[Convenio][rangoUnidad][hasta][]" data-bind='value: hasta'/></td>
						<td><input type="text" name="data[Convenio][rangoUnidad][descuento][]" data-bind='value: descuento'/></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="panel panel-info thumbnail col-md-6">
			<div class ="panel-heading">
				<span style="font-weight: bold">Rango kilos:</span>
				<div style="padding: 0px 15px 0px 10px; float:right;" class="btn btn-success" data-bind='click: addUnidad'>
					<span class="glyphicon glyphicon-plus"></span> Agregar
				</div>
			</div>
			<table>
				<tr>
					<th>Desde</th>
					<th>Hasta</th>
					<th>Porcentaje (%)</th>
					<th></th>
				</tr>
				<tbody data-bind="foreach: unidades">
					<tr>
						<td><input type="text" name="data[Convenio][rangoKilo][desde][]" data-bind='value: desde2'/></td>
						<td><input type="text" name="data[Convenio][rangoKilo][hasta][]" data-bind='value: hasta2'/></td>
						<td><input type="text" name="data[Convenio][rangoKilo][descuento][]" data-bind='value: descuento2'/></td>
						<td style="padding:0px; float:right;border:none;" class="btn btn-danger" data-bind='click: $root.removeUnidad'>
							<span class="glyphicon glyphicon-remove"></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>
		-->
	<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>
	var fullpath    = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var webroot     = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var clientes    = <?php echo json_encode($clientes); ?>;
	var destinos    = <?php echo json_encode($destinosInfo); ?>;
	var otrosPrueba;
	var isCliente   = true;
	var retorno;
	var excelVer    = "excelVer";
	var excelVerD   = "excelVerD";
	var medidasFlag = true;

//	var tarifas    = <?php echo json_encode($tarifas); ?>;
//	var descuentos = <?php echo json_encode($desc); ?>;
    var descuentoActual;
    var oTable;

	var UnidadesModel = function(unidades) {
		var self        = this;
		self.desde      = unidades.desde;
		self.hasta      = unidades.hasta;
		self.descuento  = unidades.descuento;
		self.desde2     = unidades.desde2;
		self.hasta2     = unidades.hasta2;
		self.descuento2 = unidades.descuento2;
	}
	var dataMappingOptions = {
	    key: function(data) {
	        return data.id;
	    },
	    create: function(options) {
	        return new UnidadesModel(options.data);
	    }
	};

	var viewModel = {
	    unidades: ko.mapping.fromJS([]),
	    loadUpdatedData: function(newData) {
	        ko.mapping.fromJS(newData, viewModel.unidades);
	    },
	};
	viewModel.addUnidad = function() {
	    viewModel.unidades.push(new UnidadesModel({ desde:"", hasta:"", descuento: "", desde2:"", hasta2:"", descuento2: ""}));
	};
	viewModel.removeUnidad = function(selected) {
		if(confirm('¿Esta seguro de eliminar este rango?')){
			viewModel.unidades.remove(selected);
		}
	};
	viewModel.removeUnidadTotal = function() {
	    viewModel.unidades.removeAll();
	};

	ko.applyBindings(viewModel);

$(document).ready(function(){
	//$("#btn-limpiar").after('<div class="btn-group"> <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Exportar<span style="margin-left: 10px;" class="caret"></span>    <span class="sr-only">Toggle Dropdown</span>  </button>  <ul class="dropdown-menu" role="menu">    <li><a title="Ver" id="fancybox-excel" href="javascript:;"><span class="glyphicon glyphicon-download-alt"></span>Ver</a></li>      <li><a title="Descargar" class="excel" href="excelDescargar"><span class="glyphicon glyphicon-download-alt"></span>Descargar</a></li>          </ul></div>');
	$("#btn-limpiar").after('<div class="btn-group"> <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Exportar<span style="margin-left: 10px;" class="caret"></span>    <span class="sr-only">Toggle Dropdown</span>  </button>  <ul class="dropdown-menu" role="menu">    <li><a title="Ver tarifas" id="fancybox-excel" href="javascript:;"><span class="glyphicon glyphicon-download-alt"></span>Ver tarifas</a></li> <li><a title="Ver descuentos" id="fancybox-excelD" href="javascript:;"><span class="glyphicon glyphicon-download-alt"></span>Ver descuentos</a></li>      <li><a title="Descargar tarifas" class="excel" href="excelDescargar"><span class="glyphicon glyphicon-download-alt"></span>Descargar tarifas</a></li>  <li><a title="Descargar descuentos" class="excelD" href="excelDescargarD"><span class="glyphicon glyphicon-download-alt"></span>Descargar descuentos</a></li>          </ul></div>');
	$("#medidas").hide();

	$('#ConvenioConveniosForm').bootstrapValidator({
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'data[Convenio][max_sobre]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][max_paquete]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][max_caja]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][max_devol]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][max_otros]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][porcen_declarado]': {
				validators: {
					numeric: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][valor_adicional]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][rangoUnidad][desde][]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][rangoUnidad][hasta][]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][rangoUnidad][descuento][]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][rangoKilo][desde][]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][rangoKilo][hasta][]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			},
			'data[Convenio][rangoKilo][descuento][]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			}

		}
	});

	$("#ConvenioValorSobre, #ConvenioValorPaquete, #ConvenioValorCaja, #ConvenioValorDevol, #ConvenioValorOtros, #ConvenioDeclarado").keyup(function(){
		var strNum = $(this).val();
		var num    = parseFloat(strNum.replace(/,/g,""));
		num        = num.formatMoney(0,',','.');
		$(this).val(num);
		$(this).trigger('change');
	});
	$("#btn-medidas").click( function (){
		if(medidasFlag){
			$("#medidas").show();
			medidasFlag = false;
		} else {
			$("#medidas").hide();
			medidasFlag = true;
		}
	});




	$("#fancybox-excel").click( function (){
		$.fancybox.open({
			href : excelVer,
			type : 'iframe',
			padding : 5,
			width : "80%",
			height: "80%",
			//maxHeight : 200,
			autoScale : false
		});
	});

	$("#fancybox-excelD").click( function (){
		$.fancybox.open({
			href : excelVerD,
			type : 'iframe',
			padding : 5,
			width : "80%",
			height: "80%",
			//maxHeight : 200,
			autoScale : false
		});
	});

	$("#fancybox-otros").click( function (){
		$.fancybox.open({
			href : "otrosConv",
			type : 'iframe',
			padding : 5,
			width : '70%',
			height :300,
			//maxHeight : 200,
			autoScale : false,
			beforeClose: function(){
				retorno = $('.fancybox-iframe').contents().find('#retorno').val();
				$('#ConvenioOtrosEmpaques').val(retorno);
			}
		});
	});
	$('#ConvenioTarifaTodasRegiones').click(function () {
		$('.ConvenioRegion').hide();
		$('.ConvenioDestino1').hide();
		$('.ConvenioDestino2').hide();
	});
	$('#ConvenioTarifaRegion').click(function () {
		$('.ConvenioRegion').show();
		$('.ConvenioDestino1').hide();
		$('.ConvenioDestino2').hide();
	});
	$('#ConvenioTarifaDestino').click(function () {
		$('.ConvenioRegion').show();
		$('.ConvenioDestino1').show();
		$('.ConvenioDestino2').show();
	});


	$("#ConvenioRegion").change(function () {
		//var reg = $("#ConvenioRegion option:selected").text();
		oTable.fnFilter(this.value, 1 );
		$("#ConvenioConveniosForm").data('bootstrapValidator').resetForm();
		$('#ConvenioConveniosForm').bootstrapValidator('validate');		
	});


	$("#ConvenioCliente").keyup( function (){
		oTable.fnFilter(this.value, 2 );
	});

	$("#ConvenioDestino1").keyup( function (){
		oTable.fnFilter(this.value, 6 );
		$("#ConvenioConveniosForm").data('bootstrapValidator').resetForm();
		$('#ConvenioConveniosForm').bootstrapValidator('validate');
	});
	
	$("#ConvenioDestino2").keyup( function (){
		oTable.fnFilter(this.value, 7 );
		$("#ConvenioConveniosForm").data('bootstrapValidator').resetForm();
		$('#ConvenioConveniosForm').bootstrapValidator('validate');
	});


	$("#ConvenioRegion").focus(function () {
		if(isCliente){
			oTable.fnFilterClear();
		}		
		oTable.fnReloadAjax(webroot+'sources/destinos_Tarifas.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Cod depart.';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre depart.';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Cod región';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Nombre región';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Cod destino';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Nombre destino';
		oTable.fnSetColumnVis( 2, false );
		oTable.fnSetColumnVis( 3, false );
		isCliente = false;
	});

	$("#ConvenioDestino1").keyup( function (){
		if(isCliente){
			oTable.fnFilterClear();
		}
		oTable.fnReloadAjax(webroot+'sources/destinos_Tarifas.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Cod depart.';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre depart.';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Cod región';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Nombre región';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Cod destino';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Nombre destino';
		oTable.fnSetColumnVis( 2, false );
		oTable.fnSetColumnVis( 3, false );
		isCliente = false;
	});
	
	$("#ConvenioDestino2").keyup( function (){
		if(isCliente){
			oTable.fnFilterClear();
		}
		oTable.fnReloadAjax(webroot+'sources/destinos_Tarifas.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Cod depart.';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre depart.';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Cod región';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Nombre región';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Cod destino';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Nombre destino';
		oTable.fnSetColumnVis( 2, false );
		oTable.fnSetColumnVis( 3, false );
		isCliente = false;
	});

	$("#ConvenioCliente").focus(function () {
		oTable.fnFilterClear();
		oTable.fnReloadAjax(webroot+'sources/clientes_Tarifas.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Documento';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Contacto';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Dirección';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Teléfono';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Celular';
		oTable.fnSetColumnVis( 2, true );
		oTable.fnSetColumnVis( 3, true );
		isCliente = true;
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	if(isCliente){
		    	$.each( clientes, function( key, value ) {
					if(id == value.Cliente.id){
						$('#ConvenioClienteId').val(value.Cliente.id);
						$('#ConvenioCliente').val(value.Cliente.documento);
						$('#ConvenioNombre').val(value.Cliente.nombres+' '+value.Cliente.apellidos);
						$(".excel").attr("href","excelDescargar/"+value.Cliente.id);
						$(".excelD").attr("href","excelDescargarD/"+value.Cliente.id);
						//excelVer = "excelVer/"+value.Cliente.id;
						excelVer  = $(".excelLink").attr("href")+"/"+value.Cliente.id;
						excelVerD = $(".excelLinkD").attr("href")+"/"+value.Cliente.id;
					}
				});
		    } else {
		    	$.each( destinos, function( key, value ) {
					if(id == value.Destino.id){
						$('#ConvenioDestinoId').val(value.Destino.id);
						$('#ConvenioRegion').val(value.Destino.regionId);
						$('#ConvenioDestino1').val(value.Destino.codigo);
						$('#ConvenioDestino2').val(value.Destino.nombre);

						var clienteId = $('#ConvenioClienteId').val();
						var origen    = $('#ConvenioDestino3').val();
						var destino   = value.Destino.id;
						$("#ConvenioValorAdicional").val("");
						$("#ConvenioDeclarado").val("");
						$("#ConvenioPorcenDeclarado").val("");
						$("#ConvenioMaxSobre").val("");
						$("#ConvenioValorSobre").val("");
						$("#ConvenioMaxCaja").val("");
						$("#ConvenioValorCaja").val("");
						$("#ConvenioMaxPaquete").val("");
						$("#ConvenioValorPaquete").val("");
						$("#ConvenioMaxDevol").val("");
						$("#ConvenioValorDevol").val("");
						$("#ConvenioMaxOtros").val("");
						$("#ConvenioValorOtros").val("");
						$.fancybox.showLoading();
						$.fancybox.helpers.overlay.open();
						$.ajax({
							type: 'json',
							url: fullpath+"tarifas/getTarifa/"+clienteId+"/"+origen+"/"+destino,
							beforeSend: function(xhr) {
								xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
							},
							success: function(response) {
								tarifasArray = JSON.parse(response);
								$.each( tarifasArray, function( key2, value2 ) {
									if(value2.Tarifa.empaque_id == 1){
										$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
										$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
										$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
										$("#ConvenioMaxSobre").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
										$("#ConvenioValorSobre").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
										$("#ConvenioLargoSobre").val(parseFloat(value2.Tarifa.largo).toFixed(0));
										$("#ConvenioAnchoSobre").val(parseFloat(value2.Tarifa.ancho).toFixed(0));
										$("#ConvenioAltoSobre").val(parseFloat(value2.Tarifa.alto).toFixed(0));
										$("#ConvenioPesoSobre").val(parseFloat(value2.Tarifa.peso).toFixed(0));
									} else if(value2.Tarifa.empaque_id == 2){
										$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
										$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
										$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
										$("#ConvenioMaxPaquete").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
										$("#ConvenioValorPaquete").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
										$("#ConvenioLargoPaquete").val(parseFloat(value2.Tarifa.largo).toFixed(0));
										$("#ConvenioAnchoPaquete").val(parseFloat(value2.Tarifa.ancho).toFixed(0));
										$("#ConvenioAltoPaquete").val(parseFloat(value2.Tarifa.alto).toFixed(0));
										$("#ConvenioPesoPaquete").val(parseFloat(value2.Tarifa.peso).toFixed(0));
									} else if(value2.Tarifa.empaque_id == 3){
										$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
										$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
										$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
										$("#ConvenioMaxCaja").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
										$("#ConvenioValorCaja").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
										$("#ConvenioLargoCaja").val(parseFloat(value2.Tarifa.largo).toFixed(0));
										$("#ConvenioAnchoCaja").val(parseFloat(value2.Tarifa.ancho).toFixed(0));
										$("#ConvenioAltoCaja").val(parseFloat(value2.Tarifa.alto).toFixed(0));
										$("#ConvenioPesoCaja").val(parseFloat(value2.Tarifa.peso).toFixed(0));
									} else if(value2.Tarifa.empaque_id == 4){
										$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
										$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
										$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
										$("#ConvenioMaxDevol").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
										$("#ConvenioValorDevol").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
										$("#ConvenioLargoDevol").val(parseFloat(value2.Tarifa.largo).toFixed(0));
										$("#ConvenioAnchoDevol").val(parseFloat(value2.Tarifa.ancho).toFixed(0));
										$("#ConvenioAltoDevol").val(parseFloat(value2.Tarifa.alto).toFixed(0));
										$("#ConvenioPesoDevol").val(parseFloat(value2.Tarifa.peso).toFixed(0));
									} else if(value2.Tarifa.empaque_id == 5){
										$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
										$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
										$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
										$("#ConvenioMaxOtros").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
										$("#ConvenioValorOtros").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
										$("#ConvenioLargoOtros").val(parseFloat(value2.Tarifa.largo).toFixed(0));
										$("#ConvenioAnchoOtros").val(parseFloat(value2.Tarifa.ancho).toFixed(0));
										$("#ConvenioAltoOtros").val(parseFloat(value2.Tarifa.alto).toFixed(0));
										$("#ConvenioPesoOtros").val(parseFloat(value2.Tarifa.peso).toFixed(0));
									}
								});
								$.fancybox.hideLoading();
								$.fancybox.helpers.overlay.close();
							    $("#ConvenioConveniosForm").data('bootstrapValidator').resetForm();
								$('#ConvenioConveniosForm').bootstrapValidator('validate');	
							},
							error: function(e) {
								console.log("An error occurred: " + e.responseText.message);
							}
						});
						/*
						$.each( tarifas, function( key2, value2 ) {
							if(value2.Tarifa.destino == destino && value2.Tarifa.origen == origen && value2.Tarifa.cliente_id == clienteId){
								if(value2.Tarifa.empaque_id == 1){
									$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
									$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
									$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
									$("#ConvenioMaxSobre").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
									$("#ConvenioValorSobre").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
								} else if(value2.Tarifa.empaque_id == 2){
									$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
									$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
									$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
									$("#ConvenioMaxPaquete").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
									$("#ConvenioValorPaquete").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
								} else if(value2.Tarifa.empaque_id == 3){
									$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
									$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
									$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
									$("#ConvenioMaxCaja").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
									$("#ConvenioValorCaja").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
								} else if(value2.Tarifa.empaque_id == 4){
									$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
									$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
									$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
									$("#ConvenioMaxDevol").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
									$("#ConvenioValorDevol").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
								} else if(value2.Tarifa.empaque_id == 5){
									$("#ConvenioValorAdicional").val(parseFloat(value2.Tarifa.valor_adicional).toFixed(0));
									$("#ConvenioDeclarado").val(parseFloat(value2.Tarifa.declarado).toFixed(0));
									$("#ConvenioPorcenDeclarado").val(parseFloat(value2.Tarifa.porcen_declarado).toFixed(0));
									$("#ConvenioMaxOtros").val(parseFloat(value2.Tarifa.max_kilo).toFixed(0));
									$("#ConvenioValorOtros").val(parseFloat(value2.Tarifa.tarifa).toFixed(0));
								}
							}
						});

						var clienteIdAux = parseFloat($('#ConvenioClienteId').val());
						console.log(origen+"-"+destino+"-"+clienteIdAux);
						descuentoActual = new Array();
						if(descuentos[origen][destino] != null){
							if(descuentos[origen][destino][clienteIdAux] != null){
								descuentoActual  = descuentos[origen][destino][clienteIdAux];
							}
						}
						var arrayDes = new Array();
						if(descuentoActual.Todo != null){
							arrayDes = descuentoActual.Todo;
						} else {
							viewModel.removeUnidadTotal();
						}
						viewModel.loadUpdatedData(arrayDes);
						*/
					}
				});
		    }
	    }

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

	oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/clientes_Tarifas.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"bScrollCollapse": true,

		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
		"sUrl": webroot + 'files/es.txt'
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		//		"iDisplayLength": 10,
		"bJQueryUI": true,		
		"bAutoWidth": false,
	    "aoColumns": [
	        { "sWidth": "0%" },
	        { "sWidth": "0%"},
	        { "sWidth": "10%"},
	        { "sWidth": "25%"},
	        { "sWidth": "10%"},
	        { "sWidth": "20%"},
	        { "sWidth": "20%"},
	        { "sWidth": "20%"}

	    ],

		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0, 1 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});


})


$.fn.dataTableExt.oApi.fnFilterClear  = function ( oSettings ) {
    oSettings.oPreviousSearch.sSearch = "";	      
    if ( typeof oSettings.aanFeatures.f != 'undefined' ) {
        var n = oSettings.aanFeatures.f;
        for ( var i=0, iLen=n.length ; i<iLen ; i++ ) {
            $('input', n[i]).val( '' );
        }
    }

    for ( var i=0, iLen=oSettings.aoPreSearchCols.length ; i<iLen ; i++ ) {
    	oSettings.aoPreSearchCols[i].sSearch = "";
    }
    oSettings.oApi._fnReDraw( oSettings );
};

$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw ) {
	if ( sNewSource !== undefined && sNewSource !== null ) {
	    oSettings.sAjaxSource = sNewSource;
	} 
	if ( oSettings.oFeatures.bServerSide ) {
	    this.fnDraw();
	    return;
	}

	this.oApi._fnProcessingDisplay( oSettings, true );
	var that = this;
	var iStart = oSettings._iDisplayStart;
	var aData = [];

	this.oApi._fnServerParams( oSettings, aData ); 
	oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
	    that.oApi._fnClearTable( oSettings );
	    var aData =  (oSettings.sAjaxDataProp !== "") ?
	    that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json; 
	    for ( var i=0 ; i<aData.length ; i++ ){
	        that.oApi._fnAddData( oSettings, aData[i] );
	    }         
	    oSettings.aiDisplay = oSettings.aiDisplayMaster.slice(); 
	    that.fnDraw(); 
	    if ( bStandingRedraw === true ){
	        oSettings._iDisplayStart = iStart;
	        that.oApi._fnCalculateEnd( oSettings );
	        that.fnDraw( false );
	    } 
	    that.oApi._fnProcessingDisplay( oSettings, false );
	    if ( typeof fnCallback == 'function' && fnCallback !== null ){
	        fnCallback( oSettings );
	    }
	}, oSettings );

};
</script>