<?php 
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
?>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Contabl',array('class'=>'form-inline'));?>
		<div><h3><center>INGRESOS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<div class="form-group col-md-12">
			<div class="col-md-4"><?php echo $this->Form->input('numero',array('label'=>'Numero: ','type'=>'text','class'=>'form-control','readonly'=>'readonly','default'=>$count)); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('oficina',array('label'=>'Oficina: ','type'=>'select','options'=>$oficinas,'default'=>$usuario_actual['oficina_id'],'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('contable',array('label'=>'Cod Contable: ','type'=>'select','options'=>$cuentas,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-4"><?php echo $this->Form->input('cedula',array('label'=>'Cedula: ','type'=>'text','class'=>'form-control')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('nombres',array('label'=>'Nombre: ','type'=>'text','class'=>'form-control')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('factura',array('label'=>'No Factura: ','type'=>'text','class'=>'form-control')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-8"><?php echo $this->Form->input('concepto',array('label'=>'Concepto: ','type'=>'select','options'=>$cuentas,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('valor',array('label'=>'Valor:','default'=>'0','type'=>'text','class'=>'form-control valor')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-8"><?php echo $this->Form->input('iva',array('label'=>false,'type'=>'text','default'=>"RETENCIÓN X VENTAS",'readonly'=>'readonly','tabindex'=>"-1",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('valor_iva',array('label'=>false,'default'=>'0','type'=>'text','class'=>'form-control valor')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-8"><?php echo $this->Form->input('xcompra',array('label'=>false,'type'=>'text','default'=>"RETENCIÓN EN EL ICA",'readonly'=>'readonly','tabindex'=>"-1",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('valor_compra',array('label'=>false,'default'=>'0','type'=>'text','class'=>'form-control valor')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-8"><?php echo $this->Form->input('xservicios',array('label'=>false,'type'=>'text','default'=>"DESCUENTOS",'readonly'=>'readonly','tabindex'=>"-1",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('valor_servicios',array('label'=>false,'default'=>'0','type'=>'text','class'=>'form-control valor')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-8"></div>
			<div class="col-md-4"><?php echo $this->Form->input('total',array('label'=>'Valor Total','default'=>'0','type'=>'text','class'=>'form-control valorT')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-12"><?php echo $this->Form->input('obs',array('label'=>'Observaciones','type'=>'text','class'=>'form-control')); ?></div>
		</div>
		<div style="margin: 10px 33px;">
			<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
		</div>
		<?php echo $this->Form->end();?>

	<br>
</div>




<script>
var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
var url     = <?php echo "'".Router::url('/')."contables'"; ?>;
$(document).ready(function(){

	$("#ContablConcepto").chosen({
    	no_results_text           : 'No se encuentra el concepto.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_single : "Seleccione un concepto"
    });

	$("#ContablOficina").chosen({
    	no_results_text           : 'No se encuentra la oficina.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_single : "Seleccione una oficina"
    });

	$("#ContablContable").chosen({
    	no_results_text           : 'No se encuentra el concepto.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_single : "Seleccione un concepto"
    });


	$(".valor").change(function(){
		var suma = 0;
		$.each($(".valor"),function(key,value){
	    	suma += parseFloat($(value).val());
		});
		$(".valorT").val(suma);
	});

})
</script>