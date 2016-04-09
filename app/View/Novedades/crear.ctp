<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Novedad',array('class'=>'form-inline'));?>
		<div><h3><center>NOVEDADES</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text','readonly'=>'readonly','default'=>$max)); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'select','options'=>$tipo)); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('novedad',array('label'=>'Novedad: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Código</th>
					<th>Tipo</th>
					<th>Novedad</th>
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
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
    var novedades  = <?php echo json_encode($novedades); ?>;

$(document).ready(function(){

	$('#NovedadCrearForm').bootstrapValidator({
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
    	   	$.each( novedades, function( key, value ) {
				if(id == value.Novedad.id){
					$('#NovedadId').val(value.Novedad.id);
					$('#NovedadCodigo').val(value.Novedad.codigo);
					$('#NovedadNovedad').val(value.Novedad.novedad);
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
		"sAjaxSource": webroot+'sources/novedades.txt',
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
	        { "sWidth": "10%"},
	        { "sWidth": "30%"},
	        { "sWidth": "60%"}

	    ],

		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3] },
			{ "sClass": "col-actions", "aTargets": [2] }
		]
	});


})

</script>