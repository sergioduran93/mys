
<div class="row" style="width:90%; margin-left:5%;">   

	<br>
	<div><h3><center>CONDUCTORES / PROPIETARIOS / TENEDORES</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Conductor',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','default'=>$usuario_actual['role_id'])); ?>

    <div class="form-group col-md-12">
        <div class="col-md-2"><?php echo $this->Form->input('tipoP',array('label'=>'Tipo de persona: ','type'=>'select','options'=>$tipoPersona)); ?></div>
        <div class="col-md-4" style="padding-top:25px;">
    		<span class="ApellidosDiv">
        		<?php echo $this->Form->input('conductor2', array('label'=>'Conductor','type'=>'checkbox','style'=>'margin-left:20px;')); ?>
	        </span>
	        <?php echo $this->Form->input('propietario', array('label'=>'Propietario','type' => 'checkbox','style'=>'margin-left:20px;')); ?>
	        <?php echo $this->Form->input('tenedor', array('label'=>'Tenedor','type' => 'checkbox','style'=>'margin-left:20px;')); ?>
	    </div>
        <div class="col-md-3"><?php echo $this->Form->input('identificacion',array('label'=>'Identificación: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-2"><?php echo $this->Form->input('tipo_doc',array('label'=>'Tipo de documento: ','type'=>'select','options'=>$tipo_doc)); ?></div>
        <div class="col-md-1"><?php echo $this->Form->input('dv',array('label'=>"D.V.: ",'type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('nombre1',array('label'=>'<span id="label-documento">Primer Nombre:</span>','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
        <div class="col-md-3 ApellidosDiv"><?php echo $this->Form->input('nombre2',array('label'=>'Segundo Nombre:','type'=>'text')); ?></div>
        <div class="col-md-3 ApellidosDiv"><?php echo $this->Form->input('apellido1',array('label'=>'Primer Apellido:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3 ApellidosDiv"><?php echo $this->Form->input('apellido2',array('label'=>'Segundo Apellido:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
        <div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('ciudad',array('label'=>'Ciudad:','type'=>'select','empty'=>"",'options'=>$destinos,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('pase',array('label'=>'No. Licencia:','type'=>'text')); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('fecha',array('label'=>'Fecha de vencimiento:','type'=>'text','placeholder'=>'AAAA-MM-DD')); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
    </div>
	<br>

    <table id="tabla_id">
		<thead> 
			<tr>
				<th>id</th>
				<th>Documento</th>
				<th>Nombres</th>
				<th>Teléfono</th>
				<th>Celular</th>
				<th>Ciudad</th>
				<th>Tipo</th>
				<th></th>
			</tr>
		</thead>
		<tbody style="text-align:center">
		</tbody>
	</table>
    
   	<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-primary pull-right'));?>
	<?php echo $this->Form->end();?>
</div>

<script>
	var webroot     = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url         = <?php echo "'".Router::url('/')."conductores'"; ?>;
	var conductores = <?php echo json_encode($conductores); ?>;

$(document).ready(function(){

	$('#ConductorCrearForm').bootstrapValidator({
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'data[Conductor][conductor2]': {
				validators: {
					callback: {
						message: 'Seleccione al menos una opción',
						callback: function (value, validator, $field) {
							var cond = $("#ConductorConductor2").prop('checked');
							var prop = $("#ConductorPropietario").prop('checked');
							var tene = $("#ConductorTenedor").prop('checked');
							if(cond || prop || tene) {
								return true;
							} else {
								return false;
							}
						}
					}
				}
			}
		}
	});
	$('input[type=checkbox]').change(function() {
		$("#ConductorCrearForm").bootstrapValidator('revalidateField', 'data[Conductor][conductor2]');
	});




	$("#ConductorTipoP").change(function(){
		if($(this).val() == "Juridica"){
			$(".ApellidosDiv").hide();
			$("#label-documento").text("Nombre: ");
		} else {
			$(".ApellidosDiv").show();
			$("#label-documento").text("Primer Nombre: ");
		}
	});

	$("#ConductorFecha").datepicker();

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( conductores, function( key, value ) {
				if(id == value.Conductor.id){
					$('#ConductorId').val(value.Conductor.id);
					$('#ConductorIdentificacion').val(value.Conductor.identificacion);
					$('#ConductorNombre1').val(value.Conductor.nombre1);
					$('#ConductorNombre2').val(value.Conductor.nombre2);
					$('#ConductorApellido1').val(value.Conductor.apellido1);
					$('#ConductorApellido2').val(value.Conductor.apellido2);
					$('#ConductorDireccion').val(value.Conductor.direccion);
					$('#ConductorCiudad').val(value.Conductor.ciudad);
					$('#ConductorTelefono').val(value.Conductor.telefono);
					$('#ConductorCelular').val(value.Conductor.celular);
					$('#ConductorDv').val(value.Conductor.dv);
					$('#ConductorTipoDoc').val(value.Conductor.tipo_doc);
					if(value.Conductor.conductor == 1){
						$('#ConductorConductor2').prop("checked",true);
					} else {
						$('#ConductorConductor2').prop("checked",false);
					}
					if(value.Conductor.propietario == 1){
						$('#ConductorPropietario').prop("checked",true);						
					} else {
						$('#ConductorPropietario').prop("checked",false);						
					}
					if(value.Conductor.tenedor == 1){
						$('#ConductorTenedor').prop("checked",true);						
					} else {
						$('#ConductorTenedor').prop("checked",false);
					}
					$('#ConductorPase').val(value.Conductor.pase);
					$('#ConductorFecha').val(value.Conductor.fecha);
					$('#ConductorEmail').val(value.Conductor.email);
					$('#ConductorCiudad').attr("value",value.Conductor.ciudad);
					$('#ConductorTipoP').val(value.Conductor.tipoP);
					if(value.Conductor.tipoP == "Juridica") {
						$(".ApellidosDiv").hide();
						$("#label-documento").text("Nombre: ");
					} else {
						$(".ApellidosDiv").show();
						$("#label-documento").text("Primer Nombre: ");
					}
				}
			});
	    }
	});

	$("#btn-limpiar").click(function(){
		$('#ConductorConductor2').prop("checked",false);
		$('#ConductorPropietario').prop("checked",false);
		$('#ConductorTenedor').prop("checked",false);

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
		"sAjaxSource": webroot+'sources/conductores.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,

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
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7] },
			{ "sClass": "col-actions", "aTargets": [3] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "7%"},
	        { "sWidth": "20%"},
	        { "sWidth": "5%"},
	        { "sWidth": "5%"},
	        { "sWidth": "20%"},
	        { "sWidth": "20%"},
	        { "sWidth": "2%"}

	    ],
	});

	})
</script>