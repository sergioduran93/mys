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
		<div><h3><center>RELIQUIDAR GUIAS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
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

$(document).ready(function(){

	$(document).on('click', '.btn-reliquidar', function(event) {
		var idGuia = $(this).attr('value');
		$.fancybox.open({
			href : url+"/getReliquidar/"+idGuia,
			type : 'iframe',
			padding : 5,
			width : "90%",
			height: "90%",
			//maxHeight : 200,
			//autoScale : true,
			scrolling : 'auto',
			scrollOutside   : false
		});
	});
	$('#tabla_id').on('click', '.btn-reliquidar', function(event) {
		console.log($(this).parent().parent().remove());
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
		"sAjaxSource": webroot+'sources/relacion.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage":
			{
				"sProcessing":   "Procesando...",
				"sLengthMenu":   "Ver _MENU_ registros",
				"sZeroRecords":  "No se encontraron resultados",
				"sInfo":         "",
				"sInfoEmpty":    "",
				"sInfoFiltered": "",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
		    },
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html =  '<a value="'+aData[0]+'" class="btn btn-info btn-reliquidar" style="padding:0px;" title="Reliquidar" href="#"><span class="glyphicon glyphicon-pencil"></span></a>';
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