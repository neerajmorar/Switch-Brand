<?php

require "../public/_elements.php";

$total = array(); //array which holds total price of items and respective quantities

$pageTitle = "Your Basket";
require "../public/_header.php";
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <?php echo $backButton; ?>

    <div id="yourBasket">
        <?php
        $watch = $data[1];

        //checks if basket empty or not
        if (isset($_SESSION["basket"]) == false || count($_SESSION["basket"]) == 0) {
            echo $data[0];
        } else {
            echo "<h2>Your Basket</h2>";
            echo "<p style='color: #AA0000;'>Click on an item if you wish to change its quantity or to remove it from your basket.</p>";
            //loops through basket and generates necessary info about items in it
            foreach ($_SESSION["basket"] as $i => $i_value) {
                for ($j = 0; $j < count($watch); $j++) {
                    foreach ($watch[$j] as $k => $k_value) {
                        if ($k == "ProdID") {
                            if ($k_value == $i) {
                                foreach ($watch[$j] as $l => $l_value) {
                                    if ($l == "Price") {
                                        $price = $l_value;
                                    }
                                    $image = $watch[$j]["ProdID"];
                                }
                                echo "<a href='index.php?url=add/edit/" . $image . "'><img src='../public/Images/" . $image . ".png' alt='" . $watch[$j]["Model"] . "' /></a>";
                                echo "<p class='price'>&pound;" . number_format((float) $price, 2, ".", ",") . "</p>";
                                echo "<hr />";
                                echo "<p class='quantity'>Quantity: " . $i_value . "</p>";
                                echo "<hr />";
                                echo "<p class='delete'><a href='index.php?url=add/remove/" . $image . "'>Remove from basket</a></p>";
                                echo "<hr class='itemDivider' />";
                                $total[] = ($price * $i_value); //adds to array after finding product of price and quantity
                            }
                        }
                    }
                }
            }
        }
        ?>
    </div>
    <?php
    if (isset($_SESSION["basket"]) == true) {
        if (count($_SESSION["basket"]) > 0) {
            //finds sum of items in $total array, formats it and echoes it
            echo "<p id='total'>&pound;" . number_format((float) array_sum($total), 2, ".", ",") . "</p>";
            //creates checkout button
            echo "<p id='checkOut'><a href='index.php?url=checkout/index'>Proceed to Checkout</a></p>";
        }
    }
    ?>
</div>

<?php footer(); ?>
</body>
</html>

