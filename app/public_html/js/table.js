
(function () {

    "use strict";
    
    function hover() {

        $('td').on('mouseover',function(){
            var table = $(this).closest('table'),
                index = $(this).index();
            //$(table).find('tbody').find("td:eq(" + index + ")").addClass('hov-column');
            $(table).find('thead').find("th:eq(" + index + ")").addClass('hov-column-head');
            
        })

        $('td').on('mouseout',function(){
            var table = $(this).closest('table'),
                index = $(this).index();
            //$(table).find('tbody').find("td:eq(" + index + ")").removeClass('hov-column');
            $(table).find('thead').find("th:eq(" + index + ")").removeClass('hov-column-head');
            
        })
        
    }
    
    $(function() {
       
        hover();
        
    });
    

    
    
})();