
<h1> Test has been successfully  submitted</h1>

<div class="wrap-table">
    <form class="table" method="post" action="<?php echo PUBLIC_HTML_PATH . '/home.php' ;?>">
        <table id="form-header">
             <tr>
                <td>Category: </td>
                <td id='category'><?php echo $category; ?></td>
            </tr>
            <tr>
                <td>Test name: </td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>Answeared questions: </td>
                <td><?php echo $answeared . '/' . $number; ?></td>
            </tr>            
            <tr>
                <td>Points: </td>
                <td><?php echo $points . '/' . $total_points; ?></td>
            </tr>
            <tr>
                <td>Result: </td>
                <td><?php
                    echo $result; ?></td>
            </tr>
        </table>
        <div id='form-footer'>
            <button type='submit' name='home'>Home</button>
        </div>
    </form>
</div>