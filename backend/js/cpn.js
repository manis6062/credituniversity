var items = [];


$(document).ready(function () {


    (function ($) {
        FormValidation.Validator.securePassword = {
            validate: function (validator, $field, options) {
                var value = $field.val();
                if (value === '') {
                    return true;
                }

                // Check the password strength
                if (value.length < 8) {
                    return {
                        valid: false,
                        message: 'The password must be more than 8 characters long'
                    };
                }

                // The password doesn't contain any uppercase character
                if (value === value.toLowerCase()) {
                    return {
                        valid: false,
                        message: 'The password must contain at least one upper case character'
                    }
                }

                // The password doesn't contain any uppercase character
                if (value === value.toUpperCase()) {
                    return {
                        valid: false,
                        message: 'The password must contain at least one lower case character'
                    }
                }

                // The password doesn't contain any digit
                if (value.search(/[0-9]/) < 0) {
                    return {
                        valid: false,
                        message: 'The password must contain at least one digit'
                    }
                }

                return true;
            }
        };
    }(window.jQuery));
});


$(document).ready(function () {
    var url = window.location.href;
    try {
        option = url.match(/option=(.*)/)[1];
        showDiv(option);
    } catch (e) {
    }
});

function showDiv(option) {
    $('.boxes').hide();
    $('#' + option).show();
}


function currentUrl() {
    return location.protocol + '//' + location.host + location.pathname;
}
function baseUrl() {
    return window.location.host;
}


function serverValidation(form, data, redirect) {
    try {
        var response = $.parseJSON(data);
    } catch (e) {
        window.location.href = redirect;
    }
    var message = response.message;

    if (response && response.result === 'error') {
        for (var field in response.fields) {
            form
                .bootstrapValidator('enableFieldValidators', field, true)
                .bootstrapValidator('updateStatus', field, 'INVALID', 'blank')
                .bootstrapValidator('updateMessage', field, 'blank', response.fields[field])
                .bootstrapValidator('validateField', field);
        }
    } else if (message != '' && message != null) {
        $("#baseModal2").modal().find('.modal-body').text(message).show();
    } else {
        window.location.href = redirect;
    }
}

function serverValidationNew(form, data, redirect) {
    try {
        var response = $.parseJSON(data);
    } catch (e) {
        window.location.href = redirect;
    }
    var message = response.message;

    if (response && response.result === 'error') {
        for (var field in response.fields) {
            form
                .formValidation('enableFieldValidators', field, true)
                .formValidation('updateStatus', field, 'INVALID', 'blank')
                .formValidation('updateMessage', field, 'blank', response.fields[field])
                .formValidation('validateField', field);
        }
    } else if (message != '' && message != null) {
        $("#baseModal2").modal().find('.modal-body').text(message).show();
    } else {
        window.location.href = redirect;
    }
}

function serverValidationNoRedirect(form, data) {
    var response = $.parseJSON(data);
    var message = response.message;

    if (response && response.result === 'error') {
        for (var field in response.fields) {
            form
                .formValidation('enableFieldValidators', field, true)
                .formValidation('updateStatus', field, 'INVALID', 'blank')
                .formValidation('updateMessage', field, 'blank', response.fields[field])
                .formValidation('validateField', field);
        }
    } else if (message != '' && message != null) {
        $("#baseModal2").modal().find('.modal-body').text(message).show();
    }
}


function disableValidators() {
    var form = arguments[0];
    for (var i = 1; i < arguments.length; i++) {
        $(form).bootstrapValidator('enableFieldValidators', arguments[i], false);
    }
}
function disableValidatorsNew() {
    var form = arguments[0];
    for (var i = 1; i < arguments.length; i++) {
        $(form).formValidation('enableFieldValidators', arguments[i], false);
    }
}
function enableValidatorsNew() {
    var form = arguments[0];
    for (var i = 1; i < arguments.length; i++) {
        $(form).formValidation('enableFieldValidators', arguments[i], true);
    }
}


function populateDropdown(data, id) {
    var selectedOption = $(id).find("option:selected").val();
    var names = "";
    try {
        var data1 = $.parseJSON(data);
        $.each(data1, function (id, name) {
            names += "<option value='" + id + "'>" + name + "</option>";
        });
    } catch (e) {
    }
    $(id).html(names);
    $(".select2").select2();
    $(id + " option[value=" + selectedOption + "]").attr("selected", "selected");
}


function dropdownSelectedVal(id) {
    return $("." + $("." + id).find("option:selected").val());
}
function dropdownSelectedText(id) {
    return $("." + $("." + id).find("option:selected").text());
}

function setVisibility($dropdownClass) {
    $(".roles option").each(function () {
        $("." + $(this).val()).css({'display': 'none'});
    });
    dropdownSelectedVal('roles').css({'display': 'block'});
}

function getRole() {
    return $(".roles").find("option:selected").val();
}

function modal(message) {
    $("#baseModal2").modal().find('.modal-body').text(message).show();

}

if (CKEDITOR.env.ie && CKEDITOR.env.version < 9)
    CKEDITOR.tools.enableHtml5Elements(document);

// The trick to keep the editor in the sample quite small
// unless user specified own height.


var initSample = (function () {

    var wysiwygareaAvailable = isWysiwygareaAvailable(), isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

    return function () {
        var editorElement = CKEDITOR.document.getById('editor');

        if (isBBCodeBuiltIn) {
            editorElement.setHtml(
                'Hello world!\n\n' +
                'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
            );
        }

        // Depending on the wysiwygare plugin availability initialize classic or inline editor.
        if (wysiwygareaAvailable) {
            CKEDITOR.replace('editor');
            config.fullPage = true;
            config.allowedContent = true;
            config.protectedSource.push(/<\?[\s\S]*?\?>/g);
            //config.startupMode = 'source';
        } else {
            editorElement.setAttribute('contenteditable', 'true');
            CKEDITOR.inline('editor');

            // TODO we can consider displaying some info box that
            // without wysiwygarea the classic editor may not work.
        }


    };

    function isWysiwygareaAvailable() {
        // If in development mode, then the wysiwygarea must be available.
        // Split REV into two strings so builder does not replace it :D.
        if (CKEDITOR.revision == ( '%RE' + 'V%' )) {
            return true;
        }

        return !!CKEDITOR.plugins.get('wysiwygarea');
    }

})();

CKEDITOR.config.height = 800;
CKEDITOR.config.width = 'auto';

function loadContent2() {
    $.get(
        'http://localhost/americancpn/uploads/email_templates/litmus_stamplia_templates/Minty/',
        function (response) {
            return response;
        });
}

function disable($id) {
    $(this).css('pointer-events', 'none').fadeTo(500, 0.2);
}

function getLocationData(position, callback) {
    geocoder = new google.maps.Geocoder();
    var location = 'Billings,MT';

    if (geocoder) {
        geocoder.geocode({'address': location}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                callback(results[0]);
            }
        });
    }
}


