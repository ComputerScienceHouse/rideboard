<!DOCTYPE HTML>
<html>
    <head>
        <title>Message Board</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core-debug.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>
        <?php
            foreach($css as $styles)
            {
                echo '<link href="'.$styles.'" type="text/css" rel="stylesheet">';
            }

            foreach($javascript as $js)
            {
                echo '<script src="'.$js.'" type="text/javascript"></script>';
            }
        ?>
    </head>
    <body>
        <div id="header">
            <div class="logo">
                Logo here
            </div>
            <div class="user-status">
                Welcome User!
            </div>
        </div>
        <div id="container">