<main>
    <?php
    if(isset($_SESSION["logged"])){//user logged in. display user dashboard with chats and more
        $user_id=$_SESSION["logged"];//extract user ID from session variable
        require_once('includes/user.php');//include user information and more
    }
    else{//display homepage with link to login
        require_once('includes/home.php');
    }
    ?>
</main>