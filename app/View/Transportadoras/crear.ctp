<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
?>

<div class="row" style="width:90%; margin-left:5%;">   

	<br>
	<div><h3><center>TRANSPORTADORAS</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Transportadora',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','default'=>$usuario_actual['role_id'])); ?>
    <div class="form-group col-md-12">
        <div class="col-md-5"><?php echo $this->Form->input('nit',array('label'=>'NIT: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-1"><?php echo $this->Form->input('dv',array('label'=>'D.V.: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-6"><?php echo $this->Form->input('razon',array('label'=>"Razón social: ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('contacto',array('label'=>'Contacto:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono1',array('label'=>'Teléfono1:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono2',array('label'=>'Teléfono2:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">        
        <div class="col-md-3"><?php echo $this->Form->input('telefono3',array('label'=>'Teléfono3:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono4',array('label'=>'Teléfono4:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('fax',array('label'=>'Fax:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
            </div>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('credito',array('label'=>'Crédito:','type'=>'select','options'=>$credito,'empty'=>'','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('activo',array('label'=>'Activo:','type'=>'select','options'=>$activo,'empty'=>'','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
    </div>
    <div class="form-group col-md-12" style="margin-bottom: 10px;">
		<div class="col-md-12"><?php echo $this->Form->input('destinos',array('label'=>'Destinos: ','multiple'=>true,'class'=>'chosen-select','type'=>'select','options'=>$destinos,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	</div>
	<div class="panel panel-default col-md-12" style="margin-bottom: 10px;padding:0px;margin-left:30px;width: 94%;">
		<div class="panel-heading">
			AGENCIAS
			<span style="padding: 0px 8px;float:right;" class="btn btn-success" data-bind='click: addUser'>Agregar</span>
		</div>
		<div id="contactosId">
		    <table class='contactsEditor'>
		        <tr>
		            <th>Municipio</th>
		            <th>Contacto</th>
		            <th>Celular</th>
		            <th>Teléfono 1</th>
		            <th>Teléfono 2</th>
		            <th>Teléfono 3</th>
		            <th></th>
		        </tr>
		        <tbody data-bind="foreach: users">
		            <tr>
	        			<td><?php echo $this->Form->input('Transportadora.agencias.municipio.',array('data-bind'=>'value: municipio','label'=>false,'div'=>false,'type'=>'select','options'=>$destinos,'empty'=>'','class'=>'destinosSelect')); ?></td>
		                <td><input type="text" name="data[Transportadora][agencias][contacto][]" data-bind='value: contacto'/></td>
		                <td><input type="text" name="data[Transportadora][agencias][celular][]" data-bind='value: celular'/></td>
		                <td><input type="text" name="data[Transportadora][agencias][telefono1][]" data-bind='value: telefono1'/></td>
		                <td><input type="text" name="data[Transportadora][agencias][telefono2][]" data-bind='value: telefono2'/></td>
		                <td><input type="text" name="data[Transportadora][agencias][telefono3][]" data-bind='value: telefono3'/></td>
		                <td style="padding:0px;" class="btn btn-danger" data-bind='click: $root.removeUser'>
						<span class="glyphicon glyphicon-remove"></span>
					</td>
		            </tr>
		        </tbody>
		    </table>
	    </div>
    </div>
    <div style="width: 97%;">
    <table id="tabla_id">
		<thead> 
			<tr>
				<th>id</th>
				<th>NIT</th>
				<th>Razón social</th>
				<th>Dirección</th>
				<th>Contacto</th>
				<th>Celular</th>
				<th>Télefono1</th>
				<th>Municipio</th>
				<th></th>
			</tr>
		</thead>
		<tbody style="text-align:center">
		</tbody>
	</table>
    </div>

	<div class="form-group" style="padding-left: 30px;">
		<?php echo $this->Form->button('Guardar',array('class'=>'btn btn-primary push-right'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>



<script>
	var webroot         = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url             = <?php echo "'".Router::url('/')."transportadoras'"; ?>;
	var transportadoras = <?php echo $transportadorasJson; ?>;


	var User = function(data) {
	    var self = this;
	    self.id = data.id;
	    self.municipio = data.municipio;
	    self.contacto = data.contacto;
		self.celular = data.celular;
		self.telefono1 = data.telefono1;
		self.telefono2 = data.telefono2;
		self.telefono3 = data.telefono3;
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
	        if(viewModel.users().length >= 3){
				$("#contactosId").addClass("height-155");
			} else {
				$("#contactosId").removeClass("height-155");
			}
	    }
	};
	viewModel.addUser = function() {
	    viewModel.users.push(new User({ id: 0, municipio:"", contacto:"", celular: "" , telefono1: "" , telefono2: "" , telefono3: "" }));
		if(viewModel.users().length >= 3){
			$("#contactosId").addClass("height-155");
		}
	    $.each($(".destinosSelect"),function(key,value){
			$(value).chosen({
				no_results_text           : 'No se encuentra el destino.',
				width                     : "95%",
				allow_single_deselect     : true, 
				search_contains           : true,
				disable_search_threshold  : 10,
				placeholder_text_single   : "Seleccione el destino"
			});
	    });
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);
	    if(viewModel.users().length < 3){
			$("#contactosId").removeClass("height-155");
		}
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);

$(document).ready(function(){
	viewModel.addUser();

	$('#TransportadoraCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$("#TransportadoraDestinos").chosen({
    	no_results_text           : 'No se encuentra el destino.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_multiple : "Seleccione los destinos"
    });

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( transportadoras, function( key, value ) {
				if(id == value.Transportadora.id){
					$('#TransportadoraId').val(value.Transportadora.id);
					$('#TransportadoraDv').val(value.Transportadora.dv);
					$('#TransportadoraNit').val(value.Transportadora.nit);
					$('#TransportadoraRazon').val(value.Transportadora.razon);
					$('#TransportadoraDestino').val(value.Transportadora.destino);
					$('#TransportadoraContacto').val(value.Transportadora.contacto);
					$('#TransportadoraCelular').val(value.Transportadora.celular);
					$('#TransportadoraDiasFacturacion').val(value.Transportadora.dias_facturacion);
					$('#TransportadoraEspecial').val(value.Transportadora.especial);
					$('#TransportadoraCelular').val(value.Transportadora.celular);
					$('#TransportadoraFax').val(value.Transportadora.fax);
					$('#TransportadoraEmail').val(value.Transportadora.email);
					$('#TransportadoraDireccion').val(value.Transportadora.direccion);
					$('#TransportadoraCredito').val(value.Transportadora.credito);
					$('#TransportadoraActivo').val(value.Transportadora.activo);
					$('#TransportadoraTelefono1').val(value.Transportadora.telefono1);
					$('#TransportadoraTelefono2').val(value.Transportadora.telefono2);
					$('#TransportadoraTelefono3').val(value.Transportadora.telefono3);
					$('#TransportadoraTelefono4').val(value.Transportadora.telefono4);
	  				viewModel.users.removeAll();
					if(value.Transportadora.agencias == null || value.Transportadora.agencias.length == 0) {
						viewModel.addUser();
						$("#contactosId").removeClass("height-155");
					} else {
						viewModel.loadUpdatedData(value.Transportadora.agencias);
						$.each($(".destinosSelect"),function(key,value){
							$(value).chosen({
								no_results_text           : 'No se encuentra el destino.',
								width                     : "95%",
								allow_single_deselect     : true, 
								search_contains           : true,
								disable_search_threshold  : 10,
								placeholder_text_single   : "Seleccione el destino"
							});
					    });
					}

					$("#TransportadoraDestinos option").attr("selected",false);
					if(value.Transportadora.destinos != null){
						$.each( value.Transportadora.destinos, function( key2, value2 ) {
							$("#TransportadoraDestinos option").each(function( key, value ) {
								var actual = $(value).val();
								if(actual == value2){
									$(this).attr("selected","selected");
									$("#TransportadoraDestinos").trigger("chosen:updated");
								}
							});
						});
					} else {
						$("#TransportadoraDestinos").trigger("chosen:updated");
					}
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
		"sAjaxSource": webroot+'sources/transportadoras.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar la transportadora: '+aData[2]+' ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';
			jQuery('td:eq(7)', nRow).html(html);
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
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7,8] },
			{ "sClass": "col-actions", "aTargets": [3] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "10%"},
	        { "sWidth": "20%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "5%"},
	        { "sWidth": "5%"},
	        { "sWidth": "0%"}
	    ],
	});

})
</script>