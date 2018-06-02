<header role="banner">
    <div class="fluid-container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <img src="img/LOGO_orange.png">
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        $active = true;
                    
                        foreach ( $sections as $a ) {
                            echo "<li";
                            if ( $active ) {
                                echo " class='active' ";
                                $active = false;
                            }
                            echo "><a data-nav-section='" . strtolower($a) ."'><span>$a</span></a></li>\n";
                        }
                    
                    ?>
                    <li class="call-to-action"><a class="logout"><span>Log out</span></a></li>
                </ul>
            </div>
        </nav>
  </div>
</header>
