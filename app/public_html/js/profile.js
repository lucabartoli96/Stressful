(function() {
    
    function checkInput(event) {
        
        var err_msg = function (msg) {
            return '<div class="alert alert-warning">' + msg + '</div>';
        }
        
        $("form").submit(function(event) {
            
            $(".alert").remove();
            
            var inputs = $('input:not(input:password)').filter(function() { return $(this).val() == ""; });
            
            if(inputs.length > 0) {
                event.preventDefault();
                inputs.each(function() {
                    $(this).after(err_msg($(this).attr("placeholder") + " is required")); 
                });
            }
            
            var passwords = $("input:password");
            
            if ($(passwords[0]).val() != "") {
                
                if($(passwords[1]).val() === "")  {
                    event.preventDefault();
                    $(passwords[1]).after(err_msg("password confirmation is required")); 
                } else if ($(passwords[0]).val() != $(passwords[1]).val()) {
                   event.preventDefault(); 
                   $(passwords[1]).after(err_msg("Paswords mismatch"));
                }
            }
        });
    }
    
    $(function() {
        checkInput();
    });
    
})();