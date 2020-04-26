<?php 
// Setup session
session_start();
// Setup database connection
$db_connection = mysqli_connect('localhost','root','','shop');
// $db_connection = mysqli_connect('localhost','id13294886_shopusername','Trek session 7','id13294886_shop');
$db_connection->query("SET CHARSET utf8");
$db_connection->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sklep komputerowy LW</title>

    <!-- STYLES LINK -->
    <link rel="stylesheet" href="css/main.css?17">
    <link rel="stylesheet" href="css/form.css?17">
    <link rel="stylesheet" href="css/header.css?19">
    <link rel="stylesheet" href="css/userPanel.css?14">
    <link rel="stylesheet" href="css/register.css?15">
    <link rel="stylesheet" href="css/product.css?15">
    <link rel="stylesheet" href="css/miniature.css?17">
    <link rel="stylesheet" href="css/search.css?19">

    <!-- FONTS LINK -->
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">

</head>

<body>

    <script>
        let incorrectPassword = false;
    </script>

    <?php 
        if(@$_SESSION['is_log'] == true){}
        else $_SESSION['is_log'] = false;

        //Include file with all useful functions
        include('phpSrc/functions.php');

        // Login script
        if(isset($_POST['login-button'])){
            $login = $_POST['login'];
            $password = $_POST['password'];

            $check_user_db_question = 'SELECT * FROM uzytkownik WHERE (login="'.$login.'" OR Email="'.$login.'") AND haslo="'.base64_encode($password).'"';
            $check_user = $db_connection->query($check_user_db_question);
        
            if($check_user -> num_rows > 0){
                $setLogin = 'SELECT login FROM uzytkownik WHERE (login="'.$login.'" OR Email="'.$login.'")';
                $_SESSION['is_log'] = true;
                $_SESSION['login'] = $db_connection->query($setLogin)->fetch_array()[0];

                is_log();
                ?>
                <script>sessionStorage.setItem('isAdmin','false');</script>
                <?php
            }
            else{
                $check_user_db_question = 'SELECT * FROM pracownik WHERE login = "'.$login.'" AND haslo = "'.$password.'"';

                $check_user = $db_connection->query($check_user_db_question);
            
                if($check_user -> num_rows > 0){
                    $_SESSION['is_log'] = true;
                    $_SESSION['login'] = $login;
                    $_SESSION['is_admin'] = true;

                    is_log();
                    ?>
                    <script>sessionStorage.setItem('isAdmin','true');</script>
                    <?php
                }
                else{
                    ?>
                    <script type="text/javascript">incorrectPassword = true;</script>
                    <?php
                }
            }
        }

        //Searching script
        if(isset($_POST['search'])){
            $searching_category = $_POST['category'];
            $searching_phrase = $_POST['search-input']; 
            
            if($searching_category == 'ALL')
                $que = 'SELECT nazwa,id_produktu FROM produkty WHERE nazwa LIKE "%'.$searching_phrase.'%"';
            else
                $que = 'SELECT nazwa,id_produktu FROM produkty WHERE nazwa LIKE "%'.$searching_phrase.'%" AND kategoria="'.$searching_category.'"';

            $res = $db_connection->query($que);
            $numberOfSearches = $res->num_rows;

            if($numberOfSearches > 0){
                echo '<div class="search-results">';
                for($i = 0;$i < $numberOfSearches; $i+=1){
                    $single_product = $res->fetch_array();

                    echo '<a href="product.php?productId='.$single_product[1].'"><div class="search-single-result">'.$single_product[0].'</div></a>';
                }
                echo '</div>';
            }
        }
?>
    <section class="log-form-section">

    

        <div class="login-failed-alert">Niepoprawne dane logowania</div>

        <form action="" method="POST" class="log-form">

            <input type="text" name='login' placeholder="login / e-mail" id="login-field">
            <input type="password" name='password' placeholder="hasło">

            <button type="submit" name="login-button">zaloguj</button>

            <a href="register.php" class="create-account">utwórz konto</a>

        </form>

        
    </section>  

    <div class="search-icon">

        <div class="search-cir"></div>
        <div class="search-lin"></div>
        
    </div>

    <div class="search-form-box">

        <form action="" method="POST" class="search-form">

            <span class="flex-center-row">

                <input type="text" class="search-input" name="search-input">

                <button type="submit" name="search" class="search-button">
                    <img src="img/search.png" alt="" class="search-button-img">
                </button>  

            </span>

            <?php showCategoriesList($db_connection); ?>
            
        </form>

    </div>

    <div class="content">
        <header class="page-header flex-center-row">

            <h1>sklep komputerowy</h1>


            

            <div class="searchbox">
                
            </div>

            <nav class="main-menu flex-center-row">

                <a href="index.php"><div class="main-menu-element">home</div></a>
                <a href="shop.php"><div class="main-menu-element">sklep</div></a>
                <a href="contact.php"><div class="main-menu-element">kontakt</div></a>

                <section class="menu-log-section flex-center-column">
                    <img src="img/user.png" alt="LOG" class="log-img">
                    <div class="log-status" style="color:#32CD32;">zalogowany</div>
                </section>

            </nav>
            
            <script>
                let logStatus = document.querySelector('.log-status');
            </script>

            <?php is_log() ?>


        </header>