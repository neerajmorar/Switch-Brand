<?php
require "../public/_elements.php";

$pageTitle = "Choose Card";
require "../public/_header.php";
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <h2>Choose Card</h2>
    
    <p>Click <a href="index.php?url=checkout/newCard">here</a> to add a new card.</p>
    
    <p id="selectWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["selectWarn"])) { echo "block;"; unset($_SESSION["selectWarn"]); } else { echo "none;"; } ?> padding-left: 0;">Choose a card to pay with.</p>
    
    <form method="POST" action="index.php?url=checkout/finalise">
        <p>
        <?php
        //loops through to display cards for user to select from
        for ($i = 0; $i < count($data[0]); $i++) {
            echo "<input name='card' type='radio' value=" . $data[0][$i] . " />" . $data[0][$i] . " <strong>Exp. Date:</strong> " . $data[1][$i];
            echo "<br />";
        }
        ?>
        </p>
        
        <p>
            <input type="submit" value="Submit" />
        </p>
    </form>
</div>

<?php footer(); ?>
</body>
</html>

