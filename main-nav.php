<?php
    if(isset($_COOKIE["profileid"])) {
        $profileidCookieSet = true;
    } else {
        $profileidCookieSet = false;
    }
?>
    
    <section class="materialNavSection">
        <nav class="flex-between">
            <div>
                <img src="assets/img/kelvinshotz-logo.png" alt="">
            </div>
            <div>
                <ul>
                    <li><a class="active" href="#">Home</a></li>
                    <li><a class="" href="#">About</a></li>
                    <li><a class="" href="#">Book Shoots</a></li>
                    <li><a class="" href="#">Contact</a></li>
                </ul>    
            </div>
            <div>
                <ul>
                    <?php 
                        if($profileidCookieSet){
                            echo '<li><a class="materialButton" href="#">Sign Out</a></li>';
                        } else {
                            echo '<li><a class="materialButton" href="login.php">Log in</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </section>

    <section class="materialNavSection mobile">
        <nav class="flex-between">
            <div>
                <img src="assets/img/kelvinshotz-logo.png" alt="">
            </div>
            <div>
                <ul>
                    <?php 
                        if($profileidCookieSet){
                            echo '<li><a class="materialButton" href="#">Sign Out</a></li>';
                        } else {
                            echo '<li><a class="materialButton" href="login.php">Log in</a></li>';
                        }
                    ?>
                    <li><a class="materialButton" href="#">Sign Out</a></li>
                    <li class="toggleButton">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 12H22.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.5 21H22.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M1.5 3H22.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </li>
                </ul>
            </div>
        </nav>

        <nav class="dropdown">
            <div>
                <ul class="flex-column">
                    <li><a class="active" href="#">Home</a></li>
                    <li><a class="" href="#">About</a></li>
                    <li><a class="" href="#">Book Shoots</a></li>
                    <li><a class="" href="#">Contact</a></li>
                </ul>    
            </div>
        </nav>
    </section>