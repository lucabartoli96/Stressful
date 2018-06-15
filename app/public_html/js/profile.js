(function() {
    
    
    var name, email, since;
    
    
    function getParams() {
        $(".alert").remove();
            
        var inputs = $('input:not(input:password)').filter(function() { return $(this).val() == ""; });

        if(inputs.length > 0) {
            inputs.each(function() {
                $(this).after(errMsg($(this).attr("placeholder") + " is required")); 
                return null;
            });
        }

        var passwords = $("input:password");

        if ($(passwords[0]).val() != "") {
            if($(passwords[1]).val() === "")  {
                $(passwords[1]).after(errMsg("password confirmation is required")); 
            } else if ($(passwords[0]).val() != $(passwords[1]).val()) {
               $(passwords[1]).after(errMsg("Paswords mismatch"));
                return null;
            }
        }

        var params = {
            'profile' : true,
            'modify': name, 
            'name' : $("input[name='username']").val().trim(),
            'email': $("input[name='email']").val().trim()
        };

        if ( $(passwords[0]).val() !== "" ) {
            params['password'] = $(passwords[0]).val() 
        }
        
        return params;
    }
    
    function formEvents() {
        
        $('form').submit(function(event) {
            event.preventDefault();
            
            if ( $('button').html() == 'Save' ) {
                
                var params;
                
                if ( params = getParams() ) {
                    
                    $.post(STRESSFUL_API, params).done(function(data) {

                        if ( LOG_ENABLED ) { alert(data) };

                        var rep = JSON.parse(data);

                        if ( rep.error ) {

                            $("input").each(function() {

                                var name = $(this).attr('name');

                                if( rep.error[name] ) {
                                    $(this).after(errMsg(rep.error[name]))
                                }

                            });

                        } else {

                            name = params['name'];
                            email = params['email'];
                            switchContent('desc');
                        }

                    });
                }
                
            } else {
                switchContent('inputs');
            }
            
        });
        
    }
    
    
    function inputs() {
        
        $('form').html("<input type='text' placeholder='username' name='username' value='" + name + "'/>"+
         "<input type='email' placeholder='email' name='email' value='" + email + "' />"+
         "<input type='password' placeholder='new password' name='password'/>"+
         "<input type='password' placeholder='password confirmation' name='password_conf'/>"+
         "<button type='submit' name='save'>Save</button>");
    }
    
    function desc() {
        $('form').html("<h5><b>Username: </b>" + name + "</h5>" +
        "<h5><b>Email: </b>" + email + "</h5>" +
        "<h5><b>Since: </b>" + since + "</h5>"+
         "<button type='submit' name='modify'>Modify</button>");
    }
    
    
    
    function initFields(done) {
        
         $.post(STRESSFUL_API, {
                'profile': true
            }).done(function (data) {

                if ( LOG_ENABLED ) { alert(data); }

                var rep = JSON.parse(data);

                if ( rep.error ) {
                    alert(rep.error);
                } else {
                    name = rep.name;
                    email = rep.email;
                    since = rep.since;
                }
             
                if ( done ) {
                    done();
                }
             
            });
    }
    
    
    function switchContent(content) {
        
        switch ( content ) {
            
            case 'desc':
                desc();
                break;
            case 'inputs':
                inputs();
                break;
        }
        
    }
    
    $(function() {
        
        formEvents();
        initFields(function() {
           switchContent('desc'); 
        });
        
    });
    
})();