<div class="wrap-table">
    <div class="table">
        <table data-id="<?php echo $id; ?>" 
               data-name="<?php echo $name; ?>" 
               data-value="<?php echo $value; ?>" >
            <thead>
                <tr class="head">
                    <th class="column1"></th>
                    <?php
                        $first = true;
                        foreach ( $content[0] as $key => $value) {

                            if ( !$first ) {
                                echo "<th>$key</th>";
                            } else {
                                $first = false;
                            }
                        }
                    
                        if ( $admin ) {
                            echo "<th class='last_column'></th>";
                        }

                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach( $content as $row) {
                        echo "<tr>";
                        
                        $first = true;
                        
                        foreach( $row as $value ) {
                            if ($first) {
                                echo "<td class='column1'>$value</td>";
                            } else {
                                echo "<td>$value</td>";
                            }
                        }
                        
                        if ( $admin ) {
                            echo "<td class='last_column'>".
                                    "<button class='modify'><img src='img/modify.png'></button>".
                                    "<button class='delete'><img src='img/delete.png'></button>".
                                "</td>";
                        }
                        
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>