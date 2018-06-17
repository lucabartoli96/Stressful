(function() {
    
    var MODAL = "<div class='shadow'>" + 
                "<form id='modal'>" + 
                   "<span id='close'>&times;</span>" + 
                   "<input type='text' name='name' placeholder='name'> " + 
                   "<button type='submit'> {0} </button>" + 
                "</form>" + 
            "</div>";

    
    var state, category;
    
    function modalModify(modal, oldname) {
        
        modal = modal || $('.shadow');
        
        var form = modal.find('form');
        
        form.submit(function(event) {
            event.preventDefault();
            
            $('.alert').remove();
            
            var input = $(this).find("input[name='name']");

            if ( input.val() === '' ) {
                input.after(errMsg('name is required'));
                return false;
            }
            
            $.post(STRESSFUL_API, {
                'all' : true,
                'modify' : oldname,
                'name' : input.val()
            }).done(function(data) {
                
                if(LOG_ENABLED) { alert(data); }
                
                var rep = JSON.parse(data);
                
                if ( rep.error ) {
                    input.after(errMsg(rep.error));
                } else {
                    modal.remove();
                    requireTable(state, category);
                }
                
            });
        });
    }
    
    function modalAdd(modal) {
        modal = modal || $('.shadow');
        
        var form = modal.find('form');
        
        form.submit(function(event) {
            event.preventDefault();
            
            $('.alert').remove();
            
            var input = $(this).find("input[name='name']");

            if ( input.val() === '' ) {
                input.after(errMsg('name is required'));
            }
            
            $.post(STRESSFUL_API, {
                'all' : true,
                'add' : true,
                'name' : $(modal).find('input').val()
            }).done(function(data) {
                
                if(LOG_ENABLED) { alert(data); }
                
                var rep = JSON.parse(data);
                
                if ( rep.error ) {
                    $(modal).find('input').after(errMsg(rep.error))
                } else {
                    modal.remove();
                    requireTable(state, category);
                }
                
            });
            
        });
    }
    
    function formEvents(modal) {

        $(modal).find('#close').click(function() {

            modal.remove();

        });
        
    }
    
    function backButton() {
        return "<button id='back' class='home-button' > <img src='img/back.png' /> </button>";
    }
    
    function plusButton() {
        return "<button id='plus' class='home-button' > <img src='img/plus.png' /> </button>";
    }
    
    function homeButtons() {
        
        $('#back').click(function(event) {
            event.stopPropagation();
            requireTable('all');
        });
        
        $('#plus').click(function(event) {
            event.stopPropagation();
            
            if ( state === 'all' ) {
                var modal = $(MODAL.replace('{0}', 'Add'));
            
                formEvents(modal);
                modalAdd(modal);

                $('header').after(modal);
                
            } else {
                
                requireTestAdmin('add');

            }
            
        });
        
        
    }
      
    function attachHandlers(table) {
        
        table.find('tbody tr').click(function() {
            
            var value = $(this).find('td:eq(0)').html();
            
            switch ( state ) {
                case 'all':
                    requireTable('category', value);
                    break;
                case 'category':
                    requireTest(value);
                    break;
            }
            
        });
        
        
        table.find('button.modify').click(function (event) {
            event.stopPropagation();
            
            if ( state === 'all' ) {
                
                var modal = $(MODAL.replace('{0}', 'Modify'));
                form = modal.find('form');
                
                formEvents(modal);

                var oldname = $(this).closest('tr').find('td:eq(0)').html();

                modalModify(modal, oldname);

                $('header').after(modal);
                
            } else {
                
                var name = $(this).closest('tr').find('td:eq(0)').html();
                requireTestAdmin('update', name);
                
            }
            
        });
        
        table.find('button.delete').click(function (event) {
            event.stopPropagation();
            var name = $(this).closest('tr').find('td:eq(0)').html();
            
            if (confirm("Are you sure you want to delete " + name + "?")) {
                
                var params = {};
                params[state] = category || true;
                params['delete'] = name; 
                $.post(STRESSFUL_API, params)
                .done(function(data) {
                    if (LOG_ENABLED) { alert(data); }
                    requireTable(state, category);
                });
            }
        });
        
        
    }
    
    function requireTable(name, value) {    
        
        state = name;
        category = value;
        
        var params = {};
        params[name] = value || true;
        
        $.post(STRESSFUL_API, params).done(function(data) {
            
            if(LOG_ENABLED) { alert(data); }
            
            var rep = JSON.parse(data);
            
            var admin = Number(rep.admin),
                str = "";
            
            if ( state === 'category' ) {
                str += backButton();
            }
            
            if ( rep.error ) {
                str += "<h1>" + rep.error + "</h1>";
            } else {
                str += buildTable(rep.content, admin);
            }
            
            if ( admin ) {
                str += plusButton();
            }
            
            var content = $(str);
            
            attachHandlers(content);
            
            $('.container-section').html(content);
            
            homeButtons();
        });
    }
      
    function requireTest(value) {
        post({
            'category' : category,
            'test' : value
        },
        'testuser');
        
    }
    
    function requireTestAdmin( operation, value ) {
        
        var params = {};
        params['category'] = category;
        params[operation] = true;
        
        if ( value ) {
            params['name'] = value;
        }
        
        post(params, 'testadmin');
        
    }
    
    $(function() {
        
        requireTable('all');
        
    });
    
    
})();