<?php include('header.php'); ?>

<div class="user-panel flex-center-column">

    <h1>Witaj <span
            class="color-green"><?php echo getUserData($_SESSION['login'],'uzytkownik','imie',$db_connection); ?></span>
        !</h1>

    <div class="orders flex-center-column">

        <h2 class="orders-header">Twoje zamówienia</h2>

        <?php showUserOrders($_SESSION['login'],$db_connection); ?>

    </div>

    <!-- logout script -->
    <form action="" method="POST">
        <button type="submit" name="logout" class='logout-btn'>wyloguj</button>
    </form>

    <?php
        
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location: index.php");
            }
        
        ?>

</div>

<?php include('footer.php'); ?>