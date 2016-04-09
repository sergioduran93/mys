<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<style>
/*.alinear h4 {float:left;}*/
</style>
<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<?php echo $this->Form->create('Despacho',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>TRAZABILIDAD DE DESPACHOS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<div class="form-group col-md-12">
			<div class="col-md-12">
				<div class="col-md-6">
					<?php echo $this->Form->input('reem',array('label'=>'Despacho:','type'=>'text')); ?>
				</div>
				<div class="col-md-6">
					<button type="button" class="btn btn-primary start" id="btn-consultar" style="margin-top: 25px;padding: 0px;">
						<i class="glyphicon glyphicon-repeat"></i>
						<span>Consultar</span>
					</button>
				</div>
			</div>
			<hr class="clearing"/>
			<div id="guiaInfo" class="bs-callout bs-callout-green" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4 class="traz"><span>Negociador: </span><small id="nego"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Conductor: </span><small id="cond"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Cedula: </span><small id="ced"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4 class="traz"><span>Dirección: </span><small id="dir"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Telefono: </span><small id="tel"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Celular: </span><small id="cel"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-6"><h4 class="traz"><span>Destino: </span><small id="dest"></small></h4></div>
					<div class="col-md-6"><h4 class="traz"><span>Origen: </span><small id="orig"></small></h4></div>
				</div>
				<h4>Guias</h4>
				<div id="guias"></div>
			</div>
		</div>
		<?php echo $this->Form->end();?>
		</div>
</div>
<script>
	var despacho = <?php echo json_encode($despacho); ?>;
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url       = <?php echo "'".Router::url('/')."ventas'"; ?>;
	var fullpath  = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;

	function setInfo (despacho) {
		if(despacho == ""){
			$("#guias").empty();
			$("#guiaInfo").hide();
		} else {
			$("#guias").empty();
			$("#guias").append(despacho.Despacho.html2);
			$("#nego").text(despacho.Despacho.nego);
			$("#cond").text(despacho.Despacho.cond);
			$("#ced").text(despacho.Despacho.ced);
			$("#tel").text(despacho.Despacho.tel);
			$("#cel").text(despacho.Despacho.cel);
			$("#dir").text(despacho.Despacho.dir);
			$("#dest").text(despacho.Despacho.dest);
			$("#orig").text(despacho.Despacho.orig);
			$("#guiaInfo").show();
		}
	}

$(document).ready(function(){

	$("#guiaInfo").hide();
	if(despacho != ""){
		setInfo(despacho);
	}

	$("#btn-consultar").click(function(){
		var reempa = $("#DespachoReem").val();
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"despachos/trazabilidad2/"+reempa,
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

	});

})
</script>