<style type="text/css">
	.leftTd{
		text-align: left;
	}
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
	cursor: pointer;
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
	<?php echo $this->Form->create('Cuenta',array('class'=>'form-inline'));?>
		<div><h3><center>CUENTAS CONTABLES</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<div class="form-group col-md-12">
			<div class="col-md-4"><?php echo $this->Form->input('numero',array('label'=>'Numero: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('concepto',array('label'=>'Concepto: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('naturaleza',array('label'=>'Naturaleza: ','type'=>'select','options'=>array('CREDITO'=>'CREDITO','DEBITO'=>'DEBITO'),'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		</div>
		<div style="width: 97%;">
			<table id="tabla_id">
				<thead>
					<tr>
						<th></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th></th>
					</tr>
					<tr>
						<th>id</th>
						<th>Numero</th>
						<th>Concepto</th>
						<th>Naturaleza</th>
						<th></th>
					</tr>
				</thead>
				<tbody style="text-align:center">
				</tbody>
			</table>
		</div>
		<div style="margin: 10px 33px;">
			<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
		</div>
		<?php echo $this->Form->end();?>

	<br>
</div>




<script>
var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
var url     = <?php echo "'".Router::url('/')."cuentas'"; ?>;
$(document).ready(function(){



	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
			var id         = aData[0].replace(/(&nbsp;)*/g,"");
			var numero     = aData[1].replace(/(&nbsp;)*/g,"");
			var concepto   = aData[2].replace(/(&nbsp;)*/g,"");
			var naturaleza = aData[3].replace(/(&nbsp;)*/g,"");
	    	$("#CuentaId").val(id);
	    	$("#CuentaNumero").val(numero);
	    	$("#CuentaConcepto").val(concepto);
	    	$("#CuentaNaturaleza").val(naturaleza);
	    }
	});




	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/cuentas.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar la cuenta: '+aData[2]+' ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';
			jQuery('td:eq(3)', nRow).html(html);
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
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4] },
			{ "sClass": "leftTd", "aTargets": [1] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "15%"},
	        { "sWidth": "60%"},
	        { "sWidth": "20%"},
	        { "sWidth": "5%"}
	    ],
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