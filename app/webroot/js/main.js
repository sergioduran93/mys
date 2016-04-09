/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        singleFileUploads: false,
        url: 'upload'
    });

    $('#fileupload').bind('fileuploadsubmit', function (e, data) {
        var suma = new Array();
        $.each($('.remesaClass'), function( key, value ) {
            suma.push($(value).val());
        });
        nameFiles     = JSON.stringify(suma);
        data.formData = {names: nameFiles};
        if (!data.formData.names) {
          return false;
        }
    });

    $('#fileupload').bind('fileuploaddone', function (e, data) {
        itsclicked = true;
        $("#VentaEscanearForm").submit();
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

});
