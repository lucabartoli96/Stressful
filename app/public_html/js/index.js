(function() {
    
    function getParams() {
            
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
        params['username'] = $("input[name='username']").val();
        if( $("input[name='email']").length ) {
            params['email'] = $("input[name='email']").val();
        }
        params['password'] = $(passwords[0]).val();

        return params;
    }
    
    $(function() {
        
        $('form').submit(function(event) {
            event.preventDefault();
            
            var params = getParams();
            
            if ( params !== null ) {
            
                $.post(STRESSFUL_API, params)
                .done(function(data) {
                    
                    if (LOG_ENABLED) { alert(data); }
                    
                    var rep = JSON.parse(data);

                    if ( rep.error ) {
                        
                        $("input").each(function() {
                            
                            var name = $(this).attr('name');
                            
                            if( rep.error[name] ) {
                                $(this).after(errMsg(rep.error[name]))
                            }
                            
                        });

                    } else {
                        setLocation('home');
                    }
                    
                });
            } 
        });
    
    });
    
})();
