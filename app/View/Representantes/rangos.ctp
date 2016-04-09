<?php 
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Html->script('hoverIntent');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->css('font_scala');
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('custom');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Html->script('jquery');
    echo $this->Html->script('jquery-1.9.1.min');
    echo $this->Html->script('jquery-ui');
    echo $this->Html->script('knockout');

    echo $this->Html->script('helpers/convenios');
    echo $this->Html->script('knockout.mapping');
?>


    <table>
        <thead>
            <tr>
                <th>Desde</th>
                <th>Hasta</th>
                <th>Porcentaje</th>
                <th></th>
            </tr>
        </thead>
        <tbody data-bind='foreach: datos'>
            <tr>
                <td><?php echo $this->Form->input('desde',array('label'=>false,'type'=>'text','data-bind'=>'value: desde')); ?></td>
                <td><?php echo $this->Form->input('hasta',array('label'=>false,'type'=>'text','data-bind'=>'value: hasta')); ?></td>
				<td><?php echo $this->Form->input('porcentaje',array('label'=>false,'type'=>'text','data-bind'=>'value: porcentaje')); ?></td>
                <td><a href='#' class="btn bord" data-bind='click: $root.removeDato'>Eliminar</a></td>
            </tr>
        </tbody>
    </table>
    
    <?php echo $this->Form->input('retorno',array('label'=>false,'type'=>'hidden','value'=>'')); ?>
    <button class="btn btn-primary" data-bind='click: addDato'>Agregar</button>
    <a class="btn btn-primary btn-submit" href="javascript:parent.$.fancybox.close();">Guardar</a>

<script>
var self;
var jsonData;
var rangos = <?php if(!empty($rangos['datos'])){ echo $rangos; } else { echo "0"; } ; ?>;

var DatoModel = function(datos) {
    self       = this;
    self.datos = ko.observableArray(datos);
 
    self.addDato = function() {
        self.datos.push({
            desde: "",
            hasta: "",
            porcentaje: ""
        });
    };
 
    self.removeDato = function(dato) {
        self.datos.remove(dato);
    };
 
};

var viewModel = new DatoModel();
ko.applyBindings(viewModel);


$(document).ready(function(){
    if(rangos.datos != undefined){
        for (var i = 0; i < rangos.datos.length; i++) {
            viewModel.datos.push(rangos.datos[i]);
        };
    }
    
  //  ko.applyBindings(new DatoModel());

    $('.btn-submit').click( function (i){
        $('#retorno').val(ko.mapping.toJSON(self));
        $.fancybox.close();
    });
})
</script>