(function () {
	
	'use strict';
    
    function clickMenu() {
        
        $('#navbar ul li a').click(function(event) {
            event.preventDefault();
            $('.active').removeClass('active');
            $(this).closest('li').addClass('active');
            
        });

	}

	$(function() {
        
        clickMenu();
        //callToAction();

	});


}());

