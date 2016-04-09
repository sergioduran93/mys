<?php
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery.dataTables');
	echo $this->Html->script('tuktuk');
?>
<h2 class="color theme">Gestión</h2>
<div class="row">
<div class="caja2 gris column_4 offset_3">
	<?php
	echo $this->Form->create('Radio');
	$options=array('dep'=>'Departamento','reg'=>'Región','des'=>'Destino','emp'=>'Tipo de empaque','mer'=>'Tipo de mercancia');

	$attributes=array('legend'=>false ,'separator' => '<br><br>',);
	echo $this->Form->radio('gender',$options,$attributes);
	echo $this->Form->end();
	echo $this->Form->submit('Guardar',array('class'=>'hidden'));
	?>
</div>


<fieldset class="caja2 gris column_4" style="margin-left:20px">
<?php
echo $this->Form->create('Radio');
echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text')).'<br>';
echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text'));
echo $this->Form->end('Guardar');
?>
</fieldset>

</div>

<div style="width:90%; margin-left:5%;margin-top:20px;" class="dep">		
	<h2 class="color theme titulo">Departamentos<span class="boton-esquina"><?php echo $this->Html->link('Crear nuevo', array('action' => 'crearDepartamento'),array('class'=>'button tiny')); ?></span></h2>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
		<thead> 
		</thead>
		<tbody>
		</tbody>
	</table>
</div>



<script>

var source = 'departamentos';
var webroot =<?php echo "'".Router::url('/')."app/webroot/'"; ?>;


$(document).ready(function(){



	$('#RadioGenderDep').change(function(){
		oTable.fnSetColumnVis( 0, true );
		oTable.fnSetColumnVis( 1, true );
		oTable.fnSetColumnVis( 2, false );
		oTable.fnSetColumnVis( 3, false );
		oTable.fnSetColumnVis( 4, false );
		oTable.fnSetColumnVis( 5, false );
		oTable.fnSetColumnVis( 6, false );
		oTable.fnSetColumnVis( 7, false );
		oTable.fnSetColumnVis( 8, false );
		oTable.fnSetColumnVis( 9, false );
		oTable.fnSetColumnVis( 10, false );
		oTable.fnSetColumnVis( 11, false );
		oTable.fnSetColumnVis( 12, false );
	});

	$('#RadioGenderReg').change(function(){
		oTable.fnSetColumnVis( 0, false );
		oTable.fnSetColumnVis( 1, false );
		oTable.fnSetColumnVis( 2, true );
		oTable.fnSetColumnVis( 3, true );
		oTable.fnSetColumnVis( 4, true );
		oTable.fnSetColumnVis( 5, false );
		oTable.fnSetColumnVis( 6, false );
		oTable.fnSetColumnVis( 7, false );
		oTable.fnSetColumnVis( 8, false );
		oTable.fnSetColumnVis( 9, false );
		oTable.fnSetColumnVis( 10, false );
		oTable.fnSetColumnVis( 11, false );
		oTable.fnSetColumnVis( 12, false );
	});

	$('#RadioGenderEmp').change(function(){
		//ob=oTable.fnSettings();
		oTable.fnSettings().aoColumns[0].nTh.innerHTML = 'Datatables Title 1';
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Datatables Title 2';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Datatables Title 3';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Datatables Title 4';
	});

	$('#RadioGenderMer').change(function(){
		oTable.fnSetColumnVis( 1, false );
	});



	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/'+source+'.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"aoColumns":[{"sTitle":"Codigo"},{"sTitle":"Nombre"},{"sTitle":"Codigo"},{"sTitle":"Nombre"},{"sTitle":"Departamento"},{"sTitle":"Codigo"},{"sTitle":"Nombre"},{"sTitle":"Departamento"},{"sTitle":"Region"},{"sTitle":"Codigo"},{"sTitle":"Nombre"},{"sTitle":"Codigo"},{"sTitle":"Nombre"}],		
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 2,3,4,5,6,7,8,9,10,11,12 ] },
			{ "bSortable": false, "aTargets": [12] }
		]

	});

})

</script>

