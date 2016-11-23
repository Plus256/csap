<main>
    <?php
    if(isset($_SESSION["logged"])){//user logged in. display user dashboard with chats and more
        print_r($_SESSION["logged"]);
    }
    else{//display homepage with link to login
        require_once('includes/home.php');
    }
    ?>
</main>