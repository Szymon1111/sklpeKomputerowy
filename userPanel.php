<?php include('header.php'); ?>

    <div class="user-panel">

        <h1>Witaj User !</h1>

        <div class="orders">

            nie masz zamówień

        </div>

        <!-- logout script -->
        <form action="" method="POST">
            <button type="submit" name="logout">wyloguj</button>
        </form>

        <?php
        
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location: index.php");
            }
        
        ?>

    </div>

<?php include('footer.php'); ?>