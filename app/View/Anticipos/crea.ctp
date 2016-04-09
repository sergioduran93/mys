
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Anticipo',array('class'=>'form-inline'));?>
		<div><h3><center>ANTICIPO DE CAJA</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <fieldset>
			    <div class="form-group col-md-12 bs-callout bs-callout-info" style="margin-left: 30px;padding:0px;width:50%;">
			        <div class="col-md-4"><?php echo $this->Form->input('inicio',array('label'=>'Fecha Inicio: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$fechaUnMesA)); ?></div>
			        <div class="col-md-4"><?php echo $this->Form->input('final',array('label'=>'Fecha Final: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$fechaActual)); ?></div>
			        <div class="col-md-4"><?php echo $this->Form->button("Consultar x fecha",array('id'=>'btn-buscar','style'=>'margin-top: 25px;',"class"=>'btn-primary','type'=>'button'));?></div>
				</div>
			    <div>
				    <div class="form-group col-md-12">
				    	<div class="col-md-4"><?php echo $this->Form->input('oficina',array('label'=>"Oficina: ",'type'=>'select','options'=>$oficinas)); ?></div>
			       		<div class="col-md-3"><?php echo $this->Form->input('fecha',array('label'=>'Fecha de retiro: ','type'=>'text','default'=>date("Y-m-d"))); ?></div>
			       		<div class="col-md-1"><?php echo $this->Form->input('hora',array('label'=>'H: ','type'=>'select','default'=>'12','options'=>array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12),'style'=>'padding: 3px 0px;' )); ?></div>
			       		<div class="col-md-1"><?php echo $this->Form->input('min',array('label'=>'M: ','type'=>'select','options'=>array('00'=>'00','05'=>'05','10'=>'10','15'=>'15','20'=>'20','25'=>'25','30'=>'30','35'=>'35','40'=>'40','45'=>'45','50'=>'50','55'=>'55'),'style'=>'padding: 3px 0px;')); ?></div>
			       		<div class="col-md-1"><?php echo $this->Form->input('m',array('label'=>'PM/AM','type'=>'select','options'=>array('AM'=>'AM','PM'=>'PM'),'style'=>'padding: 3px 0px;')); ?></div>
			       		<div class="col-md-2"><?php echo $this->Form->input('retiro_no',array('label'=>'Retiro No: ','type'=>'text')); ?></div>
					</div>
				    <div class="form-group col-md-12">
			       		<div class="col-md-6"><?php echo $this->Form->input('valor',array('label'=>'Valor: ','type'=>'text')); ?></div>
			       		<div class="col-md-6"><?php echo $this->Form->input('transaccion',array('label'=>'Transacción No.: ','type'=>'text')); ?></div>
					</div>
				</div>
			<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
				<thead>
					<tr>
						<th>id</th>
						<th>Oficina</th>
						<th>Retiro #</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Valor</th>
						<th>Transacción</th>
						<th>Realizo</th>
						<th>Fecha Dig.</th>
						<th>Hora Dig.</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>

	<?php echo $this->Form->button("Guardar",array('type'=>'button','id'=>'btn-submit',"class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
    var anticipos  = <?php echo json_encode($anticipos); ?>;
    var otrosPrueba;
    var retorno;

$(document).ready(function(){

	$("#AnticipoInicio").datepicker();
	$("#AnticipoFinal").datepicker();
	//$("#AnticipoFecha").datepicker();

	$("#btn-buscar").click(function(event) {
		if(($("#AnticipoInicio").val() == "") || ($("#AnticipoFinal").val() == "")){
			alert('Las fechas de busqueda no pueden estar vacias.');
		} else {
			$("#AnticipoCreaForm").submit();
		}
	});

	$("#btn-submit").click(function(event) {
		$("#AnticipoInicio").val("");
		$("#AnticipoFinal").val("");
		$("#AnticipoCreaForm").submit();
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
    	   	$.each( anticipos, function( key, value ) {
				if(id == value.Destino.id){
					$('#AnticipoDestinoId').val(value.Destino.id);
					$('#AnticipoRegion').val(value.Destino.regionId);
					$('#AnticipoDestino1').val(value.Destino.codigo);
					$('#AnticipoDestino2').val(value.Destino.nombre);
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

	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/anticipos.txt',
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
	        { "sWidth": "0%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"}

	    ],

		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7,8,9] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});


})

</script>