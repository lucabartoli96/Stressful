<div class='main-box'>
    <h1> <?php echo $operation; ?> Test </h1>
    <form>
        <table id="form-header">
             <tr>
                <td>Category: </td>
                <td id='category'><?php echo $category; ?></td>
            </tr>
            <tr>
                <td>Test name: </td>
                <td> <input id='name' type='text' placeholder="insert name" name='name' value='<?php 
                    
                    if( $name !== null ) {
                        echo $name;
                    }
                    
                    ?>'></td>
            </tr>
            <tr>
                <td>Questions: </td>
                <td id='questions-number'>0</td>
            </tr>            
            <tr>
                <td>Correct answear: </td>
                <td><input id='correct' type='number' placeholder="1" name='correct' min="1" max="5"></td>
            </tr>
            <tr>
                <td>Mistake: </td>
                <td><input id='mistake' type='number' placeholder="0" name='mistake' min="0" max="0"></td>
            </tr>
            <tr>
                <td>Total points: </td>
                <td id='total-points'>0</td>
            </tr>
        </table>
        
        <ul id='question-form'> <li><button class='plus-question'> <img src='img/plus.png' /> </button>
            </li>
        </ul>
        
        <div id='form-footer'>
            <button type="submit" name="<?php echo strtolower($operation); ?>" 
                    value="<?php
                           
                           if ( $operation === 'Update' ) {
                               echo $name;
                           }
                           
                           ?>"><?php echo $operation; ?></button>
            <button type="submit" name="quit">Quit</button>
        </div>
    </form>
</div>

