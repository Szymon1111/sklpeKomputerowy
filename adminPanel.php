<?php include('header.php'); ?>

<div class="admin-panel flex-center-column">

    <h1>
        Witaj w pracy 
        <span class="color-green">
            <?php 
                echo getUserData($_SESSION['login'],'pracownik','imie',$db_connection);
            ?>
        </span>
        !
    </h1>
        
</div>

<?php include('phpSrc/uploadImage.php'); ?>
<?php include('phpSrc/logoutBtn.php'); ?>


<?php include('footer.php'); ?>