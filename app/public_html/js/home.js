(function() {
    
    function buildTable(name, content, admin) {
    
        var table = "<div class='wrap-table'>" +
                    "<div class='table'>" +
                        "<table id='" + name + "'>" + 
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
    
    function attachHandlers(table) {
        
        table.find('tbody tr').click(function() {
            
            var id = $('table').attr('id'),
                value = $(this).find('td:eq(0)').html();
            
            switch ( id ) {
                case 'all':
                    requireTable('category', value);
                    break;
                case 'category':
                    requireTest('test', value);
                    break;
            }
            
        });
        
    }
    
    function requireTable(name, value) {
        
        var params = {};
        params[name] = value || true;
        
        $.post(STRESSFUL_API, params).done(function(data) {
            
            alert(data);
            
            var rep = JSON.parse(data);
            
            if ( rep.error ) {
                $(".container-section").html("<h1>" + rep.error + "</h1>");
            } else {
                var table = $(buildTable(name, rep.content, rep.admin));
                attachHandlers(table);
                $(".container-section").html(table);
            }
            
        });
    }
    
    
    $(function() {
        
        requireTable('all');
        
    });
    
    
})();