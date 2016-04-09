<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
?>
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Oficina',array('class'=>'form-inline'));?>
		<div><h3><center>DATOS DE OFICINAS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('consecutivo',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
	        <div class="col-md-4"><?php echo $this->Form->input('nit',array('label'=>'NIT: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	        <div class="col-md-3"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	        <div class="col-md-1"><?php echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	        <div class="col-md-1"><?php echo $this->Form->input('prefijo',array('label'=>'Prefijo: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	    </div>
	    <div class="form-group col-md-12">
	    	<div class="col-md-4"><?php echo $this->Form->input('direccion',array('label'=>"Dirección: ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-1"><?php echo $this->Form->input('ext',array('label'=>'Ext: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('resolucion',array('label'=>'Resolución DIAN','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		</div>
	    <div class="form-group col-md-12">
	    	<div class="col-md-4"><?php echo $this->Form->input('desde',array('label'=>"Nro Facturación (Desde): ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','placeholder'=>'Desde')); ?></div>
	    	<div class="col-md-4"><?php echo $this->Form->input('hasta',array('label'=>"Nro Facturación (Hasta): ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','placeholder'=>'Hasta')); ?></div>
	    	<div class="col-md-2"><?php echo $this->Form->input('barras',array('label'=>'Maneja cod. barras: ','type'=>'select','options'=>$barras)); ?></div>
			<div class="col-md-2"><?php echo $this->Form->input('imprimir',array('label'=>'Ver antes de imprimir: ','type'=>'select','options'=>$imprimir)); ?></div>
		</div>
	    <div class="form-group col-md-12" style="margin-bottom: 10px;">
			<div class="col-md-12"><?php echo $this->Form->input('destinos',array('label'=>'Destinos: ','multiple'=>true,'class'=>'chosen-select form-control','type'=>'select','options'=>$destinos,'data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-12"><?php echo $this->Form->input('recaudos',array('label'=>'Autorizada para Recaudar: ','multiple'=>true,'class'=>'chosen-select','type'=>'select','options'=>$destRecauda)); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Nit</th>
					<th>Cod</th>
					<th>Pref</th>
					<th>Nombre</th>
					<th>Ciudad</th>
					<th>Teléfono</th>
					<th>Ext</th>
					<th>Dirección</th>
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
	var webroot     = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var oficinas    = <?php echo json_encode($oficinas); ?>;
	var recaudos    = <?php echo json_encode($recaudos); ?>;
	var destinos    = <?php echo json_encode($destinos); ?>;
	var destRecauda = <?php echo json_encode($destRecauda); ?>;

$(document).ready(function(){

	$('#OficinaCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$("#OficinaDestinos").chosen({
    	no_results_text           : 'No se encuentra el destino.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_multiple : "Seleccione los destinos"
    });
	$("#OficinaRecaudos").chosen({
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
	    	$.each( oficinas, function( key, value ) {
				if(id == value.Oficina.id){
					$('#OficinaId').val(value.Oficina.id);
					$('#OficinaNit').val(value.Oficina.nit);
					$('#OficinaCodigo').val(value.Oficina.codigo);
					$('#OficinaNombre').val(value.Oficina.nombre);
					$('#OficinaDesde').val(value.Oficina.desde);
					$('#OficinaHasta').val(value.Oficina.hasta);
					$('#OficinaDireccion').val(value.Oficina.direccion);
					$('#OficinaTelefono').val(value.Oficina.telefono);
					$('#OficinaExt').val(value.Oficina.ext);
					$('#OficinaResolucion').val(value.Oficina.resolucion);
					$('#OficinaBarras').val(value.Oficina.barras);
					$('#OficinaImprimir').val(value.Oficina.imprimir);
					$('#OficinaPrefijo').val(value.Oficina.prefijo);
					$('#OficinaConsecutivo').val(value.Oficina.consecutivo);

					$("#OficinaDestinos option").attr("selected",false);
					if(value.Oficina.destinos != null){
						$.each( value.Oficina.destinos, function( key2, value2 ) {
							$("#OficinaDestinos option").each(function( key, value ) {
								var actual = $(value).val();
								if(actual == value2){
									$(this).attr("selected","selected");
									$("#OficinaDestinos").trigger("chosen:updated");
								}
							});
						});
					} else {
						$("#OficinaDestinos").trigger("chosen:updated");
					}
					$("#OficinaRecaudos").empty();
					$.each( recaudos, function( key3, value3 ) {
						if(value3 == id){
							$("#OficinaRecaudos").append('<option selected="selected" value="'+key3+'">'+destinos[key3]+'</option>');
						}
					});
					$.each( destRecauda, function( key3, value3 ) {
						$("#OficinaRecaudos").append('<option value="'+key3+'">'+value3+'</option>');
					});
					
					$("#OficinaRecaudos").trigger("chosen:updated");
					
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
		"sAjaxSource": webroot+'sources/oficinas.txt',
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
			{ "sWidth": "10%" },
			{ "sWidth": "1%" },
			{ "sWidth": "1%" },
			{ "sWidth": "10%" },
			{ "sWidth": "20%" },
			{ "sWidth": "10%" },
			{ "sWidth": "1%" },
			{ "sWidth": "20%" }
		],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7,8] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

})

</script>