<?php 
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox');
?>

<div class="row" style="width:90%; margin-left:5%;">   

	<br>
	<div><h3><center>CLIENTE NUEVO</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Cliente',array('class'=>'form-inline'));?>
    <?php echo $this->Form->input('info',array('type'=>'hidden','default'=>'[]')); ?>
    <?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'hidden','default'=>'Clientes')); ?>

    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('persona',array('label'=>'Persona: ','type'=>'select','options'=>$persona,'empty'=>"")); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('causal',array('label'=>'Causal: ','type'=>'select','options'=>$causal,'empty'=>"")); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('credito',array('label'=>"Tiene credito:",'type'=>'select','options'=>$credito,'empty'=>"")); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('activo',array('label'=>'Activo: ','type'=>'select','options'=>$activo)); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('documento',array('label'=>'<span id="label-documento">Documento:</span>','type'=>'text')); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('nombres',array('label'=>'Nombres:','type'=>'text')); ?></div>
        <div class="col-md-4 ClienteApellidosDiv"><?php echo $this->Form->input('apellidos',array('label'=>'Apellidos:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text')); ?></div>    	
        <div class="col-md-1"><?php echo $this->Form->input('indicativo',array('label'=>'Indicativo:','type'=>'text','class'=>'col-md-50')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono2',array('label'=>'Teléfono 2:','type'=>'text')); ?></div>
        <div class="col-md-2"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('ciudad',array('label'=>'Ciudad:','type'=>'select','options'=>$destinos,'class'=>'chosen-select')); ?></div>    	
        <div class="col-md-3"><?php echo $this->Form->input('fax',array('label'=>'Fax:','type'=>'text')); ?></div>    	
        <div class="col-md-3"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
        <div class="col-md-2"><?php echo $this->Form->input('especial',array('label'=>'Especial:','type'=>'select','options'=>$especial)); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-20"><?php echo $this->Form->input('numero_guias',array('label'=>'Nro. impresiones:','type'=>'text','class'=>'col-md-50')); ?></div>
    	<div class="col-md-20"><?php echo $this->Form->input('dias_facturacion',array('label'=>'Dias de Fact.:','type'=>'text')); ?></div>
        <div class="col-md-20"><?php echo $this->Form->input('cupo',array('label'=>'Cupo: ','type'=>'text')); ?></div>
        <div class="col-md-20"><?php echo $this->Form->input('cartera_negociable',array('label'=>'Cartera negociable:','type'=>'select','options'=>$cartera)); ?></div>
		<div class="col-md-20" style="padding-top:25px;"><?php echo $this->Form->input('facturar',array('label'=>'Facturar a otro','type'=>'checkbox','id'=>'facturar')); ?></div>
    </div>
    <div class="form-group col-md-12 facturar-fieldset">
        <div class="col-md-20"><?php echo $this->Form->input('documento_fact',array('label'=>'Documento:','type'=>'text')); ?></div>
        <div class="col-md-20"><?php echo $this->Form->input('nombres_fact',array('label'=>'Nombres:','type'=>'text')); ?></div>
        <div class="col-md-20"><?php echo $this->Form->input('apellidos_fact',array('label'=>'Apellidos:','type'=>'text')); ?></div>
        <div class="col-md-20"><?php echo $this->Form->input('direccion_fact',array('label'=>'Dirección:','type'=>'text')); ?></div>
        <div class="col-md-20"><?php echo $this->Form->input('telefono_fact',array('label'=>'Teléfono:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
		<div class="col-md-12"><?php echo $this->Form->input('remitentes',array('label'=>'Remitentes: ','multiple'=>true,'class'=>'chosen-select','type'=>'select','options'=>$remitentes)); ?></div>
	</div>
    <div class="form-group col-md-12 btns">
    	<div class="panel panel-info thumbnail col-md-6" style="margin-bottom:0px;">
			<div class ="panel-heading">
				<span style="font-weight: bold">Contactos:</span>
				<div style="padding: 0px 15px 0px 10px; float:right;" class="btn btn-success" data-bind='click: addUser'>
					<span class="glyphicon glyphicon-plus"></span> Agregar
				</div>
			</div>
			<table class='contactsEditor'>
		        <tr>
		            <th>Cargo/Parentesco</th>
		            <th>Nombre</th>
		            <th>Teléfono</th>
		            <th></th>
		        </tr>
		        <tbody data-bind="foreach: users">
		            <tr>
		                <td><input type="text" name="data[Cliente][contacto][cargo][]" data-bind='value: cargo'/></td>
		                <td><input type="text" name="data[Cliente][contacto][nombre][]" data-bind='value: nombre'/></td>
		                <td><input type="text" name="data[Cliente][contacto][telefono][]" data-bind='value: telefono'/></td>
		                <td style="padding:0px; float:right;" class="btn btn-danger" data-bind='click: $root.removeUser'>
							<span class="glyphicon glyphicon-remove"></span>
						</td>
		            </tr>
		        </tbody>
		    </table>
    	</div>
    </div>
	<?php echo $this->Form->button("Guardar",array("id"=>'btn-guardar',"type"=>'button',"class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
</div>

<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var fullpath = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var postData;
	var sendInfo = new Array();
$(document).ready(function(){

	$("#btn-guardar").click(function(){
		postData = $("#ClienteCrear2Form").serializeArray();
		var formURL  = $("#ClienteCrear2Form").attr("action");
		var posting  = $.post( formURL, postData);
		posting.done(function( data ) {
			var doc = $("#ClienteDocumento").val();
			var nom = $("#ClienteNombres").val();
			var ape = $("#ClienteApellidos").val();
			var dir = $("#ClienteDireccion").val();
			var tel = $("#ClienteTelefono").val();
			var te2 = $("#ClienteTelefono2").val();
			var ema = $("#ClienteEmail").val();
			var fax = $("#ClienteFax").val();
			var rem = $("#ClienteRemitentes").val();
			sendInfo[0] = doc;
			sendInfo[1] = nom+" "+ape;
			sendInfo[2] = dir;
			sendInfo[3] = tel;
			sendInfo[4] = te2;
			sendInfo[5] = ema;
			sendInfo[6] = fax;
			sendInfo[7] = rem;
			var jsonInfo = JSON.stringify(sendInfo);
			$("#ClienteInfo").val(jsonInfo);
			parent.$.fancybox.close();
		});
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
    	placeholder_text_single   : "Seleccione una ciudad"
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
	    var self = this;
	    self.id = data.id;
	    self.cargo = data.cargo;
	    self.nombre = data.nombre;
		self.telefono = data.telefono;
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
	    viewModel.users.push(new User({ id: 0, cargo:"", nombre:"", telefono: "" }));
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



	})
</script>