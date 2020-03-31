<!-- logout script -->
<form action="" method="POST">
        <button type="submit" name="logout" class='logout-btn'>wyloguj</button>
    </form>

    <?php
        
        if(isset($_POST['logout'])){
            session_destroy();
            ?>
            <script>sessionStorage.clear();</script>
            <?php
            header("Location: index.php");
        }
    
    ?>