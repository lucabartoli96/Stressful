<div class="wrap-table">
    <div class="table">
        <table>
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
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>