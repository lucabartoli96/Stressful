(function() {


    function requireTable(name, value) {    
        
        state = name;
        category = value;
        
        var params = {};
        params[name] = value || true;
        
        $.post(STRESSFUL_API, params).done(function(data) {
            
            if(LOG_ENABLED) { alert(data); }
            
            var rep = JSON.parse(data);
            
            if ( rep.error ) {
                content = "<h1>" + rep.error + "</h1>";
            } else {
                content = buildTable(rep.content, admin);
            }
            
            $('.container-section').html(content);
            
        });
    }
    
    
    $(function() {
        
        requireTable('submission');
        
    });
    
})();
    