<form action="" method="POST">

    <input type="text" name="product-title" placeholder="Tytuł produktu">
    <input type="number" min="0.00" max="10000.00" step="0.01" name="product-image" placeholder="Cena produktu"/>
    
    <?php showCategoriesList($db_connection); ?>

    <input type="file" name="product-image" class="flex-center-row">

    <button type="submit" name="add-product">Dodaj produkt</button>

</form>


<?php

    if(isset($_POST['upload-image'])){

        $conn_id = ftp_connect('files.000webhost.com');
        ftp_pasv($conn_id, true); 
        $login_result = ftp_login($conn_id, 'stronaserwerowe', 'Trek session 7');
        $localFile = $_FILES['product-image']['tmp_name'];
        $fileNameOnServer = $_FILES['product-image']['name'];

        echo $localFile;
        echo $fileNameOnServer;

        if (ftp_put($conn_id, $fileNameOnServer, $localFile, FTP_BINARY)) {
            echo "successfully uploaded";
        } else {
            echo "There was a problem while uploading";
        }

        ftp_close($conn_id);

    }


?>
<!-- <form action="" method="POST" enctype="multipart/form-data">
      
      <button type="submit" name="upload-image">Upload Image</button>
</form> -->