<?php
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<style>
.search-choice{
	width: 99%;
}
</style>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('VentasCredito',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>PLANILLA DE RELACIÓN</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<div class="form-group col-md-12">
			<div class="col-md-12"><?php echo $this->Form->input('planilla',array('label'=>'Planilla No.: ','type'=>'text','readonly'=>'readonly','default'=>$planilla)); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Remesa</th>
					<th>Destinatario</th>
					<th>Dirección</th>
					<th>Destino</th>
					<th>Teléfono</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	<?php echo $this->Form->button("Guardar",array('type'=>'submit',"class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>


<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."VentasCredito'"; ?>;
	var fullpath = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var ventas   = <?php echo json_encode($ventas); ?>;
	var ventasL  = <?php echo json_encode($ventasL); ?>;
	var ajaxCall;
	var oTable;
	function sumarValor() {
		valor = 0;
		var actuales = $("#VentasCreditoGuias2").val();
		if(actuales != null){
			$.each(actuales, function( key, value ) {
				valor = valor + ajaxCall[value];
			});
		}
		if(valor != 0){
			valor = valor.toFixed(2);
			$("#VentasCreditoValor").attr('readonly','readonly');
		} else {
			$("#VentasCreditoValor").attr('readonly',false);
		}
		$("#VentasCreditoValor").val(valor);
	}

$(document).ready(function(){
	$("#VentasCreditoBarras").keypress(function(e) {
		//console.log(e.which);
		var barras = $(this).val();
		if(e.which == 13) {
			if(ventasL[barras] != undefined){
				var actuales = $("#VentasCreditoGuias2").val();
				if(actuales != null){
					actuales.push(barras);
				} else {
					actuales = [barras];
				}
				$("#VentasCreditoGuias2").val(actuales);
				$("#VentasCreditoGuias2").trigger("chosen:updated");
				sumarValor();
			}
			$("#VentasCreditoBarras").val("");
		}
	});
	$("#VentasCreditoNegociador").chosen({
		no_results_text           : 'No se encuentra el negociador.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el negociador"
	});
	$("#VentasCreditoPlaca").chosen({
		no_results_text           : 'No se encuentra la placa.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el placa"
	});
	$("#VentasCreditoConductor").chosen({
		no_results_text           : 'No se encuentra el conductor.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el conductor"
	});
	$("#VentasCreditoOrigen").chosen({
		no_results_text           : 'No se encuentra la origen.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la origen"
	});
	$("#VentasCreditoDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});
	$("#VentasCreditoGuias2").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_multiple : "Seleccione la guia"
	});

	$("#VentasCreditoPlaca").change(function(){
		var placaSel = $("#VentasCreditoPlaca").val();
		$("#VentasCreditoGuias2").val("");
		$("#VentasCreditoGuias2").trigger("chosen:updated");
		sumarValor();
		$.each(vehiculos, function( key, value ) {
			if(placaSel == value.Vehiculo.id) {
				$("#VentasCreditoTipo").val(value.Vehiculo.marca);
				$("#VentasCreditoModelo").val(value.Vehiculo.modelo);
			}
		});
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"VentasCreditos/getNegociacion/"+placaSel,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
			success: function(response) {
				response = JSON.parse(response);
				ajaxCall = response;
				$.fancybox.hideLoading();
				$.fancybox.helpers.overlay.close();
			},
			error: function(e) {
				console.log("An error occurred: " + e.responseText.message);
			}
		});
	});

	$("#VentasCreditoConductor").change(function(){
		var conductorSel = $("#VentasCreditoConductor").val();
		$.each(conductores, function( key, value ) {
			if(conductorSel == value.Conductor.id) {
				$("#VentasCreditoNombre").val(value.Conductor.listNombre);
				$("#VentasCreditoTelefono").val(value.Conductor.telefono);
			}
		});
	});

	$("#VentasCreditoGuias2").change(function(){
		sumarValor();
	});
	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	var actuales = $("#VentasCreditoGuias2").val();
	    	if(actuales != null){
	    		actuales.push(id);
	    	} else {
	    		actuales = [id];
	    	}
	    	$("#VentasCreditoGuias2").val(actuales);
			$("#VentasCreditoGuias2").trigger("chosen:updated");
			sumarValor();
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
		"sAjaxSource": webroot+'sources/relacion.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
		"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html =  '<a class="btn btn-info" style="padding:0px;" title="Editar" href="'+url+'/editar/'+aData[0]+'"><span class="glyphicon glyphicon-pencil"></span></a>';
			html += '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar la guia: '+aData[1]+' ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';
			jQuery('td:eq(5)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": false,
		"bInfo": true,
		"bLengthChange": false,
		//"iDisplayLength": 6,
		"bJQueryUI": true,		
		"bAutoWidth": false,
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "14%"},
	        { "sWidth": "23%"},
	        { "sWidth": "22%"},
	        { "sWidth": "14%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"}
	    ],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "col-actions", "aTargets": [2] }
		]
	});

})

</script>