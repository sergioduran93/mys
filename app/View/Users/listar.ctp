	<div><h3><center>USUARIOS</center></h3></div>
	<fieldset>
	<?php echo $this->Form->create('User',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>

<!--
	-->
	<center>
		<div style="width:97% !important">
		    <table id="tabla_id">
				<thead>
					<tr>
						<th></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						<th class="col-actions ui-state-default" style="padding-right:10px;"></th>
					</tr>
					<tr>
						<th>id</th>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Oficina</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		<div>
	</center>

<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."users'"; ?>;

	$(document).ready(function() {
		

		var oTable = $('#tabla_id').dataTable( {
			"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
			"sAjaxSource": webroot+'sources/usuarios.txt',
			"oLanguage": {
				"sUrl": webroot + 'files/es.txt'
			},
			"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
				html =  '<a class="btn btn-info" style="padding:0px;" title="Editar" href="'+url+'/editar/'+aData[0]+'"><span class="glyphicon glyphicon-pencil"></span></a>';
				html += '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar: '+aData[2]+' ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';

				jQuery('td:eq(4)', nRow).html(html);
				return nRow;
			},
			"aaSorting": [[ 1, "asc" ]],
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bLengthChange": true,
	//		"iDisplayLength": 10,
			"bJQueryUI": true,
			"aoColumns": [
		        { "sWidth": "0%"},
		        { "sWidth": "20%"},
		        { "sWidth": "25%"},
		        { "sWidth": "25%"},
		        { "sWidth": "20%"},
		        { "sWidth": "10%"}
		    ],
			"aoColumnDefs": [
				{ "bVisible": false, "aTargets": [ 0 ] },
				{ "bSortable": false, "aTargets": [5] },
				{ "bSearchable": false, "aTargets": [ 1 ] },
				{ "sClass": "col-actions", "aTargets": [0] }
			]
		});

	});
</script>