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
<?php
   $this->Paginator->options(array(
      'update' => '#contenedor-relaciones',
      'before' => $this->Js->get("#procesando")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#procesando")->effect('fadeOut', array('buffer' => false))
   ));
?>

<div id="contenedor-relaciones">

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
	<?php $estados = array('PENDIENTE','FACTURADO'); ?>
	<?php echo $this->Form->create('Cuenta',array('class'=>'form-inline'));?>
		<div><h3><center>LISTA DE RELACIONES</center></h3></div>
		<div class="row" style="width:100%; margin-left:15%;">
		<div class="table-responsive" style="width:77%;  !important">
		<table class="table-responsive" id="tabla_id">
				<thead>
					<tr>
				
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('NRO RELACION'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('CLIENTE'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:20px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('FECHA'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('ESTADO'); ?></th>
					
				 <th class="col-actions ui-state-focus" style="padding-right:5px;"><?php echo __('ACCIONES'); ?></th>
				<tbody>

		<?php foreach ($relacionfacturas as $relacionfactura): ?>
		<tr>
			<td class="active"><?php echo h($relacionfactura['Relacionfactura']['id']); ?>&nbsp;</td>
			<td class="active"><?php echo h($relacionfactura['Cliente']['listNombre']); ?>&nbsp;</td>
			<td class="active"><?php echo h($relacionfactura['Relacionfactura']['fecha']); ?>&nbsp;</td>
			<td class="active"><?php echo $estados[$relacionfactura['Relacionfactura']['estado']]; ?>&nbsp;</td>
			
			
			<td class="actions">
				<?php echo $this->Html->link(__(''), array('controller' => 'relacionfacturas', 'action' => 'ver', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-list-alt')); ?>
				<?php echo $this->Html->link(__(''), array('controller' =>'ventas', 'action' => 'imprimirelacionfact', $ventas['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-print')); ?>
				 <?php echo $this->Html->link(__(''), array('action' => 'edit', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-pencil')); ?> 
				<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-trash')) ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tr>
				</thead>
				<tbody style="text-align:center">
				</tbody>
			</table>
		</div>
	</div>
		<?php echo $this->Form->end();?>

	<br>
</div>

		
	<?php echo $this->Js->writeBuffer(); ?>
</div> 


<script>
var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
var url     = <?php echo "'".Router::url('/')."facturas'"; ?>;
var oTable;
$(document).ready(function(){




	oTable = $('#tabla_id').dataTable( {
		//"sAjaxSource": webroot+'sources/facturas.txt',
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
		oTable.fnFilter(this.value, $("thead input").index(this) );
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
			this.value     = asInitVals[$("thead input").index(this)];
		}
	});
})
</script>