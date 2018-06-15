(function() {
    
    var test_obj;
    
    
    function resultTable(category, test, answeared, points, result) {

        var table = '<h1> Test successfully submitted </h1>';

        table += "<div class='wrap-table'>" +
                    "<div class='table'>" +
                        "<table id='form-header'>" +
                            "<tbody>";
        
        table += "<tr>" +
                    "<td>Category: </td>" +
                    "<td>" + category + "</td>" +
                 "</tr>" +
                 "<tr>" +
                    "<td>Name: </td>" +
                    "<td>" + test  + "</td>" +
                 "</tr>" +                 
                 "<tr>" +
                    "<td>Answered questions: </td>" +
                    "<td>" + answeared + "/" + test_obj.number  + "</td>" +
                 "</tr>" +
                "<tr>" +
                    "<td>Points: </td>" +
                    "<td>" + points + "/" + (test_obj.number*test_obj.correct)  + "</td>" +
                 "</tr>" +
                 "<tr>" +
                    "<td>Result: </td>" +
                    "<td>" + result + "</td>" +
                 "</tr>";
        
        table +=            "</tbody>" +
                        "</table>" +
                    "</div>" +
                "</div>";
        
        table += "<div id='form-footer'>" + 
            "<button type='submit' name='home'>Home</button>" +
        "</div>";

        return table;
    }
    
    
    function buildTest(questions) {
        
        var test = "";
            
        $(questions).each(function(i, question ) {
            test += "<li class='question'>";
            test += question['question'];
            test += "<ul class='fields'>";
            
            $(question.options).each(function(j, option) {
                test += "<li> <input type='radio' name='question-" + i + "'><p>" + option + "</p></li>";
            });
            
            test += "</ul></li>";
            
        });
        
        return test;
        
    }
    
    function initContent() {
        
        var button = $("button[name='submit']");
        
        $.post(STRESSFUL_API, {
            'category' : button.data('category'),
            'test'     : button.data('name')
        }).done(function(data) {
            
            if ( LOG_ENABLED ) { alert(data); }
            
            var rep = JSON.parse(data);
            
            if ( rep.error ) {
                alert(rep.error);
            } else {
                test_obj = rep;
                $('#question-form').html(buildTest(rep.questions));
            }
            
        });
        
    }
    
    
    function submitHandler() {
        
        $('form').submit(function(event) {
            event.preventDefault();
        });
        
        $("button[name='submit']").click(function(event) {
            event.preventDefault();
            
            if( confirm("You won't be able to change your answears, are you sure you want to submit?") ) {
                
                var number  = Number(test_obj.number),
                    correct = Number(test_obj.correct),
                    mistake = Number(test_obj.mistake),
                    questions = test_obj.questions,
                    points = 0, answeared = 0;
                
                $('.question').each(function(i) {
                    
                    var checked = $(this).find("input[type='radio']:checked"),
                        answear = Number(questions[i]['answear']);
                    
                    if ( checked.length ) {
                        var cli_ans = checked.closest('li').index();
                        
                        if ( answear === cli_ans ) {
                            points += correct;
                        } else {
                            points -= mistake;
                        }
                        
                        answeared++;
                    }
                    
                });
                
                var button = $("button[name='submit']");
                
                var result = "" + (Math.ceil(points / (number*correct))*100) + "%";
                
                $.post(STRESSFUL_API, {
                    'submission' : true,
                    'add' : button.data('name'),
                    'category' : button.data('category'),
                    'result'   : result
                }).done(function(data) {

                    if ( LOG_ENABLED ) { alert(data); }

                    var rep = JSON.parse(data);

                    if ( rep.error ) {
                        alert(rep.error);
                    } else {
                        $('.container-section').html(resultTable(
                            button.data('category'),
                            button.data('name'),
                            answeared,
                            points,
                            result
                        ));
                        homeButton();
                    }

                });
                
            }
            
        });
    }
    
    
    function quitHandler() {
        
        $("button[name='quit']").click(function(event) {
            event.preventDefault();
            
            if( confirm('You will lose all your answears, are you sure you want to quit') ) {        
                setLocation('home');
            }
            
        });
        
    }
    
    function homeButton() {
        $("button[name='home']").click(function() {
            setLocation('home');
        });
    }
    
    
    $(function() {
        
        initContent();
        submitHandler();
        quitHandler();
        
    });
    
})();
