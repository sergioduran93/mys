<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Mandar y Servir S.A.S.');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
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
?>
<?php 
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
	echo $this->Html->script('bootstrapValidator.min');
	
?>

<!--[if IE 7]>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->

<!--[if lt IE 9]>
<script>
	var head = document.getElementsByTagName('head')[0], style = document.createElement('style');
	style.type = 'text/css';
	style.styleSheet.cssText = ':before,:after{content:none !important';
	head.appendChild(style);
	setTimeout(function(){ head.removeChild(style); }, 0);
</script>
<![endif]-->
</head>
<body>
	<div id="page">
		<div class="navbar navbar-default navbar-static-top" role="navigation">
		      <div class="container banner">
		        <div class="navbar-header">
				<?php echo $this->Html->Image("logo2.png",array('alt'=>'logo','title'=>'Mandar y Servir','class'=>'logo-left')); ?>        
		        </div>      
		      </div>
		</div>
		<div id ="margen">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('auth'); ?>
		<?php echo $content_for_layout; ?>
		</div>
	</div>
	<div id="footer">
		<center>
		<ol class="footer-back breadcrumb" style="padding:0px;">
			<li>
				<?php echo $this->Html->link('Home',array('controller'=>'users','action'=>'index'),array('style'=>'color:#999;')); ?>
			</li>
			<li class="active">
				<?php echo $this->Html->link('Mandar y Servir','http://www.mandaryservir.com',array('target'=>'_blank','style'=>'color:#999;')); ?>
			</li>
			<li class="active">
				<?php //echo $this->Html->link('Desarrollado por: <span class="glyphicon glyphicon-wrench"></span>','http://www.google.com',array('escape' => false,'style'=>'color:#999;')); ?>
				Desarrollado por:<?php echo $this->Html->image("propiob.png", array('id'=>'linkPropio','url' => 'http://www.ingenio-web.com','style'=>'width:100px;margin: 2px 0px 5px 10px;')); ?>
			</li>
		</ol>
		</center>
	</div>
</body>
</html>
