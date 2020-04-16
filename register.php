<?php include('header.php'); ?>

<form action="" method="POST" class="register-form">

    <h4 class="register-form-headers">Dane do logowania</h4>
    <input class="medium" type="text" name="register-login" placeholder="login" required>
    <input class="medium" type="text" name="haslo" placeholder="hasło" required>
    <input type="text" name="email" placeholder="e-mail" required>

    <h4 class="register-form-headers">Dane do wysyłki</h4>
    <span>
    <input class="medium" type="text" placeholder="imię" name="imie" required>
    <input class="medium" type="text" placeholder="nazwisko" name="nazwisko" required>
    </span>

    <span>
        <input type="text" placeholder="ulica" name="ulica">
        <input class="house-number shorter" type="text" placeholder="nr domu" name="nr_domu" required> / 
        <input class="house-number shorter" type="text" placeholder="nr lokalu" name="nr_lokalu">
    </span>
    <span>
        <input class="post-code short" type="text" placeholder="kod pocztowy" name="kod_pocztowy" required>
        <input class="city-name medium" type="text" placeholder="miasto" name="miasto" required>
    </span>

    <h4 class="agree">Zgody</h4>
    <span class="checkbox-span">
        <input type="checkbox" name="regulations" required>
        <p>Akceptuję postanowienia regulaminu</p>
    </span>
    <span class="checkbox-span">
        <input type="checkbox" name="newsletter">
        <p>Zapisz mnie do newslettera</p>
    </span>


    <button type="submit" name="register">Utwórz konto</button>


</form>

<?php

    if(isset($_POST["register"])){
        if(isThisInDatabase(@$_POST['email'],'Email','uzytkownik',$db_connection)){
            echo '<div class="waring">Do podanego adresu e-mail przypisane jest już inne konto</div>';
        }
        if(isThisInDatabase(@$_POST['register-login'],'login','uzytkownik',$db_connection)){
            echo '<div class="waring">Ten login jest już zajęty</div>';
        }
        else{
            $insert = 'INSERT INTO uzytkownik (Imie,Nazwisko,Email,Login,Haslo,Ulica,Miasto,Kod_pocztowy,Nr_domu,Nr_lokalu) VALUES ("'.$_POST["imie"].'","'.$_POST["nazwisko"].'","'.$_POST["email"].'","'.$_POST["register-login"].'","'.base64_encode($_POST["haslo"]).'","'.$_POST["ulica"].'","'.$_POST["miasto"].'","'.$_POST["kod_pocztowy"].'","'.$_POST["nr_domu"].'","'.$_POST["nr_lokalu"].'")';
            if($db_connection->query($insert))?>
                <script>location.href='index.php';</script>");
            <?php
        }
    }
    
?>

<?php include('footer.php'); ?>