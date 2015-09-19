<?php
//This is the header for which all pages of the website will use.
//$pageTitle allows the title of the page to be dynamically set.
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Switch Brand - <?php echo $pageTitle ?></title>
        <link rel="stylesheet" type="text/css" href="CSS/theme.css" />
        <link href="CSS/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript">
            function clearForm() {
                window.location.reload();
            }
        </script>
    </head>
    <body>
        <header>
            <h1 id="heading"><a href="index.php">Switch Brand</a></h1>