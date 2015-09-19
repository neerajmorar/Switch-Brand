<?php

$_SESSION["file"] = "addtobasket.php"; //used in quanChange.php

require "../public/_elements.php";

$pageTitle = "Add to Basket";
require "../public/_header.php";
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <?php echo $backButton; ?>

    <h2>Add to Basket</h2>

    <?php
    //evaluates if item is added or already exists; displays appropriate message
    if (isset($data[2])) {
        echo $data[2];
    } else {
        echo "<p>This item has been added to your basket.</p>";
    }
    ?>

    <div id="addTo">
        <?php
        $watch = $data[1];
        
        //generates image and its price for display
        for ($i = 0; $i < count($watch); $i++) {
            foreach ($watch[$i] as $j => $j_value) {
                if ($j == "ProdID") {
                    if ($j_value == $data[0]) {
                        $image = $watch[$i]["ProdID"];
                        $price = $watch[$i]["Price"];
                        echo "<img src='../public/Images/" . $image . ".png' alt='" . $data[0] . "' />";
                        echo "<p id='price'>&pound;" . $price . "</p>";
                        echo "<hr id='priceDivider' />";
                    } else {
                        break;
                    }
                }
            }
        }
        ?>
        <!-- Form for changing quantity of item selected -->
        <form id="quanChange" method="POST" action="index.php?url=add/quantity/<?php echo $data[0]; ?>">
            <p id="quantity">Quantity: 
                <select name="quanChange">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </p>
            <!--<input name="quanItem" type="hidden" value="<?php echo $data[0]; ?>" /> <!-- hidden input to parse selected item name -->
            <input type="submit" value="Go" />
            <p id="quanWarning"><?php if (isset($_SESSION["quanWarning"])) {
            echo $_SESSION["quanWarning"];
            unset($_SESSION["quanWarning"]);
        } //evaluating if warning message is set or not ?></p>
        </form>
        <hr />
        <p class='delete'><a href='index.php?url=add/remove/<?php echo $image; //generates link for item deletion ?>'>Remove from basket</a></p>
    </div>
</div>

<?php footer(); ?>
</body>
</html>

