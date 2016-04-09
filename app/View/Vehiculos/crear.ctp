<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.jsontotable.min');
?>
<div class="row" style="width:90%; margin-left:5%;">

	<div><h3><center>VEHICULOS</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Vehiculo',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('conductor_id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','default'=>$usuario_actual['role_id'])); ?>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('placa',array('label'=>'Placa: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'select','options'=>$tipo,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('marca',array('label'=>'Marca: ','type'=>'select','options'=>$marca,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('modelo',array('label'=>"Modelo: ",'type'=>'text')); ?></div>
    </div>
    <br>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('soat',array('label'=>'Vencimiento SOAT: ','type'=>'text','placeholder'=>'AAAA-MM-DD')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('tecnomecanica',array('label'=>'Vencimiento Tecnico-Mecanica:','type'=>'text','placeholder'=>'AAAA-MM-DD','class'=>'')); ?></div>
   		<div class="col-md-3"><?php echo $this->Form->input('numero_motor',array('label'=>'Nro Motor:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('numero_chasis',array('label'=>'Nro Chasis:','type'=>'text')); ?></div>
    </div>
	<h3 style="margin-top:0px;"><center>PROPIETARIOS</center></h3>
	<div class="form-group col-md-12">
		<div class="col-md-20"><?php echo $this->Form->input('identificacion',array('label'=>'Documento:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('nombre1',array('label'=>'1er Nombre:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('nombre2',array('label'=>'2do Nombre:','type'=>'text')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('apellido1',array('label'=>'1er Apellido:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('apellido2',array('label'=>'2do Apellido:','type'=>'text')); ?></div>
		</div>
	<div class="form-group col-md-12">
		<div class="col-md-20"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
		<div class="col-md-20"><?php echo $this->Form->input('ciudad',array('label'=>'Municipio:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text')); ?></div>	
		<div class="col-md-1"><?php echo $this->Form->input('dv',array('label'=>'D.V.:','type'=>'text')); ?></div>
	</div>
	
	<div class="form-group col-md-12 btns">
	    <div class="plegTitulo col-md-12 btn btn-default">Observaciones<span style="margin-left: 5px;" class="caret"></span></div>
		<plegContenido><?php echo $this->Form->input('observaciones',array('label'=>false,'type'=>'textarea')); ?></plegContenido>
	</div>
	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
		<thead>
			<tr>
				<th>id</th>
				<th>Placa</th>
				<th>Tipo</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Nro Motor</th>
				<th>Nro Chasis</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

	<div class="form-group btns">
		<?php echo $this->Form->button('Guardar',array('class'=>'btn btn-primary'));?>
	</div>
	<?php echo $this->Form->end();?>
	<br>

</div>
<script>
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

   // var destinos           = <?php echo json_encode($destinos); ?>;
    var vehiculos          = <?php echo json_encode($vehiculos); ?>;
    var propietarios       = <?php echo json_encode($propietarios); ?>;
    var vehiculosPlacas    = new Array();
    var propietariosSearch = new Array();
	var webroot            = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var isVehiculo         = true;


	var contactosIniciales = [
		{desde: "", hasta: "", descuento: ""}
	];





	var User = function(data) {
		var self        = this;
		self.id         = data.id;
		self.desde      = data.desde;
		self.hasta      = data.hasta;
		self.descuento  = data.descuento;
		self.desde2     = data.desde2;
		self.hasta2     = data.hasta2;
		self.descuento2 = data.descuento2;
	}
	var dataMappingOptions = {
	    key: function(data) {
	        return data.id;
	    },
	    create: function(options) {
	        return new User(options.data);
	    }
	};
	var viewModel = {
	    users: ko.mapping.fromJS([]),
	    loadUpdatedData: function(newData) {
	        ko.mapping.fromJS(newData, viewModel.users);
	    }
	};
	viewModel.addUser = function() {
		viewModel.users.push(new User({id: 0, desde:"", hasta:"", descuento:"", desde2:"", hasta2:"", descuento2:""}));
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);


$(document).ready(function(){
	viewModel.users.push(new User({id: 0, desde:"", hasta:"", descuento:""}));

	$('#VehiculoCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});


	$("#VehiculoDestinos").chosen({
    	no_results_text           : 'No se encuentra el destino.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_multiple : "Seleccione los destinos"
    });


	$("#VehiculoSoat").datepicker();
	$("#VehiculoTecnomecanica").datepicker();

	$("plegContenido").hide();
	$(".plegTitulo").click(function(event){
		var desplegable = $(this).next();
		//$('plegContenido').not(desplegable).slideUp('fast'); // Varios items
		desplegable.slideToggle('fast');
		event.preventDefault();
	})

	$.each( vehiculos, function( key, value ) {
		vehiculosPlacas[key] = value.Vehiculo.placa;
	});
	$.each( propietarios, function( key, value ) {
		propietariosSearch[key] = value.Conductor.identificacion;
	});

	$("#VehiculoIdentificacion").focus(function(){
		oTable.fnReloadAjax(webroot+'sources/propietarios.txt');
		oTable.fnSettings().aoColumns[1].nTh.innerHTML = 'Identificación';
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Nombre';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Ciudad';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Telefono';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Celular';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Dirección';
		isVehiculo = false;

	});
	$("#VehiculoPlaca").focus(function(){
		oTable.fnReloadAjax(webroot+'sources/vehiculos.txt');
		oTable.fnSettings().aoColumns[1].nTh.innerHTML = 'Placa';
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Tipo';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Marca';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Modelo';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Nro Motor';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Nro Chasis';
		isVehiculo = true;
	});

	$(function() {
		$( "#VehiculoPlaca" ).autocomplete({
			source: vehiculosPlacas,
			select: function( event, ui ) {
				$.each( vehiculos, function( key, value ) {
					if(ui.item.value == value.Vehiculo.placa){
						$('#VehiculoId').val(value.Vehiculo.id);
						$('#VehiculoTipo').val(value.Vehiculo.tipo);
						$('#VehiculoMarca').val(value.Vehiculo.marca);
						$('#VehiculoModelo').val(value.Vehiculo.modelo);
						$('#VehiculoSoat').val(value.Vehiculo.soat);
						$('#VehiculoTecnomecanica').val(value.Vehiculo.tecnomecanica);
						$("#VehiculoNumeroMotor").val(value.Vehiculo.numero_motor);
						$("#VehiculoNumeroChasis").val(value.Vehiculo.numero_chasis);
						$('#VehiculoConductorId').val(value.Vehiculo.conductor_id);

						$("#VehiculoValorAdicional").val(value.Vehiculo.valor_adicional);
						$("#VehiculoValorSobre").val(value.Vehiculo.valor_sobre);
						$("#VehiculoValorPaquete").val(value.Vehiculo.valor_paquete);
						$("#VehiculoValorCaja").val(value.Vehiculo.valor_caja);
						$("#VehiculoValorDevol").val(value.Vehiculo.valor_devol);
						$("#VehiculoMaxSobre").val(value.Vehiculo.max_sobre);
						$("#VehiculoMaxPaquete").val(value.Vehiculo.max_paquete);
						$("#VehiculoMaxCaja").val(value.Vehiculo.max_caja);
						$("#VehiculoMaxDevol").val(value.Vehiculo.max_devol);

						$("#VehiculoValorBase").val(value.Vehiculo.valor_base);
						$("#VehiculoMaxBase").val(value.Vehiculo.max_base);

						viewModel.removeUserTotal();
						if(value.Vehiculo.rangoUnidad != null){
							viewModel.loadUpdatedData(value.Vehiculo.rangoUnidad);
						}

						$("#VehiculoIdentificacion").val(value.Conductor.identificacion);
						$("#VehiculoNombre1").val(value.Conductor.nombre1);
						$("#VehiculoNombre2").val(value.Conductor.nombre2);
						$("#VehiculoApellido1").val(value.Conductor.apellido1);
						$("#VehiculoApellido2").val(value.Conductor.apellido2);
						$("#VehiculoDireccion").val(value.Conductor.direccion);
						$("#VehiculoCiudad").val(value.Conductor.ciudad);
						$("#VehiculoTelefono").val(value.Conductor.telefono);
						$("#VehiculoCelular").val(value.Conductor.celular);
						$("#VehiculoDv").val(value.Conductor.dv);
						$("#VehiculoObservaciones").val(value.Vehiculo.observaciones);


					}
				});
			}
		});

		$( "#VehiculoIdentificacion" ).autocomplete({
			source: propietariosSearch,
			select: function( event, ui ) {
				$.each( propietarios, function( key, value ) {
					if(ui.item.value == value.Conductor.identificacion){

						$('#VehiculoConductorId').val(value.Conductor.id);
						$("#VehiculoIdentificacion").val(value.Conductor.identificacion);
						$("#VehiculoNombre1").val(value.Conductor.nombre1);
						$("#VehiculoNombre2").val(value.Conductor.nombre2);
						$("#VehiculoApellido1").val(value.Conductor.apellido1);
						$("#VehiculoApellido2").val(value.Conductor.apellido2);
						$("#VehiculoDireccion").val(value.Conductor.direccion);
						$("#VehiculoCiudad").val(value.Conductor.ciudad);
						$("#VehiculoTelefono").val(value.Conductor.telefono);
						$("#VehiculoCelular").val(value.Conductor.celular);
						$("#VehiculoDv").val(value.Conductor.dv);

					}
				});
			}
		});
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
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	if(isVehiculo) {
	    		$.each( vehiculos, function( key, value ) {
					if(id == value.Vehiculo.id){
						$('#VehiculoId').val(value.Vehiculo.id);
						$('#VehiculoPlaca').val(value.Vehiculo.placa);
						$('#VehiculoTipo').val(value.Vehiculo.tipo);
						$('#VehiculoMarca').val(value.Vehiculo.marca);
						$('#VehiculoModelo').val(value.Vehiculo.modelo);
						$('#VehiculoSoat').val(value.Vehiculo.soat);
						$('#VehiculoTecnomecanica').val(value.Vehiculo.tecnomecanica);
						$('#VehiculoNumeroMotor').val(value.Vehiculo.numero_motor);
						$('#VehiculoNumeroChasis').val(value.Vehiculo.numero_chasis);
						$('#VehiculoObservaciones').val(value.Vehiculo.observaciones);

						$("#VehiculoValorAdicional").val(value.Vehiculo.valor_adicional);
						$("#VehiculoValorSobre").val(value.Vehiculo.valor_sobre);
						$("#VehiculoValorPaquete").val(value.Vehiculo.valor_paquete);
						$("#VehiculoValorCaja").val(value.Vehiculo.valor_caja);
						$("#VehiculoValorDevol").val(value.Vehiculo.valor_devol);
						$("#VehiculoMaxSobre").val(value.Vehiculo.max_sobre);
						$("#VehiculoMaxPaquete").val(value.Vehiculo.max_paquete);
						$("#VehiculoMaxCaja").val(value.Vehiculo.max_caja);
						$("#VehiculoMaxDevol").val(value.Vehiculo.max_devol);
						$("#VehiculoValorBase").val(value.Vehiculo.valor_base);
						$("#VehiculoMaxBase").val(value.Vehiculo.max_base);
						
						viewModel.removeUserTotal();
						if(value.Vehiculo.rangoUnidad != null){
							viewModel.loadUpdatedData(value.Vehiculo.rangoUnidad);
						}

						$('#VehiculoConductorId').val(value.Conductor.id);
						$("#VehiculoIdentificacion").val(value.Conductor.identificacion);
						$("#VehiculoNombre1").val(value.Conductor.nombre1);
						$("#VehiculoNombre2").val(value.Conductor.nombre2);
						$("#VehiculoApellido1").val(value.Conductor.apellido1);
						$("#VehiculoApellido2").val(value.Conductor.apellido2);
						$("#VehiculoDireccion").val(value.Conductor.direccion);
						$("#VehiculoCiudad").val(value.Conductor.ciudad);
						$("#VehiculoTelefono").val(value.Conductor.telefono);
						$("#VehiculoCelular").val(value.Conductor.celular);
						$("#VehiculoDv").val(value.Conductor.dv);

						$("#VehiculoDestinos option").attr("selected",false);
						if(value.Vehiculo.destinos != null){
							$.each( value.Vehiculo.destinos, function( key2, value2 ) {
								$("#VehiculoDestinos option").each(function( key, value ) {
									var actual = $(value).val();
									if(actual == value2){
										$(this).attr("selected","selected");
										$("#VehiculoDestinos").trigger("chosen:updated");
									}
								});
							});
						} else {
							$("#VehiculoDestinos").trigger("chosen:updated");
						}
					}
				});
	    	} else {
	    		$.each( propietarios, function( key, value ) {
					if(id == value.Conductor.id){
						$('#VehiculoConductorId').val(value.Conductor.id);
						$("#VehiculoIdentificacion").val(value.Conductor.identificacion);
						$("#VehiculoNombre1").val(value.Conductor.nombre1);
						$("#VehiculoNombre2").val(value.Conductor.nombre2);
						$("#VehiculoApellido1").val(value.Conductor.apellido1);
						$("#VehiculoApellido2").val(value.Conductor.apellido2);
						$("#VehiculoDireccion").val(value.Conductor.direccion);
						$("#VehiculoCiudad").val(value.Conductor.ciudad);
						$("#VehiculoTelefono").val(value.Conductor.telefono);
						$("#VehiculoCelular").val(value.Conductor.celular);
						$("#VehiculoDv").val(value.Conductor.dv);
					}
				});
	    	}
	    }
	    $('#VehiculoCrearForm').data('bootstrapValidator').resetForm();
		$('#VehiculoCrearForm').bootstrapValidator('validate');
	});


	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/vehiculos.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumns": [
			{ "sWidth": "0%" },
			{ "sWidth": "15%" },
			{ "sWidth": "25%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "20%" }
		],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

	})
</script>