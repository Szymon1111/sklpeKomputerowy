<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sklep komputerowy LW</title>

    <!-- STYLES LINK -->
    <link rel="stylesheet" href="css/main.css?10">
    <link rel="stylesheet" href="css/form.css?11">
    <link rel="stylesheet" href="css/header.css?10">
    <link rel="stylesheet" href="css/userPanel.css?11">

    <!-- FONTS LINK -->
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">

</head>

<body>

    <script>

        let incorrectPassword = false;

    </script>

    <?php 
        // Setup database connection
        // $db_connection = mysqli_connect('sql304.epizy.com','epiz_25413168','Du3OTBCyHxmn','epiz_25413168_shop');
        $db_connection = mysqli_connect('localhost','root','','shop');
        
        // Setup session
        session_start();

        if(@$_SESSION['is_log'] == true){}
        else $_SESSION['is_log'] = false;

        //Include file with all useful functions
        include('phpSrc/functions.php');

        // Login script
        if(isset($_POST['submit'])){
            $login = $_POST['login'];
            $password = $_POST['password'];

            $check_user_db_question = 'SELECT * FROM uzytkownik WHERE login = "'.$login.'" AND haslo = "'.$password.'"';

            $check_user = $db_connection->query($check_user_db_question);
        
            if($check_user -> num_rows > 0){
                $_SESSION['is_log'] = true;
                $_SESSION['login'] = $login;

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
?>
    <section class="log-form-section">

        <div class="login-failed-alert"></div>

        <form action="" method="POST" class="log-form">

            <input type="text" name='login' placeholder="LOGIN / E-MAIL" id="login-field">
            <input type="password" name='password' placeholder="HASŁO">

            <button type="submit" name="submit">zaloguj</button>

        </form>

    </section>

    <div class="content">
        <header class="page-header flex-center-row">

            <h1>sklep komputerowy</h1>

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