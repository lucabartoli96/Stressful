

var STRESSFUL_API = "http://localhost/Stressful/resources/library/stressful_api.php";


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


function getLocation() {
     var location = window.location.href;
     return location.substr(0, location.lastIndexOf('/'));
}


function errMsg(msg) {
    return '<div class="alert alert-warning">' + msg + '</div>';
}