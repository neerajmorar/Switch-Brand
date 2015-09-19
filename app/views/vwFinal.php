<?php

require "../public/_elements.php";

$total = array();

$pageTitle = "Finalise";
require "../public/_header.php";
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <h2>Finalise Your Order</h2>

    <h3>Your Order</h3>
    <ul>
        <?php
        //displays items in basket and relative info
        for ($i = 0; $i < count($data[0]); $i++) {
            foreach ($_SESSION["basket"] as $j => $j_value) {
                if ($data[0][$i]["ProdID"] == $j) {
                    echo "<li>" . $data[0][$i]["Model"] . " - <strong>&pound;". $data[0][$i]["Price"] . "</strong> x" . $j_value . " quantity</li>";
                    $total[] = $data[0][$i]["Price"] * $j_value;
                }
            }
        }
        ?>
    </ul>

    <h3>Your Delivery Details</h3>
    <?php
    //displays address
    echo "<p>" . $data[1][0]["C_Forename"] . " " . $data[1][0]["C_Surname"] . "<br />";
    echo $data[1][0]["C_AddressOne"] . "<br />";
    echo $data[1][0]["C_AddressTwo"] . "<br />";
    echo $data[1][0]["C_AddressThree"] . "<br />";
    echo $data[1][0]["C_City"] . "<br />";
    echo $data[1][0]["C_PostCode"] . "</p>";
    echo "<p>Telephone: " . $data[1][0]["C_Telephone"] . "</p>";
    ?>

    <h3>Selected Card</h3>
    <?php
    //displays card chosen
    echo "<p>" . $data[2][0] . "</p>";
    ?>
    <hr />

    <?php
    echo "<p id='total'>&pound;" . number_format((float) array_sum($total), 2, ".", ",") . "</p>";
    //creates checkout button
    echo "<p id='order'><a href='index.php?url=checkout/order/" . substr($data[2][0], 15) . "/" . number_format((float) array_sum($total), 2, ".", "") . "'>Checkout</a></p>";
    ?>
</div>

<?php footer(); ?>
</body>
</html>