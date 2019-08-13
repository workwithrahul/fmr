jQuery(function () {

    if (jQuery(window).width() < 768) {

        jQuery("body").addClass("sidebar-toggled");
        jQuery("#accordionSidebar").addClass("toggled");

    }      


    jQuery(document).find("a.delete_record_cls.disabled").parent().parent().addClass("field_disabled_row");
    setTimeout(function () {
        jQuery(document).find('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
        jQuery(document).find('[data-toggle="modal"]').tooltip({'placement': 'top'});
    }, 1500);
    jQuery("#startdate").datepicker({
        dateFormat: "dd-mm-yy",
        maxDate: "today",
        onSelect: function () {
            var min = $(this).datepicker('getDate') || new Date();
            jQuery('#enddate').datepicker('option', {minDate: min});
            jQuery("#dosagefiltterdate").show();
            jQuery("#from_date").text(jQuery(this).val());

        }
    });

    jQuery("#enddate").datepicker({
        dateFormat: "dd-mm-yy",
        maxDate: "today",
        onSelect: function () {
            jQuery("#dosagefiltterdate").show();
            jQuery("#to_date").text(" to " + jQuery(this).val());
        }
    });

    //Disabled User Text Color Class
    setTimeout(function () {
        if (jQuery(document).find("#dosages_tab_head.active").length == 0) {
            jQuery(document).find("#readings_tab_head, #readings").addClass("active");
            jQuery(document).find("#readings").addClass("show");
            jQuery(document).find("#add_reading_field").show();
        }
    }, 1500);

    //Drag & Drop Reading Manage fields
    $("#cms_reading_fields_outer").sortable({
        delay: 150,
        stop: function () {
            var selectedData = new Array();
            $('#cms_reading_fields_outer .cms_fields_list').each(function () {
                selectedData.push($(this).attr("id"));
            });
            //console.log(selectedData);
            updateOrder(selectedData);
        }
    });

    function updateOrder(data) {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: APP_URL + "/admin/cms/manage/field/order",
            type: 'POST',
            data: {position: data, _token: _token},
            success: function (response) {
                setTimeout(function () {
                    location.reload();
                }, 200);
            }
        })
    }

    // Export Service Reports
    /* 	jQuery("#notification_all").on("click",function(){
     
     }); */

    // Push Notification Checkboxes
    jQuery("#notification_all").on("click", function () {
        if (this.checked) {
            jQuery('input[name="notification_service"]').prop("checked", true);
            jQuery('input[name="notification_repair"]').prop("checked", true);
            jQuery('input[name="notification_admin"]').prop("checked", true);
        } else {
            jQuery('input[name="notification_service"]').prop("checked", false);
            jQuery('input[name="notification_repair"]').prop("checked", false);
            jQuery('input[name="notification_admin"]').prop("checked", false);

        }
    });

    jQuery("#notification_service, #notification_repair, #notification_admin ").on("click", function () {
        var notification_service = jQuery('input[name="notification_service"]').prop("checked");
        var notification_repair = jQuery('input[name="notification_repair"]').prop("checked");
        var notification_admin = jQuery('input[name="notification_admin"]').prop("checked");
        if (notification_service == false || notification_repair == false || notification_admin == false) {
            jQuery('input[name="notification_all"]').prop("checked", false);
        }

        if (notification_service == true && notification_repair == true && notification_admin == true) {
            jQuery('input[name="notification_all"]').prop("checked", true);
        }
    });

    //Drag & Drop Dosage Manage fields
    $("#cms_dosage_fields_outer").sortable({
        delay: 150,
        stop: function () {
            var selectedData = new Array();
            $('#cms_dosage_fields_outer .cms_fields_list').each(function () {
                selectedData.push($(this).attr("id"));
            });
            //console.log(selectedData);
            updateDosageOrder(selectedData);
        }
    });

    function updateDosageOrder(data) {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: APP_URL + "/admin/cms/manage/dosage/order",
            type: 'POST',
            data: {position: data, _token: _token},
            success: function (response) {
                setTimeout(function () {
                    location.reload();
                }, 200);
            }
        })
    }

    //Preview Client Pool Photo
    jQuery('#client_pool_photo').change(function () {
        var input = this;
        var url = jQuery(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            jQuery('#preview_pool_img').show();
            jQuery('#img_placehoder_text').hide();
            reader.onload = function (e) {
                jQuery('#preview_pool_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            jQuery('#img').attr('src', '/assets/no_preview.png');
        }
    });

    //Preview Proflie Photo
    jQuery('#profile_photo').change(function () {
        var input = this;
        var url = jQuery(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                jQuery('#preview_profile_pic, #preview_tech_profile_pic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            jQuery('#img').attr('src', '/public/images/profilepic.png');
        }
    });

    //Preview CMS About Us Banner
    jQuery('#about_banner_img').change(function () {
        var input = this;
        var url = jQuery(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e) {
                jQuery('#preview_about_banner').attr('src', e.target.result);
                jQuery(".about_banner_error").hide();
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            jQuery(".about_banner_error").html("The service image must be an image.");
            jQuery(".about_banner_error~span.invalid-feedback").hide();
        }

    });

    //Preview CMS Service Section Image
    jQuery(document).on('change', '.service_image', function () {
        var input = this;
        var url = jQuery(this).val();
        var service_img_id = jQuery(this).next().attr('id');
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            jQuery('.cms_about_service').show();
            jQuery('#img_placehoder_text').hide();

            reader.onload = function (e) {
                console.log(service_img_id);
                if (typeof service_img_id === 'undefined') {
                    jQuery(".cms_about_service").attr('src', e.target.result);
                } else {
                    jQuery("#" + service_img_id).attr('src', e.target.result);
                    jQuery("#" + service_img_id).next().hide();
                    jQuery(".cms_about_service").next().hide();
                }


            }
            reader.readAsDataURL(input.files[0]);
        } else {
            jQuery(this).next().next().html("The service image must be an image.");
        }
    });

    //Add New Section for CMS About Us Page
    var counter = 0;
    jQuery('#addnewserviceBtn').click(function () {
        counter++;
        if (counter <= 7) {
            jQuery('.service_section_row').append("<div class='row service_content_row'><div class='col-12 col-sm-6'><input class='service_image' type='file' name='service_image[]' /><img class='fullwidth cms_about_service' alt='service' style='display:none;' /><div id='img_placehoder_text' style='padding:15px 0;'>Select Image</div></div><div class='col-12 col-sm-5'><input type='text' class='themeinput3' name='service_name[]' placeholder='Service Name' value='' /></div><div class='col-12 col-sm-1 txt_center'><img class='actionicon delimg remove_service_row' src='" + APP_URL + "/public/images/del.png' alt='img'></div></div>");
        } else {
            jQuery(this).remove();
        }
    });

    // Remove service section jQuery
    jQuery('.remove_service_row').click(function () {
        jQuery(this).parent().parent().remove();
    });

    //Change password field display  
    jQuery('#change_password_field').click(function () {
        jQuery('#show_password_field').toggle();
    });

    //Ajax Change Password with validation
    jQuery('#change_pwd_btn').on('click', function () {
        var validator = jQuery("#change_password_pview").validate({
            rules: {
                password: "required",
                cnfpassword: {
                    equalTo: "#pviwe_pwd"
                }
            },
            messages: {
                password: " Enter Password",
                cnfpassword: "Enter Confirm Password Same as Password"
            }
        });
        if (validator.form()) {
            //e.preventDefault(); 
            var _token = jQuery('input[name="_token"]').val();
            var password = jQuery('input[name="password"]').val();
            var cnfpassword = jQuery('input[name="cnfpassword"]').val();
            var action = jQuery('#change_password_pview').attr('action');
            jQuery.ajax({
                type: "POST",
                url: action,
                data: {password: password, cnfpassword: cnfpassword, _token: _token},
                success: function (response) {
                    console.log(response.data.message);
                    if (response.status == "success") {
                        toastr.success(response.data.message, "Proflie", {timeout: 3000});
                        jQuery('#show_password_field').hide();
                    }
                }
            });
        }
    });

    //Ajax Submit work order request with validation
    jQuery('#work_order_req').on('click', function () {
        var validator = jQuery("#workOrders").validate({
            ignore: "",
            rules: {
                searchclient: {
                    required: true
                },
                searchtech: {
                    required: true
                },
                pool_issue: "required"
            },
            messages: {
                pool_issue: "This required field.",
                searchclient: "The search client field is required.",
                searchtech: "The search technician field is required."
            }
        });
        if (validator.form()) {
            //e.preventDefault(); 
            var _token = jQuery('input[name="_token"]').val();
            var pool_issue = jQuery('textarea[name="pool_issue"]').val();
            var searchclient = jQuery('input[name="searchclient"]').val();
            var searchtech = jQuery('input[name="searchtech"]').val();
            var action = jQuery('#workOrders').attr('action');
            jQuery(this).prop("disabled", true);
            jQuery.ajax({
                type: "POST",
                url: action,
                data: {pool_issue: pool_issue, searchclient: searchclient, searchtech: searchtech, _token: _token},
                success: function (response) {
                    console.log(response.data.message);
                    if (response.status == "success") {
                        toastr.success(response.data.message, "Work Orders", {timeout: 3000});
                        setTimeout(
                                function () {
                                    window.location.replace(APP_URL + "/admin/repair/request");
                                }, 1000);
                    }
                }
            });
        }
    });

    // Add delete button url in dialog box
    jQuery(document).on('click', ".client_del_yes", function () {
        setTimeout(function () {// wait for 5 secs(2)
            jQuery(".modal-backdrop.fade.show").remove();
            jQuery("#delete_record").removeClass('show');
        }, 2000);
    });

    jQuery(document).on('click', ".delete_record_cls", function () {
        $('.client_del_yes').attr('href', $(this).attr('href'));
    });

    // Add Client Cancel button url in dialog box
    jQuery(document).on('click', ".cancel_button_cls", function () {
        $('.cancel_button_yes').attr('href', $(this).attr('href'));
    });

    // Manage Fields Popup show and hide
    jQuery(document).on('change', ".field_type", function () {
        console.log("Dosage");
        manageFields();
    });

    //Reset Manage field form
    jQuery(document).on('click', ".add_mng_field", function () {
        $('#cms_manage_fields').find("input[type=text], textarea, input[type=number]").val("");
        $('#cms_manage_fields').find("select option:eq(0)").attr('selected', 'selected');
        var field_tab = jQuery(this).data('field_tab');
        jQuery("#manage_fields_modal").find('input[name="field_tab"]').val(field_tab);
        manageFields();
    });
    // Show hide tab add new field
    $('#dosages_tab_head').click(function () {
        $('#add_dosage_field').show();
        $('#add_reading_field').hide();
    });
    // Show hide tab add new field
    $('#readings_tab_head').click(function () {
        $('#add_dosage_field').hide();
        $('#add_reading_field').show();

    });
    $('.manage_fields_updt').click(function () {
        $('#cms_manage_fields').attr('action', $(this).attr('href'));
        var field_tab = jQuery(this).data('field_tab');
        var field_order = jQuery(this).data('field_order');
        var field_label = jQuery(this).data('field_label');
        var field_type = jQuery(this).data('field_type');
        var range_min = jQuery(this).data('range_min');
        var range_max = jQuery(this).data('range_max');
        var range_step = jQuery(this).data('range_step');
        var bool_val = jQuery(this).data('bool_val');
        var select_val = jQuery(this).data('select_val');
        console.log(range_min);
        jQuery("#manage_fields_modal").find('.field_type option').removeAttr("selected");
        jQuery("#manage_fields_modal").find('input[name="field_tab"]').val(field_tab);
        jQuery("#manage_fields_modal").find('input[name="field_order"]').val(field_order);
        jQuery("#manage_fields_modal").find('input[name="field_label"]').val(field_label);
        jQuery("#manage_fields_modal").find('.field_type option[value="' + field_type + '"]').attr("selected", "selected");
        manageFields();
        jQuery("#manage_fields_modal").find('input[name="range_min"]').val(range_min);
        jQuery("#manage_fields_modal").find('input[name="range_max"]').val(range_max);
        jQuery("#manage_fields_modal").find('input[name="range_step"]').val(range_step);
        jQuery("#manage_fields_modal").find('input[name="select_val"]').val(select_val);
        jQuery("#manage_fields_modal").find('input[name="bool_val"]').val(bool_val);

    });

    //Ajax Manage field form with validation
    jQuery('#cms_manage_btn').on('click', function () {
        var validator = jQuery("#cms_manage_fields").validate({
            rules: {
                field_label: "required",
                field_type: "required"
            },
            messages: {
                field_label: " Please enter field Name",
                field_type: "Please choose field type"
            }
        });
        if (validator.form()) {
            //e.preventDefault(); 
            var _token = jQuery('input[name="_token"]').val();
            var field_tab = jQuery('input[name="field_tab"]').val();
            var field_order = jQuery('input[name="field_order"]').val();
            var field_label = jQuery('input[name="field_label"]').val();
            var field_type = jQuery('select[name="field_type"]').val();
            var range_min = jQuery('input[name="range_min"]').val();
            var range_max = jQuery('input[name="range_max"]').val();
            var range_step = jQuery('input[name="range_step"]').val();
            //var bool_val = jQuery('input[name="bool_val"]:checked').val();
            var select_val = jQuery('input[name="select_val"]').val();
            //var textarea_val = jQuery('textarea[name="textarea_val"]').val();
            // var image_val = jQuery('input[name="image_val"]').val();
            var action = jQuery('#cms_manage_fields').attr('action');
            if (field_type == "range") {
                var field_data = {range_min: range_min, range_max: range_max, range_step: range_step};
            }
            /* if (field_type == "boolean") {
             var field_data = {bool_val: bool_val};
             } */
            if (field_type == "select") {
                var field_data = {select_val: select_val};
            }
            /* if (field_type == "textarea") {
             var field_data = {textarea_val: textarea_val};
             } */
            /* if (field_type == "image") {
             var field_data = image_val;
             } */
            jQuery.ajax({
                type: "POST",
                url: action,
                data: {field_tab: field_tab, field_label: field_label, field_type: field_type, field_order: field_order, field_data: field_data, _token: _token},
                success: function (response) {
                    //console.log( response );
                    if (response.status == "success") {
                        toastr.success(response.data.message, "Manage Fields", {timeout: 3000});
                        jQuery("#manage_fields_modal").hide();
                        jQuery(".modal-backdrop.fade.show").remove();
                        setTimeout(function () {// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 1000);

                    }
                }
            });
        }
    });

    //Click get contact email edit value
    jQuery(document).on('click', '.contact_email_field_add', function () {
        $('#cms_contact_email').attr('action', $(this).attr('href'));
        var email = jQuery(this).data('email');
        console.log(email);
        jQuery("#contact_field_record").find('input[name="email"]').val(email);

    });

    //Click get contact category edit value
    jQuery(document).on('click', '.contact_cat_field_add', function () {
        $('#cms_contact_cat').attr('action', $(this).attr('href'));
        var category = jQuery(this).data('category');
        console.log(category);
        jQuery("#contact_cat_field_record").find('input[name="category"]').val(category);

    });

    // Dosage Report filter show and hide
    jQuery(document).on('click', "#dosagefilter_btn", function () {
        $('#dosagefilter').toggle();
        $('#contactmessagefilter').toggle();
        $('#dosage_report_clear').toggle();
        $('#repair_report_clear').toggle();
        $('#service_report_clear').toggle();
        $('#dosagefiltterdate').toggle();
    });


    // Dosage Report Filter
    jQuery('#dosage_report_filter').on('click', function () {
        jQuery("#dosageReportList_processing").show();
        var searchclient = jQuery("#reportclient").val();
        var dosagetech = jQuery("#dosagetech").val();
        var startdate = jQuery("#startdate").val();
        var enddate = jQuery("#enddate").val();
        var _token = jQuery("input[name='_token']").val();
        jQuery.ajax({
            type: "POST",
            url: APP_URL + "/admin/dosage/reports/ajax",
            data: {searchclient: searchclient, dosagetech: dosagetech, startdate: startdate, enddate: enddate, _token: _token},
            success: function (response) {
                console.log(response);
                if (response.status == "success") {
                    jQuery("#dosageReportList_processing").hide();
                    if (response.data.length === 0) {
                        jQuery("#dosageReportList").html('');
                        jQuery("#dosageReportList").html('<div class="fullwidth dosagereport"><div class="row"><div class="col-12 col-sm-12"><span>No Records found</span></div></div></div>');
                    } else {
                        jQuery("#dosageReportList").html('');
                        jQuery.each(response.data, function (key, val) {
                            jQuery("#dosageReportList").append('<div class="fullwidth dosagereport"><div class="row"><div class="col-12 col-sm-9"><span>' + val.meta_key + '</span></div><div class="col-12 col-sm-3 text-right">' + val.meta_value + '</div></div></div>');
                        });
                    }
                }
            }
        });

    });

    // Dosage Report Filter
    jQuery('#dosage_report_clear').on('click', function () {
        $(".token-input-delete-token").trigger("click");
        $("#startdate").val('');
        $("#enddate").val('');
        $('#dosagefilter').hide();
        $('#dosagefiltterdate').hide();
        $('#dosage_report_clear').hide();
        jQuery("#dosageReportList_processing").show();
        var _token = jQuery("input[name='_token']").val();
        jQuery.ajax({
            type: "POST",
            url: APP_URL + "/admin/dosage/reports/ajax",
            data: {_token: _token},
            success: function (response) {
                console.log(response);
                if (response.status == "success") {
                    jQuery("#dosageReportList_processing").hide();
                    if (response.data.length === 0) {
                        jQuery("#dosageReportList").html('');
                        jQuery("#dosageReportList").html('<div class="fullwidth dosagereport"><div class="row"><div class="col-12 col-sm-12"><span>No Records found</span></div></div></div>');
                    } else {
                        jQuery("#dosageReportList").html('');
                        jQuery.each(response.data, function (key, val) {
                            jQuery("#dosageReportList").append('<div class="fullwidth dosagereport"><div class="row"><div class="col-12 col-sm-9"><span>' + val.meta_key + '</span></div><div class="col-12 col-sm-3 text-right">' + val.meta_value + '</div></div></div>');
                        });
                    }
                }
            }
        });

    });

    //Ajax Contact email field form with validation
    jQuery('#email_sbmt_btn').on('click', function () {
        var validator = jQuery("#cms_contact_email").validate({
            rules: {
                email: "required",
            },
            messages: {
                email: " Email field is required",
            }
        });
        if (validator.form()) {
            //e.preventDefault(); 
            var _token = jQuery('input[name="_token"]').val();
            var email = jQuery('input[name="email"]').val();
            var action = jQuery('#cms_contact_email').attr('action');
            console.log(action);
            jQuery.ajax({
                type: "POST",
                url: action,
                data: {email: email, _token: _token},
                success: function (response) {
                    if (response.status == "success") {
                        toastr.success(response.data.message, "", {timeout: 3000});
                        jQuery("#contact_field_record").hide();
                        jQuery(".modal-backdrop.fade.show").remove();
                        setTimeout(function () {// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 1000);

                    }
                },
                error: function (reject) {
                    if (reject.status === 422) {
                        var errors = $.parseJSON(reject.responseText);
                        jQuery.each(errors, function (key, val) {
                            if (typeof val.email != "undefined") {
                                jQuery(".contact_email_field").addClass('error');
                                jQuery(".contact_email_field").next().remove();
                                jQuery(".contact_email_field").after('<label for="email" class="error">' + val.email[0] + '</label>');
                            }
                        });
                    }
                }
            });
        }
    });
    //Ajax Contact Category field form with validation
    jQuery('#cat_sbmt_btn').on('click', function () {
        var validator = jQuery("#cms_contact_cat").validate({
            rules: {
                category: "required",
            },
            messages: {
                category: " Category field is required",
            }
        });
        if (validator.form()) {
            //e.preventDefault(); 
            var _token = jQuery('input[name="_token"]').val();
            var category = jQuery('input[name="category"]').val();
            var action = jQuery('#cms_contact_cat').attr('action');
            console.log(action);
            jQuery.ajax({
                type: "POST",
                url: action,
                data: {category: category, _token: _token},
                success: function (response) {
                    if (response.status == "success") {
                        toastr.success(response.data.message, "", {timeout: 3000});
                        jQuery("#contact_cat_field_record").hide();
                        jQuery(".modal-backdrop.fade.show").remove();
                        setTimeout(function () {// wait for 5 secs(2)
                            location.reload(); // then reload the page.(3)
                        }, 1000);

                    }
                },
                error: function (reject) {
                    if (reject.status === 422) {
                        var errors = $.parseJSON(reject.responseText);
                        jQuery.each(errors, function (key, val) {
                            if (typeof val.category != "undefined") {
                                jQuery(".contact_cat_field").addClass('error');
                                jQuery(".contact_cat_field").next().remove();
                                jQuery(".contact_cat_field").after('<label for="category" class="error">' + val.category[0] + '</label>');
                            }
                        });
                    }
                }
            });
        }
    });

    //Reset Form
    $('#resetForm').click(function () {
        if ($('#workOrders').length > 0) {
            $('#workOrders')[0].reset();
        }
        if ($('#new_tech_edit').length > 0) {
            $("#new_tech_edit").find("input[type=text], input[type=email], textarea").val("");
        }
        if ($('#edit_admin_detail').length > 0) {
            $("#edit_admin_detail").find("input[type=text], input[type=email], textarea").val("");
        }
        if ($('#edit_auth_profile').length > 0) {
            $("#edit_auth_profile").find("input[type=text], input[type=email], textarea").val("");
        }
        $('#searchclient_outer').find('.token-input-delete-token').trigger("click");
        $('#searchtech_outer').find('.token-input-delete-token').trigger("click");
    });
    //Search Client and Technician	
    if ($('#searchclient').length > 0) {
        jQuery("#searchclient").tokenInput(APP_URL + "/admin/client/search", {preventDuplicates: true, tokenLimit: 1, onReady: function () {
                $('#token-input-searchclient').attr('placeholder', 'Search Client');
            }, prePopulate: $clientName});
    }
    if ($('#searchtech').length > 0) {
        jQuery("#searchtech").tokenInput(APP_URL + "/admin/tech/search", {preventDuplicates: true, tokenLimit: 1, onReady: function () {
                $('#token-input-searchtech').attr('placeholder', 'Search Technician');
            }, prePopulate: $repairTech});
    }
    if ($('#specialtech').length > 0) {
        jQuery("#specialtech").tokenInput(APP_URL + "/admin/special/tech/search", {preventDuplicates: true, onReady: function () {
                $('#token-input-specialtech').attr('placeholder', 'Search Service Technician(s)');
            }, prePopulate: $serviceTech});
    }
    if ($('#dosagetech, #servicetech').length > 0) {
        jQuery("#dosagetech, #servicetech").tokenInput(APP_URL + "/admin/service/tech/search", {preventDuplicates: true, tokenLimit: 1, onReady: function () {
                $('#token-input-dosagetech, #token-input-servicetech').attr('placeholder', 'Search Technician');
            }});
    }
    if ($('#repairtech').length > 0) {
        jQuery("#repairtech").tokenInput(APP_URL + "/admin/repair/tech/search", {preventDuplicates: true, tokenLimit: 1, onReady: function () {
                $('#token-input-repairtech').attr('placeholder', 'Search Technician');
            }});
    }
    if ($('#bothtech').length > 0) {
        jQuery("#bothtech").tokenInput(APP_URL + "/admin/contact/message/search/tech", {preventDuplicates: true, tokenLimit: 1, onReady: function () {
                $('#token-input-bothtech').attr('placeholder', 'Search Technician');
            }});
    }
    if ($('#reportclient').length > 0) {
        jQuery("#reportclient").tokenInput(APP_URL + "/admin/report/clients/search", {preventDuplicates: true, tokenLimit: 1, onReady: function () {
                $('#token-input-reportclient').attr('placeholder', 'Search Client');
            }});
    }
});

function validatePassword() {
    var validator = jQuery("#change_password_pview, #new_tech_edit, #edit_auth_profile, #edit_admin_detail").validate({
        rules: {
            password: "required",
            cnfpassword: {
                equalTo: "#pviwe_pwd"
            }
        },
        messages: {
            password: " Enter Password",
            cnfpassword: "Enter Confirm Password Same as Password"
        }
    });
}

function manageFields() {

    jQuery("#field_tab").data(field_tab);
    var field_val = jQuery(".field_type").val();
    console.log(field_val);
    if (field_val == 'range') {
        jQuery("#field_type_option").html('');
        jQuery("#field_type_option").html('<div class="row align-items-center popformrow"><div class="col-sm-4 poplabel">Minimum Value</div><div class="col-sm-8 popinput"><input name="range_min" type="text" placeholder="2" /></div></div><div class="row align-items-center popformrow"><div class="col-sm-4 poplabel">Maximum Value</div><div class="col-sm-8 popinput"><input name="range_max" type="text" placeholder="7" /></div></div><div class="row align-items-center popformrow"><div class="col-sm-4 poplabel">Step Size</div><div class="col-sm-8 popinput"><input name="range_step" type="text" placeholder="0.5" /></div></div>');
    }

    if (field_val == 'boolean') {
        jQuery("#field_type_option").html('');
        // jQuery("#field_type_option").html('<div class="row align-items-center popformrow"><div class="col-sm-4 poplabel">Yes/No</div><div class="col-sm-8"><input type="radio" name="bool_val" value="yes" checked /> Yes<input type="radio" name="bool_val" value="no" /> No</div></div>');
    }

    if (field_val == 'select') {
        jQuery("#field_type_option").html('');
        jQuery("#field_type_option").html('<div class="row align-items-center popformrow"><div class="col-sm-4 poplabel">Select</div><div class="col-sm-8 popinput"><input type="text" id="select_val" name="select_val" placeholder="example, example1, example2" /></div></div>');
    }

    if (field_val == 'textarea') {
        jQuery("#field_type_option").html('');
        // jQuery("#field_type_option").html('<div class="row align-items-center popformrow"><div class="col-sm-4 poplabel">Textarea</div><div class="col-sm-8 rowform"><textarea name="textarea_val"></textarea></div></div>');
    }

    /*     if (field_val == 'image') {
     jQuery("#field_type_option").html('');
     jQuery("#field_type_option").html('<div class="row align-items-center popformrow"><div class="col-sm-4 poplabel">Image</div><div class="col-sm-8 popinput"><input type="file" name="image_val" /></div></div>');
     } */
}