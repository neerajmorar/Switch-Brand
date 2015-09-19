<?php

require "../public/_elements.php";

$pageTitle = $data[0]["model"]; //item parsed from url produced via product href on welcome page
require "../public/_header.php";

$_SESSION["item"] = $pageTitle; //creates session variable, used for adding item to basket
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <?php echo $backButton; //calls variables from elements.php  ?>

    <h2><?php echo $pageTitle ?></h2>

    <div id="product">
        <img src="../public/Images/<?php echo $data[0]["id"]; ?>.png" alt="<?php echo $pageTitle; //dynamically create image of product ?>" />
        <?php
        echo "<p class='price'>&pound;" . number_format((float) $data[0]["price"], 2, ".", ",") . "</p>";
        echo "<p id='basket'><a href='index.php?url=add/index/" . $data[0]["id"] . "'>Add to basket</a></p>";
        echo "<hr id='priceDivider' />";
        echo "<p id='desc'>" . $data[0]["desc"] . "</p>";
        echo "<hr />";
        echo "<p id='quantity'><strong>" . $data[0]["quan"] . "</strong> left in stock</p>";
        echo "<hr />";
        ?>
    </div>

    <h3>Suggested for you</h3>
    <div id="suggested">
        <table>
            <tr>
                <?php
                $watch = $data[1];

                for ($i = 0; $i < count($watch); $i++) {
                    foreach ($watch[$i] as $j => $j_value) {
                        if ($j == "Model") {
                            if ($j_value == $pageTitle) {
                                break;
                            } else {
                                $alt = $j_value;
                                echo "<td>";
                                echo "<a href='index.php?url=item/index/" . $watch[$i]["ProdID"] . "'><img src='../public/Images/" . $watch[$i]["ProdID"] . ".png' alt='" . $alt . "' /></a>";
                                echo "</td>";
                            }
                        }
                    }
                }
                echo "</tr>
            <tr id='model'>";
                for ($i = 0; $i < count($watch); $i++) {
                    foreach ($watch[$i] as $j => $j_value) {
                        if ($j == "Model") {
                            if ($j_value == $pageTitle) {
                                break;
                            } else {
                                echo "<td>";
                                echo $j_value;
                                echo "</td>";
                                break;
                            }
                        } else {
                            continue;
                        }
                    }
                }
                echo "</tr>
            <tr id='price'>";
                for ($i = 0; $i < count($watch); $i++) {
                    foreach ($watch[$i] as $j => $j_value) {
                        if ($j == "Model") {
                            if ($j_value == $pageTitle) {
                                break;
                            } else {
                                continue;
                            }
                        }
                        if ($j == "Price") {
                            echo "<td>";
                            echo "&pound;" . number_format((float) $j_value, 2, ".", ",");
                            echo "</td>";
                            break;
                        } else {
                            continue;
                        }
                    }
                }
                ?>
            </tr>
        </table>
    </div>
</div>


<?php footer(); ?>
</body>
</html>

