(function() {
    
    
    var QUESTION = "<li class='question'>" +
                        "<input class='quest-sentence' type='text'>" + 
                        "<ul id='question-{0}' class='fields'>" + 
                            "<li> <button class='plus-option'> <img src='img/plus.png' /> </button> </li>" + 
                        "</ul>" + 
                        "<div class='buttons'>" +
                            "<button class='delete'>" +
                                "<img src='img/delete.png' />" + 
                            "</button>" +
                        "</div>" +
                    "</li>",
        OPTION = "<li> <input type='radio' name='{0}'> <input type='text'> </li>";
    
    var index=0, number=0;
    
    var question_form, number_output, points_output;
    
    function updateTable() {
        var points = Number($('#correct').val()) || 1;
        number_output.html(number);
        points_output.html( points * number );
    
    }
    
    function init() {
        question_form = $('#question-form');
        number_output = $('#questions-number');
        points_output = $('#total-points');
    }
    
    function initPage() {
        
        var button = $("button[type='submit']:not(button[name='quit'])");
        
        var operation = button.attr('name');
        
        if ( operation === 'update' ) {
            var name = button.val();
            
            $.post(STRESSFUL_API, {
                'category' : $('#category').html().trim(),
                'test' : name
            }).done(function(data) {
                
                if ( LOG_ENABLED ) { alert(data); }
                
                var rep = JSON.parse(data);
                
                if( rep.error ) {
                    alert(rep.error);
                } else {
                    fillFields(rep);
                    plusHandlers();
                }
                
            });
            
        } else {
            addQuestion();
            plusHandlers();
        }
    }
    
    function addOption(question, text, isAns) {
        
        var option = $(OPTION.replace('{0}', $(question).find('.fields').attr('id')));
        
        if ( text ) {
            $(option).find("input[type='text']").attr('value', text);
            if ( isAns ) {
                $(option).find("input[type='radio']").attr('checked', true);
            }
        }
        
        $(question).find('.plus-option')
            .closest('li').before(option);
        
    }
    
    function addQuestion(sentence, answear, options) {
        
        index++;
        number++;
        
        var question = $(QUESTION.replace('{0}', index));
        
        if ( sentence ) {
            $(question).find('.quest-sentence').attr('value', sentence);
        }
        
        if ( answear !== undefined && options !== undefined ) {
            
            $(options).each(function(i, text) {
                addOption(question, text, answear === i);
                
            });
        } else {
            addOption(question);
        }
        
        questionHandlers(question);
        
        $('.plus-question').before(question);
        
    }
    
    function fillFields(content) {
        
        number_output.html(content.number);
        $('#correct').val(content.correct);
        $('#mistake').val(content.mistake);
        
        $(content.questions).each(function(i, question) {
            addQuestion(question.question, 
                        question.answear,
                        question.options);
        });
        
    }
    
    function questionHandlers(question) {
        
        question.find('.plus-option').click(function(event) {
            event.preventDefault();
            addOption(question);
        });


        question.find('.delete').click(function(event) {
            question.remove();
            number--;
            updateTable();
        });
    }
    
    
    function plusHandlers() {
        $('.plus-question').click(function(event) {
            addQuestion();
            updateTable();
            
        });
    }
    
    
    function tableHandlers() {
        $('#correct').change(function() {
            var points = Number($(this).val()) || 1;
            $('#mistake').attr('max', points);
            points_output.html( points * number );
        });
    }
    
    
    function tableErrMsg(msg) {
        return "<tr><td></td><td>" + errMsg(msg) + "</td></tr>"
    }
    
    function submitHandlers() {
        
        $('form').submit(function(event) {
            event.preventDefault();
        });
        
        $("button[name='quit']").click(function(event) {
            event.preventDefault();
            post({
               'category' : $('#category').html()
            }, 'home');
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
                    .after(tableErrMsg("name is required"));
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
                        'test'     : name,
                        'number'   : list.length,
                        'correct'  : correct,
                        'mistake'  : mistake,
                        'category' : category,
                        'questions': JSON.stringify(list)
                    };
                    
                if ( $(this).attr('name') === 'update' ) {
                    params['update'] = $(this).val();
                } else {
                    params['add'] = true;
                }
                
                $.post(STRESSFUL_API, params)
                .done(function(data) {
                    
                    var rep = JSON.parse(data);
                    
                    if ( rep.error ) {
                        $('#name').closest('tr')
                            .after(tableErrMsg(rep.error));
                    } else {
                        post({}, 'home');
                    }
                    
                });
            }
            
            
        });
        
        
    }
    
    $(function() {
        
        init();
        initPage();
        submitHandlers();
        tableHandlers();
    });
    
})();