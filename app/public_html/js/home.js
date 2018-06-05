(function() {
    
    
    function clickTable() {
        
        $('table tbody tr').click(function (event) {
            var category = $(this).find('td:eq(0)').html();
            
            var form = document.createElement("form");
            form.setAttribute('method', 'POST');
            form.setAttribute('style', 'display: none');
            
            var input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', 'category');
            input.setAttribute('value', category);
            
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
            
        });
        
    }
    
    $(function() {
       clickTable();
    });
    
    
})();