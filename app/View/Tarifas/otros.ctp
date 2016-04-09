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



    echo $this->Html->script('helpers/convenios');
    echo $this->Html->script('knockout.mapping');
?>


    <table>
        <thead>
            <tr>
                <th>Empaque</th>
                <th>Tarifa</th>
                <th>Kg. Maximos</th>
                <th></th>
            </tr>
        </thead>
        <tbody data-bind='foreach: datos'>
            <tr>
				<td><?php echo $this->Form->input('empaques',array('label'=>false,'type'=>'select','empty'=>'','options'=>null,'data-bind'=>'value: empaque_id')); ?></td>
                <td><?php echo $this->Form->input('precio',array('label'=>false,'type'=>'text','data-bind'=>'value: tarifa')); ?></td>
				<td><?php echo $this->Form->input('maximo',array('label'=>false,'type'=>'text','data-bind'=>'value: max_kilo')); ?></td>
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
$(document).ready(function(){

    var DatoModel = function(datos) {
        self = this;
        self.datos = ko.observableArray(datos);
     
        self.addDato = function() {
            self.datos.push({
                empaque_id: "",
                tarifa: "",
                max_kilo: ""
            });
        };
     
        self.removeDato = function(dato) {
            self.datos.remove(dato);
        };
     
    };
  //  ko.applyBindings(new DatoModel());
var viewModel = new DatoModel([{ empaque_id: "",tarifa: "",max_kilo: ""}]);
ko.applyBindings(viewModel);


    $('.btn-submit').click( function (i){
        $('#retorno').val(ko.mapping.toJSON(self));
        $.fancybox.close();
    });


})
</script>