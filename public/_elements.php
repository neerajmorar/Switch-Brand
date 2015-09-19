<?php

//page consisting of functions and variables

$backButton = "<p id='back'><a href='index.php?url=home/index'><i class='fa fa-arrow-left fa-2x'></i></a></p>"; //used for majority of site
$backButtonEdit = "<p id='back'><a href='basket.php'><i class='fa fa-arrow-left fa-2x'></i></a></p>"; //used for editbasket.php

function footer() {
    if (isset($_SESSION["user"])) {
        echo "<footer><small>&copy; 2015 Switch Brand. All Rights Reserved. <a href='index.php?url=login/out'>Log Out</a></small></footer>";
    } else {
        echo "<footer><small>&copy; 2015 Switch Brand. All Rights Reserved. <a href='index.php?url=login/index'>Log In</a> <a href='index.php?url=login/register'>Register</a></small></footer>";
    }
    
    echo "<br />";
    echo "<form method='POST' action='index.php?url=home/search'>Search: <input type='text' name='search' /> <input type='submit' value='Go' /></form>";
}

//function which creates basket icon and dynamically checks basket and its quantity
function basketIcon() {
    echo "<a href='index.php?url=basket/index'><div id='cart'><i class='fa fa-shopping-cart fa-3x'></i>";
    if (isset($_SESSION["basket"]) == false) {
        echo "<span>0</span>";
    } else {
        echo "<span>" . count($_SESSION["basket"]) . "</span>";
    }
    echo "</div></a>";
}
