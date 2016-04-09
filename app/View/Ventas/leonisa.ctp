<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<style type="text/css">
	/*	::-webkit-scrollbar {
	    width: 12px;
	}
	::-webkit-scrollbar-thumb {
		-webkit-box-shadow: inset 0 0 6px rgb(137, 137, 137);
		border-radius: 5px;
		background-color: rgb(208, 226, 253);
	}
	::-webkit-scrollbar-track {
		background-color: rgb(244, 244, 244);
	}*/
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
	table.dataTable,
	table.dataTable td,
	table.dataTable th {
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
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
	<?php echo $this->Form->input('tipoconsultar', array('type'=>'hidden','default'=>'1')); ?>
		<div><h3><center>CONSULTA LEONISA</center></h3></div>
		<div class="form-group col-md-12">
			<div class="col-md-3">
				<?php echo $this->Form->input('fecha',array('label'=>'Fecha: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$desde)); ?>
			</div>
			<div class="col-md-3">
				<?php echo $this->Form->button("Consultar",array('type'=>'submit','style'=>'margin-top: 19px;',"class"=>'btn btn-primary','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
			</div>
		</div>
		</div>
	<?php echo $this->Form->end();?>
	
	<?php echo $this->Form->create('Venta',array('id'=>'VentaLeonisaForm2','class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
	<?php echo $this->Form->input('fecha2',array('type'=>'hidden','default'=>$desde)); ?>
	<?php echo $this->Form->input('tipoguardar', array('type'=>'hidden','default'=>'1')); ?>
	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
		<thead>
			<tr>
				<th></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
			</tr>
			<tr>
				<th>Cod. Barra</th>
				<th>Destino</th>
				<th>Destinatario</th>
				<th>Direccion</th>
				<th>Telefono</th>
				<th>Cant</th>
				<th>Contenido</th>
				<th># Guia</th>
				<th># Orden</th>
				<th>Campaña</th>
				<th>Zona</th>
				<th>Estado</th>
				<th>Valor</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
<?php echo $this->Form->button("Guardar",array('id'=>'btn-guardar','type'=>'button',"class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
<hr class="clearing" />
<?php echo $this->Form->end();?>
</div>

<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var arrayBarra = new Array();
	var oTable;
$(document).ready(function(){
	$("#btn-guardar").click(function(){
		oTable.fnSettings()._iDisplayLength = -1;
		oTable.fnDraw();
		itsclicked = true;
		$("#VentaLeonisaForm2").submit();
	});
	$("#VentaFecha").datepicker();
	$("#VentaFecha").change(function(){
		$("#VentaFecha2").val($(this).val());
	});


	var flag = 0;
	$(document).on("keypress",".inputBarra",function(e){
		if(e.which == 13) {
			flag = flag + 1;
			if(flag == 2){
				flag = 0;
				$(this).val($(this).val()+",");
			}
		}
		var barra = $(this).val();
		var guia = $(this).attr('aux');
		arrayBarra[guia] = barra;
	});

	oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/leonisa.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,
		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			var info = arrayBarra[aData[0]];
			if(info == undefined){
				html = '<input class="inputBarra" type="text" aux="'+aData[0]+'" name="data[Venta][codigo]['+aData[0]+']" style="padding:3px;">';
			} else {
				html = '<input class="inputBarra" type="text" aux="'+aData[0]+'" value="'+info+'" name="data[Venta][codigo]['+aData[0]+']" style="padding:3px;">';
			}
			if(aData[11] == '0'){
				$(nRow).addClass("error");
			} else {
				$(nRow).removeClass("error");
			}
			jQuery('td:eq(0)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"sScrollX": "100%",
		"aoColumns": [
			{ "sWidth": "10%"},
			{ "sWidth": "10%"},
			{ "sWidth": "20%"},
			{ "sWidth": "20%"},
			{ "sWidth": "10%"},
			{ "sWidth": "1%"},
			{ "sWidth": "10%"},
			{ "sWidth": "10%"},
			{ "sWidth": "10%"},
			{ "sWidth": "10%"},
			{ "sWidth": "10%"},
			{ "sWidth": "10%"},
			{ "sWidth": "10%"}
		],
		"aoColumnDefs": [
			{ "bSortable": false, "aTargets": [0] },
			{ "bVisible": false, "aTargets": [ 11 ] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

	var asInitVals = new Array();

	$("thead input").keyup( function (){
		oTable.fnFilter(this.value, $("thead input").index(this)+1);
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

})
</script>