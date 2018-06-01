(function () {
	
	'use strict';

	function clickMenu() {
        
        $('#navbar a:not([class="external"])').click(function(event){
			var section = $(this).data('nav-section'),
				navbar = $('#navbar');
            
            var $el = $('#navbar > ul');
            $el.find('li').removeClass('active');
            $el.each(function(){
                $(this).find('a[data-nav-section="'+section+'"]').closest('li').addClass('active');
            });

		    if ( navbar.is(':visible')) {
		    	navbar.removeClass('in');
		    	navbar.attr('aria-expanded', 'false');
		    	$('.js-fh5co-nav-toggle').removeClass('active');
		    }

		});
        

	}

    function callToAction() {
        
        var other = function (className) {
            if(className == "signup") {
                return "login";
            } else {
                return "signup"
            }
        }
        
        $(".call-to-action").click(function (event) {
            $("body").empty();
            $("link[href$='css/topbar.css']").attr("href", "css/login.css");
            
            var className = $(this).closest("li").attr("class");
            
            $("body").load("html/login.html", function() {
                $("." + other(className)).hide()
                
                $(".message").click(function(event) {
                    var className = $(this).parent("form").attr("class");
                    $("." + className).hide();
                    $("." + other(className)).show();
                })
            });
            
        });
        
        
    }

	$(function() {
        
        clickMenu();
        callToAction();

	});


}());

