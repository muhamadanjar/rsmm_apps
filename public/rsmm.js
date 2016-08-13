
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
});
(function($, window, document){}(jQuery, window, document));
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
    relative_urls: false,
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

function getGeoserverLayer () {
                
    var url = '/geoserver/wms?request=GetCapabilities&service=WMS&version=1.1.1&info_format=text/html';
    var parser = new ol.format.WMSCapabilities();
    $.ajax({
        url: url,
        dataType : 'json',
    }).then(function(response) {
       
                    
    });
}

/*var errorAjax = function(x,e,thrownError){
    if(x.status==0){
        console.log('You are offline!!\n Please Check Your Network.');
    }else if(x.status==404){
        console.log('Requested URL not found.');
    }else if(x.status==500){
        console.log('Internel Server Error.');
    }else if(e=='parsererror'){
        console.log('Error.\nParsing JSON Request failed.'+thrownError);
            
    }else if(e=='timeout'){
        console.log('Request Time out.');
    }else {
        console.log('Unknow Error.\n'+x.responseText);
    }
}*/

(function($, window, document){
    $('.formConfirm').on('click', function(e) {
            e.preventDefault();
            var el = $(this).parent();
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');
            
            $('#formConfirm')
            .find('#frm_body').html('<h6>'+msg+'</h6>')
            .end().find('#frm_title').html(title)
            .end().modal('show');
            
            $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
        });

        $('#formConfirm').on('click', '#frm_submit', function(e) {
            var id = $(this).attr('data-form');
            $(id).submit();

        });
  

}(jQuery, window, document));


//Validasi Number//
(function($, window, document){

	 /*$('input.bobotText').keyup(function(e) {  
		var val = this.value;
		if(val >= 0 && val <= 100){
		}else{
			alert("angka harus kurang dari 0 atau lebih dari 100");
			val = 0;
			return false;
		}
		return numeralsOnly(e);
		  
     });*/
	 $('input.bobotText').bind('keyup',rangeNumber);
		
	 
	 $('input[name="nilai_tgl"]').bind('keypress', function(e) {
		return numeralsOnly(e);
		
	 });
	 


}(jQuery, window, document));
//Date time............
(function($, window, document){
    $('#darijam').timepicker({ 'timeFormat': 'H:i:s','scrollDefaultNow': true});
    $('#sampaijam').timepicker({ 'timeFormat': 'H:i:s' });

    $(".dateField").datetimepicker({
        pickTime: false,
        format: 'YYYY-MM-DD'
    });
    $(".timeField").datetimepicker({
        pickDate: false,
        format: 'HH:mm',
        pickSeconds: true,
        pick12HourFormat: true  

    });


}(jQuery, window, document));

(function($, window, document){
    if( $( '.rt-clock' ).length > 0 ){
        var monthNames = [ 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember' ];
        var dayNames= [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu' ];

        var newDate = new Date();

        newDate.setDate(newDate.getDate());

        var date = dayNames[ newDate.getDay() ] + ', ' + newDate.getDate() + ' ' + monthNames[ newDate.getMonth() ] + ' ' + newDate.getFullYear();

        $( '.rt-clock .date' ).html( date );

        setInterval(
            function() {
                var seconds = new Date().getSeconds();
                $(".rt-clock .seconds").html(( seconds < 10 ? "0" : "" ) + seconds);
            },1000 );

        setInterval(
            function() {
                var minutes = new Date().getMinutes();
                $(".rt-clock .minutes").html(( minutes < 10 ? "0" : "" ) + minutes);
            },1000);

        setInterval(
            function() {
                var hours = new Date().getHours();
                $(".rt-clock .hours").html(( hours < 10 ? "0" : "" ) + hours);
            }, 1000);
    }
}(jQuery, window, document));

(function($, window, document){
    if( $( '#date_expired' ).length > 0 ){
        var dateline_now = document.getElementById('date_expired').value;
        var deadline = new Date(dateline_now);
        if(new Date() > deadline){
            alert('Udah deadline broh');
            window.location = 'http://'+window.location.hostname+':'+window.location.port;
        }    
    }
    
}(jQuery, window, document));
//Datatable.............................
(function($, window, document){

    /* # Data tables
================================================== */


    //===== Setting Datatable defaults =====//

    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        pagingType: 'full_numbers',
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Cari:</span> _INPUT_',
            lengthMenu: '<span>Data:</span> _MENU_',
            paginate: { 'first': 'Awal', 'last': 'Akhir', 'next': '>', 'previous': '<' }
        },
        "bSort": false
    });



    //===== Default datatable =====//

    $('.datatable table').dataTable();



    //===== Datatable with pager =====//

    $('.datatable-pager table').dataTable({
        pagingType: 'simple',
        language: {
            paginate: { 'next': 'Next →', 'previous': '← Previous' }
        }
    });



    //===== Media datatable =====//

    $('.datatable-media table').dataTable({
        columnDefs: [{ 
            orderable: false,
            targets: [ 0 ]
        }],
        order: [[ 1, 'asc' ]]
    });



    //===== Custom sort columns =====//

    $('.datatable-custom-sort table').dataTable({
        columnDefs: [{ 
            orderable: false,
            targets: [ 0, 2 ]
        }],
        order: [[ 1, 'asc' ]]
    });



    //===== Invoices datatable =====//

    $('.datatable-invoices table').dataTable({
        columnDefs: [{ 
            orderable: false,
            targets: [ 1, 6 ]
        }],
        order: [[ 0, 'desc' ]]
    });



    //===== Tasks datatable =====//

    $('.datatable-tasks table').dataTable({
        columnDefs: [{ 
            orderable: false,
            targets: [ 5 ]
        }]
    });



    //===== Saving state =====//

    $('.datatable-ajax-source table').dataTable({
        ajax: 'media/datatable_ajax_source.txt'
    });



    //===== Saving state =====//

    $('.datatable-state-saving table').dataTable({
        stateSave: true
    });



    //===== Datatable with selectable rows =====//

    $('.datatable-selectable table').dataTable({
        dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>',
        tableTools: {
            sRowSelect: 'multi',
            aButtons: 
            [{
                sExtends: 'collection',
                sButtonText: 'Tools <span class="caret"></span>',
                sButtonClass: 'btn btn-primary',
                aButtons:    [ 'select_all', 'select_none' ]
            }]
        }
    });



    //===== Datatable with tools =====//

    $('.datatable-tools table').dataTable({
        dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>',
        tableTools: {
            sRowSelect: "single",
            sSwfPath: "media/swf/copy_csv_xls_pdf.swf",
            aButtons: [
                {
                    sExtends:    'copy',
                    sButtonText: 'Copy',
                    sButtonClass: 'btn btn-default'
                },
                {
                    sExtends:    'print',
                    sButtonText: 'Print',
                    sButtonClass: 'btn btn-default'
                },
                {
                    sExtends:    'collection',
                    sButtonText: 'Save <span class="caret"></span>',
                    sButtonClass: 'btn btn-primary',
                    aButtons:    [ 'csv', 'xls', 'pdf' ]
                }
            ]
        }
    });



    //===== Datatable with custom column filtering =====//

    // Setup - add a text input to each footer cell
    $('.datatable-add-row table tfoot th').each( function () {
        var title = $('.datatable-add-row table thead th').eq($(this).index()).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Filter '+title+'" />' );
    });
 
    // DataTable
    var table = $('.datatable-add-row table').DataTable();
     
    // Apply the filter
    $(".datatable-add-row table tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    });


    $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');
	//===== Default datatable =====//

    $('.table-datatable table').dataTable();

}(jQuery, window, document));
//Grafik 
(function($, window, document){
	var Selector = '.piegrafik';
	if( $(Selector).length > 0 ){
		var title;
		$(Selector).each(function() {
			var datab = parseInt($(this).attr('data-berhasil'));
			var datatb = parseInt($(this).attr('data-gagal'));
			$(this).highcharts({
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: title
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				credits: {
					enabled: true,
					text: 'You can have a link in here too',
					href: 'http://www.google.com'
				},
				series: [{
					name: 'Rencana',
					colorByPoint: true,
					data: [{
						name: 'Berhasil (Selesai)',
						y: datab
					}, {
						name: 'Gagal (Belum Selesai)',
						y: datatb,
						sliced: true,
						selected: true
					}]
				}]
			});
		});
	}
	
}(jQuery, window, document));
//Ajax Bobot Nilai
(function($, window, document){
	$('.btn-harian-proses').on('click', function(e) {
    	e.preventDefault();
    	var btnawal = $(this);
		var el = $(this).parent();
        var harianid = el.attr('data-harianid');
        //var bobot = el.attr('data-bobot');
		var bobot = $(this).closest('.form-group').find("input[name='bobot']").val();

		
		var formData = {
            harianid: harianid,
            bobot: bobot,
			'_token': $('input[name=_token]').val(),
        }

		
		$.ajax({
			type: 'POST',
			url: '/edit-bobot',
			dataType : 'json',
			data: formData,
			success: function (data) {
                console.log(data);
				$(this).find("i").html("...");
            },
			error: function (data) {
                console.log('Error:', data);
            }
		});
            
        
    });


}(jQuery, window, document));
//Grafik Column
(function($, window, document){
	
	var Selector = '.column';
	if( $(Selector).length > 0 ){
		$(Selector).each(function() {
			var title = $(this).data('title') || 'Rencana Kerja Mingguan' ;
			var subtitle = $(this).data('subtitle') || 'Source : RSMM ';
			var db = $(this).data('berhasil') || $.error('data berhasil tidak ada.');
			var dtb = $(this).data('tberhasil') || $.error('data tidak berhasil tidak ada.');
			db = db.split(",").map(Number);
			dtb = dtb.split(",").map(Number);

			$(this).highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: title
				},
				subtitle: {
					text: subtitle
				},
				xAxis: {
					categories: [
						'Senin',
						'Selasa',
						'Rabu',
						'Kamis',
						'Jum\'at',
					   
					],
					crosshair: true,
					
				},
				yAxis: {
					min: 0,
					max:100,
					title: {
						text: 'Rainfall (%)'
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
					name: 'Terlaksana',
					data: db
		
				}, {
					name: 'Belum Terlaksana',
					data: dtb
		
				}],
				credits: {
					enabled: true,
					text: 'RSMM Studio',
					href: 'http://www.google.com'
				},
			});
		});
	}
	
}(jQuery, window, document));


