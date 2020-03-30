<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sklep komputerowy LW</title>

    <!-- STYLES LINK -->
    <link rel="stylesheet" href="css/main.css?10">
    <link rel="stylesheet" href="css/form.css?10">
    <link rel="stylesheet" href="css/header.css?10">
    <link rel="stylesheet" href="css/userPanel.css?11">

    <!-- FONTS LINK -->
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">

</head>

<body>

    <?php 
        // Setup database connection
        // $db_connection = mysqli_connect('sql304.epizy.com','epiz_25413168','Du3OTBCyHxmn','epiz_25413168_shop');
        $db_connection = mysqli_connect('localhost','root','','shop');
        
        // Setup session
        session_start();

        if(@$_SESSION['is_log'] == true){}
        else $_SESSION['is_log'] = false;

        // This function set the login panel look 
        function is_log(){ 
            global $db_connection;

            if($_SESSION['is_log']){
                if(@$_SESSION['is_admin'])
                    $foo = getUserData($_SESSION['login'],'pracownik','imie',$db_connection).' '.getUserData($_SESSION['login'],'pracownik','nazwisko',$db_connection).' [A]';
                else
                    $foo = getUserData($_SESSION['login'],'uzytkownik','imie',$db_connection).' '.getUserData($_SESSION['login'],'uzytkownik','nazwisko',$db_connection);
            ?>
                <script type='text/javascript'>
                    logStatus.innerHTML = "<?php echo $foo ?>";
                    logStatus.style.color = '#32CD32';
                </script>

            <?php
                }
                else{
            ?>
                <script type='text/javascript'>
                    logStatus.innerHTML = 'zaloguj';
                    logStatus.style.color = 'black';
                </script>
            <?php
            }
        }

        function logOut(){

        }

        function getUserData($userLogin,$from,$what,$db_connection){
            $que = 'SELECT '.$what.' FROM '.$from.' WHERE login = "'.$userLogin.'"';

            if($userLogin == '')
                echo 'Login uzytkownika nie moze byc rowny NULL';

            $answer = $db_connection->query($que);
            $answer = $answer->fetch_array();

            if($what == '*')
                return $answer;
            else
                return $answer[0];
        }

        function showUserOrders($userLogin,$db_connection){
            $que = 'SELECT Id_zamowienia,status,cena FROM zamowienia WHERE Login_uzytkownika="'.$userLogin.'"';

            if($userLogin == '')
                echo 'Login uzytkownika nie moze byc rowny NULL';

            $answer = $db_connection->query($que);
            $orders_number = $answer -> num_rows;

            if($orders_number == 0)
                echo 'Nie masz zamówień';
            else{
                echo'
                <div class="single-order flex-center-row">
                    <div class="order-id">Numer</div>
                    <div class="order-status">Status</div>
                    <div class="order-price">Cena</div>
                </div>';
                for($i = $orders_number;$i > 0;$i--){
                    $toShow = $answer->fetch_array();
                    echo '<div class="single-order flex-center-row"><div class="order-id">'.$toShow[0].'</div><div class="order-status">'.$toShow[1].'</div><div class="order-price">'.$toShow[2].'</div></div>';
                }
            }

        }

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
            }
            else{
                $check_user_db_question = 'SELECT * FROM pracownik WHERE login = "'.$login.'" AND haslo = "'.$password.'"';

                $check_user = $db_connection->query($check_user_db_question);
            
                if($check_user -> num_rows > 0){
                    $_SESSION['is_log'] = true;
                    $_SESSION['login'] = $login;
                    $_SESSION['is_admin'] = true;

                    is_log();
                }
                else{
                    ?>
                    <script type="text/javascript">let incorrectPassword = true;</script>
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