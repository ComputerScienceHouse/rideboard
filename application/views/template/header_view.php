<!DOCTYPE HTML>
<html>
    <head>
        <title>Message Board</title>
        <link href="<?=site_url('css/style.css')?>" rel="stylesheet" type="text/css">
        <link href="<?=site_url('js/jquery-ui/css/custom-theme/jquery-ui-1.8.9.custom.css')?>" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core-debug.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script>
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
                <a href="<?=site_url()?>">CSH Ride Board</a>
            </div>
            <div class="user-status">
                <?php
                if(isset($_SESSION['loggedIn']))
                {
                    echo 'Welcome '.$_SESSION['loggedIn']['full_name'].' | <a href="'.site_url('my_car').'">My Car</a> | <a href="'.site_url('login/logout').'">Logout<a>';
                }
                else
                {
                    echo '<a href="'.site_url('login').'">Login</a>';
                }
                ?>
            </div>
        </div>
        <div id="container">