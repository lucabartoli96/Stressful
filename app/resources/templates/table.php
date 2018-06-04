<div id="<?php echo $id; ?>" class="limiter">
		<div class="container-table">
			<div class="wrap-table">
				<div class="table">
					<table>
						<thead>
                            <tr class="head">
                                <th></th>
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
                                    foreach( $row as $value ) {
                                        echo "<td>$value</td>";
                                    }
                                    echo "</tr>";
                                }
                            ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>