<header>
    <div class="wrapper">
        <div id="logo_container"><a href="./"><?php echo file_get_contents("resources/images/logo.svg"); ?></a></div>
        <?php
        //track session
        if(isset($_SESSION["logged"])){//user logged in. display username and logout button
            require_once('includes/user.php');
            ?>
            <a id="signout_button" href="includes/logout.php">Logout</a>
            <span id="user_name"><?php echo $user->name; ?></span>
            <?php
        }
        else{//user not logged in. display app name
            ?>
            <span id="app_name"><?php echo $app_name; ?></span>
            <?php
        }
        ?>
        <div class="spacer"></div>
    </div>
</header>