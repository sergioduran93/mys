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
      'update' => '#contenedor-representantes',
      'before' => $this->Js->get("#procesando")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#procesando")->effect('fadeOut', array('buffer' => false))
   ));
?>

<div id="contenedor-representantes">

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
		<div><h3><center>LISTA DE CUENTAS DE REPRESENTANTES</center></h3></div>
		
		<div class="table-responsive" style="width:97%;  !important">
		<table class="table table-bordered table-striped">
				<thead>
					<tr>
				
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('ID'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('CODIGO'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('CEDULA'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('NOMBRE'); ?></th>
				
					
				 <th class="col-actions ui-state-focus" style="padding-right:5px;"><?php echo __('ACCIONES'); ?></th>
				<tbody>
		<?php foreach ($representantes as $representante): ?>
		<tr>
			<td class="active"><?php echo h($representante['Representante']['id']); ?>&nbsp;</td>
			<td class="active"><?php echo h($representante['Representante']['codigo']); ?>&nbsp;</td>
			<td class="active"><?php echo h($representante['Representante']['identificacion']); ?>&nbsp;</td>
			<td class="active"><?php echo h($representante['Representante']['nombre1']); ?> <?php echo h($representante['Representante']['nombre2']); ?> <?php echo h($representante['Representante']['apellido1']); ?> <?php echo h($representante['Representante']['apellido2']); ?>&nbsp;</td>
	
			<td class="actions">
				<?php echo $this->Html->link(__(''), array('controller' => 'representantes', 'action' => 'ver', $representante['Representante']['id']), array('class' => 'glyphicon glyphicon-list-alt')); ?>
				<!--<?php echo $this->Html->link(__(''), array('controller' =>'ventas', 'action' => 'imprimirelacionfact', $ventas['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-print')); ?> -->
				 <?php echo $this->Html->link(__(''), array('controller' => 'representantes','action' => 'editar', $representante['Representante']['id']), array('class' => 'glyphicon glyphicon-pencil')); ?> 
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
	
		<?php echo $this->Form->end();?>

	<br>
</div>
<p>
		<?php
		echo $this->Paginator->counter(array(
		'format' => __('Pagina {:page} de {:pages}, {:count} Representates en Total')
		));
		?>	</p>
		<ul class="pagination">
			<li> <?php echo $this->Paginator->prev('<< ' . __('Atras'), array('tag' => false), null, array('class' => 'prev disabled btn-primary')); ?> </li>
			<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
			<li> <?php echo $this->Paginator->next(__('Siguiente') . ' >>', array('tag' => false), null, array('class' => 'next disabled btn-primary')); ?> </li>
		</ul>
	<?php echo $this->Js->writeBuffer(); ?>
</div> 

<script>
var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
var url     = <?php echo "'".Router::url('/')."facturas'"; ?>;
$(document).ready(function(){

	$('#tabla_id').on('click', 'tr', function(event) {
		var Relacionfactura = oTable.fnGetData(this);
		if (null != Relacionfactura) {
			var relacionRelacionfactura_id         = Relacionfactura.replace(/(&nbsp;)*/g,"");
			var cliente_id     = Relacionfactura.replace(/(&nbsp;)*/g,"");
			var fecha = Relacionfactura.replace(/(&nbsp;)*/g,"");
			var estado   = Relacionfactura.replace(/(&nbsp;)*/g,"");
			var fecha = Relacionfactura.replace(/(&nbsp;)*/g,"");
			var valor = Relacionfactura.replace(/(&nbsp;)*/g,"");
	    	$("#Cuentarelacionfactura_id").val(id);
	    	$("#Cuentacliente_nom").val(nombre);
	    	$("#Cuentaestado").val(estado);
	    	$("#Cuentafecha").val(numero);
	    	$("#Cuentavalor").val(numero);
	    }
	});

	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/facturas.txt',
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
</div>