<?php include('header.php'); ?>
    
    

    <main class="flex-center-column front-page-content">
        <header class="front-page-content-header">
            <h1>Witaj w naszym sklepie komputerowym LW</h1>
            <h3>Zaufało nam już <span class="color-green"><?php echo $db_connection -> query('SELECT COUNT(*) FROM uzytkownik')->fetch_array()[0]; ?></span> klientów</h3>
        </header>

        <div class="random-products">

            <?php 
                createProductMiniature(30,$db_connection);
                createProductMiniature(31,$db_connection);
                createProductMiniature(32,$db_connection);
            ?>
            
        </div>

    </main>

<?php include('footer.php'); ?>