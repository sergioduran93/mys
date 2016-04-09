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

$cakeDescription = __d('cake_dev', 'MYS');
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
	echo $this->Html->script('bootstrapValidator.min');
	echo $this->Html->script('es_CL');
//	echo $this->Html->script('jquery.textarea');
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
	<div class="body-gray" id="page">
		<div class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container banner">
				<div class="navbar-header">
					<?php echo $this->Html->Image("logo2.png",array('url'=>array('controller'=>'users','action'=>'index'),'title'=>'HOME','class'=>'logo-left')); ?>        
		        </div>
		        <div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<?php 
							if ($role == 'Admin'){
								echo $this->element('admin');
							} else if ($role == 'Representante'){
								echo $this->element('representante');
							} else {
								echo $this->element('admin');
							}
						?>
					</ul>
					<div class="user-banner" style="color:#fff;">
						<?php if ($session): ?>
							<?php echo '<div>Bienvenido ' . $this->Html->link($usuario_actual['name'], array('controller'=>'users', 'action'=>'perfil',$usuario_actual['id']),array('class'=>'perfil')) . $this->Html->link('Salir', array('controller'=>'users', 'action'=>'logout'),array('class'=>'btn bord')).'</div>'; ?>
						<?php else: ?>
							<?php echo '<div>'.$this->Html->link('Entrar', array('controller'=>'users', 'action'=>'login'),array('class'=>'btn bord')).'</div>'; ?>
						<?php endif; ?>
					</div>
		        </div>
		    </div>
		</div>
		<div id ="margen2">
			<!--<nav class="navbar navbar-default" role="navigation" style="margin-left: -15px;margin-right: -15px;background-color: #f8f8f8; border-color: #e7e7e7;padding-top: 8px;">-->
			<nav class="navbar navbar-default banner-nav-grey" role="navigation">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <button id="btn-limpiar" type="submit" class="btn btn-primary" onclick="limpiar();">Limpiar</button>
				  <ul class="navbar-nav navbar-right btn btn-default" style="margin:0px;list-style: none;">
				    <li>Fecha:</li>
					<li><?php echo date("Y-m-d");?></li>
				  </ul>
				</div>
			</nav>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<br>
		<br>
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

<div class="modal fade" id="alertM">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Notificación</h4>
</div>
<div class="modal-body">
<p id="alertP">One fine body&hellip;</p>
</div>
<div class="modal-footer">
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>



<script>
var itsclicked = false;

function limpiar (argument) {
	$.each($("input"), function( key, value ) {
		var read = $(value).attr('readonly');
		if(read != "readonly"){
			$(value).val("");
		}
	});
	$("select").val("");
}

$("#linkPropio").mouseenter(function() {
		var link  = $(this).attr("src");
		var link2 = link.replace("propiob","propioa");
		$(this).attr("src",link2);
	})
	.mouseleave(function() {
		var link  = $(this).attr("src");
		var link2 = link.replace("propioa","propiob");
		$(this).attr("src",link2);
	}
);

$(document).ready(function(){
	$("input[type|='text']" ).change(function(){
		$(this).val($(this).val().toUpperCase());
	});
});
/*$(window).on('beforeunload', function(e) {
	return 'NO HA CERRADO SESSIÓN';
});*/
</script>
