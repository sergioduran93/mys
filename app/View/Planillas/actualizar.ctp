<div class="row" style="width:90%; margin-left:5%;">
	<div><h3><center>ACTUALIZAR PLANILLA POR PAGAR</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Planilla',array('class'=>'form-inline'));?>
    <div class="form-group col-md-12">    	
    	<div class="form-group col-md-12">
	        <div class="col-md-3"><?php echo $this->Form->input('fecha',array('label'=>'Fecha: ','type'=>'text','placeholder'=>'AAAA-MM-DD','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
    	    <div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'select','options'=>$tipo,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        	<div class="col-md-3"><?php echo $this->Form->input('codigo',array('label'=>'Código(Población)/Placa: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('identificacion',array('label'=>"Nro. recibo: ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        </div>
    	<div class="form-group col-md-12">
        	<div class="col-md-3"><?php echo $this->Form->input('guia',array('label'=>"Nro. guia: ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
    	    <div class="col-md-3"><?php echo $this->Form->input('valor',array('label'=>"Valor: ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        	<div class="col-md-6"><?php echo $this->Form->input('concepto',array('label'=>"Concepto: ",'type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        </div>
	    <table id="tabla_id" class="col-md-12">
			<thead> 
				<tr>
					<th>id</th>
					<th>Fecha</th>
					<th>Tipo</th>
					<th>Codigo/Placa</th>
					<th>Documento</th>
					<th>Valor</th>
					<th>Concepto</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

	<?php echo $this->Form->submit('Guardar',array('class'=>'pull-right btn btn-primary'));?>

    </div>

	<?php echo $this->Form->end();?>
</div>

<script>
	var webroot        = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
    var representantes = <?php echo json_encode($representantes); ?>;
    var vehiculos      = <?php echo json_encode($vehiculos); ?>;
    var planillas      = <?php echo json_encode($planillas); ?>;
    var representantesSearch = new Array();
    var representantesSearch2 = new Array();


$(document).ready(function(){

	$('#PlanillaActualizarForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$("#PlanillaFecha").change(function(){
		$('#PlanillaActualizarForm').data('bootstrapValidator').resetForm();
		$('#PlanillaActualizarForm').bootstrapValidator('validate');
	});

	$("#PlanillaTipo").change(function(){
		$("#PlanillaCodigo").val("");

		if($(this).val() == "Representante"){

			$("#PlanillaCodigo" ).autocomplete({
				minLength: 0,
				source: representantesSearch,
				change: function (event, ui) {
					$('#PlanillaActualizarForm').data('bootstrapValidator').resetForm();
					$('#PlanillaActualizarForm').bootstrapValidator('validate');
				}
			}).focus(function(){
			$(this).autocomplete("search", "");
    		return false;
				console.log(this.value);
			});

		} else {

			$("#PlanillaCodigo").autocomplete({
			minLength: 0,
			source: representantesSearch2,
			change: function (event, ui) {
				$('#PlanillaActualizarForm').data('bootstrapValidator').resetForm();
				$('#PlanillaActualizarForm').bootstrapValidator('validate');
			}
		}).focus(function(){
			$(this).autocomplete("search", "");
    		return false;
				console.log(this.value);
			});

		}
	});
	$("#PlanillaFecha").datepicker();
	$("#PlanillaValor").number(true,0);
	var i = 0;
	$.each( representantes, function( key, value ) {
		representantesSearch[i] = value;
		i++;
	});
	i=0;
	$.each( vehiculos, function( key, value ) {
		representantesSearch2[i] = value;
		i++;
	});
	$(function() {
		$("#PlanillaCodigo" ).autocomplete({
			minLength: 0,
			source: representantesSearch,
			change: function (event, ui) {
				$('#PlanillaActualizarForm').data('bootstrapValidator').resetForm();
				$('#PlanillaActualizarForm').bootstrapValidator('validate');
			}
		}).focus(function(){
			$(this).autocomplete("search", "");
    		return false;
				console.log(this.value);
			});
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( planillas, function( key, value ) {
				if(id == value.Planilla.id){
					//$('#PlanillaId').val(value.Planilla.id);
					$('#PlanillaFecha').val(value.Planilla.fecha);
					$('#PlanillaTipo').val(value.Planilla.tipo);
					$('#PlanillaCodigo').val(value.Planilla.codigo);
					$('#PlanillaIdentificacion').val(value.Planilla.identificacion);
					$('#PlanillaValor').val(value.Planilla.valor);
					$('#PlanillaConcepto').val(value.Planilla.concepto);
					$('#PlanillaGuia').val(value.Planilla.guia);		

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
		"sAjaxSource": webroot+'sources/planillas.txt',
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
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5] },
			{ "sClass": "col-actions", "aTargets": [3] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"},
	        { "sWidth": "25%"}
	    ],
	});

})
</script>