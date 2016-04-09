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

<div style="width:100%">
    <table>
        <thead>
            <tr>
                <th style="width:16%">Empaque</th>
                <th style="width:12%">Tarifa</th>
                <th style="width:12%">Kg. Maximo</th>
                <th style="width:12%">Largo</th>
                <th style="width:12%">Ancho</th>
                <th style="width:12%">Alto</th>
                <th style="width:12%">Peso</th>
                <th style="width:12%"></th>
            </tr>
        </thead>
        <tbody data-bind='foreach: datos'>
            <tr>
				<td><?php echo $this->Form->input('empaques',array('label'=>false,'type'=>'select','empty'=>'','options'=>null,'data-bind'=>'value: empaque_id')); ?></td>
                <td><?php echo $this->Form->input('precio',array('label'=>false,'type'=>'text','data-bind'=>'value: tarifa')); ?></td>
                <td><?php echo $this->Form->input('maximo',array('label'=>false,'type'=>'text','data-bind'=>'value: max_kilo')); ?></td>
                <td><?php echo $this->Form->input('largo',array('label'=>false,'type'=>'text','data-bind'=>'value: largo')); ?></td>
                <td><?php echo $this->Form->input('ancho',array('label'=>false,'type'=>'text','data-bind'=>'value: ancho')); ?></td>
                <td><?php echo $this->Form->input('alto',array('label'=>false,'type'=>'text','data-bind'=>'value: alto')); ?></td>
				<td><?php echo $this->Form->input('peso',array('label'=>false,'type'=>'text','data-bind'=>'value: peso')); ?></td>
                <td><a href='#' class="btn bord" data-bind='click: $root.removeDato'>Eliminar</a></td>
            </tr>
        </tbody>
    </table>
</div>
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
                max_kilo: "",
                largo: "",
                ancho: "",
                alto: "",
                peso: ""
            });
        };
     
        self.removeDato = function(dato) {
            self.datos.remove(dato);
        };
     
    };
  //  ko.applyBindings(new DatoModel());
var viewModel = new DatoModel([{ empaque_id: "",tarifa: "",max_kilo: "",largo: "",alto: "",ancho: "",peso: ""}]);
ko.applyBindings(viewModel);


    $('.btn-submit').click( function (i){
        $('#retorno').val(ko.mapping.toJSON(self));
        $.fancybox.close();
    });


})
</script>