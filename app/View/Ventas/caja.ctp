<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<div class="row" style="width:90%;text-align:left; margin-left:5%;">
	<br>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>CUADRE DE CAJA</center></h3></div>
			<div class="form-group col-md-12">
				<div class="col-md-4"><?php echo $this->Form->input('oficina',array('label'=>'Oficina: ','type'=>'select','options'=>$oficinas,'default'=>$oficina,'empty'=>'')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('desde',array('label'=>'Desde: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$desde)); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('hasta',array('label'=>'Hasta: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$hasta)); ?></div>
				<div class="col-md-2">
					<?php echo $this->Form->button("Consultar",array("class"=>'btn btn-primary',"style"=>'margin-top: 20px;width: 100%;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
				</div>
				<?php if($post == true){ ?>
				<div class="col-md-12">
					<div class="col-md-6">
						<table class="table">
							<tr>
								<td style="padding:0px;">
									<button type="button" class="btn btn-success" style="width:100%;text-align:left;">
										<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
										Saldo Anterior
									</button>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($saldoAnt,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Anticipos de Caja
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="anticipo" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="anticipo" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($anticipo,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Venta de Contado
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="contado" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="contado" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($contado,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Otros Ingresos
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="anticipo" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="anticipo" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($recibo,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Recaudos Contraentrega
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="contra" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="contra" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($contra,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-danger" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-minus-sign" style="margin:0px;"></span>
											Fletes Pagados
										</button>
										<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="fletes" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="fletes" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($flete,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-danger" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-minus-sign" style="margin:0px;"></span>
											Salidas de Caja
										</button>
										<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="contado" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="contado" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($pago,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<button type="button" class="btn btn-primary" style="width:100%;text-align:left;">
										<span class="glyphicon glyphicon-chevron-right" style="margin:0px;"></span>
										SALDO
									</button>
								</td>
								<td style="padding:0px;"><?php echo '<strong style="float:right;margin-top: 7px;">$'.number_format($saldo,0,'','.').'</strong>'; ?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-6">
						<table class="table">
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Ventas Credito
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="credito" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="credito" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($credito,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Ventas de Cliente
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="credito" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="credito" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($cliente,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Ventas Contraentrega
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="contrat" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="contrat" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($contra,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Ventas Credicontado
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="credicon" class="linkReporte">PDF</a></li>
											<!--<li><a href="#" linkVal="credicon" class="linkReporteExcel">EXCEL</a></li>-->
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($credicon,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<button type="button" class="btn btn-primary" style="width:100%;text-align:left;">
										<span class="glyphicon glyphicon-chevron-right" style="margin:0px;"></span>
										SALDO
									</button>
								</td>
								<td style="padding:0px;"><?php echo '<strong style="float:right;margin-top: 7px;">$'.number_format($saldo2,0,'','.').'</strong>'; ?></td>
							</tr>
						</table>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>

	<?php echo $this->Form->end();?>
	<br>
</div>

<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/img/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."ventas/'"; ?>;

$(document).ready(function(){
	$("#VentaOficina").chosen({
		no_results_text           : 'No se encuentra la oficina.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione la oficina"
	});
	$(".linkReporte").click(function(){
		var varOficina = $("#VentaOficina").val();
		var varDesde   = $("#VentaDesde").val();
		var varHasta   = $("#VentaHasta").val();
		var href       = url + $(this).attr('linkVal')+'/'+varOficina+'/'+varDesde+'/'+varHasta;
		console.log(href);
		$.fancybox.open({
			href : href,
			type : 'iframe',
			padding : 5,
			width : "80%",
			height: "80%",
			//maxHeight : 200,
			//autoScale : true,
			scrolling : 'auto',
			scrollOutside   : false
		});
	});
	
	$(".linkReporteExcel").click(function(){
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		var varOficina = $("#VentaOficina").val();
		var varDesde   = $("#VentaDesde").val();
		var varHasta   = $("#VentaHasta").val();
		var href       = url+"cajaExcel"+'/'+ $(this).attr('linkVal')+'/'+varOficina+'/'+varDesde+'/'+varHasta;
		window.open(href);
		$.fancybox.hideLoading();
		$.fancybox.helpers.overlay.close();
	});
	
	/*$("#btn-consultar").click(function(){
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"ventas/trazabilidad2/"+remesa,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
			success: function(response) {
				console.log(response);
				response = JSON.parse(response);
				if(response != null){
					setInfo(response);
				}
				$.fancybox.hideLoading();
				$.fancybox.helpers.overlay.close();
			},
			error: function(e) {
				console.log("An error occurred: " + e.responseText.message);
			}
		});

	});*/
	$("#VentaDesde").datepicker();
	$("#VentaHasta").datepicker();


})
</script>