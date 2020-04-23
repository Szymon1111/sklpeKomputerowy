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
    if($answer)
        $orders_number = $answer -> num_rows;
    else
        $orders_number = 0;

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

function isThisInDatabase($thingToCheck,$columnName,$table,$db_connection){

    $que = 'SELECT login FROM '.$table.' WHERE '.$columnName.'="'.$thingToCheck.'"';
    $answer = $db_connection->query($que);
    $answer = $answer->fetch_array();
    
    if($answer[0])
        return true;
    else
        return false;
}

function createProductMiniature($productId,$db_connection){
     
    $que = 'SELECT * FROM produkty WHERE id_produktu="'.$productId.'"';
    $answer = $db_connection->query($que);
    
    if($answer -> num_rows > 0){
        $answer = $answer->fetch_array();

        echo '
        <div class="product-miniature">
                    <a href="product.php?productId='.$answer[0].'" class="miniature-title"><h2 class="miniature-title">'.$answer[1].'</h2></a>
                <h3 class="miniature-price">Cena '.$answer[2].'</h3>
        </div>
        ';
    }

}

function showCategoriesList($db_connection){
    echo '<select name="category" id="categories">';

    $que = 'SELECT * FROM kategorie';
    $answer = $db_connection -> query($que);
    $rowsNumber = $answer -> num_rows;

    for($i = 0; $i < $rowsNumber; $i++){
        $ans = $answer->fetch_array();
        echo '<option value="'.$ans[0].'">'.$ans[0].'</option>';
    }
  
    echo '</select>';
}
?>