<?php include('header.php'); ?>

<form method="POST" class="register-form">

    <h4 class="register-form-headers">Dane do logowania</h4>
    <input class="medium" type="text" placeholder="login">
    <input class="medium" type="text" placeholder="hasło">
    <input type="text" placeholder="e-mail">

    <h4 class="register-form-headers">Dane do wysyłki</h4>
    <span>
    <input class="medium" type="text" placeholder="imię">
    <input class="medium" type="text" placeholder="nazwisko ">
    </span>

    <span>
        <input type="text" placeholder="ulica">
        <input class="house-number shorter" type="text" placeholder="nr domu"> / 
        <input class="house-number shorter" type="text" placeholder="nr lokalu">
    </span>
    <span>
        <input class="post-code short" type="text" placeholder="kod pocztowy">
        <input class="city-name medium" type="text" placeholder="miasto">
    </span>


</form>

<?php include('footer.php'); ?>