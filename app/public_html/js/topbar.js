(function () {
	
	'use strict';
    
    function logout() {
        
        $('.logout').click(function() {
            
            $.post( STRESSFUL_API, {"logout" : "true"} )
            .done(function(data) {
                
                var rep = JSON.parse(data);
                
                if ( rep.logout ) {
                    setLocation('login');
                } else {
                    alert('Server error!');
                }
            });
            
        });
        
    }
    

	$(function() {

        logout();

	});


}());

