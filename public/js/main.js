$(document).ready(function () {
    $("[rel=tooltip]").tooltip({ html: true });
    $(".field-tooltip").tooltip({
        html: true,
        placement: "right",
        trigger: "focus"
    });
    $('#authForm').on('submit', function (e) {
        if ($(".resetform").length) {
            $('.resetform').submit();
        } else {
            e.preventDefault();
        }
    });
    $('#loginName').blur(function () {
        console.log($(this).val());
    });
    $('#authForm .form-control').on('focus', function () {
        $('.submit-icon').removeClass('active');
        $(this).siblings('.submit-icon').addClass('active');
    });
    $('#authForm .form-control').on('blur', function () {
        $('.submit-icon').removeClass('active');
    });
    jQuery('#loginName .form-control').keyup(function (event) {
        if ($(this).val().length < 9) { $('#loginPassword').addClass('hidden'); }
        //$(this).val($(this).val().toUpperCase());
    });
    jQuery('#loginName .form-control').on('keypress', function (event) {
        if (event.charCode !== 13) {
            var regex = new RegExp("^[a-zA-Z0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });
    $('#loginName .form-control').on('propertychange input', function () {
        if ($(this).val() !== '') $('.id-error').hide();
    });
    $('.register-form #loginPassword .form-control, #authForm.resetform #password').on('propertychange input focus', function () {
        var passVal = $(this).val();
        if (!verifyPassField(passVal)) {
            $('#loginEmail').addClass('hidden');
        }
        if ($("#reset-submit").length) {
            $('#reset-submit').prop("disabled", true);
        }
        setTimeout(function () {
            var passTooltip = $('.tooltip-pass');
            $('li', passTooltip).removeClass('green');
            if (passVal.length >= 8) {
                $('.8char', passTooltip).addClass('green');
            }
            if (/[a-z]/.test(passVal) && /[A-Z]/.test(passVal)) {
                $('.up-lower', passTooltip).addClass('green');
            }
            if (/[0-9]/.test(passVal)) {
                $('.one-num', passTooltip).addClass('green');
            }
            if (/[^\w\s]/gi.test(passVal)) {
                $('.one-special', passTooltip).addClass('green');
                if ($("#reset-submit").length) {
                     $('#reset-submit').removeAttr("disabled");
                }
            }
        });
    });
    $('.register-form #loginName .form-control').on('propertychange input focus', function () {
        var passVal = $(this).val();
        setTimeout(function () {
            var passTooltip = $('.tooltip-pass');

            $('li', passTooltip).removeClass('green');
            if (passVal.length <= 8) {

            }
            if (passVal.length >= 9) {
                $('.4char', passTooltip).addClass('green');
            }
            if (passVal.length >= 23) {
                $('.18char', passTooltip).addClass('red');
                return false;
            }
            if (/[a-z]/.test(passVal) && /[A-Z]/.test(passVal)) {
                $('.up-lower', passTooltip).addClass('green');
            }
            if (/[0-9]/.test(passVal)) {
                $('.one-num', passTooltip).addClass('green');
            }
            if (/[^\w\s]/gi.test(passVal)) {
                $('.one-special', passTooltip).addClass('green');
            }
        });
    });

    // Resend 
    var _token = $('input[name="_token"]').val();
    jQuery( "#search_name" ).autocomplete({
      source: function( request, response ) {
        jQuery.ajax({
          url: "/search/name",
          dataType: "json",
          type: "POST",
          data: {q: request.term,_token: _token},
          success: function( data ) {
            response(jQuery.map(data.items, function(item) {
                return {
                        value: item.name,
                        label: item.name,
                        email: item.email,
                    };
                }));
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        jQuery("#searchEmail").html(ui.item.email);
        jQuery("#searchData").show();
        // log( ui.item ?
        //   "Selected: " + ui.item.name :
        //   "Nothing selected, input was " + this.value);
      },
      open: function() {
        jQuery( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        jQuery( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    });
});
function loginSubmit(field) {
    $('.form-error').hide();
    var idField = $('#loginName .form-control'),
        passField = $('#loginPassword .form-control');
    if (idField.is(":focus") || field == 1) {
        if (idField.val().length == 0) {
            $('.id-error').show();
            $('#loginPassword').addClass('hidden');
            return false;
        }
        $('#loginPassword').removeClass('hidden');
        passField.focus();
    } else if (passField.is(":focus") || field == 2) {
        if (passField.val() === '') {
            $('.pass-error').show();
        } else {
            var _token = $('input[name="_token"]').val();
            showLoader();
            $.ajax({
                url: "/user/login",
                method: 'POST',
                data: { username: $('#utn').val(), email: $('#email').val(), password: $('#password').val(), _token: _token },
                success: function (response) {
                    hideLoader();
                    if (response.status) {
                        $('#utn').css('border-color', 'green');
                        $('#password').css('border-color', 'green');
                        window.location.href = '/home';
                    } else {
                        $('#utn').css('border-color', 'red');
                        $('#password').css('border-color', 'red');
                        $('#error-msg').html(response.message);
                        $('#error-msg').show();
                        return false;
                    }
                }
            });
        }
    } else {
        console.log('else action');
    }
}
function registerSubmit(field) {
    $('.form-error').hide();
    var idField = $('#loginName .form-control'),
        passField = $('#loginPassword .form-control'),
        emailField = $('#loginEmail .form-control');
    if (idField.is(":focus") || field == 1) {
        if (idField.val() === '') {
            $('.id-error').show();
            return false;
        }
        if (idField.val().length >= 9) {
            var _token = $('input[name="_token"]').val();
            showLoader();
            $.ajax({
                url: "/is/username/exist",
                method: 'POST',
                data: { username: $('#utn').val(), _token: _token },
                success: function (response) {
                    hideLoader();
                    if (response.status) {
                        console.log(response.status);
                        $('#utn').css('border-color', 'green');
                        $('#loginPassword').removeClass('hidden');
                        passField.focus();
                    } else {
                        $('#utn').css('border-color', 'red');
                        $('.id-error').html(response.status);
                        $('.id-error').show();
                        return false;
                    }
                }
            });
        } else {
            $('#loginPassword').addClass('hidden');
        }
    } else if (passField.is(":focus") || field == 2) {
        if (passField.val() === '') {
            $('.pass-error').show();
        } else {
            if (verifyPassField($(passField).val())) {
                $('#loginEmail').removeClass('hidden');
                emailField.focus();
            }
        }
    } else if (emailField.is(":focus") || field == 3) {
        if (emailField.val() === '') {
            $('.email-error').show();
        } else {
            if ((/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(emailField.val()))) {
                showLoader();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "/add/user",
                    method: 'POST',
                    data: { username: $('#utn').val(), email: $('#email').val(), password: $('#password').val(), _token: _token },
                    success: function (response) {
                        hideLoader();
                        if (response.status) {
                            console.log(response.status);
                            $('#email').css('border-color', 'green');
                            $('#loginPassword').removeClass('hidden');
                            passField.focus();
                            window.location.href = '/verify';
                        } else {
                            $('#email').css('border-color', 'red');
                            $('#error-msg').html(response.msg);
                            $('#error-msg').show();
                            return false;
                        }
                    }
                });
            } else {
                $('.email-error').show();
            }

        }
    } else {
        console.log('else action');
    }
}
function resetSubmit(field) {
    $('.form-error').hide();
    var idField = $('#resetEmail .form-control');
    if (idField.is(":focus") || field == 1) {
        if (idField.val() === '') {
            $('.reset-error').show();
            return false;
        }
        showLoader();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/send/forgot/password/email",
            method: 'GET',
            data: { username: $('#utn').val(), email: $('#email').val(), password: $('#password').val(), _token: _token },
            success: function (response) {
                hideLoader();
                if (response.status) {
                    $('#error-msg').show();
                    $('#email').css('border-color', 'green');
                    $('#loginPassword').removeClass('hidden');
                    //passField.focus();
                    window.location.href = '/login';
                } else {
                    $('#error-msg').show();
                    $('#email').css('border-color', 'red');
                    $('#error-msg').html(response.msg);
                    $('#error-msg').show();
                    return false;
                }
            }
        });
    } else {
        console.log('else action');
    }
}
function verifySubmit() {
    $('.form-error').hide();
    var idField = $('#verificationCode .form-control');
    console.log("idField=" + idField.val());
    if (idField.val() === '') {
        $('.verify-error').show();
        return false;
    }
    showLoader();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: "/verify/otp",
        method: 'POST',
        data: { otp: $('#verify-otp').val(), user_id: $('#user_id').val(), _token: _token },
        success: function (response) {
            hideLoader();
            if (response.status) {
                console.log(response.status);
                $('#verify-otp').css('border-color', 'green');
                $('#loginPassword').removeClass('hidden');
                //passField.focus();
                window.location.href = '/home';
            } else {
                $('#verify-otp').css('border-color', 'red');
                $('#error-msg').html(response.message);
                $('#error-msg').show();
                return false;
            }
        }
    });

}
function verifyPassField(passVal) {
    if (!passVal) return false;
    if (passVal.length >= 8 &&
        /[a-z]/.test(passVal) && /[A-Z]/.test(passVal) &&
        /[0-9]/.test(passVal) &&
        /[^\w\s]/gi.test(passVal)) {
        return true;
    } else {
        return false;
    }
}
var loader = $('#loader');
function showLoader() {
    loader.show();
}
function hideLoader() {
    loader.hide();
}
