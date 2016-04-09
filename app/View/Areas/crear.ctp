<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
?>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Area',array('class'=>'form-inline'));?>
		<div><h3><center>AREAS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-2"><?php echo $this->Form->input('codigo',array('label'=>'Codigo: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-10"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		</div>
		<div class="form-group col-md-12" style="margin-bottom:10px;">
			<div class="col-md-12"><?php echo $this->Form->input('destinos',array('label'=>'Destinos: ','multiple'=>true,'class'=>'chosen-select form-control','type'=>'select','options'=>$destinos,'data-bv-notempty'=>'true')); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Codigo</th>
					<th>Nombre</th>
					<th></th>
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
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."clientes'"; ?>;
	var areas   = <?php echo json_encode($areas); ?>;
	var oTable;
$(document).ready(function(){

	$('#AreaCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$("#AreaDestinos").chosen({
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
    	   	$.each( areas, function( key, value ) {
				if(id == value.Area.id){
					$('#AreaId').val(value.Area.id);
					$('#AreaCodigo').val(value.Area.codigo);
					$('#AreaNombre').val(value.Area.nombre);
					$('#AreaDestinos').val(value.Area.destinos);
					$("#AreaDestinos option").attr("selected",false);
					$.each( value.Area.destinos, function( key2, value2 ) {
						$("#AreaDestinos option").each(function( key3, value3 ) {
							var actual = $(value3).val();
							if(actual == value2){
								$(this).attr("selected","selected");
							}
						});
					});
					$("#AreaDestinos").trigger("chosen:updated");
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
		"sAjaxSource": webroot+'sources/areas.txt',
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
			$('td:eq(2)', nRow).html(html);
			return nRow;
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
	        { "sWidth": "20%"},
	        { "sWidth": "1%"}

	    ],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0,3 ] },
			{ "bSortable": false, "aTargets": [0,3] },
			{ "sClass": "col-actions", "aTargets": [2] }
		]
	});


})

</script>