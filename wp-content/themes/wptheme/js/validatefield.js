
function validateTextField(textField, minVal, maxVal)
{
    var parentBlock = textField.parent().parent();
    var icon = textField.parent().find(".glyphicon");
    parentBlock.removeClass("has-error");
    parentBlock.removeClass("has-success");
    icon.removeClass("glyphicon-remove");
    icon.removeClass("glyphicon-ok");
    if (textField.val().length < minVal || (maxVal > 0 && textField.val().length > maxVal))
    {
        parentBlock.addClass("has-error");
        icon.addClass("glyphicon-remove");
        return false;
    }
    parentBlock.addClass("has-success");
    icon.addClass("glyphicon-ok");
    return true;
}

function validateSelectField(selectField, values)
{
    if (jQuery.inArray(parseInt(selectField.val()), values) < 0)
    {
        return false;
    }
    return true;
}

function validateNumberField(numberField, minVal, maxVal)
{
    if (numberField.val() < minVal || (maxVal > 0 && numberField.val() > maxVal))
    {
        return false;
    }
    return true;
}

function validateImageUploadingField(imageUploadingField)
{
    var parentBlock = imageUploadingField.parent();
    var messageBlok = parentBlock.find(".alert");
    messageBlok.hide();
    if (imageUploadingField.find('.file-preview-frame').length <= 0)
    {
        messageBlok.show();
        return false;
    }
    return true;
}