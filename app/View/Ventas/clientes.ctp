<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>CUENTA CLIENTES</center></h3></div>
			<div class="form-group col-md-12">
				<div class="col-md-4"><?php echo $this->Form->input('cliente',array('label'=>'Cliente: ','type'=>'select','options'=>$clientes,'default'=>$representante,'empty'=>'')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('desde',array('label'=>'Desde: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$desde)); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('hasta',array('label'=>'Hasta: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$hasta)); ?></div>
				<div class="col-md-2">
					<?php echo $this->Form->button("Consultar",array("class"=>'btn btn-primary',"style"=>'margin-top: 20px','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
				</div>
				<?php if($post == true){ ?>
				<div class="col-md-12">
					<div class="col-md-12">
					<div class="col-md-6">
						<table class="table">
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Contado
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="contado" class="linkReporte">PDF</a></li>
											<li><a href="#" linkVal="contado" class="linkReporteExcel">EXCEL</a></li>
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
											Credito
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="credito" class="linkReporte">PDF</a></li>
											<li><a href="#" linkVal="credito" class="linkReporteExcel">EXCEL</a></li>
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
											Credicontado
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="credicontado" class="linkReporte">PDF</a></li>
											<li><a href="#" linkVal="credicontado" class="linkReporteExcel">EXCEL</a></li>
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($credicontado,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Contraentrega
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="contraentrega" class="linkReporte">PDF</a></li>
											<li><a href="#" linkVal="contraentrega" class="linkReporteExcel">EXCEL</a></li>
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$'.number_format($contraentrega,0,'','.').'</span>'; ?></td>
							</tr>
							<tr>
								<td style="padding:0px;">
									<div class="btn-group" style="width:100%;">
										<button type="button" class="btn btn-success" style="width:90%;text-align:left;">
											<span class="glyphicon glyphicon-plus-sign" style="margin:0px;"></span>
											Especial
										</button>
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" style="width:10%;">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<ul class="dropdown-menu" role="menu" style="width:100%">
											<li><a href="#" linkVal="especial" class="linkReporte">PDF</a></li>
											<li><a href="#" linkVal="especial" class="linkReporteExcel">EXCEL</a></li>
										</ul>
									</div>
								</td>
								<td style="padding:0px;"><?php echo '<span style="float:right;margin-top: 7px;">$0</span>'; ?></td>
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
				</div>
				</div>
				<?php } ?>
			</div>
		</div>

	<?php echo $this->Form->end();?>
	<br>
</div>

<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/img/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."ventas/'"; ?>;

$(document).ready(function(){
	$("#VentaCliente").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione el cliente"
	});

	$(".linkReporteExcel").click(function(){
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		var varRepre = $("#VentaCliente").val();
		var varDesde = $("#VentaDesde").val();
		var varHasta = $("#VentaHasta").val();
		var href     = url+"clienteExcel"+'/'+ $(this).attr('linkVal')+'/'+varRepre+'/'+varDesde+'/'+varHasta;
		location.assign(href);
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