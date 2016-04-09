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
?>

<div class ="row post-body">
	<center>
		<br>
		<div style="padding:100px;"><?php echo $this->Html->Image("mys2.png",array('style'=>'width: 40%;')); ?></div>
	</center>
<br>

</div>
