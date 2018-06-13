(function() {
    
    function getParams() {
        
        $("form").submit(function(event) {
            event.preventDefault();
            
            $(".alert").remove();
            
            var inputs = $('input').filter(function() { return $(this).val() == ""; });
            
            if(inputs.length > 0) {
                inputs.each(function() {
                    $(this).after(errMsg($(this).attr("placeholder") + " is required")); 
                });
                return null;
            }
            
            var passwords = $("input:password");
            
            if (passwords.length > 1 && $(passwords[0]).val() != "" && $(passwords[1]).val() != "")  {
                if ($(passwords[0]).val() != $(passwords[1]).val()) {
                   $(passwords[1]).after(errMsg("Paswords mismatch"));
                    return null;
                }
            }
            
            var params = {};
        
            params[$('form').attr('id')] = true;
        
            inputs
                .filter(function() { return $(this).attr('type') === 'text'; })
                .each(function() {
                    params[$(this).attr('name')] = $(this).val();
                });

            params['password'] = $(passwords[0]).val();
            
            return params;
            
        });
    }
    
    $(function() {
        
        if ( let params = getParams() ) {
            
            $.post(STRESSFUL_API, params)
            .done(function(data) {
                
                var rep = JSON.parse(data);
                
                if ( rep.error ) {
                    
                } else {
                    
                }
                
                
            });
            
        }
    
    });
    
})();
