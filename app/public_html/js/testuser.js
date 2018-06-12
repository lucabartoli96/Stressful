(function() {
    
    
    function submitHandler() {
        
        $('form').submit(function(event) {
            event.preventDefault();
        });
        
        $("button[name='submit']").click(function(event) {
            event.preventDefault();
            
            if( confirm("You won't be able to change your answears, are you sure you want to submit?") ) {
                var category = $(this).data('category'),
                    name = $(this).data('name');
                
                var ans = [];
                
                $('.question').each(function() {
                    
                    var checked = $(this).find("input[type='radio']:checked");
                    
                    if ( checked.length ) {
                        ans.push(checked.closest('li').index());
                    } else {
                        ans.push(-1);
                    }
                    
                });
                
                post({
                    'category' : category,
                    'name' : name,
                    'submitted' : JSON.stringify(ans)
                });
            }
            
        });
    }
    
    function quitHandler() {
        
        $("button[name='quit']").click(function(event) {
            event.preventDefault();
            
            if( confirm('You will lose all your answeara, are you sure you want to quit') ) {
                var category = $("button[name='submit']").data('category');
                
                post({
                   'category' : category 
                }, 
                getLocation() + '/home.php');
                
            }
            
        })
        
    }
    
    function homeButton() {
        $("button[name='home']").click(function() {
            post({}, getLocation() + '/home.php');
        });
    }
    
    
    $(function() {
        
        submitHandler();
        quitHandler();
        homeButton();
        
    });
    
})();
