<?php 
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('custom');
	//echo $this->Html->css('superfish');
	echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
    echo $this->Html->css('jquery.dataTables_themeroller'); 
	//echo $this->Html->css('halflings');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-1.9.1.min');
	echo $this->Html->script('jquery-ui');

	echo $this->Html->script('hoverIntent');
	echo $this->Html->script('superfish');
	echo $this->Html->script('jquery.dataTables');
	echo $this->Html->script('knockout');
	echo $this->Html->script('bootstrapValidator.min');
	echo $this->Html->script('es_CL');
?>
<center>
<div style="width:30%;padding:10% 0%;">
	<fieldset class="panel panel-primary" style="text-align:left;">
		<div class ="panel-heading"><h4><span class="glyphicon glyphicon-user"></span>Ingreso al sistema</h4></div>
		<?php echo $this->Form->create('User',array('class'=>'form-horizontal panel-footer'));?>
		<div class="form-group">
			<div class="col-md-12"><?php echo $this->Form->input('username',array('label'=>'Usuario:','class'=>'colortexto form-control','data-bv-notempty'=>'true'));?></div>
		</div>
		<div class="form-group">
			<div class="col-md-12"><?php echo $this->Form->input('password',array('label'=>'Contraseña:','class'=>'colortexto form-control','data-bv-notempty'=>'true'));?></div>
		</div>
		<div class="form-group">
			<div class="col-md-12"><?php echo $this->Form->submit('Entrar',array('div' => false,'class'=>'btn btn-primary'));?></div>
		</div>
	</fieldset>
</center>
<hr class="clearing"/>

<script>
$(document).ready(function() {
    $('#UserLoginForm').bootstrapValidator({
    	feedbackIcons: {
            required: 'glyphicon glyphicon-asterisk',
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        }
    });
});
</script>