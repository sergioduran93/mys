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
	<?php echo $this->Form->create('Reempaque',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>TRAZABILIDAD DE REEMPAQUES</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<div class="form-group col-md-12">
			<div class="col-md-12">
				<div class="col-md-6">
					<?php echo $this->Form->input('reem',array('label'=>'Reempaque:','type'=>'text')); ?>
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
					<div class="col-md-4"><h4 class="traz"><span>Representante: </span><small id="repre"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Cedula: </span><small id="ced"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4 class="traz"><span>Codigo: </span><small id="cod"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Dirección: </span><small id="dir"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Telefono: </span><small id="tel"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4 class="traz"><span>Celular: </span><small id="cel"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Origen: </span><small id="orig"></small></h4></div>
					<div class="col-md-4"><h4 class="traz"><span>Destino: </span><small id="dest"></small></h4></div>
				</div>
			</div>
			<div style="margin-top:10px;" id="guias"></div>

		</div>
		<?php echo $this->Form->end();?>
		</div>
</div>
<script>
	var reempaque = <?php echo json_encode($reempaque); ?>;
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url       = <?php echo "'".Router::url('/')."ventas'"; ?>;
	var fullpath  = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;

	function setInfo (reempaque) {
		if(reempaque == ""){
			$("#guias").empty();
			$("#guiaInfo").hide();
		} else {
			$("#guias").empty();
			$("#guias").append(reempaque.Reempaque.html2);
			$("#ReempaqueReem").val(reempaque.Reempaque.id);
			$("#nego").text(reempaque.Reempaque.nego);
			$("#repre").text(reempaque.Reempaque.repre);
			$("#cod").text(reempaque.Reempaque.cod);
			$("#ced").text(reempaque.Reempaque.ced);
			$("#tel").text(reempaque.Reempaque.tel);
			$("#cel").text(reempaque.Reempaque.cel);
			$("#dir").text(reempaque.Reempaque.dir);
			$("#dest").text(reempaque.Reempaque.dest);
			$("#orig").text(reempaque.Reempaque.orig);
			$("#guiaInfo").show();
		}
	}

$(document).ready(function(){

	$("#guiaInfo").hide();
	if(reempaque != ""){
		setInfo(reempaque);
	}

	$("#btn-consultar").click(function(){
		var reempa = $("#ReempaqueReem").val();
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"reempaques/trazabilidad2/"+reempa,
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