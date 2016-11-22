<?php
//header or leaderboard
require_once('includes/db.php');
?>
<header>
    <div class="wrapper">
        <div id="logo_container"><a href="./"><?php echo file_get_contents("resources/images/logo.svg"); ?></a></div>
        <?php
        //track session
        if(isset($_SESSION["logged"])){//user logged in. display username and logout button
            $user_id=$_SESSION['logged'];
        }
        else{//user not logged in. display app name
            ?>
            <div id="app_name"><?php echo $app_name; ?></div>
            <?php
        }
        ?>
    </div>
</header>