(function () {
	
	'use strict';
    
    function logout() {
        
        $('.logout').click(function() {
            
            var URL = getLocation() + "/login.php";
            
            post({
                'logout' : 'true'
            }, URL);
            
        });
        
    }

	$(function() {

        logout();

	});


}());

