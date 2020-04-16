<?php include('header.php'); ?>
    
    

    <main class="front-page-content flex-center-column">
        <header class="front-page-content-header">
            <h1>Witaj w naszym sklepie komputerowym LW</h1>
            <h3>Zaufało nam już <span class="color-green"><?php echo $db_connection -> query('SELECT COUNT(*) FROM uzytkownik')->fetch_array()[0]; ?></span> klientów</h3>
        </header>

        <div class="random-products flex-center-row">

        <?php 
            createProductMiniature(1,$db_connection);
            createProductMiniature(2,$db_connection);
        ?>


        </div>

    </main>

<?php include('footer.php'); ?>