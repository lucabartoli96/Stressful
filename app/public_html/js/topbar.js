(function () {
	
	'use strict';
    
    function logout() {
        
        $('.logout').click(function() {
            
            var URL = window.location.href;
            URL = URL.substr(0, URL.lastIndexOf('/')) + "/login.php";
            
            post({
                'logout' : 'true'
            }, URL);
            
        });
        
    }

	$(function() {

        logout();

	});


}());

