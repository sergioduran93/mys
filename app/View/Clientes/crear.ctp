<?php 
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
?>

<div class="row" style="width:90%; margin-left:5%;">   

	<br>
	<div><h3><center>CLIENTES</center></h3></div>
	<fieldset>
	<?php echo $this->Form->create('Cliente',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','default'=>$usuario_actual['role_id'])); ?>
	<div class="form-group col-md-12">
	    <div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'select','options'=>$tipo,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('persona',array('label'=>'Persona: ','type'=>'select','options'=>$persona,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-2" id="causalDiv"><?php echo $this->Form->input('causal',array('label'=>'Causal: ','type'=>'select','options'=>$causal,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-2" id="creditoDiv"><?php echo $this->Form->input('credito',array('label'=>"Tiene credito:",'type'=>'select','options'=>$credito,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-2" id="activoDiv"><?php echo $this->Form->input('activo',array('label'=>'Activo: ','type'=>'select','options'=>$activo,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	</div>
	<div class="form-group col-md-12">
	    <div class="col-md-4"><?php echo $this->Form->input('documento',array('label'=>'<span id="label-documento">Documento:</span>','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-4"><?php echo $this->Form->input('nombres',array('label'=>'Nombres:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-4 ClienteApellidosDiv"><?php echo $this->Form->input('apellidos',array('label'=>'Apellidos:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	</div>
	<div class="form-group col-md-12">
	    <div class="col-md-3"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
	    <div class="col-md-1"><?php echo $this->Form->input('indicativo',array('label'=>'Indicativo:','type'=>'text','class'=>'col-md-50','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('telefono2',array('label'=>'Teléfono 2:','type'=>'text')); ?></div>
	    <div class="col-md-2"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text')); ?></div>
	</div>
	<div class="form-group col-md-12">
	    <div class="col-md-4"><?php echo $this->Form->input('ciudad',array('label'=>'Ciudad:','type'=>'select','options'=>$destinos,'class'=>'chosen-select','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
	    <div class="col-md-3"><?php echo $this->Form->input('fax',array('label'=>'Fax:','type'=>'text')); ?></div>    	
	    <div class="col-md-3"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
	    <div class="col-md-2" id="especialDiv"><?php echo $this->Form->input('especial',array('label'=>'Especial:','type'=>'select','options'=>$especial,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	</div>
	<div class="form-group col-md-12">
	    <div class="col-md-20" id="plazoDiv"><?php echo $this->Form->input('numero_guias',array('label'=>'Plazo pago:','type'=>'text','class'=>'col-md-50','placeholder'=>'Dias')); ?></div>
		<div class="col-md-20" id="suspendeDiv"><?php echo $this->Form->input('dias_facturacion',array('label'=>'Suspende servicio:','type'=>'text','placeholder'=>'Dias')); ?></div>
	    <div class="col-md-20" id="cupoDiv"><?php echo $this->Form->input('cupo',array('label'=>'Cupo: ','type'=>'text')); ?></div>
	    <div class="col-md-20" id="carteraDiv"><?php echo $this->Form->input('cartera_negociable',array('label'=>'Cartera negociable:','type'=>'select','options'=>$cartera)); ?></div>
		<div class="col-md-20" style="padding-top:25px;"><?php echo $this->Form->input('facturar',array('label'=>'Facturar a otro','type'=>'checkbox','id'=>'facturar')); ?></div>
	</div>
	<div class="form-group col-md-12 facturar-fieldset">
	    <div class="col-md-3"><?php echo $this->Form->input('documento_fact',array('label'=>'Documento:','type'=>'text')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('nombres_fact',array('label'=>'Nombres:','type'=>'text')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('direccion_fact',array('label'=>'Dirección:','type'=>'text')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('telefono_fact',array('label'=>'Teléfono:','type'=>'text')); ?></div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-12"><?php echo $this->Form->input('remitentes',array('label'=>'Remitentes: ','multiple'=>true,'class'=>'chosen-select','type'=>'select','options'=>$remitentes)); ?></div>
	</div>
	<div class="form-group col-md-12 btns">
		<div class="panel panel-info thumbnail col-md-12" style="margin-bottom:0px;">
			<div class ="panel-heading">
				<span style="font-weight: bold">Contactos:</span>
				<div style="padding: 0px 15px 0px 10px; float:right;" class="btn btn-success" data-bind='click: addUser'>
					<span class="glyphicon glyphicon-plus"></span> Agregar
				</div>
			</div>
			<table class='contactsEditor col-md-12'>
		        <tr>
		            <th>Cargo/Parentesco</th>
		            <th>Nombre</th>
		            <th>Teléfono</th>
		            <th>Correo</th>
		            <th></th>
		        </tr>
		        <tbody data-bind="foreach: users">
		            <tr>
		                <td><input type="text" name="data[Cliente][contacto][cargo][]" data-bind='value: cargo'/></td>
		                <td><input type="text" name="data[Cliente][contacto][nombre][]" data-bind='value: nombre'/></td>
		                <td><input type="text" name="data[Cliente][contacto][telefono][]" data-bind='value: telefono'/></td>
		                <td><input type="text" name="data[Cliente][contacto][correo][]" data-bind='value: correo'/></td>
		                <td style="padding:0px; float:right;" class="btn btn-danger" data-bind='click: $root.removeUser'>
							<span class="glyphicon glyphicon-remove"></span>
						</td>
		            </tr>
		        </tbody>
		    </table>
		</div>
	</div>
	<table id="tabla_id">
		<thead> 
			<tr>
				<th>id</th>
				<th>Documento</th>
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Teléfono 2</th>
				<th>Dirección</th>
				<th>Celular</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<?php echo $this->Form->submit("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
</div>

<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."clientes'"; ?>;
	var clientes = <?php echo json_encode($clientes); ?>;
	var role     = <?php echo $usuario_actual['role_id']; ?>;
$(document).ready(function(){

	if(role == 3){
		$("#causalDiv").hide();
		$("#creditoDiv").hide();
		$("#activoDiv").hide();
		$("#especialDiv").hide();
		$("#plazoDiv").hide();
		$("#suspendeDiv").hide();
		$("#cupoDiv").hide();
		$("#carteraDiv").hide();
	}

	$('#ClienteCrearForm').bootstrapValidator({
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$("#ClienteRemitentes").chosen({
    	no_results_text           : 'No se encuentra el remitente.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_multiple : "Seleccione los remitentes"
    });
	$("#ClienteCiudad").chosen({
    	no_results_text           : 'No se encuentra la ciudad.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_single : "Seleccione una ciudad"
    });

	$("#ClientePersona").change(function(){
		if($(this).val() == "Juridica"){
			$(".ClienteApellidosDiv").hide();
			$("#label-documento").text("Identificación: ");
		} else {
			$(".ClienteApellidosDiv").show();
			$("#label-documento").text("Documento: ");
		}
	});

	$(".facturar-fieldset").hide();	
	$("#facturar").change(function(){
		if($("#facturar").is(':checked')){
			$(".facturar-fieldset").show();
		} else {
			$(".facturar-fieldset").hide();
		}
	});

	$("#ClienteTipo").change(function(){
		if($(this).val() == "Clientes"){
			$("#ClienteDiasFacturacion").attr("readonly",false);
			$("#ClienteDiasFacturacion").removeClass("readonly-fondo");
			$("#ClienteCupo").attr("readonly",false);
			$("#ClienteCupo").removeClass("readonly-fondo");
			$(".fieldset-contactos").show();
			$("#ClienteCarteraNegociable").removeAttr("disabled");
			$("#ClienteCarteraNegociable").removeClass("readonly-fondo");
			$("#ClienteNumeroGuias").attr("readonly",false);
			$("#ClienteNumeroGuias").removeClass("readonly-fondo");
			$("#ClienteEspecial").removeAttr("disabled");
			$("#ClienteEspecial").removeClass("readonly-fondo");			
		} else if($(this).val() == "Vendedor"){
			$("#ClienteDiasFacturacion").attr("readonly",true);
			$("#ClienteDiasFacturacion").addClass("readonly-fondo");
			$("#ClienteCupo").attr("readonly",true);
			$("#ClienteCupo").addClass("readonly-fondo");
			$(".fieldset-contactos").hide();
			$("#ClienteCarteraNegociable").attr("disabled","disabled");
			$("#ClienteCarteraNegociable").addClass("readonly-fondo");
			$("#ClienteNumeroGuias").attr("readonly",true);
			$("#ClienteNumeroGuias").addClass("readonly-fondo");
			$("#ClienteEspecial").attr("disabled","disabled");
			$("#ClienteEspecial").addClass("readonly-fondo");
		}
	});

	var User = function(data) {
		var self      = this;
		self.id       = data.id;
		self.cargo    = data.cargo;
		self.nombre   = data.nombre;
		self.telefono = data.telefono;
		self.correo   = data.correo;
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
	    },
	};
	viewModel.addUser = function() {
	    viewModel.users.push(new User({ id: 0, cargo:"", nombre:"", telefono: "" ,correo: ""}));
	};
	viewModel.removeUser = function(selected) {
		if(confirm('¿Esta seguro de eliminar este contacto?')){
			viewModel.users.remove(selected);
		}
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);
	viewModel.addUser();


	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( clientes, function( key, value ) {
				if(id == value.Cliente.id){
					$('#ClienteId').val(value.Cliente.id);
					$('#ClienteTipo').val(value.Cliente.tipo);
					$('#ClientePersona').val(value.Cliente.persona);
					if(value.Cliente.persona == "Juridica") {
						$(".ClienteApellidosDiv").hide();
						$("#label-documento").text("Identificación: ");
					} else {
						$(".ClienteApellidosDiv").show();
						$("#label-documento").text("Documento: ");
					}

					$("#ClienteRemitentes option").attr("selected",false);
					if(value.Cliente.remitentes.length > 0){
						$.each( value.Cliente.remitentes, function( key2, value2 ) {
							$("#ClienteRemitentes option").each(function( key, value ) {
								var actual = $(value).val();
								if(actual == value2){
									$(this).attr("selected","selected");
								}
							});
						});
					}
					$("#ClienteRemitentes").trigger("chosen:updated");

					$('#ClienteCiudad').val(value.Cliente.ciudad);
					$("#ClienteCiudad").trigger("chosen:updated");
					$('#ClienteActivo').val(value.Cliente.activo);
					$('#ClienteCausal').val(value.Cliente.causal);
					$('#ClienteCredito').val(value.Cliente.credito);
					$('#ClienteDiasFacturacion').val(value.Cliente.dias_facturacion);
					$('#ClienteEspecial').val(value.Cliente.especial);
					$('#ClienteCelular').val(value.Cliente.celular);
					$('#ClienteFax').val(value.Cliente.fax);
					$('#ClienteNumeroGuias').val(value.Cliente.numero_guias);
					$('#ClienteEmail').val(value.Cliente.email);
					$('#ClienteCarteraNegociable').val(value.Cliente.cartera_negociable);
				//	$('#facturar').val(value.Cliente.facturar);
					if(value.Cliente.facturar == 1){
						$('#facturar').prop('checked',true);
						$(".facturar-fieldset").show();
						$('#ClienteDocumentoFact').val(value.Cliente.documento_fact);
						$('#ClienteNombresFact').val(value.Cliente.nombres_fact);
						$('#ClienteDireccionFact').val(value.Cliente.direccion_fact);
						$('#ClienteTelefonoFact').val(value.Cliente.telefono_fact);
					} else {
						$('#facturar').prop('checked',false);
						$(".facturar-fieldset").hide();
						$('#ClienteDocumentoFact').val("");
						$('#ClienteNombresFact').val("");
						$('#ClienteDireccionFact').val("");
						$('#ClienteTelefonoFact').val("");
					}
					$('#ClienteDocumento').val(value.Cliente.documento);
					$('#ClienteNombres').val(value.Cliente.nombres);
					$('#ClienteCupo').val(value.Cliente.cupo);
					$('#ClienteApellidos').val(value.Cliente.apellidos);
					$('#ClienteDireccion').val(value.Cliente.direccion);
					$('#ClienteIndicativo').val(value.Cliente.indicativo);
					$('#ClienteTelefono').val(value.Cliente.telefono);
					$('#ClienteTelefono2').val(value.Cliente.telefono2);
	    			viewModel.users.removeAll();
					viewModel.loadUpdatedData(value.Cliente.contacto);
				}
			});
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

	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/clientes.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar: '+aData[2]+' ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';
			$('td:eq(6)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0,7 ] },
			{ "bSortable": false, "aTargets": [0,7] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

	})
</script>