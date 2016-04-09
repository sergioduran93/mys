<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->script('jquery.jCombo.min');
	echo $this->Html->script('bootstrap.min');
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
	<?php echo $this->Form->create('Factura',array('class'=>'form-inline'));?>
		<div><h3><center>FACTURACIÓN</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor',array('type'=>'hidden')); ?>
       	<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-2"><?php echo $this->Form->input('desde',array('label'=>'Desde:','type'=>'text','placeholder'=>"AAAA-MM-DD",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-2"><?php echo $this->Form->input('hasta',array('label'=>'Hasta:','type'=>'text','placeholder'=>"AAAA-MM-DD",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'select','options'=>array('Credito'=>'CREDITO','Credicontado'=>'CREDICONTADO'),'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-5"><?php echo $this->Form->input('cliente',array('label'=>'Cliente: ','type'=>'select','options'=>$clientes,'empty'=>'','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		</div>
		<div class="form-group col-md-12" style="margin-bottom:10px;">
			<div class="col-md-12"><?php echo $this->Form->input('destinos',array('label'=>'Filtrar x Destinos: ','multiple'=>true,'class'=>'chosen-select form-control','type'=>'select','options'=>$destinos)); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th></th>
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
				</tr>
				<tr>
					<th>id</th>
					<th>destId</th>
					<th></th>
					<th>Fecha</th>
					<th>Remesa</th>
					<th>Doc Ref 1</th>
					<th>Doc Ref 2</th>
					<th>Doc Ref 3</th>
					<th>Destinatario</th>
					<th>Destino</th>
					<th>Dirección</th>
					<th>Valor</th>
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
$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw ) {
    if ( sNewSource !== undefined && sNewSource !== null ) {
        oSettings.sAjaxSource = sNewSource;
    } 
    if ( oSettings.oFeatures.bServerSide ) {
        this.fnDraw();
        return;
    }
 
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
    var aData = [];
 
    this.oApi._fnServerParams( oSettings, aData ); 
    oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
        that.oApi._fnClearTable( oSettings );
        var aData =  (oSettings.sAjaxDataProp !== "") ?
        that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json; 
        for ( var i=0 ; i<aData.length ; i++ ){
            that.oApi._fnAddData( oSettings, aData[i] );
        }         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice(); 
        that.fnDraw(); 
        if ( bStandingRedraw === true ){
            oSettings._iDisplayStart = iStart;
            that.oApi._fnCalculateEnd( oSettings );
            that.fnDraw( false );
        } 
        that.oApi._fnProcessingDisplay( oSettings, false );
        if ( typeof fnCallback == 'function' && fnCallback !== null ){
            fnCallback( oSettings );
        }
    }, oSettings );
};

$.fn.dataTableExt.afnFiltering.push(
	function (settings, data, index) {
		var destinos = $("#FacturaDestinos").val();
		var mostrar = false;
		//for (var i=0; i < data.length; i++) {
			if(destinos != null){
				$.each(destinos,function(key,value){
					if(value == data[0]){
						mostrar = true;
					}
				});
			} else {
				return true;
			}
			

		//}
		
		return mostrar;
	}
);


	var fullpath = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."facturas'"; ?>;
	var ajaxCall = "";
	var oTable;
$(document).ready(function(){
/*
	$('#FacturaCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});
*/
	$("#FacturaHasta").datepicker();
	$("#FacturaDesde").datepicker();

	$("#FacturaCliente").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el cliente"
	});

	$("#FacturaTipo").chosen({
		no_results_text           : 'No se encuentra el tipo.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el tipo"
	});

	$("#FacturaDestinos").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_multiple : "Seleccione los destinos"
	});

	/*
	oTable.fnFilter("");
	*/
	$("#FacturaDestinos").change(function(){
		oTable.fnFilter("");
	});


	$("#FacturaCliente").change(function(){
		var desde = $("#FacturaDesde").val();
		var hasta = $("#FacturaHasta").val();
		var tipo = $("#FacturaTipo").val();
		var clienteId = $(this).val();
		if(clienteId != ""){
			$.fancybox.showLoading();
			$.fancybox.helpers.overlay.open();
			$.ajax({
				type: 'json',
				url: fullpath+"Facturas/getGuias/"+clienteId+"/"+tipo+"/"+desde+"/"+hasta,
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				},
				success: function(response) {
					ajaxCall = webroot+'sources/'+response+'.txt';

					oTable.fnReloadAjax(webroot+'sources/'+response+'.txt');
					$.fancybox.hideLoading();
					$.fancybox.helpers.overlay.close();
				},
				error: function(e) {
					console.log("An error occurred: " + e.responseText.message);
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

	$('#tabla_id').on('change', '.checkGuias', function(event) {
		var suma = 0;
		$(".checkGuias").each( function (i,elem){
			if($(elem).is(":checked")){
				suma += parseFloat($(elem).attr('suma'));
			}
		});
		$("#FacturaValor").val(suma);
	});



	oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/empty.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollY": 200,
        "sScrollX": "100%",
        "sScrollXInner": "110%",
		"bPaginate": false,
		"oLanguage": {
		"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<input class="checkGuias" name="data[Factura][guias][]" suma="'+aData[10]+'" type="checkbox" style="width:20px;height:20px;" value="'+aData[0]+'">';
			$('td:eq(0)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		//"bLengthChange": true,
		//		"iDisplayLength": 10,
		"bJQueryUI": true,		
		//"bAutoWidth": false,

		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0,1 ] },
			{ "bSearchable": false, "aTargets": [ 0,1 ] },
			{ "bSortable": false, "aTargets": [0,1] },
			{ "sClass": "col-actions", "aTargets": [2] }
		]
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

})

</script>