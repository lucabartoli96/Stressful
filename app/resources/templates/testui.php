<div class='main-box'>
    <h1> <?php echo $name; ?> </h1>
    <form>
        <?php
            print_questions($questions);    
        ?>        
        <div id='form-footer'>
            <button type="submit" name="submit" data-category="<?php echo $category; ?>" data-name="<?php echo $name; ?>">Submit</button>
            <button type="submit" name="quit">Quit</button>
        </div>
    </form>
</div>

