<?php
	echo $this->Html->script('jquery.dataTables');
	echo $this->Html->script('jquery.fancybox');
	echo $this->Html->css('jquery.fancybox'); 
?>
<br>
<div><h3><center>GESTIÓN</center></h3></div>
<?php echo $this->Form->create('Departamento',array('action'=>'registra','onsubmit' => 'return itsclicked;')); ?>
<table class="col-md-12">
	<tr>
	<td>
		<div class="panel panel-info thumbnail col-md-5 col-md-push-4" style="width:210px;">
			<?php
			$options    = array('dep'=>' Departamento','reg'=>' Región','des'=>' Destino','emp'=>' Tipo de empaque','mer'=>' Tipo de mercancia');
			$attributes = array('legend'=>false ,'separator' => '<br><br>','default'=>'dep');
			echo $this->Form->radio('accion',$options,$attributes);
		//		echo $this->Form->end();
		//		echo $this->Form->submit('Guardar',array('type'=>'hiden'));
			?>
		</div>
	</td>
	<td>
		<div class="panel panel-info thumbnail col-md-6" style="width:320px;">
			<div class="form-group col-md-12">
				<div class="col-md-12"><?php echo $this->Form->input('codigo',array('label'=>'Código:','type'=>'text','readonly'=>true,'id'=>'readonly')); ?></div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-12"><?php echo $this->Form->input('nombre',array('label'=>'Nombre:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			</div>
			<div class="form-group col-md-12 hidenR">
				<div class="col-md-12"><?php echo $this->Form->input('descuento',array('label'=>'Porcentaje Descuento (%):','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			</div>
			<div class="form-group col-md-12 hiden">
				<div class="col-md-12"><?php echo $this->Form->input('region_id',array('label'=>'Región: ','type'=>'select','options'=>$region,'class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			</div>
			<div class="form-group col-md-12 hiden">
				<div class="col-md-12"><?php echo $this->Form->input('departamento_id',array('label'=>'Departamento: ','type'=>'select','options'=>$departamento,'class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			</div>
			<?php
				echo $this->Form->button('Guardar',array('class'=>'btn btn-primary','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));
				echo $this->Form->end();
			?>
		</div>
	</td>
	</tr>

</table>

<h3 class="titulo">Departamentos</h3>
	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
		<thead> 
		</thead>
		<tbody>
		</tbody>
	</table>

<br><br><br>

<script>


var codDep = <?php echo $codDep; ?>;
var codReg = <?php echo $codReg; ?>;
var codDes = <?php echo $codDes; ?>;
var codEmp = <?php echo $codEmp; ?>;
var codMer = <?php echo $codMer; ?>;
var redir  = <?php echo $accion; ?>;
var oTable;
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



var source   = 'departamentos';
var role     = <?php echo $usuario_actual['role_id']; ?>;
var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
var url      = <?php echo "'".Router::url('/')."departamentos'"; ?>;
var acciones = 2;
var funcion  = "Departamento";

$(document).ready(function(){
	$('#DepartamentoRegistraForm').bootstrapValidator({
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'data[Departamento][descuento]': {
				validators: {
					integer: {
						message: 'Por favor ingrese un número válido'
					}
				}
			}
		}
	});
	//$("#btn-limpiar").after('<a class="btn btn-success" style="padding:5px 10px 4px 5px;" title="Exportar" href="excel"><span class="glyphicon glyphicon-download-alt"></span>Excel</a>');
	$("#btn-limpiar").after('<div class="btn-group"> <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Exportar<span style="margin-left: 10px;" class="caret"></span>    <span class="sr-only">Toggle Dropdown</span>  </button>  <ul class="dropdown-menu" role="menu">    <li><a title="Ver" id="fancybox-otros" href="javascript:;"><span class="glyphicon glyphicon-download-alt"></span>Ver</a></li>      <li><a title="Descargar" href="excelDescargar"><span class="glyphicon glyphicon-download-alt"></span>Descargar</a></li>          </ul></div>');

	if(role == 2 || role == 3) {
		$("#DepartamentoAccionReg").attr("disabled", true);
	}

	$("#fancybox-otros").click( function (){
		$.fancybox.open({
			href : "excelVer",
			type : 'iframe',
			padding : 5,
			width : "80%",
			height :"80%",
			//maxHeight : 200,
			autoScale : false
		});
	});

	$('#readonly').val(codDep);
	$('.hiden').hide();
	$('.hidenR').hide();
/*
	$(".region").keyup( function (){
		oTable.fnFilter(this.value);
	});
*/
	$('#DepartamentoAccionDep').change(function(){
		$('#readonly').val(codDep);
		funcion = "Departamento";
		acciones = 2;
		$('.titulo').text("Departamentos");
		oTable.fnSetColumnVis( 3, false );
		oTable.fnSetColumnVis( 4, false );
		oTable.fnReloadAjax(webroot+'sources/departamentos.txt');
		$('.hiden').hide();
		$('.hidenR').hide();
	});

	$('#DepartamentoAccionReg').change(function(){
		$('#readonly').val(codReg);
		funcion = "Region";
		acciones = 2;
		oTable.fnSetColumnVis( 3, false );
		oTable.fnSetColumnVis( 4, false );
		//s=[{"sTitle":"id"},{"sTitle":"uno"},{"sTitle":"dos"},{"sTitle":"tres"},{"sTitle":"tres"},{"sTitle":"tres"}];
		$('.titulo').text("Regiones");
		oTable.fnReloadAjax(webroot+'sources/regiones.txt');
		$('.hiden').hide();
		$('.hidenR').show();
	});

	$('#DepartamentoAccionEmp').change(function(){
		$('#readonly').val(codEmp);
		funcion = "Empaque";
		acciones = 2;
		oTable.fnSetColumnVis( 3, false );
		oTable.fnSetColumnVis( 4, false );
		$('.titulo').text("Empaques");
		oTable.fnReloadAjax(webroot+'sources/empaques.txt');
		$('.hiden').hide();
		$('.hidenR').hide();
	});

	$('#DepartamentoAccionMer').change(function(){
		$('#readonly').val(codMer);
		funcion = "Mercancia";
		acciones = 2;
		oTable.fnSetColumnVis( 3, false );
		oTable.fnSetColumnVis( 4, false );
		$('.titulo').text("Mercancias");
		oTable.fnReloadAjax(webroot+'sources/mercancias.txt');
		$('.hiden').hide();
		$('.hidenR').hide();
	});

	$('#DepartamentoAccionDes').change(function(){
		$('#readonly').val(codDes);
		funcion = "Destino";
		acciones = 4;
		oTable.fnSetColumnVis( 3, true );
		oTable.fnSetColumnVis( 4, true );
		$('.titulo').text("Destinos");
		oTable.fnReloadAjax(webroot+'sources/destinos.txt');
		$('.hiden').show();
		$('.hidenR').hide();
	});

	oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/'+source+'.txt',
		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html =  '<a class="btn btn-info" style="padding:0px;" title="Editar" href="'+url+'/editar'+funcion+'/'+aData[0]+'"><span class="glyphicon glyphicon-pencil"></span></a>';
			html += '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar'+funcion+'/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar: '+aData[2]+' ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';

			jQuery('td:eq('+acciones+')', nRow).html(html);
			return nRow;
		},
		"aaSorting": [[ 1, "asc" ]],
		"aoColumns":[
			{"sTitle":"id"},
			{"sTitle":"Código"},
			{"sTitle":"Nombre"},
			{"sTitle":"Departamento"},
			{"sTitle":"Región"},
			{"sTitle":"Acciones"}
			],
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "sClass": "col-actions", "aTargets": [5] }
		],
		"fnInitComplete": function() {
			oTable.fnSetColumnVis( 3, false );
			oTable.fnSetColumnVis( 4, false );

			if(redir == 1){
				$("#DepartamentoAccionDep").attr("checked","checked");
				$('#readonly').val(codDep);
				funcion = "Departamento";
				acciones = 2;
				$('.titulo').text("Departamentos");
				oTable.fnSetColumnVis( 3, false );
				oTable.fnSetColumnVis( 4, false );
				oTable.fnReloadAjax(webroot+'sources/departamentos.txt');
				$('.hiden').hide();
				$('.hidenR').hide();
			} else if(redir == 2){
				$("#DepartamentoAccionReg").attr("checked","checked");
				$('#readonly').val(codReg);
				funcion = "Region";
				acciones = 2;
				oTable.fnSetColumnVis( 3, false );
				oTable.fnSetColumnVis( 4, false );
				//s=[{"sTitle":"id"},{"sTitle":"uno"},{"sTitle":"dos"},{"sTitle":"tres"},{"sTitle":"tres"},{"sTitle":"tres"}];
				$('.titulo').text("Regiones");
				oTable.fnReloadAjax(webroot+'sources/regiones.txt');
				$('.hiden').hide();
				$('.hidenR').show();
			} else if(redir == 3){
				$("#DepartamentoAccionDes").attr("checked","checked");
				$('#readonly').val(codDes);
				funcion = "Destino";
				acciones = 4;
				oTable.fnSetColumnVis( 3, true );
				oTable.fnSetColumnVis( 4, true );
				$('.titulo').text("Destinos");
				oTable.fnReloadAjax(webroot+'sources/destinos.txt');
				$('.hiden').show();
				$('.hidenR').hide();
			} else if(redir == 4){
				$("#DepartamentoAccionEmp").attr("checked","checked");
				$('#readonly').val(codEmp);
				funcion = "Empaque";
				acciones = 2;
				oTable.fnSetColumnVis( 3, false );
				oTable.fnSetColumnVis( 4, false );
				$('.titulo').text("Empaques");
				oTable.fnReloadAjax(webroot+'sources/empaques.txt');
				$('.hiden').hide();
				$('.hidenR').hide();
			} else if(redir == 5){
				$("#DepartamentoAccionMer").attr("checked","checked");
				$('#readonly').val(codMer);
				funcion = "Mercancia";
				acciones = 2;
				oTable.fnSetColumnVis( 3, false );
				oTable.fnSetColumnVis( 4, false );
				$('.titulo').text("Mercancias");
				oTable.fnReloadAjax(webroot+'sources/mercancias.txt');
				$('.hiden').hide();
				$('.hidenR').hide();
			}
		}

	});

})

</script>

