<?php echo $this->Html->script('jquery.fineuploader-3.4.1.min'); ?>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('User',array('type'=>'file','class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('codigo',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role_id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('username',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('password',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('cookie',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('foto',array('type'=>'hidden')); ?>

	<div><h3><center>PERFIL DE USUARIO</center></h3></div>
	<div class="form-group col-md-12">
		<div class="col-md-2">
			<a href="#" class="thumbnail" id="user-avatar">
				<?php 
					if($foto == ""){
						echo $this->Html->Image("perfiles/empty.jpg",array('id'=>'user-avatar2'));
					} else {
						echo $this->Html->Image("perfiles/".$foto,array('id'=>'user-avatar2'));
					} 
				?>
			</a>      
			<?php echo $this->Form->input('foto',array('label'=>false,'type'=>'file','id'=>'files','style'=>'display:none;')); ?>
		</div>
		<div class="col-md-10">
			<div class="col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('name',array('label'=>'Nombres: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('lastname',array('label'=>'Apellidos: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('email',array('label'=>'Email: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Telefono: ','type'=>'text')); ?></div>
			</div>
			<div class="col-md-12">
				<div class="col-md-4"><?php echo $this->Form->input('username',array('label'=>'Usuario: ','type'=>'text','readonly'=>'readonly')); ?></div>
				<div class="col-md-4"><?php echo $this->Form->input('password',array('label'=>'Contraseña: ','type'=>'password')); ?></div>
				<div class="col-md-4"><?php echo $this->Form->input('password2',array('label'=>'Confirmar contraseña: ','type'=>'password')); ?></div>
			</div>
		</div>
	</div>
	<div class="form-group btns">
		<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>
<div id="progress">
	<div class="bar" style="width: 0%;"></div>
</div>


<script type="text/javascript">

	jQuery('#user-avatar').click(function(){
		jQuery('input[type=file]').click();
	});

	if (window.File && window.FileReader && window.FileList && window.Blob) {
		jQuery('#files').change(function(evt){

			var files = evt.target.files;
			for (var i = 0, f; f = files[i]; i++){

				if (!f.type.match('image.*')) {
					continue;
				}

				var reader = new FileReader();

				reader.onload = (function(theFile) {
					return function(e) {
						// Render thumbnail.
						var img = document.createElement('img');
						img.setAttribute('src',   e.target.result);
						img.setAttribute('width',   180);
						img.setAttribute('height',   180);
						img.setAttribute('title',  escape(theFile.name));

						jQuery('#user-avatar').find('img').remove();
						jQuery('#user-avatar').append(img);
					};
				})(f);
				reader.readAsDataURL(f);
			}
		});

	} else {

	}





/*
$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $(".bootstrap-filestyle").css("background-image", "url("+this.result+")");
               // $("#imagePreview2").attr("src", this.result);
            }
        }
    });
});

*/
</script>

<style>
#imagePreview {
    width: 180px;
    height: 180px;
    background-position: center center;
    background-size: cover;
    -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3);
    display: inline-block;
}
</style>