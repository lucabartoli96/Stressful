(function() {
    
    function checkInput() {
        
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
        checkInput();
    
    });
    
})();
