<?php

require "../public/_elements.php";

$pageTitle = "Login";
require "../public/_header.php";
?>
<?php basketIcon() ?>
</header>

<div id="content">
    <?php echo $backButton; //calls variables from elements.php   ?>

    <h2><?php echo $pageTitle ?></h2>
    
    <?php if ($data == "<p style='color: #AA0000'>Your email or password is wrong.</p>") { echo $data; unset($data); }?>

    <form method="POST" action="index.php?url=login/in">
        <p>
            <label>Email:</label>
            <br />
            <input name="email" type="email" />
        </p>
        
        <p>
            <label>Password:</label>
            <br />
            <input name="password" type="password" />
        </p>
        
        <p>
            <input type="submit" value="Submit" />
        </p>
    </form>
    
    <br />
    
    <p>Don't have an account? Register <a href="index.php?url=login/register">here</a>.</p>
</div>

<?php footer(); ?>
</body>
</html>
