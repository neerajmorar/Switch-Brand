<?php

require '../public/_elements.php';

$pageTitle = 'Welcome';
require '../public/_header.php';
?>
<?php basketIcon()  //executes function from elements.php     ?>
</header>

<div id="content">
    <h2>Welcome<span id="greeting"><?php if (isset($_SESSION['user']) == true ) { echo ', ' . $_SESSION['user']; } //creates personalised greeting ?></span></h2>

    <p>Here are a range of watches for you to choose from.</p>

    <div class="imageContainer">
        <table>
            <tr>
                <?php
                //creates a 3 row table
                for ($i = 0; $i < count($data); $i++) {
                    echo "<td>";
                    //finds image
                    foreach ($data[$i] as $j => $j_value) {
                        if ($j == "Model") {
                            $alt = $j_value;
                            echo "<a href='index.php?url=item/index/" . $data[$i]['ProdID'] . "'><img src='../public/Images/" . $data[$i]['ProdID'] . ".png' alt='" . $alt . "' /></a>";
                        }
                    }
                    echo "</td>";
                }
                echo "</tr>
            <tr id='model'>";
                for ($i = 0; $i < count($data); $i++) {
                    echo "<td>";
                    //finds product name
                    foreach ($data[$i] as $j => $j_value) {
                        if ($j == "Model") {
                            echo $j_value;
                            break;
                        } else {
                            continue;
                        }
                    }
                    echo "</td>";
                }
                echo "</tr>
            <tr id='price'>";
                for ($i = 0; $i < count($data); $i++) {
                    echo "<td>";
                    //finds price
                    foreach ($data[$i] as $j => $j_value) {
                        if ($j == "Price") {
                            echo "&pound;" . number_format((float) $j_value, 2, ".", ",");
                            break;
                        } else {
                            continue;
                        }
                    }
                    echo "</td>";
                }
                ?>
            </tr>
        </table>
    </div>
    <?php
    if (isset($_COOKIE["recentView"])) {
        echo "<h3 id='recent'>Recently viewed</h3>";
        recentlyViewed();
    }
    ?>
</div>

<?php footer(); //calls function from elements.php   ?>
</body>
</html>