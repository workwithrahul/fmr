// Call the dataTables jQuery plugin
$(document).ready(function () {
	
    $('#dataTableClient').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/clients/ajax"},
		"drawCallback": function(settings) {
		   $(document).find("a.delete_record_cls.disabled").parent().parent().addClass("user_disabled_tr"); 
		},
        'columnDefs': [{
                'targets': [5], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "asc"]]
    });
	
	$('#notificationList').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/notifications/ajax"},
        'columnDefs': [{
                'targets': [3], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[3, "desc"]]
    });
	
    $('#clientRepairHistory').DataTable({
        "processing": true,
        "serverSide": true,
		"searching": false,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/repair/history/ajax"},
        'columnDefs': [{
                'targets': [3], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "desc"]]
    });
	
	$('#clientServiceHistory').DataTable({
        "processing": true,
        "serverSide": true,
		"searching": false,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/service/history/ajax"},
        'columnDefs': [{
                'targets': [5], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "desc"]]
    });
	
    dataTableTechnician = $('#dataTableTechnician').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {
            "url": APP_URL + "/admin/technicians/ajax",
            "type": "POST",
            "data": function (data) {
                data.service_team_tech = $('#service_team_tech:checked').val();
                data.repair_team_tech = $('#repair_team_tech:checked').val();
                data._token = jQuery('input[name="_token"]').val();
            }
        },
		"drawCallback": function(settings) {
		   $(document).find("a.delete_record_cls.disabled").parent().parent().addClass("user_disabled_tr"); 
		},
        'columnDefs': [{
                'targets': [6], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "asc"]]
    });
    $('#service_team_tech').on('click', function (e) {
        dataTableTechnician.ajax.reload();
    });

    $('#repair_team_tech').on('click', function (e) {
        dataTableTechnician.ajax.reload();
    });
    $('#clear_filter').on('click', function (e) {
        $('#service_team_tech').prop("checked", false);
        $('#repair_team_tech').prop("checked", false);
        dataTableTechnician.ajax.reload();
    });
    $('#dataTableCmsEmail').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/cms/contact/email/ajax"},
        'columnDefs': [{
                'targets': [1], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "desc"]]
    });
    $('#dataTableCmsCategory').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/cms/contact/category/ajax"},
        'columnDefs': [{
                'targets': [1], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "desc"]]
    });
    $('#openRepairRequest').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/repair/request/ajax"},
        'columnDefs': [{
                'targets': [3], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[3, "desc"]]
    });
	
	$('#completeRepairRequest').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/request/complete/ajax"},
        'columnDefs': [{
                'targets': [3], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "desc"]]
    });
	
    $('#dataTableAdmin').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {url: APP_URL + "/admin/team/ajax"},
		"drawCallback": function(settings) {
		   $(document).find("a.delete_record_cls.disabled").parent().parent().addClass("user_disabled_tr"); 
		},
        'columnDefs': [{
                'targets': [6], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "asc"]]
    });
	
	//Report Repair Tech Client History
	var reportRepair = $('#reportRepair').DataTable({
        "processing": true,
        "serverSide": true,
		"searching": false,
        "pageLength": 10,
		"ajax": {
            "url": APP_URL + "/admin/repair/reports/ajax",
            "type": "POST",
            "data": function (data) {
                data.client_id = $('#reportclient').val();
                data.tech_id = $('#repairtech').val();
                data.startdate = $('#startdate').val();
                data.enddate = $('#enddate').val();
                data._token = jQuery('input[name="_token"]').val();
            }
        },
        'columnDefs': [{
                'targets': [4], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[3, "desc"]]
    });
	$('#repair_report_filter').on('click', function (e) {
        reportRepair.ajax.reload();
    });
	$('#repair_report_clear').on('click', function (e) {
		$( ".token-input-delete-token" ).trigger( "click" );
		$( "#startdate" ).val('');
		$( "#enddate" ).val('');
		$('#dosagefilter').hide();
        $('#dosagefiltterdate').hide();
        $('#repair_report_clear').hide();
        reportRepair.ajax.reload();
    });
	//Contact Message List
	var contactMessage = $('#contactMessageList').DataTable({
        "processing": true,
        "serverSide": true,
		"searching": false,
        "pageLength": 10,
		"ajax": {
			"url": APP_URL + "/admin/contact/message/ajax",
			"type": "POST",
			"data": function (data) {
                data.tech_id = $('#bothtech').val();
				data.startdate = $('#startdate').val();
				data.enddate = $('#enddate').val();
				data._token = jQuery('input[name="_token"]').val();
			}
		},
        'columnDefs': [{
                'targets': [4], /* column index */
                'orderable': false, /* true or false */
            }],
        "order": [[0, "desc"]]
    });
	
	//Contact Messages Filter
	$('#contact_message_filter').on('click', function (e) {
        contactMessage.ajax.reload();
    });
	  
	////Contact Messages Clear Filter
	$('#contact_message_clear').on('click', function (e) {
		$( ".token-input-delete-token" ).trigger( "click" );
		$( "#startdate" ).val('');
		$( "#enddate" ).val('');
		$('#contactmessagefilter').hide();
        $('#dosagefiltterdate').hide();
        contactMessage.ajax.reload();
    });
	
	//Report Service Tech Client History	
	var reportService = $('#reportService').DataTable({
        "processing": true,
        "serverSide": true,
		"searching": false,
        "pageLength": 10,
		"order": [[3, "desc"]],
        "ajax": {
			"url": APP_URL + "/admin/service/reports/ajax",
			"type": "POST",
			"data": function (data) {
				data.client_id = $('#reportclient').val();
                data.tech_id = $('#servicetech').val();
				data.startdate = $('#startdate').val();
				data.enddate = $('#enddate').val();
				data._token = jQuery('input[name="_token"]').val();
			}
		},
        'columnDefs': [{
                'targets': [3], /* column index */
                'orderable': false, /* true or false */
            }]
    });
	
	//Report Service Tech Client History Filter
	$('#service_report_filter').on('click', function (e) {
        reportService.ajax.reload();
    });
	 
	//Report Service Tech Client History Clear Filter
	$('#service_report_clear').on('click', function (e) {
		$( ".token-input-delete-token" ).trigger( "click" );
		$( "#startdate" ).val('');
		$( "#enddate" ).val('');
		$('#dosagefilter').hide();
        $('#dosagefiltterdate').hide();
        $('#service_report_clear').hide();
        reportService.ajax.reload();
    });
});