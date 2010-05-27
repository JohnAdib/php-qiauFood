$(document).ready(function () {
    $('input[type="text"], textarea').focus(function () {
        defaultText = $(this).val();
        $(this).val('');
    });
    $('input[type="text"], textarea').blur(function () {
        if ($(this).val() == "") {
            $(this).val(defaultText);
        }
    });
});