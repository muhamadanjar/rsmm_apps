$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
});
(function($, window, document){}(jQuery, window, document));

$(function() {
/* # Data tables
================================================== */
    //===== Setting Datatable defaults =====//

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        pagingType: 'full_numbers',
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Data:</span> _MENU_',
            paginate: { 'first': 'Awal', 'last': 'Akhir', 'next': '>', 'previous': '<' }
        }
    });

    $.fn.dataTable.ext.buttons.reload = {
        text: 'Reload',
        action: function ( e, dt, node, config ) {
            dt.ajax.reload();
        }
    };

    var rencana_kerja = $('#rencana_kerjaDiv').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "ajax": "http://localhost:8000/api/data_rencana_kerja",
        
        "columns": [
            { "data": "kode_rencana","defaultContent": "<button>Click!</button>" },
            { "data": "rencana_kerja" },
            { "data": "dari_tgl" },
            { "data": "sampai_tgl" },
            { "data": "keterangan" },
        ],
    });

    var ToEndDate = new Date();
    ToEndDate.setDate(ToEndDate.getDate()+365);
    
    $( "#dari_tgl" ).datepicker( {
        format: 'dd/mm/yyyy',
        startDate: '01/01/2012',
        endDate: ToEndDate
    }); 

    $( "#sampai_tgl" ).datepicker( {
        format: 'dd/mm/yyyy',
        startDate: '01/01/2012',
        endDate: ToEndDate
    });

    $("#kode_grup_rencana").change(function(argument) {
        $.ajax({
            url:'http://localhost:8000/api/getkode-'+$(this).val(),
            type:'GET',
            //dataType:'json',
        }).done(function(argument) {
            console.log(argument);
            $("#kode_rencana").val(argument);
        });
    });
    

    

    

    

});

    

$.extend({
    getValues: function(url) {
        var result = null;
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            async: false,
            success: function(data) {
                result = data;
            }
        });
        return result;
    }
});
/*        
tinymce.init({
    selector: ".tinymce_rsmmm",
            theme: "modern",
                //skin: "light",
    width: 580,
    height: 200,    
    /*plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
    ],*/
    /*relative_urls: false,
    browser_spellcheck : true ,
    filemanager_title:"Responsive Filemanager",
    external_filemanager_path:"http://"+window.location.hostname+"/filemanager/",
    external_plugins: { "filemanager" : "../../filemanager/plugin.min.js"},
    codemirror: {
        indentOnInit: true, // Whether or not to indent code on init. 
        path: 'CodeMirror'
    },  
    image_advtab: true,
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "| responsivefilemanager | image | media | link unlink anchor | print preview code  | youtube | qrcode | flickr | picasa | easyColorPicker"
});
*/
function numeralsOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
            console.log(evt);
            return false;
        }
    return true;
}

function lettersOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
    if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
        alert("Enter letters only.");
        return false;
    }
    return true;
}

function ynOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
    if (charCode > 31 && charCode != 78 && charCode != 89 && charCode != 110 && charCode != 121) {
    alert("Enter \"Y\" or \"N\" only.");

    return false;
    }
    return true;
}

function valBetweenAlt(v, min, max) {
    if (val > min) {
        if (val < max) {
            return val;
        } else return max;
    } else return min;
}

function rangeNumber(evt) {

    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
                $(this).val(0);
            return false;
        }
        var max = 100;
        var min = 0;
        if ($(this).val() > max){
             $(this).val(max);
        }else if($(this).val() < min){
             $(this).val(min);
        }
        
        
        
    return true;
}

(function($, window, document){
    $('.frmKuesioner').on('click', function(e) {
        e.preventDefault();
        
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        
        $('#frmKuesioner')
        .find('#frm_body').html('<h6>'+msg+'</h6>')
        .end().find('#frm_title').html(title)
        .end().modal('show');
        
        $('#frmKuesioner').find('#frm_submit').attr('data-form', dataForm);
    });

    $('#frmKuesioner').on('click', '#frm_submit', function(e) {
        var id = $(this).attr('data-form');
        console.log(id);
        $(id).submit();
    });

    $('.frmModal').on('click', function(e) {
        e.preventDefault();
        
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        console.log(dataForm);
        $('#frmModal')
        .find('#frm_body').html('<h6>'+msg+'</h6>')
        .end().find('#frm_title').html(title)
        .end().modal('show');
        
        $('#frmModal').find('#frm_submit').attr('data-form', dataForm);
    });

    $('#frmModal').on('click', '#frm_submit', function(e) {
        var id = $(this).attr('data-form');
        console.log(id);
        $(id).submit();
    });

}(jQuery, window, document));

(function($, window, document){
    $('#kuesioner_satu').DataTable();
    $('#kuesioner_dua').DataTable();
    $('#kuesioner_tiga').DataTable();
    $(".select2").select2();
    $('#tgl_masuk_kerja').datepicker({
      autoclose: true,
      dateFormat: 'dd.mm.yy',
    });
}(jQuery, window, document));

//BSN Form
(function($, window, document){
    //Initialize Select2 Elements
    
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    //$(".my-colorpicker1").colorpicker();
    //color picker with addon
    //$(".my-colorpicker2").colorpicker();

    //Timepicker
    /*$(".timepicker").timepicker({
      showInputs: false
    });*/
}(jQuery, window, document));