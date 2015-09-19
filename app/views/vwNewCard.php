<?php

require "../public/_elements.php";

$pageTitle = "Add Card";
require "../public/_header.php";
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <h2>Add Card Details</h2>
    
    <?php if($data == "<p style='color: #AA0000'>This card has already been registered.</p>") { echo $data; unset($data); }?>
    
    <form method="POST" action="index.php?url=checkout/add">
        <p>
            <label>Card Number:</label>
            <br />
            <input type="text" name="card" autocomplete="off" <?php if (isset($_SESSION["cardBorder"])) { echo "style='border: " . $_SESSION["cardBorder"] . "'"; unset($_SESSION["cardBorder"]); } ?> /> 
            
            <span id="cardWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["cardWarn"])) { echo "inline"; unset($_SESSION["cardWarn"]); } else { echo "none"; } ?>">Invalid card number.</span>
        </p>
        
        <p>
            <label>Expiration Date:</label>
            <br />
            <select name="expMonth" <?php if (isset($_SESSION["expBorder"])) { echo "style='border: " . $_SESSION["expBorder"] . "'"; unset($_SESSION["expBorder"]); } ?> >
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
            </select>
            <select name="expYear">
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
            </select>
            
            <span id="expWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["expWarn"])) { echo "inline"; unset($_SESSION["expWarn"]); } else { echo "none"; } ?>">Invalid expiry date.</span>
        </p>
        
        <p>
            <label>Security Number:</label>
            <br />
            <input type="text" name="secNo" autocomplete="off" <?php if (isset($_SESSION["secBorder"])) { echo "style='border: " . $_SESSION["secBorder"] . "'"; unset($_SESSION["secBorder"]); } ?> />
            
            <span id="secWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["secWarn"])) { echo "inline"; unset($_SESSION["secWarn"]); } else { echo "none"; } ?>">Invalid security number.</span>
        </p>
        
        <p>
            <input type="submit" value="Submit" />
        </p>
    </form>
</div>

<?php footer(); ?>
</body>
</html>

