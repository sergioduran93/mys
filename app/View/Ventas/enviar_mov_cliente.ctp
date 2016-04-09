<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
	echo $this->Html->script('bootstrap.min');
?>

<div class="row" style="width:90%; margin-left:5%;">
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
	<?php echo $this->Form->input('informe',array('type'=>'hidden')); ?>
		<div><h3><center><span class="glyphicon glyphicon-envelope" style="margin-right:15px;"></span>ENVIAR INFORME</center></h3></div>
		<div class="form-group col-md-12">
			<div class="col-md-6"><?php echo $this->Form->input('email',array('label'=>'Email: ','type'=>'text','default'=>$this->data['Venta']['email'])); ?></div>
			<div class="col-md-6"><?php echo $this->Form->input('asunto',array('label'=>'Asunto: ','type'=>'text','default'=>"Informe de movilización (Cliente)")); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-12"><?php echo $this->Form->input('msg',array('label'=>'Mensaje: ','type'=>'textarea')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-12">
				<?php echo $this->Form->button("Enviar",array("id"=>"btnSend",'type'=>'button',"class"=>'btn btn-primary',"style"=>'margin-top: 20px','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
			</div>
		</div>
	<?php echo $this->Form->end();?>
</div>

<script>
	
$(document).ready(function(){
	$("#btnSend").click(function(){
		$.ajax({
			type: "POST",
			cache: false,
			url: "enviarMovCliente",
			data: $("#VentaEnviarMovClienteForm").serializeArray(), // all form fields
			success: function (data) {
				alert("Correo enviado");
			}
		}); 
	});
})
</script>