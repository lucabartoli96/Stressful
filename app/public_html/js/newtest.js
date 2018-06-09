(function() {
    
    
    var QUESTION = "<li class='question'>" +
                        "<input type='text'>" + 
                            "<ul id='question-{0}' class='fields'>" + 
                                "<li> <input type='radio' name='{0}'> <input type='text'> </li>" + 
                                "<li> <button class='plus-option'> <img src='img/plus.png' /> </button> </li>" + 
                            "</ul>" + 
                    "</li>",
        OPTION = "<li> <input type='radio' name='group{0}'> <input type='text'> </li>";
         
    
    var length = 0;
    
    var questions;
    
    
    $(function() {
        
        $('form').submit(function(event) {
            event.preventDefault();
        });
        
        questions = $('#question-form');
        
        $('.plus-question').click(function(event) {
           var question = $(QUESTION.replace('{0}', length));
        
            $(question).find('.plus-option').click(function(event) {
                var li = $(this).closest('li'),
                    name = li.closest('ul').attr('id'),
                    option = $(OPTION.replace('{0}', name));

                li.before(option);
            });

            $(this).before(question);
            
        }).click();
        
    })
    
})();