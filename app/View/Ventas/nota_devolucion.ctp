<?php 
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('reorder');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<style type="text/css">
	.dataTables_scroll{
		width: 100% !important;
	}
	table.table {
	clear: both;
	margin-top: 0px !important;
	margin-bottom: 0px !important;
	max-width: none !important;
	border-collapse: separate;
	}
	table.dataTable{
	width: 100% !important;
	}
	table.dataTable,
	table.dataTable td,
	table.dataTable th {
	margin: 0px !important;
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	}
	.ColVis_collection li{
		width: 20%;
	}
	.ColVis_collection li label{
		float: left;
		padding: 0px 20px;
	}
	.dataTables_wrapper {
		margin-left: 0px;
	}
	.btnTable {
		padding: 4px 10px;
		background: rgb(205, 226, 244);
		color: rgb(65, 77, 94);
		border-radius: 5px;
		font-weight: bold;
	}
</style>

<div class="row" style="width:90%; margin-left:5%;">   
	<br>
	<div><h3><center>NOTA DE DEVOLUCIÓN</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('accion',array('type'=>'hidden','default'=>'Guardar')); ?>
	<div class="bs-callout bs-callout-info" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
		<h4>Cliente</h4>
		<div class="form-group col-md-12">
			<div class="col-md-4"><?php echo $this->Form->input('cliente',array('label'=>'Nombre: ','type'=>'select','options'=>$clientes,'empty'=>"")); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('clienteD',array('label'=>'Documento: ','type'=>'select','options'=>$clienteD,'empty'=>"")); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('telefono',array('label'=>'Telefono: ','type'=>'text','readonly'=>'readonly')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-6"><?php echo $this->Form->input('direccion',array('label'=>'Dirección: ','type'=>'text','readonly'=>'readonly')); ?></div>
			<div class="col-md-6"><?php echo $this->Form->input('email',array('label'=>'Email: ','type'=>'text','readonly'=>'readonly')); ?></div>
		</div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-12"><?php echo $this->Form->input('contacto',array('label'=>'Contacto: ','type'=>'text')); ?></div>
	</div>

	<center>
		<div style="width:97% !important">
		    <table id="tabla_id">
				<thead>
					<tr>
						<th class="col-actions ui-state-default" style="padding-right:10px;"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					</tr>
					<tr>
						<th></th>
						<th>Remesa</th>
						<th>Remitente</th>
						<th>Cliente</th>
						<th>Origen</th>
						<th>Destino</th>
						<th>Fecha entrega</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		<div>
	</center>
	<div style="margin-right:18px;float:right;">
		<?php echo $this->Form->button("Guardar",array('id'=>'btn-guardar','type'=>'button',"class"=>'btn btn-primary'));?>
		<?php echo $this->Form->button("Terminar",array('id'=>'btn-terminar','type'=>'button',"class"=>'btn btn-primary'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>

<script>
	var clienteT = <?php echo json_encode($clienteT); ?>;
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."ventas'"; ?>;
	var fullpath = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var oTable;
	var arrayCheck = new Array();


$(document).ready(function(){
	$("#btn-guardar").click(function(){
		$("#VentaAccion").val("Guardar");
		itsclicked = true;
		$("#VentaNotaDevolucionForm").submit();
	});
	$("#btn-terminar").click(function(){
		if(confirm("Está seguro de terminar?")){
			$("#VentaAccion").val("Terminar");
			itsclicked = true;
			$("#VentaNotaDevolucionForm").submit();
		}
	});

	$("#VentaCliente").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione"
	});
	$("#VentaClienteD").chosen({
		no_results_text           : 'No se encuentra.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione"
	});

	$("#VentaCliente").change(function(){
		var clienSel = $(this).val();
		if(clienSel == ""){
			oTable.fnFilter("",2);
			$("#VentaTelefono").val("");
			$("#VentaDireccion").val("");
			$("#VentaEmail").val("");
		} else {
			$.fancybox.showLoading();
			$.fancybox.helpers.overlay.open();
			$.ajax({
				type: 'json',
				url: fullpath+"ventas/getDevolucion/"+clienSel,
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				},
				success: function(response) {
					response = JSON.parse(response);
					$.each(response, function( index, guia ) {
						arrayCheck[guia] = true;
					});
					oTable.fnDraw();
					$.fancybox.hideLoading();
					$.fancybox.helpers.overlay.close();
				},
				error: function(e) {
					console.log("An error occurred: " + e.responseText.message);
				}
			});
			$.each(clienteT, function( key, value ) {
				if(value.Cliente.id == clienSel){
					$("#VentaTelefono").val(value.Cliente.telefono);
					$("#VentaDireccion").val(value.Cliente.direccion);
					$("#VentaEmail").val(value.Cliente.email);
				}
			});
		}
		
		oTable.fnFilter($("#VentaCliente option:selected").text(), 3);
		$("#VentaClienteD").val(clienSel);
		$("#VentaClienteD").trigger("chosen:updated");

	});
	$("#VentaClienteD").change(function(){
		var clienSel = $(this).val();
		if(clienSel == ""){
			oTable.fnFilter("",2);
			$("#VentaTelefono").val("");
			$("#VentaDireccion").val("");
			$("#VentaEmail").val("");
		} else {
			$.each(clienteT, function( key, value ) {
				if(value.Cliente.id == clienSel){
					$("#VentaTelefono").val(value.Cliente.telefono);
					$("#VentaDireccion").val(value.Cliente.direccion);
					$("#VentaEmail").val(value.Cliente.email);
				}
			});
		}
		$("#VentaCliente").val(clienSel);
		$("#VentaCliente").trigger("chosen:updated");

		oTable.fnFilter($("#VentaCliente option:selected").text(), 3);
	});

	$(document).on("change",".checkClass",function(){
		var valor = $(this).val();
		arrayCheck[valor] = true;
	});


	oTable = $('#tabla_id').dataTable( {
		"sDom": "R<'clear'><'H'lfr>t<'F'ip>",
		"sAjaxSource": webroot+'sources/nota_devolucion.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage":
			{
				"sProcessing":   "Procesando...",
				"sLengthMenu":   "Ver _MENU_ registros",
				"sZeroRecords":  "No se encontraron resultados",
				"sInfo":         "<span class='btnTable'>Total Remesas: _MAX_</span>",
				"sInfoEmpty":    "",
				"sInfoFiltered": "",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
		    },
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			var info = arrayCheck[aData[0]];
			if(info == undefined){
				html = '<input class="checkClass" type="checkbox" value="'+aData[0]+'" name="data[Venta][codigo][]" style="height:20px;width:20px;">';
			} else {
				html = '<input class="checkClass" type="checkbox" checked="checked" value="'+aData[0]+'" name="data[Venta][codigo][]" style="height:20px;width:20px;">';
			}

			jQuery('td:eq(0)', nRow).html(html);
			return nRow;
		},		
		"aLengthMenu": [[10 ,25, 50, 100, -1], [10 ,25, 50, 100, "Todos"]],
		"iDisplayLength": 10,
		//"sScrollX": "100%",
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "sWidth": "25%", "aTargets": [2,3] },
			{ "bSearchable": false, "aTargets": [ 0,1 ] },
			{ "bSortable": false, "aTargets": [0,1] }
		],
		"oColReorder": {
            "iFixedColumns": 1
        }
	});

	var asInitVals = new Array();

	$("thead input").keyup( function (){
		oTable.fnFilter(this.value, $("thead input").index(this)+1 );
	});

	$("thead input").each( function (i){
		asInitVals[i] = this.value;
	});

	$("thead input").focus( function (){
		if ( this.className === "search_init" ){
			this.value     = "";
			this.className = "";
		}
	});

	$("thead input").blur( function (i){
		if ( this.value === "" ){
			this.className = "search_init";
			this.value     = asInitVals[$("thead input").index(this)+1];
		}
	});

	});
</script>