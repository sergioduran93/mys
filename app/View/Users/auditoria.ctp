<div class="row" style="width:90%; margin-left:5%;">
	<br>	
		<div><h3><center>AUDITORIA</center></h3></div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>Acción</th>
					<th>Tabla</th>
					<th>Clave Primaria</th>
					<th>Usuario</th>
					<th>Fecha</th>
					<th>Valor</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	<br>
</div>
<style>
.dataTables_scrollBody{
	overflow: visible !important;
}
</style>

<script>
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;

$(document).ready(function(){


	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/auditoria.txt',
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
		"bAutoWidth": false,
	    "aoColumns": [
	        { "sWidth": "14%"},
	        { "sWidth": "14%"},
	        { "sWidth": "14%"},
	        { "sWidth": "14%"},
	        { "sWidth": "14%"},
	        { "sWidth": "30%"}

	    ],

		"aoColumnDefs": [
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5] },
			{ "sClass": "col-actions", "aTargets": [0] }
		]
	});


})

</script>