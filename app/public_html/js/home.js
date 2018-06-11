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
            
            var table = $(this).closest('table'),
                id = table.data('id');
            
            if ( id !== 'test' ) {
                var modal = $(MODAL.replace('{0}', 'modify')
                               .replace('{1}', 'Modify')),
                form = modal.find('form');
            
                formEvents(modal);

                var oldname = $(this).closest('tr').find('td:eq(0)').html();

                form.find("button").val(oldname);

                $('header').after(modal);
                
            } else {
                
                var name = $(this).closest('tr').find('td:eq(0)').html();
                
                post({
                    'modify' : true,
                    'category' : table.data('category'),
                    'name' : name
                }, 
                getLocation() + "/testadmin.php");
                
            }
            
        });
        
        $('button.delete').click(function (event) {
            event.stopPropagation();
            var name = $(this).closest('tr').find('td:eq(0)').html(),
                table = $(this).closest('table'),
                id = table.data('id');
            
            if (confirm("Are you sure you want to delete " + name + " " + id + "?")) {
                
                var params = {};

                if( id === 'test' ) {
                    params['category'] = table.data('category');
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
    
    
    function formEvents(modal) {
        
        modal = modal || $('.shadow');
        
        var form = modal.find('form');
        
        form.submit(function(event) {
            
            $('.alert').remove();
            
            var input = $(this).find("input[name='name']");

            if ( input.val() === '' ) {
                event.preventDefault();
                input.after(errMsg('name is required'));
            }

        });

        $(form).find('#close').click(function() {

            modal.remove();

        });
        
    }
    
    
    function plusButton() {
        
        $('#plus').click(function() {
            
            var tag = null;
            
            if( $('.section').find('table').length ) {
                tag = $('.section').find('table');
            } else {
                tag = $('.section').find('h1');
            }
            
            var id = tag.data('id');
            
            if ( id === 'category' ) {
                var modal = $(MODAL.replace('{0}', 'add')
                               .replace('{1}', 'Add'));
            
                formEvents(modal);

                $('header').after(modal);
                
            } else {
                
                post({
                    'category' : tag.data('category')
                }, 
                getLocation() + "/testadmin.php");
            }
            
        });
        
    }
    
    
    $(function() {
       clickTable();
       adminButtons();
       backButton();
       plusButton();
       formEvents();
        
    });
    
    
})();