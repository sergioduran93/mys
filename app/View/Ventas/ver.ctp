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
		<div><h3><center>VER GUIA</center></h3></div>
			<div class="form-group col-md-12">
				<div class="col-md-6"><?php echo $this->Form->input('guia',array('label'=>'Guia: ','type'=>'select','options'=>$guias,'default'=>$id,'empty'=>'')); ?></div>
			</div>
			<?php echo $this->Html->Image("escaner/empty.jpg",array('id'=>'imageId','style'=>'cursor:pointer;margin: 10px 0px 0px 30px;width: 50%;border-radius: 15px;border: 3px solid rgb(141, 193, 240);padding: 3px;')); ?>

		</div>
	<?php echo $this->Form->end();?>
	<br>
</div>

<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/img/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."img/'"; ?>;
	var guias   = <?php echo json_encode($guias); ?>;
	var inicial = 'empty.jpg';
	var inicialCopia = 'empty.jpg';

$(document).ready(function(){
	$("#imageId").click( function (){
		$.fancybox.open({
			href : $("#imageId").attr('src'),
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

	$("#VentaGuia").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione la guia"
	});

	$("#VentaGuia").change(function(){
		var id = $(this).val();
		if(id == ""){
			var urlImage = $("#imageId").attr('src');
			urlImage = urlImage.replace(inicial,inicialCopia);
			inicial = inicialCopia;
			$("#imageId").attr('src',urlImage);
		} else {
			var urlImage = $("#imageId").attr('src');
			urlImage = urlImage.replace(inicial,guias[id]+".jpeg");
			inicial = guias[id]+".jpeg";
			$("#imageId").attr('src',urlImage);
		}
	});

})
</script>