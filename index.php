<?php include('header.php'); ?>
    
    

    <main class="front-page-content">
        <header class="front-page-content-header">
            <h1>Witaj w naszym sklepie komputerowym LW</h1>
            <h3>Zaufało nam już <span style="color:#32CD32;"><?php echo $db_connection -> query('SELECT COUNT(*) FROM uzytkownik')->fetch_array()[0]; ?></span> klientów</h3>
        </header>

    </main>

<?php include('footer.php'); ?>