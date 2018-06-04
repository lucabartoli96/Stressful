(function() {
    
    function formStuff() {
        $('form').submit(function(event) {
            event.preventDefault();
            
            var button = $(this).find('button[type="submit"]');
            
            if( button.html() === "Modify" ) {
                $(this).find('h5').hide();
                $(this).find('input').show();
                button.html("Save");
            } else {
                $(this).find('input').hide();
                $(this).find('h5').show();
                button.html("Modify");
            }
            
            
        })
    }
    
    
    function checkInput() {
        
        var err_msg = function (msg) {
            return '<div class="alert alert-warning">' + msg + '</div>';
        }
        
        $("form").submit(function(event) {
            
            $(".alert").remove();
            
            var inputs = $('input').filter(function() { return $(this).val() == ""; });
            
            if(inputs.length > 0) {
                event.preventDefault();
                inputs.each(function() {
                    $(this).after(err_msg($(this).attr("placeholder") + " is required")); 
                });
            }
            
            var passwords = $("input:password");
            
            if (passwords.length > 1 && $(passwords[0]).val() != "" && $(passwords[1]).val() != "")  {
                if ($(passwords[0]).val() != $(passwords[1]).val()) {
                   event.preventDefault(); $(passwords[1]).after(err_msg("Paswords mismatch"));
                }
            }
        });
    }
    
    $(function() {
        formStuff();
    
    });
    
})();