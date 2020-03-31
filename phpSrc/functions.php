<?php

// This functions sets the login section's look
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

// This function returns user data based on user's login
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

//This function shows user's orders based on user's login
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
?>