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

$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
{
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
 
        for ( var i=0 ; i<aData.length ; i++ )
        {
            that.oApi._fnAddData( oSettings, aData[i] );
        }
         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
 
        that.fnDraw();
 
        if ( bStandingRedraw === true )
        {
            oSettings._iDisplayStart = iStart;
            that.oApi._fnCalculateEnd( oSettings );
            that.fnDraw( false );
        }
 
        that.oApi._fnProcessingDisplay( oSettings, false );
 

        if ( typeof fnCallback == 'function' && fnCallback !== null )
        {
            fnCallback( oSettings );
        }
    }, oSettings );
};

/*
function fnShowHide( iCol )
{
	var oTable = $('#tabla_id').dataTable();

	for (var i = 0; i < iCol.length; i++) {		
		var bVis = oTable.fnSettings().aoColumns[iCol[i]].bVisible;
		oTable.fnSetColumnVis( iCol, bVis ? false : true );
	};	
}
*/
function fnShowHide( iCol )
{
	/* Get the DataTables object again - this is not a recreation, just a get of the object */
	var oTable = $('#example').dataTable();
	
//	var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
	oTable.fnSetColumnVis( iCol, false );
}

var source = 'departamentos';
var webroot =<?php echo "'".Router::url('/')."app/webroot/'"; ?>;
var bandera=0;
var ob;
var s=[{"sTitle":"id"},{"sTitle":"uno"},{"sTitle":"dos"}];






$(document).ready(function(){

	$('#RadioGenderDep').change(function(){
		source = 'departamentos';
		oTable.fnReloadAjax(webroot+'sources/'+source+'.txt');
	});

	$('#RadioGenderReg').change(function(){
		s=[{"sTitle":"id"},{"sTitle":"uno"},{"sTitle":"dos"},{"sTitle":"tres"},{"sTitle":"tres"},{"sTitle":"tres"}];
		source = 'destinos';
		oTable.fnReloadAjax(webroot+'sources/'+source+'.txt');
	});

	$('#RadioGenderEmp').change(function(){
		//ob=oTable.fnSettings();
		oTable.fnSettings().aoColumns[1].nTh.innerHTML = 'Datatables Title 1';
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
		"aoColumns":s,
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [3] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]

	});

})

</script>

