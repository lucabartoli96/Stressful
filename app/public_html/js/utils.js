

var STRESSFUL_API = "http://localhost/Stressful/resources/library/stressful_api.php";

var LOG_ENABLED = true;

function addHiddenInput(form, name, value) {

    var hiddenField = $("<input type='hidden' >");
    hiddenField.attr("name", name);
    hiddenField.attr("value", value);

    form.append(hiddenField);
}


function post(params, file) {

    var form = $('<form> </form>');
    form.attr('method', 'POST');
    form.attr("style", 'display: none');
    
    if(file) {
        form.attr("action", getLocation() + '/' + file + '.php');
    }

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            addHiddenInput(form, key, params[key]);
        }
    }

    $('body').append(form);
    form.submit();
}


function buildTable(content, admin) {

    var table = '';

    table += "<div class='wrap-table'>" +
                "<div class='table'>" +
                    "<table>" + 
                        "<thead>" +
                            "<tr class='head'>" + 
                                "<th> </th>";


    var first = true;

    $(Object.keys(content[0])).each(function(idx, str) {
        if ( !first ) {
            table += "<th>" + str + "</th>";   
        } else {
            first = false;
        }
    });

    if ( admin ) {
        table += "<th class='last_column'></th>";
    }

    table += '</tr> </thead> <tbody>';

    $(content).each(function(idx, row) {

        table += '<tr>';

        first = true;

        $.each(row, function(key, value) {

            if ( first ) {
                table += "<td class='column1'>" + value + "</td>";
                first = false;
            } else {
                table += "<td>" + value + "</td>";
            }
        });

        if ( admin ) {
            table += "<td class='last_column'>" +
                        "<button class='modify'><img src='img/modify.png'></button>" +
                        "<button class='delete'><img src='img/delete.png'></button>" +
                    "</td>";
        }

        table += "</tr>";

    });

    table +=  "</tbody>" +
            "</table>" +
        "</div>" +
    "</div>";

    return table;
}


function getLocation() {
     var location = window.location.href;
     return location.substr(0, location.lastIndexOf('/'));
}

function setLocation(page) {
    window.location.href = getLocation() + '/' + page + '.php';
}


function errMsg(msg) {
    return '<div class="alert alert-warning">' + msg + '</div>';
}