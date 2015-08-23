/*jslint vars: false, browser: true */
/*global jQuery */

var connection_display_field = function(field, entidad, concepts) {
    $.ajax({
        url: field + "/"+ entidad,
        type: 'GET',
        cache: false,
        async: true,
        dataType: 'json',
        success: function (response) {
            concepts.find('option').remove().end().append('<option value="0">---------</option>');
            $.each(response, function() {
                concepts.append($("<option />").val(this.id).text(this.name));
            });
        }

    });
};


var display_field = function(visible, element) {
    var display = visible == false ? "none" : "block";
    element.parent().css("display", display);
    element.disabled = visible;
};

(function ($) {
    "use strict";
    $.fn.requestForm = function () {
        return this.each(function () {
            var $university = $("#fos_user_profile_form_university"),
                $college = $("#fos_user_profile_form_college"),
                $student_delegation = $("#fos_user_profile_form_studentdelegation");

                $university.change(function () {
                    var option = $('option:selected', this).attr('value');
                    connection_display_field('facultades', option, $college);
                    display_field(false, $student_delegation);
                });

                $college.change(function () {
                    console.log("entra");
                    var option = $('option:selected', this).attr('value');
                    connection_display_field('delegaciones', option, $student_delegation);
                    display_field(true, $student_delegation);
                });

        });

    };

$(document).ready(function () {
    $("form").requestForm();
});

}(jQuery));
