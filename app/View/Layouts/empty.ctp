<?php
	echo $this->Html->meta('icon');
	echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
	echo $this->Html->css('jquery.dataTables_themeroller'); 

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-1.10.2.min');
	echo $this->Html->script('hoverIntent');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->css('font_scala');
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('custom');
	//echo $this->Html->css('superfish');
	echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
	echo $this->Html->css('jquery.dataTables_themeroller'); 
	echo $this->Html->css('docs'); 
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
	echo $this->Html->script('custom');
	echo $this->Html->script('jquery.number.min');
	echo $this->Session->flash();
	echo $this->Session->flash('auth');
	echo $content_for_layout; 
?>