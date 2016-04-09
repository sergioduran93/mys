<?php 
	echo $this->Html->css('kube');
	echo $this->Html->css('superfish');
	echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
	echo $this->Html->css('jquery.dataTables_themeroller'); 
	echo $this->Html->css('halflings');
	echo $this->Html->css('jquery.fancybox');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-1.9.1.min');
	echo $this->Html->script('hoverIntent');
	echo $this->Html->script('superfish');
	echo $this->Html->script('jquery.dataTables');
	echo $this->Html->script('knockout');
?>

<div class="row" style="width:90%; margin-left:5%;">
	
	<br>
	<?php echo $this->Form->create('Descuento');?>

		<div><h3><center>CONVENIOS</center></h3></div>
	    <fieldset>
			    <?php echo $this->Form->input('cliente_id',array('type'=>'hidden')); ?>
			    <?php echo $this->Form->input('destino_id',array('type'=>'hidden')); ?>
			    <div class="units-row units-split">
			        <div class="unit-20"><?php echo $this->Form->input('cliente',array('label'=>'Cliente NIT: ','type'=>'text')); ?></div>
			        <div class="unit-50"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text','style'=>'width:100%')); ?></div>
			        <div class="unit-30">
			        	<?php
						$options=array('TodasRegiones'=>'Todas las regiones ','Region'=>'Región ','Destino'=>'Destino ');
						$attributes=array('legend'=>false,'default'=>'Destino');
						echo $this->Form->radio('descuento',$options,$attributes);
						?>
					</div>
			    </div>
			    <div class="units-row">
			        <div class="unit-20 DescuentoRegion"><?php echo $this->Form->input('region',array('label'=>'Region: ','type'=>'select','options'=>$regiones,'empty'=>'')); ?></div>
			        <div class="unit-20 DescuentoDestino1"><?php echo $this->Form->input('destino1',array('label'=>'Cod. Destino: ','type'=>'text')); ?></div>
			        <div class="unit-20 DescuentoDestino2"><?php echo $this->Form->input('destino2',array('label'=>"Nom. Destino:",'type'=>'text')); ?></div>
			        <div class="unit-10"><?php echo $this->Form->input('destino3',array('label'=>'Ciudad origen: ','type'=>'select','options'=>$destinosList)); ?></div>
			    </div>
			<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
				<thead>
					<tr>
						<th>id</th>
						<th>id region</th>
						<th>Documento</th>
						<th>Nombre</th>
						<th>Teléfono</th>
						<th>Teléfono 2</th>
						<th>Dirección</th>
						<th>Celular</th>
					</tr>
				</thead>
				<tbody style="text-align:center">
				</tbody>
			</table>
		    <br>
	        <div class="units-row">
	        	<button class="btn btn-blue push-right" data-bind='click: addUnidad'>Agregar fila</button>
				<table>
				<tr>
				<td>	            
			    	<!--<button class="btn btn-blue push-right" data-bind='click: addUnidad'>Agregar Unidades</button> -->
					<span style="font-weight: bold">Rango unidades:</span>
					<table>
				        <tr>
				            <th>Desde</th>
				            <th>Hasta</th>
				            <th>Descuento (%)</th>
				        </tr>
				        <tbody data-bind="foreach: unidades">
				            <tr>
				                <td><input class="unit-50" name="data[Descuento][rangoUnidad][desde][]" data-bind='value: desde'/></td>
				                <td><input class="unit-50" name="data[Descuento][rangoUnidad][hasta][]" data-bind='value: hasta'/></td>
				                <td><input class="unit-50" name="data[Descuento][rangoUnidad][descuento][]" data-bind='value: descuento'/></td>
				                
				            </tr>
				        </tbody>
				    </table>	            
	        	</td>
	        	<td>
			    	<span style="font-weight: bold">Rango kilos:</span>
					<table>
				        <tr>
				            <th>Desde</th>
				            <th>Hasta</th>
				            <th>Descuento (%)</th>
				        </tr>
				        <tbody data-bind="foreach: unidades">
				            <tr>
				                <td><input class="unit-50" name="data[Descuento][rangoKilo][desde][]" data-bind='value: desde'/></td>
				                <td><input class="unit-50" name="data[Descuento][rangoKilo][hasta][]" data-bind='value: hasta'/></td>
				                <td><input class="unit-50" name="data[Descuento][rangoKilo][descuento][]" data-bind='value: descuento'/></td>
				                <td><div><a href='#' class="btn bord" data-bind='click: $root.removeKilo'>Eliminar</a></div></td>
				            </tr>
				        </tbody>
				    </table>
	        	</td>
	        </div>
	        </tr>
	        </table>
	            <br><br><br><br><br><br>
				<?php echo $this->Form->submit('Guardar',array('class'=>'btn btn-blue','div'=>false));?>	        	
				<?php echo $this->Html->link('Exportar', array('action'=>'excel'),array('class'=>'excel btn btn-blue','div'=>false)); ?>
				<?php echo $this->Html->link('Deshacer Descuentos', array('action'=>'deshacer'),array('onclick'=>"return confirm('Esta seguro de deshacer los descuentos?');",'class'=>'deshacer btn btn-red','div'=>false)); ?>
	        </div>	     	
	    </fieldset>

	<?php echo $this->Form->end();?>
	<br>
</div>



<script>
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
    var clientes  = <?php echo json_encode($clientes); ?>;
    var destinos  = <?php echo json_encode($destinosInfo); ?>;
    var otrosPrueba;
    var isCliente = true;
    var retorno;

$(document).ready(function(){
	$("#btn-limpiar").after('<a class="btn btn-success" style="padding:5px 10px 4px 5px;" title="Exportar" href="excel/1"><span class="glyphicon glyphicon-download-alt"></span>Excel</a>');
	
	$("#fancybox-otros").click( function (){
		$.fancybox.open({
			href : "otros",
			type : 'iframe',
			padding : 5,
			width : 600,
			height :300,
			//maxHeight : 200,
			autoScale : false,
			beforeClose: function(){
				retorno = $('.fancybox-iframe').contents().find('#retorno').val();
				$('#DescuentoOtrosEmpaques').val(retorno);
			}
		});
	});

	var contactosIniciales = [
		{desde: "", hasta: "", descuento: ""}
	];

	var UnidadesModel = function(unidades) {
		var self = this;
		self.unidades = ko.observableArray(ko.utils.arrayMap(unidades, function(unidad) {
		    return {desde: unidad.desde, hasta: unidad.hasta, descuento: unidad.descuento};
		}));

		self.addUnidad = function() {
		    self.unidades.push({
		        desde: "",
		        hasta: "",
		        descuento: ""
		    });
		};

		self.removeUnidad = function(unidad) {
		    self.unidades.remove(unidad);
		};
		self.addKilo = function() {
		    self.unidades.push({
		        desde: "",
		        hasta: "",
		        descuento: ""
		    });
		};

		self.removeKilo = function(kilo) {
		    self.unidades.remove(kilo);
		};
	};
	ko.applyBindings(new UnidadesModel(contactosIniciales));



	$('#DescuentoDescuentoTodasRegiones').click(function () {
		$('.DescuentoRegion').hide();
		$('.DescuentoDestino1').hide();
		$('.DescuentoDestino2').hide();
	});
	$('#DescuentoDescuentoRegion').click(function () {
		$('.DescuentoRegion').show();
		$('.DescuentoDestino1').hide();
		$('.DescuentoDestino2').hide();
	});
	$('#DescuentoDescuentoDestino').click(function () {
		$('.DescuentoRegion').show();
		$('.DescuentoDestino1').show();
		$('.DescuentoDestino2').show();
	});


	$("#DescuentoRegion").change(function () {
		//var reg = $("#DescuentoRegion option:selected").text();
		oTable.fnFilter(this.value, 1 );		
	});


	$("#DescuentoCliente").keyup( function (){
		oTable.fnFilter(this.value, 2 );
	});

	$("#DescuentoDestino1").keyup( function (){
		oTable.fnFilter(this.value, 6 );
	});
	
	$("#DescuentoDestino2").keyup( function (){
		oTable.fnFilter(this.value, 7 );
	});


	$("#DescuentoRegion").focus(function () {
		if(isCliente){
			oTable.fnFilterClear();
		}		
		oTable.fnReloadAjax(webroot+'sources/destinos_Descuentos.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Cod depart.';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre depart.';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Cod región';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Nombre región';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Cod destino';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Nombre destino';
		isCliente = false;
	});

	$("#DescuentoDestino1").keyup( function (){
		if(isCliente){
			oTable.fnFilterClear();
		}
		oTable.fnReloadAjax(webroot+'sources/destinos_Descuentos.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Cod depart.';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre depart.';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Cod región';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Nombre región';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Cod destino';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Nombre destino';
		isCliente = false;
	});
	
	$("#DescuentoDestino2").keyup( function (){
		if(isCliente){
			oTable.fnFilterClear();
		}
		oTable.fnReloadAjax(webroot+'sources/destinos_Descuentos.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Cod depart.';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre depart.';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Cod región';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Nombre región';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Cod destino';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Nombre destino';
		isCliente = false;
	});

	$("#DescuentoCliente").focus(function () {
		oTable.fnFilterClear();
		oTable.fnReloadAjax(webroot+'sources/clientes_Descuentos.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Documento';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre';
		oTable.fnSettings().aoColumns[4].nTh.innerHTML = 'Contacto';
		oTable.fnSettings().aoColumns[5].nTh.innerHTML = 'Dirección';
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Teléfono';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Celular';
		isCliente = true;
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	if(isCliente){
		    	$.each( clientes, function( key, value ) {
					if(id == value.Cliente.id){
						$('#DescuentoClienteId').val(value.Cliente.id);
						$('#DescuentoCliente').val(value.Cliente.documento);
						$('#DescuentoNombre').val(value.Cliente.nombres+' '+value.Cliente.apellidos);
						$(".excel").attr("href", $(".excel").attr("href")+'/'+value.Cliente.id)
						$(".deshacer").attr("href", $(".deshacer").attr("href")+'/'+value.Cliente.id)
					}
				});
		    } else {
		    	$.each( destinos, function( key, value ) {
					if(id == value.Destino.id){
						$('#DescuentoDestinoId').val(value.Destino.id);
						$('#DescuentoRegion').val(value.Destino.regionId);
						$('#DescuentoDestino1').val(value.Destino.codigo);
						$('#DescuentoDestino2').val(value.Destino.nombre);
					}
				});
		    }
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
		"sAjaxSource": webroot+'sources/clientes_Descuentos.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"bScrollCollapse": true,
		"aoColumns": [
	        { "sWidth": "0%" },
	        { "sWidth": "0%" },
	        { "sWidth": "10%" },
	        { "sWidth": "35%" },
	        { "sWidth": "10%" },
	        { "sWidth": "15%" },
	        { "sWidth": "20%" },
	        { "sWidth": "10%"}

	    ],

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
			{ "bVisible": false, "aTargets": [ 0, 1 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});


})


$.fn.dataTableExt.oApi.fnFilterClear  = function ( oSettings ) {
    oSettings.oPreviousSearch.sSearch = "";	      
    if ( typeof oSettings.aanFeatures.f != 'undefined' ) {
        var n = oSettings.aanFeatures.f;
        for ( var i=0, iLen=n.length ; i<iLen ; i++ ) {
            $('input', n[i]).val( '' );
        }
    }

    for ( var i=0, iLen=oSettings.aoPreSearchCols.length ; i<iLen ; i++ ) {
    	oSettings.aoPreSearchCols[i].sSearch = "";
    }
    oSettings.oApi._fnReDraw( oSettings );
};

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
</script>