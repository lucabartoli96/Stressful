<div class='shadow'>
    <form id='modal' method='post'>  
       <span id='close'>&times;</span>  
       <input type='text' name='name' placeholder='name'>  
        <?php 
        login_err($err);
        ?>
       <button type='submit' 
               name='<?php echo strtolower($operation); ?>'
               <?php
               
               if ( $value !== null ) {
                   
                   echo " value='$value' ";
                   
               }
               
               ?> > <?php echo $operation; ?> </button>  
    </form>
</div>