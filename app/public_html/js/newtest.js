(function() {
    
    
    var QUESTION = "<li class='question'>" +
                        "<input type='text'>" + 
                        "<ul id='question-{0}' class='fields'>" + 
                            "<li> <input type='radio' name='question-{0}'> <input type='text'> </li>" + 
                            "<li> <button class='plus-option'> <img src='img/plus.png' /> </button> </li>" + 
                        "</ul>" + 
                        "<div class='buttons'>" +
                            "<button class='delete'>" +
                                "<img src='img/delete.png' />" + 
                            "</button>" +
                        "</div>" +
                    "</li>",
        OPTION = "<li> <input type='radio' name='{0}'> <input type='text'> </li>";
         
    
    var index, number;
    
    var question_form, number_output, points_output;
    
    function updateTable() {
        var points = Number($('#correct').val()) || 1;
        number_output.html(number);
        points_output.html( points * number );
    
    }
    
    function init() {
        index = number = $('.question').length;
        question_form = $('#question-form');
        number_output = $('#questions-number');
        points_output = $('#total-points');
    }
    
    function plusHandlers() {
        $('.plus-question').click(function(event) {
            var question = $(QUESTION
                             .replace('{0}', index)
                             .replace('{0}', index));
            
            index++;
            
            $(question).find('.plus-option').click(function(event) {
                var li = $(this).closest('li'),
                    name = li.closest('ul').attr('id'),
                    option = $(OPTION.replace('{0}', name));
                
                li.before(option);
            });
            
            
            $(question).find('.delete').click(function(event) {
                question.remove();
                number--;
                updateTable();
            });
            
            $(this).before(question);
            number++;
            updateTable();
            
        });
        
        if( $('.question').length === 0 ) {
            $('.plus-question').click();
        }
    }
    
    
    function tableHandlers() {
        $('#correct').change(function() {
            var points = Number($(this).val()) || 1;
            $('#mistake').attr('max', points);
            points_output.html( points * number );
        });
    }
    
    
    function submitHandlers() {
        
        $('form').submit(function(event) {
            event.preventDefault();
        });
        
        $("button[name='quit']").click(function(event) {
            event.preventDefault();
            post({
               'category' : $('#category').html()
            }, getLocation() + '/home.php');
        });
        
        $("button[name='create'], button[name='update']").click(function(event) {
            event.preventDefault();
            
            $('.alert').remove();
            
            var name = $('#name').val().trim(),
                correct = Number($('#correct').val() || 1),
                mistake = Number($('#mistake').val() || 0),
                category = $('#category').html().trim();
            
            if ( name === '' ) {
                $('#name').closest('tr')
                    .after("<tr><td></td><td>" + errMsg("name is required") + "</td></tr>");
                return;
            }
            
            var list = [],
                err_flag = false;
            
            var questions = $('.question');
            
            if ( questions.length == 0 ) {
                $('#form-footer').before(errMsg('Must create at least one question'));
                return;
            }

            questions.each(function() {
                
                var question = $(this).find("input[type='text']:eq(0)").val();
                
                if( question === '' ) {
                    $(this).append(errMsg("Question text is required"));
                    err_flag = true;
                }
                
                var inputs = $(this).find('.fields input[type="text"]'),
                    empty = inputs.filter(function() {
                        return $(this).val() === "";
                    }),
                    checked = $(this).find('input[type="radio"]:checked');
                    
                    
                if ( inputs.length < 2 ) {
                    $(this).append(errMsg('Must specify at least two options'));
                    err_flag = true;
                }
                
                if ( empty.length > 0 ) {
                    $(this).append(errMsg('Cannot leave empty options'));
                    err_flag = true;
                }
                
                if ( checked.length < 1) {   
                    $(this).append(errMsg('You must choose a correct answear'));
                    err_flag = true;
                }
                
                if ( !err_flag ) {
                    
                    var options = [];
                
                    inputs.each(function() {
                        options.push($(this).val().trim());
                    });

                    list.push({
                        'question' : question.trim(),
                        'answear'  : checked.closest('li').index(),
                        'options'  : options
                    });
                }
                
            });
            
            
            if ( !err_flag ) {
                var params = {
                        'name'     : name,
                        'number'   : list.length,
                        'correct'  : correct,
                        'mistake'  : mistake,
                        'category' : category,
                        'questions': JSON.stringify(list)
                    };
                
                if ( $(this).attr('name') === 'update' ) {
                    params['update'] = $(this).val();
                }
                
                post(params);
            }
            
            
        });
        
        
    }
    
    
    $(function() {
        
        init();
        submitHandlers();
        plusHandlers();
        tableHandlers();
    });
    
})();