<?php
    echo $this->Html->css('chosen');
    echo $this->Html->script('chosen.jquery');
?>
    <?php echo $this->Form->create('Tarifa',array('class'=>'form-inline'));?>
    <div class="form-group col-md-12">
        <div class="col-md-12" style="padding-top:25px;">
            <?php
            $options=array('TodasRegiones'=>'Todas las regiones ','Region'=>'Región ','Destino'=>'Destino ');
            $attributes=array('legend'=>false,'default'=>'Destino');
            echo $this->Form->radio('tarifa',$options,$attributes);
            ?>
        </div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('region',array('label'=>'Region: ','type'=>'select','options'=>$regiones,'empty'=>'')); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('origen',array('label'=>'Ciudad origen: ','type'=>'select','options'=>$destinos)); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('destino',array('label'=>'Ciudad destino: ','type'=>'select','options'=>$destinos)); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-20"><?php echo $this->Form->input('incrementar',array('label'=>'Incrementar: ','type'=>'text')); ?></div>
        <div class="col-md-20"><?php echo $this->Form->input('disminuir',array('label'=>'Disminuir: ','type'=>'text')); ?></div>
        <button type="button" id="btn-deshacer-inc" class="btn btn-danger" style="margin-top: 20px;">Deshacer Incrementar</button>
        <button type="button" id="btn-deshacer-dis" class="btn btn-danger" style="margin-top: 20px;">Deshacer Disminuir</button>
        <?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'margin-top: 20px;'));?>
    </div>
    <div class="form-group col-md-12">
        <?php echo $html;?>
    </div>
    <?php echo $this->Form->end();?>



<script>
var self;
var jsonData;
var url     = <?php echo "'".Router::url('/')."tarifas/'"; ?>;
var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;

$(document).ready(function(){
    $("#btn-deshacer-inc").click(function(){
        if(confirm("¿Esta seguro de deshacer el incremento?")){
            window.location = url+"incremento/1";
        }
    });
    $("#btn-deshacer-dis").click(function(){
        if(confirm("¿Esta seguro de deshacer la decremento?")){
            window.location = url+"decremento/1";
        }
    });
    $("#TarifaRegion").chosen({
        no_results_text           : 'No se encuentra la region.',
        width                     : "95%",
        allow_single_deselect     : true, 
        search_contains           : true,
        disable_search_threshold  : 10,
        placeholder_text_single   : "Seleccione la region"
    });
    $("#TarifaDestino").chosen({
        no_results_text           : 'No se encuentra el destino.',
        width                     : "95%",
        allow_single_deselect     : true, 
        search_contains           : true,
        disable_search_threshold  : 10,
        placeholder_text_single   : "Seleccione el destino"
    });
    $("#TarifaOrigen").chosen({
        no_results_text           : 'No se encuentra el origen.',
        width                     : "95%",
        allow_single_deselect     : true, 
        search_contains           : true,
        disable_search_threshold  : 10,
        placeholder_text_single   : "Seleccione el origen"
    });
    $('#TarifaIncrementar').change(function(){
        $('#TarifaDisminuir').val("");
        var incremento = $(this).val();
        $.each($(".tarifaVal"), function( key, value ) {
            var valor = $(value).attr('base');
            var valorF = parseFloat(valor);
            $(value).text((valorF+(valorF*(incremento/100))).toFixed(0));
        });
    });
    $('#TarifaDisminuir').change(function(){
        $('#TarifaIncrementar').val("");
        var incremento = $(this).val();
        $.each($(".tarifaVal"), function( key, value ) {
            var valor = $(value).attr('base');
            var valorF = parseFloat(valor);
            $(value).text((valorF-(valorF*(incremento/100))).toFixed(0));
        });
    });

    $('#qwer').dataTable( {
        "sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bPaginate": true,
        "sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
        "oLanguage": {
            "sUrl": webroot + 'files/es.txt'
        },
        "bFilter": true,
        "bSort": true,    /// CAMBIE ESTO A TRUE
        "bInfo": true,
        "bSortable": false,
        "bLengthChange": true,
        "bJQueryUI": true,
        "bAutoWidth": false
    });
/*
    var oTable = $('#tabla_id').dataTable( {
        "sAjaxSource": webroot+'sources/destinos_Tarifas.txt',
        "sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,

        "sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
        "oLanguage": {
        "sUrl": webroot + 'files/es.txt'
        },
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bLengthChange": true,
        //      "iDisplayLength": 10,
        "bJQueryUI": true,      
        "bAutoWidth": false,
        "aoColumns": [
            { "sWidth": "0%" },
            { "sWidth": "0%"},
            { "sWidth": "10%"},
            { "sWidth": "25%"},
            { "sWidth": "10%"},
            { "sWidth": "20%"},
            { "sWidth": "20%"},
            { "sWidth": "20%"}

        ],

        "aoColumnDefs": [
            { "bVisible": false, "aTargets": [ 0, 1 ] },
            { "bSearchable": false, "aTargets": [ 0 ] },
            { "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7] },
            { "sClass": "col-actions", "aTargets": [3] }
        ]
    });
*/

})
</script>