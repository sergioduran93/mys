<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Auxiliar',array('class'=>'form-inline'));?>
		<div><h3><center>AUXILIARES DE BODEGA</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-3"><?php echo $this->Form->input('documento',array('label'=>'Documento: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-5"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('oficina',array('label'=>'Oficina: ','type'=>'select','options'=>$oficinas)); ?></div>
       		<div class="col-md-1"><?php echo $this->Form->input('negociar',array('label'=>'Negociar: ','type'=>'select','options'=>$negociar)); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Documento</th>
					<th>Nombre</th>
					<th>Oficina</th>
					<th>Negociar</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

	<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>
	var webroot    = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var auxiliares = <?php echo json_encode($auxiliares); ?>;
	var oTable;
$(document).ready(function(){

	$('#AuxiliarCrearForm').bootstrapValidator({
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
    	   	$.each( auxiliares, function( key, value ) {
				if(id == value.Auxiliar.id){
					$('#AuxiliarId').val(value.Auxiliar.id);
					$('#AuxiliarDocumento').val(value.Auxiliar.documento);
					$('#AuxiliarNombre').val(value.Auxiliar.nombre);
					$('#AuxiliarOficina').val(value.Auxiliar.oficina);
					$('#AuxiliarNegociar').val(value.Auxiliar.negociar);
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

	oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/auxiliares.txt',
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
		"bAutoWidth": false,
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "20%"},
	        { "sWidth": "50%"},
	        { "sWidth": "20%"},
	        { "sWidth": "10%"}

	    ],

		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4] },
			{ "sClass": "col-actions", "aTargets": [2] }
		]
	});


})

</script>