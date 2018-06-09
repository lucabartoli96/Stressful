

function addHiddenInput(form, name, value) {

    var hiddenField = $("<input type='hidden' >");
    hiddenField.attr("name", name);
    hiddenField.attr("value", value);

    form.append(hiddenField);
}


function post(params, URL) {

    var form = $('<form> </form>');
    form.attr('method', 'POST');
    form.attr("style", 'display: none');
    
    if(URL) {
        form.attr("action", URL);
    }

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            addHiddenInput(form, key, params[key]);
        }
    }

    $('body').append(form);
    form.submit();
}


function err_msg(msg) {
    return '<div class="alert alert-warning">' + msg + '</div>';
}