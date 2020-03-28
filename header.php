<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sklep komputerowy LW</title>

    <!-- STYLES LINK -->
    <link rel="stylesheet" href="css/main.css?6">
    <link rel="stylesheet" href="css/form.css?2">
    <link rel="stylesheet" href="css/header.css?3">

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
                    echo 'Niepoprawne dane logowania !!!';
                }
            }
        }
?>
    <section class="log-form-section">

    <form action="" method="POST" class="log-form">

        <input type="text" name='login' placeholder="LOGIN / E-MAIL">
        <input type="password" name='password' placeholder="HASŁO">

        <button type="submit" name="submit">zaloguj</button>

    </form>

    </section>

    <div class="content">
        <header class="page-header">

            <h1>sklep komputerowy</h1>

            <nav class="main-menu">

                <a href="index.php"><div class="main-menu-element">home</div></a>
                <a href="shop.php"><div class="main-menu-element">sklep</div></a>
                <a href="contact.php"><div class="main-menu-element">kontakt</div></a>

                <section class="menu-log-section">
                    <img src="img/user.png" alt="LOG" class="log-img">
                    <div class="log-status" style="color:#32CD32;">zalogowany</div>
                </section>

            </nav>
            
            <script>
                let logStatus = document.querySelector('.log-status');
            </script>

            <?php is_log() ?>


        </header>