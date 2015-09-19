<?php

require "../public/_elements.php";

$pageTitle = "Register";
require "../public/_header.php";
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <?php echo $backButton; //calls variables from elements.php   ?>

    <h2><?php echo $pageTitle; ?></h2>

    <p><strong>* - These fields are required.</strong></p>

    <form id="register" method="POST" action="index.php?url=login/confirmReg">
        <p>
            <label>Your Email:*</label>
            <br />
            <input name="email" type="email" <?php if (isset($_SESSION["emailBorder"])) { echo "style='border: " . $_SESSION["emailBorder"] . "'"; unset($_SESSION["emailBorder"]); } ?> />

            <?php if ($data == "<span class='commonWarning' style='color: #AA0000; display: inline;'>This email has already been registered.</span>") { echo $data; unset($data); } ?>
            <span id="emailWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["emailWarn"])) { echo "inline"; unset($_SESSION["emailWarn"]); } else { echo "none"; } ?>">Invalid email.</span>
        </p>

        <p>
            <label>Password:*</label>
            <br />
            <input name="password" type="password" <?php if (isset($_SESSION["passBorder"])) { echo "style='border: " . $_SESSION["passBorder"] . "'"; } ?> />
            
            <span id="passWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["passWarn"])) { echo "inline"; unset($_SESSION["passWarn"]); } else { echo "none"; } ?>">Invalid password.</span>
        </p>

        <p>
            <label>Confirm Your Password:*</label>
            <br />
            <input name="passwordcon" type="password" <?php if (isset($_SESSION["passBorder"])) { echo "style='border: " . $_SESSION["passBorder"] . "'"; unset($_SESSION["passBorder"]); } ?> />
            
            <span id="verWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["verWarn"])) { echo "inline"; unset($_SESSION["verWarn"]); } else { echo "none"; } ?>">Passwords don't match.</span>
        </p>

        <p>
            <label>Your First Name:*</label>
            <br />
            <input name="fName" type="text" <?php if (isset($_SESSION["fBorder"])) { echo "style='border: " . $_SESSION["fBorder"] . "'"; unset($_SESSION["fBorder"]); } ?> />
            
            <span id="fWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["fWarn"])) { echo "inline"; unset($_SESSION["fWarn"]); } else { echo "none"; } ?>">Invalid name.</span>
        </p>

        <p>
            <label>Your Last Name:*</label>
            <br />
            <input name="lName" type="text" <?php if (isset($_SESSION["sBorder"])) { echo "style='border: " . $_SESSION["sBorder"] . "'"; unset($_SESSION["sBorder"]); } ?> />
            
            <span id="sWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["sWarn"])) { echo "inline"; unset($_SESSION["sWarn"]); } else { echo "none"; } ?>">Invalid name.</span>
        </p>

        <p>
            <label>Your Telephone/Mobile Number:*</label>
            <br />
            <input name="tel" type="text" <?php if (isset($_SESSION["tBorder"])) { echo "style='border: " . $_SESSION["tBorder"] . "'"; unset($_SESSION["tBorder"]); } ?> />
            
            <span id="telWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["telWarn"])) { echo "inline"; unset($_SESSION["telWarn"]); } else { echo "none"; } ?>">Invalid phone number.</span>
        </p>

        <p>
            <label>Address One:*</label>
            <br />
            <input name="addOne" type="text" <?php if (isset($_SESSION["add1Border"])) { echo "style='border: " . $_SESSION["add1Border"] . "'"; unset($_SESSION["add1Border"]); } ?> />
            
            <span id="add1Warn" class="commonWarning" style="display: <?php if (isset($_SESSION["add1Warn"])) { echo "inline"; unset($_SESSION["add1Warn"]); } else { echo "none"; } ?>">Invalid address.</span>
        </p>

        <p>
            <label>Address Two:</label>
            <br />
            <input name="addTwo" type="text" <?php if (isset($_SESSION["add2Border"])) { echo "style='border: " . $_SESSION["add2Border"] . "'"; unset($_SESSION["add2Border"]); } ?> />
            
            <span id="add2Warn" class="commonWarning" style="display: <?php if (isset($_SESSION["add2Warn"])) { echo "inline"; unset($_SESSION["add2Warn"]); } else { echo "none"; } ?>">Invalid address.</span>
        </p>

        <p>
            <label>Address Three:*</label>
            <br />
            <input name="addThree" type="text" <?php if (isset($_SESSION["add3Border"])) { echo "style='border: " . $_SESSION["add3Border"] . "'"; unset($_SESSION["add3Border"]); } ?> />
            
            <span id="add3Warn" class="commonWarning" style="display: <?php if (isset($_SESSION["add3Warn"])) { echo "inline"; unset($_SESSION["add3Warn"]); } else { echo "none"; } ?>">Invalid address.</span>
        </p>

        <p>
            <label>City:*</label>
            <br />
            <input name="city" type="text" <?php if (isset($_SESSION["cityBorder"])) { echo "style='border: " . $_SESSION["cityBorder"] . "'"; unset($_SESSION["cityBorder"]); } ?> />
            
            <span id="cityWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["cityWarn"])) { echo "inline"; unset($_SESSION["cityWarn"]); } else { echo "none"; } ?>">Invalid city.</span>
        </p>

        <p>
            <label>Post Code:*</label>
            <br />
            <input name="postCode" type="text" <?php if (isset($_SESSION["postBorder"])) { echo "style='border: " . $_SESSION["postBorder"] . "'"; unset($_SESSION["postBorder"]); } ?> />
            
            <span id="postWarn" class="commonWarning" style="display: <?php if (isset($_SESSION["postWarn"])) { echo "inline"; unset($_SESSION["postWarn"]); } else { echo "none"; } ?>">Invalid postcode.</span>
        </p>

        <p>
            <input type="button" value="Reset" onclick="clearForm()" />
            <input type="submit" value="Submit" />
        </p>
    </form>
</div>

<?php footer(); ?>
</body>
</html>
