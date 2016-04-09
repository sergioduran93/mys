
<?php
    echo $this->Html->script("tmpl.min");
    echo $this->Html->script("load-image.min");
    echo $this->Html->script("canvas-to-blob.min");
    echo $this->Html->script("bootstrap.min");
    echo $this->Html->script("jquery.fileupload");
    echo $this->Html->script("jquery.iframe-transport");
    echo $this->Html->script('jquery.fancybox.pack');
    echo $this->Html->script("jquery.fileupload-process");
    echo $this->Html->script("jquery.fileupload-image");
    echo $this->Html->script("jquery.fileupload-ui");
    echo $this->Html->script("main");
    echo $this->Html->css('jquery.fancybox');
    echo $this->Html->css('fileupload');

    echo $this->Html->css('prism');
    echo $this->Html->css('chosen');
    echo $this->Html->script('knockout');
    echo $this->Html->script('knockout.mapping');
    echo $this->Html->script('chosen.jquery');
    echo $this->Html->script('jquery.jsontotable.min');
    echo $this->Html->script('jquery.fancybox');
    echo $this->Html->css('jquery.fancybox');
?>



<div class="row" style="width:90%; margin-left:5%;">
    <br>
    <?php if(empty($usuario_actual['archivo'])){ $usuario_actual['archivo'] = '0'; } ?>
    <?php echo $this->Form->create('Venta',array('type'=>'file','class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
    <?php echo $this->Form->input('usuario_escan',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
    <?php echo $this->Form->input('control',array('type'=>'hidden','default'=>$usuario_actual['archivo'])); ?>
    <div class="form-group col-md-12">
        <div class="col-md-12"><?php echo $this->Form->input('escaneadas',array('label'=>'Guias ya escaneadas: ','multiple'=>true,'type'=>'select','options'=>$guiasEsca,'empty'=>'')); ?></div>
    </div>
    <div class="panel panel-primary col-md-12" style="margin-bottom: 10px;padding:0px;margin-left:30px;width: 94%;">
        <div class ="panel-heading">
            <div class="col-md-12">
                GUIAS
                <div style="padding: 0px 8px;float:right;" class="btn btn-default" data-bind='click: addUser'>
                    <span class="glyphicon glyphicon-plus"></span>Agregar
                </div>
            </div>
        </div>
        <div>
            <div class="form-group col-md-12"  data-bind='foreach: users'>
                <div data-bind='attr: {id: $index() } '>
                    <?php echo $this->Form->input('guia.',array('type'=>'hidden','data-bind'=>'value: remesa,attr: {id: "guia"+$index() }')); ?>
                    <div style="width:15%;float:left;padding:0px;"><?php echo $this->Form->input('remesa.',array('label'=>'Remesa: ','type'=>'text','data-bind'=>'value: remesa,attr: {id: "remesa"+$index() }','class'=>'remesaClass')); ?></div>
                    <div style="width:27%;float:left;padding:0px;"><?php echo $this->Form->input('ruta.',array('label'=>'Ruta: ','readonly'=>'readonly','type'=>'text','data-bind'=>'value: ruta,attr: {id: "ruta"+$index() }')); ?></div>
                    <div style="width:27%;float:left;padding:0px;"><?php echo $this->Form->input('destinatario.',array('label'=>'Destinatario: ','readonly'=>'readonly','type'=>'text','data-bind'=>'value: destinatario,attr: {id: "destinatario"+$index() }')); ?></div>
                    <div style="width:27%;float:left;padding:0px;"><?php echo $this->Form->input('cliente.',array('label'=>'Cliente: ','readonly'=>'readonly','type'=>'text','data-bind'=>'value: cliente,attr: {id: "cliente"+$index() }')); ?></div>
                    <div style="width:4%;float:left;margin-top:20px;">
                        <?php echo $this->Form->button('<span class="glyphicon glyphicon-remove"></span>',array('style'=>'padding:5px;','type'=>'button','class'=>'btn btn-danger push-right','data-bind'=>'click: $root.removeUser','escape'=>false));?>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end();?>

    <form id="fileupload" style="margin-left:30px;" action="upload" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page -->
        <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-md-12">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <input accept="image/png,image/gif,image/jpg,image/jpeg" type="file" name="files[]" multiple style="cursor:pointer;">
                </span>
                <button type="submit" class="btn btn-primary start" id="btn-submit">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Subir imagenes</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar subida</span>
                </button>
                <input type="checkbox" class="toggle hidden">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress state -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </form>

    <br>
</div>


<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { o.files[i].name = $("#guia"+i).val(); file.name=$("#guia"+i).val();  %}
    <div class="template-upload fade col-md-12">
        <div class="col-md-6">
            <span class="preview"></span>
        </div>
        <div class="col-md-3">
            {%=file.name %}
            <p class="size">Subiendo...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </div>
        <div class="col-md-3">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start hidden" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Subir</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel hidden" style="margin-top:30px;">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </div>
        <hr class="clearing"/>
    </div>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
<tr class="template-download fade">
<td>
<span class="preview">
</span>
</td>

</tr>
</script>



<script>
    var nameFiles = JSON.stringify(new Array('asadasd'));
    var User = function(data) {
        var self          = this;
        self.id           = data.id;
        self.remesa       = data.remesa;
        self.ruta         = data.ruta;
        self.base         = data.base;
        self.destinatario = data.destinatario;
        self.cliente      = data.cliente;
        self.paquete      = data.paquete;
    }
    var dataMappingOptions = {
        key: function(data) {
            return data.id;
        },
        create: function(options) {
            return new User(options.data);
        }
    };
    var viewModel = {
        users: ko.mapping.fromJS([]),
        loadUpdatedData: function(newData) {
            ko.mapping.fromJS(newData, viewModel.users);
        }
    };
    viewModel.addUser = function() {
        viewModel.users.push(new User({id: "", remesa:"", ruta:"", base:"", destinatario:"", cliente:"", paquete:""}));
        
        for (var z = 0; z < viewModel.users().length; z++) {
            $("#remesa"+z).autocomplete({
                source: ventasArray,
                select: function( event, ui ) {
                    var n = $(this).attr('id');
                    n = n.replace("remesa", "");
                    $.each(ventas,function(key,value) {
                        if(ui.item.value == value.Venta.remesa){
                            if(value.Venta.despachada == "Escaneada"){
                                var arrayAux = $("#VentaEscaneadas").val();
                                if(arrayAux == null){
                                    arrayAux = new Array();
                                }
                                arrayAux.push(value.Venta.id);
                                $("#VentaEscaneadas").val(arrayAux);
                                $("#VentaEscaneadas").trigger("chosen:updated");
                                $("#guia"+n).val("");
                                $("#ruta"+n).val("");
                                $("#destinatario"+n).val("");
                                $("#cliente"+n).val("");
                                confirm("Esta guia ya esta escaneada.");
                                $("#remesa"+n).val("");
                            } else {
                                $("#guia"+n).val(value.Venta.id);
                                $("#ruta"+n).val(value.Venta.origenNombre+"-"+value.Venta.destinoNombre);
                                $("#destinatario"+n).val(value.Venta.nombreDest);
                                $("#cliente"+n).val(value.Venta.nombreClien);
                            }
                        }
                    });
                }
            }); 
        };

        $.each($('.remesaClass'), function( key, value ) {
            $(value).change(function(){
                var suma = new Array();
                $.each($('.remesaClass'), function( key2, value2 ) {
                    suma.push($(value2).val());
                });
                nameFiles = JSON.stringify(suma);
            });
        });
    };
    viewModel.removeUser = function(selected) {
        viewModel.users.remove(selected);
    };
    viewModel.removeUserTotal = function() {
        viewModel.users.removeAll();
    };
    ko.applyBindings(viewModel);


    var webroot     = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
    var url         = <?php echo "'".Router::url('/')."recogidas'"; ?>;
    var ventas      = <?php echo json_encode($guias); ?>;
    var ventasArray = new Array();

    $.each(ventas,function(key,value) {
        ventasArray[key] = value.Venta.remesa;
    });

$(document).ready(function(){
    viewModel.addUser();
    $("#VentaEscaneadas").chosen({
        no_results_text           : 'No se encuentra la guia.',
        width                     : "95%",
        allow_single_deselect     : true, 
        search_contains           : true,
        disable_search_threshold  : 0,
        placeholder_text_multiple : "Seleccione la guia"
    });

    $("#btn-submit").click(function(){
        itsclicked = true;
        $('#VentaEscanearForm').submit();
    });

    var oTable = $('#tabla_id').dataTable( {
        "sAjaxSource": webroot+'sources/sin_despachar.txt',
        "sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,
        "sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
        "oLanguage": {
            "sUrl": webroot + 'files/es.txt'
        },
        "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
            html = '<a class="linkTrazabilidad btn btn-info" style="padding:0px;" title="Trazabilidad" href="'+url+'/trazabilidad/'+aData[0]+'">'+aData[3]+'</a></nav>';
            $('td:eq(0)', nRow).html(html);
            return nRow;
        },
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bLengthChange": true,
        "bJQueryUI": true,
        "aoColumns": [
            { "sWidth": "0%" },
            { "sWidth": "0%" },
            { "sWidth": "0%" },
            { "sWidth": "5%" },
            { "sWidth": "15%" },
            { "sWidth": "15%" },
            { "sWidth": "15%" },
            { "sWidth": "15%" },
            { "sWidth": "2%" },
            { "sWidth": "2%" }
        ],
        "aoColumnDefs": [
            { "bVisible": false, "aTargets": [ 0,1,2 ] },
            { "bSearchable": false, "aTargets": [ 0 ] },
            { "bSortable": false, "aTargets": [0] },
            { "sClass": "col-actions", "aTargets": [3] }
        ]
    });

})
</script>