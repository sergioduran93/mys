<div class="row" style="width:90%; margin-left:5%;">   

	<br>
	<div><h3><center>AGENCIAS</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Agencia',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>

    <div class="form-group col-md-12">
        <div class="col-md-6"><?php echo $this->Form->input('destino',array('label'=>'Municipio:','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
        <div class="col-md-6"><?php echo $this->Form->input('contacto',array('label'=>'Contacto:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono1',array('label'=>'Teléfono1:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono2',array('label'=>'Teléfono2:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('telefono3',array('label'=>'Teléfono3:','type'=>'text')); ?></div>
    </div>
	<br>

    <table id="tabla_id">
		<thead> 
			<tr>
				<th>id</th>
				<th>Municipio</th>
				<th>Contacto</th>
				<th>Teléfono1</th>
				<th>Teléfono2</th>
				<th>Celular</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
    
	<?php echo $this->Form->submit('Guardar',array('class'=>'pull-right btn btn-primary'));?>
   	<?php echo $this->Form->button('Limpiar',array('class'=>'btn btn-primary pull-right','type'=>'button','id'=>"limpiar"));?>
	<?php echo $this->Form->end();?>
</div>



<script>
	var webroot  =<?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var agencias =<?php echo $agenciasJson; ?>;

$(document).ready(function(){

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( agencias, function( key, value ) {
				if(id == value.Agencia.id){
					$('#AgenciaId').val(value.Agencia.id);
					$('#AgenciaDestino').val(value.Agencia.destino);
					$('#AgenciaContacto').val(value.Agencia.contacto);
					$('#AgenciaCelular').val(value.Agencia.celular);
					$('#AgenciaTelefono1').val(value.Agencia.telefono1);
					$('#AgenciaTelefono2').val(value.Agencia.telefono2);
					$('#AgenciaTelefono3').val(value.Agencia.telefono3);
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

	$("#limpiar").click(function () {
		$('#AgenciaId').val("");
		$('#AgenciaDestino').val("");
		$('#AgenciaContacto').val("");
		$('#AgenciaCelular').val("");
		$('#AgenciaTelefono1').val("");
		$('#AgenciaTelefono2').val("");
		$('#AgenciaTelefono3').val("");
	});




	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/agencias.txt',
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
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5] },
			{ "sClass": "col-actions", "aTargets": [3] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "5%"},
	        { "sWidth": "5%"}
	    ],
	});


	})
</script>