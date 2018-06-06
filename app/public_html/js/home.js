(function() {
    
    
    var MODAL = "<div class='shadow'>" + 
                    "<form method='post' id='modal'>" + 
                       "<span id='close'>&times;</span>" + 
                       "<input type='text' name='name' placeholder='name'> " + 
                       "<button type='submit' name='{0}'> {1} </button>" + 
                    "</form>" + 
                "</div>";
    
    
    function clickTable() {
        
        $('table tbody tr').click(function (event) {
            
            var name = $(this).closest('table').data('id'),
                value = $(this).find('td:eq(0)').html();
            
            var params = {};
            params[name] = value;
            post(params);
            
        });
        
    }
    
    function adminButtons() {
        
        $('button.modify').click(function (event) {
            event.stopPropagation();
            
            var modal = $(MODAL.replace('{0}', 'modify')
                               .replace('{1}', 'modify'));
            
            
            var input = $("<input type='hidden'>");
            
            input.attr('oldname', name);
            input.attr('value', value);
            
            modal.find('form').append(input);
            
            $(modal).find('.close').click(function() {
                modal.remove();
            });
            
            $('header').after(modal);
            
        });
        
        $('button.delete').click(function (event) {
            event.stopPropagation();
            var name = $(this).closest('tr').find('td:eq(0)').html();
            
            if (confirm("Are you sure you want to delete " + name + "?")) {
                
                var table = $(this).closest('table');
                
                var params = {};

                if ( table.data('name') !== '' && table.data('value') !== '' ) {
                    params[table.data('name')] = table.data('value');
                }
                
                params['delete'] = name; 
                post(params);
            }
        });
        
    }
    
    
    function backButton() {
        
        $('#back').click(function() {
            post();
        });
        
    }
    
    
    function plusButton() {
        
        $('#plus').click(function() {
            
            var modal = $(MODAL.replace('{0}', 'add')
                               .replace('{1}', 'Add'));
            
            $(modal).find('.close').click(function() {
               
                modal.remove();
                
            });
            
            $('header').after(modal);
            
        });
        
    }
    
    
    $(function() {
       clickTable();
       adminButtons();
       backButton();
       plusButton();
        
    });
    
    
})();