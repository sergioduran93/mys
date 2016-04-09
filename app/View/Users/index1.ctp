<?php 
		echo $this->Html->meta('icon');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('font-awesome-ie7');
		echo $this->Html->css('kube');
		echo $this->Html->css('superfish');
		echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
        echo $this->Html->css('jquery.dataTables_themeroller'); 

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery-1.9.1.min');
		echo $this->Html->script('hoverIntent');
		echo $this->Html->script('superfish');
		echo $this->Html->css('font_scala');
?>

index