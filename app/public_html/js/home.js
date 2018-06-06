(function() {
    
    
    function clickTable() {
        
        $('table tbody tr').click(function (event) {
            
            var name = $(this).closest('table').data('id'),
                value = $(this).find('td:eq(0)').html();
            
            var form = document.createElement("form");
            form.setAttribute('method', 'POST');
            form.setAttribute('style', 'display: none');
            
            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', name);
            input.setAttribute('value', value);
            
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
            
        });
        
    }
    
    function adminButtons() {
        
        $('button.modify').click(function (event) {
            event.stopPropagation();
            
        });
        
        $('button.delete').click(function (event) {
            event.stopPropagation();
            var name = $(this).closest('tr').find('td:eq(0)').html();
            
            if (confirm("Are you sure you want to delete " + name + "?")) {
                
                var table = $(this).closest('table');
                
                var form = document.createElement("form");
                form.setAttribute('method', 'POST');
                form.setAttribute('style', 'display: none');

                if ( table.data('name') !== '' && table.data('value') !== '' ) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', table.data('name'));
                    input.setAttribute('value', table.data('value'));
                    form.appendChild(input);
                }
                
                var input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('name', 'delete');
                input.setAttribute('value', name);
                form.appendChild(input);
                
                document.body.appendChild(form);
                form.submit();

            }
        });
        
    }
    
    $(function() {
       clickTable();
       adminButtons();
    });
    
    
})();