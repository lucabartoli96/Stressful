(function () {
	
	'use strict';
    
    function clickMenu() {
        
        $('#navbar ul li a:not(.call-to-action a)')
        .click(function(event) {
            event.preventDefault();
            $('.active').removeClass('active');
            $(this).closest('li').addClass('active');
            
        });

	}
    
    function logout() {
        
        $('.logout').click(function() {
            
            var URL = window.location.href;
            URL = URL.substr(0, URL.lastIndexOf('/')) + "/login.php";
            
            var form = document.createElement("form");
            form.setAttribute('action', URL);
            form.setAttribute('method', 'POST');
            form.setAttribute('style', 'display: none');
            
            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'logout');
            input.setAttribute('value', 'true');
            
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
            
        });
        
    }

	$(function() {
        
        clickMenu();
        logout();

	});


}());

